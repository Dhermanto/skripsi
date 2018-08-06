<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends MX_Controller{

    public function __construct(){
        parent::__construct();
		$this->page->template('app_tpl');
		$this->load->model('course_model');

        if(!($this->session->userdata('pengguna'))) {
			redirect(base_url('login/admin'));
		}
        else if(($this->session->userdata('user'))) {
			redirect(base_url('apps'));
		}
    }

    public function index($q_encoded = 'x')
	{
        $this->course_model->set_filter($q_encoded);

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'course_image' => array('text' => 'logo', 'func' => 'course_logo_thumbnail'),
                'course_title' => array('text' => 'Course Title'),
                'category_name' => array('text' => 'Category'),
                // 'course_wizlearn_id' => array('text' => 'LMS Course ID'),
                // 'course_opened_date' => array('text' => 'Opened Date'),
                // 'course_closed_date' => array('text' => 'Closed Date'),
                'credit_point' => array('text' => 'Credit point', 'align' => 'right'),
                'active_duration' => array('text' => 'Active Duration', 'align' => 'right'),
                'course_status' => array('text' => 'Status', 'func' => 'status_active'),
				// 'lms_sync' => array('text' => 'LMS Sync', 'align' => 'center', 'func' => 'sync_status'),
			),
			'num_rows' => $this->course_model->count()->num_rows(),
			'item' => 'id',
			'warning' => 'id',
			// 'sorting' => TRUE,
			'order' => 'desc',
			'checkbox' => FALSE,
		));

		$this->course_model->set_grid_params($this->grid->params());
		$this->grid->source($this->course_model->get());
		
		$this->page->view('course_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'filter' => $this->course_model->filter,
			'keyword' => $this->course_model->keyword,
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

	public function test()
	{
		$data = $this->course_model->get()->result();
		foreach ($data as $key => $value) {
			echo $value->course_title . "<br/>";
		}
	}

	public function form($action = 'insert', $id = '')
	{	

		$this->page->view('course_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->course_model->by_id($id),
			'id' => $id,
            // 'category' => $this->db->get_where('category', array('id' => $id))->result(),
		));
	}


	public function tambah()
	{
		$this->form();
	}

    public function insert()
	{
		// upload
		$image_data = $this->do_upload();

		$data = $this->form_data();
		$data['course_image'] = $image_data['file_name'];

		if ($data['course_image'] == '') {
			$data['course_image'] = 'no-image.png';
		}

        db_insert('courses', $data);
		$course_id = $this->db->insert_id();
		$this->session->set_flashdata('success', 'Data berhasil dibuat');
		redirect($this->input->post('redirect'));
    }
	
	public function do_upload()
    {
        $config['upload_path']          = './uploads/catalogs';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 4000;
        $config['max_height']           = 3000;
		$config['encrypt_name'] 		= TRUE;

        $this->load->library('upload', $config);

        $file = $this->upload->do_upload('course_image');

        return $this->upload->data();
    }


	public function edit($id)
	{
		$this->form('update', $id);
	}


	public function form_data()
	{
		$names = array('upper_course_title', 'course_description', 'course_status', 'credit_point', 'num_active_duration', 'course_category', 'course_image','course_demo','course_prerequisit');
		return form_data($names);
	}
	
	public function update($id)
	{
		// upload
		$image_data = $this->do_upload();
		
		$data = $this->form_data();
		$data['course_image'] = $image_data['file_name'];

		if ($data['course_image'] == '') {
			$image_past = $this->db->get_where('courses', "id = $id")->row();
			$data['course_image'] = $image_past->course_image;
		}

		$data['course_wizlearn_id'] = $this->input->post('course_wizlearn_id');
		$data['course_wizlearn_id'] = $response['courseid'];
		$data['lms_sync'] = '1';
		db_update('courses', $data, array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect($this->input->post('redirect'));
	}


	public function delete($id)
	{
		db_delete('courses', array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect($this->agent->referrer());
	}
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
