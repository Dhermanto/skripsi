<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MX_Controller {


	public function __construct()
	{
		parent::__construct();
	}


	public function login()
	{
		$nama_login = $this->input->post('nama_login');
		$password = bjs_password($this->input->post('password'));

		$check_nama = $this->db->get_where('users', array('user_wizlearn_id' => $nama_login))->num_rows();
		$check_pass = $this->db->get_where('users', array('user_password' => $password))->num_rows();
		$src = $this->db
					->select('id, user_name, user_group, customer_id')
					->where("user_wizlearn_id = '$nama_login' AND user_password = '$password'")
					->get('users');


		if ($check_nama == '0') {
			$message = "<div style='color: red'><strong>Username tidak terdaftar...!</strong></div>";
			$this->session->set_flashdata('name', $message);
			redirect(site_url('/login/admin'));
		}
		else if ($check_nama > '0' && $check_pass == '0') {
			$message = "<div style='color: red'><strong>Password salah</strong></div>";
			$this->session->set_flashdata('pass', $message);
			redirect(site_url('/login/admin'));
		}
		else if ($src->num_rows() > 0) {
			
			$row_array = $src->row_array();
			
			if (($row_array['user_group'] != 'admin') && ($row_array['user_group'] != 'admin_bank')){
				redirect(site_url('/login/admin'));
			}
			else {					
				$pengguna = $src->row();
				$this->session->set_userdata('pengguna', $pengguna);
				redirect(site_url('/dasbor'));
			}
		}
		else {
			redirect(site_url('/login/admin'));
		}
	}


	public function password()
	{
		$this->page->template('app_tpl');
		$this->page->view('auth_password', array (
			'action_url' => $this->page->base_url('/update_pwd'),
		));
	}


	public function update_pwd()
	{
		$pwd_old = bjs_password($this->input->post('pwd_old'));
		$pwd_new = bjs_password($this->input->post('pwd_new'));

		$id_pengguna = $this->session->userdata('pengguna')->id;

		$src =
			$this->db
					->where("id = '$id_pengguna' AND user_password = '$pwd_old'")
					->get('users');

		if ($src->num_rows() > 0) {
			db_update('users', array('user_password' => $pwd_new), "id = '$id_pengguna'");
			$this->session->set_flashdata('pwd_status', 'ok');
			redirect($this->agent->referrer());
		}
		else {
			$this->session->set_flashdata('pwd_status', 'wrong');
			redirect($this->agent->referrer());
		}
	}


	public function logout()
	{
		$this->session->destroy('pengguna');
		redirect(site_url('/login/admin'));
	}

	public function landing_login()
	{
		$nama_login       = strtoupper($this->input->post('nama_login'));
        // $nama_email       = $this->input->post('nama_email');
		$password         = bjs_password($this->input->post('password'));
        // $customer_slug    = $this->input->post('slug');
        // $id               = $this->input->post('id');

        $src = "SELECT c.customer_name, c.id, u.user_name, c.customer_slug, u.id as user_id FROM customers as c, users as u WHERE c.id = u.customer_id AND u.user_wizlearn_id = '$nama_login' AND u.user_password = '$password'";
        $sql = $this->db->query($src)->row_array();
        $id = @$sql['id'];
        $now = date('Y-m-h');

        $query = $this->db->query($src);

        $nama =  @$sql['customer_name'];

		if ($query->num_rows() > 0) {
		    $pengguna = $query->row();
	        $this->session->set_userdata('user', $pengguna);

	        $query_exp  = "SELECT * FROM customer_credits WHERE customer_id = $id ORDER BY id DESC";
	        $exp_date   = $this->db->query($query_exp)->row();
	        $id_user = $sql['user_id'];
	        $credit_point = $this->db->query("SELECT SUM(credit_point) AS credit FROM `user_journals` WHERE user_id = '$id_user'")->row();

	        if ($now > $exp_date->credit_exp_date && $credit_point->credit > 0) {
	        	$data = array(
		        	'user_id' => $id_user,
		        	'credit_point' => -$credit_point->credit,
		        );
	        	db_insert('user_journals', $data);
	        }

	        redirect(site_url('/apps/index'));
		}
		else {
			$this->session->set_flashdata('login_status', 'wrong');
	        redirect(site_url('login'));
            // redirect(site_url("/$customer_slug"));
		}
	}

}

/* End of file auth.php */
/* Location: ./application/modules/pengguna/controllers/auth.php */
