<?php
	
	session_start();
	require_once "model.php";
	$login = new Login;
	$database = new Database;
	$token = $database->generateAuth();

	if (isset($_POST['action']) && !empty($_POST['action'])) 
    { 
        if($_POST['action'] == "login" && $_POST['als_logintoken'] == $_SESSION['als_logintoken']) {

        	if($_POST['username'] != "" && $_POST['password'] != "") {
				
				$user_id = "";
				$data = array();
				$password = md5($_POST['password']);
                $row1 = $login->validateUsername($_POST['username']);
                $row2 = $login->validateUserPass($_POST['username'], $password);
				$data = $login->userDetail($_POST['username'], $password);
				
				if($row1 > 0) {
					
					if($row2 > 0) {
						
						$action = "Login";
						$user_id = $data[0]['user_id'];
						$_SESSION['als_userid'] = $data[0]['user_id'];
						$_SESSION['als_token'] = $token;
						$result = $login->updateRecord("UPDATE tbl_user SET token='$token' WHERE user_id='$user_id'");
						$data = array('success' =>true,'' =>'', 'link' =>'pages/dashboard.php');
					}
					else {
                        $data = array('success' =>false,'message' =>'Incorrect password.', 'link' =>'');
					}
				}
				else {
                    $data = array('success' =>false,'message' =>'Account not exist.', 'link' =>'');
				}
				
                echo json_encode($data);
        	}
        }
    }
   
?>