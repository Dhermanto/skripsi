<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $db;
	public $table;
	public $fields;
	public $filter = array();
	public $keyword;
	public $where;
	public $sql_where;
	public $like;
	public $sql_like;
	public $offset;
	public $order;
	public $limit;
	
	public $id_divisi;
	public $id_grup_pengguna;
	
	
	public function __construct()
	{
		parent::__construct();
		
		$CI =& get_instance();
		$this->db = $CI->db;
		
		$this->id_divisi = user_session('id_divisi');
		$this->id_grup_pengguna = user_session('id_grup_pengguna');
		$this->sql_where = $this->sql_like = '';
		$this->keyword = '';
	}
	
	
	public function by_id($id)
	{
		$src = $this->db->get_where($this->table, array('id' => $id));
		return $src->num_rows() > 0 ? $src->row() : $this->fields;
	}
	
	
	public function set_filter($q_encoded)
	{
		// foreach ($this->filter as $key => $val) {
			// $this->filter[$key] = '';
		// }
		$params_json = base64_decode($q_encoded);
		$params_arr = (mb_detect_encoding($params_json) == 'ASCII') ? (array) json_decode($params_json) : array();
		
		foreach ($params_arr as $key => $val) {
			if (is_object($val)) $this->filter[$key] = (array) $val;
			else if ($key == 'keyword') $this->keyword = $val;
			else $this->filter[$key] = $val;
		}
	}
	
	
	# obsolete
	public function set_keyword($q_encoded)
	{
		$q_decoded = base64_decode($q_encoded);
		$this->keyword = (mb_detect_encoding($q_decoded) == 'ASCII') ? $q_decoded : '';
	}
	
	
	public function set_grid_params($params)
	{
		$this->offset = $params['offset'];
		$this->order = $params['item'].' '.$params['order'];
		$this->limit = $params['limit'];
	}
	
	
	# obsolete
	public function like()
	{
		$i = 1;
		foreach ($this->like as $field) {
			if ($i == 1) $this->db->like($field, $this->keyword, 'both');
			else $this->db->or_like($field, $this->keyword, 'both');
			$i++;
		}
	}
	
	
	public function filter(/*$ctable = ""*/)
	{
		// if($ctable == "") $ctable = $this->table;
		// // active data
		// $this->db->where($ctable.'.deleted_at IS NULL');
		
		// set filter pencarian
		$this->sql_like = 'FALSE';
		
		$i = 1;
		foreach ($this->like as $field) {
			$this->sql_like .= " OR $field LIKE '%".$this->keyword."%'";
			$i++;
		}
		
		$this->db->where('('.$this->sql_like.')');
		
		// set filter where
		foreach ($this->filter as $field => $filter) {
			if (is_array($filter)) {
				$this->db->where("($field BETWEEN '$filter[start]' AND '$filter[end]')");
			}
			else if ($filter !== '') {
				$this->db->where("$field = '$filter'");
				// $this->sql_where .= " AND $field = '$filter'";
			}
		}
	}
	
	
	public function num_rows()
	{
		$this->filter();
		return $this->db->count_all_results($this->table);
	}
	
	
	public function get()
	{
		$this->filter();
		$this->db->order_by($this->order);
		$this->db->limit($this->limit, $this->offset);
		return $this->db->get($this->table);
	}
	
	
}
// END MY_Model Class

/* End of file MY_Model.php */
/* Location: ./system/core/MY_Model.php */
