<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('customer/customer_model');
        $this->page->template('frontend_tpl');
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
            $userData   = $this->session->userdata('user');
            $id         = $userData->id;
            $id_user    = $userData->user_id;
            $nama       = $userData->user_name;
            $data_home  = $this->db->query("SELECT *, uc.id as id_user_course FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND user_id = $id_user AND enrollment_status = '1' AND enrolled_time > '0' AND uc.deleted_by is null AND c.deleted_by is null");

            $keranjang = $this->db->select("*, count(*) AS total")->where(array('user_id' => $id_user));
            $keranjang = $this->db->get('user_course')->row()->total;
            if ($userData->user_group == 'admin_bank') {
                $credit = $this->customer_model->give_id($userData->id)->row()->credit_point;
            }
            else {
                $credit = $this->db->query("SELECT *, IFNULL(SUM(credit_point), 0) AS credit FROM user_journals WHERE user_id = $id_user")->row()->credit;
            }

            $query_exp = "SELECT * FROM customer_credits WHERE customer_id = $id ORDER BY id DESC";
            $exp       = $this->db->query($query_exp)->row()->credit_exp_date;

            $this->page->view('dashboard-home', array(
                'data_home' => $data_home->result(),
                'nama'      => $nama,
                'keranjang' => $keranjang,
                'credit'    => $credit,
                'exp'       => $exp
            ));
        }
        else {
            redirect(site_url('login'));
        }
    }

    public function login()
    {
        $this->page->template('frontend_login');
        $this->page->view();
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
