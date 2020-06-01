<?php
	require_once "../model/controller.php";
	require_once "../model/model.php";
	$model = new Model;
	$database = new Database;
	$sql = "SELECT * FROM tbl_learners WHERE status ='Deleted' ORDER BY learner_fullname";
	$record = $model->displayRecord($sql);
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
		table {
			font-size: 12px;
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
			  <li class="active"><a href="recyclebin.php"><i class="fa fa-flask"></i> Recycle Bin</a></li>
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
				  <img src="../images/recyclebin.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px">List of record</h4>
			 </div>
			  <div class="panel-body">
				  <div class="responsive">
					  <div class="table-responsive">
						  <table id="example2" class="table table-bordered table-hover">
							  <thead style="background-color:#e2e2e2">
								<tr>
								  <th>Learner Name</th>
								  <th class="text-center">Gender</th>
								 <th>Date of Birth</th>
								  <th class="text-center">Age</th>
									<th>Address</th>
									<th>Contact No</th>
									<th width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
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
										
										$gender = "";
										if($value['gender'] == "M") {
											
											$gender = "Male";
										}
										else {
											$gender = "Female";
										}
										
										echo 
										'<tr>
											<td>'.$value['learner_fullname'].'</td>
											<td class="text-center">'.$gender.'</td>
											<td>'.date("F m Y", strtotime($value['date_of_birth'])).'</td>
											<td class="text-center">'.$age.'</td>
											<td>'.$value['address'].'</td>
											<td>'.$value['contact_no'].'</td>
											<td>
												<div class="btn-group">
												  <a type="button" data-toggle="tooltip" data-placement="top" title="Delete permanent" class="btn btn-danger btn-xs" onclick=remove_record("'.$id.'")><i class="fa fa-trash"></i> Delete </a>
												  <a type="button" data-toggle="tooltip" data-placement="top" title="Restore record" class="btn btn-primary btn-xs" onclick=restore_record("'.$id.'")><i class="fa fa-trash"></i> Restore </a>
												</div
											</td>
										</tr>';
									}
								}
								else {
									echo '<tr style="background-color:#d0f1e2"><td colspan="10"><h4 class="text-center">No records available.</h4></td></tr>';
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
	});
	function remove_record(member_id) {
		$.confirm({
			title: 'Confirmation Message',
			content: 'Permanent delete this record?',
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
				action:"permanent_remove",
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
	function restore_record(member_id) {
		$.ajax({
			url: "../model/learners.php",
			dataType:'json',
			type: "POST",
			data:{ 
				action:"restore_record",
				member_id: member_id
			},
			success: function(data) {
				console.log(data);
				if(data.data == true) {
					$.confirm({
						title: 'Information Message',
						content: 'Record was successfully restored.',
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
						content: 'Record not restored.',
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
