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
        <li><a href="<?= base_url()?>user/profile/">Profile</a></li>
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
    	<div class="row">
    		<?php echo validation_errors(); ?>
			<?php if($this->session->flashdata('EmailsuccessMessage')){?>
			<div class="alert alert-info">
				<span><?php echo $this->session->flashdata('EmailsuccessMessage');?> </span>
			</div>
			<?php }?>
			<?php if($this->session->flashdata('EmailerrorMessage')){?>
			<div class="alert alert-danger">
				<span><?php echo $this->session->flashdata('EmailerrorMessage');?> </span>
			</div>
			<?php }?>
			
           
        
			<form action="" method="post" class="form-horizontal">
				<fieldset>
					<div class="form-group">
						<label class="col-md-2 control-label">Email</label>
						<div class="col-md-6">
							<input type="email" id="changeEmail" name="change_email" placeholder="Email" class="form-control" value="<?=$this->session->userdata('email')?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-6">
							<button class="btn btn-fill btn-info" name="submitEmail" type="submit">Update</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<div class="row"><br><br></div>
    	<div class="row">
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
			<?php }?>
			
           
        
			<form action="" method="post" class="form-horizontal">
				<fieldset>
					<div class="form-group">
						<label class="col-md-2 control-label">Password</label>
						<div class="col-md-6">
							<input type="password" id="changePassword" name="change_password" placeholder="Password" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label"></label>
						<div class="col-md-6">
							<button class="btn btn-fill btn-info" name="submit" type="submit">Update</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
    </div>
</div>
</div>




</div>
</div>

<?php $this->load->view('dashboard_footer'); ?>