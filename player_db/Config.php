<?php

class Config {

	 private $host = "localhost";
	 private $db_name = "amriksinghpadam_myplayer_db";
	 private $username = "amriksinghpadam_myplayer_db";
	 private $password = "Amrik25081995";
        //Actual Detail
//       private $host = "localhost";
//	private $db_name = "myplayer_db";
//	private $username = "root";
//	private $password = "";
        
	private $conn;

	public function connect_db(){
		$this->conn = null;
                
                $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
                
                if($this->conn->connect_errno){
                    echo $this->conn->connect_error;
                }else{
                    return $this->conn;
                }

	}
        public function checkSession(){
            session_start();
            if(!isset($_SESSION['sess_email']) && !isset($_SESSION['sess_password'])){
                header("location:./");
            }
        }

}

?>