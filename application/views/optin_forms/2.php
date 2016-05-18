
<input type="hidden" name="lead_title"  value="<?php echo (isset($leadData->title) && $leadData->title!='')?$leadData->title:$optinData['title']; ?>" >
<input type="hidden" name="lead_desc" value="<?php echo (isset($leadData->desc) && $leadData->desc!='')?$leadData->desc:$optinData['desc']; ?>" >
<input type="hidden" name="lead_btn_txt" value="<?php echo (isset($leadData->btnTxt) && $leadData->btnTxt!='')?$leadData->btnTxt:$optinData['btnTxt']; ?>" >


<div id="optinforms-form3-container">
        <input type="hidden" name="listname" value="<?php $optin_id = "123"; echo $optin_id; ?>" />
        <input type="hidden" name="redirect" value="<?php $adurl = "233"; echo $adurl; ?>" />
        <div id="optinforms-form3">
            <div id="optinforms-form3-inside" style="background:#FFFFFF">
               <div id="image-preview" class="optinforms-form3-container-left">
                  <label for="image-upload" id="image-label">Choose File</label>
                  <input type="file" name="optin_image" id="image-upload" />
                  <?php 
					if(isset($leadImg) && $leadImg !='')
					{
						$imgUrl = $leadImg;
					}
					else
					{
						$imgUrl = base_url()."assets/img/landing-imgs/4.jpg";
					}
				  ?>
				  <img id="first-img" class="vid_inv_form_img" src="<?php echo $imgUrl;?>">
                </div>


                <!--optinforms-form3-container-left-->
                <div id="optinforms-form3-container-right">
                    <div class="utm_title_container">
						
                        <h2 class="vid_inv_form_title" contenteditable=true><?php echo (isset($leadData->title) && $leadData->title!='')?$leadData->title:$optinData['title']; ?></h2>
                        <h4 class="vid_inv_form_desc" contenteditable=true><?php echo (isset($leadData->desc) && $leadData->desc!='')?$leadData->desc:$optinData['desc']; ?></h4>
                    </div>
                    <input type="text" id="optinforms-form3-name-field" name="name" placeholder="Your Name" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666666">
                    <input type="text" id="optinforms-form3-email-field" name="email" placeholder="Your Email Address" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#666666">
                    <div id="optinforms-form3-button" class="vid_inv_form_btn" contenteditable=true style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#FFFFFF; background-color:#49A3FE"><?php echo (isset($leadData->btnTxt) && $leadData->btnTxt!='')?$leadData->btnTxt:$optinData['btnTxt']; ?></div>
                </div><!--optinforms-form3-container-right-->
                <div class="clear"></div>
            </div><!--optinforms-form3-inside-->
        </div><!--optinforms-form3-->
        <div class="clear"></div>
    <!-- </form> -->
</div>


<script src="<?= base_url() ?>assets/js/custom/optin_forms.js" type="text/javascript"></script>

