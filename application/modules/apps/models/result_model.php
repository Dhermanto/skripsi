<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'courses';
		$this->like = array('course_title', 'course_opened_date', 'course_closed_date', 'course_status', 'category_name');
		$this->filter = array (
			'id' => '',
		);

		$this->fields = (object) array (
			'id' => '',
			'course_title' => '',
			'course_description' => '',
			'course_opened_date' => date('Y-m-d'),
			'course_closed_date' => date('Y-m-d', strtotime('+30 days')),
			'course_status' => '',
			'course_prerequisit' => '',
			'course_demo' => '',
			'course_wizlearn_id' => '',
			'credit_point' => '',
			'active_duration' => 30,
			'course_category' => '',
			'course_image' => '',
			'completion_date' => date('Y-m-d'),
		);
	}


	public function get_return($user_id)
	{
		$main_table = $this->table;
		$this->filter();

		$this->db->select("$main_table.*, $main_table.id AS id, c.category_name,uc.*");
		$this->db->join("user_course AS uc", "$main_table.id = uc.course_id", 'inner');
		$this->db->join("category as c", "$main_table.course_category = c.id");
		$this->db->where("uc.user_id",$user_id);
		$this->db->order_by("$main_table.course_title");

		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function get_excel($user_id)
	{
		$main_table = $this->table;
		$this->filter();

		$this->db->select("$main_table.*, $main_table.id AS id, c.category_name,uc.*");
		$this->db->join("user_course AS uc", "$main_table.id = uc.course_id", 'inner');
		$this->db->join("category as c", "$main_table.course_category = c.id");
		$this->db->where("uc.user_id",$user_id);
		$this->db->order_by("$main_table.course_title");

		// $this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}



	public function by_id($id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, $main_table.id AS id,uc.*");
		$this->db->join("user_course AS uc", "$main_table.id = uc.course_id", 'inner');
		$this->db->join("category AS c", "$main_table.course_category = c.id", 'left');
		// $this->db->where("uc.user_id",$user_id);
		$this->db->group_by("c.id");
		$src = $this->db->get_where($this->table, array("$main_table.id" => $id));


		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}

	public function num_rows_result($user_id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, $main_table.id AS id, c.category_name,uc.*");
		$this->db->join("user_course AS uc", "$main_table.id = uc.course_id", 'inner');
		$this->db->join("category as c", "$main_table.course_category = c.id");
		$this->db->where("uc.user_id",$user_id);
		$this->db->order_by("$main_table.course_title");
		return $this->db->count_all_results($this->table);
	}
}
