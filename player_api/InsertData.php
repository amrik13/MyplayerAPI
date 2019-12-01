<?php

class InsertData{
    
    private $conn;
    private $CAROUSEL_TABLE = "carousel";
    private $USER_TABLE = "myplayer_registration";
    private $TOPIMAGE_TABLE='topimage';
    private $CONTENTTYPE_TABLE='type';
    private $ARTIST_TABLE='artist';
    private $LANGUAGE_TABLE='language';
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    // Insert Complete Data For Carousel
    public function insetCarouselDetail($carousel_title, $banner_name,$img_tmp_name,$carousel_img_dir){
        
        if(move_uploaded_file($img_tmp_name, $carousel_img_dir.$banner_name)){
            $sql = "INSERT INTO ".$this->CAROUSEL_TABLE." (image,title) VALUES ('$banner_name','$carousel_title')";
            mysqli_query($this->conn, $sql);
            if(mysqli_affected_rows($this->conn)>0){
                ?><script>
                    alert("Image Inserted Successfully!!");
                    window.location.href = "../Carousel.php";
                </script><?php
            }else{
                 ?><script>
                    alert("Error While Inserting Data!!");
                    window.location.href = "../Carousel.php";
                </script><?php
            }
            
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
            ?><script>
                alert("Sorry! Server Error, Please try after some time..");
                window.location.href = "../Carousel.php";
            </script><?php
        }
    }
    
    // Register UserData into Database
    public function registerUser($name,$email,$password){
        $sql1 = "SELECT email FROM ".$this->USER_TABLE;
        $rs = mysqli_query($this->conn, $sql1);
        $temp = 0;
        // checking if email already exist
        while($row = mysqli_fetch_assoc($rs)){
            if($row['email'] == $email){
                $temp++;
            }
        }
        if($temp!=0){
            ?><script>
                alert("Email Already Registered!");
                window.location.href = "../";
            </script><?php
        }else{
            $sql = "INSERT INTO ".$this->USER_TABLE." (name,email,password) VALUES ('$name','$email','$password')";
            mysqli_query($this->conn, $sql);
            if(mysqli_affected_rows($this->conn)>0){
                ?><script>
                    alert("User Registered Successfully!!");
                    window.location.href = "../";
                </script><?php
            }else{
                 ?><script>
                    alert("Error While Registeration!!");
                    window.location.href = "../";
                </script><?php
            }
        }
    }
    
//Login User     
    public function loginUser($email,$password){    
        $sql = "SELECT * FROM ".$this->USER_TABLE." WHERE email = '$email' AND password = '$password'";
        $rs = mysqli_query($this->conn, $sql);
        // checking if email already exist
        if($row = mysqli_fetch_assoc($rs)){
            session_start();
            $_SESSION['sess_uid'] = $row['regid'];
            $_SESSION['sess_name'] = $row['name'];
            $_SESSION['sess_email'] = $row['email'];
            $_SESSION['sess_password'] = $row['password'];
            header("location:../Carousel.php");
        }else{
            ?><script>
                alert("Incorrect Detail!");
                window.location.href = "../";
            </script><?php
        }
        
    }
    
    //update Password from setpassword.php
    public function updatePassword($new_pwd,$user_id){
        $sql = "UPDATE ".$this->USER_TABLE." SET password = '$new_pwd' WHERE regid='$user_id'";
        mysqli_query($this->conn,$sql);
        if(mysqli_affected_rows($this->conn)){
             ?><script>
                alert("Password Updated Login Again!");
                window.location.href = "../";
            </script><?php
        }else{
             ?><script>
                alert("Error While Updating Password!");
                window.location.href = "../";
            </script><?php
        }
    }
    
    //Update Carousel Detail
    public function updateCarousel($carousel_title, $banner_name,$img_tmp_name,$carousel_img_dir,$carouselId){
        if(move_uploaded_file($img_tmp_name, $carousel_img_dir.$banner_name)){
            $sql = "UPDATE ".$this->CAROUSEL_TABLE." SET image = '$banner_name', title = '$carousel_title' "
                    . "WHERE carouselid = '$carouselId'";
            mysqli_query($this->conn, $sql);
            if(mysqli_affected_rows($this->conn)>0){
                ?><script>
                    alert("Carousel Updated Successfully!!");
                    window.location.href = "../Carousel.php";
                </script><?php
            }else{
                 ?><script>
                    alert("Error While Updating Carousel!!");
                    window.location.href = "../Carousel.php";
                </script><?php
            }
            
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
            ?><script>
                alert("Sorry! Carousel Server Error, Please try after some time..");
                window.location.href = "../Carousel.php";
            </script><?php
        }
    }
    // Upload Top Image
    public function updateTopImage($topImage_name,$img_tmp_name,$topImage_dir){
        if(move_uploaded_file($img_tmp_name, $topImage_dir.$topImage_name)){
            $sql = "INSERT INTO ".$this->TOPIMAGE_TABLE." (image) VALUES ('$topImage_name')";
            mysqli_query($this->conn, $sql);
            if(mysqli_affected_rows($this->conn)>0){
                ?><script>
                    alert("Image Inserted Successfully!!");
                    window.location.href = "../top4ImageBlock.php";
                </script><?php
            }else{
                 ?><script>
                    alert("Error While Inserting Data!!");
                    window.location.href = "../top4ImageBlock.php";
                </script><?php
            }
            
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
           
        }
    }
    //insert content type ( Ex. Song & Video)
    public function insertContentType($type){
        $sql = "INSERT INTO ".$this->CONTENTTYPE_TABLE." (contenttype) VALUES ('$type')";
        mysqli_query($this->conn, $sql);
        if(mysqli_affected_rows($this->conn)>0){
            ?><script>
                alert("Content Type Inserted Successfully!!");
                window.location.href = "../category.php";
            </script><?php
        }else{
             ?><script>
                alert("Error While Inserting Content Type!!");
                window.location.href = "../category.php";
            </script><?php
        }
    }
    // Insert Artist
    public function insertArtist($artist){
        $sql = "INSERT INTO ".$this->ARTIST_TABLE." (artistname) VALUES ('$artist')";
        mysqli_query($this->conn, $sql);
        if(mysqli_affected_rows($this->conn)>0){
            ?><script>
                alert("Artist Inserted Successfully!!");
                window.location.href = "../category.php";
            </script><?php
        }else{
             ?><script>
                alert("Error While Inserting Artist!!");
                window.location.href = "../category.php";
            </script><?php
        }
    }
    // Insert Language
    public function insertLanguage($language){
        $sql = "INSERT INTO ".$this->LANGUAGE_TABLE." (languages) VALUES ('$language')";
        mysqli_query($this->conn, $sql);
        if(mysqli_affected_rows($this->conn)>0){
            ?><script>
                alert("Language Inserted Successfully!!");
                window.location.href = "../category.php";
            </script><?php
        }else{
             ?><script>
                alert("Error While Inserting Language!!");
                window.location.href = "../category.php";
            </script><?php
        }
    }
    
    
    
}



?>
