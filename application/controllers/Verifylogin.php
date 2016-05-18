<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		$this->load->model("settings_model");
		$data['getSettings'] = $this->settings_model->getSettings();
		
        if($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
            $this->load->view('login_view',$data);
        } else {
            //Go to private area
			//echo "<pre>";
			//print_r($_SESSION);
			//echo "</pre>";
			$userID = $this->aauth->get_user_id($this->input->post('email'));
			
			if($this->aauth->is_admin() == 1)
			{
				//if admin
				redirect('admin', 'refresh');
			}
			else
			{
				redirect('campaignlist', 'refresh');
			}
            
        }

    }

    public function check_database($pwd) {
        $user = $this->input->post('email');
        $pwd = $this->input->post('password');

        if( $this->aauth->login($user, $pwd, true) ) {
            return true;
        } else {
            // $this->aauth->print_errors();
            $this->form_validation->set_message('check_database', 'E-mail or Password do not match.');
            return false;
        }

    }

}