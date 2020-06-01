<?php
	require_once "../model/controller.php";
	require_once "../model/model.php";
	$model = new Model;
	$user_id = $_SESSION['als_userid'];
	$sql = "SELECT * FROM tbl_user WHERE user_id='$user_id'";
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
	  <div class="container-fluid"  style="width:90%;" >
		  <br>
		 <div class="panel panel-success">
			  <div class="panel-heading" style="background-color:#b1e2bd">
				<img src="../images/user_edit.png" width="40px" height="40px"><h4 style="margin-top:-30px; margin-left:45px; ">My Account</h4>
			 </div>
			  <div class="panel-body">
				<form id="update_form">
					<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
						<center>
							<img src="../images/user_list.png" width="180px" height="180px" style="margin-top:50px">
						</center>
					</div>
					<div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
						<div class="form-group">
							<label>Fullname</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
								<input type='hidden' class='form-control' name='action' id='action' value="update_user"  required>
								<input type='text' class='form-control' name='fullname' id='fullname' value="<?php echo $record[0]['fullname']; ?>" placeholder="Fullname" required>
							</div>
						</div>
						<div class="form-group">
							<label>Username</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user" style="color:#69AA46"></i></span>
								<input type='text' class='form-control' name='username' id='username' value="<?php echo $record[0]['username']; ?>" placeholder="Username" required>
							</div>
						</div>
						<div class="form-group">
							<label>Current Password</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key" style="color:#69AA46"></i></span>
								<input type='password' class='form-control' name='current_password' id='current_password' placeholder="Current Password" required>
							</div>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key" style="color:#69AA46"></i></span>
								<input type="password" class='form-control' name='new_password' id='new_password' placeholder="New Password" required>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="box-footer">
							<div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
								
							</div>
							<div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
								<button type="reset" class="btn btn-app bg-red margin">
									<i class="fa fa-times-circle"></i> Cancel
								</button>
								<button type="submit" class="btn btn-app bg-blue margin" >
									<i class="fa fa-save"></i> Save
								</button>
							</div>
						</div>
					</div>
			  </form>
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
							content: 'Useraccount was successfully updated.',
							icon: 'glyphicon glyphicon-info-sign',
							theme: 'bootstrap',
							 type: 'green',
							buttons: {
								Okay: {
									text: 'Okay',
									btnClass: 'btn-blue',
									keys: ['enter'],
									action: function () {
										window.location.reload();
									}
								}
							}
						});
					}
					else if(data == "wrong_password") {
						$.confirm({
							title: 'Error Message',
							content: 'Incorrect current password.',
							icon: 'fa fa-exclamation-circle',
							theme: 'bootstrap',
							 type: 'red',
							buttons: {
								Okay: {
									text: 'Okay',
									btnClass: 'btn-blue',
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
							content: 'Useraccount not updated.',
							icon: 'fa fa-exclamation-circle',
							theme: 'bootstrap',
							 type: 'red',
							buttons: {
								Okay: {
									text: 'Okay',
									btnClass: 'btn-blue',
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
						icon: 'fa fa-exclamation-circle',
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
