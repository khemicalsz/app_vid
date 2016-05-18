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
<li><a href="<?php echo base_url()?>admin">Users</a></li>
<li><a href="<?php echo base_url()?>admin/settings">Settings</a></li>
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
        <h4 class="title">Change Password</h4>
    </div>
    <div class="content">
			<?php echo validation_errors(); ?>
			<?php if($this->session->flashdata('successMessage')){?>
			<div class="alert alert-info">
				<span><?php echo $this->session->flashdata('successMessage');?> </span>
			</div>
			<?php }?>
			<?php if($this->session->flashdata('errorMessage')){?>
			<div class="alert alert-danger">
				<span><?php echo $this->session->flashdata('errorMessage');?> </span>
			</div>
			<?php }
			//echo "<pre>";
			//print_r($settings);
			//echo "</pre>";
			?>
			
		
     
			<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
				<fieldset>
					<div class="form-group">
						<label class="col-md-2 control-label">App Name</label>
						<div class="col-md-6">
							<input type="text" name="app_name" value="<?php echo $getSettings[0]->app_name?>" placeholder="App Name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Logo</label>
						<div class="col-md-6">
							<input type="file" name="logo" placeholder="Logo" class="form-control">
							<img src="<?php echo $getSettings[0]->logo_url?>" width="100">
						</div>
					</div>
					<div class="form-group color-picker-form-group">
                    <label class="col-md-2 control-label">Header Background Color</label>
                    <div class="col-md-6 titleColor">
                        <div class="input-group">
                            <input type="text" value="<?php echo $getSettings[0]->header_bg?>" class="form-control" name="header_bg_color"/>
                            <span class="input-group-addon" id="webBgTitleColor"><i></i></span>
                        </div>
                    </div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Register Page Path</label>
						<div class="col-md-6">
							<input type="text" name="register_page_path" value="<?php echo $getSettings[0]->register_page_path?>" placeholder="Register Page Path" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Login Page Path</label>
						<div class="col-md-6">
							<input type="text" name="login_page_path" value="<?php echo $getSettings[0]->login_path?>" placeholder="Login Page Path" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Support Email</label>
						<div class="col-md-6">
							<input type="text" name="support_email_actual" value="<?php echo $getSettings[0]->support_email_actual?>" placeholder="Support Email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Support Page Text</label>
						<div class="col-md-6">
							<textarea name="support_page_text" class="form-control"><?php echo $getSettings[0]->support_page_text?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Sender Email Name</label>
						<div class="col-md-6">
							<input type="text" name="support_email" value="<?php echo $getSettings[0]->support_email?>" placeholder="Support Email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Sender Email</label>
						<div class="col-md-6">
							<input type="text" name="sender_email" value="<?php echo $getSettings[0]->sender_email?>" placeholder="Sender Email Name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Register Subject Line</label>
						<div class="col-md-6">
							<textarea name="register_sub_line" class="form-control"><?php echo $getSettings[0]->email_text?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Emails Text After Registration</label>
						<div class="col-md-6">
							<textarea name="register_email_text" class="form-control"><?php echo $getSettings[0]->email_text?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-6">
							<button class="btn btn-fill btn-info" name="update_settings" type="submit">Update</button>
						</div>
					</div>
				</fieldset>
			</form>
    </div>
</div>
</div>




</div>
</div>

<?php $this->load->view('dashboard_footer'); ?>