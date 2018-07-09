<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
            //data session and template
            $id         = $this->session->userdata('user')->id;
            $id_user    = $this->session->userdata('user')->user_id;
            $data   = $this->db->get_where('customers', array('id' => $id))->row();

            $credit = $this->db->query("SELECT *, IFNULL(SUM(credit_point), 0) AS credit FROM user_journals WHERE user_id = $id_user")->row();

            $this->db->select("count(*) AS total")->where(array('user_id'=>$id_user));
            $keranjang = $this->db->get('user_course')->row();
            //data_course
            $data_keranjang = $this->db->query("SELECT * FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND user_id = $id_user AND enrollment_status = '0' AND c.deleted_by is null")->result();

            $query_exp  = "SELECT * FROM customer_credits WHERE customer_id = $id ORDER BY id DESC";
            $exp_date   = $this->db->query($query_exp)->row();

            $this->page->view('dashboard-pengaturan', array(
                'nama'      => $this->session->userdata('user')->user_name,
                'exp'       => $exp_date->credit_exp_date,
                'logo'      => $data->customer_logo,
                'credit'    => $credit->credit,
                'keranjang' => $keranjang->total,
                'action'    => $this->page->base_url('/update_password'),
                'data_keranjang' => $data_keranjang,
            ));
        }
        else {
            redirect(site_url('login'));
        }
    }

    public function update_password()
    {
        $pwd_old = bjs_password($this->input->post('pwd_old'));
        $pwd_new = bjs_password($this->input->post('pwd_new'));
        $rpt_pwd = bjs_password($this->input->post('rpt_pwd'));
        // $name    = $this->input->post('user_id');
        $id      = $this->session->userdata('user')->user_id;

        if (($pwd_old) != '' && ($pwd_new) != '' && ($rpt_pwd) != '') {
            if ($pwd_new === $rpt_pwd) {
				
				$src = $this->db
        					 ->where("id = '$id' AND user_password = '$pwd_old'")
        					 ->get('users');

                if ($src->num_rows() > 0) {

					$user = $this->db->get_where('users', array('id' => $id))->row_array();
					
					$params = array (
						'userid' => $user['user_wizlearn_id'],
						'password' => $pwd_new,
					);
			
					$this->db->update('users', array('user_password' => $pwd_new), "id = '$id'");
					$alert = "<div class='alert alert-success'>Password changed successfully!</div>";
					$this->session->set_flashdata('pwd_status', $alert);	
        			redirect($this->agent->referrer());
        		}
        		else {
                    $alert = "<div class='alert alert-warning'>Wrong old password!</div>";
                    $this->session->set_flashdata('pwd_status', $alert);
        			redirect($this->agent->referrer());
        		}
            }
            else {
                $alert = "<div class='alert alert-warning'>Password not match!</div>";
                $this->session->set_flashdata('pwd_status', $alert);
                redirect($this->agent->referrer());
            }
        }
        else {
            $this->session->set_flashdata('pwd_status', 'wrong');
     		redirect($this->agent->referrer());
        }
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
