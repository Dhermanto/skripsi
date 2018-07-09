<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller{

    public function __construct(){
        parent::__construct();
		$this->page->template('app_tpl');
		$this->load->model('user_model');
		$this->load->library("form_validation");

        if(!($this->session->userdata('pengguna'))) {
			redirect(base_url('login/admin'));
		}
        else if(($this->session->userdata('user'))) {
			redirect(base_url('apps'));
		}
    }

    public function index($q_encoded = 'x')
	{
        $this->user_model->set_filter($q_encoded);

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'user_name' => array('text' => 'User Name'),
				'user_wizlearn_id' => array('text' => 'User ID'),
				'user_email' => array('text' => 'Email'),
				'customer_name' => array('text' => 'Customer'),
				'user_group' => array('text' => 'User Group', 'func' => 'admin_bank'),
			),
			'num_rows' => $this->user_model->count(),
			'item' => 'id',
			'warning' => 'id',
			// 'sorting' => FALSE,
			'order' => 'desc',
			'checkbox' => FALSE,
		));

		$this->user_model->set_grid_params($this->grid->params());
		$this->grid->source($this->user_model->get());
		
		// $this->grid->add_actions(array(
  //           'sync' => array('show' => TRUE, 'title' => 'LMS Sync', 'icon' => 'refresh'),
  //       ));
		
		$this->page->view('user_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'filter' => $this->user_model->filter,
			'keyword' => $this->user_model->keyword,
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
		$this->page->view('user_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->user_model->by_id($id),
			'id' => $id,
            'customer_name' => $this->user_model->get_customer(),
		));
	}


	public function tambah()
	{
		$this->form();
	}


	public function edit($id)
	{
		$this->form('update', $id);
	}


	public function form_data()
	{
		$names = array('upper_user_name', 'user_password', 'user_group', 'user_email', 'user_wizlearn_id', 'customer_id');
		return form_data($names);
	}


	public function insert()
	{
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.user_name]');
		$this->form_validation->set_rules('user_wizlearn_id', 'User ID', 'trim|required|is_unique[users.user_wizlearn_id]');
		if ($this->form_validation->run() == FALSE){
			// $this->session->set_flashdata("error",validation_errors());
			// redirect("user/tambah");
			$this->form();
		}else{
			// masukkan ke tabel pengguna
			$data = $this->form_data();
	        $data['user_password'] = bjs_password($data['user_password']);

			db_insert('users', $data);
			$user_id = $this->db->insert_id();
			$this->session->set_flashdata('success', 'Data berhasil dibuat');
			redirect($this->page->base_url());
		}
	}


	public function update($id)
	{
		$data = $this->form_data();
		$data['lms_sync'] = '0';
		
        $user  = $this->db->get_where('users', array('id' => $id))->row();
		
		if (($data['user_password']) != '') {
            $data['user_password'] = bjs_password($data['user_password']);
        }
		else {
			$data['user_password'] = $user->user_password;
		}

		db_update('users', $data, array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect($this->page->base_url());
	}


	public function delete($id)
	{
		db_delete('users', array('id' => $id));
		$this->session->set_flashdata('success', 'Data berhasil dihapus');
		redirect($this->agent->referrer());
	}

    public function test()
    {
        $data = $this->uri->segment(1);
        echo $data;
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
