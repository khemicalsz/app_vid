<?php 

//echo "<pre>";
//print_r($getCidData[0]);
//echo "</pre>";


$mockupWidth = "width:800px";
$mockupHeight = "height:800px";
if($getCidData[0]->width !='')
{
$mockupWidth = "width:".$getCidData[0]->width."px";
}

if($getCidData[0]->height !='')
{
$mockupHeight= "height:".$getCidData[0]->height."px";
}

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
}
else
{
$video = "https://player.vimeo.com/video/".$getCidData[0]->vid."?autoplay=1";   
}

if(isset($getCidData[0]->vid) && $getCidData[0]->mocuk_position !='none' && $getCidData[0]->mocuk_position !="" )
{
	echo "<div align='".$getCidData[0]->mocuk_position."'>";
}
?>
<div class="ivf_container" style="<?= $mockupWidth?>;<?= $mockupHeight?>" id="campaign-<?=$getCidData[0]->cid;?>">
<div class="i_video_player <?= $getCidData[0]->mockup?>">

<img class="ivf_frame" src="<?= base_url() ?>assets/img/mockups/_<?=$getCidData[0]->mockup?>.png">


<?php 
if(isset($getCidData[0]->landing_img_url) && $getCidData[0]->landing_img_url !='')
{
$landingImg = base_url()."assets/uploads/".$getCidData[0]->landing_img_url;
}
else
{
$landingImg = $getCidData[0]->landing_img;   
}

if($getCidData[0]->autoplay ==0)
{
	$landingImgStyle = "style = 'background: url(".$landingImg.")no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;'";
}
else
{
	$landingImgStyle = '';
}
?>
<div class="player_wrapper <?=$getCidData[0]->mockup?>" <?php echo $landingImgStyle;?>>                             
<?php 
if($getCidData[0]->autoplay ==0)
{
?>
<i class="play_shadow play_animation play_btn play_large admin iPlayBtnID <?=$getCidData[0]->play_icon?>" data-video_url="<?= $video; ?>"></i>
<?php
}
else
{
?>
<i class="play_shadow iPlayBtnID" data-video_url="<?= $video; ?>"></i>
<?php	
}

if($getCidData[0]->action_redirect_url !='')
{
	$actionClass = '';	
	if($getCidData[0]->width <=400 )
	{
		$actionClass = "action-btn-width-400";
	}
	elseif($getCidData[0]->width > 400 && $getCidData[0]->width <=500)
	{
		$actionClass = "action-btn-width-500";
	}
	elseif($getCidData[0]->width > 500 && $getCidData[0]->width <=600)
	{
		$actionClass = "action-btn-width-600";
	}
	elseif($getCidData[0]->width > 600 && $getCidData[0]->width <=700)
	{
		$actionClass = "action-btn-width-700";
	}
	elseif($getCidData[0]->width > 700 && $getCidData[0]->width <=800)
	{
		$actionClass = "action-btn-width-700";
	}
	elseif($getCidData[0]->width > 800 && $getCidData[0]->width <=900)
	{
		$actionClass = "action-btn-width-800";
	}
	elseif($getCidData[0]->width > 900 && $getCidData[0]->width <=1000)
	{
		$actionClass = "action-btn-width-900";
	}
	
?>
<div class="button-styling <?=$actionClass?>">
<div class="btnClose">X</div>	
<div style="background:<?=$getCidData[0]->btn_cont_bg?>;" class="btnFinalBackground" data-btn-delay="<?= $getCidData[0]->action_delay?>">
<div class="btnFinalTitle" style="color:<?= $getCidData[0]->btn_title_color ;?>"><?= $getCidData[0]->action_hover_title ;?> </div>
<div class="btn btn-fill btn-info button-text-custom call-to-action-btn btnFinal button-text-custom <?= $getCidData[0]->btn_bg ;?>">
	<a style="color: <?= $getCidData[0]->btn_txt_color ;?>;" href="<?= $getCidData[0]->action_redirect_url;?>"><?= $getCidData[0]->action_btn_txt ;?></a>
</div>
</div> 
</div> 
<?php 
}
?>
<?php 
if($getCidData[0]->banner_redirect_url !='')
{
?>
<div class="bannerPreview" data-banner-delay="<?= $getCidData[0]->banner_delay?>">
<div class="bannerClose">X</div>
<a href="<?= $getCidData[0]->banner_redirect_url?>" target="_blank"> 
<img src="<?= $getCidData[0]->banner_url?>">
</a>
</div>
<?php   
}
?>
<?php 
if($getCidData[0]->buynow_url !='')
{
?>
<div class="buyNowPreview" data-buynow-delay="<?= $getCidData[0]->buynow_delay?>">
<div class="buyNowClose">X</div>
<a href="<?= $getCidData[0]->buynow_url?>" target="_blank">
<?php 
if($getCidData[0]->buynow_upload_img !='')
{
echo '<img src="'.$getCidData[0]->buynow_upload_img .'">';       
}
else
{
if($getCidData[0]->buynow_btn !='')
{
echo '<img src="'.base_url().'assets/img/buttons/'.str_replace(".gif",".png",$getCidData[0]->buynow_btn) .'">';       
}
else
{
echo '<img src="'.base_url().'assets/img/buttons/buynowwhite.png">';   
}   
}    
?> 
</a>
</div>
<?php 
}
?>


<?php
//echo "here is me: ".$getCidData[0]->lead_responder; 
if($getCidData[0]->lead_responder !='')
{

//echo "<pre>";
//print_r($getCidData[0]);
//echo "</pre>";

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
	$leadImg = $getCidData[0]->lead_img;
else
	$leadImg = base_url()."assets/img/lead_bg.png";

if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'AWeber')
	$leadFormAction = 'http://www.aweber.com/scripts/addlead.pl'; 
else if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'GetResponse')
	$leadFormAction = 'https://app.getresponse.com/add_subscriber.html';
else if (!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'Mailchimp')
	$leadFormAction = $getCidData[0]->mailchimp_form_url;
else
	$leadFormAction = '';


$optinID = $getCidData[0]->lead_id;
$adurl = $getCidData[0]->lead_url;
?>
<div id="optinforms-form3" class="optinformsWrapper" data-lead-delay="<?php echo $getCidData[0]->lead_delay;?>">
	<div class="leadClose">X</div>
	<div id="optinforms-form3-inside">
		<div class="optinforms-form3-container-left" id="image-preview" style="background-image: url(<?php echo $leadImg;?>)">
		</div>
		<div id="optinforms-form3-container-right">
			<div class="utm_title_container">
				<h2 class="vid_inv_form_title"><?php echo $leadTitle;?></h2>
				<h4 class="vid_inv_form_desc"><?php echo $leadDesc;?></h4>
			</div>
			<form action="<?php echo $leadFormAction;?>" method="post" id="leadFrm">
			<?php if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'Mailchimp')
			{?>
			
			<input type="text" placeholder="First Name" name="FNAME" class="optinforms-form3-name-field">
			<input type="text" placeholder="Your Email Address" name="EMAIL" class="optinforms-form3-name-field">
			
			<?php 
			}
			else
			{?>
			<input type="text" placeholder="Your Name" name="name" class="optinforms-form3-name-field">
			<input type="text" placeholder="Your Email Address" name="email" class="optinforms-form3-name-field">
			<?php if(!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'AWeber'){?>
				<input type="hidden" name="listname" value="<?php echo $optinID; ?>" />
				<input type="hidden" name="redirect" value="<?php echo $adurl; ?>" />
				
			<?php }else if (!empty($getCidData[0]->lead_data) && $getCidData[0]->lead_responder == 'GetResponse'){ ?>
					<input type="hidden" name="campaign_token" value="<?php echo $optinID; ?>">
					<input type="hidden" name="start_day" value="0">
			<?php }?>
			<?php }?>
			<button type="button" class="vid_inv_form_btn leadBtn" id="optinforms-form3-button"><?php echo $leadBtn;?></button>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php	
}
?>

<?php   
if(isset($getCidData[0]->vid) && $getCidData[0]->mocuk_position !='none' && $getCidData[0]->mocuk_position !="" )
{
	echo "</div>";
}
?>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php 
if($getCidData[0]->autoplay ==0)
{
?>
<script src="<?= base_url()?>assets/js/external.js"></script>
<?php 
}
else
{
?>
<script src="<?= base_url()?>assets/js/external_auto.js"></script>
<?php	
}
?>