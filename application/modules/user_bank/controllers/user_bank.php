<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_bank extends MX_Controller{
	public $idBank;
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
		$idBank = $this->session->userdata('idBank');
		if (!$idBank) {
			$this->session->set_userdata('idBank', $this->uri->segment(3));
		}
		$idBank = $this->session->userdata('idBank');
        $this->user_model->set_filter($q_encoded);
		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'user_name' => array('text' => 'User Name'),
				'user_wizlearn_id' => array('text' => 'User ID'),
				'user_email' => array('text' => 'Email'),
                'credit_point' => array('text' => 'Credit Point'),
                // 'lms_sync' => array('text' => 'LMS Sync', 'align' => 'center', 'func' => 'sync_status'),
			),
			'num_rows' => $this->user_model->num_rows(),
			'item' => 'user_name',
			'warning' => 'user_wizlearn_id',
			// 'sorting' => FALSE,
			'checkbox' => FALSE,
		));

		$this->user_model->set_grid_params($this->grid->params());
		$this->grid->source($this->user_model->getById($idBank));
		$this->page->view('user_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/getById"),
			'param' => $q_encoded,
			'excel_url' => $this->page->base_url("/excel"),
			'filter' => $this->user_model->filter,
			'keyword' => $this->user_model->keyword,
			'grid' => $this->grid->draw(),   //data table
			'pagelink' => $this->grid->page_link(), //data paging
		));
	}

	public function excel($q_encoded = '')
    {
    	$this->user_model->set_filter($q_encoded);
    	$idBank = $this->session->userdata('idBank');
		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 4,
			'items'	=> array (
				'user_name' => array('text' => 'User Name'),
				'user_wizlearn_id' => array('text' => 'User ID'),
				'user_email' => array('text' => 'Email'),
                'credit_point' => array('text' => 'Credit Point'),
                // 'lms_sync' => array('text' => 'LMS Sync', 'align' => 'center', 'func' => 'sync_status'),
			),
			'num_rows' => $this->user_model->num_rows(),
			'item' => 'user_name',
			'warning' => 'user_wizlearn_id',
			'order'	=> 'desc',
			// 'sorting' => FALSE,
			'checkbox' => FALSE,
		));
		$this->grid->disable_all_acts();
		$this->user_model->set_grid_params($this->grid->params());
		$this->grid->source($this->user_model->getById($idBank));

		$konten = $this->load->view('result_excel', array (
			'grid' => $this->grid->draw(),   //data table
		),true);
		excel_header('user_credit_'.date('YmdHis').'.xls');
		echo $konten;
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
			$this->form();
		}else{
			// masukkan ke tabel pengguna
			$data = $this->form_data();
	        $data['user_password'] = bjs_password($data['user_password']);

			db_insert('users', $data);
			$user_id = $this->db->insert_id();
			
			// redirect
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
		redirect($this->page->base_url());
	}


	public function delete($id)
	{
		db_delete('users', array('id' => $id));
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
