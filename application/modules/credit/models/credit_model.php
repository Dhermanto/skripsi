<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credit_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'customer_credits';
		$this->like = array('credit_point', 'trx_no', 'trx_date', 'credit_exp_date');

		$this->fields = (object) array (
			'id' => '',
			'customer_id',
			'credit' => '',
			'customer_name' => '',
			'credit_point' => '',
			'credit_exp_date' => date('Y-m-d', strtotime('+360 days')),
			'trx_no' => '',
			'trx_date' => date('Y-m-d'),
			'remarks' => ''
		);

		$this->filter = array (
			'id'	=> '',
		);
	}

	public function get()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, c.customer_name AS customer_name");
		$this->db->join("customers AS c", "$main_table.customer_id = c.id", 'left');
		$this->db->where("$main_table.deleted_by is null");
		$this->db->where("c.deleted_by is null");
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function by_id($id)
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->select("$main_table.*, c.customer_name, SUM(credit_point) AS credit");
		$this->db->join("customers AS c", "$main_table.customer_id = c.id", 'left');
		$this->db->group_by("$main_table.customer_id");
		$src = $this->db->get_where($this->table, array("$main_table.id" => $id));
		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}

	public function get_customer()
	{
		$this->db->select("id, customer_name")->order_by("customer_name");
		return $this->db->get_where('customers', 'deleted_at is null')->result();
	}

	public function get_id($id)
	{
		$data 	= $this->db->get_where('customers', array('id' => $id));
		return $data;
	}
}
