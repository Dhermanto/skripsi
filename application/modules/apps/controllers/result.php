<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends MX_Controller{

	

	public function __construct($value='')
	{
		parent::__construct();
		$this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model("result_model");
	}

	public function index($q_encoded = 'x')
	{
		$this->result_model->set_filter($q_encoded);

		$id         = $this->session->userdata('user')->id;
		$id_user    = $this->session->userdata('user')->user_id;

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 5,
			'items'	=> array (
                'course_title' 	  => array('text' => 'Course Title'),
                'category_name'   => array('text' => 'Category'),
                'enrolled_time'   => array('text' => 'Enrolled Time'),
                'completion_date' => array('text' => 'Completion Date'),
                'score' 		  => array('text' => 'Score'),
			),
			'num_rows' => $this->result_model->num_rows_result($id_user),
			'item' => 'course_title',
			'warning' => 'course_title',
			'sorting' => FALSE,
			'checkbox' => FALSE,
		));

		$this->grid->add_actions(array(
            'edit' => array('show' => false, 'title' => 'LMS Sync', 'icon' => 'refresh'),
            'delete' => array('show' => false, 'title' => 'LMS Sync', 'icon' => 'refresh'),
        ));

		$this->result_model->set_grid_params($this->grid->params());
		$this->grid->source($this->result_model->get_return($id_user));

		$this->page->view('dashboard-result', array (
			'addnew_url'   => $this->page->base_url("/tambah"),
			'excel_url'    => $this->page->base_url("/excel/".$q_encoded),
			'insert_url'   => $this->page->base_url("/insert"),
			'update_url'   => $this->page->base_url("/update"),
			'filter_url'   => $this->page->base_url("/filter"),
			'search_url'   => $this->page->base_url("/search"),
			'getdata_url'  => $this->page->base_url("/get"),
			'filter' 	   => $this->result_model->filter,
			'keyword' 	   => $this->result_model->keyword,
			'grid' 		   => $this->grid->draw(),   //data table
			'pagelink' 	   => $this->grid->page_link(), //data paging
		));
	}

	public function search()
	{
		$q_encoded = base64_encode(json_encode($this->input->post()));
		redirect($this->page->base_url("/index/$q_encoded"));
	}

	public function excel($q_encoded = 'x')
	{
		$this->result_model->set_filter($q_encoded);

		$id_user    = $this->session->userdata('user')->user_id;

		$data   = $this->db->get_where('customers', array('id' => $this->session->userdata('user')->id))->row();
		$credit = $this->db->query("SELECT *, IFNULL(SUM(credit_point), 0) AS credit FROM user_journals WHERE user_id = $id_user")->row();

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 5,
			'items'	=> array (
				// 'course_image' => array('text' => 'logo', 'func' => 'course_logo_thumbnail'),
                'course_title' => array('text' => 'Course Title'),
                'category_name' => array('text' => 'Category'),
                'enrolled_time' => array('text' => 'Enrolled Time'),
                'completion_date' => array('text' => 'Completion Date'),
                'score' 		=> array('text' => 'Score'),
                // 'course_wizlearn_id' => array('text' => 'LMS Course ID'),
                // 'course_opened_date' => array('text' => 'Opened Date'),
                // 'course_closed_date' => array('text' => 'Closed Date'),
                // 'credit_point' => array('text' => 'Credit point', 'align' => 'right'),
                // 'active_duration' => array('text' => 'Active Duration', 'align' => 'right'),
                // 'course_status' => array('text' => 'Status', 'func' => 'status_active'),
				// 'lms_sync' => array('text' => 'LMS Sync', 'align' => 'center', 'func' => 'sync_status'),
			),
			'num_rows' => $this->result_model->num_rows_result($id_user),
			'item' => 'course_title',
			'warning' => 'course_title',
			'sorting' => FALSE,
			'checkbox' => FALSE,
			'pagintaion' => false,
		));

		$this->grid->add_actions(array(
            'edit' => array('show' => false, 'title' => 'LMS Sync', 'icon' => 'refresh'),
            'delete' => array('show' => false, 'title' => 'LMS Sync', 'icon' => 'refresh'),
        ));

		$this->result_model->set_grid_params($this->grid->params());
		$this->grid->source($this->result_model->get_excel($id_user));


		$konten = $this->load->view('dashboard-result-excel', array (
			'nama'           => $this->session->userdata('user')->user_name,
            'logo'           => $data->customer_logo,
            'credit'         => $credit->credit,
			'addnew_url' => $this->page->base_url("/tambah"),
			'insert_url' => $this->page->base_url("/insert"),
			'update_url' => $this->page->base_url("/update"),
			'filter_url' => $this->page->base_url("/filter"),
			'search_url' => $this->page->base_url("/search"),
			'getdata_url' => $this->page->base_url("/get"),
			'filter' => $this->result_model->filter,
			'keyword' => $this->result_model->keyword,
			'grid' => $this->grid->draw(),   //data table
			'pagelink' => $this->grid->page_link(), //data paging
		),true);

		excel_header('course_result_'.date('YmdHis').'.xls');
		echo $konten;
	}
}
