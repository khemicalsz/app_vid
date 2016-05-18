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
							<h4 class="title">User Management</h4>
                            <!-- Table -->
                            <div class="bootstrap-table">
                            	<div class="fixed-table-toolbar">
									<div class="bars pull-left">
										<div class="toolbar">
								            <!--        Here you can write extra buttons/actions for the toolbar              -->
								        </div>
								    </div>
									<div class="pull-left create-new-listing">
										<!--<a href="<?php echo base_url();?>campaignadd">
											<button class="btn btn-fill btn-info">Create New Campaign</button>
										</a>-->
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
														<div class="th-inner ">User Name</div><div class="fht-cell"></div>
													</th>
													<th class="text-left" style="" data-field="email">
														<div class="th-inner ">Email</div><div class="fht-cell"></div>
													</th>
                          <th class="text-left" style="" data-field="email">
                            <div class="th-inner ">Admin</div><div class="fht-cell"></div>
                          </th>
													<th class="text-left" style="" data-field="email">
														<div class="th-inner ">Status</div><div class="fht-cell"></div>
													</th>
													<th class="text-left" style="" data-field="action">
														<div class="th-inner ">Action</div><div class="fht-cell"></div>
													</th>
												</tr>
											</thead>

											<tbody class="searchableList">
												<?php
													//echo "<pre>";
													//print_r($userList);
													//echo "</pre>";
													foreach($userList as $key => $userList) {
												?>
												<tr data-index="<?= $key ?>">
													<td style=""><?= $userList->name ?></td>
													<td style=""><?= $userList->email ?></td>
                          <td style=""><input type="checkbox" name="vehicle" value="1" <?=$this->aauth->is_admin($userList->id) ? 'checked' : ''?> onclick="changeRole(<?=$userList->id?>)"></td>
													<td style="">Active</td> 
													<td class="td-actions text-left" style="">
														<a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove removeBtn removeUser" href="javascript:void(0)" data-original-title="Remove" data-original-title="Delete User" data-toggle="modal" data-target="#deleteUser" data-record-id="<?php echo $userList->id;?>" ><i class="fa fa-remove"></i></a>
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

        <form name="deleteFrm" action="" id="deleteUserFrm" method="post" action="">
        	<input type="hidden" name="inputDeleteID" id="inputDeleteID" value="">
        </form>

<div id="deleteUser" class="modal fade" role="dialog">
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
<div id="userInfoContainer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Info</h4>
      </div>
      <div class="modal-body" id="userInfoData">
           

            <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
	    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	  </div>
    </div>

  </div>
</div>
<script>
var varchangeRole   = "<?=base_url('Admin/changeRole')?>";
function changeRole(id){
    var obj =  [];
    obj.push({name: 'user_id' ,value: id });
    $.ajax({
        url: varchangeRole,
        type: "post",
        data:  obj,
        success: function(data){
            $('#Loader-modal').modal('toggle');
            var res = jQuery.parseJSON(data);
            if(res.status == true){
              alert(res.message);
              window.location.href = "<?=base_url('Admin')?>";

            } else {
              
              adlert(res.message);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });

}
</script>
<?php $this->load->view('dashboard_footer'); ?>