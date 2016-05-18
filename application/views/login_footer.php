<footer class="footer footer-transparent">
                <div class="container">
                    <nav class="pull-left">
                    </nav>
                    <p class="copyright pull-right">
                        &copy; <?php echo date('Y');?> <a href="<?php echo base_url()?>"><?php echo $getSettings[0]->app_name;?></a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
    
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/jquery-ui.min.js" type="text/javascript"></script> 
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	
	
	<!--  Forms Validations Plugin -->
	<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
	
	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="<?= base_url() ?>assets/js/moment.min.js"></script>
	
    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="<?= base_url() ?>assets/js/bootstrap-datetimepicker.js"></script>
    
    <!--  Select Picker Plugin -->
    <script src="<?= base_url() ?>assets/js/bootstrap-selectpicker.js"></script>
    
	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
	<script src="<?= base_url() ?>assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>
	
	<!--  Charts Plugin -->
	<script src="<?= base_url() ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?= base_url() ?>assets/js/bootstrap-notify.js"></script>
    
    <!-- Sweet Alert 2 plugin -->
	<script src="<?= base_url() ?>assets/js/sweetalert2.js"></script>
        
    <!-- Vector Map plugin -->
	<script src="<?= base_url() ?>assets/js/jquery-jvectormap.js"></script>
	
    <!--  Google Maps Plugin    -->
    <!-- // <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
	
	<!-- Wizard Plugin    -->
    <script src="<?= base_url() ?>assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Datatable Plugin    -->
    <script src="<?= base_url() ?>assets/js/bootstrap-table.js"></script>
    
    <!--  Full Calendar Plugin    -->
    <script src="<?= base_url() ?>assets/js/fullcalendar.min.js"></script>
    
    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="<?= base_url() ?>assets/js/light-bootstrap-dashboard.js"></script>
	
	<!--   Sharrre Library    -->
    <script src="<?= base_url() ?>assets/js/jquery.sharrre.js"></script>
	
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="<?= base_url() ?>assets/js/demo.js"></script>
    <!-- <script type="text/javascript" src="./as/assets/js/sha512.js"></script>
    // <script type="text/javascript" src="./as/ASLibrary/js/asengine.js"></script>
    // <script type="text/javascript" src="./as/ASLibrary/js/register.js"></script>
    // <script type="text/javascript" src="./as/ASLibrary/js/login.js"></script>
    // <script type="text/javascript" src="./as/ASLibrary/js/passwordreset.js"></script>
    // <script type="text/javascript" src="./as/assets/js/respond.min.js"></script> -->
    <script type="text/javascript">
        $().ready(function(){
            var imgIndex = 1;
            lbd.checkFullPageBackgroundImage();
            
            setInterval(function(){
                if(imgIndex <= 4) {
                    lbd.toggleBgImages(imgIndex);
                    imgIndex++;
                } else {
                    imgIndex = 1;
                    lbd.toggleBgImages(imgIndex);
                }
            }, 7500);

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
</html>