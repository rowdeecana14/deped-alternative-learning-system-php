<?php
    session_start();
	require_once "model.php";
	$login = new Login;
	$database = new Database;

	if(!empty($_SESSION['als_userid'])) {
		
		unset ($_SESSION['als_token']);
		unset ($_SESSION['als_userid']);
		header("location: ../login.php");
	}
	else {
		header("location: ../login.php");
	}
?>
