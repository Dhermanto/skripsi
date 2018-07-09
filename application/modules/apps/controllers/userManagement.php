<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermanagement extends MX_Controller{

	public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model('user_model');
        $this->load->model('customer/customer_model');
        $this->load->model('position_management_model');
        $this->load->library("form_validation");
    }

    public function index($q_encoded = 'x')
	{
        $this->user_model->set_filter($q_encoded);

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 5,
			'items'	=> array (
				'user_name' => array('text' => 'User Name'),
				'user_wizlearn_id' => array('text' => 'User ID'),
				'user_email' => array('text' => 'Email'),
				'credit_point' => array('text' => "Credit Point", "align" => "center"),
				'position_name' => array('text' => 'Position'),
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
		
		$this->page->view('user_index', array (
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'give_url' => $this->page->base_url("/give"),
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
		$userData 	= $this->session->userdata('user');
		$this->page->view('user_form', array (
			'action_url' => $this->page->base_url("/$action/$id"),
			'data' => $this->user_model->by_id($id),
			'id' => $id,
            'customer_name' => $this->user_model->get_customer(),
            'position' => $this->position_management_model->getByCustomer($userData->id),
		));
	}

	public function give() {
		$userData 	= $this->session->userdata('user');
		$this->page->view('give_form', array (
			'action_url' 	=> $this->page->base_url("/addCreditPoint/$userData->id"),
            'userData' 	 => $this->user_model->getByCustomer($userData->id),
		));
	}

	public function addCreditPoint($id) {
		$jumlah           = 0;
        $credit           = $this->customer_model->give_id($id);
        $row_array        = $credit->row_array();
        $customer_id      = $row_array['customer_id'];
        $credit           = $this->input->post('credit'); 

        foreach ($credit as $key => $value) {
        	$user_journals = array();
        	if ($value !== "0") {
        		$user_journals = array(
	                'credit_point'  => $value,
	                'user_id'       => $key
	            );

	            db_insert('user_journals', $user_journals);
            	$jumlah += (int) $value;
        	}
        }

        $customer_journals = array(
            'customer_id'   => $customer_id,
            'credit_point'  => -$jumlah
        );

        db_insert('customer_journals', $customer_journals);
        $this->session->set_flashdata('success', 'Data berhasil disimpan');
        redirect($this->page->base_url());
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
		$names = array('upper_user_name', 'user_password', 'user_group', 'user_email', 'user_wizlearn_id', 'customer_id', 'position');
		return form_data($names);
	}


	public function insert()
	{
		$userData 	= $this->session->userdata('user');
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|is_unique[users.user_name]');
		$this->form_validation->set_rules('user_wizlearn_id', 'User ID', 'trim|required|is_unique[users.user_wizlearn_id]');
		$this->form_validation->set_rules('position', 'User ID', 'trim|required');
		if ($this->form_validation->run() == FALSE){
			// $this->session->set_flashdata("error",validation_errors());
			// redirect("user/tambah");
			$this->form();
		}else{
			// masukkan ke tabel pengguna
			$data = $this->form_data();
	        $data['user_password'] = bjs_password($data['user_password']);
	        $data['customer_id'] = $userData->id;
	        $data['user_group'] = "customer";
			db_insert('users', $data);
			$user_id = $this->db->insert_id();
			$this->session->set_flashdata('success', 'Data berhasil dibuat');
			redirect($this->page->base_url());
		}
	}


	public function update($id)
	{
		$userData = $this->session->userdata('user');
		$data 	  = $this->form_data();
        $user     = $this->db->get_where('users', array('id' => $id))->row();
		
		if (($data['user_password']) != '') {
            $data['user_password'] = bjs_password($data['user_password']);
        }
		else {
			$data['user_password'] = $user->user_password;
		}
		$data['user_group'] = "customer";
		$data['customer_id'] = $userData->id;
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
