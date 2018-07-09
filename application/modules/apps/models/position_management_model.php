<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Position_management_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'user_position';
		$this->like = array('position_name');
		$this->filter = array (

		);

		$this->fields = (object) array (
			'id' => '',
			'position_name' => '',
		);
	}


	public function get()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->where('deleted_at is null');
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function getByCustomer($id)
	{
		$main_table = $this->table;
		$this->db->where('deleted_at is null');
		$this->db->where('customer_id', $id);
		return $this->db->get($main_table);
	}

	public function byId($id)
	{
		$main_table = $this->table;
		$this->db->join("user_position_detail AS upd", "$main_table.id = upd.user_position_id", 'inner');
		$this->db->where("$main_table.deleted_at is null");
		$this->db->where("$main_table.id", $id);
		return $this->db->get($main_table)->result();
	}
}
