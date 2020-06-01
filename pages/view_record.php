<?php
	require_once "../model/controller.php";
	require_once "../model/model.php";
	$model = new Model;
	$database = new Database;

	if(isset($_GET['member_id'])) {
		$member_id = $_GET['member_id'];
		$sql = "SELECT * FROM tbl_learners WHERE member_id='$member_id'";
		$record = $model->displayRecord($sql);
		$sql = "SELECT * FROM tbl_logs WHERE member_id='$member_id'";
		$logs_data = $model->displayRecord($sql);
		$date_of_birth = "";
		$date_mapped = "";
		$date_attendance = "";
		$gender = "";
		
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
		
		if($record[0]['gender'] == "M") {
			$gender = "Male";
		}
		else {
			$gender = "Male";
		}
		
		$get_date = explode("-", $record[0]['date_of_birth']);
		$birth_year = $get_date[0];
		$birth_month = $get_date[1];
		$birth_day = $get_date[0];
		$age = $database->getAge($birth_year, $birth_month, $birth_day);
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
             <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
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
	  <div class="container-fluid"  style="width:93%;" >
		  <br>
		    <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Learner Details</a></li>
              <li><a href="#tab_2" data-toggle="tab">Record Logs</a></li>
				<a href="masterlist.php" class="btn btn-success btn-sm pull-right" style="margin-top:8px; margin-right:10px"><i class="fa fa-mail-reply-all "></i> Back</a>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               	<div class="panel panel-success">
				  <div class="panel-heading" style="background-color:#b1e2bd">
					<img src="../images/details.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px; ">Learner Details</h4>
				 </div>
				  <div class="panel-body">
					  <div class="col-md-6 col-sm-6 col-xs-6">
						<table class="table table-striped" style="font-size:14px">
						 <tr>
							<th width="30%" style="border-bottom: 1px solid #b1e2bd;">Learner Name:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['learner_fullname']; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Gender:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo  $gender; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Date of Birth:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo date("F m Y", strtotime($record[0]['date_of_birth'])); ?></td>
						  </tr>
							<tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Age:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $age. " years old"; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Mother Tangue:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['mother_toungue']; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Religion:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['religion']; ?></td>
						  </tr>
							<tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Address:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['address']; ?></td>
						  </tr>
							<tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Occupation:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['occupation']; ?></td>
						  </tr>
						 <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Father's Name:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['mother_fullname']; ?></td>
						  </tr>
							<tr style="border-bottom: 1px solid #b1e2bd;">
							<th>Mother's Name:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['father_fullname']; ?></td>
						  </tr>
							<tr style="border-bottom: 1px solid #b1e2bd;">
							<th>Contact No:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['contact_no']; ?></td>
						  </tr>
						</table>
					</div>
					  <div class="col-md-6 col-sm-6 col-xs-6">
						<table class="table table-striped" style="font-size:14px">
						 <tr>
							<th width="40%" style="border-bottom: 1px solid #b1e2bd;">Last Grade Level Completed:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['grade_level']; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Learner Category:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['category_of_learner']; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Date Mapped:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $date_mapped; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Interested in ALS:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['interested_in_als']; ?></td>
						  </tr>
						  <tr>
							<th style="border-bottom: 1px solid #b1e2bd;">Preferred Program:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['preferred_program']; ?></td>
						  </tr>
							<tr style="border-bottom: 1px solid #b1e2bd;">
							<th style="border-bottom: 1px solid #b1e2bd;">First Date Attendance:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $date_attendance; ?></td>
						  </tr>
							<tr style="border-bottom: 1px solid #b1e2bd;">
							<th style="border-bottom: 1px solid #b1e2bd;">LRN:</th>
							<td style="border-bottom: 1px solid #b1e2bd;"><?php echo $record[0]['lrn']; ?></td>
						  </tr>
					
						</table>
					</div>
				  </div>
				</div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="panel panel-success">
				  <div class="panel-heading" style="background-color:#b1e2bd">
					<img src="../images/calendar.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px; ">Record Logs</h4>
				 </div>
				  <div class="panel-body">
				  <?php
					  
					  function check($data, $array, $status) {
						  $data_return = "";
						  if($status == "Updated") {
							  if(in_array($data, $array)) {
								  $data_return = "border-bottom: 1px solid #5483e0;";
							  }
							  else {
								  $data_return = "border-bottom: 1px solid #b1e2bd;";
							  }
						  }
						  else {
							  $data_return = "border-bottom: 1px solid #b1e2bd;";
						  }
						  
						  return $data_return;
					  }
					  if(count($logs_data) > 0) {
						  foreach($logs_data as $value) {
							  $date_of_birth = "";
								$date_mapped = "";
								$date_attendance = "";
								$gender = "";

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

								if($record[0]['gender'] == "M") {
									$gender = "Male";
								}
								else {
									$gender = "Male";
								}

								$get_date = explode("-", $record[0]['date_of_birth']);
								$birth_year = $get_date[0];
								$birth_month = $get_date[1];
								$birth_day = $get_date[0];
							  	$image = "";
							  	$category_list = "";
								$age = $database->getAge($birth_year, $birth_month, $birth_day);
							  	if($value['status'] == "Added") {
									$image = "../images/added.png";
								}
							  	else {
								  	$image = "../images/updated.png";
									$category_list = explode("-", $value['category']);
								}
							  
							  
							  
							  	
					?>
					  		 <div class="col-md-12 col-sm-12 col-xs-12">
								 <hr>
								 <h4><img src="<?php echo $image; ?>" height="40px" height="40px"><?php echo " ".$value['status']." on ".date('M d, Y h:i: A',strtotime($value['date'])); ?></h4>
								 <hr>
					  		</div>
							  <div class="col-md-6 col-sm-6 col-xs-6">
								<table class="table table-striped" style="font-size:14px">
								 <tr>
									<th width="30%" style="<?php echo check(1, $category_list, $value['status']); ?>">Learner Name:</th>
									<td style="<?php echo check(1, $category_list, $value['status']); ?>"><?php echo $value['learner_fullname']; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(2, $category_list, $value['status']); ?>">Gender:</th>
									<td style="<?php echo check(2, $category_list, $value['status']); ?>"><?php echo  $gender; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(3, $category_list, $value['status']); ?>">Date of Birth:</th>
									<td style="<?php echo check(3, $category_list, $value['status']); ?>"><?php echo date("F m Y", strtotime($value['date_of_birth'])); ?></td>
								  </tr>
									<tr>
									<th style="<?php echo check(3, $category_list, $value['status']); ?>;">Age:</th>
									<td style="<?php echo check(3, $category_list, $value['status']); ?>"><?php echo $age. " years old"; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(4, $category_list, $value['status']); ?>;">Mother Tangue:</th>
									<td style="<?php echo check(4, $category_list, $value['status']); ?>;"><?php echo $value['mother_toungue']; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(5, $category_list, $value['status']); ?>;">Religion:</th>
									<td style="<?php echo check(5, $category_list, $value['status']); ?>;"><?php echo $value['religion']; ?></td>
								  </tr>
									<tr>
									<th style="<?php echo check(6, $category_list, $value['status']); ?>;">Address:</th>
									<td style="<?php echo check(6, $category_list, $value['status']); ?>;"><?php echo $value['address']; ?></td>
								  </tr>
									<tr>
									<th style="<?php echo check(7, $category_list, $value['status']); ?>;">Occupation:</th>
									<td style="<?php echo check(7, $category_list, $value['status']); ?>;"><?php echo $value['occupation']; ?></td>
								  </tr>
								 <tr>
									<th style="<?php echo check(8, $category_list, $value['status']); ?>;">Father's Name:</th>
									<td style="<?php echo check(8, $category_list, $value['status']); ?>;"><?php echo $value['father_fullname']; ?></td>
								  </tr>
								<tr >
									<th style="<?php echo check(9, $category_list, $value['status']); ?>;">Mother's Name:</th>
									<td style="<?php echo check(9, $category_list, $value['status']); ?>;"><?php echo $value['mother_fullname']; ?></td>
								  </tr>
									<tr>
									<th style="<?php echo check(10, $category_list, $value['status']); ?>;">Contact No:</th>
									<td style="<?php echo check(10, $category_list, $value['status']); ?>;"><?php echo $value['contact_no']; ?></td>
								  </tr>
								</table>
							</div>
							  <div class="col-md-6 col-sm-6 col-xs-6">
								<table class="table table-striped" style="font-size:14px">
								 <tr>
									<th width="40%" style="<?php echo check(11, $category_list, $value['status']); ?>;">Last Grade Level Completed:</th>
									<td style="<?php echo check(11, $category_list, $value['status']); ?>;"><?php echo $value['grade_level']; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(12, $category_list, $value['status']); ?>;">Learner Category:</th>
									<td style="<?php echo check(12, $category_list, $value['status']); ?>;"><?php echo $value['category_of_learner']; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(13, $category_list, $value['status']); ?>;">Date Mapped:</th>
									<td style="<?php echo check(13, $category_list, $value['status']); ?>;"><?php echo $date_mapped; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(14, $category_list, $value['status']); ?>;">Interested in ALS:</th>
									<td style="<?php echo check(14, $category_list, $value['status']); ?>;"><?php echo $value['interested_in_als']; ?></td>
								  </tr>
								  <tr>
									<th style="<?php echo check(15, $category_list, $value['status']); ?>;">Preferred Program:</th>
									<td style="<?php echo check(15, $category_list, $value['status']); ?>;"><?php echo $value['preferred_program']; ?></td>
								  </tr>
									<tr>
									<th style="<?php echo check(16, $category_list, $value['status']); ?>;">First Date Attendance:</th>
									<td style="<?php echo check(16, $category_list, $value['status']); ?>;"><?php echo $date_attendance; ?></td>
								  </tr>
									<tr >
									<th style="<?php echo check(17, $category_list, $value['status']); ?>;">LRN:</th>
									<td style="<?php echo check(17, $category_list, $value['status']); ?>;"><?php echo $value['lrn']; ?></td>
								  </tr>

								</table>
							</div>
					<?php	  } 
					  }
				  ?>
				  </div>
				</div>
              </div>
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
							title: 'Error Message',
							content: 'Registration was successfully saved.',
							icon: 'fa fa-exclamation-triangle',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-blue',
								keys: ['enter'],
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
								btnClass: 'btn-blue',
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
