<?php

class ReadData{
    private $conn;
    private $CAROUSEL_TABLE = "carousel";
    private $USER_TABLE = "myplayer_registration";
    private $TOPIMAGE_TABLE='topimage';
    private $CONTENTTYPE_TABLE='type';
    private $ARTIST_TABLE='artist';
    private $LANGUAGE_TABLE='language';
    private $SONG_TABLE = 'song';
    private $VIDEO_TABLE = 'video';
    
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
    
     // Reading UserDetail
    public function readUserDetail(){
        $sql = "SELECT * FROM ".$this->USER_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    
    // Reading TopImages
    public function readTopImage(){
        $sql = "SELECT * FROM ".$this->TOPIMAGE_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    //Read Content Type
    public function readContetType(){
        $sql = "SELECT * FROM ".$this->CONTENTTYPE_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    //Read Artist
    public function readArtist(){
        $sql = "SELECT * FROM ".$this->ARTIST_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    //Read Language
    public function readLanguage(){
        $sql = "SELECT * FROM ".$this->LANGUAGE_TABLE;
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    //Read Song Detail
    public function readSongDetail(){
        $sql = "SELECT * FROM ".$this->SONG_TABLE ." S"
                . " LEFT JOIN artist A ON S.artistid = A.artistid"
                . " LEFT JOIN language L ON S.languageid = L.languageid";
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    // Read Video Detail
     public function readVideoDetail(){
        $sql = "SELECT * FROM ".$this->VIDEO_TABLE ." V"
                . " LEFT JOIN artist A ON V.artistid = A.artistid"
                . " LEFT JOIN language L ON V.languageid = L.languageid";
        $rs = mysqli_query($this->conn, $sql);
        return $rs;
    }
    
}


?>