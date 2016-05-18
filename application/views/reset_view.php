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
            <div class="collapse navbar-collapse">
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
							
                            <form action="<?= base_url()?>reset" method="post">
                                <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                                <div class="card card-hidden">
                                    <div class="header text-center">Reset</div>
                                    <div class="content">
										<?php echo validation_errors(); ?>
										<?php if(isset($success_msg) && $success_msg !=''){?>
											<div class="alert alert-info">
												<span><?php echo $success_msg;?></span>
											</div>
										<?php }?>
                                        <div class="form-group">
                                            <label>Email address <star>*</star></label>
                                            <input type="email" id="forgot-password-email" name="reset_email" placeholder="Enter Email" class="form-control" email="true" required="true" aria-required="true" aria-invalid="true">
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" name="submit" id="btn-forgot-password" class="btn btn-fill btn-warning btn-wd">Reset Password</button>
                                    </div>
                                </div>

                            </form>  

                        </div>                    
                    </div>
                </div>
            </div>
        	
<?php $this->load->view('login_footer'); ?>