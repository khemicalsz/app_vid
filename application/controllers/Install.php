<?php

class install extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form','directory','security'));
		$this->load->library('form_validation');
	}
	
	function index()
	{
		echo "<pre>";
		print_r($this->config->_config_paths[0]);
		echo "</pre>";
		
		echo $this->config->_config_paths[0]."config\database";
		
		$this->form_validation->set_rules('host', 'Host', 'required');
		$this->form_validation->set_rules('database', 'Database', 'required');
		$this->form_validation->set_rules('user', 'Database User', 'required');
		$this->form_validation->set_rules('pass', 'Database Pass', '');
		
		if ($this->form_validation->run() == TRUE)
        {
           // echo 
        }
        else
        {
            $data['msg'] = validation_errors('<h3>', '</h3>');          
			
			$this->load->view("login_header");
			$this->load->view("install/step1");
			$this->load->view("login_footer");        
        }
		
		
		
	}

}