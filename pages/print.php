<?php
	require_once "../model/controller.php";
	require_once "../model/model.php";
	$model = new Model;
	$sql = "SELECT * FROM tbl_learners WHERE status !='Deleted' ORDER BY learner_fullname";
	$record = $model->displayRecord($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ALS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="../images/als.png">
  <link rel="stylesheet" href="../AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../AdminLTE/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="../AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="../AdminLTE/plugins/confirmation/jquery-confirm.css">
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
		table {
			font-size: 10px;
		}
		h4 {
			font-size: 13px; 
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
             <li class=""><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
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
						<li class="active">
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
	  <div class="container-fluid"  style="width:100%;" >
		  <br>
		 <div class="col-xs-12" style="margin-left:15px;">
			<img src="../images/left_logo.png" class="left_logo" width="70px" height="70px" style="margin-top:5px">
		</div>
		<div class="col-xs-12" style="">
			<div style="">
				<h4 style="margin-top:-70px"  align="center" id="line1">Department of Education</h4>
				<h4 style="margin-top:-5px"  align="center"><b>ALTERNATIVE LEARNING SYSTEM</b></h4>
				<h4 style="margin-top:-5px"  align="center"><b>MASTERLIST OF MAPPED AND POTENTIAL LEARNERS (AF1)</b></h4>
				
			</div>
			<div class="col-xs-12 pull-right" style="margin-top:-70px;">
				<img src="../images/als3.png" class="pull-right  right_logo" width="70px" height="70px" id="rl">
			</div>
			<table class="table " >
				<tbody>
					<tr>
						<td style="" width="8%"></td>
						<td style=" font-weight:bold; font-size:12px" width="6%">District</td>
						<td style="border: 1px solid black; font-weight:bold; font-size:13px; text-align:center;" width="16%">ESCALANTE II</td>
						<td style="" width="7%"></td>
						<td style="font-weight:bold; font-size:12px" width="5%">Division</td>
						<td style="border: 1px solid black; font-weight:bold; text-align:center; font-size:13px" width="15%">ESCALANTE CITY</td>
						<td style="" width="7%"></td>
						<td style=" font-weight:bold; font-size:12px" width="4%">Region</td>
						<td style="border: 1px solid black; font-weight:bold; text-align:center; font-size:13px" width="7%">IV</td>
						<td style="" width="4%"></td>
						<td style=" font-weight:bold; text-align:right; font-size:12px" width="9%">Calendar Year</td>
						<td style="border: 1px solid black; font-weight:bold; text-align:center; font-size:13px" width="5%">2019</td>
						<td style=""></td>
					</tr>
				</tbody>
			</table>
			<table class="table " style="margin-top:-12px; margin-bottom:7px">
				<tbody>
					<tr>
						<td style="" width="8%"></td>
						<td style=" font-weight:bold" width="6%"></td>
						<td style="border: 1px solid black; font-weight:bold; font-size:13px; text-align:center;" width="22%">SITION LAOYAN, BRY. DIAN-AY</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		  </div>
		  <table id="" class="table " style="border: 1px solid black;">
			  <thead style="background-color:#e2e2e2; " >
				 <th  colspan="6" style="border: 1px solid black;"></th>
				  <th colspan="2" style="text-align: center; border: 1px solid black;">COMPLETE HOME ADDRESS</th>
				 <th colspan="2" style="text-align: center; border: 1px solid black;">PARENTS</th>
				 <th colspan="3" style="border: 1px solid black;"></th>
				 <th colspan="3" style="text-align: center; border: 1px solid black;">REMARKS</th>
			  </thead>
			   <thead style="font-weight:bold; text-align:center;">
				  <th style="border: 1px solid black;" width="10%">NAME<br>(Last Name, First Name, Name<br>Extension, Middle Name</th>
				  <th style="border: 1px solid black;" width="1%">Sex (MF)</th>
				  <th style="border: 1px solid black;" width="1%">Age</th>
					<th style="border: 1px solid black;" width="2%">Date of Birth<br>(mm/dd/yyy)</th>
					<th style="border: 1px solid black;" width="5%">Mother Tongue</th>
					<th style="border: 1px solid black;">Religion</th>
					<th style="border: 1px solid black;">House No/Street/Sitio/<br>Purok</th>
					<th style="border: 1px solid black;">Occupation</th>
					<th style="border: 1px solid black;" width="10%">Father's Name (Last Name, First Name, Middle Name, Middle Name)</th>
					<th style="border: 1px solid black;" width="10%">Mother's Maiden Name (Last Name, First Name, Middle Name, Middle Name)</th>
					<th style="border: 1px solid black;">Contact Number OF Learner (if available)</th>
					<th style="border: 1px solid black;">Last Grade Level Completed in Formal School</th>
					<th style="border: 1px solid black;">Date Mapped (mm/dd/yyy)</th>
					<th style="border: 1px solid black;">Inte<br>rested<br>in<br>ALS?<br>Yes<br>or No</th>
					<th style="border: 1px solid black;">If Yes, Preferred Program</th>
					<th style="border: 1px solid black;">If already enrolled in ALS, provide date of first attendance (DOFA) and LRN</th>
			</thead>
			<tbody class="searchable">
			<?php

				if(count($record) > 0) {
					foreach($record as $value) {
						$id = $value['member_id'];
						$get_date = explode("-", $value['date_of_birth']);
						$birth_year = $get_date[0];
						$birth_month = $get_date[1];
						$birth_day = $get_date[0];
						$age = $database->getAge($birth_year, $birth_month, $birth_day);
						$date_mapped = "";
						$date_attendance = "";
						$date_of_birth = "";

						if($value['date_of_birth'] != "") {
							$date1 = explode("-", $value['date_of_birth']);
							$date_of_birth = $date1[1]."/".$date1[2]."/".$date1[0];
						}
						if($value['date_mapped'] != "") {
							$date1 = explode("-", $value['date_mapped']);
							$date_mapped = $date1[1]."/".$date1[2]."/".$date1[0];
						}
						if($value['date_attendance'] != "") {
							$date2 = explode("-", $value['date_attendance']);
							$date_attendance = $date2[1]."/".$date2[2]."/".$date2[0];
						}

						echo 
						'<tr>
							<td style="border: 1px solid black;">'.$value['learner_fullname'].'</td>
							<td style="border: 1px solid black;">'.$value['gender'].'</td>
							<td style="border: 1px solid black;">'.$age.'</td>
							<td style="border: 1px solid black;">'.$date_of_birth.'</td>
							<td style="border: 1px solid black;">'.$value['mother_toungue'].'</td>
							<td style="border: 1px solid black;">'.$value['religion'].'</td>
							<td style="border: 1px solid black;">'.$value['address'].'</td>
							<td style="border: 1px solid black;">'.$value['occupation'].'</td>
							<td style="border: 1px solid black;">'.$value['father_fullname'].'</td>
							<td style="border: 1px solid black;">'.$value['mother_fullname'].'</td>
							<td style="border: 1px solid black;">'.$value['contact_no'].'</td>
							<td style="border: 1px solid black;">'.$value['category_of_learner']." ".$value['grade_level'].'</td>
							<td style="border: 1px solid black;">'.$date_mapped.'</td>
							<td style="border: 1px solid black;">'.$value['interested_in_als'].'</td>
							<td style="border: 1px solid black;">'.$value['preferred_program'].'</td>
							<td style="border: 1px solid black;">'.$value['date_attendance']." ".$value['lrn'].'</td>
						</tr>';
					}
				}
				else {
					echo '<tr style="background-color:#d0f1e2"><td colspan="16"><h4 class="text-center">No records available.</h4></td></tr>';
				}
			?>
			</tbody>
		</table>
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
<script src="../AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<script src="../AdminLTE/dist/js/adminlte.min.js"></script>
<script src="../AdminLTE/dist/js/demo.js"></script>
<script src="../AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../AdminLTE/plugins/confirmation/jquery-confirm.js"></script>
<script>
	
</script>
</body>
</html>
