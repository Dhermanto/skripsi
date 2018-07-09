<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_apps extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->page->template('frontend_login');
        $this->page->use_directory();
        $this->load->model("apps_model");
    }

    public function login()
    {
        $nama_login       = strtoupper($this->input->post('nama_login'));
        $nama_email       = $this->input->post('nama_email');
		$password         = bjs_password($this->input->post('password'));
        $customer_slug    = $this->input->post('slug');
        $id               = $this->input->post('id');
		$now = date('Y-m-h');

        $src = "SELECT 
        		c.customer_name, 
        		c.id, 
        		u.user_group,
        		u.user_name, 
        		c.customer_slug, 
        		u.id as user_id 
        		FROM customers as c, users as u 
        		WHERE c.id = u.customer_id 
        		AND c.customer_slug = '$customer_slug' 
        		AND u.user_wizlearn_id = '$nama_login' 
        		AND u.deleted_by is NUll 
        		AND u.user_password = '$password'";

        $sql = $this->db->query($src)->row_array();
        $query = $this->db->query($src);

        $nama =  @$sql['customer_name'];

		if ($query->num_rows() > 0) {
		    $pengguna = $query->row();
	        $this->session->set_userdata('user', $pengguna);

	        $query_exp  = "SELECT * FROM customer_credits WHERE customer_id = $id ORDER BY id DESC";
	        $exp_date   = $this->db->query($query_exp)->row();
	        $id_user = $sql['user_id'];
	        $credit_point = $this->db->query("SELECT SUM(credit_point) AS credit FROM `user_journals` WHERE user_id = '$id_user'")->row();

	        $data = array(
	        	'user_id' => $id_user,
	        	'credit_point' => -$credit_point->credit,
	        );

	        if ($now > $exp_date->credit_exp_date && $credit_point->credit > 0) {
	        	db_insert('user_journals', $data);
	        }
	        redirect(site_url('/apps/index'));
		}
		else {
			$this->session->set_flashdata('login_status', 'wrong');
            redirect(site_url("/$customer_slug"));
		}
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
		$customer_id = $this->session->userdata('user')->id;
		$customer_slug = $this->db->select('customer_slug')->get_where('customers', array('id' => $customer_id))->row('customer_slug');
		
        $this->session->destroy('user');
        redirect(site_url('/'.$customer_slug));
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
