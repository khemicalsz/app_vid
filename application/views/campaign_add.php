<?php $this->load->view('dashboard_header'); ?>

<body>

<div class="wrapper">

<?php $this->load->view('left_panel'); ?>


<div class="main-panel">
<nav class="navbar navbar-default navbar-fixed">
<div class="container-fluid">    
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<div class="navbar-brand"></div>
</div>
<div class="collapse navbar-collapse">       

<?php $userID = $this->session->userdata('id'); ?>
<ul class="nav navbar-nav navbar-right">
<?php if($this->aauth->is_admin() == 1) {?>
<li><a href="<?php echo base_url()?>admin">Users</a></li>
<li><a href="<?php echo base_url()?>admin/settings">Settings</a></li>
<?php }?>  
	<li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?= $username ?>
            <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li><a href="<?= base_url()?>user/profile/<?php echo $userID?>">Profile</a></li>
      </ul>
</li>
    <li>
        <a href="<?= site_url( 'logout' ) ?>">
            Log out
        </a>
    </li> 
</ul>
</div>
</div>
</nav>
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-7">
<div class="card">
    <div class="header">
        <h4 class="title">Campaign Setup</h4>
    </div>
    <div class="content">
			<?php echo validation_errors(); ?>
			
			<?php if($this->session->flashdata('errorMessage')){?>
				<div class="alert alert-danger">
					<span><?php echo $this->session->flashdata('errorMessage');?></span>
				</div>
			<?php }?>
			
			<?php if(isset($errorMessage) && $errorMessage !=''){?>
				<div class="alert alert-danger">
					<span><?php echo $errorMessage;?></span>
				</div>
			<?php } ?>
			
            <?php if(isset($message) && $message!=''){?>
				<div class="alert alert-info">
					<span><?php echo $message?></span>
				</div>
			<?php } ?>
        <?php
            $attr = array('id' => 'campaign_form', 'class' => 'form-horizontal addCampaignFrm');
        ?>
        <?= form_open_multipart('campaignadd', $attr) ?>
            <fieldset>
                <!-- <div class="col-md-6"> -->

                     <div class="form-group">
                        <label class="col-md-3 control-label">Campaign Name</label>
                        <div class="col-md-7">
                            <input type="text" id="campaignID" name="campaign_name" placeholder="Campaign Name" class="form-control check-validation" data-filter="required" data-type="text" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Video Type <small class="recommended-red">(Recommended)</small></label>
                        <div class="col-md-7">
                            <div  class="ts-dual-buttons-container clearFixMe" id="ts-vcsc-dualbutton-9449068">

                            <div style="width: 100%;" class="ts-dual-buttons-wrapper ts-dual-buttons-center ts-dual-buttons-radius-large">
                                <a  id="youtubeID" class="ts-dual-buttons-link-left ts-dual-buttons-color-peter-river-flat">You Tube</a>
                            <span style="background: #ffffff; color: #444444;" class="ts-dual-buttons-separator">or</span>
                            <a  id="vimeoID" href="#" class="ts-dual-buttons-link-right ts-dual-buttons-color-sun-flower">Vimeo</a>
                            </div>
                            </div>
                            <div class="radio-video-type">
                                <input type="radio" name="videoType" class="radio-youtube" value="1" > Youtube
                                <input type="radio" name="videoType" class="radio-vimeo" value="0" > Vimeo
                            </div>
                        </div>
                    </div>    
                    
                    <div class="form-group" style="display:none" id="youtubeTxtField">
                        <label class="col-md-3 control-label">Youtube Video ID</label>
                        <div class="col-md-7">
                            <input type="text" id="yid_id" name="youtube_vid_id" placeholder="Youtube Video ID" class="form-control" >
								<div class="show-controls-wrapper">
									<label class="checkbox">
										<input type="checkbox" data-toggle="checkbox" name="show_controls" value="1">
										Show Player Controls
									</label>    
								</div>
                        </div>
                    </div>
                    <div class="form-group" id="vimeoTxtField" style="display:none;">
                        <label class="col-md-3 control-label">Vimeo Video ID</label>
                        <div class="col-md-7">
                            <input type="text" id="vvid_id" name="vimeo_vid_id" placeholder="Vimeo Video ID" class="form-control">
                        </div>
                    </div>
					<div class="form-group"  style="display: none">
						<label class="col-md-3 control-label">Auto Play</label>
						<div class="col-md-4">
						<label class="checkbox">
							<input type="checkbox" data-toggle="checkbox" name="auto_play" value="1">
						</label>    
						</div>
					</div>

                    <div class="form-group landing-images-container">
                        <label class="col-md-3 control-label">Thumbnail Image</label>
                        <div class="col-md-7">
                            <div  class="ts-dual-buttons-container clearFixMe" id="ts-vcsc-dualbutton-9449068">

                            <div style="width: 100%;" class="ts-dual-buttons-wrapper ts-dual-buttons-center ts-dual-buttons-radius-large">
                                <a  id="showImg" class="ts-dual-buttons-link-left ts-dual-buttons-color-peter-river-flat" data-toggle="modal" data-target="#ladingImgModal">Show</a>
                            <span style="background: #ffffff; color: #444444;" class="ts-dual-buttons-separator">or</span>
                            <a  id="addUrl" href="#" class="ts-dual-buttons-link-right ts-dual-buttons-color-sun-flower">Upload</a>
                            </div>
                            </div>  
                            <input type="hidden" name="landing_img_default" id="landingImgDefault" value=""> 
                        </div>
                    </div>
                          
                    <div class="form-group" style="display:none" id="landingImgUrlWrapper">
                        <label class="col-md-3 control-label">Upload Thumbnail <small class="recommended-red">MAX size 1MB</small></label>
                        <div class="col-md-7">
                            <input type="file" name="landing_image_url" class="form-control" placeholder="Upload Thumbnail Image" id="landingImgUrl">
                        </div>  
                    </div>                
            </fieldset>
    </div>
</div>
</div>

<!-- Mockups -->
<div class="col-md-7">
<div class="card">
    <div class="header">
        <h4 class="title">Mockups</h4>
    </div>
    <div class="content form-horizontal">
        <fieldset>

            <div class="form-group">
                <label class="col-md-3 control-label">Style</label>

                <div class="col-md-7">
                    <input type="radio" value="1"  id="mpbRadio" class="hidden" checked/>
                    <a id="mbp" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="2" name="rad_mockup" id="mbaRadio" class="hidden" />
                    <a id="mba" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="3" name="rad_mockup" id="imacRadio" class="hidden" />
                    <a id="imac" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="4" name="rad_mockup" id="mbgoldRadio" class="hidden" />
                    <a id="mbgold" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="5" name="rad_mockup" id="mbgreyRadio" class="hidden" />
                    <a id="mbgrey" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="6" name="rad_mockup" id="ipadhorRadio" class="hidden" />
                    <a id="ipadhor" href="#" class="radio-picture">&nbsp;</a>


                    <input type="radio" value="8" name="rad_mockup" id="iphonehorRadio" class="hidden" />
                    <a id="iphonehor" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="10" name="rad_mockup" id="iwatchgRadio" class="hidden" />
                    <a id="iwatchg" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="11" name="rad_mockup" id="iwatchsRadio" class="hidden" />
                    <a id="iwatchs" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="12" name="rad_mockup" id="iwatchwRadio" class="hidden" />
                    <a id="iwatchw" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="13" name="rad_mockup" id="plasma1Radio" class="hidden" />
                    <a id="plasma1" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="14" name="rad_mockup" id="plasma2Radio" class="hidden" />
                    <a id="plasma2" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="15" name="rad_mockup" id="samsungbRadio" class="hidden" />
                    <a id="samsungb" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="16" name="rad_mockup" id="samsungwRadio" class="hidden" />
                    <a id="samsungw" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="17" name="rad_mockup" id="dslrRadio" class="hidden" />
                    <a id="dslr" href="#" class="radio-picture">&nbsp;</a>

                    <input type="radio" value="18" name="rad_mockup" id="htchorRadio" class="hidden" />
                    <a id="htchor" href="#" class="radio-picture">&nbsp;</a>
					
                </div>
                <input type="hidden" name="mockup_type" value="mbp" id="mockUpType">
            </div>
            <div class="form-group play-icon-container">
                        <label class="col-md-3 control-label">Play Icon</label>
                        <div class="col-md-7">
                            <div class="edit_form_line">
                                <div class="ivf_icons">
                                    <div data-icon="arrow75" class="ivf_icon_option ivf_arrow75 play_btn play_large">
                                        <i class="ivf_play-arrow75" data-toggle="modal" data-target="#playArrow75"></i>
                                    </div>
                                    <div data-icon="key9" class="ivf_icon_option ivf_key9 play_large">
                                        <i class="ivf_play-key9" data-toggle="modal" data-target="#playKey9"></i>
                                    </div>
                                    <div data-icon="play43" class="ivf_icon_option ivf_play43 ">
                                        <i class="ivf_play-play43" data-toggle="modal" data-target="#play43Icon"></i>
                                    </div>
                                    <div data-icon="play6" class="ivf_icon_option ivf_play6 ">
                                        <i class="ivf_play-play6" data-toggle="modal" data-target="#play6Icon"></i>
                                    </div>
                                    <div data-icon="small31" class="ivf_icon_option ivf_small31 ">
                                        <i class="ivf_play-small31" data-toggle="modal" data-target="#playSmall31"></i>
                                    </div>
                                    <div data-icon="youtube12" class="ivf_icon_option ivf_youtube12 sel">
                                        <i class="ivf_play-youtube12" data-toggle="modal" data-target="#playYoutube12"></i>
                                    </div>

                                    <input type="hidden" name="play_icon" id="playIconValue" value="ivf_play-arrow75 color-icon-white size-mbp-play-icon">
                                </div>
                            </div>
                         </div>
                     </div> 
                     <div class="form-group">
                        <label class="col-md-3 control-label">Mockup Dimension</label>
                        <div class="col-md-3">
                            <input type="number" min="0" placeholder="Width" name="mockup_width" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="number" min="0" placeholder="Height" name="mockup_height" class="form-control">
                        </div>
                    </div>
					<div class="form-group align-checkboxes">
                        <label class="col-md-3 control-label">Mockup Position</label>
							<div class="col-md-2">
							<label class="checkbox">
								<input type="checkbox" name="mockup_position" data-toggle="checkbox" value="none" checked>
								None
							</label>    
							</div>
							<div class="col-md-2">							
							<label class="checkbox">
								<input type="checkbox" name="mockup_position" data-toggle="checkbox" value="left" >
								Left
							</label> 
							</div>							
							<div class="col-md-2">							
								<label class="checkbox">
									<input type="checkbox" name="mockup_position" data-toggle="checkbox" value="right" >
									Right
								</label> 
							</div>
							<div class="col-md-2">							
								<label class="checkbox">
									<input type="checkbox" name="mockup_position" data-toggle="checkbox" value="center">
									Center
								</label> 	
							</div>
                    </div>

        </fieldset>
    </div>
</div>
</div>

<!-- Call to action -->
<div class="col-md-7">
<div class="card">
    <div class="header slider">
        <h4 class="title">Call to Action <small class="small-font">(Minimun Mockup Size: 500X300)</small> <i class="pe-7s-angle-down"></i></h4>
    </div>
    <div class="content form-horizontal">
        <div class="form-group">
            <div id="btnBg" style="height:63px;padding:9px 0px;background-color: #ff9a9a">
                <div id="buttonTitle" style="float:left;">Enter Your Headline Here.... </div>
				<label id="buttonTxt" class="button-bg-primary btn btn-fill btn-info button-text-custom call-to-action-btn" style="margin:4px 6px;color: rgb(207, 192, 192);">
					<a href=""> Click me</a>
				</label>
            </div>
        </div>
        <fieldset>
             <div class="form-group">
                <label class="col-md-3 control-label">Headline</label>
                <div class="col-md-7">
                    <input type="text" name="hover_title" placeholder="Title" id="btnTitleText"  class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label ">Button Text</label>
                <div class="col-md-7">
                    <input type="text" maxlength="30" name="button_text" placeholder="Button Text" id="btnTxtInput" class="form-control">
                </div>
            </div>
                <div class="form-group">
                <label class="col-md-3 control-label">Redirect URL <small class="recommended-red">(Recommended)</small></label>
                <div class="col-md-7">
                    <input type="text" id="redirect_url" name="cta_redirect_url" placeholder="Redirect URL" class="form-control">
                </div>
            </div>
               
             <div class="form-group color-picker-form-group">
                    <label class="col-md-3 control-label">Headline Color</label>
                    <div class="col-md-7 titleColor">
                        <div class="input-group">
                            <input type="text" value=""  class="form-control" name="button_title_color"/>
                            <span class="input-group-addon" id="btnTitleColor"><i></i></span>
                        </div>
                    </div>
            </div>

             <div class="form-group">
                    <label class="col-md-3 control-label">Button Background</label>
                    <div class="col-md-7">
                        
                            <select id="btnBackground" data-option="grey" class="form-control wpb-input" name="button_background">
                                <option value="button-bg-default" class="button-bg-default">Classic Grey</option>
                                <option value="button-bg-primary" class="button-bg-primary">Classic Blue</option>
                                <option value="button-bg-info" class="button-bg-info">Classic Turquoise</option>
                                <option value="button-bg-success" class="button-bg-success">Classic Green</option>
                                <option value="button-bg-warning" class="button-bg-warning">Classic Orange</option>
                                <option value="button-bg-danger" class="button-bg-danger">Classic Red</option>
                                <option value="button-bg-inverse" class="button-bg-inverse">Classic Black</option>
                                <option value="button-bg-blue" class="button-bg-blue">Blue</option>
                                <option value="button-bg-turquoise" class="button-bg-turquoise">Turquoise</option>
                                <option value="button-bg-pink" class="button-bg-pink">Pink</option>
                                <option value="button-bg-violet" class="button-bg-violet">Violet</option>
                                <option value="button-bg-peacoc" class="button-bg-peacoc">Peacoc</option>
                                <option value="button-bg-chino" class="button-bg-chino">Chino</option>
                                <option value="button-bg-mulled-wine" class="button-bg-mulled-wine">Mulled Wine</option>
                                <option value="button-bg-vista-blue" class="button-bg-vista-blue">Vista Blue</option>
                                <option value="button-bg-black" class="button-bg-black">Black</option>
                                <option selected="selected" value="button-bg-grey" class="button-bg-grey">Grey</option>
                                <option value="button-bg-orange" class="button-bg-orange">Orange</option>
                                <option value="button-bg-sky" class="button-bg-sky">Sky</option>
                                <option value="button-bg-green" class="button-bg-green">Green</option>
                                <option value="button-bg-juicy-pink" class="button-bg-juicy-pink">Juicy pink</option>
                                <option value="button-bg-sandy-brown" class="button-bg-sandy-brown">Sandy brown</option>
                                <option value="button-bg-purple" class="button-bg-purple">Purple</option>
                                <option value="button-bg-white" class="button-bg-white">White</option>
                            </select>
                            
                        
                    </div>
            </div>
            <div class="form-group color-picker-form-group">
                    <label class="col-md-3 control-label">Button Text Color</label>
                    <div class="col-md-7 button-text">
                        <div class="input-group">    
                            <input type="text" value=""  class="form-control" name="button_text_color"/>
                            <span class="input-group-addon" id="btnTextColor"><i></i></span>
                        </div>
                    </div>
            </div>
            <div class="form-group color-picker-form-group">
                <label class="col-md-3 control-label">Layout Background</label>
                <div class="col-md-7 btnbgcontainer">
                    <div class="input-group">
                        <input type="text" value="" class="form-control" name="button_container_bg"/>
                        <span class="input-group-addon" id="btnContainerBg"><i></i></span>
                    </div>
                </div>
            </div>
			<div class="form-group">
                <label class="col-md-3 control-label">Delay</label>
                <div class="col-md-7">
                    <input type="number" min="0" placeholder="In Seconds" id="delayBtn" name="cta_delay" class="form-control">
                </div>
            </div>

        </fieldset>
    </div>
</div>
</div>

<!-- Banner -->
<div class="col-md-7">
<div class="card">
    <div class="header slider">
        <h4 class="title">Banner <small class="small-font">(Minimun Mockup Size: 500X300)</small><i class="pe-7s-angle-down"></i> </h4>
    </div>
    <div class="content form-horizontal">
        <fieldset>
            <div class="form-group">
                <label class="col-md-3 control-label">Banner Upload <small class="recommended-red">MAX size 1MB</small></label>
                <div class="col-md-7">
					<input type="file" id="bannerUrl" name="banner_url" placeholder="Banner URL" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Redirect URL <small class="recommended-red">(Recommended)</small></label>
                <div class="col-md-7">
                    <input type="text" id="bannerRedirectUrl" name="bnr_redirect_url" placeholder="Redirect URL" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Delay</label>
                <div class="col-md-7">
                    <input type="number" min="0" placeholder="In Seconds" id="delayBanner" name="bnr_delay" class="form-control">
                </div>
            </div>
        </fieldset>
    </div>
</div>
</div>


<!-- lead generation -->
<div class="col-md-7">
<div class="card">
    <div class="header slider">
        <h4 class="title">Lead Generation  <small class="small-font">(Minimun Mockup Size: 500X300)</small> <i class="pe-7s-angle-down"></i> </h4>
    </div>
    <div class="content form-horizontal">
        <fieldset>

            <?php
                $this->load->view('optin_forms/2');
            ?>
            <!-- Email AutoResponder -->
            <div class="form-group">
                <label class="col-md-3 control-label">AutoResponder</label>
                <div class="col-md-7">
                    <select name="email_responder" class="form-control" id="emailResponder">
                        <option value="">Select Any</option>
						<option value="AWeber">AWeber</option>
                        <option value="GetResponse">GetResponse</option>
						<option value="Mailchimp">Mailchimp</option>
						<!--<option value="ActiveCampaign">ActiveCampaign</option>-->
                    </select>
                </div>
            </div>

            <div class="form-group" id="responderID">
                <label class="col-md-3 control-label">ID</label>
                <div class="col-md-7">
                    <input type="text" name="responder_id" placeholder="ID" class="form-control">
                </div>
            </div>

            <div class="form-group" id="responderRedirectUrl">
                <label class="col-md-3 control-label">Redirect URL</label>
                <div class="col-md-7">
                    <input type="text" id="redirect_url" name="optin_redirect_url" placeholder="Redirect URL" class="form-control">
                </div>
            </div>
			
			<div class="form-group" id="mailChimpInput">
                <label class="col-md-3 control-label">Mailchimp Form</label>
                <div class="col-md-7">
                    <input type="text" id="mailchimpFrmUrl" name="mail_chimp_form_url" placeholder="Mailchimp Form URL" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Delay </label>
                <div class="col-md-7">
                    <input type="number" min="0" placeholder="In Seconds" name="optin_delay" class="form-control">
                </div>
            </div>

        </fieldset>
    </div>
</div>
</div>

<!-- buy now -->
<div class="col-md-7">
<div class="card">
    <div class="header slider">
        <h4 class="title">Buy Now <i class="pe-7s-angle-down"></i> </h4>
    </div>
    <div class="content form-horizontal">
        <fieldset>
            <div class="form-group">
                <label class="col-md-3 control-label">Buy Now Button</label>
                <div class="col-md-7">
                    <div  class="ts-dual-buttons-container clearFixMe" id="ts-vcsc-dualbutton-9449068">

                            <div style="width: 100%;" class="ts-dual-buttons-wrapper ts-dual-buttons-center ts-dual-buttons-radius-large">
							<a  id="showBuyNowBtn" class="ts-dual-buttons-link-left ts-dual-buttons-color-peter-river-flat" data-toggle="modal" data-target="#buyNowBtns">Show</a>
                            <span style="background: #ffffff; color: #444444;" class="ts-dual-buttons-separator">or</span>
                            <a  id="uploadBuyNowButton" href="#" class="ts-dual-buttons-link-right ts-dual-buttons-color-sun-flower">Upload</a>
                            </div>
                            </div>
                             
                    <input type="hidden" id="downloadIcon" name="download_icon">        
                </div>
            </div>
           
            <div class="form-group" style="display:none" id="uploadButtonWrapper">
                <label class="col-md-3 control-label">Upload Buy Now <small class="recommended-red">MAX size 1MB</small></label>
                <div class="col-md-7">

                    <input type="file" id="uploadBuyNow" placeholder="Upload Buy Now Button" name="upload_buy_now_button_url" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Buy Now URL <small class="recommended-red">(Recommended)</small></label>
                <div class="col-md-7">
                    <input type="text" id="buyNowUrl" placeholder="Buy Now Button URL" name="buy_now_url" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Delay</label>
                <div class="col-md-7">
                    <input type="number" min="0" placeholder="In Seconds" name="buynow_delay" id="buynowDelay" class="form-control">
                </div>
            </div>
        </fieldset>
    </div> 
</div>
</div>

<!-- save grid -->
<div class="col-md-7">
<div class="card">
    <!-- <div class="header slider">
        <h4 class="title">Buy Now <i class="pe-7s-angle-down"></i> </h4>
    </div> -->
    <div class="content form-horizontal">
        <fieldset>
			<input type="hidden" name="baseUrl" value="<?php echo base_url();?>">
            <button type="submit" class="btn btn-fill btn-info" name="saveCampaign" id="publishCampaign">Publish</button>
        </fieldset>
    </div>
</div>
</div>
<script>
    var testPreview = true;
</script>
<div class="col-md-4 card-preview">
<div class="card">
    <div class="header">
        <h4 class="title">Preview</h4>
    </div>
    <div class="content">
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="vc_col-sm-12 wpb_column vc_column_container ">
                <div class="wpb_wrapper">
                    <div class="ivf_container">
                    
                        <div class="i_video_player mbp ">

                            <img class="ivf_frame" src="<?= base_url() ?>assets/img/mockups_thumb/_mbp.png" style="max-height:284px;">
                                <div class="player_wrapper mbp" style="background: url(<?php echo base_url().'assets/img/landing-imgs/5.jpg'?>) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
                                    <i class="playerIconPreview play_shadow play_animation play_btn play_large admin iPlayBtnID" style="color:#ffffff" data-video_url=""></i>
                                    
									<div  class="button-styling">
                                        <div class="btnClose">X</div>
                                        <div style="background:rgb(186, 74, 74);" class="btnPreviewBackground">
                                            <div class="btnPreviewTitle" style="float:left;margin-top: 12px;">Click here to watch an amazing </div>
                                                <div class="btnPreview button-text-custom call-to-action-btn size-button-mini hover-button-modern" style="margin:4px 6px;background-color: rgb(79, 44, 44); color: rgb(207, 192, 192);">
                                                   <a href=""> button</a>
                                                </div>
                                        </div> 
                                       
                                    </div> 
                                     <div class="bannerPreview">
                                            <div class="bannerClose">X</div>
                                            <a href=""> </a>
                                     </div>
                                        <div class="buyNowPreview">
                                            <div class="buyNowClose">X</div>
                                            <a href=""> </a>
                                        </div>


                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <br style="clear:both">
       <!-- <button name="updatePreview" id="updatepreview" class="btn btn-fill btn-info">Update Preview</button>-->

        <input type="checkbox" id="op"></input>

        <!-- <div class="lower">
            <button for="op" type="button" id="fullpreview" class="btn btn-fill btn-info">Full Screen</button>
        </div> -->

        <div id="fullpreview" class="lower">
          <label for="op" class="btn btn-fill btn-info">Full Screen</label>
        </div>

        <div class="overlay overlay-hugeinc">
            <label for="op" id="closeFullScreen"></label>

            <div class="container container-table">
                <div class="row vertical-center-row">
                    <div class="vc_row wpb_row vc_row-fluid text-center col-md-8 col-md-offset-2">
                        <div class="vc_col-sm-12 wpb_column vc_column_container ">
                            <div class="wpb_wrapper">
                                <div class="ivf_container">
                                    <?php
                                        if(isset($_SESSION['campaign_preview']['mockup_type']) && $_SESSION['campaign_preview']['mockup_type'] !='')
                                        {
                                            $mockUp = $_SESSION['campaign_preview']['mockup_type'];
                                        }
                                        else
                                        {
                                            $mockUp = 'mbp';
                                        }
                                    ?>
                                    <div class="i_video_player mbp">
                                        <img class="ivf_frame" src="<?= base_url() ?>assets/img/mockups_thumb/_mbp.png" style="width:700px;">
                                          
                                            <div class="player_wrapper mbp" style="background: url(<?php echo base_url().'assets/img/landing-imgs/5.jpg'?>) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">                                               
                                                <i class="playerIconPreview play_shadow play_animation play_btn play_large admin  color-icon-white iPlayBtnID" style="color:#ffffff"  data-video_url=""></i>
                                                 <div class="button-styling">
                                                    <div class="btnClose">X</div>
                                                    <div style="background:rgb(186, 74, 74);" class="btnPreviewBackground">
                                                        <div class="btnPreviewTitle" style="float:left;margin-top: 12px;">Click here to watch an amazing </div>
                                                       <div class="btnPreview button-text-custom call-to-action-btn size-button-mini hover-button-modern" style="margin:4px 6px;background-color: rgb(79, 44, 44); color: rgb(207, 192, 192);">
                                                             <a href=""> button</a>
                                                       </div>
                                                    </div> 
                                                </div> 
                                                <div class="bannerPreview">
                                                    <div class="bannerClose">X</div>
                                                    <a href=""> </a>
                                                </div>
                                                 <div class="buyNowPreview">
                                                    <div class="buyNowClose">X</div>
                                                    <a href=""> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>


        </div>
        <!-- <button type="submit" class="btn btn-fill">Save</button> -->
    </div>
</div>
</div>

<?= form_close() ?>
</div>
</div>


<div id="ladingImgModal" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Select Landing Image</h4>
  </div>
  <div class="modal-body">
            <div class="content">
            <?php
                foreach ($landing_imgs as $key => $val) {
            ?>
                <div class="land-img" id="show_<?= $key?>">
                    <img src="<?= base_url() ?>assets/img/landing-imgs/<?= $val ?>">
                </div>

            <?php
                }
            ?>
            </div>       
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>

<div id="buyNowBtns" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Buy Now Buttons</h4>
  </div>
  <div class="modal-body">
        <?php
            foreach ($buttonsArray as $arr_key => $arr) {
    
                foreach ($arr as $key => $val) {
            ?>
                <div class="buy-button-img">
                    <img src="<?= base_url() ?>assets/img/buttons/<?= $val ?>.png">
                </div>

            <?php
                }
            }
            ?>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>



<div id="playArrow75" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content width-436px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Play Buttons</h4>
  </div>
  <div class="modal-body">
        <div class="edit_form_line">
            <div class="ivf_icons">
				<div class="col-md-12">
					<div data-icon="arrow75" data-icon-color="sky-blue" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
						<i class="ivf_play-arrow75 color-icon-sky-blue"></i>
					</div>
					<div data-icon="arrow75" data-icon-color="red" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
						<i class="ivf_play-arrow75 color-icon-red"></i>
					</div>
					<div data-icon="arrow75" data-icon-color="green" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
						<i class="ivf_play-arrow75 color-icon-green"></i>
					</div>
					<div data-icon="arrow75" data-icon-color="purple" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
						<i class="ivf_play-arrow75 color-icon-purple"></i>
					</div>
				</div>
				<div class="col-md-12">
					<div data-icon="arrow75" data-icon-color="yellow" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
                    <i class="ivf_play-arrow75 color-icon-yellow"></i>
                </div>
                <div data-icon="arrow75" data-icon-color="white" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
                    <i class="ivf_play-arrow75 color-icon-white"></i>
                </div>
                <div data-icon="arrow75" data-icon-color="orange" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
                    <i class="ivf_play-arrow75 color-icon-orange"></i>
                </div>
                <div data-icon="arrow75" data-icon-color="black" class="ivf_icon_option ivf_icon_modal ivf_arrow75 play_btn play_large grey-bg">
                    <i class="ivf_play-arrow75 color-icon-black"></i>
                </div>
				</div>
            </div>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
<div id="playKey9" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content width-436px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Play Buttons</h4>
  </div>
  <div class="modal-body">
        <div class="edit_form_line">
            <div class="ivf_icons">
				<div class="col-md-12">
					<div data-icon="key9" data-icon-color="sky-blue" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-sky-blue"></i>
                </div>
                <div data-icon="key9" data-icon-color="red" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-red"></i>
                </div>
                <div data-icon="key9" data-icon-color="green" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-green"></i>
                </div>
                <div data-icon="key9" data-icon-color="purple" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-purple"></i>
                </div>
				</div>
                <div class="col-md-12">
					<div data-icon="key9" data-icon-color="yellow" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-yellow"></i>
                </div>
                <div data-icon="key9" data-icon-color="white" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-white"></i>
                </div>
                <div data-icon="key9" data-icon-color="orange" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-orange"></i>
                </div>
                <div data-icon="key9" data-icon-color="black" class="ivf_icon_option ivf_icon_modal ivf_key9 play_btn play_large grey-bg">
                    <i class="ivf_play-key9 color-icon-black"></i>
                </div>
				</div>
                
            </div>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
<div id="play43Icon" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content width-436px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Play Buttons</h4>
  </div>
  <div class="modal-body">
        <div class="edit_form_line">
            <div class="ivf_icons">
				<div class="col-md-12">
					<div data-icon="play43" data-icon-color="sky-blue" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-sky-blue"></i>
                </div>
                <div data-icon="play43" data-icon-color="red" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-red"></i>
                </div>
                <div data-icon="play43" data-icon-color="green" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-green"></i>
                </div>
                <div data-icon="play43" data-icon-color="purple" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-purple"></i>
                </div>
				</div>
                <div class="col-md-12">
					<div data-icon="play43" data-icon-color="yellow" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-yellow"></i>
                </div>
                <div data-icon="play43" data-icon-color="white" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-white"></i>
                </div>
                <div data-icon="play43" data-icon-color="orange" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-orange"></i>
                </div>
                <div data-icon="play43" data-icon-color="black" class="ivf_icon_option ivf_icon_modal ivf_play43 play_btn play_large grey-bg">
                    <i class="ivf_play-play43 color-icon-black"></i>
                </div>
				</div>
                
            </div>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
<div id="play6Icon" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content width-436px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Play Buttons</h4>
  </div>
  <div class="modal-body">
        <div class="edit_form_line">
            <div class="ivf_icons">
				<div class="col-md-12">
					<div data-icon="play6" data-icon-color="sky-blue" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-sky-blue"></i>
                </div>
                <div data-icon="play6" data-icon-color="red" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-red"></i>
                </div>
                <div data-icon="play6" data-icon-color="green" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-green"></i>
                </div>
                <div data-icon="play6" data-icon-color="purple" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-purple"></i>
                </div>
				</div>
                <div class="col-md-12">
					<div data-icon="play6" data-icon-color="yellow" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-yellow"></i>
                </div>
                <div data-icon="play6" data-icon-color="white" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-white"></i>
                </div>
                <div data-icon="play6" data-icon-color="orange" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-orange"></i>
                </div>
                <div data-icon="play6" data-icon-color="black" class="ivf_icon_option ivf_icon_modal ivf_play6 play_btn play_large grey-bg">
                    <i class="ivf_play-play6 color-icon-black"></i>
                </div>
				</div>
                
            </div>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
<div id="playSmall31" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content width-436px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Play Buttons</h4>
  </div>
  <div class="modal-body">
        <div class="edit_form_line">
            <div class="ivf_icons">
				<div class="col-md-12">
					<div data-icon="small31" data-icon-color="sky-blue" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-sky-blue"></i>
                </div>
                <div data-icon="small31" data-icon-color="red" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-red"></i>
                </div>
                <div data-icon="small31" data-icon-color="green" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-green"></i>
                </div>
                <div data-icon="small31" data-icon-color="purple" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-purple"></i>
                </div>
				</div>
                <div class="col-md-12">
					<div data-icon="small31" data-icon-color="yellow" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-yellow"></i>
                </div>
                <div data-icon="small31" data-icon-color="white" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-white"></i>
                </div>
                
                <div data-icon="small31" data-icon-color="orange" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-orange"></i>
                </div>
                <div data-icon="small31" data-icon-color="black" class="ivf_icon_option ivf_icon_modal ivf_small31 play_btn play_large grey-bg">
                    <i class="ivf_play-small31 color-icon-black"></i>
                </div>
				</div>
                
            </div>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
<div id="playYoutube12" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content width-436px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Play Buttons</h4>
  </div>
  <div class="modal-body">
        <div class="edit_form_line">
            <div class="ivf_icons">
				<div class="col-md-12">
					<div data-icon="youtube12" data-icon-color="sky-blue" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-sky-blue"></i>
                </div>
                <div data-icon="youtube12" data-icon-color="red" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-red"></i>
                </div>
                <div data-icon="youtube12" data-icon-color="green" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-green"></i>
                </div>
                <div data-icon="youtube12" data-icon-color="purple" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-purple"></i>
                </div>
				</div>
                <div class="col-md-12">
					<div data-icon="youtube12" data-icon-color="yellow" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-yellow"></i>
                </div>
                <div data-icon="youtube12" data-icon-color="white" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-white"></i>
                </div>
				<div data-icon="youtube12" data-icon-color="orange" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-orange"></i>
                </div>
                <div data-icon="youtube12" data-icon-color="black" class="ivf_icon_option ivf_icon_modal ivf_youtube12 play_btn play_large grey-bg">
                    <i class="ivf_play-youtube12 color-icon-black"></i>
                </div>
				</div>
                
            </div>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
<!-- yt_player -->
<!--
<script src="https://www.youtube.com/iframe_api"></script>-->
<script src="<?= base_url() ?>assets/js/custom/yt_player.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/js/jquery.fitvids.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/js/custom/img_upload.js" type="text/javascript"></script>

<?php $this->load->view('dashboard_footer'); ?>