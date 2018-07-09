<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Up_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'user_position_detail';

		$this->fields = (object) array (
		);
	}	

	public function getByPoisition($id) {
		$main_table = $this->table;
		$this->db->select("*");
		$this->db->where("user_position_id", $id);
		return $this->db->get($main_table);
	}

	public function getExamCustomer($id_course, $id) {
		//get exam
        $this->db->select('exam');
        $this->db->from('user_position');
        $this->db->join('user_position_detail', 'user_position_detail.user_position_id = user_position.id', 'left');
        $this->db->where('course_id', $id_course);
        $this->db->where('user_position.customer_id', $id);
        return $this->db->get()->row();
	}

	public function getExamByUser($courseId, $user_id) {
		//get exam
		$this->db->where('course_id', $courseId);
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc");
        $this->db->from("user_course");
        return $this->db->get()->row();
	}
}

