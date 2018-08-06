<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
		$this->like = array('user_name', 'user_group');
		$this->filter = array (
			'id'	=> '',
		);

		$this->fields = (object) array (
			'id'			 	=> '',
			'user_name' 	 	=> '',
			'user_password'  	=> '',
			'user_email' 	 	=> '',
			'user_group'     	=> '',
			'user_wizlearn_id'  => '',
		);
	}

	public function get()
	{
		$this->like = array('user_name', 'user_group', 'position_name');
		$userData 	= $this->session->userdata('user');
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, position_name, SUM(credit_point) AS credit_point", FALSE);
		$this->db->where("$main_table.deleted_at is null");
		$this->db->where("$main_table.user_group", "customer");
		$this->db->where("$main_table.customer_id", $userData->id);
		$this->db->join("user_journals as uj", "$main_table.id = uj.user_id", "LEFT");
		$this->db->join("user_position as up", "$main_table.position = up.id", "LEFT");
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		$this->db->group_by("$main_table.id");
		return $this->db->get($main_table);
	}

	public function count()
	{
		$userData 	= $this->session->userdata('user');
		$main_table = $this->table;
		$this->db->select("$main_table.*");
		$this->db->where("$main_table.deleted_at is null");
		$this->db->where("$main_table.user_group", "customer");
		$this->db->join("user_journals as uj", "$main_table.id = uj.user_id");
		$this->db->join("user_position as up", "$main_table.position = up.id", "LEFT");
		$this->db->where("$main_table.customer_id", $userData->id);
		$this->db->group_by("$main_table.id");
		return $this->db->get("$main_table")->num_rows();
	}

	public function by_id($id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*");
		$src = $this->db->get_where($this->table, array("$main_table.id" => $id));
		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}


	public function get_customer()
	{
		return $this->db->get_where('customers', 'deleted_at is null')->result();
	}

	public function getByCustomer($customerId) {
		$main_table = $this->table;
		$this->db->select("$main_table.*, SUM(credit_point) AS credit_point", FALSE);
		$this->db->join("user_journals as uj", "$main_table.id = uj.user_id", "LEFT");
		$this->db->where("customer_id", $customerId);
		$this->db->where("$main_table.deleted_at is null");
		$this->db->where("user_group", "customer");
		$this->db->order_by("user_name", "asc");
		$this->db->group_by("$main_table.id");
		return $this->db->get("$main_table")->result();	
	}

	public function getUserResult($id) {
		$this->like = array('user_name', 'user_group', 'position_name', 'course_title');
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, uc.score, uc.id as user_course_id, answer_exam, course_title, enrolled_time, completion_date, position_name");
		$this->db->join("user_course AS uc", "$main_table.id = uc.user_id");
		$this->db->join("courses AS c", "c.id = uc.course_id");
		$this->db->join("user_position AS up", "up.id = $main_table.position");
		$this->db->where("$main_table.customer_id", $id);
		$this->db->where("$main_table.deleted_at is null");
		$this->db->where("user_group", "customer");
		$this->db->order_by("user_name", "asc");
		$this->db->group_by(array("uc.id", "$main_table.id", "up.id"));
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get("$main_table");
	}

	public function getUserResultRow($id) {
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, uc.id as user_course_id, answer_exam, course_title, enrolled_time, completion_date, position_name");
		$this->db->join("user_course AS uc", "$main_table.id = uc.user_id");
		$this->db->join("courses AS c", "c.id = uc.course_id");
		$this->db->join("user_position AS up", "up.id = $main_table.position");
		$this->db->where("$main_table.customer_id", $id);
		$this->db->where("$main_table.deleted_at is null");
		$this->db->where("user_group", "customer");
		$this->db->order_by("user_name", "asc");
		$this->db->group_by(array("uc.id", "$main_table.id", "up.id"));
		return $this->db->get("$main_table");
	}
}
