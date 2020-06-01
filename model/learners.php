<?php
	//defined('BASEPATH') OR exit('No direct script access allowed');
	require_once "model.php";
	session_start();
	date_default_timezone_set('Asia/Manila');
	$learner = new Model;
	$database = new Database;
	
	if(isset($_POST['action'])) {
		if($_POST['action'] == "import_data") {
			
			$filename=$_FILES["file"]["tmp_name"];	
			if($_FILES["file"]["size"] > 0) {
				$file = fopen($filename, "r");
			 	$count = 0;
				$total = 0;
			 	$date = "";
				while (($row = fgetcsv($file, 10000, ",")) !== FALSE) {
					if($total >= 2) {
						$date = date("Y-m-d h:i:s");
						$date_created = date("Y-m-d");
						$learner_name = $row[0];
						$gender =  strtoupper(trim($row[1]," "));
						$date_of_birth = $row[3];
						$mother_tangue = $row[4];
						$religion = $row[5];;
						$address = $row[6];
						$occupation = $row[7];
						$father_name = $row[8];
						$mother_name = $row[9];
						$contact_no = $row[10];

						$grade_level = $row[11];
						$category_of_learner = strtoupper(trim($row[12]));
						$date_mapped = $row[13];
						$interested_in_als = $row[14];
						$preferred_program = $row[15];
						$date_attendance = $row[16];
						$lrn = $row[17];
						$status = "Added";
						
						if($date_of_birth != "") {
							$data_date_of_birth = explode("/", $date_of_birth);
							$date_of_birth = $data_date_of_birth[2]."-".$data_date_of_birth[0]."-".$data_date_of_birth[1];
						}
						if($date_mapped != "") {
							$data_date_mapped = explode("/", $date_mapped);
							$date_mapped = $data_date_mapped[2]."-".$data_date_mapped[0]."-".$data_date_mapped[1];
						}
						if($date_attendance != "") {
							$data_date_attendance = explode("/", $date_attendance);
							$date_attendance = $data_date_attendance[2]."-".$data_date_attendance[0]."-".$data_date_attendance[1];
						}
						
						$code = "";
						$id_exist = true;
						$sql = "SELECT * FROM tbl_learners WHERE member_id=?";

						while ($id_exist == true) {

							$code = $database->generateID();
							$row = $database->validate($sql, $code);

							if($row == 0) {
								$id_exist = false;
								break;
							}
						}
						
						if($learner_name != "") {
							
							$sql = "SELECT * FROM tbl_learners WHERE learner_fullname=?";
							$check = $database->validate($sql, $learner_name);
							
							if($check == 0) {
								$sql = "INSERT INTO tbl_learners (member_id, learner_fullname, gender, date_of_birth, mother_toungue, religion, address, occupation, father_fullname, mother_fullname, contact_no, grade_level, category_of_learner, date_mapped, interested_in_als, preferred_program, date_attendance, lrn, status, date_created) VALUES('$code', '$learner_name', '$gender', '$date_of_birth', '$mother_tangue', '$religion', '$address', '$occupation', '$father_name', '$mother_name', '$contact_no', '$grade_level', '$category_of_learner', '$date_mapped', '$interested_in_als', '$preferred_program', '$date_attendance', '$lrn', '$status', '$date_created')";
								$data = $learner->addRecord($sql);

								$sql = "INSERT INTO tbl_logs (learner_fullname, gender, date_of_birth, mother_toungue, religion, address, occupation, father_fullname, mother_fullname, contact_no, grade_level, category_of_learner, date_mapped, interested_in_als, preferred_program, date_attendance, lrn, date, status, member_id) VALUES('$learner_name', '$gender', '$date_of_birth', '$mother_tangue', '$religion', '$address', '$occupation', '$father_name', '$mother_name', '$contact_no', '$grade_level', '$category_of_learner', '$date_mapped', '$interested_in_als', '$preferred_program', '$date_attendance', '$lrn', '$date', '$status', '$code')";
								$data = $learner->addRecord($sql);
								$count++;
							}
						}
					}
					$total++;
				}
				if($count > 0) {
					echo "true";
				}
				else {
					echo "false";
				}
				fclose($file);	
			}
			else {
				echo "false";
			}
		}
		else if($_POST['action'] == "display_record") {
			
		}
		else if($_POST['action'] == "add_record") {
			
			$date = date("Y-m-d h:i:s");
			$date_created = date("Y-m-d");
			$learner_name = $_POST['learner_name'];
			$gender = $_POST['gender'];
			$date_of_birth = $_POST['date_of_birth'];
			$mother_tangue = $_POST['mother_tangue'];
			$address = $_POST['address'];
			$religion = $_POST['religion'];
			$occupation = $_POST['occupation'];
			$father_name = $_POST['father_name'];
			$mother_name = $_POST['mother_name'];
			$contact_no = $_POST['contact_no'];
			
			$grade_level = $_POST['grade_level'];
			$category_of_learner = $_POST['category_of_learner'];
			$date_mapped = $_POST['date_mapped'];
			$interested_in_als = $_POST['interested_in_als'];
			$preferred_program = $_POST['preferred_program'];
			$date_attendance = $_POST['date_attendance'];
			$lrn = $_POST['lrn'];
			$status = "Added";
			
			if($date_of_birth != "") {
				$data_date_of_birth = explode("/", $date_of_birth);
				$date_of_birth = $data_date_of_birth[2]."-".$data_date_of_birth[0]."-".$data_date_of_birth[1];
			}
			if($date_mapped != "") {
				$data_date_mapped = explode("/", $date_mapped);
				$date_mapped = $data_date_mapped[2]."-".$data_date_mapped[0]."-".$data_date_mapped[1];
			}
			if($date_attendance != "") {
				$data_date_attendance = explode("/", $date_attendance);
				$date_attendance = $data_date_attendance[2]."-".$data_date_attendance[0]."-".$data_date_attendance[1];
			}
			
            $code = "";
			$id_exist = true;
			$sql = "SELECT * FROM tbl_learners WHERE member_id=?";

            while ($id_exist == true) {

                $code = $database->generateID();
                $row = $database->validate($sql, $code);

                if($row == 0) {
                    $id_exist = false;
                    break;
                }
            }
			
			if($learner_name != "") {
							
				$sql = "SELECT * FROM tbl_learners WHERE learner_fullname=?";
				$check = $database->validate($sql, $learner_name);

				if($check == 0) {
					$sql = "INSERT INTO tbl_learners (member_id, learner_fullname, gender, date_of_birth, mother_toungue, religion, address, occupation, father_fullname, mother_fullname, contact_no, grade_level, category_of_learner, date_mapped, interested_in_als, preferred_program, date_attendance, lrn, status, date_created) VALUES('$code', '$learner_name', '$gender', '$date_of_birth', '$mother_tangue', '$religion', '$address', '$occupation', '$father_name', '$mother_name', '$contact_no', '$grade_level', '$category_of_learner', '$date_mapped', '$interested_in_als', '$preferred_program', '$date_attendance', '$lrn', '$status', '$date_created')";
					$data = $learner->addRecord($sql);

					$sql = "INSERT INTO tbl_logs (learner_fullname, gender, date_of_birth, mother_toungue, religion, address, occupation, father_fullname, mother_fullname, contact_no, grade_level, category_of_learner, date_mapped, interested_in_als, preferred_program, date_attendance, lrn, date, status, member_id) VALUES('$learner_name', '$gender', '$date_of_birth', '$mother_tangue', '$religion', '$address', '$occupation', '$father_name', '$mother_name', '$contact_no', '$grade_level', '$category_of_learner', '$date_mapped', '$interested_in_als', '$preferred_program', '$date_attendance', '$lrn', '$date', '$status', '$code')";
					$data = $learner->addRecord($sql);
					echo $data;
				}
				else {
					echo "exist";
				}
			}
			
		}
		else if($_POST['action'] == "update_record") {
			
			$date = date("Y-m-d h:i:s");
			$member_id = $_POST['member_id'];
			$learner_name = $_POST['learner_name'];
			$gender = $_POST['gender'];
			$date_of_birth = $_POST['date_of_birth'];
			$mother_tangue = $_POST['mother_tangue'];
			$address = $_POST['address'];
			$religion = $_POST['religion'];
			$occupation = $_POST['occupation'];
			$father_name = $_POST['father_name'];
			$mother_name = $_POST['mother_name'];
			$contact_no = $_POST['contact_no'];
			
			$grade_level = $_POST['grade_level'];
			$category_of_learner = $_POST['category_of_learner'];
			$date_mapped = $_POST['date_mapped'];
			$interested_in_als = $_POST['interested_in_als'];
			$preferred_program = $_POST['preferred_program'];
			$date_attendance = $_POST['date_attendance'];
			$lrn = $_POST['lrn'];
			$status = "Updated";
			
			if($date_of_birth != "") {
				$data_date_of_birth = explode("/", $date_of_birth);
				$date_of_birth = $data_date_of_birth[2]."-".$data_date_of_birth[0]."-".$data_date_of_birth[1];
			}
			if($date_mapped != "") {
				$data_date_mapped = explode("/", $date_mapped);
				$date_mapped = $data_date_mapped[2]."-".$data_date_mapped[0]."-".$data_date_mapped[1];
			}
			if($date_attendance != "") {
				$data_date_attendance = explode("/", $date_attendance);
				$date_attendance = $data_date_attendance[2]."-".$data_date_attendance[0]."-".$data_date_attendance[1];
			}
			
			$category = "";
			$count = 0;
			
			$sql = "SELECT * FROM tbl_learners WHERE member_id='$member_id'";
			$data_details = $learner->displayRecord($sql);
			if($data_details[0]['learner_fullname'] != $learner_name) {
				$category = $category."1";
				$count++;
			}
			if($data_details[0]['gender'] != $gender) {
				
				if($count > 0) {
					$category = $category."-2";
				}
				else {
					$category = $category."2";
				}
				
				$count++;
			}
			if($data_details[0]['date_of_birth'] != $date_of_birth) {
				
				if($count > 0) {
					$category = $category."-3";
				}
				else {
					$category = $category."3";
				}
				
				$count++;
			}
			if($data_details[0]['mother_toungue'] != $mother_tangue) {
				
				if($count > 0) {
					$category = $category."-4";
				}
				else {
					$category = $category."4";
				}
				
				$count++;
			}
			if($data_details[0]['religion'] != $religion) {
				
				if($count > 0) {
					$category = $category."-5";
				}
				else {
					$category = $category."5";
				}
				
				$count++;
			}
			if($data_details[0]['address'] != $address) {
				
				if($count > 0) {
					$category = $category."-6";
				}
				else {
					$category = $category."6";
				}
				
				$count++;
			}
			if($data_details[0]['occupation'] != $occupation) {
				
				if($count > 0) {
					$category = $category."-7";
				}
				else {
					$category = $category."7";
				}
				
				$count++;
			}
			if($data_details[0]['father_fullname'] != $father_name) {
				
				if($count > 0) {
					$category = $category."-8";
				}
				else {
					$category = $category."8";
				}
				
				$count++;
			}
			if($data_details[0]['mother_fullname'] != $mother_name) {
				
				if($count > 0) {
					$category = $category."-9";
				}
				else {
					$category = $category."9";
				}
				
				$count++;
			}
			if($data_details[0]['contact_no'] != $contact_no) {
				
				if($count > 0) {
					$category = $category."-10";
				}
				else {
					$category = $category."10";
				}
				
				$count++;
			}
			if($data_details[0]['grade_level'] != $grade_level) {
				
				if($count > 0) {
					$category = $category."-11";
				}
				else {
					$category = $category."11";
				}
				
				$count++;
			}
			if($data_details[0]['category_of_learner'] != $category_of_learner) {
				
				if($count > 0) {
					$category = $category."-12";
				}
				else {
					$category = $category."12";
				}
				
				$count++;
			}
			if($data_details[0]['date_mapped'] != $date_mapped) {
				
				if($count > 0) {
					$category = $category."-13";
				}
				else {
					$category = $category."13";
				}
				
				$count++;
			}
			if($data_details[0]['interested_in_als'] != $interested_in_als) {
				
				if($count > 0) {
					$category = $category."-14";
				}
				else {
					$category = $category."14";
				}
				
				$count++;
			}
			if($data_details[0]['preferred_program'] != $preferred_program) {
				
				if($count > 0) {
					$category = $category."-15";
				}
				else {
					$category = $category."15";
				}
				
				$count++;
			}
			if($data_details[0]['date_attendance'] != $date_attendance) {
				
				if($count > 0) {
					$category = $category."-16";
				}
				else {
					$category = $category."16";
				}
				
				$count++;
			}
			if($data_details[0]['lrn'] != $lrn) {
				
				if($count > 0) {
					$category = $category."-17";
				}
				else {
					$category = $category."7";
				}
				
				$count++;
			}
			
			
			
			$sql = "UPDATE tbl_learners SET learner_fullname='$learner_name', gender='$gender', date_of_birth='$date_of_birth', mother_toungue='$mother_tangue', religion='$religion', address='$address', occupation='$occupation', father_fullname='$father_name', mother_fullname='$mother_name', contact_no='$contact_no', grade_level='$grade_level', category_of_learner='$category_of_learner', date_mapped='$date_mapped', interested_in_als='$interested_in_als', preferred_program='$preferred_program', date_attendance='$date_attendance', lrn='$lrn' WHERE member_id='$member_id'";
			$result = $learner->updateRecord($sql);
			
			$sql = "INSERT INTO tbl_logs (learner_fullname, gender, date_of_birth, mother_toungue, religion, address, occupation, father_fullname, mother_fullname, contact_no, grade_level, category_of_learner, date_mapped, interested_in_als, preferred_program, date_attendance, lrn, date, status, category, member_id) VALUES('$learner_name', '$gender', '$date_of_birth', '$mother_tangue', '$religion', '$address', '$occupation', '$father_name', '$mother_name', '$contact_no', '$grade_level', '$category_of_learner', '$date_mapped', '$interested_in_als', '$preferred_program', '$date_attendance', '$lrn', '$date', '$status', '$category', '$member_id')";
			$result = $learner->updateRecord($sql);
			echo $result;
		}
		else if($_POST['action'] == "remove_record") {
			$member_id = $_POST['member_id'];
			$sql = "UPDATE tbl_learners SET status='Deleted' WHERE member_id='$member_id'";
			$result = $learner->deleteRecord($sql);
			echo json_encode(array("data" =>$result));
		}
		else if($_POST['action'] == "restore_record") {
			$member_id = $_POST['member_id'];
			$sql = "UPDATE tbl_learners SET status='Restored' WHERE member_id='$member_id'";
			$result = $learner->deleteRecord($sql);
			echo json_encode(array("data" =>$result));
		}
		else if($_POST['action'] == "permanent_remove") {
			$member_id = $_POST['member_id'];
			$sql = "DELETE FROM tbl_learners WHERE member_id='$member_id'";
			$result = $learner->deleteRecord($sql);
			echo json_encode(array("data" =>$result));
		}
		
		else if($_POST['action'] == "update_user") {
			
			$message = "";
			$user_id = $_SESSION['als_userid'];
			$fullname = $_POST['fullname'];
			$user_name = $_POST['username'];
			$current_password = $_POST['current_password'];
			$new_password = $_POST['new_password'];
			
			$sql = "SELECT * FROM tbl_user WHERE user_id='$user_id'";
			$record = $learner->displayRecord($sql);
			
			if($record[0]['password'] == md5($current_password)) {
				$new_password = md5($_POST['new_password']);
				$sql = "UPDATE tbl_user SET fullname='$fullname',  username='$user_name', password='$new_password' WHERE user_id='$user_id'";
				$result = $learner->deleteRecord($sql);
				$message = "true";
				
			}
			else {
				$message = "wrong_password";
			}
			echo $message;
		}
		
		else {
			header("location:dashboard.php");
		}
	}
?>