<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends MX_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model("landing_model");
		$this->page->template('landing_tpl');
	}


	public function index()
	{
		$count = $this->db->query("SELECT count(*) AS total FROM courses WHERE deleted_at is NULL")->row();
		$total = $count->total;

		if ($total < 12) {
			$total = $total;
		}
		else {
			$total = 12;
		}

		$this->page->view("landing_index",array(
			"courses" => $this->landing_model->get_courses($total)->result_array(),
			"category" => $this->landing_model->get_categories()->result_array(),
		));
	}

	public function course($id)
	{
		$this->page->view("landing_course",array(
			"course" => $this->landing_model->get_course($id)->row(),
		));	
	}

	public function content($id)
	{
		$this->page->view("content", array(
			'v' => $this->db->get_where("category", "id = $id")->row(),
		));
	}

	// public function content($q_encoded = 'x')
	// {
	// 	$this->landing_model->set_filter($q_encoded);
	// 	$this->page->template('app_tpl');

	// 	$this->grid->init(array (
	// 		'base_url' => $this->page->base_url("/content/$q_encoded"),
	// 		'act_url' => $this->page->base_url(),
	// 		'uri_segment' => 4,
	// 		'items'	=> array (
	// 			'category_name' => array('text' => 'Category'),
	// 			'content' => array('text' => 'Content', 'func' => 'content'),
	// 		),
	// 		'num_rows' => $this->landing_model->num_rows(),
	// 		'item' => 'id_category',
	// 		'warning' => 'id_category',
	// 		// 'sorting' => FALSE,
	// 		'checkbox' => FALSE,
	// 	));

	// 	$this->landing_model->set_grid_params($this->grid->params());
	// 	$this->grid->source($this->landing_model->get());
		
	// 	$this->page->view("landing_content", array (
	// 		'addnew_url' => $this->page->base_url("/tambah"),
	// 		'insert_url' => $this->page->base_url("/insert"),
	// 		'update_url' => $this->page->base_url("/update"),
	// 		'filter_url' => $this->page->base_url("/filter"),
	// 		'search_url' => $this->page->base_url("/search"),
	// 		'getdata_url' => $this->page->base_url("/get"),
	// 		'filter' => $this->landing_model->filter,
	// 		'keyword' => $this->landing_model->keyword,
	// 		'grid' => $this->grid->draw(),   //data table
	// 		'pagelink' => $this->grid->page_link(), //data paging
	// 	));
	// }

	// public function filter()
 //    {
 //        $q_encoded = base64_encode(json_encode($this->input->post()));
	// 	redirect($this->page->base_url("/index/$q_encoded"));
 //    }

 //    public function search()
	// {
	// 	$q_encoded = base64_encode(json_encode($this->input->post()));
	// 	redirect($this->page->base_url("/index/$q_encoded"));
	// }


	// public function form($action = 'insert', $id = '')
	// {
	// 	$this->page->template('app_tpl');
	// 	$this->page->view('landing_form', array (
	// 		'action_url' => $this->page->base_url("/$action/$id"),
	// 		'data' => $this->landing_model->by_id($id),
	// 		'id' => $id,
	// 	));
	// }


	// public function tambah()
	// {
	// 	$this->form();
	// }


	// public function edit($id)
	// {
	// 	$this->form('update', $id);
	// }


	// public function form_data()
	// {
	// 	$names = array('id_category', 'content');
	// 	return form_data($names);
	// }

	// public function insert()
	// {
	// 	$this->page->template('app_tpl');
 //        $data = $this->form_data();

 //        db_insert('content', $data);
	// 	redirect(base_url() . "landing/content");
 //    }

 //    public function update($id)
	// {
	// 	$this->page->template('app_tpl');
	// 	$data = $this->form_data();

	// 	db_update('content', $data, array('id' => $id));
	// 	redirect(base_url() . "landing/content");
	// }


	// public function delete($id)
	// {
	// 	db_delete('content', array('id' => $id));
	// 	redirect($this->agent->referrer());
	// }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
