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

function admin_bank($string)
{
	if ($string == 'admin_bank') {
		return "admin customer";
	}
	else {
		return $string;
	}
}

function dd($some_var) {
	echo "<pre>";
    print_r($some_var);
    echo "</pre>";
	die();
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
	$data['updated_by'] = $CI->session->userdata('pengguna');
	$data['updated_by'] = (!$data['updated_by']) ? $CI->session->userdata('user')->id : $data['updated_by']->id;
	return $CI->db->update($table, $data, $where);
}

function db_delete($table, $where)
{
	$CI =& get_instance();
	$data['deleted_at'] = date('Y-m-d H:i:s');
	$data['deleted_by'] = $CI->session->userdata('pengguna');
	$data['deleted_by'] = (!$data['deleted_by']) ? $CI->session->userdata('user')->id : $data['deleted_by']->id;
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

function answer_exam($answer) {
	if ($answer) {
		return '<a href="' . base_url('/uploads/answer') . "/" . $answer . '" title="Download Answer"><i class="glyphicon glyphicon-file"></i></a>';
	}
	else {
		return '<b>No answer yet</b>';
	}
}

function score($id) {
	$CI    = & get_instance();
	$check = $CI->db->query("SELECT score, answer_exam FROM user_course where id = $id")->row();

	if ($check->answer_exam) {
		if ($check->score) {
			$string = "<div id='$id'><a href='#' class='give_score' data-id='$id' data-value='$check->score'>$check->score</a></div>";
		}
		else {
			$string = "<div id='$id'><a href='#' class='give_score' data-id='$id' data-value='0'>Give</a></div>";
		}		
	}
	else {
		$string = "<div style='text-align:center'>-</div>";
	}
	return $string;
}

function status_active($status)
{
	return $status == '1' ? '<font color="ForestGreen">ACTIVE</font>' : '<font color="Crimson">INACTIVE</font>';
}

function padded_string($string)
{
	return str_pad($string, (16 * (floor(strlen($string) / 16) + 1)), chr(16 - (strlen($string) % 16)));
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

function content($content)
{
	return nl2br(substr($content, 0, 200));
}

function icon()
{

 return	
 $icon = array( 'fa-bank',
 'fa-building',
 'fa-codepen',
 'fa-circle-o-notch',
 'fa-circle-thin',
 'fa-cube',
 'fa-cubes',
 'fa-database',
 'fa-delicious',
 'fa-deviantart',
 'fa-digg',
 'fa-drupal',
 'fa-empire',
 'fa-envelope-square',
 'fa-fax',
 'fa-file-archive-o',
 'fa-file-audio-o',
 'fa-file-code-o',
 'fa-file-excel-o',
 'fa-file-image-o',
 'fa-file-movie-o',
 'fa-file-pdf-o',
 'fa-file-photo-o',
 'fa-file-picture-o',
 'fa-file-powerpoint-o',
 'fa-file-sound-o',
 'fa-file-video-o',
 'fa-file-word-o',
 'fa-file-zip-o',
 'fa-ge',
 'fa-git',
 'fa-git-square',
 'fa-google',
 'fa-graduation-cap',
 'fa-hacker-news',
 'fa-header',
 'fa-history',
 'fa-institution',
 'fa-joomla',
 'fa-jsfiddle',
 'fa-language',
 'fa-life-bouy',
 'fa-life-ring',
 'fa-life-saver',
 'fa-mortar-board',
 'fa-openid',
 'fa-paper-plane',
 'fa-paper-plane-o',
 'fa-paragraph',
 'fa-paw',
 'fa-pied-piper',
 'fa-pied-piper-alt',
 'fa-pied-piper-square',
 'fa-qq',
 'fa-ra',
 'fa-rebel',
 'fa-recycle',
 'fa-reddit',
 'fa-reddit-square',
 'fa-send',
 'fa-send-o',
 'fa-share-alt',
 'fa-share-alt-square',
 'fa-slack',
 'fa-sliders',
 'fa-soundcloud',
 'fa-space-shuttle',
 'fa-spoon',
 'fa-spotify',
 'fa-steam',
 'fa-steam-square',
 'fa-stumbleupon',
 'fa-stumbleupon-circle',
 'fa-support',
 'fa-taxi',
 'fa-tencent-weibo',
 'fa-tree',
 'fa-university',
 'fa-vine',
 'fa-wechat',
 'fa-weixin',
 'fa-wordpress',
 'fa-yahoo',); 
}


/* End of file briq_helper.php */
/* Location: ./application/helpers/briq_helper.php */
