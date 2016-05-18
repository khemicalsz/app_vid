<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
		$this->load->helper(array('form'));
        $this->load->helper('security');
        $this->load->library('form_validation');
    }
	public function index() {
		/* redirects if already loggined */
        if($this->aauth->is_loggedin()) {
            redirect('campaignadd', 'refresh');
        }
		
		$data = '';
		$this->load->model("settings_model");
		$data['getSettings'] = $this->settings_model->getSettings();
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('reset_email', 'Email', 'required');
			if ($this->form_validation->run() == FALSE) {
				
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
			}
			else
			{
				$email = $_POST['reset_email'];
				$this->aauth->remind_password($email);
				$data['success_msg'] = "Verfication Code has been sent to your email address";
			}
		}
		

		$this->load->view('reset_view',$data);
	}
	
	function reset_password($userID,$verficationCode)
	{
		$verifyUser = $this->aauth->verify_user($userID, $verficationCode);
		if($verifyUser == true)
		{
			$data['userID']  = $userID;
			$this->load->view('update_password',$data);
		}
		else
		{
			redirect('login', 'refresh');
			exit();
		}
	}
	
	function updatePassword(){
		$data = '';
		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('update_password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
			}
			else
			{
				$password = $_POST['update_password'];
				$userID = $_POST['userID'];
				
				$update = $this->aauth->update_user($userID, FALSE,$password,FALSE);
				if($update == true)
				{
					$this->session->set_flashdata('success_msg', 'Password has been updated successfully');
					redirect('login', 'refresh');
					exit();
				}
				else
				{
					
					$this->session->set_flashdata('error_msg', 'Unable to Update Password');
					redirect('reset/update_password', 'refresh');
					exit();
				}
				
			}
		}
	}
}
