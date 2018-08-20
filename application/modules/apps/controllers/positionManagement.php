<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PositionManagement extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model('position_management_model');
        $this->load->model('category/category_model');
        $this->load->model('up_model');
        $this->load->library("form_validation");
    }

    public function index($q_encoded = 'x')
	{
        $this->position_management_model->set_filter($q_encoded);

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 5,
			'items'	=> array (
                'position_name' => array('text' => 'Position Name'),
			),
			'num_rows' => $this->position_management_model->num_rows(),
			'item' => 'id',
			'warning' => 'position_name',
			'order' => 'desc',
			'sorting' => FALSE,
			'checkbox' => FALSE,
		));

		$this->position_management_model->set_grid_params($this->grid->params());
		$this->grid->source($this->position_management_model->get());

		$this->page->view('position_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'filter' => $this->position_management_model->filter,
			'keyword' => $this->position_management_model->keyword,
			'grid' => $this->grid->draw(),   //data table
			'pagelink' => $this->grid->page_link(), //data paging
		));
	}

    public function filter()
    {
        $q_encoded = base64_encode(json_encode($this->input->post()));
		redirect($this->page->base_url("/index/$q_encoded"));
    }

    public function search()
	{
		$q_encoded = base64_encode(json_encode($this->input->post()));
		redirect($this->page->base_url("/index/$q_encoded"));
	}


	public function form($action = 'insert', $id = '')
	{
		$this->page->view('position_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->position_management_model->byId($id),
			'id' => $id,
			'category' => $this->category_model->getAll(),
		));
	}


	public function tambah()
	{
		$this->form();
	}

    public function insert()
	{
		$userData 	= $this->session->userdata('user');
        $data 		= $this->form_data();
        $uploadData = array();
        $count = 0;
        $dataDetail = array();
        $dataUserPosition 	 = array();
        $dataUserPosition['position_name'] = $data['position_name'];
        $dataUserPosition['customer_id']   = $userData->id;
        db_insert('user_position', $dataUserPosition);
        $userPosId = $this->db->insert_id();
        foreach ($_FILES['exam']['name'] as $key => $value) {
        	if ($value != "") {
        		$_FILES['exams']['name'] 	 = $value;
                $_FILES['exams']['type'] 	 = $_FILES['exam']['type'][$key];
                $_FILES['exams']['tmp_name'] = $_FILES['exam']['tmp_name'][$key];
                $_FILES['exams']['error'] 	 = $_FILES['exam']['error'][$key];
                $_FILES['exams']['size'] 	 = $_FILES['exam']['size'][$key];

                $uploadPath 			 = 'uploads/exam/';
                $config['upload_path']   = $uploadPath;
                $config['encrypt_name']  = TRUE;
                $config['allowed_types'] = 'pdf|txt|gif|jpg|png|doc|docx';
                $this->load->library('upload', $config);
                if ( $this->upload->do_upload('exams') ){
                    $fileData = $this->upload->data();
                    // $uploadData[$count]['file_name'] = $fileData['file_name'];

                    $dataDetail['user_position_id'] = $userPosId;
		        	$dataDetail['course_id'] 		= $key;
		        	$dataDetail['exam'] 			= $fileData['file_name'];
					db_insert('user_position_detail', $dataDetail);
                }
                $count++;
        	}
        }

        $this->session->set_flashdata('success', 'Data berhasil dibuat');
		redirect($this->page->base_url());
    }

	public function edit($id)
	{
		$this->form('update', $id);
	}

	public function form_data()
	{
		$names = array('position_name', 'courses', 'exam');
		return form_data($names);
	}

	public function update($id)
	{
		$userData = $this->session->userdata('user');
		$data 	  = $this->form_data();
		$checkId  = $this->up_model->getByPoisition($id)->result();
		$oldCourse  = array();
		$newCourse  = array();
		$dataDetail = array();
		$dataArr  	= array();
		$count 	  = 0;
		if (isset($_FILES['exam'])) {
			foreach ($_FILES['exam']['name'] as $key => $value) {
	        	if ($value != "") {
	        		$_FILES['exams']['name'] 	 = $value;
	                $_FILES['exams']['type'] 	 = $_FILES['exam']['type'][$key];
	                $_FILES['exams']['tmp_name'] = $_FILES['exam']['tmp_name'][$key];
	                $_FILES['exams']['error'] 	 = $_FILES['exam']['error'][$key];
	                $_FILES['exams']['size'] 	 = $_FILES['exam']['size'][$key];
	                $uploadPath 			 = 'uploads/exam/';
	                $config['upload_path']   = $uploadPath;
	                $config['encrypt_name']  = TRUE;
	                $config['allowed_types'] = 'pdf|txt|gif|jpg|png|doc|docx';
	                $this->load->library('upload', $config);
	                if ( $this->upload->do_upload('exams') ){
	                    $fileData = $this->upload->data();
	                    $uploadData[$key] = $fileData['file_name'];
	                }
	                $count++;
	        	}
	        }
		}
		foreach ($checkId as $key => $value) {
			array_push($oldCourse, $value->course_id);		
		}

		$oldData = array_diff($oldCourse, $data['courses']);
		if (count($oldData) > 0) {
			foreach ($oldData as $key => $value) {
				$this->db->delete('user_position_detail', 
					array(
						'course_id' => $value,
						'user_position_id' => $id,
					)
				); 
			}
		}

		//update
		foreach ($uploadData as $key => $value) {
			$checkCourse = $this->db->get_where('user_position_detail', 
				array(
					'user_position_id' => $id,
					'course_id' 	   => $key,
				)
			)->row();

			if (count($checkCourse) == 0) {
				$dataDetail['user_position_id'] = $id;
				$dataDetail['course_id'] 		= $key;
				$dataDetail['exam'] 			= $value;
				db_insert('user_position_detail', $dataDetail);	
			}
			else {
				$dataArr["exam"] = $value;
				db_update('user_position_detail', 
					$dataArr, 
					array(
						'course_id' => $key,
						'user_position_id' => $id,
						'deleted_at' => 0
					));
			}
		}

		$dataUserPosition = array();
		$dataUserPosition['position_name'] = $data['position_name'];
		db_update('user_position', $dataUserPosition, array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect($this->page->base_url());
	}


	public function delete($id)
	{
		db_delete('user_position', array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect($this->agent->referrer());
	}

    public function test()
    {
        test();
    }

}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
