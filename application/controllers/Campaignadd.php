<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CampaignAdd extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('campaign_model');
        $this->load->library('session');
        $this->load->helper(array('form','directory','security'));
        
        $this->load->library('form_validation');
		
		//$this->config->set_item('logo_url', 'ahsan');
    }

	public function index() {

        $userid = $this->session->userdata('id');
        $username = $this->session->userdata('name');
        $useremail = $this->session->userdata('email');
        $statename = 'Add Campaign';


        $getLandingImgFromDir = directory_map('assets/img/landing-imgs');

        //print_r($getLandingImgFromDir);

        //$landing_imgs = array('cat_a' => array(1, 2, 3), 'cat_b' => array(4, 5, 6));

        $landing_imgs = $getLandingImgFromDir;

        $buttonsArray = array(
                            'add_to_cart' => array('addtocartblack', 'addtocartblue', 'addtocartgold','addtocartred','addtocartwhite'), 
                            'buy_now' => array('buynowblack', 'buynowblue', 'buynowgold', 'buynowred','buynowwhite'),
                            'download_now' => array('downloadnowblack', 'downloadnowblue', 'downloadnowgold','downloadnowred','downloadnowwhite'),
                            'get_instant_access' => array('getinstantaccessblack','getinstantaccessblue','getinstantaccessgold','getinstantaccessred','getinstantaccesswhite')
                            );

        $optinData = array(
            'title' => 'Hello',
            'desc' => 'A quick brown fox jumps over the lazy dog',
            'btnTxt' => 'Button Text'
            );

		if( !$this->is_loggedin() ) {
            redirect('login', 'refresh');
		} else {
			$this->load->model("settings_model");
			$settings = $this->settings_model->getSettings();
            $data = array(
                        'username' => $username, 
                        'useremail' => $useremail, 
                        'statename' => $statename, 
                        'message' => '',
                        'errorMessage' => '',
                        'landing_imgs' => $landing_imgs,
                        'buttonsArray' =>$buttonsArray,
                        'optinData' => $optinData,
						'getSettings'=>$settings
                        );

        $this->form_validation->set_rules('campaign_name', 'Compaign Name', 'required');
		// for save campaign    
        if(isset($_POST['saveCampaign']))    
         {
            if ($this->form_validation->run() == FALSE) 
            {
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><span>', '</span></div>');
				
            } else 
            { 

                //echo "<pre>";
                //print_r($_POST);
                //echo "</pre>";
                //exit();
                
                if($this->input->post('youtube_vid_id') !='')
                 {
                    $videoID = $this->input->post('youtube_vid_id');
                    $isYoutube = 1;
                 }
                 else if($this->input->post('vimeo_vid_id') !='') 
                 {
                    $videoID = $this->input->post('vimeo_vid_id');
                    $isYoutube = 0;  
                 }
                 else
                 {
					$this->session->set_flashdata('errorMessage', 'Please enter Youtube or Vimeo ID');
                    redirect('campaignadd');
                    exit();
                 }   
                 
				
                $userid                 = $this->session->userdata('id');
                $vid                    = $this->security->xss_clean($videoID);
				
				$checkControls 			= $this->input->post('show_controls');
				$playControls			= (isset($checkControls) && $checkControls == 1)?$checkControls:0;
                
				$checkMockupPosition 	= $this->input->post('mockup_position');
				$mockupPosition			= (isset($checkMockupPosition) && $checkMockupPosition != '')?$checkMockupPosition:'none';
				
				$autoPlayCheck 			= $this->input->post('auto_play');
				$autoPlay				= (isset($autoPlayCheck) && $autoPlayCheck == 1)?$autoPlayCheck:0;
				
				
				$campaignName           = $this->security->xss_clean($this->input->post('campaign_name'));
                $landingImageDefault    = $this->security->xss_clean($this->input->post('landing_img_default'));
                $playIcon               = $this->security->xss_clean($this->input->post('play_icon'));
                $mockupType             = $this->security->xss_clean($this->input->post('mockup_type'));
                $mockupWidth            = $this->security->xss_clean($this->input->post('mockup_width'));
                $mockupHeight           = $this->security->xss_clean($this->input->post('mockup_height'));
                $ctaTxt                 = $this->security->xss_clean($this->input->post('button_text'));
                $ctaTitle               = $this->security->xss_clean($this->input->post('hover_title'));
                //$ctaHoverTxt            = $this->security->xss_clean($this->input->post('hover_text'));
                $ctaRedirectUrl         = $this->security->xss_clean($this->input->post('cta_redirect_url'));
                $ctaDelay               = $this->security->xss_clean($this->input->post('cta_delay'));

                $ctaButtonTitleColor      = $this->security->xss_clean($this->input->post('button_title_color'));
                $ctaButtonBackground    = $this->security->xss_clean($this->input->post('button_background'));
                $ctaButtonTxtColor      = $this->security->xss_clean($this->input->post('button_text_color'));
                $ctaButtonContainerBg   = $this->security->xss_clean($this->input->post('button_container_bg'));
                $ctaButtonStyle         = $this->security->xss_clean($this->input->post('button_style'));
                $ctaButtonShape         = $this->security->xss_clean($this->input->post('button_shape'));
                $ctaButtonSize          = $this->security->xss_clean($this->input->post('button_size'));

                //$bannerUrl              = $this->security->xss_clean($this->input->post('banner_url'));
                $bannerRedirectUrl      = $this->security->xss_clean($this->input->post('bnr_redirect_url'));
                $bannerDelay            = $this->security->xss_clean($this->input->post('bnr_delay'));

                $leadAutoResponder      = $this->security->xss_clean($this->input->post('email_responder'));
                $leadResponseId         = $this->security->xss_clean($this->input->post('responder_id'));
                $leadRedirectUrl        = $this->security->xss_clean($this->input->post('optin_redirect_url'));
                $leadDelay              = $this->security->xss_clean($this->input->post('optin_delay'));

                $leadTitle              = $this->security->xss_clean($this->input->post('lead_title'));
                $leadDesc               = $this->security->xss_clean($this->input->post('lead_desc'));
                $leadBtnTxt             = $this->security->xss_clean($this->input->post('lead_btn_txt'));

                $leadFormData           = array(
                                            'title'  => $leadTitle,
                                            'desc'   => $leadDesc,
                                            'btnTxt' => $leadBtnTxt
                                            );

				$mailChimpUrl             = $this->security->xss_clean($this->input->post('mail_chimp_form_url'));
				
                $buynowDownloadIcon     = $this->security->xss_clean($this->input->post('download_icon'));
                $buynowUrl              = $this->security->xss_clean($this->input->post('buy_now_url'));
                $buynowDelay              = $this->security->xss_clean($this->input->post('buynow_delay'));   


                $ctaButtonStyle = "hover-button-".strtolower($ctaButtonStyle);
                $ctaButtonShape = "radius-button-".strtolower($ctaButtonShape);
                $ctaButtonSize = "size-button-".strtolower($ctaButtonSize);


				$baseUrl = $this->security->xss_clean($this->input->post('baseUrl')); 
				
               
                //get buynow button img name
                $buyNowUrl = basename($buynowDownloadIcon);         // $file is set to "imgname.png"
                $getFileNameOnly = basename($buyNowUrl, ".png"); // $file is set to "imgname"
                
				
                $arrayCompaign = array(
                'uid' => $userid,
				'base_url' => $baseUrl,
                'vid' => $vid,
                'is_youtube' => $isYoutube,
				'autoplay' => $autoPlay,
				'youtube_controls' =>$playControls,
                'campaign_name'=> $campaignName,
                'landing_img' => $landingImageDefault,
                'play_icon'=>$playIcon,
                'mockup' =>$mockupType,
                'width' =>$mockupWidth ,
                'height' =>$mockupHeight,
				'mocuk_position' =>$mockupPosition,
                'action_btn_txt' =>$ctaTxt,
                'action_hover_title' => $ctaTitle,
                'btn_title_color' => $ctaButtonTitleColor ,
                'btn_bg'=>$ctaButtonBackground,
                'btn_txt_color'=>$ctaButtonTxtColor,
                'btn_cont_bg'=>$ctaButtonContainerBg,
                'btn_style'=>$ctaButtonStyle,
                'btn_shape'=>$ctaButtonShape,
                'btn_size'=>$ctaButtonSize,
                'action_delay' => $ctaDelay ,
                'action_redirect_url' =>$ctaRedirectUrl,
                'banner_redirect_url' => $bannerRedirectUrl,
                'banner_delay' =>$bannerDelay,
                'lead_responder' =>$leadAutoResponder,
                'lead_id' =>$leadResponseId,
                'lead_url' =>$leadRedirectUrl,
                'lead_delay' =>$leadDelay,
                'lead_data' => json_encode($leadFormData),
                'mailchimp_form_url' => $mailChimpUrl,
				'buynow_btn' =>$getFileNameOnly.".gif",
                'buynow_url' =>$buynowUrl,
                'buynow_delay'=>$buynowDelay
                );

                $compaignID = $this->campaign_model->insertCompaign($arrayCompaign);
                $data['errorMessage'] = $this->uploadImages($_FILES,$compaignID);
                $data['message'] = "Record has been saved Sucessfully";

            }

         }


            $this->load->view('campaign_add', $data);


		}

        // echo "<pre>";
        // print_r($this->session->userdata());
        // echo "</pre>";

	}

	function is_loggedin() {

        if ( $this->aauth->is_loggedin() ){
             return true;
        } else {
             return false;
        }
    }

    function uploadImages($arrayImg,$compaignID)
    {
        
        $config['upload_path'] = 'assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1058576';
        $config['max_width']  = '2000';
        $config['max_height']  = '2000';
        $config['overwrite']  = false;

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

                    if($file == 'upload_landing_image_url')
                    {
                        $updateArray = array(
                           'upload_landing_img' => base_url().$config['upload_path'].$getFileData['file_name']
                           
                        );    
                    }
                    else if($file =='upload_buy_now_button_url')
                    {
                        $updateArray = array(
                           'buynow_upload_img' => base_url().$config['upload_path'].$getFileData['file_name']
                           
                        );     
                    }
					else if($file =='optin_image')
                    {
                        $updateArray = array(
                           'lead_img' => base_url().$config['upload_path'].$getFileData['file_name']
                           
                        );     
                    }	
                    else if($file =='banner_url')
                    {
                        $updateArray = array(
                           'banner_url' => base_url().$config['upload_path'].$getFileData['file_name']
                           
                        );     
                    }
					else if($file =='landing_image_url')
                    {
                        $updateArray = array(
                           'landing_img_url' => base_url().$config['upload_path'].$getFileData['file_name']
                           
                        );     
                    }
					
                     $this->campaign_model->updateCampaign($updateArray,$compaignID);

                }    
            }    
            
        }
    }
}
