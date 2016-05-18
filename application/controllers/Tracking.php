<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Tracking extends CI_Controller
{
		function __construct()
		{
			parent:: __construct();
			$this->load->model('campaign_model');
		}


		function index()
		{
			if(isset($_POST['campaign']) && $_POST['campaign'])
			{

				$campaignID = $_POST['campaign'];	
				$array = array(
						"campaign_id"=>$campaignID,
						"hit"=>1,
						"created" => date('Y-m-d H:i:s')
					);
				$trackCampaign = $this->campaign_model->insertTracking($array);
				
			}	
		}
}