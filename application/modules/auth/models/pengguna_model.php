<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna_model extends MY_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'users';

		$this->fields = (object) array (
			'id' => NULL,
			'nama' => NULL,
			'email' => NULL,
			'no_hp' => NULL,
		);
	}


	public function info($id)
	{
		$this->db->select('a.*, b.isi_data AS divisi, c.isi_data AS grup_pengguna');
		$this->db->join('master AS b', 'a.id_divisi = b.id');
		$this->db->join('master AS c', 'a.id_grup_pengguna = c.id');
		$this->db->where("a.id = '$id'");
		return $this->db->get('pengguna AS a')->row();
	}


}
/* End of file pengguna_model.php */
/* Location: ./application/modules/pengguna/models/pengguna_model.php */
