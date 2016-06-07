
<?php	
	require_once('./php/UIHandler.php');
	require_once('./php/CRMDefaults.php');
    require_once('./php/LanguageHandler.php');
    include('./php/Session.php');

	$ui = \creamy\UIHandler::getInstance();
	$lh = \creamy\LanguageHandler::getInstance();
	$user = \creamy\CreamyUser::currentUser();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Goautodial</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Creamy style -->
        <link href="css/creamycrm.css" rel="stylesheet" type="text/css" />
        <!-- Circle Buttons style -->
        <link href="css/circle-buttons.css" rel="stylesheet" type="text/css" />
        <!-- Wizard Form style -->
        <link href="css/wizard-form.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap Player -->
	<link href="css/bootstrap-player.css" rel="stylesheet" type="text/css" />
        <?php print $ui->creamyThemeCSS(); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <!-- Data Tables -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<!-- Bootstrap Player -->
	<script src="js/bootstrap-player.js" type="text/javascript"></script>

        <!-- Creamy App -->
        <script src="js/app.min.js" type="text/javascript"></script>
    </head>
    <?php print $ui->creamyBody(); ?>
        <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
		<?php print $ui->creamyHeader($user); ?>
            <!-- Left side column. contains the logo and sidebar -->
			<?php print $ui->getSidebar($user->getUserId(), $user->getUserName(), $user->getUserRole(), $user->getUserAvatar()); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php $lh->translateText("settings"); ?>
                        <small><?php $lh->translateText("call_times"); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="./index.php"><i class="fa fa-phone"></i> <?php $lh->translateText("home"); ?></a></li>
                       <li><?php $lh->translateText("settings"); ?></li>
						<li class="active"><?php $lh->translateText("call_times"); ?>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <?php if ($user->userHasAdminPermission()) { ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-default">
                                <div class="box-header">
                                    <h3 class="box-title"><?php $lh->translateText("call_times"); ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table" id="recording_table">
					<?php print $ui->getListAllCallTimes(); ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
				<!-- /fila con acciones, formularios y demás -->
				<?php
					} else {
						print $ui->calloutErrorMessage($lh->translationFor("you_dont_have_permission"));
					}
				?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		<div class="bottom-menu skin-blue">
			<div class="action-button-circle" data-toggle="modal">
				<?php print $ui->getCircleButton("calltimes", "plus"); ?>
			</div>
		</div>
	<!-- Modal -->
	<div id="view-calltime-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog" style="width: 800px;">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><b>Call Time Details</b></h4>
	      </div>
	      <div class="modal-body">
			<div class="form-horizontal">
				<form id="form_calltimes" class="">
					<div class="message_box"></div>
					<div class="form-group">
						<label class="control-label col-lg-4">Call Time ID:</label>
						<div class="col-lg-8">
							<label class="control-label call-time-id hide"></label>
							<input type="text" class="form-control call-time-id-textbox" name="call_time_id">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Call Time Name:</label>
						<div class="col-lg-8">
							<input type="text" class="form-control call-time-name" name="call_time_name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Call Time Comments:</label>
						<div class="col-lg-8">
							<input type="text" class="form-control call-time-comments" name="call_time_comments">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">User Group:</label>
						<div class="col-lg-8">
							<select class="form-control call-time-user-group" name="call_time_user_group">
								<!-- <option value="ALL">ALL USER GROUPS</option> -->
								<option value="ADMIN">ADMIN - GOAUTODIAL ADMINISTRATORS</option>
								<option value="AGENTS">AGENTS - GOAUTODIAL AGENTS</option>
								<!-- <option value="SUPERVISOR">SUPERVISOR - SUPERVISOR</option> -->
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">&nbsp;</label>
						<div class="col-lg-8">
							<div class="row">
								<label class="control-label col-lg-3">Start</label>
								<label class="control-label col-lg-3">Stop</label>
								<label class="control-label col-lg-3">After Hours Audio</label>
								<div class="control-label col-lg-3">&nbsp;</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Dafault:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_default" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_default" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_default">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Sunday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_sunday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_sunday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_sunday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Monday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_monday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_monday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_monday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Tuesday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_tuesday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_tuesday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_tuesday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Wednesday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_wednesday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_wednesday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_wednesday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Thrusday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_thursday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_thursday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_thursday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Friday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_friday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_friday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_friday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Saturday:</label>
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-3">
									<input type="text" class="form-control" name="start_saturday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="stop_saturday" value="0">
								</div>
								<div class="col-lg-3">
									<input type="text" class="form-control" name="audio_saturday">
								</div>
								<div class="control-label col-lg-3">
									<a href="#">[audio chooser]</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary btn-save-calltime">Save</button>
			<button type="button" class="btn btn-primary btn-update-calltime hide" data-id="">Modify</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	    <!-- End of modal content -->
	  </div>
	</div>
	<!-- End of modal -->
	
	<!-- Modal -->
	<div id="confirmation-delete-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><b>Confirmation Box</b></h4>
	      </div>
	      <div class="modal-body">
	      	<p>Are you sure you want to delete Call Time ID: <span class="calltime-id-delete-label" data-id=""></span></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" id="delete-calltime-btn" data-id="">Yes</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	      </div>
	    </div>
	    <!-- End of modal content -->
	  </div>
	</div>
	<!-- End of modal -->
		<!-- Forms and actions -->
		<script src="js/jquery.validate.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				// $('#view-calltime-modal').modal('show');
				$('#calltimes').dataTable();

				$('.add-calltimes').click(function(){
					$('.call-time-id').text('');
					$('.call-time-name').val('');
					$('.call-time-comments').val('');
					$('.call-time-user-group option[value="ADMIN"]').attr('selected','selected');

					$('.call-time-id').addClass('hide');
					$('.call-time-id-textbox').removeClass('hide');
					$('.btn-save-calltime').removeClass('hide');
					$('.btn-update-calltime').addClass('hide');
				    $('#view-calltime-modal').modal('show');
				});
				
				$('.btn-save-calltime').click(function(){
					var form_data = $('#form_calltimes').serialize();

					$.ajax({
						url: "./php/AddCalltime.php",
						type: 'POST',
						data: { 
						      form_data : form_data,
						},
						dataType: 'json',
						success: function(data) {
						    console.log(data.result);
						    if(data.result == "success"){
						    	window.location.href = "http://localhost/CreamCRM/settingscalltimes.php";
						    }
						}
					});
					
				});

				$('.edit-calltime').click(function(){
					var call_time_id = $(this).attr('data-id');
					
					$.ajax({
						url: "./php/ViewCalltime.php",
						type: 'POST',
						data: { 
						      call_time_id : call_time_id,
						},
						dataType: 'json',
						success: function(data) {
						    // console.log(data);
						    $('.call-time-id').text(data.call_time_id);
							$('.call-time-name').val(data.call_time_name);
							$('.call-time-comments').val();
							$('.call-time-user-group option[value='+ data.user_group +']').attr('selected','selected');

							$('.call-time-id').removeClass('hide');
							$('.call-time-id-textbox').addClass('hide');
							$('.btn-save-calltime').addClass('hide');
							$('.btn-update-calltime').removeClass('hide');
							$('.btn-update-calltime').attr('data-id', data.call_time_id);
						    $('#view-calltime-modal').modal('show');
						}
					});
				});
				
				$('.delete-calltime').click(function(){
					var call_time_id = $(this).attr('data-id');
					$('.calltime-id-delete-label').text(call_time_id);
					$('.calltime-id-delete-label').attr( "data-id", call_time_id);
					$('#confirmation-delete-modal').modal('show');
				});
				
				$('#delete-calltime-btn').click(function(){
					var call_time_id = $('.calltime-id-delete-label').attr('data-id');
					$.ajax({
						url: "./php/DeleteCalltime.php",
						type: 'POST',
						data: { 
						      call_time_id : call_time_id,
						},
						dataType: 'json',
						success: function(data) {
							if(data == 1){
								var table = $('#calltimes').DataTable({
									"sAjaxSource": ""
								});
								alert('Success');
								$('#confirmation-delete-modal').modal('hide');
								table.fnDraw();
							}else{
								alert('Error');
							}
						}
					});
				});
			});
		</script>
    </body>
</html>
