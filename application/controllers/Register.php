<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {


	public function __construct() {
        parent::__construct();
    }
	public function index() {
		$this->load->helper(array('form'));
		
		$this->load->model("settings_model");
		$data['getSettings'] = $this->settings_model->getSettings();
		
		
		
		if( $this->is_loggedin() ) {
            redirect('campaignadd', 'refresh',$data);
		} else {
			$this->load->view('register_view',$data);
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
