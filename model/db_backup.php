<?php
class db_backup{
		
		public function connect_server(){
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$conn = new mysqli($servername, $username, $password);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			return $conn;
		}
		public function connect_db(){
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "deped_als";
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			return $conn;
		}
		public function tables(){
			
			$conn = $this->connect_db();
			$query = $conn->prepare("SHOW TABLES");
            $query->execute();
            $tables = array();
            $result = $query->get_result();
                
            while ($row = $result->fetch_assoc()) {
                
                array_push($tables, $row['Tables_in_deped_als']);
			}
			return $tables;
		}
		function insert_database(){
			$conn = $this->connect_server();
			$data = "false";
			$sql = "CREATE DATABASE deped_als";
			if ($conn->query($sql) === TRUE) {
				$data = "true";
			}
			return $data;
		}
		function db_import($file_path){
			$conn = $this->connect_db();
			$tbl_query = null;
			foreach ($this->tables() as $key => $table) {
				if ($conn->query("DROP TABLE IF EXISTS ".$table) === TRUE) {
				}
			}
			$templine = '';
			$lines = file($file_path);
			foreach ($lines as $line)
			{
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
				$templine .= $line;
				if (substr(trim($line), -1, 1) == ';')
				{
					$conn->query($templine);
					$templine = '';
				}
			}
			return true;
		}
		
	}
?>