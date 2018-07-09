<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminBankResult extends MX_Controller{

	public function __construct($value='')
	{
		parent::__construct();
		$this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model("user_model");
	}

	public function index($q_encoded = 'x')
	{
		$this->user_model->set_filter($q_encoded);

		$id         = $this->session->userdata('user')->id;
		$id_user    = $this->session->userdata('user')->user_id;

		$this->grid->init(array (
			'base_url' => $this->page->base_url("/index/$q_encoded"),
			'act_url' => $this->page->base_url(),
			'uri_segment' => 5,
			'items'	=> array (
                'user_name' 	  => array('text' => 'User Name'),
                'course_title'    => array('text' => 'Course Title'),
                'enrolled_time'   => array('text' => 'Enrolled Time'),
                'completion_date' => array('text' => 'Completion Date'),
                'position_name'   => array('text' => 'Position'),
                'answer_exam'     => array('text' => 'Exam Answer', 'func' => 'answer_exam', 'align' => 'center'),
                'user_course_id'  => array('text' => 'Score', 'func' => 'score', 'align' => 'center'),
			),
			'num_rows' => $this->user_model->getUserResultRow($id)->num_rows(),
			'item' => 'course_title',
			'warning' => 'course_title',
			'sorting' => FALSE,
			'checkbox' => FALSE,
		));

		$this->grid->add_actions(array(
            'edit' => array('show' => false, 'title' => 'LMS Sync', 'icon' => 'refresh'),
            'delete' => array('show' => false, 'title' => 'LMS Sync', 'icon' => 'refresh'),
        ));

		$this->user_model->set_grid_params($this->grid->params());
		$this->grid->source($this->user_model->getUserResult($id));

		$this->page->view('admin_result', array (
			'addnew_url'   => $this->page->base_url("/tambah"),
			'excel_url'    => $this->page->base_url("/excel/".$q_encoded),
			'insert_url'   => $this->page->base_url("/insert"),
			'update_url'   => $this->page->base_url("/update"),
			'filter_url'   => $this->page->base_url("/filter"),
			'search_url'   => $this->page->base_url("/search"),
			'getdata_url'  => $this->page->base_url("/get"),
			'filter' 	   => $this->user_model->filter,
			'keyword' 	   => $this->user_model->keyword,
			'grid' 		   => $this->grid->draw(),   //data table
			'pagelink' 	   => $this->grid->page_link(), //data paging
		));
	}

	public function search()
	{
		$q_encoded = base64_encode(json_encode($this->input->post()));
		redirect($this->page->base_url("/index/$q_encoded"));
	}

	public function giveScore() {
		$id    = $_POST['id'];
		$score = $_POST['score'];
		db_update('user_course', ['score' => $score], ['id' => $id]);  
	}
}
