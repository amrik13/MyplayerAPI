<?php

include '../player_db/Config.php';
include '../player_api/InsertData.php';
include '../player_api/ReadData.php';
include '../player_api/DeleteData.php';


$db = new Config();
$conn = $db->connect_db();

//Take data from view to insert data into DATABASE for carousel
if(isset($_REQUEST["update_carousel"])){
    
    $carousel_title = $_REQUEST["carouseltitle"];
    $banner_name = $_FILES["carouselbanner"]["name"];
    $img_tmp_name = $_FILES["carouselbanner"]["tmp_name"];
    $carousel_img_dir = "../img/carouselbanner/";
    $banner_size = $_FILES["carouselbanner"]["size"];
    $file_mime = $_FILES["carouselbanner"]["type"];
    
    if($file_mime=="image/jpeg" || $file_mime=="image/jpg" || $file_mime=="image/png"){
        if(file_exists($carousel_img_dir.$banner_name)){
        ?><script>
              alert("Hello! Image Already Exist With This Name!");
              window.location.href = "../Carousel.php";
        </script><?php
        }else{
            if($banner_size > 320000){
            ?><script>
                  alert("Image Size Exceeded, Please choose image below 320kb");
                  window.location.href = "../Carousel.php";
            </script><?php
            }else{
                    $insetData = new InsertData($conn);
                    $insetData->insetCarouselDetail($carousel_title,$banner_name,$img_tmp_name,$carousel_img_dir);
            }
        }
    }else{
        ?><script>
              alert("Sorry! Only JPEG/PNG/JPG Accepted!!");
              window.location.href = "../Carousel.php";
        </script><?php
    }
    //echo "hello insert - ".$carousel_title."-".$banner_name;
}

// Register User info and checking email is exit or no with playerDB/VerifyEmail.php database
if(isset($_REQUEST['myplayer_user_reg'])){
    $name = $_REQUEST['namer'];
    $email = $_REQUEST['emailr'];
    $pwd = $_REQUEST['pwdr'];
   
    $insertData = new InsertData($conn);
    $insertData->registerUser($name,$email,$pwd);
}

// Login User 
if(isset($_REQUEST['user_login'])){
    $email = $_REQUEST['lemail'];
    $pwd = $_REQUEST['lpwd'];
    $insertData = new InsertData($conn);
    $insertData->loginUser($email,$pwd);
}

//receiving email id for sending mail to recover password but first need to check mail present in DB or Not
if(isset($_REQUEST['forget_pwd_mail'])){
    $email = $_REQUEST['pwd_reset_mail'];
    $email = trim($email);
    $readData = new ReadData($conn);
    $readData->passResetMainCheck($email);
}

//update password after seting new password
if(isset($_REQUEST['set_pwd'])){
    $newPwd = $_REQUEST['new_pwd'];
    $user_id = $_REQUEST['uid'];
    $insetData = new InsertData($conn);
    $insetData->updatePassword($newPwd, $user_id);
}
// geting carousel id to send it to delete carouel 
if(isset($_REQUEST['dlt'])){
    $cid = $_REQUEST['cid'];
    $dltData = new DeleteData($conn);
    $dltData->deleteCarousel($cid);
}

// Edit Carousel Data (From Form)
if(isset($_REQUEST['edit_carousel_form'])){
    
    $carouselTitle = $_REQUEST['new_carousel_title'];
    $carouselId = $_REQUEST['carousel_id'];
    
    $banner_name = $_FILES["new_carousel_banner"]["name"];
    $img_tmp_name = $_FILES["new_carousel_banner"]["tmp_name"];
    $carousel_img_dir = "../img/carouselbanner/";
    $banner_size = $_FILES["new_carousel_banner"]["size"];
    $file_mime = $_FILES["new_carousel_banner"]["type"];
    
    if($file_mime=="image/jpeg" || $file_mime=="image/jpg" || $file_mime=="image/png"){
        if(file_exists($carousel_img_dir.$banner_name)){
        ?><script>
              alert("Hello! Image Already Exist With This Name!");
              window.location.href = "../Carousel.php";
        </script><?php
        }else{
            if($banner_size > 320000){
            ?><script>
                  alert("Image Size Exceeded, Please choose image below 320kb");
                  window.location.href = "../Carousel.php";
            </script><?php
            }else{
                    $insetData = new InsertData($conn);
                    $insetData->updateCarousel($carouselTitle,$banner_name,
                            $img_tmp_name,$carousel_img_dir,$carouselId);
            }
        }
    }else{
        ?><script>
              alert("Sorry! Only JPEG/PNG/JPG Accepted!!");
              window.location.href = "../Carousel.php";
        </script><?php
    }
}

// Upload Top 4 Images
if(isset($_REQUEST['upload_top_image'])){
     
    $topImage_name = $_FILES["topImage"]["name"];
    $img_tmp_name = $_FILES["topImage"]["tmp_name"];
    $topImage_dir = "../img/topImageBlock/";
    $topImage_size = $_FILES["topImage"]["size"];
    $file_mime = $_FILES["topImage"]["type"];
    
    if($file_mime=="image/jpeg" || $file_mime=="image/jpg" || $file_mime=="image/png"){
        if(file_exists($topImage_dir.$topImage_name)){
        ?><script>
              alert("Hello! Image Already Exist With This Name!");
              window.location.href = "../top4ImageBlock.php";
        </script><?php
        }else{
            if($topImage_size > 320000){
            ?><script>
                  alert("Image Size Exceeded, Please choose image below 320kb");
                  window.location.href = "../top4ImageBlock.php";
            </script><?php
            }else{
                    $insetData = new InsertData($conn);
                    $insetData->updateTopImage($topImage_name,$img_tmp_name,$topImage_dir);
            }
        }
    }else{
        ?><script>
              alert("Sorry! Only JPEG/PNG/JPG Accepted!!");
              window.location.href = "../top4ImageBlock.php";
        </script><?php
    }
}
// delete top 4 image 
if(isset($_REQUEST['dltTopImg'])){
    $imgId = $_REQUEST['topImgid'];
    $dltData = new DeleteData($conn);
    $dltData->deleteTopImage($imgId);
}

//add content type (song , video )
if(isset($_REQUEST['content_type_submit'])){
    $type = $_REQUEST['contentType'];
    $temp = 0;
    if(preg_match('/[\'^£$%&*()}{@#0123456789~?><>,|=_+¬-]/', $type)){
        $temp++;
    }
    if($temp==0){
        $type = trim(strtolower($type));
        $insertContentType = new InsertData($conn);
        $insertContentType->insertContentType($type);
    }else{
        echo "<center><h2>Special Character & Number Not Allowed!</h2></center>";
    }
}
//add Artist 
if(isset($_REQUEST['artist'])){
    $artist = $_REQUEST['artistName'];
    $temp = 0;
    if(preg_match('/[\'^£$%&*()}{@#0123456789~?><>,|=_+¬-]/', $artist)){
        $temp++;
    }
    if($temp==0){
        $artist = trim(strtolower($artist));
        $insertArtist = new InsertData($conn);
        $insertArtist->insertArtist($artist);
    }else{
        echo "<center><h2>Special Character & Number Not Allowed!</h2></center>";
    }
}
//add Language
if(isset($_REQUEST['language_form'])){
    $language = $_REQUEST['language'];
    $temp = 0;
    if(preg_match('/[\'^£$%&*()}{@#0123456789~?><>,|=_+¬-]/', $language)){
        $temp++;
    }
    if($temp==0){
        $language = trim(strtolower($language));
        $insertLang = new InsertData($conn);
        $insertLang->insertLanguage($language);
    }else{
        echo "<center><h2>Special Character & Number Not Allowed!</h2></center>";
    }
}

?>