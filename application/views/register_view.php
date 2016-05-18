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
    <div class="full-page register-page" data-color="azure" data-image="./assets/img/full-screen-image-2.jpg">   
        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">    
                    <div class="col-md-8 col-md-offset-2">
                        <div class="header-text">
							<img src="<?php echo $getSettings[0]->logo_url; ?>" width="220">
                            <hr />
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="text-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                        <?= form_open('verifyregistration') ?>
                        <!-- <form action="http://localhost/vid_invision/verifyregistration" method="post"> -->
                            <div class="card card-plain">
                                <div class="content">
                                    <div class="form-group">
                                        <input type="text" id="reg-name" name="reg-name" placeholder="Username" value="<?php echo set_value('reg-name'); ?>" class="form-control" required="required" aria-required="true" aria-invalid="true">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="reg-email" name="reg-email" placeholder="Email Address" value="<?php echo set_value('reg-email'); ?>" class="form-control" email="true" required="required" aria-required="true" aria-invalid="true">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="reg-password" name="reg-password" placeholder="Password" value="<?php echo set_value('reg-password'); ?>" class="form-control" required="required" aria-required="true" aria-invalid="true">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="reg-conf-password" name="reg-conf-password" placeholder="Repeat Password" value="<?php echo set_value('reg-conf-password'); ?>" class="form-control" required="required" aria-required="true" aria-invalid="true">
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" id="btn-register" class="btn btn-fill btn-neutral btn-wd">Create Account</button>
                                </div>
                            </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
<?php $this->load->view('login_footer'); ?>