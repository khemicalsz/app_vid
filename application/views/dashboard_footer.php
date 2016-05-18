            <footer class="footer">
                <div class="container-fluid">
                    <!-- <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                        </ul>
                    </nav> -->
                    <p class="copyright pull-right">
                        &copy; <?php echo date('Y');?> <a href="http://www.vidinvision.com"><?php echo $getSettings[0]->app_name;?></a>
                    </p>
                </div>
            </footer>
        </div>
    </div>


	<script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/custom_colorpicker.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?= base_url() ?>assets/js/bootstrap-checkbox-radio-switch.js"></script>
	
	<!--  Charts Plugin -->
	<script src="<?= base_url() ?>assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?= base_url() ?>assets/js/bootstrap-notify.js"></script>
    
    <!--  Google Maps Plugin    -->
   <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
	
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="<?= base_url() ?>assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Dyanmic Image upload -->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.uploadPreview.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="<?= base_url() ?>assets/js/demo.js"></script>
    <script src="<?= base_url() ?>assets/js/ivf.js"></script>

    <script src="<?= base_url() ?>assets/js/custom/campaignlist_func.js"></script>
	<script src="<?= base_url() ?>assets/js/custom/custom_func.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){
        	
        	// demo.initChartist();
        	
        	// $.notify({
         //    	icon: 'pe-7s-gift',
         //    	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."
            	
         //    },{
         //        type: 'info',
         //        timer: 4000
         //    });
            
    	});
	</script>
	
<script>
$("input[name=mockup_position]").click(function(){
				var group = "input:checkbox[name='"+$(this).prop("name")+"']";
				$(group).prop("checked",false);
				$(this).prop("checked",true);
			});
			
$(".align-checkboxes .checkbox").click(function(){
	$('.align-checkboxes .checkbox').removeClass('checked');
	$('.align-checkboxes .checkbox input:checkbox').removeAttr('checked');
	$(this).addClass('checked');
})
</script>
<?php 
if($this->uri->segment(1) == 'admin')
{
?>
<script src="<?php echo base_url()?>assets/js/custom/admin.js"></script>
<?php		
}
?>
	
</body>    
</html>