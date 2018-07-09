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
			'customer_id'  		=> '',
			'customer_name' 	=> '',
		);
	}

	public function get()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, c.customer_name");
		$this->db->join("customers AS c", "$main_table.customer_id = c.id", 'left');
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("($main_table.user_group = 'admin' OR $main_table.user_group = 'admin_bank')");
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function count()
	{
		$main_table = $this->table;
		$this->db->select("$main_table.*");
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("$main_table.user_group", "admin");
		$this->db->or_where("$main_table.user_group", "admin_group");
		return $this->db->get("$main_table")->num_rows();
	}

	public function by_id($id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, c.customer_name");
		$this->db->join("customers AS c", "$main_table.customer_id = c.id", 'left');
		$src = $this->db->get_where($this->table, array("$main_table.id" => $id));
		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}


	public function get_customer()
	{
		return $this->db->get_where('customers', 'deleted_by is null')->result();
	}
}
