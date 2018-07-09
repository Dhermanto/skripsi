<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'customers';

		$this->fields = (object) array (
			'id' => NULL,
			'user_name' => NULL,
			'user_password' => NULL,
			'customer_logo' => NULL,
			'customer_slug' => NULL,
		);
	}

	public function info($id)
	{
		$this->db->select('a.*, b.user_name AS user_name, b.user_password');
		$this->db->join('users AS b', 'a.id = b.user_id');
		$this->db->where("a.id = '$id'");
		return $this->db->get('customers AS a')->row();
	}

	public function get_catalog()
	{
		return $this->db->get_where('courses', 'deleted_by is null');
	}

	public function course_detail($course_id,$user_id)
	{
	    $sql = "SELECT
					b.enrollment_status,
					b.completion_date,
					b.id as user_course_id, 
					a.*
				FROM
					`courses` a
				LEFT JOIN 
					user_course b ON a.id =b.course_id AND b.user_id = {$user_id}
				where a.id = {$course_id}
				order by b.id desc
				";
	    return $this->db->query($sql);
	}
}
