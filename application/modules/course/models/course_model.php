<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'courses';
		$this->like = array('course_title', 'course_opened_date', 'course_closed_date', 'course_status');
		$this->filter = array (
			'id' => '',
		);

		$this->fields = (object) array (
			'id' => '',
			'course_title' => '',
			'course_description' => '',
			'course_opened_date' => date('Y-m-d'),
			'course_closed_date' => date('Y-m-d', strtotime('+360 days')),
			'course_status' => '',
			'course_prerequisit' => '',
			'course_demo' => '',
			'course_wizlearn_id' => '',
			'credit_point' => '',
			'active_duration' => 30,
			'course_category' => '',
			'course_image' => '',
		);
	}


	public function get()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, $main_table.id AS id, c.category_name");
		$this->db->join("category as c", "$main_table.course_category = c.id");
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function count()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, $main_table.id AS id, c.category_name");
		$this->db->join("category as c", "$main_table.course_category = c.id");
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		return $this->db->get($main_table);
	}


	public function by_id($id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, $main_table.id AS id");
		$this->db->join("category AS c", "$main_table.course_category = c.id", 'left');
		$this->db->group_by("c.id");
		$src = $this->db->get_where($this->table, array("$main_table.id" => $id));


		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}

	public function byCategory($id) {
		$main_table = $this->table;
		$this->db->select("$main_table.*, $main_table.id AS id, c.category_name");
		$this->db->join("category as c", "$main_table.course_category = c.id");
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		$this->db->where("c.id", $id);
		return $this->db->get($main_table);
	}
}
