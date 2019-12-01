<?php

class ReadData{
    private $conn;
    private $CAROUSEL_TABLE = "carousel";
    private $USER_TABLE = "myplayer_registration";
    private $TOPIMAGE_TABLE='topimage';
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Reading Carousel Data
    public function readCarousel(){
        $sql = "SELECT * FROM ".$this->CAROUSEL_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    
    // Checking Mail Id In DB For Password Reset Mail To received mail id
    public function passResetMainCheck($mail_id){
        $temp = FALSE;
        $reg_id = "";
        $sql = "SELECT regid,email FROM ".$this->USER_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        while($row = mysqli_fetch_assoc($rs)){
            //echo "checking".$temp.$mail_id;
            if($row['email']==$mail_id){
                $temp=TRUE;   
                $reg_id = $row['regid'];
            }
        }
        if($temp){
            //send mail to checked email id
            $subject = "Password Recovery | MyPlayerAPI-Admin";
            $to = $mail_id;
            $id = trim($reg_id);
            $msg = "Please click below link to reset the password...\n ";
            $url = "URL: "." https://amriksinghpadam.com/MyplayerAPI/setPassword.php?uid=$id";
            $message = $msg."\n".$url;
            
            if(mail($to, $subject, $message)){
                ?><script>
                    alert("Mail Sent, Please Check Your Mail-Box");
                    window.location.href = "../";
                </script><?php
            }else{
                 ?><script>
                    alert("Unable To Send Mail, Try Aftar Some Time.");
                    window.location.href = "../";
                </script><?php
            }
            
        }else{
            ?><script>
                alert("Incorrect E-Mail Id!!");
                window.location.href = "../";
            </script><?php
        }
    }
    // Reading TopImages
    public function readTopImage(){
        $sql = "SELECT * FROM ".$this->TOPIMAGE_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    
    
}


?>