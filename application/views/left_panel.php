<?php 

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'active';
}


$userID = $this->session->userdata('id');
?>

<div class="sidebar" style="background:<?php echo $getSettings[0]->header_bg?>">    

<!--   
    
    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" 
    Tip 2: you can also add an image using data-image tag
    
-->

	<div class="sidebar-wrapper">
        <div class="logo">
            <a href="<?= base_url();?>campaignlist" class="logo-text">
				<img src="<?php echo $getSettings[0]->logo_url; ?>" width="250">
            </a>
        </div>
                   
        <ul class="nav">
            <li class="<?= echoActiveClassIfRequestMatches('campaignlist')?>">
                <a href="<?= site_url('campaignlist') ?>">
                    <i class="pe-7s-keypad"></i> 
                    <p>HOME</p>
                </a>            
            </li>
            <li class="<?=echoActiveClassIfRequestMatches('campaignadd')?>">
                <a href="<?= site_url('campaignadd') ?>">
                    <i class="pe-7s-pen"></i> 
                    <p>Add Campaign</p>
                </a>        
            </li>
			<li class="<?=echoActiveClassIfRequestMatches('wordpressplugin')?>">
                <a href="<?php echo base_url();?>assets/plugins/video_mockup.zip">
                    <i class="pe-7s-download"></i> 
                    <p>Wordpress Plugin</p>
                </a>        
            </li>
            <li class="<?=echoActiveClassIfRequestMatches('tutorials')?>">
                <a href="#">
                    <i class="pe-7s-notebook"></i> 
                    <p>How to Use</p>
                </a>        
            </li>
            <li class="<?=echoActiveClassIfRequestMatches('support')?>">
                <a href="<?php echo base_url();?>support">
                    <i class="pe-7s-tools"></i> 
                    <p>Support</p>
                </a>        
            </li>
        </ul> 
	</div>
</div>