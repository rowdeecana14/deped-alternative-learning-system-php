<?php
	require_once "../model/controller.php";
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once "../include/css.php"; ?>
	<style>
		.panel-success {
			border-color: #b3f180;
		}
		hr {
			margin-top: 0px;
    		margin-bottom: 15px;
			border-top: 1px solid #afaaaa;
		}
		.form-control {
			background-color: #e2e2e2;
		}
	</style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green fixed layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand"><img src="../images/als.png" width="50px" height="50px" style="margin-top:-12px; margin-left:-18px"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
             <li ><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="registration.php"><i class="fa fa-edit"></i> Registration</a></li>
			 <li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i>  Records <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					 <li><a href="masterlist.php">Master List</a></li>
					<li class="divider"></li>
					<li><a href="inschool.php">In school</a></li>
					<li class="divider"></li>
					<li><a href="osc.php">Out of school children</a></li>
					<li class="divider"></li>
					<li><a href="osa.php">Out of school adult</a></li>
					  <li class="divider"></li>
					<li><a href="osy.php">Out of school youth</a></li>
				  </ul>
            </li>
			  <li ><a href="recyclebin.php"><i class="fa fa-flask"></i> Recycle Bin</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="light-blue user-menu">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle" >

						<span class="user-info" id="position_d">
							<img class="user-image" src="../images/Female.png" alt="Users Photo">
							<label id="fullname"><?php echo $user_data[0]['fullname']; ?></label>
						</span>

						<i class="fa fa-caret-down"></i>
					</a>

					<ul class="dropdown-menu dropdown-user" style="width:200px">
						<h5 style="margin-left: 10px;">Settings</h5>
						<li class="divider"></li>
						<li>
							<a href="myaccount.php">
								<i class="fa fa-user green"></i>
								My Account
							</a>
						</li>

						<li class="divider"></li>
						<li>
							<a href="../model/logout.php">
								<i class="fa fa-sign-out green"></i>
								Log out
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
	 
  <!-- Full Width Column -->
  <div class="content-wrapper">
	  <div class="container-fluid"  style="width:90%;" >
		  <br>
		 <div class="panel panel-success">
			  <div class="panel-heading" style="background-color:#b1e2bd">
				  <img src="../images/user_add.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px">Registration Form</h4>
				  <div class="pull-right" style="margin-top:-38px">
					  <button class="btn btn-default" id="btn_import">
						<img src="../images/upload.png" width="30px"  height="30px"> Import data
					</button>
				  </div>
			 </div>
			  <div class="panel-body">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<form id="registration_form">
						<h4>Personal Data</h4>
						<hr>
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Learner Fullname</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
									<input type='hidden' class='form-control' name='action' id='action' value="add_record"  required>
									<input type='text' class='form-control' name='learner_name' id='learner_name' placeholder="(Last Name, First Name, Name Extension, Middle Name)" required>
								</div>
							</div>
							<div class="form-group" >
								<label>Gender:</label>
								<div class="input-group" id="inputG">
									<span class="input-group-addon"><i class="fa fa-venus-double" style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="gender" id="gender">
										<option value="M">Male</option>
										<option value="F">Female</option>
									</select>
								  </div>

							  </div>
							<div class="form-group">
								<label>Date of Birth:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" style="color:#69AA46"></i></span>
									<input type="text" class="form-control" placeholder="Date of Birth" name="date_of_birth" id="date_of_birth" data-date-format="mm/dd/yyyy" required>
								</div>
							</div>
							<div class="form-group">
								<label>Mother Tangue</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-flag-checkered" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='mother_tangue' id='mother_tangue' placeholder="Monther Tangue" required>
								</div>
							</div>

							<div class="form-group">
								<label>Complete Address</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-home" style="color:#69AA46"></i></span>
									<textarea class="form-control" rows="2" placeholder="(House No. / Street / Sitio / Purok)" name="address" id="address"></textarea>
								</div>
							</div>

						</div>

						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Religion</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-university" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='religion' id='religion' placeholder="Religion" required>
								</div>
							</div>
							<div class="form-group">
								<label>Occupation</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-briefcase" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='occupation' id='occupation' placeholder="Occupation" >
								</div>
							</div>
							<div class="form-group">
								<label>Father's Fullname</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='father_name' id='father_name' placeholder="(Last Name, First Name, Middle Name)" >
								</div>
							</div>
							<div class="form-group">
								<label>Mother's Fullname</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='mother_name' id='mother_name' placeholder="(Last Name, First Name, Middle Name)" >
								</div>
							</div>
							<div class="form-group">
								<label>Contact Number</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa  fa-tty" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='contact_no' id='contact_no' placeholder="Contact Number of Learner (if available)" >
								</div>
							</div>

						</div>
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<br>
							<h4>Membership Data</h4>
							<hr>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Last Grade Level Completed in Formal School</label>
								<br>
								<label>Grade Level</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sort-numeric-asc " style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="grade_level" id="grade_level">
										<option>Grade 1</option>
										<option>Grade 2</option>
										<option>Grade 3</option>
										<option>Grade 4</option>
										<option>Grade 5</option>
										<option>Grade 6</option>
										<option>Grade 7</option>
										<option>Grade 8</option>
										<option>Grade 9</option>
										<option>Grade 10</option>
										<option>Grade 11</option>
										<option>Grade 12</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Category of learner</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sitemap" style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="category_of_learner" id="category_of_learner">
										<option value="INSCHOOL">In School</option>
										<option value="OSC">Out of School Children</option>
										<option value="OSA">Out of School Adult</option>
										<option value="OSY">Out of School Youth</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label>Date Mapped:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" style="color:#69AA46"></i></span>
									<input type="text" class="form-control" placeholder="Date Mapped" name="date_mapped" id="date_mapped" data-date-format="mm/dd/yyyy" >
								</div>
							</div>
							<div class="form-group" >
								<label>Interested in ALS ?</label>
								<div class="input-group" id="inputG">
									<span class="input-group-addon"><i class="fa fa-hand-o-up" style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="interested_in_als" id="interested_in_als">
										<option value=" ">Select option</option>
										<option value="Yes">Yes</option>
										<option value="No">No</option>
									</select>
								  </div>
							  </div>

						</div>
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<br>
								<label>If Yes, Preferred Program</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa  fa-ruble" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='preferred_program' id='preferred_program' placeholder="If Yes, Preferred Program" >
								</div>
							</div>
							<div class="form-group">
								<label>If already enrolled in ALS provide date of first attendance (DOFA) and LRN</label>
								<br>
								<label>Date Attendance</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" style="color:#69AA46"></i></span>
									<input type="text" class="form-control" placeholder="Date Attendance" name="date_attendance" id="date_attendance" data-date-format="mm/dd/yyyy" >

								</div>
							</div>
							<div class="form-group">
								<label>LRN</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-barcode" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='lrn' id='lrn' placeholder="LRN" >
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="box-footer">
								<button type="submit" class="btn btn-app bg-blue margin pull-right" >
									<i class="fa fa-save"></i> Save
								</button>
								<button type="reset" class="btn btn-app bg-red margin pull-right">
									<i class="fa fa-times-circle"></i> Cancel
								</button>
							</div>
						</div>
					</form>
					<form id="import_form" enctype="multipart/form-data">
				  		<div class="modal fade" id="import_modal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-md">
						  <div class="modal-content">
							<div class="modal-header" style="background-color: #008d4c">
							  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
							  </button>
							  <h4 class="modal-title" id="myModalLabel" style="color:white"><img src="../images/upload.png" width="35px" height="35px"> Import data</h4>
							</div>
							<div class="modal-body">
								<div class=" form-group">
									<label class="form-group input-lg"><img src="../images/csv.png" width="50px" height="50px"> Choose (.csv) file: </label>
									<div class="margin">
										<input type="hidden" name="action" value="import_data">
										<input type="file" class="form-control input-lg" id="file" style=" background-color:#e2e2e2; " name="file"  accept=".csv"  required>
									</div>
								</div>
								<br>
							</div>
							<div class="modal-footer" style="border-top: 1px solid #b3f180">
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
								<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Now</button>
							</div>
						  </div>
						</div>
					  </div>
					</form>
				</div>
			  </div>
			</div>
	</div>

    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
   <footer class="main-footer" style="border-top: 1px solid #b3f180; background-color: #d0f1e2">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2018-2019</strong> Deped Escalante City
    </div>
    <!-- /.container -->
  </footer>
</div>
<?php require_once "../include/js.php"; ?>
<script>
	$(document).ready(function() {
		
		$('#date_of_birth').datepicker({
		  autoclose: true
		});
		$('#date_mapped').datepicker({
		  autoclose: true
		});
		$('#date_attendance').datepicker({
		  autoclose: true
		});
		$("#btn_import").click(function() {
			$("#import_modal").modal("show");
		});
		
		$("#import_form").on('submit',(function(e) {
			e.preventDefault();
			$("#import_modal").modal("hide");
			var jc = $.alert({
				title: 'Please wait...',
				draggable: false,
				icon: 'fa fa-hourglass-2',
				theme: 'bootstrap',
				 type: 'green',
				content: '<br><center><img src="../images/loading.gif" width="100px" height=100px" style="opacity:0.8"></center><br>'
			});
			jc.open();
			$(".jconfirm-buttons").hide();
			$.ajax({
				url: "../model/learners.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(result){
					console.log(result);

					if(result == "true") {
						jc.close();
						$.confirm({
							title: 'Information Message',
							content: 'File was successfully imported.',
							icon: 'glyphicon glyphicon-info-sign',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-primary',
								keys: ['enter', 'esc'],
								}
							}
						});
					}
					else {
						$.confirm({
							title: 'Error Message',
							content: 'File not imported.',
							icon: 'fa fa-exclamation-circle',
							theme: 'bootstrap',
							 type: 'red',
							buttons: {
								Okay: {
									text: 'Okay',
									btnClass: 'btn-primary',
									keys: ['enter', 'esc'],
								}
							}
						});
						jc.close();
					}
				}
			});
		}));
		
		$("#registration_form").on('submit',(function(e) {

			e.preventDefault();
			$.ajax({
				url: "../model/learners.php",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					console.log(data);
					if(data == "true") {
						$.confirm({
							title: 'Information Message',
							content: 'Registration was successfully saved.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-primary',
								keys: ['enter', 'esc'],
								}
							}
						});
					}
					else if(data == "exist") {
						$.confirm({
							title: 'Information Message',
							content: 'Not save, the record is already exist.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-primary',
								keys: ['enter', 'esc'],
								}
							}
						});
					}
					else {
						$.confirm({
							title: 'Error Message',
							content: 'Registration not save.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'red',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-primary',
								keys: ['enter', 'esc'],
								}
							}
						});
					}
					$("#registration_form")[0].reset();

				},
				error: function(){
					$.confirm({
						title: 'Error Message',
						content: 'There was an error.',
						icon: 'fa fa-exclamation-triangle',
						theme: 'bootstrap',
						 type: 'red',
						buttons: {
							Okay: {
							text: 'Okay',
							btnClass: 'btn-blue',
							keys: ['enter', 'esc'],
							}
						}
					});
				}
			});
		}))
	});

</script>
</body>
</html>
