<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Katalog extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model('apps_model');
        $this->load->model('user/user_model');
        $this->load->model('course/course_model');
        $this->load->model('position_management_model');
    }

    public function index()
    {
        if ($this->session->userdata('user')) {
            $id_user  = $this->session->userdata('user')->user_id;
            $userData = $this->user_model->by_id($id_user);
            $idCategory  = array();

            //find user course
            $find_course = $this->db->query("SELECT * FROM user_course WHERE user_id = $id_user AND deleted_by is null");

            //cek date
            $cek_date = $this->db->query("SELECT * FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id_user AND uc.enrolled_time > 0 AND c.deleted_by is null");
            //data_course
            $data_keranjang = $this->db->query("SELECT * FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND user_id = $id_user AND enrollment_status = '0' AND c.deleted_by is null")->result();

            $where     = "";
            $courseArr = array();
            if ($userData->position != null) {
                $getCoursePosition = $this->position_management_model->byId($userData->position);
                if (count($getCoursePosition) > 0) {
                    foreach ($getCoursePosition as $key => $value) {
                        array_push($courseArr, $value->course_id);
                    }
                    foreach ($courseArr as $key => $value) {
                        $categoryPosition = $this->course_model->by_id($value);
                        $idCategory[$categoryPosition->course_category] = $categoryPosition->course_category;
                    }

                    $proses = implode(",", $courseArr);
                    $where  = "AND c.id IN ($proses)";
                }
            }

            //course & category
            $category_course = $this->db->query("
                SELECT *, c.id AS id_course, category.id AS id_category 
                FROM category 
                JOIN courses as c ON category.id = c.course_category 
                WHERE c.course_status = '1' 
                $where
                AND c.deleted_by is null"
            );

            //get category
            $whereCategory = "";
            if (count($idCategory) > 0) {
                $transformCategory = implode(",", $idCategory);
                $whereCategory = "AND id IN ($transformCategory)";
            }

            $category = $this->db->query("SELECT * FROM category WHERE deleted_by is null $whereCategory"); 
            $this->page->view('catalog', array(
                'course_id'      => $find_course->result_array(),
                'cek_date'       => $cek_date->result_array(),
                'data_keranjang' => $data_keranjang,
                'course_category'=> $category_course,
                'category'       => $category,
                'user_id'        => $id_user
                // 'userdata'       => 
            ));
        }
        else {
            redirect(site_url('login'));
        }
    }

    public function course_in($id)
    {
        $id_course   = str_replace("%22", '', $id);
        $user_id     = $this->session->userdata('user')->user_id;

        $data = array(
            'course_id' => $id_course,
            'user_id' => $user_id,
            'bookmarked_time' => date("Y-m-d H:i:s")
        );

        $sql = $this->db->get_where('courses', array('id' => $id_course))->row();

        $data_journals = array(
            'user_id' => $user_id,
            'credit_point' => -$sql->credit_point
        );

        db_insert('user_course', $data);
        db_insert('user_journals', $data_journals);
        redirect(site_url('apps/bookmarked'));
    }
	
    public function course_out($name = null, $id_course = null)
    {
        $id         = $this->session->userdata('user')->user_id;
        $course_id  = $this->db->query("SELECT id FROM user_course WHERE user_id = $id AND enrollment_status = '0' AND deleted_by is null")->result();
        $credit     = 0;

        if ($name == 'enroll') {
            $sql = $this->db->query("SELECT *, c.credit_point FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id AND uc.enrollment_status = '0' AND uc.id = $id_course AND c.deleted_by is null")->row();
			
			$user = $this->db->get_where('users', array('id' => $id))->row();
			$course = $this->db->get_where('courses', array('id' => $sql->course_id))->row();
			
			$params = array (
				'userid' => $user->user_wizlearn_id,
				'courseid' => $course->course_wizlearn_id,
				'coursestartdate' => gmdate('d/m/Y'),
				'courseenddate' => date('d/m/Y', strtotime('+'.$course->active_duration.' days')),
			);
		
			$data = array(
				'user_wizlearn_id' => $params['userid'],
				'course_wizlearn_id' => $params['courseid'],
				'enrollment_status' => '1',
				'enrolled_time' => date("Y-m-d H:i:s"),
			);

			foreach ($course_id as $key => $value) {
				$this->db->update('user_course', $data, array('user_id' => $id, 'id' => $id_course));
			}
        }
        else if ($name == 'cancel') {
            $sql = $this->db->query("SELECT *, c.credit_point FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id AND uc.enrollment_status = '0' AND uc.id = $id_course")->row();

            $data = array(
                'user_id' => $id,
                'credit_point' => $sql->credit_point,
            );

            db_insert('user_journals', $data);

            $this->db->where("user_id", "$id");
            $this->db->where("enrollment_status", "0");
            $this->db->where("id", "$id_course");
            $this->db->delete("user_course");
            // db_update('user_course', $data_course, array('user_id' => $id));
        }
        redirect(site_url('apps/bookmarked'));
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
