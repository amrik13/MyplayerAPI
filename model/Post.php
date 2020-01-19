<?php

include '../player_db/Config.php';
include '../player_api/InsertData.php';
include '../player_api/ReadData.php';
include '../player_api/DeleteData.php';
include '../player_api/APIConstant.php';

$db = new Config();
$conn = $db->connect_db();

//Take data from view to insert data into DATABASE for carousel
if(isset($_REQUEST["update_carousel"])){
    
    $carousel_title = $_REQUEST["carouseltitle"];
    $banner_name = $_FILES["carouselbanner"]["name"];
    $img_tmp_name = $_FILES["carouselbanner"]["tmp_name"];
    $carousel_img_dir = APIConstant::$CAROUSELDIR;
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
    $carousel_img_dir = APIConstant::$CAROUSELDIR;
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
    $topImage_dir = APIConstant::$TOPIMAGEDIR;
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
        $contentTypeImage_name = $_FILES["content_type_banner"]["name"];
        $img_tmp_name = $_FILES["content_type_banner"]["tmp_name"];
        $contentTypeImage_dir = APIConstant::$CONTENTTYPEIMAGEDIR;
        $contentTypeImage_size = $_FILES["content_type_banner"]["size"];
        $file_mime = $_FILES["content_type_banner"]["type"];

        if($file_mime=="image/jpeg" || $file_mime=="image/jpg" || $file_mime=="image/png"){
            if(file_exists($contentTypeImage_dir.$contentTypeImage_name)){
            ?><script>
                  alert("Hello! Image Already Exist With This Name!");
                  window.location.href = "../category.php";
            </script><?php
            }else{
                if($contentTypeImage_size > 320000){
                ?><script>
                      alert("Image Size Exceeded, Please choose image below 320kb");
                      window.location.href = "../category.php";
                </script><?php
                }else{
                    $type = trim(strtolower($type));
                    $insertContentType = new InsertData($conn);
                    $insertContentType->insertContentType($type,$contentTypeImage_name,
                            $img_tmp_name,$contentTypeImage_dir);
                }
            }
        }else{
            ?><script>
                  alert("Sorry! Only JPEG/PNG/JPG Accepted!!");
                  window.location.href = "../category.php";
            </script><?php
        }
        
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
        $artistImage_name = $_FILES["artist_banner"]["name"];
        $img_tmp_name = $_FILES["artist_banner"]["tmp_name"];
        $artistImage_dir = APIConstant::$ARTISTIMAGEDIR;
        $artistImage_size = $_FILES["artist_banner"]["size"];
        $file_mime = $_FILES["artist_banner"]["type"];

        if($file_mime=="image/jpeg" || $file_mime=="image/jpg" || $file_mime=="image/png"){
            if(file_exists($artistImage_dir.$artistImage_name)){
            ?><script>
                  alert("Hello! Image Already Exist With This Name!");
                  window.location.href = "../category.php";
            </script><?php
            }else{
                if($artistImage_size > 320000){
                ?><script>
                      alert("Image Size Exceeded, Please choose image below 320kb");
                      window.location.href = "../category.php";
                </script><?php
                }else{
                     //$artist = trim(strtolower($artist));
                    $insertArtist = new InsertData($conn);
                    $insertArtist->insertArtist($artist,$artistImage_name,
                            $img_tmp_name,$artistImage_dir);
                }
            }
        }else{
            ?><script>
                  alert("Sorry! Only JPEG/PNG/JPG Accepted!!");
                  window.location.href = "../category.php";
            </script><?php
        }
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
        $languageImage_name = $_FILES["language_banner"]["name"];
        $img_tmp_name = $_FILES["language_banner"]["tmp_name"];
        $languageImage_dir = APIConstant::$LANGUAGEBANNERDIR;
        $languageImage_size = $_FILES["language_banner"]["size"];
        $file_mime = $_FILES["language_banner"]["type"];

        if($file_mime=="image/jpeg" || $file_mime=="image/jpg" || $file_mime=="image/png"){
            if(file_exists($languageImage_dir.$languageImage_name)){
            ?><script>
                  alert("Hello! Image Already Exist With This Name!");
                  window.location.href = "../category.php";
            </script><?php
            }else{
                if($languageImage_size > 320000){
                ?><script>
                      alert("Image Size Exceeded, Please choose image below 320kb");
                      window.location.href = "../category.php";
                </script><?php
                }else{
                     $language = trim(strtolower($language));
                    $insertLang = new InsertData($conn);
                    $insertLang->insertLanguage($language,$languageImage_name,
                            $img_tmp_name,$languageImage_dir);
                }
            }
        }else{
            ?><script>
                  alert("Sorry! Only JPEG/PNG/JPG Accepted!!");
                  window.location.href = "../category.php";
            </script><?php
        }
        
        
        $insertLang->insertLanguage($language);
    }else{
        echo "<center><h2>Special Character & Number Not Allowed!</h2></center>";
    }
}

// Upload Song Data
if(isset($_REQUEST['upload_song_data'])){
    
    $artistId =  $_REQUEST['song_artist'];
    $languageId =  $_REQUEST['song_language'];
    $typeId =  $_REQUEST['song_type'];
    $songTitle = $_REQUEST['song_title'];
    $songDesc = $_REQUEST['song_description'];
    // Song .mp3 file
    $songName1 = $_FILES['song_file']['name'];
    $songName = preg_replace('/\s+/', '_', $songName1);
    $songFileType = pathinfo($songName, PATHINFO_EXTENSION);
    $song_tmp_name = $_FILES['song_file']['tmp_name'];
    $songDirectroy = APIConstant::$SONGDIRECTORY;
    
    // Song Image file
    $songBannerName1 = $_FILES['song_banner']['name'];
    $songBannerName = preg_replace('/\s+/', '_', $songBannerName1);
    $songBannerFileType = $_FILES['song_banner']['type'];
    $songBanner_tmp_name = $_FILES['song_banner']['tmp_name'];
    $songBannerDirectroy = APIConstant::$SONGIMAGEDIR;
    //echo $songName."<br>".$songFileType;
    
    if($songFileType=="mp3"){
            if(file_exists($songDirectroy.$songName)){
            ?><script>
                  alert("Hello! Song File Already Exist With This Name!");
                  window.location.href = "../song.php";
            </script><?php
            }else{
                if($songBannerFileType=="image/jpg" || $songBannerFileType=="image/jpeg" || $songBannerFileType=="image/png" ){
                    if(file_exists($songBannerDirectroy.$songBannerName)){
                    ?><script>
                          alert("Hello! Song Image Already Exist With This Name!");
                          window.location.href = "../song.php";
                    </script><?php
                    }else{
                        try{
                            $insertLang = new InsertData($conn);
                            $insertLang->insertSongDetail($artistId,$languageId,$typeId,$songTitle,$songDesc,$songName,
                                $songBannerName,$song_tmp_name,$songBanner_tmp_name,$songDirectroy,$songBannerDirectroy);
                        } catch (Exception $ex) {
                            print_r($ex);
                        }
                        
                    }
                }else{
                    ?><script>
                          alert("Sorry! Only .jpg/.png/.jpeg Accepted!!");
                          window.location.href = "../song.php";
                    </script><?php
                }
            }
        }else{
             ?><script>
                alert("Sorry! Only .MP3 Accepted!!");
                window.location.href = "../song.php";
            </script><?php
        }
    
}


// Upload Video Data
if(isset($_REQUEST['upload_video_data'])){
    
    $artistId =  $_REQUEST['video_artist'];
    $languageId =  $_REQUEST['video_language'];
    $typeId =  $_REQUEST['video_type'];
    $videoTitle = $_REQUEST['video_title'];
    $videoDesc = $_REQUEST['video_description'];
    // Song .mp3 file
    $videoName1 = $_FILES['video_file']['name'];
    $videoName = preg_replace('/\s+/', '_', $videoName1);
    $videoFileType = pathinfo($videoName, PATHINFO_EXTENSION);
    $video_tmp_name = $_FILES['video_file']['tmp_name'];
    $videoDirectroy = APIConstant::$VIDEODIRECTORY;
    // Song Image file
    $videoBannerName1 = $_FILES['video_banner']['name'];
    $videoBannerName = preg_replace('/\s+/', '_', $videoBannerName1);
    $videoBannerFileType = $_FILES['video_banner']['type'];
    $videoBanner_tmp_name = $_FILES['video_banner']['tmp_name'];
    $videoBannerDirectroy = APIConstant::$VIDEOIMAGEDIR;
    //echo $songFileType;
    
    if($videoFileType=="mp4"){
        if(file_exists($videoDirectroy.$videoName)){
        ?><script>
              alert("Hello! Video File Already Exist With This Name!");
              window.location.href = "../video.php";
        </script><?php
        }else{
            if($videoBannerFileType=="image/jpg" || $videoBannerFileType=="image/jpeg" || $videoBannerFileType=="image/png" ){
                if(file_exists($videoBannerDirectroy.$videoBannerName)){
                ?><script>
                      alert("Hello! Video Image Already Exist With This Name!");
                      window.location.href = "../video.php";
                </script><?php
                }else{
                    try{
                        $insertLang = new InsertData($conn);
                        $insertLang->insertVideoDetail($artistId,$languageId,$typeId,$videoTitle,$videoDesc,$videoName,
                            $videoBannerName,$video_tmp_name,$videoBanner_tmp_name,$videoDirectroy,$videoBannerDirectroy);
                    } catch (Exception $ex) {
                        print_r($ex);
                    }

                }
            }else{
                ?><script>
                      alert("Sorry! Only .jpg/.png/.jpeg Accepted!!");
                      window.location.href = "../video.php";
                </script><?php
            }
        }
    }else{
        ?><script>
              alert("Sorry! Only .MP4 Accepted!!");
              window.location.href = "../video.php";
        </script><?php
    }
    
}
// Most played Section
if(isset($_REQUEST['most_played_song'])){
    $songId = $_REQUEST['contentid'];
    $insertData = new InsertData($conn);
    if(!empty($songId)){
        $insertData->updateSongPlayedCounter($songId);
    }
}
if(isset($_REQUEST['most_played_video'])){
    $videoId = $_REQUEST['contentid'];
    $insertData = new InsertData($conn);
    if(!empty($videoId)){
        $insertData->updateVideoPlayedCounter($videoId);
    }
}
?>