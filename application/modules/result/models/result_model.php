<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'user_course';

		// $this->like = array('course_title', 'course_opened_date', 'course_closed_date', 'course_status');
		$this->like = array('user_name');
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


	public function get()
	{
		$main_table = $this->table;
		$target_table = "user_course";
		$this->filter($target_table);

		$this->db->select("	$target_table.id as main_id,
							c.category_name,
							b.course_title,
							cu.customer_name,
							u.user_name,
							$target_table.completion_date,
							$target_table.*,
							b.*,
							c.*,
							cu.*,
							u.*
							");
		$this->db->join("courses AS b", "b.id = $target_table.course_id", 'inner');
		$this->db->join("category AS c", "b.course_category = c.id", 'left');
		$this->db->join("users AS u", "$target_table.user_id = u.id", 'inner');
		$this->db->join("customers AS cu", "cu.id = u.customer_id", 'left');
		$this->db->where("$target_table.deleted_by is null");
		$this->db->where("b.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		$this->db->where("cu.deleted_by is null");
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);

		return $this->db->get($target_table);
	}

	public function count()
	{
		$main_table = $this->table;
		$target_table = "user_course";
		$this->filter($target_table);

		$this->db->select("	$target_table.id as main_id,
							c.category_name,
							b.course_title,
							cu.customer_name,
							u.user_name,
							$target_table.completion_date,
							$target_table.*,
							b.*,
							c.*,
							cu.*,
							u.*
							");
		$this->db->join("courses AS b", "b.id = $target_table.course_id", 'inner');
		$this->db->join("category AS c", "b.course_category = c.id", 'left');
		$this->db->join("users AS u", "$target_table.user_id = u.id", 'inner');
		$this->db->join("customers AS cu", "cu.id = u.customer_id", 'left');
		$this->db->where("$target_table.deleted_by is null");
		$this->db->where("b.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		$this->db->where("cu.deleted_by is null");
		// $this->db->order_by($this->order);
		// $this->db->limit($this->limit, $this->offset);

		return $this->db->get($target_table);
	}


	public function get_excel()
	{
		$main_table = $this->table;
		$target_table = "user_course";
		$this->filter($target_table);

		$this->db->select("	$target_table.id as main_id,
							c.category_name,
							b.course_title,
							cu.customer_name,
							u.user_name,
							$target_table.completion_date,
							$target_table.scorm_score,
							$target_table.*,
							b.*,
							c.*,
							cu.*,
							u.*
							");
		$this->db->join("courses AS b", "b.id = $target_table.course_id", 'inner');
		$this->db->join("category AS c", "b.course_category = c.id", 'left');
		$this->db->join("users AS u", "$target_table.user_id = u.id", 'inner');
		$this->db->join("customers AS cu", "cu.id = u.customer_id", 'left');
		
		$this->db->order_by("cu.customer_name");
		// $this->db->limit($this->limit, $this->offset);	

		return $this->db->get($target_table);
	}


	public function by_id($id)
	{
		$main_table = $this->table;
		$target_table = "user_course";
		$this->filter($target_table);
		$this->db->select("	$target_table.id as main_id,
							c.category_name,
							b.course_title,
							cu.customer_name,
							u.user_name,
							$target_table.completion_date,
							$target_table.scorm_score");
		$this->db->join("courses AS b", "b.id = $target_table.course_id", 'inner');
		$this->db->join("category AS c", "b.course_category = c.id", 'left');
		$this->db->join("users AS u", "$target_table.user_id = u.id", 'inner');
		$this->db->join("customers AS cu", "cu.id = u.customer_id", 'left');
		
		$this->db->order_by("cu.customer_name");

		$this->db->where("uc.user_id",$user_id);
		// $this->db->group_by("c.id");
		$src = $this->db->get_where($target_table, array("$target_table.id" => $id));


		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}

	public function num_rows()
	{
		$main_table = $this->table;
		$target_table = $this->table;
		$this->filter();
		$this->db->select("	$target_table.id as main_id,
							c.category_name,
							b.course_title,
							cu.customer_name,
							u.user_name,
							$target_table.completion_date,
							$target_table.scorm_score,
							$target_table.*,
							b.*,
							c.*,
							cu.*,
							u.*
							");
		$this->db->join("courses AS b", "b.id = $target_table.course_id", 'inner');
		$this->db->join("category AS c", "b.course_category = c.id", 'left');
		$this->db->join("users AS u", "$target_table.user_id = u.id", 'inner');
		$this->db->join("customers AS cu", "cu.id = u.customer_id", 'left');
		$this->db->where("$target_table.deleted_by is null");
		$this->db->order_by("cu.customer_name");

		return $this->db->count_all_results($this->table);
	}
}
