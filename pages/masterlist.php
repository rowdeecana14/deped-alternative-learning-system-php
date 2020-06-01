<?php
	require_once "../model/controller.php";
	require_once "../model/model.php";
	$model = new Model;
	$database = new Database;
	$start = 0;
	$end = 100;
	$sql = "SELECT * FROM tbl_learners WHERE status !='Deleted' ORDER BY learner_fullname";
	$record = $model->displayRecord($sql);
	$learners = count($model->displayRecord("SELECT * FROM tbl_learners WHERE status != 'Deleted'"));

	if(isset($_GET['next'])) {
		$start = $_GET['next_start'];
		$end = $_GET['next_end'];
	}
	if(isset($_GET['previous'])) {
		$start = $_GET['previous_start'];
		$end = $_GET['previous_end'];
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
			border-top: 2px solid #afaaaa;
		}
		.form-control {
			background-color: #e2e2e2;
		}
		table {
			font-size: 12px;
		}
		#title_name {
			font-size:16px; 
			font-weight:bold;
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
			 <li class="dropdown active">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i>  Records <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
					 <li class="active"><a href="masterlist.php">Master List</a></li>
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
	  <div class="container-fluid"  style="width:100%;" >
		  <br>
		 <div class="panel panel-success">
			  <div class="panel-heading" style="background-color:#b1e2bd">
				  <img src="../images/report.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px">Masterlist Record</h4>
				  <div class="pull-right" style="margin-top:-42px">
					  <a type="button" download="masterlist.xls" onclick="return ExcellentExport.excel(this, 'excel_table', 'Masterlist');" class="btn btn-default">
						  <img src="../images/xls.png" width="30px"> Export data
					  </a>
				  </div>
			 </div>
			  <div class="panel-body">
				  <div class="col-md-9 col-sm-9 col-xs-9">
					<div class="input-group ">
						<input type="text" class="form-control" style="height:45px; background-color:#e2e2e2" placeholder="Search Here" id="filter">
						<span class="input-group-addon"><i class="fa fa-search" style="width:30px"></i></span>
					  </div>
				  </div>
					<div class="col-md-3 col-sm-3 col-xs-3">
				  </div>
				  <div class="col-md-12 col-sm-12 col-xs-12">
					  <br>
					  <hr>
						  <h3 id="title_name">MASTERLIST OF LEARNERS <p class="pull-right">Total: <?php echo $learners; ?></p></h3>
					  <hr>
					  <div class=" table-responsive">
						  <table id="" class="table table-bordered table-hover">
							  <thead style="background-color:#e2e2e2">
								  <tr>
								  	<th colspan="8"></th>
									<th>In school</th>
									<th colspan="3" class="text-center">Out of School</th>
									  <th></th>
								  </tr>
								<tr>
								  <th>Learner Name</th>
								  <th>Gender</th>
								  <th>Age</th>
									<th>Mother Tangue</th>
									<th>Religion</th>
									<th>Address</th>
									<th>Occupation</th>
									<th>Contact No</th>
									<th></th>
									<th>OSC</th>
									<th>OSA</th>
									<th>OSY</th>
									<th width="10%">Action</th>
								</tr>
							</thead>
							<tbody class="searchable">
							<?php
								$count = $start;
								$limit = 0;
								if(count($record) >= $end) {
									$limit = $end;
								}
								else {
									$limit = count($record);
								}
								if(count($record) > 0) {
									for($x = $start; $x < $limit; $x++) {
										
										$count++;
										$id = $record[$x]['member_id'];
										$get_date = explode("-", $record[$x]['date_of_birth']);
										$birth_year = $get_date[0];
										$birth_month = $get_date[1];
										$birth_day = $get_date[0];
										$age = $database->getAge($birth_year, $birth_month, $birth_day);
										$date_mapped = "";
										$date_attendance = "";
										$inschool = "";
										$osc = "";
										$osa = "";
										$osy = "";
										
										if($record[$x]['category_of_learner'] == "INSCHOOL") {
											$inschool = '<center><i class="fa fa-check"></i></center>';
										}
										else if($record[$x]['category_of_learner'] == "OSC") {
											$osc = '<center><i class="fa fa-check"></i></center>';
										}
										else if($record[$x]['category_of_learner'] == "OSA") {
											$osa = '<center><i class="fa fa-check"></i></center>';
										}
										else {
											$osy = '<center><i class="fa fa-check"></i></center>';
										}
										
										if($record[$x]['date_mapped'] != "") {
											$date1 = explode("-", $record[$x]['date_mapped']);
											$date_mapped = $date1[1]."/".$date1[2]."/".$date1[0];
										}
										if($record[$x]['date_attendance'] != "") {
											$date2 = explode("-", $record[$x]['date_attendance']);
											$date_attendance = $date2[1]."/".$date2[2]."/".$date2[0];
										}
										
										echo 
										'<tr>
											<td>'.$record[$x]['learner_fullname'].'</td>
											<td class="text-center">'.$record[$x]['gender'].'</td>
											<td class="text-center">'.$age.'</td>
											<td>'.$record[$x]['mother_toungue'].'</td>
											<td>'.$record[$x]['religion'].'</td>
											<td>'.$record[$x]['address'].'</td>
											<td>'.$record[$x]['occupation'].'</td>
											<td>'.$record[$x]['contact_no'].'</td>
											<td>'.$inschool.'</td>
											<td>'.$osc.'</td>
											<td>'.$osa.'</td>
											<td>'.$osy.'</td>
											<td>
												<div class="btn-group">
												  <a type="button" data-toggle="tooltip" data-placement="top" title="Remove record" class="btn btn-danger btn-xs" onclick=remove_record("'.$id.'")><i class="fa fa-trash"></i> </a>
												   <a href="update_record.php? member_id='.$id.'" data-toggle="tooltip" data-placement="top" title="Update record" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> </a>
												  <a href="view_record.php? member_id='.$id.'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="View profile"><i class="fa fa-user"></i> </a>
												</div
											</td>
										</tr>';
									}
								}
								else {
									echo '<tr style="background-color:#d0f1e2"><td colspan="13"><h4 class="text-center">No records available.</h4></td></tr>';
								}
							?>
							</tbody>
						</table>
						  <?php
						  	$previous_start = $start - 100;
							$previous_end = $end - 100;
						  	$next_start = $end;
							$next_end = $end + 100;
						  
						  	if($count == $end) {
								
								if($count == 100) {
									echo '
									<div class="box-footer" style="border-top: 1px solid #afaaaa;">
										<p>Showing '.$count.' of '.$learners.' entries</p>
										<form method="get" style="margin-top: -40px">
											<input type="hidden" name="next_start" value="'.$next_start.'">
											<input type="hidden" name="next_end" value="'.$next_end.'">
											<button type="submit" name="next" class="btn btn-primary pull-right margin">Next <i class="fa fa-arrow-right"></i></button>
										</form>
									</div>';
								}
								else if(count($record) > $end) {
									echo '
									<div class="box-footer" style="border-top: 1px solid #afaaaa;">
										<p>Showing '.$count.' of '.$learners.' entries</p>
										<form method="get" style="margin-top: -40px">
											<input type="hidden" name="next_start" value="'.$next_start.'">
											<input type="hidden" name="next_end" value="'.$next_end.'">
											<input type="hidden" name="previous_start" value="'.$previous_start.'">
											<input type="hidden" name="previous_end" value="'.$previous_end.'">
											<button type="submit" name="next" class="btn btn-primary pull-right margin">Next <i class="fa fa-arrow-right"></i></button>
											<button type="submit" name="previous" class="btn btn-primary pull-right margin"><i class="fa fa-arrow-left"></i> Previous </button>
										</form>
									</div>';
									
								}
								else {
									echo '
									<div class="box-footer" style="border-top: 1px solid #afaaaa;">
										<p>Showing '.$count.' of '.$learners.' entries</p>
										<form method="get" style="margin-top: -30px">
											<input type="hidden" name="previous_start" value="'.$previous_start.'">
											<input type="hidden" name="previous_end" value="'.$previous_end.'">
											<button type="submit" name="previous" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Previous </button>
										</form>
									</div>';
								}
							}
						  	else {
								if(count($record) > 0 && $previous_end > 0) {
									echo '
									<div class="box-footer" style="border-top: 1px solid #afaaaa;">
										<p>Showing '.$count.' of '.$learners.' entries</p>
										<form method="get" style="margin-top: -30px">
											<input type="hidden" name="previous_start" value="'.$previous_start.'">
											<input type="hidden" name="previous_end" value="'.$previous_end.'">
											<button type="submit" name="previous" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Previous </button>
										</form>
									</div>';
								}
								else {
									echo '
									<div class="box-footer" style="border-top: 1px solid #afaaaa;">
										<p>Showing '.$count.' of '.$learners.' entries</p>
									</div>';
								}
							}
						  ?>
						   <table id="excel_table" class="table hide" style="border: 1px solid black">
							  <thead style="background-color:#e2e2e2; " >
								  	<tr>
								  <td colspan="16"><h3>MASTERLIST OF LEARNERS</h3></td>
							  </tr>
								 <tr style="font-weight:bold; font-size: 16px;" >
									 <td  colspan="6" style="border: 1px solid black;"></td>
									  <td colspan="2" style="text-align: center; border: 1px solid black;">COMPLETE HOME ADDRESS</td>
									 <td colspan="2" style="text-align: center; border: 1px solid black;">PARENTS</td>
									 <td colspan="3" style="border: 1px solid black;"></td>
									 <td colspan="3" style="text-align: center; border: 1px solid black;">REMARKS</td>
								  </tr>
								<tr style="font-weight:bold; text-align:center;">
								  <td style="border: 1px solid black;">NAME (Last Name, First Name, Name, Extension, Middle Name)</td>
								  <td style="border: 1px solid black;">Sex (MF)</td>
								  <td style="border: 1px solid black;">Age</td>
									<td style="border: 1px solid black;">Date of Birth(mm/dd/yyy)</td>
									<td style="border: 1px solid black;">Mother Tongue</td>
									<td style="border: 1px solid black;">Religion</td>
									<td style="border: 1px solid black;">House No/Street/Sitio/Purok</td>
									<td style="border: 1px solid black;">Occupation</thd>
									<td style="border: 1px solid black;">Father's Name (Last Name, First Name, Middle Name, Middle Name)</td>
									<td style="border: 1px solid black;">Mother's Maiden Name (Last Name, First Name, Middle Name, Middle Name)</td>
									<td style="border: 1px solid black;">Contact Number OF Learner (if available)</td>
									<td style="border: 1px solid black;">Last Grade Level Completed in Formal School</td>
									<td style="border: 1px solid black;">Date Mapped (mm/dd/yyy)</td>
									<td style="border: 1px solid black;">Interested in ALS? Yes or No</td>
									<td style="border: 1px solid black;">If Yes, Preferred Program</td>
									<td style="border: 1px solid black;">If already enrolled in ALS, provide date of first attendance (DOFA) and LRN</td>
								</tr>
							</thead>
							<tbody class="searchable" id="printData">
							<?php
								$limit2 = 0;
								if(count($record) >= $end) {
									$limit2 = $end;
								}
								else {
									$limit2 = count($record);
								}
								if(count($record) > 0) {
									for($x = $start; $x < $limit2; $x++) {
										
										$id = $record[$x]['member_id'];
										$get_date = explode("-", $record[$x]['date_of_birth']);
										$birth_year = $get_date[0];
										$birth_month = $get_date[1];
										$birth_day = $get_date[0];
										$age = $database->getAge($birth_year, $birth_month, $birth_day);
										$date_mapped = "";
										$date_attendance = "";
										$date_of_birth = "";
										
										if($record[$x]['date_of_birth'] != "") {
											$date1 = explode("-", $record[$x]['date_of_birth']);
											$date_of_birth = $date1[1]."/".$date1[2]."/".$date1[0];
										}
										if($record[$x]['date_mapped'] != "") {
											$date1 = explode("-", $record[$x]['date_mapped']);
											$date_mapped = $date1[1]."/".$date1[2]."/".$date1[0];
										}
										if($record[$x]['date_attendance'] != "") {
											$date2 = explode("-", $record[$x]['date_attendance']);
											$date_attendance = $date2[1]."/".$date2[2]."/".$date2[0];
										}
										
										echo 
										'<tr>
											<td style="border: 1px solid black;">'.$record[$x]['learner_fullname'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['gender'].'</td>
											<td style="border: 1px solid black;">'.$age.'</td>
											<td style="border: 1px solid black;">'.$date_of_birth.'</td>
											<td style="border: 1px solid black;">'.$record[$x]['mother_toungue'].'</td>
											
											<td style="border: 1px solid black;">'.$record[$x]['religion'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['address'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['occupation'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['father_fullname'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['mother_fullname'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['contact_no'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['category_of_learner']." ".$record[$x]['grade_level'].'</td>
											<td style="border: 1px solid black;">'.$date_mapped.'</td>
											<td style="border: 1px solid black;">'.$record[$x]['interested_in_als'].'</td>
											<td style="border: 1px solid black;">'.$record[$x]['preferred_program'].'</td>
											<td style="border: 1px solid black;">'.$date_attendance." ".$record[$x]['lrn'].'</td>
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
		$('[data-toggle="tooltip"]').tooltip(); 
		$('#filter').keyup(function() {
				
			var rex = new RegExp($(this).val(), 'i');
			$('.searchable tr').hide();
			$('.searchable tr').filter(function() {

				return rex.test($(this).text());
			}).show();
		});
	});
	
	function printTable() {
		var response = document.getElementById("printData");
		var newWin = window.open('', 'Print-Window', 'width=1000,height=600, left=170');
		var content = '<!DOCTYPE html>\
			<html >\
			<head>\
				<meta charset="utf-8">\
				<meta name="viewport" content="width=device-width, initial-scale=1.0">\
				<meta name="description" content="">\
				<meta name="author" content="">\
				<title>Print Records</title>\
				<link rel="stylesheet" href="../AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">\
				<style>\
					table, th, td {\
						font-size:10px; \
						border: 1px solid black;\
					}\
					h4 { \
						font-size:12px; \
					} \
					h3 { \
						font-size:14px; \
						font-weight:bold; \
					} \
					hr {\
						border: 0;\
						border-top: 1px solid black;\
					}\
				</style>\
			</head>\
			<body onload="window.print()">\
			<div class="container">\
				<div class="row">\
					<div class="col-xs-12" style="margin-left:15px;">\
						<img src="../images/left_logo.png" class="left_logo" width="70px" height="70px" style="margin-top:5px">\
					</div>\
					<div class="col-xs-12" style="">\
						<div style="">\
							<h4 style="margin-top:-70px"  align="center" id="line1">Department of Education</h4>\
							<h4 style="margin-top:-5px"  align="center"><b>ALTERNATIVE LEARNING SYSTEM</b></h4>\
							<h4 style="margin-top:-5px"  align="center"><b>MASTERLIST OF MAPPED AND POTENTIAL LEARNERS (AF1)</b></h4>\
						</div>\
						<div class="col-xs-12 pull-right" style="margin-top:-70px;">\
							<img src="../images/als3.png" class="pull-right  right_logo" width="70px" height="70px" id="rl">\
						</div>\
						<table class="table " >\
							<tbody>\
								<tr>\
									<td style="" width="8%"></td>\
									<td style=" font-weight:bold; font-size:12px" width="6%">District</td>\
									<td style="border: 1px solid black; font-weight:bold; font-size:13px; text-align:center;" width="16%">ESCALANTE II</td>\
									<td style="" width="7%"></td>\
									<td style="font-weight:bold; font-size:12px" width="5%">Division</td>\
									<td style="border: 1px solid black; font-weight:bold; text-align:center; font-size:13px" width="15%">ESCALANTE CITY</td>\
									<td style="" width="7%"></td>\
									<td style=" font-weight:bold; font-size:12px" width="4%">Region</td>\
									<td style="border: 1px solid black; font-weight:bold; text-align:center; font-size:13px" width="7%">IV</td>\
									<td style="" width="4%"></td>\
									<td style=" font-weight:bold; text-align:right; font-size:12px" width="9%">Calendar Year</td>\
									<td style="border: 1px solid black; font-weight:bold; text-align:center; font-size:13px" width="5%">2019</td>\
									<td style=""></td>\
								</tr>\
							</tbody>\
						</table>\
						<table class="table " style="margin-top:-12px; margin-bottom:7px">\
							<tbody>\
								<tr>\
									<td style="" width="8%"></td>\
									<td style=" font-weight:bold" width="6%"></td>\
									<td style="border: 1px solid black; font-weight:bold; font-size:13px; text-align:center;" width="22%">SITION LAOYAN, BRY. DIAN-AY</td>\
									<td></td>\
								</tr>\
							</tbody>\
						</table>\
					  </div>\
					  <table id="" class="table " style="border: 1px solid black;">\
						  <thead style="background-color:#e2e2e2; " >\
							 <th  colspan="6" style="border: 1px solid black;"></th>\
							  <th colspan="2" style="text-align: center; border: 1px solid black;">COMPLETE HOME ADDRESS</th>\
							 <th colspan="2" style="text-align: center; border: 1px solid black;">PARENTS</th>\
							 <th colspan="3" style="border: 1px solid black;"></th>\
							 <th colspan="3" style="text-align: center; border: 1px solid black;">REMARKS</th>\
						  </thead>\
						   <thead style="font-weight:bold; text-align:center;">\
							  <th style="border: 1px solid black;" width="10%">NAME</th>\
							  <th style="border: 1px solid black;" width="1%">Sex (MF)</th>\
							  <th style="border: 1px solid black;" width="1%">Age</th>\
								<th style="border: 1px solid black;" width="2%">Date of Birth</th>\
								<th style="border: 1px solid black;" width="5%">Mother Tongue</th>\
								<th style="border: 1px solid black;">Religion</th>\
								<th style="border: 1px solid black;">Address</th>\
								<th style="border: 1px solid black;">Occupation</th>\
								<th style="border: 1px solid black;" width="10%">Fathers Name</th>\
								<th style="border: 1px solid black;" width="10%">Mothers Maiden Name</th>\
								<th style="border: 1px solid black;">Contact Number</th>\
								<th style="border: 1px solid black;">Last Grade Level Completed</th>\
								<th style="border: 1px solid black;">Date Mapped</th>\
								<th style="border: 1px solid black;">Inte<br>rested<br>in<br>ALS?<br>Yes<br>or No</th>\
								<th style="border: 1px solid black;">Preferred Program</th>\
								<th style="border: 1px solid black;">DOFA and LRN</th>\
						</thead>\
						<tbody class="searchable">' + response.innerHTML + '</tbody>\
					</table>\
				</div>\
			</div>\
			</body>\
			</html>';

		newWin.document.open();
		newWin.document.write(content);
		newWin.document.close();

		 //setTimeout(function() {
		//	 newWin.close();
		// }, 2000);
	}

	function remove_record(member_id) {
		$.confirm({
			title: 'Confirmation Message',
			content: 'Are you sure you want to remove this record?',
			theme: 'bootstrap',
			 type: 'orange',
			buttons: {
				Cancel: {
					text: 'Cancel',
					btnClass: 'btn-danger',
					keys: ['esc']
				},
				Okay: {
					text: 'Delete',
					btnClass: 'btn-blue',
					keys: ['enter'],
					action: function(){
						remove_ajax(member_id);
					}
				}
			}
		});
	}
	function remove_ajax(member_id) {
		$.ajax({
			url: "../model/learners.php",
			dataType:'json',
			type: "POST",
			data:{ 
				action:"remove_record",
				member_id: member_id
			},
			success: function(data) {
				console.log(data);
				if(data.data == true) {
					$.confirm({
						title: 'Information Message',
						content: 'Record was successfully removed.',
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
				else if(data.data == false) {
					$.confirm({
						title: 'Error Message',
						content: 'Record not remove.',
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
				else {
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
			},
			error: function(){
				alert("error");
			}
		});
	}
</script>
</body>
</html>
