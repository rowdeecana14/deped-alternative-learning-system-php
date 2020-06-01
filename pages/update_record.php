<?php
	require_once "../model/controller.php";
	require_once "../model/model.php";
	$model = new Model;

	if(isset($_GET['member_id'])) {
		$member_id = $_GET['member_id'];
		$sql = "SELECT * FROM tbl_learners WHERE member_id='$member_id'";
		$record = $model->displayRecord($sql);
		$date_of_birth = "";
		$date_mapped = "";
		$date_attendance = "";
		
		if($record[0]['date_of_birth'] != "") {
			$date1 = explode("-", $record[0]['date_of_birth']);
			$date_of_birth = $date1[1]."/".$date1[2]."/".$date1[0];
		}
		if($record[0]['date_mapped'] != "") {
			$date2 = explode("-", $record[0]['date_mapped']);
			$date_mapped = $date2[1]."/".$date2[2]."/".$date2[0];
		}
		if($record[0]['date_attendance'] != "") {
			$date3 = explode("-", $record[0]['date_attendance']);
			$date_attendance = $date2[1]."/".$date2[2]."/".$date2[0];
		}
	}
	else {
		header("location: dashboard.php");
	}
	
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
            <li ><a href="registration.php"><i class="fa fa-edit"></i> Registration</a></li>
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
				  <img src="../images/user_add.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px">Update Record</h4>
				  <a href="masterlist.php" class="btn btn-success btn-sm pull-right" style="margin-top:-35px"><i class="fa fa-mail-reply-all "></i> Back</a> 
			 </div>
			  <div class="panel-body">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<form id="update_form">
						<h4>Personal Data</h4>
						<hr>
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Learner Fullname</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
									<input type='hidden' class='form-control' name='member_id' value="<?php echo $member_id; ?>"  required>
									<input type='hidden' class='form-control' name='action' id='action' value="update_record"  required>
									<input type='text' class='form-control' name='learner_name' id='learner_name' placeholder="(Last Name, First Name, Name Extension, Middle Name)" value="<?php echo $record[0]['learner_fullname']; ?>" required>
								</div>
							</div>
							<div class="form-group" >
								<label>Gender:</label>
								<div class="input-group" id="inputG">
									<span class="input-group-addon"><i class="fa fa-venus-double" style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="gender" id="gender">
									<?php
										if($record[0]['gender'] == "M"){
											echo '<option value="M" selected>Male</option>
											<option value="F">Female</option>';
										}
										else {
											echo '<option value="M">Male</option>
											<option value="F" selected>Female</option>';
										}
									?>
									</select>
								  </div>

							  </div>
							<div class="form-group">
								<label>Date of Birth:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" style="color:#69AA46"></i></span>
									<input type="text" class="form-control" placeholder="Date of Birth" name="date_of_birth" id="date_of_birth" data-date-format="mm/dd/yyyy" value="<?php echo $date_of_birth; ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label>Mother Tangue</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-flag-checkered" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='mother_tangue' id='mother_tangue' placeholder="Monther Tangue" value="<?php echo $record[0]['mother_toungue']; ?>" required>
								</div>
							</div>

							<div class="form-group">
								<label>Complete Address</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-home" style="color:#69AA46"></i></span>
									<textarea class="form-control" rows="2" placeholder="(House No. / Street / Sitio / Purok)" name="address" id="address" ><?php echo $record[0]['address']; ?></textarea>
								</div>
							</div>

						</div>

						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Religion</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-university" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='religion' id='religion' placeholder="Religion" value="<?php echo $record[0]['religion']; ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label>Occupation</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-briefcase" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='occupation' id='occupation' placeholder="Occupation" value="<?php echo $record[0]['occupation']; ?>" >
								</div>
							</div>
							<div class="form-group">
								<label>Father's Fullname</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='father_name' id='father_name' placeholder="(Last Name, First Name, Middle Name)" value="<?php echo $record[0]['father_fullname']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label>Mother's Fullname</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='mother_name' id='mother_name' placeholder="(Last Name, First Name, Middle Name)" value="<?php echo $record[0]['mother_fullname']; ?>">
								</div>
							</div>
							<div class="form-group">
								<label>Contact Number</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa  fa-tty" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='contact_no' id='contact_no' placeholder="Contact Number of Learner (if available)" value="<?php echo $record[0]['contact_no']; ?>">
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
										<?php
											$list_array = array("Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12");
											foreach($list_array as $value) {
												if($record[0]['grade_level'] == $value) {
													echo '<option selected>'.$value.'</option>';
												}
												else {
													echo '<option >'.$value.'</option>';
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Category of learner</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sitemap" style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="category_of_learner" id="category_of_learner">
										<?php
											if($record[0]['category_of_learner'] == "INSCHOOL") {
												echo 
												'<option value="INSCHOOL" selected>In School</option>
												<option value="OSC">Out of School Children</option>
												<option value="OSA">Out of School Adult</option>
												<option value="OSY">Out of School Youth</option>';
											}
											else if($record[0]['category_of_learner'] == "OSC") {
												echo 
												'<option value="INSCHOOL" >In School</option>
												<option value="OSC" selected>Out of School Children</option>
												<option value="OSA">Out of School Adult</option>
												<option value="OSY">Out of School Youth</option>';
											}
											else if($record[0]['category_of_learner'] == "OSA") {
												echo 
												'<option value="INSCHOOL" >In School</option>
												<option value="OSC" >Out of School Children</option>
												<option value="OSA" selected>Out of School Adult</option>
												<option value="OSY">Out of School Youth</option>';
											}
											else {
												echo 
												'<option value="INSCHOOL" >In School</option>
												<option value="OSC" >Out of School Children</option>
												<option value="OSA">Out of School Adult</option>
												<option value="OSY" selected>Out of School Youth</option>';
											}
										?>
										
									</select>
								</div>
							</div>

							<div class="form-group">
								<label>Date Mapped:</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" style="color:#69AA46"></i></span>
									<input type="text" class="form-control" placeholder="Date Mapped" name="date_mapped" id="date_mapped" data-date-format="mm/dd/yyyy" value="<?php echo $date_mapped; ?>">
								</div>
							</div>
							<div class="form-group" >
								<label>Interested in ALS ?</label>
								<div class="input-group" id="inputG">
									<span class="input-group-addon"><i class="fa fa-hand-o-up" style="color:#69AA46"></i></span>
									<select class="form-control" style="width: 100%;" name="interested_in_als" id="interested_in_als">
										<?php
											if($record[0]['interested_in_als'] == " ") {
												echo 
												'<option value=" " selected>Select option</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>';
											}
											else if($record[0]['interested_in_als'] == "Yes") {
												echo 
												'<option value=" " >Select option</option>
												<option value="Yes" selected>Yes</option>
												<option value="No">No</option>';
											}
											else {
												echo 
												'<option value=" " >Select option</option>
												<option value="Yes" >Yes</option>
												<option value="No" selected>No</option>';
											}
										?>
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
									<input type='text' class='form-control' name='preferred_program' id='preferred_program' placeholder="If Yes, Preferred Program" value="<?php echo $record[0]['preferred_program']; ?>" >
								</div>
							</div>
							<div class="form-group">
								<label>If already enrolled in ALS provide date of first attendance (DOFA) and LRN</label>
								<br>
								<label>Date Attendance</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" style="color:#69AA46"></i></span>
									<input type="text" class="form-control" placeholder="Date Attendance" name="date_attendance" id="date_attendance" data-date-format="mm/dd/yyyy" value="<?php echo $date_attendance; ?>">

								</div>
							</div>
							<div class="form-group">
								<label>LRN</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-barcode" style="color:#69AA46"></i></span>
									<input type='text' class='form-control' name='lrn' id='lrn' placeholder="LRN" value="<?php echo $record[0]['lrn']; ?>">
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
		
		$("#update_form").on('submit',(function(e) {

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
							content: 'Record was successfully updated.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
									text: 'Okay',
									btnClass: 'btn-primary',
									keys: ['enter', 'esc'],
									action: function () {
										window.location.reload();
									}
								}
							}
						});
					}
					else {
						$.confirm({
							title: 'Error Message',
							content: 'Record not updated.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'red',
							buttons: {
								Okay: {
									text: 'Okay',
									btnClass: 'btn-primary',
									keys: ['enter', 'esc'],
									action: function () {
										window.location.reload();
									}
								}
							}
						});
					}

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
								btnClass: 'btn-primary',
								keys: ['enter', 'esc'],
								action: function () {
									window.location.reload();
								}
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
