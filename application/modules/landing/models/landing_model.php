<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Landing_model extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'content';
		$this->like = array('id_category');

		$this->filter = array (

		);

		$this->fields = (object) array (
			'id' => '',
			'id_category' => '',
			'content' => '',
		);
	}

	public function get_courses($offset = '')
	{
		$this->db->order_by("id","RANDOM");
		$this->db->limit($offset, 0);
		$this->db->where('deleted_at IS NULL');
		$this->db->where('course_category !=', '0');
		return $this->db->get("courses");
	}

	public function get_course($id)
	{
		// $this->db->order_by("id","RANDOM");
		// $this->db->limit($offset, 0);
		

		$sql = "	SELECT a.* , b.category_name
					FROM courses a 
					LEFT JOIN category b ON a.course_category = b.id
					WHERE a.deleted_at IS NULL
					AND a.id = {$id}
					";

		
		return $this->db->query($sql);
	}

	public function get_categories($offset = 6)
	{
		// $this->db->order_by("id","RANDOM");
		$this->db->limit($offset, 0);
		$this->db->where('deleted_at IS NULL');
		return $this->db->get("category");
	}

	public function get()
	{
		$main_table = $this->table;
		$this->filter();

		$this->db->select("$main_table.*, category_name");
		$this->db->join('category AS c', "c.id = $main_table.id_category");
		$this->db->where('c.deleted_at is NULL');
		$this->db->where("$main_table.deleted_at is NULL");
		return $this->db->get("$main_table");
	}
}
