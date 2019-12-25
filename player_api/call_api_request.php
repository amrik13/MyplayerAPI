<?php

include '../player_db/Config.php';
include 'InsertData.php';
include 'ReadData.php';
include 'DeleteData.php';
include 'APIConstant.php';

$db = new Config();
$conn = $db->connect_db();
$readData = new ReadData($conn);
$base_url = $_SERVER['HTTP_HOST']."/MyplayerAPI/";
// All Carousel Data Response
if(isset($_REQUEST['all_carousel_data']))
{
    $banner_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$CAROUSELBANNERURL;
    $result_carousel = $readData->readCarousel();
    if(isset($result_carousel)){
        $carousel_api = array();
        $carousel_api['carousel'] = array();
        while($carousel_row = mysqli_fetch_assoc($result_carousel)){
            extract($carousel_row);
            $carousel_item = array(
                'carouselid' => $carouselid,
                'image' => $image,
                'imageurl' => $banner_base_url.$image,
                'title' => $title
            );
            array_push($carousel_api['carousel'],$carousel_item);
        }
        echo json_encode($carousel_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}

// Top_Image_Data API Data Response
if(isset($_REQUEST['top_image_data']))
{
    $top_img_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$TOPIMAGEDIRURL;
    $result_top_img = $readData->readTopImage();
    if(isset($result_top_img)){
        $top_img_api = array();
        $top_img_api['topimage'] = array();
        while($top_img_row = mysqli_fetch_assoc($result_top_img)){
            extract($top_img_row);
            $top_img_item = array(
                'topimageid' => $topimageid,
                'image' => $image,
                'imageurl' => $top_img_base_url.$image
            );
            array_push($top_img_api['topimage'],$top_img_item);
        }
        echo json_encode($top_img_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}
// ARTIST API Data Response
if(isset($_REQUEST['artist_data']))
{
    $artist_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$ARTISTDIRURL;
    $result_artist = $readData->readArtist();
    if(isset($result_artist)){
        $artist_api = array();
        $artist_api['artist'] = array();
        while($artist_row = mysqli_fetch_assoc($result_artist)){
            extract($artist_row);
            $artist_item = array(
                'artistid' => $artistid,
                'image' => $image,
                'artistname' => $artistname,
                'imageurl' => $artist_base_url.$image
            );
            array_push($artist_api['artist'],$artist_item);
        }
        echo json_encode($artist_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}
// CONTENT TYPE API Data Response
if(isset($_REQUEST['content_type_data']))
{
    $content_type_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$CONTENTTYPEDIRURL;
    $result_content_type = $readData->readContetType();
    if(isset($result_content_type)){
        $content_type_api = array();
        $content_type_api['contenttype'] = array();
        while($content_type_row = mysqli_fetch_assoc($result_content_type)){
            extract($content_type_row);
            $content_type_item = array(
                'typeid' => $typeid,
                'image' => $image,
                'contenttype' => $contenttype,
                'imageurl' => $content_type_base_url.$image
            );
            array_push($content_type_api['contenttype'],$content_type_item);
        }
        echo json_encode($content_type_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}
// LANGUAGE API Data Response
if(isset($_REQUEST['language_data']))
{
    $language_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$LANGUAGEDIRURL;
    $result_language = $readData->readLanguage();
    if(isset($result_language)){
        $language_api = array();
        $language_api['language'] = array();
        while($language_row = mysqli_fetch_assoc($result_language)){
            extract($language_row);
            $language_item = array(
                'languageid' => $languageid,
                'language' => $languages,
                'image' => $image,
                'imageurl' => $language_base_url.$image
            );
            array_push($language_api['language'],$language_item);
        }
        echo json_encode($language_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}
// USER_DETAIL API Data Response
if(isset($_REQUEST['user_detail_data']))
{
    
    $result_user_detail = $readData->readUserDetail();
    if(isset($result_user_detail)){
        $user_detail_api = array();
        $user_detail_api['userdetail'] = array();
        while($user_detail_row = mysqli_fetch_assoc($result_user_detail)){
            extract($user_detail_row);
            $user_detail_item = array(
                'userid' => $regid,
                'username' => $name,
                'useremail' => $email,
                'regtime' => $time
            );
            array_push($user_detail_api['userdetail'],$user_detail_item);
        }
        echo json_encode($user_detail_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}
// SONG API Data Response
if(isset($_REQUEST['all_song_data']))
{
    $song_banner_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$SONGIMAGEDIRURL;
    $result_song = $readData->readSongDetail();
    if(isset($result_song)){
        $song_api = array();
        $song_api['song'] = array();
        while($song_row = mysqli_fetch_assoc($result_song)){
            extract($song_row);
            $song_item = array(
                'songid' => $songid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'languageid' => $languageid,
                'counter' => $counter,
                'songtitle' => $songtitle,
                'songdescription' => $songdescription,
                'songfilename' => $songfilename,
                'songurl' => $songurl,
                'songbanner' => $songbanner,
                'songbannerurl' => $song_banner_base_url.$songbanner
            );
            array_push($song_api['song'],$song_item);
        }
        echo json_encode($song_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}
// VIDEO API Data Response
if(isset($_REQUEST['all_video_data']))
{
    $video_base_url = APIConstant::$SCHEME.$base_url.APIConstant::$VIDEOIMAGEDIRURL;
    
    $result_video = $readData->readVideoDetail();
    if(isset($result_video)){
        $video_api = array();
        $video_api['video'] = array();
        while($video_row = mysqli_fetch_assoc($result_video)){
            extract($video_row);
            $video_item = array(
                'videoid' => $videoid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'languageid' => $languageid,
                'counter' => $counter,
                'videotitle' => $videotitle,
                'videodescription' => $videodescription,
                'videofilename' => $videofilename,
                'videourl' => $videourl,
                'videobanner' => $videobanner,
                'videobannerurl' => $video_base_url.$videobanner
            );
            array_push($video_api['video'],$video_item);
        }
        echo json_encode($video_api);
    }else{
        echo json_decode('message','no data found ( ERROR )...');
    }
}

?>
