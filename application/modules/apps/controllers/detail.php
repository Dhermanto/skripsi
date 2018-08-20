<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail extends MX_Controller{

    public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model('apps_model');
        $this->load->model('up_model');
    }

    public function index($id = null)
    {
        if ($this->session->userdata('user')) {
            $userData   = $this->session->userdata('user');
            $id_user    = $userData->user_id;

            //get_course
            $course = $this->apps_model->get_catalog()->result();
            //find course
            $find_course = $this->db->query("SELECT * FROM user_course WHERE user_id = $id_user AND enrollment_status = '0'");
            //cek date
            $cek_date = $this->db->query("SELECT * FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id_user AND uc.enrolled_time > 0 AND c.deleted_by is null");

            $this->page->view('dashboard-detail', array(
                'course'         => $course,
                'course_id'      => $find_course->result(),
                'cek_date'       => $cek_date->result(),
            ));

        }
        else {
            redirect(site_url('login'));
        }
    }

    public function course_detail($id_course, $userCourseId = '')
    {
        $course = $this->db->query("SELECT * FROM courses WHERE id = $id_course")->row();
        $id         = $this->session->userdata('user')->id;
        $id_user    = $this->session->userdata('user')->user_id;
        $position   = $this->session->userdata('user')->position;
        //find course
        $find_course = $this->db->query("SELECT * FROM user_course WHERE user_id=$id_user AND enrollment_status = '0'");
        //cek date
        $cek_date = $this->db->query("SELECT * FROM user_course as uc, courses as c WHERE uc.course_id = c.id AND uc.user_id = $id_user AND uc.enrolled_time > 0");

        $my_course = $this->apps_model->course_detail($id_course, $id_user);

        //get exam
        $exam      = $this->up_model->getExamCustomer($id_course, $id, $position);
        $checkExam = $this->up_model->getExamByUser($id_course, $id_user);
        $this->page->view('dashboard-detail', array(
            'course_detail' => $course,
            'course_id'     => $find_course->result_array(),
            'cek_date'      => $cek_date->result_array(),
            'my_course'     => $my_course->row(),
            'userCourseId'  => $userCourseId,
            'exam'          => $exam,
            'examFile'      => isset($checkExam->answer_exam) ? $checkExam->answer_exam : ""
        ));
    }

    public function detail_in($id)
    {
        $user_id     = $this->session->userdata('user')->user_id;
        $data = array(
            'course_id' => $id,
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
        redirect(site_url('apps/katalog'));
    }

    public function updateAnswer() {
        $user_id  = $this->session->userdata('user')->user_id;
        $courseId = $_POST['course_id'];
        $userCourseId = $_POST['user_course_id'];
        $uploadPath              = 'uploads/answer/';
        $config['upload_path']   = $uploadPath;
        $config['encrypt_name']  = TRUE;
        $config['allowed_types'] = 'pdf|txt|doc|xls|xlsx|docx';
        $this->load->library('upload', $config);
        $dataDetail = array();
        if ( $this->upload->do_upload('answer') ){
            $fileData  = $this->upload->data();
            $checkExam = $this->up_model->getExamByUser($courseId, $user_id);
            $dataDetail['answer_exam']  = $fileData['file_name'];
            if ($checkExam) {
                db_update('user_course', $dataDetail, array('id' => $userCourseId));  
            }
        }
    }

    public function setCompletionDate($id) {
        $user_id  = $this->session->userdata('user')->user_id;
        $checkExam = $this->up_model->getExamByUser($id, $user_id);
        $dataDetail['completion_date']  = date('Y-m-d H:i:s');
        if ($checkExam) {
            db_update('user_course', $dataDetail, array('id' => $checkExam->id));  
        }
    }

    public function date_diff($d1, $d2)
    {
        $d1 = (is_string($d1) ? strtotime($d1) : $d1);
        $d2 = (is_string($d2) ? strtotime($d2) : $d2);
        $diff_secs = abs($d1 - $d2);
        $base_year = min(date("Y", $d1), date("Y", $d2));
        $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);

        $year=date("Y", $diff) - $base_year;
        if($year==1)
        {
            $year='1 tahun ';
        }
        elseif($year>1)
        {
            $year=$year.' tahun ';
        }
        else
        {
            $year='';
        }

        $month=date("n", $diff) - 1;

        if($month==1)
        {
            $month='1 bulan ';
        }
        elseif($month>1)
        {
            $month=$month.' bulan ';
        }
        else
        {
            $month='';
        }
            $day=date("j", $diff) - 1;

        if($day==1)
        {
            $day='1 hari';
        }
        elseif($day>1)
        {
            $day=$day.' hari';
        }
        else
        {
            $day='';
        }
            return $year.$month.$day;
    }
}

/* End of file pengguna.php */
/* Location: ./application/modules/pengaturan/controllers/pengguna.php */
