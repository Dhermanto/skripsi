<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Site extends MX_Controller {	public function __construct()	{		parent::__construct();
		$this->page->template('frontend_login');	}	public function index()	{		$this->page->view();	}	public function customer()	{		if($this->session->userdata('user')) {			redirect(site_url('/apps/index'));		}		$slug = $this->uri->segment(1);		$logo = $this->db->get_where("customers", array('LOWER(customer_slug)' => strtolower($slug)))->row_array();		$data = $this->db->get_where("customers", array('LOWER(customer_slug)' => strtolower($slug)));		if ($data->num_rows() > 0) {				$this->page->view(NULL, array (				'data' => $logo,				'login_url' => site_url('/apps/login_apps/login'),				'resetpwd_url' => site_url('/apps/login_apps/resetpwd'),				'user' => $logo['id'],				'customer_name' => strtoupper($logo['customer_name']),			));		}		else {			show_404();		}	}	public function error()    {        $this->load->view('frontend_login');    }}/* End of file site.php *//* Location: ./application/controllers/site.php */