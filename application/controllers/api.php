<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MX_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		
		$this->key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
		$this->iv	= 'ABC123DEF456HIJ7';
	}
	
	
	private function check_date_format($date)
	{
		$date_arr = explode('/', $date);
		
		if (count($date_arr) != 3) return FALSE;
		if (strlen($date_arr[0]) != 2 OR strlen($date_arr[1]) != 2 OR strlen($date_arr[2]) != 4) return FALSE;
		if ( ! (intval($date_arr[0]) >= 1 && intval($date_arr[0] <= 31))) return FALSE;
		if ( ! (intval($date_arr[1]) >= 1 && intval($date_arr[1] <= 12))) return FALSE;
		
		return TRUE;
	}
	
	
	public function v2($method = 'insertResult')
	{
		# cek method
		if ($method != 'insertResult') {
			header('HTTP/1.1 404 Page Not Found.', TRUE);
		}
		
		# ambil data
		// $key = $this->input->post('key');
		$userid = $this->input->post('userid');
		$courseid = $this->input->post('courseid');
		$completedate = $this->input->post('completedate');
		$scormscore = $this->input->post('scormscore');
		$requestdate = $this->input->post('requestdate');
		
		// $result = print_r($_POST, TRUE);
		// file_put_contents('./request_'.@date('YmdHis').'.txt', $result);
		
		# cek user id
		$is_user_exist = FALSE;
		
		if ($userid != '') {
			$src = $this->db->get_where('users', "user_wizlearn_id = '{$userid}'");
			$is_user_exist = ($src->num_rows() > 0);
		}
		
		# cek course id
		$is_course_exist = FALSE;
		
		if ($courseid != '') {
			$src = $this->db->get_where('courses', "course_wizlearn_id = '{$courseid}'");
			$is_course_exist = ($src->num_rows() > 0);
		}
		
		# error 700
		// if ($key != $this->key) {
			// header('HTTP/1.1 700 Invalid key.', TRUE);
		// }
		
		# error 701
		if (
			$userid == ''
			OR $courseid == ''
			OR $completedate == ''
			OR $scormscore == ''
			OR $requestdate == ''
		) {
			header('HTTP/1.1 701 Invalid parameter length, parameter length is incorrect what expected for current API.', TRUE);
		}
		
		# error 702
		else if (substr($requestdate, 0, 8) != gmdate('dmY')) {
			header('HTTP/1.1 702 Invalid parameter request date, request date parameter is not equal with current date.', TRUE);
		}
		
		# error 711
		else if ( ! $is_user_exist) {
			header('HTTP/1.1 711 Invalid User ID parameter, User ID does not exist.', TRUE);
		}
		
		# error 721
		else if ( ! $is_course_exist) {
			header('HTTP/1.1 721 Invalid Course ID parameter, Course ID does not exist.', TRUE);
		}
		
		# error 731
		else if ( ! $this->check_date_format($completedate)) {
			header('HTTP/1.1 731 Invalid Complete Date parameter, date format should be dd/mm/yyyy.', TRUE);
		}
		
		# error 741
		else if ( ! (is_numeric($scormscore) OR $scormscore == '-')) {
			header('HTTP/1.1 741 Invalid SCORM Score parameter, SCORM Score should be numeric or "-" character.', TRUE);
		}
		
		# success!
		else {
			// $source_date = DateTime::createFromFormat('d/m/Y', $completedate);
			// $completedate = $source_date->format('Y-m-d');
			
			$data = array (
				'updated_score_time' => @date('Y-m-d H:i:s'),
				'completion_date' => $completedate,
				'scorm_score' => $scormscore == '-' ? -1 : $scormscore,
			);
			
			$where = array (
				'user_wizlearn_id' => $userid,
				'course_wizlearn_id' => $courseid,
			);
			
			$this->db->update('user_course', $data, $where);
			header('HTTP/1.1 200 Insert is successful.', TRUE);
		}
	}
	
	
	public function insertResult()
	{
		# get params
		$param = $this->input->post('param');
		$decoded = base64_decode($param);
		$message = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $decoded, MCRYPT_MODE_CBC, $this->iv), "\x00..\x10");
		
		# parse message
		parse_str($message, $params);
		
		# cek user id
		$is_user_exist = FALSE;
		
		if (isset($params['userid'])) {
			$userid = $params['userid'];
			$src = $this->db->get_where('users', "user_wizlearn_id = '{$userid}'");
			$is_user_exist = ($src->num_rows() > 0);
		}
		
		# cek course id
		$is_course_exist = FALSE;
		
		if (isset($params['courseid'])) {
			$courseid = $params['courseid'];
			$src = $this->db->get_where('courses', "course_wizlearn_id = '{$courseid}'");
			$is_course_exist = ($src->num_rows() > 0);
		}
		
		# error 700
		if ( ! $message OR ! mb_detect_encoding($message)) {
			header('HTTP/1.1 700 Invalid parameter, parameter cannot be decrypted.', TRUE);
		}
		
		# error 701
		else if (
			! isset($params['userid'])
			OR ! isset($params['courseid'])
			OR ! isset($params['completedate'])
			OR ! isset($params['scormscore'])
			OR ! isset($params['requestdate'])
		) {
			header('HTTP/1.1 701 Invalid parameter length, parameter length is incorrect what expected for current API.', TRUE);
		}
		
		# error 702
		else if (substr($params['requestdate'], 0, 8) != gmdate('dmY')) {
			header('HTTP/1.1 702 Invalid parameter request date, request date parameter is not equal with current date.', TRUE);
		}
		
		# error 711
		else if ($params['userid'] == '') {
			header('HTTP/1.1 711 Invalid User ID parameter, User ID cannot be null.', TRUE);
		}
		
		# error 712
		else if ( ! $is_user_exist) {
			header('HTTP/1.1 712 Invalid User ID parameter, User ID does not exist.', TRUE);
		}
		
		# error 721
		else if ($params['courseid'] == '') {
			header('HTTP/1.1 721 Invalid Course ID parameter, Course ID cannot be null.', TRUE);
		}
		
		# error 722
		else if ( ! $is_course_exist) {
			header('HTTP/1.1 722 Invalid Course ID parameter, Course ID does not exist.', TRUE);
		}
		
		# error 731
		else if ($params['completedate'] == '') {
			header('HTTP/1.1 731 Invalid Complete Date parameter, Complete Date cannot be null.', TRUE);
		}
		
		# error 732
		else if ( ! $this->check_date_format($params['completedate'])) {
			header('HTTP/1.1 732 Invalid Complete Date parameter, date format should be dd/mm/yyyy.', TRUE);
		}
		
		# error 741
		else if (strval($params['scormscore']) == '') {
			header('HTTP/1.1 741 Invalid SCORM Score parameter, SCORM Score cannot be null.', TRUE);
		}
		
		# error 742
		else if ( ! (is_numeric($params['scormscore']) OR $params['scormscore'] == '-')) {
			header('HTTP/1.1 742 Invalid SCORM Score parameter, SCORM Score should be numeric or "-" character.', TRUE);
		}
		
		# success!
		else {
			$source_date = DateTime::createFromFormat('d/m/Y', $params['completedate']);
			$completedate = $source_date->format('Y-m-d');
			
			$data = array (
				'completion_date' => $completedate,
				'scorm_score' => $params['scormscore'],
			);
			
			$where = array (
				'user_wizlearn_id' => $params['userid'],
				'course_wizlearn_id' => $params['courseid'],
			);
			
			$this->db->update('user_course', $data, $where);
			header('HTTP/1.1 200 Insert is successful.', TRUE);
		}
	}
	
	
	public function updateWizlearnCourseID()
	{
		# get params
		$param = $this->input->post('param');
		$decoded = base64_decode($param);
		$message = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $decoded, MCRYPT_MODE_CBC, $this->iv), "\x00..\x10");
		
		# parse message
		parse_str($message, $params);
		
		# cek iim course id
		$is_course_exist = FALSE;
		
		if (isset($params['iimcourseid'])) {
			$iimcourseid = $params['iimcourseid'];
			$src = $this->db->get_where('courses', "id = '{$iimcourseid}'");
			$is_course_exist = ($src->num_rows() > 0);
		}
		
		# error 700
		if ( ! $message OR ! mb_detect_encoding($message)) {
			header('HTTP/1.1 700 Invalid parameter, parameter cannot be decrypted.', TRUE);
		}
		
		# error 701
		else if (
			! isset($params['iimcourseid'])
			OR ! isset($params['courseid'])
			OR ! isset($params['coursetitle'])
			OR ! isset($params['requestdate'])
		) {
			header('HTTP/1.1 701 Invalid parameter length, parameter length is incorrect what expected for current API.', TRUE);
		}
		
		# error 702
		else if (substr($params['requestdate'], 0, 8) != gmdate('dmY')) {
			header('HTTP/1.1 702 Invalid parameter request date, request date parameter is not equal with current date.', TRUE);
		}
		
		# error 711
		else if ( ! $is_course_exist) {
			header('HTTP/1.1 711 Invalid IIM Course ID parameter, IIM Course ID does not exist.', TRUE);
		}
		
		# error 712
		else if ($params['courseid'] == '') {
			header('HTTP/1.1 712 Invalid Course ID parameter, Course ID cannot be null.', TRUE);
		}
		
		# error 713
		else if ($params['coursetitle'] == '') {
			header('HTTP/1.1 713 Invalid Course Title parameter, Course Title cannot be null.', TRUE);
		}
		
		# success!
		else {
			$data = array (
				'course_wizlearn_id' => $params['courseid'],
			);
			
			$where = array (
				'id' => $params['iimcourseid'],
			);
			
			$this->db->update('courses', $data, $where);
			header('HTTP/1.1 200 Insert is successful.', TRUE);
		}
	}
	
	
	public function test()
	{
		$this->load->view('api_test');
	}
	
	
	public function v2test()
	{
		$this->load->view('api_v2test');
	}
	
	
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
