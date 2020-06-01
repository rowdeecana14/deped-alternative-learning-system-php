<?php
	
	require_once "model.php";
	session_start();
	$database = new Database;
	$model = new Model;
	$controller = new Controller;
	$record= array();
		
	if(!isset($_SESSION['als_token'])) {
			
		header("location:../login.php");
	}
	else {
		$user_id = $_SESSION['als_userid'];
		$num_rows = $controller->checkUser($_SESSION['als_userid'], $_SESSION['als_token']);
		$record  = $controller->userDetails($_SESSION['als_userid']);
		
		$sql = "SELECT * FROM tbl_user WHERE user_id='$user_id'";
		$user_data = $model->displayRecord($sql);
		
		if($num_rows == 0) {
			header("location:../login.php");
		}
	}

?>