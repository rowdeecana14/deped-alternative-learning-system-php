<?php
    
//===========================================================================================//
//        DATABASE CLASS                                                                    //
//=========================================================================================//
 
    class Database {
        
        protected $server_name = "localhost";
        protected $user_name = "root";
        protected $password = "";
        protected $db_name = "deped_als";
        protected $db_connect = null;
        private $query = null;
        private $sql = "";
        
		public function openConnection() {
            
            $this->db_connect = new mysqli ($this->server_name, $this->user_name, $this->password, $this->db_name);
            
            if ($this->db_connect->connect_error) {
                die("Connection failed: " . $this->db_connect->connect_error);
            }
            return $this->db_connect;
        }
        public function closeConnection() {
            
            $this->db_connect->close();
            $this->query = null;
            $this->sql = "";
        }
        public function generateID() {

            $uniqueID = "";
            $number = "0123456789";
            $max = strlen($number);

            for($i = 0; $i <= 20; $i++) {
                $uniqueID .= $number[rand() % $max];
            }
            return $uniqueID;
        }
		public function validate($sql, $code) {
			$num_rows = 0;
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
			$this->query->bind_param('s', $code);
			$this->query->execute();
			$this->query->store_result();
			$num_rows = $this->query->num_rows;
			$this->closeConnection();
			
			return $num_rows;
        }
		
        public function uploadImage($getImage, $getImage_location) {

            $upload_location = "../books/".$getImage;
            $image_location = $getImage_location;

            if(move_uploaded_file($image_location, $upload_location)) {
                //echo "Save";
            }
            else {
                echo "Error1";
            }
        }
		
		public function checkData($data) {
			
			$valid = false;
			if(isset($data) && !empty($data)) {
				$valid = true;
			}
			else {
				$valid = false;
			}
			return $valid;
		}
		
		public function cleanData($data) {
			
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		public function convertData($data) {
			
			$data = strtolower($data);
            $data = ucwords($data);
			return $data;
		}
        
		public function generateAuth() {

			$code = "";
			$vowels = 'aeou';
			$consonants = "bdghjmnpqrstvz";
			$number = '1234567890';

			for($i = 0; $i <= 10; $i++) {

				$code .= $consonants[rand() % strlen($consonants)];
				$code .= $vowels[rand() % strlen($vowels)];
				$code .= $number[rand() % strlen($number)];
			}
			return $code;
		}
		public function totalRow($sql) {

           $this->openConnection();
            $this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            
            $number = 0;
            $result = $this->query->get_result();
                
            while ($myrow = $result->fetch_assoc()) {
				
				if($myrow['quantity'] == null) {
					$number = 0;
				}
				else {
					$number = $number + $myrow['quantity'];
				}
            } 
            $this->closeConnection();
            return $number;
        }
		
		public function getAge($birth_year, $birth_month, $birth_day) {
			date_default_timezone_set('Asia/Manila');
			$current_year = date('Y');
			$current_month = date('m');
			$current_day = date('d');
			$year = $current_year - $birth_year;

			if ($year == 0) {
				$age = $year;
			}
			else if ($year > 0) {
				if ($current_month == $birth_month) {
					if ($current_day >= $birth_day) {
						$age = $year;
					}
					else {
						$age = $year - 1;
					}
				}
				else if ($current_month < $birth_month) {
					$age = $year - 1;
				}
				else  {
					$age = $year;
				}
			}
        	return $age;
		}

    }
//===========================================================================================//
//        LOGIN CLASS                                                                       //
//=========================================================================================//
	class Login extends Database {

		public function validateUsername($get_username) {

			$num_rows = 0;
			$this->openConnection();
			$this->sql = "SELECT * FROM tbl_user WHERE username=?  LIMIT 1";
			$this->query = $this->db_connect->prepare($this->sql);
			$this->query->bind_param('s', $get_username);
			$this->query->execute();
			$this->query->store_result();
			$num_rows = $this->query->num_rows;

			$this->closeConnection();
			return $num_rows;
		}

		public function validateUserPass($get_username, $get_password) {

			$num_rows = 0;
			$this->openConnection();
			$this->sql = "SELECT * FROM tbl_user WHERE username=? AND password=?  LIMIT 1";
			$this->query = $this->db_connect->prepare($this->sql);
			$this->query->bind_param('ss', $get_username, $get_password);
			$this->query->execute();
			$this->query->store_result();
			$num_rows = $this->query->num_rows;

			$this->closeConnection();
			return $num_rows;
		}

		public function userDetail($get_username, $get_password) {

			$this->openConnection();
			$this->sql = "SELECT user_id FROM tbl_user WHERE username=? AND password=?  LIMIT 1";
			$this->query = $this->db_connect->prepare($this->sql);
			$this->query->bind_param('ss', $get_username, $get_password);
			$this->query->execute();

			$data = array();
			$result = $this->query->get_result();

			while ($myrow = $result->fetch_assoc()) {

				array_push($data, $myrow);
			} 
			$this->closeConnection();
			return $data;
		}

		public function updateRecord($sql) {

			$success = "";
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);

			if($this->query->execute()) {
				$success = "true";
			}
			else {
				$success = "false";
			}

			$this->closeConnection();
			return $success;
		}
	}

//===========================================================================================//
//        CRUD CLASS                                                                        //
//=========================================================================================//

	class Model extends Database {
		
		public function displayRecord($sql) {
			
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            $data = array();
            $result = $this->query->get_result();
                
            while ($row = $result->fetch_assoc()) {
                
                array_push($data, $row);
			}
			
			$this->closeConnection();
			return $data;
		}
		public function searchRecord($sql) {
			
            $this->openConnection();
            $this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            
            $data = array();
            $result = $this->query->get_result();
                
            while ($myrow = $result->fetch_assoc()) {
                    
                array_push($data, $myrow);
            } 
            $this->closeConnection();
            return $data;
		}
		public function addRecord($sql) {
			
			$success = "false";
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
			
			if($this->query->execute()) {
				$success = "true";
			}
			else {
				$success = "false";
			}

			$this->closeConnection();
			return $success;
		}
		public function updateRecord($sql) {
			
			$success = "";
			$this->openConnection();
            $this->query = $this->db_connect->prepare($sql);
			
            if($this->query->execute()) {
                $success = "true";
            }
            else {
				$success = "false";
            }

            $this->closeConnection();
			return $success;
		}
		public function editRecord($sql) {
			
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            
            $data = array();
            $result = $this->query->get_result();
                
            while ($myrow = $result->fetch_assoc()) {
                    
                array_push($data, $myrow);
            } 
            $this->closeConnection();
            return $data;
		}
		public function deleteRecord($sql) {
			
			$success = false;
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
			if($this->query->execute()) {

				$success = true;
			}
			else {

				$success = false;
			}
            $this->closeConnection();
			return $success;
        }
	}

	//===========================================================================================//
	//        CONTROLLER CLASS                                                                  //
	//=========================================================================================//
	class Controller extends Database {

		public function checkUser($user_id, $token) {
			$num_rows = 0;
			$this->openConnection();
			$this->sql = "SELECT * FROM tbl_user WHERE token=? AND user_id=?";
			$this->query = $this->db_connect->prepare($this->sql);
			$this->query->bind_param('ss', $token, $user_id);
			$this->query->execute();
			$this->query->store_result();
			$num_rows = $this->query->num_rows;

			return $num_rows;
		}
		public function userDetails($user_id) {

			$this->sql = "SELECT * FROM tbl_user  WHERE tbl_user.user_id=? ";
			$this->query = $this->db_connect->prepare($this->sql);
			$this->query->bind_param('s', $user_id);
			$this->query->execute();

			$data = array();
			$result = $this->query->get_result();

			while ($myrow = $result->fetch_assoc()) {

				array_push($data, $myrow);
			} 
			return $data;
		}

	}
?>