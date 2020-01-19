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
    $banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$CAROUSELBANNERURL;
    $result_carousel = $readData->readCarousel();
    if(mysqli_num_rows($result_carousel)>0){
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// Top_Image_Data API Data Response
if(isset($_REQUEST['top_image_data']))
{
    $top_img_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$TOPIMAGEDIRURL;
    $result_top_img = $readData->readTopImage();
    if(mysqli_num_rows($result_top_img)>0){
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// ARTIST API Data Response
if(isset($_REQUEST['artist_data']))
{
    $artist_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$ARTISTDIRURL;
    $result_artist = $readData->readArtist();
    if(mysqli_num_rows($result_artist)>0){
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// CONTENT TYPE API Data Response
if(isset($_REQUEST['content_type_data']))
{
    $content_type_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$CONTENTTYPEDIRURL;
    $result_content_type = $readData->readContetType();
    if(mysqli_num_rows($result_content_type)>0){
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// LANGUAGE API Data Response
if(isset($_REQUEST['language_data']))
{
    $language_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$LANGUAGEDIRURL;
    $result_language = $readData->readLanguage();
    if(mysqli_num_rows($result_language)>0){
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// USER_DETAIL API Data Response
if(isset($_REQUEST['user_detail_data']))
{
    
    $result_user_detail = $readData->readUserDetail();
    if(mysqli_num_rows($result_user_detail)>0){
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// SONG API Data Response
if(isset($_REQUEST['all_song_data']))
{
    $song_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$SONGIMAGEDIRURL;
    $result_song = $readData->readSongDetail();
    if(mysqli_num_rows($result_song)>0){
        $song_api = array();
        $song_api['song'] = array();
        while($song_row = mysqli_fetch_assoc($result_song)){
            extract($song_row);
            $song_item = array(
                'songid' => $songid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// VIDEO API Data Response
if(isset($_REQUEST['all_video_data']))
{
    $video_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$VIDEOIMAGEDIRURL;
    
    $result_video = $readData->readVideoDetail();
    if(mysqli_num_rows($result_video)>0){
        $video_api = array();
        $video_api['video'] = array();
        while($video_row = mysqli_fetch_assoc($result_video)){
            extract($video_row);
            $video_item = array(
                'videoid' => $videoid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// LATEST SONG API Data Response
if(isset($_REQUEST['latest_song']))
{
    $song_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$SONGIMAGEDIRURL;
    $result_song = $readData->readLatestSongDetail();
    if(mysqli_num_rows($result_song)>0){
        $song_api = array();
        $song_api['latestsong'] = array();
        while($song_row = mysqli_fetch_assoc($result_song)){
            extract($song_row);
            $song_item = array(
                'songid' => $songid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'songtitle' => $songtitle,
                'songdescription' => $songdescription,
                'songfilename' => $songfilename,
                'songurl' => $songurl,
                'songbanner' => $songbanner,
                'songbannerurl' => $song_banner_base_url.$songbanner,
                'time' => $time
            );
            array_push($song_api['latestsong'],$song_item);
        }
        echo json_encode($song_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// LATEST VIDEO API Data Response
if(isset($_REQUEST['latest_video']))
{
    $video_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$VIDEOIMAGEDIRURL;
    $result_video = $readData->readLatestVideoDetail();
    if(mysqli_num_rows($result_video)>0){
        $video_api = array();
        $video_api['latestvideo'] = array();
        while($video_row = mysqli_fetch_assoc($result_video)){
            extract($video_row);
            $video_item = array(
                'videoid' => $videoid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'videotitle' => $videotitle,
                'videodescription' => $videodescription,
                'videofilename' => $videofilename,
                'videourl' => $videourl,
                'videobanner' => $videobanner,
                'videobannerurl' => $video_banner_base_url.$videobanner,
                'time' => $time
            );
            array_push($video_api['latestvideo'],$video_item);
        }
        echo json_encode($video_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// SONG DISCOVER API Data Response
if(isset($_REQUEST['discover_song_content']))
{
    $languageId = $_REQUEST['discover_song'];
    $song_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$SONGIMAGEDIRURL;
    $result_song = $readData->readDiscoverSongDetail($languageId);
    if(mysqli_num_rows($result_song)>0){
        $song_api = array();
        $song_api['discoversong'] = array();
        while($song_row = mysqli_fetch_assoc($result_song)){
            extract($song_row);
            $song_item = array(
                'songid' => $songid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'songtitle' => $songtitle,
                'songdescription' => $songdescription,
                'songfilename' => $songfilename,
                'songurl' => $songurl,
                'songbanner' => $songbanner,
                'songbannerurl' => $song_banner_base_url.$songbanner
            );
            array_push($song_api['discoversong'],$song_item);
        }
        echo json_encode($song_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// DISCOVER VIDEO API Data Response
if(isset($_REQUEST['discover_video_content']))
{
    $languageId = $_REQUEST['discover_video'];
    $video_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$VIDEOIMAGEDIRURL;
    $result_video = $readData->readDiscoverVideoDetail($languageId);
    if(mysqli_num_rows($result_video)>0){
        $video_api = array();
        $video_api['video'] = array();
        while($video_row = mysqli_fetch_assoc($result_video)){
            extract($video_row);
            $video_item = array(
                'videoid' => $videoid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
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
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// SONG ARTIST API Data Response
if(isset($_REQUEST['artist_song_content']))
{
    $artistId = $_REQUEST['artist_song'];
    $song_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$SONGIMAGEDIRURL;
    $result_song = $readData->readArtistSongDetail($artistId);
    if(mysqli_num_rows($result_song)>0){
        $song_api = array();
        $song_api['artistsong'] = array();
        while($song_row = mysqli_fetch_assoc($result_song)){
            extract($song_row);
            $song_item = array(
                'songid' => $songid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'songtitle' => $songtitle,
                'songdescription' => $songdescription,
                'songfilename' => $songfilename,
                'songurl' => $songurl,
                'songbanner' => $songbanner,
                'songbannerurl' => $song_banner_base_url.$songbanner
            );
            array_push($song_api['artistsong'],$song_item);
        }
        echo json_encode($song_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// DISCOVER VIDEO API Data Response
if(isset($_REQUEST['artist_video_content']))
{
    $artistId = $_REQUEST['artist_video'];
    $video_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$VIDEOIMAGEDIRURL;
    $result_video = $readData->readArtistVideoDetail($artistId);
    if(mysqli_num_rows($result_video)>0){
        $video_api = array();
        $video_api['artistvideo'] = array();
        while($video_row = mysqli_fetch_assoc($result_video)){
            extract($video_row);
            $video_item = array(
                'videoid' => $videoid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'videotitle' => $videotitle,
                'videodescription' => $videodescription,
                'videofilename' => $videofilename,
                'videourl' => $videourl,
                'videobanner' => $videobanner,
                'videobannerurl' => $video_base_url.$videobanner
            );
            array_push($video_api['artistvideo'],$video_item);
        }
        echo json_encode($video_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}
// MOST PLAYED SONG API Data Response
if(isset($_REQUEST['most_played_song']))
{
    $song_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$SONGIMAGEDIRURL;
    $result_song = $readData->readMostPlayedSongDetail();
    if(mysqli_num_rows($result_song)>0){
        $song_api = array();
        $song_api['mostplayedsong'] = array();
        while($song_row = mysqli_fetch_assoc($result_song)){
            extract($song_row);
            $song_item = array(
                'songid' => $songid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'songtitle' => $songtitle,
                'songdescription' => $songdescription,
                'songfilename' => $songfilename,
                'songurl' => $songurl,
                'songbanner' => $songbanner,
                'songbannerurl' => $song_banner_base_url.$songbanner,
                'time' => $time
            );
            array_push($song_api['mostplayedsong'],$song_item);
        }
        echo json_encode($song_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

// MOST PLAYED VIDEO API Data Response
if(isset($_REQUEST['most_played_video']))
{
    $video_banner_base_url = APIConstant::$HTTPS_SCHEME.$base_url.APIConstant::$VIDEOIMAGEDIRURL;
    $result_video = $readData->readMostPlayedVideoDetail();
    if(mysqli_num_rows($result_video)>0){
        $video_api = array();
        $video_api['mostplayedvideo'] = array();
        while($video_row = mysqli_fetch_assoc($result_video)){
            extract($video_row);
            $video_item = array(
                'videoid' => $videoid,
                'typeid' => $typeid,
                'artistid' => $artistid,
                'artistname' => $artistname,
                'languageid' => $languageid,
                'counter' => $counter,
                'videotitle' => $videotitle,
                'videodescription' => $videodescription,
                'videofilename' => $videofilename,
                'videourl' => $videourl,
                'videobanner' => $videobanner,
                'videobannerurl' => $video_banner_base_url.$videobanner,
                'time' => $time
            );
            array_push($video_api['mostplayedvideo'],$video_item);
        }
        echo json_encode($video_api);
    }else{
        echo json_encode(array('error' => array('message' => ' no data found...')));
    }
}

?>
