<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'customers';
		$this->like = array('customer_name');

		$this->filter = array (

		);

		$this->fields = (object) array (
			'id' => '',
			'customer_name' => '',
			'customer_phone' => '',
			'customer_email' => '',
			'customer_website' => '',
			'customer_fax' => '',
			'customer_address' => '',
			'customer_logo' => '',
		);
	}

	public function get()
	{
		$order = $this->order;
		if ($order == "id desc") {
			$this->order = $this->table . ".id desc";
		}
		$main_table = $this->table;
		$this->filter();
		
		return $this->db->query("SELECT *, $main_table.id, IFNULL(SUM(credit_point), 0) AS credit_point, MAX(credit_exp_date) AS credit_exp_date FROM $main_table LEFT JOIN customer_journals AS cj ON cj.customer_id = $main_table.id WHERE $main_table.deleted_at IS NULL AND (".$this->sql_like.") GROUP BY $main_table.id ORDER BY $this->order LIMIT $this->limit OFFSET $this->offset");
	}

	public function give_id($id)
	{
		$sql = "SELECT c.id, user_name, u.id AS user_id, c.customer_name, SUM(customer_journals.credit_point) AS credit_point, c.id AS customer_id
		FROM customer_journals
		LEFT JOIN customers AS c ON customer_journals.customer_id = c.id
		LEFT JOIN users AS u ON customer_journals.customer_id = u.customer_id
		WHERE c.id = $id AND u.deleted_at IS NULL AND u.user_group = 'admin_bank' GROUP BY u.id ORDER BY user_name";
		return $this->db->query($sql);
	}
}
