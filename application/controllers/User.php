<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
        $this->load->helper('security');
        $this->load->library('form_validation');
	}
	
	public function profile($id)
	{
		
		if( !$this->is_loggedin() ) 
		{
            redirect('login', 'refresh');
		}
		else
		{
			$data['statename'] = 'Profile';
			$data['username'] = $this->session->userdata('name');
			$this->load->model("settings_model");
			$data['getSettings'] = $this->settings_model->getSettings();
			if(isset($_POST['submit']))
			{
				$this->load->helper('security');
				$this->load->library('form_validation');

				$this->form_validation->set_rules('change_password', 'Password', 'trim|required|xss_clean');

				if($this->form_validation->run() == FALSE) {
					//Field validation failed.  User redirected to login page
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
					
				} else 
				{
					$password = $_POST['change_password'];
					$userID = $this->session->userdata('id');
					
					$changePass = $this->aauth->update_user($userID,false,$password,false);
					
					if($changePass)
					{
						$this->session->set_flashdata('successMessage', 'Password has been changed successfully');
						redirect('user/profile/'.$userID, 'refresh');
					}
					else
					{
						$this->session->set_flashdata('errorMessage', 'Unable to change Password');
						redirect('user/profile/'.$userID, 'refresh');
					}
				}
			}

			if(isset($_POST['submitEmail']))
			{
				$this->load->helper('security');
				$this->load->library('form_validation');

				$this->form_validation->set_rules('change_email', 'Email', 'required|valid_email');

				if($this->form_validation->run() == FALSE) {
					//Field validation failed.  User redirected to login page
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
					
				} else 
				{
					$email = $_POST['change_email'];
					$userID = $this->session->userdata('id');
					
					$checkEmail = $this->settings_model->checkEmail($userID,$email);

					if(count($checkEmail) > 0){
						$this->session->set_flashdata('errorMessage', 'Email already used by another user.');
						redirect('user/profile/'.$userID, 'refresh');	
					} else {
						$changeEmail = $this->aauth->update_user($userID,$email,false,false);
						
						if($changeEmail)
						{	
							$this->session->set_userdata('email', $email);
							$this->session->set_flashdata('EmailsuccessMessage', 'Email has been changed successfully');
							redirect('user/profile/'.$userID, 'refresh');
						}
						else
						{
							$this->session->set_flashdata('EmailerrorMessage', 'Unable to change Email');
							redirect('user/profile/'.$userID, 'refresh');
						}
					}
						
				}
			}
			$this->load->view('profile', $data);
		}
		
	}
	
	function is_loggedin() {

        if ( $this->aauth->is_loggedin() ){
             return true;
        } else {
             return false;
        }
    }

}