<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';
		$this->like = array('user_name', 'user_wizlearn_id', 'user_email');
		$this->filter = array (
		);

		$this->fields = (object) array (
			'id'			 	=> '',
			'user_name' 	 	=> '',
			'user_email' 	 	=> '',
			'user_wizlearn_id'  => '',
			'credit_point'  => '',
		);
	}

	public function get()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, c.customer_name");
		$this->db->join("customers AS c", "$main_table.customer_id = c.id", 'left');
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function getById($idBank)
	{
		$main_table = $this->table;
		$this->filter();

		$sql = "SELECT u.id, user_name, u.id AS user_id, u.user_wizlearn_id, u.user_email, c.customer_name, SUM(user_journals.credit_point) AS credit_point, c.id AS customer_id
		FROM user_journals
		LEFT JOIN users AS u ON user_journals.user_id = u.id
		LEFT JOIN customers AS c ON c.id = u.customer_id
		WHERE c.id = $idBank 
		AND u.deleted_at IS NULL 
		AND (".$this->sql_like.")
		AND u.user_group = 'customer' GROUP BY u.id ORDER BY $this->order LIMIT $this->limit OFFSET $this->offset";
		return $this->db->query($sql);
	}

	public function by_id($id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, c.customer_name");
		$this->db->join('customers AS c', "$main_table.customer_id = c.id", 'left');
		$src = $this->db->get_where($this->table, array("$main_table.id" => $id));
		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}


	public function get_customer()
	{
		return $this->db->get_where('customers', 'deleted_by is null')->result();
	}
}
