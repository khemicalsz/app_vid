<?php
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
        $this->load->model('campaign_model');
        $this->load->library('session');
        $this->load->helper(array('form','directory','security'));
        
        $this->load->library('form_validation');
	}
	
	public function index()
	{
		if( !$this->is_loggedin() || $this->aauth->is_admin() != 1) 
		{
            redirect('login', 'refresh');
		} 
		else 
		{
			$userid = $this->session->userdata('id');
			$username = $this->session->userdata('name');
			$useremail = $this->session->userdata('email');
			$statename = 'Admin Panel';
			
			if(isset($_POST['inputDeleteID']) && $_POST['inputDeleteID'] != '')
            {
				$this->aauth->delete_user($_POST['inputDeleteID']);
                $this->session->set_flashdata('successMessage', 'User has been deleted Successfully');
				redirect('Admin');
                exit();
            }
			
			$userList = $this->aauth->list_users(3);
			
			
			$this->load->model("settings_model");
			$settings = $this->settings_model->getSettings();
			$data = array(
                        'username' => $username, 
                        'useremail' => $useremail, 
                        'statename' => $statename, 
                        'message' => '',
                        'errorMessage' => '',
						'userList' => $userList,
						'getSettings'=>$settings
                        );
			
			$this->load->view("admin/user_listing",$data);
		}
	}
	
	public function settings()
	{
		$userid = $this->session->userdata('id');
		$username = $this->session->userdata('name');
		$useremail = $this->session->userdata('email');
		$statename = 'Settings';
		
		if(isset($_POST['update_settings']))    
		{
			$this->form_validation->set_rules('app_name', 'App Name', 'required');
			$this->form_validation->set_rules('header_bg_color', 'Header Background Color', 'required');
			$this->form_validation->set_rules('register_page_path', 'Register Page Path', 'required');
			$this->form_validation->set_rules('login_page_path', 'Login Page Path', 'required');
			$this->form_validation->set_rules('support_email', 'Sender Email', 'required');
			$this->form_validation->set_rules('sender_email', 'Sender Email', 'required');
			
			$this->form_validation->set_rules('support_email_actual', 'Support Email', 'required');
			$this->form_validation->set_rules('support_page_text', 'Support Page Text', 'required');
			
			
			if ($this->form_validation->run() == FALSE) 
            {
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
            } 
			else 
			{
				$appName = $this->security->xss_clean($this->input->post('app_name'));
				$headerBg = $this->security->xss_clean($this->input->post('header_bg_color'));
				$registerPagePath = $this->security->xss_clean($this->input->post('register_page_path'));
				$loginPagePath = $this->security->xss_clean($this->input->post('login_page_path'));
				$supportEmail = $this->security->xss_clean($this->input->post('support_email'));
				$senderEmail = $this->security->xss_clean($this->input->post('sender_email'));
				$supportEmailTxt = $this->security->xss_clean($this->input->post('register_email_text'));
				$supportSubLine = $this->security->xss_clean($this->input->post('register_sub_line'));
				
				$supportEmailActual = $this->security->xss_clean($this->input->post('support_email_actual'));
				$supportPageText = $this->security->xss_clean($this->input->post('support_page_text'));
				
				$dbArray = array("app_name"=>$appName,
								"header_bg" =>$headerBg,
								"register_page_path" =>$registerPagePath,
								"login_path" =>$loginPagePath,
								"support_email_actual" =>$supportEmailActual,
								"support_page_text" =>$supportPageText,
								"support_email"=>$supportEmail,
								"sender_email"=>$senderEmail,
								"email_text"=>$supportEmailTxt,
								"register_subject_line"=>$supportSubLine
								);
								
				$this->campaign_model->updateSettings($dbArray, 1);	
				$this->uploadImages($_FILES,1);				
			}
		}
		
		
		$getSettings = $this->campaign_model->getSettings();
		$data = array(
                        'username' => $username, 
                        'useremail' => $useremail, 
                        'statename' => $statename, 
                        'message' => '',
						'getSettings' =>$getSettings,
                        'errorMessage' => '',
						'getSettings'=>$getSettings
                        );
						
		
		$this->load->view("admin/settings",$data);
	}
	
	function is_loggedin() {

        if ( $this->aauth->is_loggedin() ){
             return true;
        } else {
             return false;
        }
    }
	
	function uploadImages($arrayImg,$settingID)
    {
		$config['upload_path'] = 'assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '10000000';
        $config['max_width']  = '100000';
        $config['max_height']  = '100000';
        $config['overwrite']  = true;
		
		$this->load->library('upload', $config);
	
		foreach($arrayImg as $file => $value)
        {
            $fileName = $value['name'];
            if(!empty($fileName))
            {
                if ( ! $this->upload->do_upload($file))
                {
					return $this->upload->display_errors();   
                }
                else
                {
                    $getFileData = $this->upload->data();
					 $updateArray = array(
                           'logo_url' => base_url().$config['upload_path'].$getFileData['file_name']
                        ); 	

					$this->campaign_model->updateSettings($updateArray,$settingID);
                }    
            }    
        }
	}	

	public function changeRole(){
		$this->load->model("settings_model");
		$user_id = $this->input->post('user_id');

		$checkAdmin = $this->settings_model->checkAdmin($user_id);
		if(count($checkAdmin) > 0){
			$removeAdminRole = $this->settings_model->removeAdminRole($user_id);
			if($removeAdminRole){
				$result = array(
					'status' 	=> true,
					'message'   => "You' ve successfully remove Admin role to user."
				);

				echo json_encode($result);
				exit();
			} else {
				$result = array(
					'status' 	=> false,
					'message'   => "Something went wrong romoving admin role to a user, please contact the web developer."
				);

				echo json_encode($result);
				exit();
			}
		} else {
			$addAdminRole = $this->settings_model->addAdminRole($user_id);
			if($addAdminRole){
				$result = array(
					'status' 	=> true,
					'message'   => "You' ve successfully add Admin role to user."
				);

				echo json_encode($result);
				exit();
			} else {
				$result = array(
					'status' 	=> false,
					'message'   => "Something went wrong adding admin role to a user, please contact the web developer."
				);

				echo json_encode($result);
				exit();
			}

		}
	}
}