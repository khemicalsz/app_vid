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
                    <div class="card">
                        <!-- <div class="header">
                            <legend>Campaign List</legend>
                        </div> -->
                        <div class="content">
                            <div class="text-success">
                                <?= $message ?>
                                <?php echo $this->session->flashdata('successMessage');?>
                            </div>

                            <!-- Table -->
                            <div class="bootstrap-table">
                            	<div class="fixed-table-toolbar">
									<div class="bars pull-left">
										<div class="toolbar">
								            <!--        Here you can write extra buttons/actions for the toolbar              -->
								        </div>
								    </div>
									<div class="pull-left create-new-listing">
										<a href="<?php echo base_url();?>campaignadd">
											<button class="btn btn-fill btn-info">Create New Campaign</button>
										</a>
									</div>
								    
									<div class="pull-right search"><input id="filterListing" class="form-control" type="text" placeholder="Search"></div>
								</div>

								<div class="fixed-table-container" style="padding-bottom: 0px;">
									<div class="fixed-table-header" style="display: none;"><table></table></div>
									<div class="fixed-table-body">
										<div class="fixed-table-loading" style="top: 41px;">Loading, please wait...</div>
										<table id="bootstrap-table" class="table table-hover">
											<thead>
												<tr>
													<th class="text-left" style="" data-field="id">
														<div class="th-inner ">Mockup Type</div><div class="fht-cell"></div>
													</th>
													<th class="text-left" style="" data-field="id">
														<div class="th-inner ">Campaign Name</div><div class="fht-cell"></div>
													</th>
													<th style="" data-field="vid_id">
														<div class="th-inner">Number Of Views</div><div class="fht-cell"></div>
													</th>
										
													<th class="td-actions text-right" style="" data-field="actions">
														<div class="th-inner ">Actions</div><div class="fht-cell"></div>
													</th>
												</tr>
											</thead>

											<tbody class="searchableList">
												<?php
													foreach($campaigns as $key => $campaign) {
													if($campaign->is_youtube == 1)
													{
														$videoURL = "https://www.youtube.com/watch?v=".$campaign->vid;
													}
													else
													{
														$videoURL = "https://player.vimeo.com/video/".$campaign->vid;
													} 
												?>

												<tr data-index="<?= $key ?>">
													<!--<td class="bs-checkbox">
														<input data-index="0" name="btSelectItem" type="checkbox">
													</td> -->
													<td style="">
														<div class="listing-mockup" style="position:relative;">
															<img src="<?= base_url() ?>assets/img/mockups_thumb/_<?= $campaign->mockup ?>.png" width="100">
															<i class="<?= $campaign->mockup ?>-set-position icon-position-abosolute play_shadow play_animation play_btn play_large admin iPlayBtnID <?=$campaign->play_icon?>" style="color:#ffffff"></i>
														</div>
													</td>
													<td style=""><?= $campaign->campaign_name ?></td>
													<td style=""><?= $campaign->hit ?></td>
													<td class="td-actions text-right" style="">
														<a rel="tooltip" title="" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)" data-original-title="Generate HTML" data-cid="<?= $campaign->cid;?>"><i class="fa fa-image"></i></a>
														<a rel="tooltip" title="" class="btn btn-simple btn-warning btn-icon table-action wordpress" href="javascript:void(0)" data-original-title="Wordpress Code" data-toggle="modal" data-cid="<?= $campaign->cid;?>"><i class="fa fa-wordpress"></i></a>
														<a rel="tooltip" title="" class="btn btn-simple btn-warning btn-icon table-action edit" href="<?php echo base_url();?>campaignlist/editCampaign/<?= $campaign->cid ?>" data-original-title="Edit Campaign"><i class="fa fa-edit"></i></a>
														<a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove removeBtn" href="javascript:void(0)" data-original-title="Remove" data-original-title="Edit" data-toggle="modal" data-target="#playSmall31" data-record-id="<?= $campaign->cid;?>" ><i class="fa fa-remove"></i></a>
													</td>
												</tr>

												<?php
													}
												?>

											</tbody>
										</table>
									</div>
								</div>

								<div class="fixed-table-footer" style="display: none;"><table><tbody><tr></tr></tbody></table></div>

                            </div>

                            <!-- Table End -->

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <form name="deleteFrm" action="" id="deleteCampaignFrm" method="post" action="">
        	<input type="hidden" name="inputDeleteID" id="inputDeleteID" value="">
        </form>

<div id="playSmall31" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure you want to Delete</h4>
      </div>
      <div class="modal-body">
            <div class="edit_form_line">
                <button type="button" class="btn btn-default " id="deleteYes" >Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <div class="clearfix"></div>
      </div>
      
    </div>

  </div>
</div>
<div id="generateHtmlContainer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Copy Following Script</h4>
      </div>
      <div class="modal-body">
			<button class="btn btn-fill btn-info margin-bottom-10" id="copyButton">Copy to Clipboard</button>
			
           <textarea class="form-control" cols="70" rows="15" readonly id="showGenCode"></textarea>

            <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
	    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	  </div>
    </div>

  </div>
</div>

<div id="wordpressContainer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Copy Following Shortcode</h4>
      </div>
      <div class="modal-body">
           <button class="btn btn-fill btn-info margin-bottom-10" id="copyWpButton">Copy to Clipboard</button>
           <textarea class="form-control" cols="70" rows="15" readonly id="showWordpressCode"></textarea>

            <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
	    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	  </div>
    </div>

  </div>
</div>


<?php $this->load->view('dashboard_footer'); ?>