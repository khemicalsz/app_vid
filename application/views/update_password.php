<?php $this->load->view('login_header'); ?>

<body> 
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">    
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>">Vid Invision</a>
            </div>
            <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav navbar-right">
                    <li>
                       <a href="<?= site_url('register') ?>">
                            Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="black" data-image="./assets/img/full-screen-image-3.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">                   
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
							
                            <form action="<?= base_url()?>reset/updatePassword" method="post">
                                <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                                <div class="card card-hidden">
                                    <div class="header text-center">Update Password</div>
                                    <div class="content">
										<?php echo validation_errors(); ?>
										<?php if($this->session->flashdata('error_msg')){?>
											<div class="alert alert-danger">
												<span><?php echo $this->session->flashdata('error_msg');?> </span>
											</div>
										<?php }?>
                                        <div class="form-group">
                                            <label>Add New Password <star>*</star></label>
                                            <input type="password" id="forgot-password" name="update_password" placeholder="Update Password" class="form-control" required="true" aria-required="true" aria-invalid="true">
											<input type="hidden" name="userID" value="<?php echo $userID?>">
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" name="submit" id="btn-forgot-password" class="btn btn-fill btn-warning btn-wd">Update</button>
                                    </div>
                                </div>

                            </form>  

                        </div>                    
                    </div>
                </div>
            </div>
        	
<?php $this->load->view('login_footer'); ?>