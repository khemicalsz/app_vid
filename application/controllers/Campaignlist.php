<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CampaignList extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('campaign_model');
        $this->load->library('session');
        $this->load->helper(array('form','directory','security'));
        $this->load->helper('security');
        $this->load->library('form_validation');
    }

	public function index() {

        $userid = $this->session->userdata('id');
        $username = $this->session->userdata('name');
        $useremail = $this->session->userdata('email');
        $statename = 'List Campaign';


		if( !$this->is_loggedin() ) {
            redirect('login', 'refresh');
		} else {
             

            if(isset($_POST['inputDeleteID']) && $_POST['inputDeleteID'] != '')
            {
                $this->campaign_model->delete_campaign($_POST['inputDeleteID']);
                $this->session->set_flashdata('successMessage', 'Campaign has been deleted Successfully');
                redirect('campaignlist');
                exit();

            }
			
			$this->load->model("settings_model");
			$settings = $this->settings_model->getSettings();	
			
            $data = array('username' => $username, 'useremail' => $useremail, 'statename' => $statename, 'message' => '','getSettings'=>$settings);
			$data['campaigns'] = $this->campaign_model->list_all();

            //echo "<pre>";
            //print_r($data['campaigns']);
            //echo "</pre>";

			$this->load->view('campaign_list', $data);
		}

	}

	
    function editCampaign($id='')
    {

        if( $id == '')
        {
            redirect('campaignlist', 'refresh');
        }    


        $userid = $this->session->userdata('id');
        $username = $this->session->userdata('name');
        $useremail = $this->session->userdata('email');

        $this->form_validation->set_rules('campaign_name', 'Compaign Name', 'required');

        $getLandingImgFromDir = directory_map('assets/img/landing-imgs');
        
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

        
        $statename = 'Edit Campaign';


        if( !$this->is_loggedin() ) {
            redirect('login', 'refresh');
        } else {
			
			$this->load->model("settings_model");
			$settings = $this->settings_model->getSettings();	
			
            $data = array('username' => $username,'errorMessage' => '', 'useremail' => $useremail, 
                        'statename' => $statename, 'message' => '','landing_imgs' => $landing_imgs,
                        'buttonsArray' =>$buttonsArray, 'optinData'=>$optinData,'getSettings'=>$settings);

            $data['campaigns'] = $this->campaign_model->list_all();
            $data['getSingleCampaign'] = $this->campaign_model->edit_campaign($id);


            if(isset($_POST['updateCampaign']))    
            {
				//echo "<pre>";
				//print_r($_POST);
				//echo "</pre>";
				//exit();
			
            if ($this->form_validation->run() == FALSE) 
            {
                // $this->load->view('myform');
                // $this->load->view('register_view');
                // echo "false";
                // echo validation_errors();
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
                    redirect('campaignlist/editCampaign/'.$id);
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
                //$landingImageUrl        = $this->security->xss_clean($this->input->post('landing_image_url'));
                $playIcon               = $this->security->xss_clean($this->input->post('play_icon'));
                $mockupType             = $this->security->xss_clean($this->input->post('mockup_type'));
                $mockupWidth            = $this->security->xss_clean($this->input->post('mockup_width'));
                $mockupHeight           = $this->security->xss_clean($this->input->post('mockup_height'));
                $ctaTxt                 = $this->security->xss_clean($this->input->post('button_text'));
                $ctaTitle               = $this->security->xss_clean($this->input->post('hover_title'));
                //$ctaHoverTxt            = $this->security->xss_clean($this->input->post('hover_text'));
                $ctaRedirectUrl         = $this->security->xss_clean($this->input->post('cta_redirect_url'));
                $ctaDelay               = $this->security->xss_clean($this->input->post('cta_delay'));

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

                $buynowDownloadIcon     = $this->security->xss_clean($this->input->post('download_icon'));
                $buynowUrl              = $this->security->xss_clean($this->input->post('buy_now_url'));   
                $buynowDelay              = $this->security->xss_clean($this->input->post('buynow_delay'));

				$mailChimpUrl             = $this->security->xss_clean($this->input->post('mail_chimp_form_url'));
				
				
                $ctaButtonStyle = "hover-button-".strtolower($ctaButtonStyle);
                $ctaButtonShape = "radius-button-".strtolower($ctaButtonShape);
                $ctaButtonSize = "size-button-".strtolower($ctaButtonSize);
               
                //get buynow button img name
                //$buyNowUrl = basename($buynowDownloadIcon);         // $file is set to "imgname.png"
                //$getFileNameOnly = basename($buyNowUrl, ".png"); // $file is set to "imgname"
                
				$baseUrl = $this->security->xss_clean($this->input->post('baseUrl')); 
				$uploadedBuyNowIcon = $this->security->xss_clean($this->input->post('uploaded_buy_now_btn')); 
				
                $arrayCompaign = array(
                'uid' => $userid,
                'vid' => $vid,
				'base_url' => $baseUrl,
                'is_youtube' => $isYoutube,
				'autoplay' => $autoPlay,
				'youtube_controls' => $playControls,
                'campaign_name'=> $campaignName,
                'landing_img' => $landingImageDefault,
                'play_icon'=>$playIcon,
                'mockup' =>$mockupType,
                'width' =>$mockupWidth ,
                'height' =>$mockupHeight,
				'mocuk_position' =>$mockupPosition,
                'action_btn_txt' =>$ctaTxt,
                'action_hover_title' => $ctaTitle,
                //'action_hover_txt' => $ctaHoverTxt ,
                'btn_bg'=>$ctaButtonBackground,
                'btn_txt_color'=>$ctaButtonTxtColor,
                'btn_cont_bg'=>$ctaButtonContainerBg,
                //'btn_style'=>$ctaButtonStyle,
               // 'btn_shape'=>$ctaButtonShape,
                //'btn_size'=>$ctaButtonSize,
                'action_delay' => $ctaDelay ,
                'action_redirect_url' =>$ctaRedirectUrl,
                //'banner_url' =>$bannerUrl,
                'banner_redirect_url' => $bannerRedirectUrl,
                'banner_delay' =>$bannerDelay,
                'lead_responder' =>$leadAutoResponder,
                'lead_id' =>$leadResponseId,
                'lead_url' =>$leadRedirectUrl,
                'lead_delay' =>$leadDelay,
                'lead_data' => json_encode($leadFormData),
				'mailchimp_form_url' => $mailChimpUrl,
                'buynow_btn' =>$buynowDownloadIcon,
                'buynow_url' =>$buynowUrl,
                'buynow_delay'=>$buynowDelay
                );
                
               
                 if($buynowDownloadIcon !='' && $uploadedBuyNowIcon == '')
                 {
                    $arrayCompaign['buynow_upload_img'] = '';
					
                 }
				 elseif($buynowDownloadIcon == '' && $uploadedBuyNowIcon != '')
                 {
                    $arrayCompaign['buynow_upload_img'] = $uploadedBuyNowIcon;
					$arrayCompaign['buynow_btn'] = '';
                 }		

				//echo "<pre>"; 
				//print_r($_POST);
				//echo "</pre>"; 
				
				//echo "<pre>"; 
				//print_r($_FILES);
				//echo "</pre>"; 
				//exit();
				
                $compaignID = $this->campaign_model->updateCampaign($arrayCompaign,$id);
                $data['errorMessage'] = $this->uploadImages($_FILES,$id);
                $data['message'] = "Record has been saved Sucessfully";
                redirect('campaignlist/editCampaign/'.$id);
                exit();

            }

         }
            $this->load->view('campaign_edit', $data);

        }
        
        
    }
	
	function support()
	{
		$this->load->model("settings_model");
		$settings = $this->settings_model->getSettings();	
		$userid = $this->session->userdata('id');
        $username = $this->session->userdata('name');
        $useremail = $this->session->userdata('email');
		$statename = 'Support';
		
		
		$data = array('username' => $username,'errorMessage' => '', 'useremail' => $useremail,'getSettings'=>$settings,'statename'=>$statename);
		
		$this->load->view('support_page', $data);
	}
	
	function tutorials(){
		$this->load->model("settings_model");
		$settings = $this->settings_model->getSettings();	
		$userid = $this->session->userdata('id');
        $username = $this->session->userdata('name');
        $useremail = $this->session->userdata('email');
		$statename = 'How to Use';
		
		
		$data = array('username' => $username,'errorMessage' => '', 'useremail' => $useremail,'getSettings'=>$settings,'statename'=>$statename);
		
		$this->load->view('tutorials', $data);
	}

    function is_loggedin() {
        if ( $this->aauth->is_loggedin() ){
             return true;
        } else {
             return false;
        }
    }


    function ajaxGenerateHtml()
    {
        if(isset($_POST['cid']) && $_POST['cid'] !='')
        {
            $getCidData = $this->campaign_model->edit_campaign($_POST['cid']);
            $data['getCidData'] = $getCidData;

            $this->load->view('generate_html',$data);
       
        } 
        
    }

    function ajaxWordpressCode()
    {
        if(isset($_POST['cid']) && $_POST['cid'] !='')
        {
            $getCidData = $this->campaign_model->edit_campaign($_POST['cid']);
			
			//echo "<pre>";
			//print_r($getCidData);
			//echo "</pre>";
            
            if(isset($getCidData[0]->is_youtube) && $getCidData[0]->is_youtube ==1)
            {
				if($getCidData[0]->youtube_controls == 1)
				{
					$showControls = 1;
				}
				else
				{
					$showControls = 0;
				}
	
                $video = "http://www.youtube.com/embed/".$getCidData[0]->vid."?rel=0&amp;autoplay=1&controls=".$showControls;
                $isYoutube = "true";
            }
            else
            {
                $video = "https://player.vimeo.com/video/".$getCidData[0]->vid."?autoplay=1";   
                $isYoutube = "false";
            }


            $data['getCidData'] = $getCidData;

            $landingImg = '';
            
            if($getCidData[0]->landing_img !='' &&  $getCidData[0]->landing_img_url =='')
            {
                $landingImg = $getCidData[0]->landing_img;
            }
            elseif($getCidData[0]->landing_img_url !='')
            {
                $landingImg = $getCidData[0]->landing_img_url;   
            }

            $buyNowBtn = '';

            if($getCidData[0]->buynow_upload_img !='' && $getCidData[0]->buynow_btn =='')
            {
                $buyNowBtn = $getCidData[0]->buynow_upload_img;
            }
            elseif($getCidData[0]->buynow_btn !='' && $getCidData[0]->buynow_upload_img =='')
            {
                $buyNowBtn = $getCidData[0]->buynow_btn;   
            }
            else
            {
                $buyNowBtn = $getCidData[0]->buynow_btn;   
            }
          
			$mockupUrl = $getCidData[0]->base_url.'assets/img/mockups/_'.$getCidData[0]->mockup.'.png';
            
            $shortCode = '';
            $shortCode .="[vidvision"; 
            $shortCode .= " cid ='".$getCidData[0]->cid."' " ;
            //$shortCode .= " uid= '".$getCidData[0]->uid."'"; 
			$shortCode .= " mockup_url= '".$mockupUrl."'"; 
            $shortCode .= " isYoutube= '".$isYoutube."' "; 
            $shortCode .= " video_url= '".$video."'"; 
			$shortCode .= " autoplay= '".$getCidData[0]->autoplay."'";
            $shortCode .= " campaign_name= '".$getCidData[0]->campaign_name."'"; 
            $shortCode .= " landing_img= '".$landingImg."'"; 
            $shortCode .= " play_icon = '".$getCidData[0]->play_icon."'"; 
            $shortCode .= " mockup = '".$getCidData[0]->mockup."'"; 
            $shortCode .= " width ='".$getCidData[0]->width."'"; 
            $shortCode .= " height = '".$getCidData[0]->height."'"; 
			$shortCode .= " mocuk_position = '".$getCidData[0]->mocuk_position."'";
            $shortCode .= " action_btn_txt = '".$getCidData[0]->action_btn_txt."'"; 
            $shortCode .= " action_hover_title = '".$getCidData[0]->action_hover_title."'"; 
            $shortCode .= " action_hover_txt = '".$getCidData[0]->action_hover_txt."'"; 
            $shortCode .= " btn_title_color = '".$getCidData[0]->btn_title_color."'"; 
            $shortCode .= " btn_bg = '".$getCidData[0]->btn_bg."'";
            $shortCode .= " btn_container_bg = '".$getCidData[0]->btn_cont_bg."'"; 
            $shortCode .= " btn_txt_color = '".$getCidData[0]->btn_txt_color."'"; 
            $shortCode .= " action_delay = '".$getCidData[0]->action_delay."'"; 
            $shortCode .= " action_redirect_url = '".$getCidData[0]->action_redirect_url."'"; 
            $shortCode .= " banner_url = '".$getCidData[0]->banner_url."'"; 
            $shortCode .= " banner_redirect_url = '".$getCidData[0]->banner_redirect_url."'";
            $shortCode .= " banner_delay = '".$getCidData[0]->banner_delay."'"; 
            
			if(!empty($getCidData[0]->lead_responder))
			{

				$leadData = json_decode($getCidData[0]->lead_data);

				if(!empty($leadData->title))
					$leadTitle = $leadData->title;
				else
					$leadTitle = "Hello";

				if(!empty($leadData->desc))
					$leadDesc = $leadData->desc;
				else
					$leadDesc = "A quick brown fox jumps over the lazy dog";

				if(!empty($leadData->desc))
					$leadBtn = $leadData->btnTxt;
				else
					$leadBtn = "Button";

				if(!empty($getCidData[0]->lead_img))
					$leadImg = base_url()."assets/uploads/".$getCidData[0]->lead_img;
				else
					$leadImg = base_url()."assets/img/lead_bg.png";

				if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'AWeber')
					$leadFormAction = 'http://www.aweber.com/scripts/addlead.pl'; 
				else if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'GetResponse')
					$leadFormAction = 'https://app.getresponse.com/add_contact_webform.html';
				else if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'Mailchimp')
					$leadFormAction = $getCidData[0]->mailchimp_form_url;
				else
					$leadFormAction = '';

				$shortCode .= " form_action = '".$leadFormAction."'"; 
				$shortCode .= " lead_title = '".$leadTitle."'"; 
				$shortCode .= " lead_desc = '".$leadDesc."'"; 
				$shortCode .= " lead_button = '".$leadBtn."'"; 
				$shortCode .= " lead_image = '".$leadImg."'"; 
				$shortCode .= " lead_responder = '".$getCidData[0]->lead_responder."'"; 
				$shortCode .= " lead_id = '".$getCidData[0]->lead_id."'"; 
				$shortCode .= " lead_url = '".$getCidData[0]->lead_url."'"; 
				$shortCode .= " lead_delay = '".$getCidData[0]->lead_delay."'"; 
			}
			
			
            $shortCode .= " buynow_btn = '".$buyNowBtn."'";
            $shortCode .= " buynow_url = '".$getCidData[0]->buynow_url."'";
            $shortCode .= " buynow_delay = '".$getCidData[0]->buynow_delay."'";
            $shortCode .=  "]";

            echo $shortCode;
            
        } 
    }

    function uploadImages($arrayImg,$compaignID)
    {
        //echo "<pre>";
        //print_r($arrayImg);
        //echo "</pre>";
        //exit();

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
                           'upload_landing_img' => $base_url().$config['upload_path'].$getFileData['file_name']
                           
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
