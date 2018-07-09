<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function bjs_password($raw_password)
{
	return strtoupper(md5('BJS-'.$raw_password.'-*123#'));
}

function user_session($field)
{
	$CI =& get_instance();
	$user = $CI->session->userdata('users');
	return empty($user) ? null : $user->$field;
}

function options($src, $id, $ref_val, $text_field)
{
	$options = '';
	foreach ($src->result() as $row) {
		$opt_value	= $row->$id;
		$text_value	= $row->$text_field;

		if ($row->$id == $ref_val) {
			$options .= '<option value="'.$opt_value.'" selected>'.$text_value.'</option>';
		}
		else {
			$options .= '<option value="'.$opt_value.'">'.$text_value.'</option>';
		}
	}
	echo $options;
	return $options;
}

function validate_form($names)
{
	$CI =& get_instance();

	foreach ($names as $name) {
		if ($CI->input->post($name) == '') {
			$CI->session->set_flashdata('form_status', 'invalid');
			redirect($CI->agent->referrer());
		}
	}
}

function form_data($names)
{
	$CI =& get_instance();

	foreach ($names as $name) {
		$words = explode('_', $name);
		$prefix = $words[0];

		if ($prefix == 'num') {
			$name = substr($name, 4);
			$data[$name] = str_replace(',', '', $CI->input->post($name));
		}
		else if ($prefix == 'upper') {
			$name = substr($name, 6);
			$data[$name] = strtoupper($CI->input->post($name));
		}
		else if ($prefix == 'tgl') {
			$tgl = $CI->input->post($name);
			$data[$name] = ($tgl == '') ? NULL : $tgl;
		}
		else {
			$data[$name] = $CI->input->post($name);
		}
	}

	return $data;
}

function date_id($date)
{
	if ($date == '') return '';
	$date_arr = explode('-', $date);
	return $date_arr[2].' '.get_month($date_arr[1]).' '.$date_arr[0];
}

function strip_dot($text)
{
	return str_replace('.', '', $text);
}

function strip_comma($text)
{
	return str_replace(',', '', $text);
}

function currency($number)
{
	return number_format($number, 0, '.', ',');
}

function db_insert($table, $data)
{
	$CI =& get_instance();
	// $data['created_by'] = user_session('id');
	if ($CI->session->userdata('pengguna') != '') {
		$data['created_by'] = $CI->session->userdata('pengguna')->id;
		return $CI->db->insert($table, $data);
	}
	else if ($CI->session->userdata('user') != '') {
		$data['created_by'] = $CI->session->userdata('user')->user_id;
		return $CI->db->insert($table, $data);
	}

}

function db_insert_batch($table, $data_arr)
{
	$CI =& get_instance();

	foreach ($data_arr as $key => $data) {
		// $data_arr[$key]['created_by'] = user_session('id');
		$data_arr[$key]['created_by'] = $CI->session->userdata('pengguna')->id;
	}

	return $CI->db->insert_batch($table, $data_arr);
}

function db_update($table, $data, $where)
{
	$CI =& get_instance();
	$data['updated_at'] = date('Y-m-d H:i:s');
	$data['updated_by'] = $CI->session->userdata('pengguna')->id;
	return $CI->db->update($table, $data, $where);
}

function db_delete($table, $where)
{
	$CI =& get_instance();
	$data['deleted_at'] = date('Y-m-d H:i:s');
	$data['deleted_by'] = $CI->session->userdata('pengguna')->id;
	return $CI->db->update($table, $data, $where);
}

function code_credit_point()
{
	$CI =& get_instance();
	$check = $CI->db->query("SELECT trx_no FROM customer_credits order by id DESC");
	if ($check->num_rows()>0)
	{
		$check = $check->row_array();
		$last_kode = $check['trx_no'];
		$ambil = substr($last_kode, 8, 4)+1;
		$new_code = "CR/" . date('Y') .  sprintf("/%04s", $ambil); //4 digit string dengan nilai increment
		return $new_code;
	}
	else
	{
		return "CR/" . date('Y') . "/0001";
	}
}

function array_push_assoc($array, $key, $value){
	$array[$key] = $value;
	return $array;
}

# status active

function status_active($status)
{
	return $status == '1' ? '<font color="ForestGreen">ACTIVE</font>' : '<font color="Crimson">INACTIVE</font>';
}

function padded_string($string)
{
	return str_pad($string, (16 * (floor(strlen($string) / 16) + 1)), chr(16 - (strlen($string) % 16)));
}

function aes256_encrypt($message)
{
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	$iv		= 'ABC123DEF456HIJ7';
	
	$chiper = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, padded_string($message), MCRYPT_MODE_CBC, $iv);
	return urlencode(base64_encode(base64_encode($chiper)));
}

function aes256_decrypt($message)
{
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	$iv		= 'ABC123DEF456HIJ7';
	
	$message = base64_decode(base64_decode(urldecode($message)));
	return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $message, MCRYPT_MODE_CBC, $iv), "\x00..\x10");
}

function LMS_CourseCatalogue($data)
{
	$url 	= 'http://uat.asknlearn.com/iim/Webservice/api/IIM/IIMWebService.asmx/IIM_LMS_Register_CourseCatalog';
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	
	$data['subjectname'] = 'General';
	$data['requestdate'] = gmdate('dmYhi');
	$param = urldecode(http_build_query($data, '', '&'));
	
	$key = urlencode(base64_encode($key));
	$param = aes256_encrypt($param);
	
	$api_url = "{$url}?key={$key}&param={$param}";
	$response = file_get_contents($api_url);
	$response_xml = simplexml_load_string($response);
	
	$response_str = aes256_decrypt($response_xml[0]);
	parse_str($response_str, $response_arr);
	
	return $response_arr;
}

function LMS_RegisterUser($data)
{
	$url 	= 'http://uat.asknlearn.com/iim/Webservice/api/IIM/IIMWebService.asmx/IIM_LMS_Register_User';
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	
	$data['groupid'] = 'IIM';
	$data['groupname'] = 'IIM';
	$data['requestdate'] = gmdate('dmYhi');
	$param = urldecode(http_build_query($data, '', '&'));
	
	$key = urlencode(base64_encode($key));
	$param = aes256_encrypt($param);
	
	$api_url = "{$url}?key={$key}&param={$param}";
	$response = file_get_contents($api_url);
	$response_xml = simplexml_load_string($response);
	
	return $response_xml[0];
}

function LMS_SyncPassword($data)
{
	$url 	= 'http://uat.asknlearn.com/iim/Webservice/api/IIM/IIMWebService.asmx/IIM_LMS_SyncPassword';
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	
	$data['requestdate'] = gmdate('dmYhi');
	$param = urldecode(http_build_query($data, '', '&'));
	
	$key = urlencode(base64_encode($key));
	$param = aes256_encrypt($param);
	
	$api_url = "{$url}?key={$key}&param={$param}";
	$response = file_get_contents($api_url);
	$response_xml = simplexml_load_string($response);
	
	return $response_xml[0];
}

function LMS_AssignCourse($data)
{
	$url 	= 'http://uat.asknlearn.com/iim/Webservice/api/IIM/IIMWebService.asmx/IIM_LMS_Assign_Course';
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	
	$data['requestdate'] = gmdate('dmYhi');
	$param = urldecode(http_build_query($data, '', '&'));
	
	$key = urlencode(base64_encode($key));
	$param = aes256_encrypt($param);
	
	$api_url = "{$url}?key={$key}&param={$param}";
	$response = file_get_contents($api_url);
	$response_xml = simplexml_load_string($response);
	
	return $response_xml[0];
}

function LMS_ValidateUser($data)
{
	$url 	= 'http://uat.asknlearn.com/iim/SSO/IIM/SSO.aspx';
	$key	= 'T7D+IbdKOBfF3zd+LT+cYGDFhQ4YcHU2';
	
	$data['requestdate'] = gmdate('dmYhi');
	$param = urldecode(http_build_query($data, '', '&'));
	
	$key = urlencode(base64_encode($key));
	$param = aes256_encrypt($param);
	
	$api_url = "{$url}?key={$key}&param={$param}";
	return $api_url;
}

function logo_thumbnail($file)
{
	return '<img src="'.base_url('/uploads/'.$file).'" width="100" style="background:#fff;border:1px solid #ddd;padding:5px">';
}

function course_logo_thumbnail($file)
{
	return '<img src="'.base_url('/uploads/catalogs/'.$file).'" width="100" style="background:#fff;border:1px solid #ddd;padding:5px">';
}

function sync_status($status)
{
	return ($status == '1') ? '<i class="glyphicon glyphicon-check" style="color:ForestGreen"></i>' : '-';
}

function excel_header($filename)
{
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
}


/* End of file briq_helper.php */
/* Location: ./application/helpers/briq_helper.php */