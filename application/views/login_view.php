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
        </div>
    </div>
</nav>


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="./assets/img/full-screen-image-3.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('verifylogin'); ?>
						<?php if($this->session->flashdata('success_msg')){?>
							<div class="alert alert-info">
								<span><?php echo $this->session->flashdata('success_msg');?> </span>
							</div>
						<?php }?>
                            <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card card-hidden">
                                <div class="header text-center" style="background-color:<?php echo $getSettings[0]->header_bg; ?>">
									<img src="<?php echo $getSettings[0]->logo_url; ?>" width="220">
								</div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>Email <star>*</star></label>
                                        <input type="email" id="login-username" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" class="form-control" email="true" required="required" aria-required="true" aria-invalid="true">
                                        <!-- <input type="text" id="login-username" name="username" placeholder="Enter Username" class="form-control"> -->
                                    </div>
                                    <div class="form-group">
                                        <label>Password <star>*</star></label>
                                        <input type="password" id="login-password" name="password" placeholder="Enter Password" class="form-control" required="true" aria-required="true" aria-invalid="true">
                                    </div>                                    
                                    <div class="form-group">
                                        <a href="<?= site_url('reset');?>">Forget Password</a>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" id="btn-login" class="btn btn-fill btn-warning btn-wd">Login</button>
                                </div>
                            </div>

                        <?= form_close() ?>

                    </div>                    
                </div>
            </div>
        </div>
    	

<?php $this->load->view('login_footer'); ?>