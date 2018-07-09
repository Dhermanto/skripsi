<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lms extends MX_Controller{
	public function __construct(){
        parent::__construct();
        $this->page->use_directory();
        $this->page->template('frontend_tpl');
        $this->load->model('apps_model');
    }

    public function index()
    {    
        # LMS Validate User
        $id         = $this->session->userdata('user')->user_id;
        $id_wizlearn = 62;

        $user = $this->db->get_where('users', array('id' => $id))->row();
            
            $params = array (
                'userid' => $user->user_wizlearn_id,
                'courseid' => $id_wizlearn,
                'coursestartdate' => gmdate('d/m/Y'),
                'courseenddate' => date('d/m/Y', strtotime('+360 days')),
            );
            
        $response = LMS_AssignCourse($params); 

        $user_params = array (
            'userid' => $user->user_wizlearn_id,
            'password' => $user->user_password,
            'courseid' => $id_wizlearn,
        );
        $url = LMS_ValidateUser($user_params);
        
        # End of LMS
        
        header('location:'.$url);  
    }
}
