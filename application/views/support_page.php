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
<div class="navbar-brand"><?= $statename ?></div>
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
<div class="col-md-12">
<div class="card" style="min-height:500px;">
    <div class="header">
        
    </div>
    <div class="content">
		<p><?php echo $getSettings[0]->support_page_text?></p>
		<p><a href="mailto:<?php echo $getSettings[0]->support_email_actual?>"><?php echo $getSettings[0]->support_email_actual?></p>
	</div>
</div>
</div>




</div>
</div>

<?php $this->load->view('dashboard_footer'); ?>