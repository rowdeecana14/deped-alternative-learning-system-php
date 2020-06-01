<?php
	
	require_once "model/model.php";
	session_start();
	$database = new Database;
	$controller = new Controller;
	$token = $database->generateAuth();
	$_SESSION['als_logintoken'] = $token;

	if(isset($_SESSION['als_token']) && isset($_SESSION['als_userid'])) {
		
		$num_rows = $controller->checkUser($_SESSION['als_userid'], $_SESSION['als_token']);
		if($num_rows == 1) {
			header("location:pages/dashboard.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>E Libary</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="shortcut icon" href="images/als.png">
	<link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="Login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="Login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login/css/main.css">
	<link rel="stylesheet" type="text/css" href="AdminLTE/plugins/confirmation/jquery-confirm.css">
	<style>
    #flaming:hover {
		color:#00008B;
    }
    #flaming{
	  -webkit-animation: colorchange 4s infinite; /* Chrome, Safari, Opera */ 
	  animation: 5s infinite colorchange;
	}
	@-webkit-keyframes  colorchange {
	  10% {
	   color:#ffffff;
	  }
	  60% {
		color: #9400D3;
	  }
	}
	@keyframes colorchange {
	  10% {
	   color:#ffffff;
	  }
	  60% {
		color: #9400D3;
	  }
	}
	</style>
</head>
<body style="background:url('images/wall_1.jpg');background-repeat: no-repeat; background-size: cover; ">
	
	<div class="limiter" >
		<div class="container-login100 b">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33" style="background-color:transparent;background-color:	rgba(102, 101, 111, 0.8); ">
                  <p style="text-align:center; margin-top:-40px"><img class="align-content" src="images/logo.png" alt="" width="150px" height="150px" ></p>
				<div class="container-login100-form-btn m-t-17" style="opacity:2px">
						<button class="login100-form-btn" name="login" style="background:url('images/spc.gif')repeat; ">
							<h1 id="flaming" class="text-center" style="margin:20px;">A-Learning System</h1>
						</button>
					</div><br>
				
				<form id="loginForm" class="login100-form validate-form flex-sb flex-w" method="post" role="form">
					<div class="p-t-13 p-b-9">
						<span class="txt1">
						</span>
					</div>
					<div class="wrap-input100" data-validate = "Email is required">
						<input class="input100" type="text" name="username" id="username" placeholder="Enter Username" required>
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100" data-validate = "Password is required" style="margin-top:20px">
						<input class="input100" type="password" name="password" id="password" placeholder="Enter Password" required>
						<span class="focus-input100"></span>
					</div><br>
					<div class="container-login100-form-btn m-t-17" style="opacity:2px">
						<button class="login100-form-btn" name="" type="submit">
							<h3 style="margin-left:140px;">Login now</h3
						</button>
					</div>
				</form>
				 <div class="modal fade" id="myModal" role="dialog">
					
				</div>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	<script src="Login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="Login/vendor/animsition/js/animsition.min.js"></script>
	<script src="Login/vendor/bootstrap/js/popper.js"></script>
	<script src="Login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="Login/vendor/select2/select2.min.js"></script>
	<script src="Login/vendor/daterangepicker/moment.min.js"></script>
	<script src="Login/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="Login/vendor/countdowntime/countdowntime.js"></script>
	<script src="Login/js/main.js"></script>
	<script src="AdminLTE/plugins/confirmation/jquery-confirm.js"></script>
	
	<script type="text/javascript">
		$("#loginForm").on('submit',(function(e) {

			e.preventDefault();
			var token = "<?php echo $token; ?>";
			$.ajax({
				url: "model/login.php",
				dataType:'json',
				type: "POST",
				data:{
					action: 'login',
					als_logintoken: token,
					username: $("#username").val(),
					password: $("#password").val()
				},
				success: function(data) {
					console.log(data);
					if(data.success == true) {
						
						$("#myModal").modal("show");
						var content = '';
						 var jc = $.alert({
							title: 'Please wait...',
							draggable: false,
							content:content,
							icon: 'fa fa-hourglass-2',
                            theme: 'bootstrap',
							 type: 'green',
							content: '<br><center><img src="images/loading.gif" width="100px" height=100px" style="opacity:0.8"></center><br>'
						});
						jc.open();
						$(".jconfirm-buttons").hide();
						setTimeout(function() {
							window.location.href = '' + data.link;
						}, 1000);
						
			         } 
			        else if(data.success == false) {
						
						if(data.message == "Account not exist.") {
							$("#username").val("");
							$("#password").val("");
						}
						else {
							$("#password").val("");
						}
						$.confirm({
                            title: 'Error Message',
                            content: data.message,
							icon: 'fa fa-exclamation-circle',
                            theme: 'bootstrap',
							 type: 'orange',
                            buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-blue',
								keys: ['enter', 'esc'],
								}
                            }
                        });
						
			        }
					else {
						$("#username").val("");
						$("#password").val("");
						$.confirm({
                            title: 'Error Message',
                            content: "There was an error",
							icon: 'fa fa-exclamation-circle',
                            theme: 'bootstrap',
							 type: 'orange',
                            buttons: {
								Okay: {
								text: 'Okay',
								btnClass: 'btn-blue',
								keys: ['enter', 'esc'],
								}
                            }
                        });
					}
				},
				error: function(){
					alert("error");
				}
			});
		}));
	</script>
</body>
</html>