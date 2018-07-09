<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmarked extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model('apps_model');
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
            $id_user    = $this->session->userdata('user')->user_id;
			
            //get_course
            $course = $this->apps_model->get_catalog();
            
            //find course
            $find_course = $this->db->query("SELECT * FROM user_course WHERE user_id=$id_user AND enrollment_status = '0' AND deleted_by is null");

            //cek date
            $cek_date = $this->db->query("SELECT * FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id_user AND uc.enrolled_time > 0 AND c.deleted_by is null");
            //cek date
            $data_bookmarked = $this->db->query("SELECT *, uc.id as id_user_course FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id_user AND c.deleted_by is null ORDER BY enrollment_status ASC");

            $this->page->view('bookmarked', array(
                'course'         => $course,
                'course_id'      => $find_course->result_array(),
                'bookmarked'     => $data_bookmarked->result_array(),
                'cek_date'       => $cek_date->result_array(),
            ));
        }
        else {
            redirect(site_url('login'));
        }
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
