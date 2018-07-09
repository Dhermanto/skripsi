<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'category';
		$this->like = array('category_name', 'content');
		$this->filter = array (

		);

		$this->fields = (object) array (
			'id' => '',
			'category_name' => '',
			'content' => ''
		);
	}


	public function get()
	{
		$main_table = $this->table;
		$this->filter();
		$this->db->where('deleted_by is null');
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($main_table);
	}

	public function getAll()
	{
		$main_table = $this->table;
		$this->db->where('deleted_by is null');
		return $this->db->get($main_table);
	}

	public function byId($id)
	{
		$main_table = $this->table;
		$this->db->where('deleted_by is null');
		$this->db->where('id', $id);
		return $this->db->get($main_table)->row();
	}
}
