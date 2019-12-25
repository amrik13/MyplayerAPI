<?php

class InsertData{
    
    private $conn;
    private $CAROUSEL_TABLE = "carousel";
    private $USER_TABLE = "myplayer_registration";
    private $TOPIMAGE_TABLE='topimage';
    private $CONTENTTYPE_TABLE='type';
    private $ARTIST_TABLE='artist';
    private $LANGUAGE_TABLE='language';
    private $SONG_TABLE = 'song';
    private $VIDEO_TABLE = 'video';
    
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
                    alert("Error While Inserting top image into DB!!");
                    window.location.href = "../top4ImageBlock.php";
                </script><?php
            }
            
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
           ?><script>
                alert("Error While Inserting Top Imge Into directory!!");
                window.location.href = "../top4ImageBlock.php";
            </script><?php
        }
    }
    //insert content type ( Ex. Song & Video)
    public function insertContentType($type,$contentTypeImage_name,
                            $img_tmp_name,$contentTypeImage_dir){
        if(move_uploaded_file($img_tmp_name, $contentTypeImage_dir.$contentTypeImage_name)){
            $sql = "INSERT INTO ".$this->CONTENTTYPE_TABLE." (contenttype,image) VALUES ('$type','$contentTypeImage_name')";
            mysqli_query($this->conn, $sql);
            if(mysqli_affected_rows($this->conn)>0){
                ?><script>
                    alert("Content Type Inserted Successfully!!");
                    window.location.href = "../category.php";
                </script><?php
            }else{
                 ?><script>
                    alert("Error While Inserting Content Type Into DB!!");
                    window.location.href = "../category.php";
                </script><?php
            }
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
           ?><script>
                alert("Error While Inserting Content Type Image Into directory!!");
                window.location.href = "../category.php";
            </script><?php
        }
        
    }
    // Insert Artist
    public function insertArtist($artist,$artistImage_name,
                            $img_tmp_name,$artistImage_dir){
        if(move_uploaded_file($img_tmp_name, $artistImage_dir.$artistImage_name)){
            $sql = "INSERT INTO ".$this->ARTIST_TABLE." (artistname,image) VALUES ('$artist','$artistImage_name')";
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
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
           ?><script>
                alert("Error While Inserting Artist Image Into directory!!");
                window.location.href = "../category.php";
            </script><?php
        }
        
    }
    // Insert Language
    public function insertLanguage($language,$languageImage_name,
                            $img_tmp_name,$languageImage_dir){
        if(move_uploaded_file($img_tmp_name, $languageImage_dir.$languageImage_name)){
            $sql = "INSERT INTO ".$this->LANGUAGE_TABLE." (languages,image) VALUES ('$language','$languageImage_name')";
            mysqli_query($this->conn, $sql);
            if(mysqli_affected_rows($this->conn)>0){
                ?><script>
                    alert("Language Inserted Successfully!!");
                    window.location.href = "../category.php";
                </script><?php
            }else{
                 ?><script>
                    alert("Error While Inserting Language into DB!!");
                    window.location.href = "../category.php";
                </script><?php
            }
            //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
        }else{
           ?><script>
                alert("Error While Inserting Language Image Into directory!!");
                window.location.href = "../category.php";
            </script><?php
        }
        
    }
    
    //Upload Songs Detail
    public function insertSongDetail($artistId,$languageId,$typeId,$songTitle,
                $songDesc,$songName,$songBannerName,$song_tmp_name,
            $songBanner_tmp_name,$songDirectroy,$songBannerDirectroy){
        
        if(move_uploaded_file($song_tmp_name, $songDirectroy.$songName)){
            if(move_uploaded_file($songBanner_tmp_name, $songBannerDirectroy.$songBannerName)){
                $songName = preg_replace('/\s+/', '_', $songName);
                $songUrl = APIConstant::$SCHEME. APIConstant::$BASEURL.APIConstant::$SONGDIRECTORYURL.$songName;
                $sql = "INSERT INTO ".$this->SONG_TABLE." (typeid,artistid,languageid,songtitle,songurl,songfilename,songbanner,songdescription) "
                        . "VALUES ('$typeId','$artistId','$languageId','$songTitle','$songUrl','$songName','$songBannerName','$songDesc')";
                mysqli_query($this->conn, $sql);
                if(mysqli_affected_rows($this->conn)>0){
                    ?><script>
                        alert("Song Detail Inserted Successfully!!");
                        window.location.href = "../song.php";
                    </script><?php
                }else{
                     ?><script>
                        alert("Error While Inserting Song Detail Into DB!!");
                        window.location.href = "../song.php";
                    </script><?php
                }
                //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
            }else{
                ?><script>
                    alert("Error While Inserting Song Image Into directory!!");
                    window.location.href = "../song.php";
                </script><?php
            }
        }else{
           ?><script>
                alert("Error While Inserting Song Into directory!!");
                window.location.href = "../song.php";
            </script><?php
        }
        
    }
    
    
    //Upload Video Detail
    public function insertVideoDetail($artistId,$languageId,$typeId,$videoTitle,
                $videoDesc,$videoName,$videoBannerName,$video_tmp_name,
            $videoBanner_tmp_name,$videoDirectroy,$videoBannerDirectroy){
        
        if(move_uploaded_file($video_tmp_name, $videoDirectroy.$videoName)){
            if(move_uploaded_file($videoBanner_tmp_name, $videoBannerDirectroy.$videoBannerName)){
                $videoName = preg_replace('/\s+/', '_', $videoName);
                $videoUrl = APIConstant::$SCHEME. APIConstant::$BASEURL.APIConstant::$VIDEODIRECTORYURL.$videoName;
                $sql = "INSERT INTO ".$this->VIDEO_TABLE." (typeid,artistid,languageid,videotitle,videourl,videofilename,videobanner,videodescription) "
                        . "VALUES ('$typeId','$artistId','$languageId','$videoTitle','$videoUrl','$videoName','$videoBannerName','$videoDesc')";
                mysqli_query($this->conn, $sql);
                if(mysqli_affected_rows($this->conn)>0){
                   
                }else{
                     ?><script>
                        alert("Error While Inserting Video Detail Into DB!!");
                        window.location.href = "../video.php";
                    </script><?php
                }
                //echo "hello insert - ".$carousel_title."<br><br>".$banner_name;
            }else{
                ?><script>
                    alert("Error While Inserting Video Image Into directory!!");
                    window.location.href = "../video.php";
                </script><?php
            }
        }else{
           ?><script>
                alert("Error While Inserting Video Into directory!!");
                window.location.href = "../video.php";
            </script><?php
        }
        
    }
    
    
}



?>