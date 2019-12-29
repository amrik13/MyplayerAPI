<?php

include 'player_db/Config.php';
include 'player_api/ReadData.php';
$db = new Config();
$db->checkSession();
$conn = $db->connect_db();
$readCategory = new ReadData($conn);
$result = $readCategory->readContetType();
$result1 = $readCategory->readArtist();
$result2 = $readCategory->readLanguage();
$result3 = $readCategory->readLanguage();
$result4 = $readCategory->readLanguage();
$result5 = $readCategory->readArtist();
$result6 = $readCategory->readArtist();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>MyPlayer - Dashboard </title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/logo.png" type="image/png" >
        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/material-design-iconic-font/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/jquery-scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="vendors/fullcalendar/fullcalendar.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
    </head>

    <body data-ma-theme="green">
        <main class="main">
            <!-- loader -->
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">

                <!-- toggle button -->
                <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                 <!-- title logo -->   
                <div class="header__logo hidden-sm-down">
                    <span><a href="" style="font-size: 22px;color:white;"><img src="img/logo.png" width="60" >Myplayer</a></span>
                </div>
                 
                  <ul class="top-nav dropdown1">
                    <li class="dropdown">
                        <a href="model/Logout.php" class="dropdown">
                            <img src="img/logout.png" />
                        </a>
                    </li>

                   
                </ul>
                 
            </header>
<?php
include 'sidebar.php';
?>
             <section class="content">
                 <div class="card">
                    <div class="card-body">
                        <h5 style="text-align:center;">DEMO API Request Call</h5><br><br>
                        <div class="row" role="tablist">
                            <div class="col-md-2">
                            <!--<form action="model/Post.php" method="post" enctype="multipart/form-data">
                                    <input required type="text" name="contentType" class="form-control" placeholder="Type-Eg. Song or Video..."
                                             autocomplete="off" style="border-bottom:1px solid lightgray;padding-left:1%;" >
                                    <br>        
                                    <input type="submit" value="SEND API REQUEST" name="content_type_submit" class="btn btn-outline-info" >
                                </form>-->
                            <center>
<!--// Request Carousel API Call Without Filter-->                            
                            <form action="player_api/call_api_request.php" target="_blank" method="get">
                                <input type="submit" value="CAROUSEL" name="all_carousel_data" class="btn btn-outline-info" >
                            </form>
                            </center>
                        </div>
                        <div class="col-md-2">
                            <center>
    <!--// Request TOP Image API Call Without Filter-->                            
                            <form action="player_api/call_api_request.php" target="_blank" method="get">
                                <input type="submit" value="TOP IMAGE" name="top_image_data" class="btn btn-outline-info" >
                            </form>
                            </center>
                        </div>
                        <div class="col-md-2">
                            <center>
<!--// Request Artist API Call Without Filter-->                            
                            <form action="player_api/call_api_request.php" target="_blank" method="get">
                                <input type="submit" value="ARTIST" name="artist_data" class="btn btn-outline-info" >
                            </form>
                            </center>
                        </div>
                        <div class="col-md-2">
                            <center>
<!--// Request CONTENT TYPE API Call Without Filter-->                            
                            <form action="player_api/call_api_request.php" target="_blank" method="get">
                                <input type="submit" value="CONTENT TYPE" name="content_type_data" class="btn btn-outline-info" >
                            </form>
                            </center>
                        </div>
                        <div class="col-md-2">
                            <center>
<!--// Request LANGUAGE API Call Without Filter-->                            
                            <form action="player_api/call_api_request.php" target="_blank" method="get">
                                <input type="submit" value="LANGUAGE" name="language_data" class="btn btn-outline-info" >
                            </form>    
                            </center>
                        </div>
                        <div class="col-md-2">
                            <center>
<!--// Request User Details API Call Without Filter-->                            
                            <form action="player_api/call_api_request.php" target="_blank" method="get">
                                <input type="submit" value="USER DETAIL" name="user_detail_data" class="btn btn-outline-info" >
                            </form>    
                            </center>
                        </div>
                    </div>
                        <br><br>
                    <div class="row" role="tablist">
                        <div class="col-md-6">
                        <!--<form action="model/Post.php" method="post" enctype="multipart/form-data">
                                <input required type="text" name="contentType" class="form-control" placeholder="Type-Eg. Song or Video..."
                                         autocomplete="off" style="border-bottom:1px solid lightgray;padding-left:1%;" >
                                <br>        
                                <input type="submit" value="SEND API REQUEST" name="content_type_submit" class="btn btn-outline-info" >
                            </form>-->
                        <center>
<!--// Request All Song API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <input type="submit" value="ALL SONG" name="all_song_data" style="width:80%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                    <div class="col-md-6">
                        <center>
<!--// Request ALl Video API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <input type="submit" value="ALL VIDEO" name="all_video_data" style="width:80%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request Latest Song API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <input type="submit" value="LATEST SONG" name="latest_song" style="width:80%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request Latest VIDEO API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <input type="submit" value="LATEST VIDEO" name="latest_video" style="width:80%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request DICSCOVER SONG(Language Specific Content) API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <select name="discover_song"  required>
                                <option value="" >None</option>
                                <?php
                                while ($row_discover = mysqli_fetch_assoc($result3)){
                                    $language = $row_discover['languages'];
                                    $languageid = $row_discover['languageid'];
                                ?>
                                <option value="<?=$languageid?>"><?=$language?></option>
                                <?php } ?>
                            </select>
                            
                            <input type="submit" value="DICSCOVER SONG" name="discover_song_content" style="width:60%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request DICSCOVER VIDEO(Language Specific Content) API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <select name="discover_video"  required>
                                <option value="" >None</option>
                                <?php
                                while ($row_discover1 = mysqli_fetch_assoc($result4)){
                                    $language1 = $row_discover1['languages'];
                                    $languageid1 = $row_discover1['languageid'];
                                ?>
                                <option value="<?=$languageid1?>"><?=$language1?></option>
                                <?php } ?>
                            </select>
                            
                            <input type="submit" value="DICSCOVER VIDEO" name="discover_video_content" style="width:60%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request ARTIST SONG(Language Specific Content) API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <select name="artist_song"  required>
                                <option value="" >None</option>
                                <?php
                                while ($row_artist = mysqli_fetch_assoc($result5)){
                                    $artist = $row_artist['artistname'];
                                    $artistid = $row_artist['artistid'];
                                ?>
                                <option value="<?=$artistid?>"><?=$artist?></option>
                                <?php } ?>
                            </select>
                            
                            <input type="submit" value="ARTIST-SONG" name="artist_song_content" style="width:60%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request ARTIST VIDEO(Language Specific Content) API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <select name="artist_video"  required>
                                <option value="" >None</option>
                                 <?php
                                while ($row_artist1 = mysqli_fetch_assoc($result6)){
                                    $artist1 = $row_artist1['artistname'];
                                    $artistid1 = $row_artist1['artistid'];
                                ?>
                                <option value="<?=$artistid1?>"><?=$artist1?></option>
                                <?php } ?>
                            </select>
                            
                            <input type="submit" value="ARTIST-VIDEO" name="artist_video_content" style="width:60%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request Most Played Song API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <input type="submit" value="MOST-PLAYED-SONG" name="most_played_song" style="width:80%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                        
                    <div class="col-md-6">
                        <br>
                        <center>
<!--// Request Most Played VIDEO API Call Without Filter-->                            
                        <form action="player_api/call_api_request.php" target="_blank" method="get">
                            <input type="submit" value="MOST-PLAYED-VIDEO" name="most_played_video" style="width:80%;" class="btn btn-outline-info" >
                        </form>
                        </center>
                    </div>
                </div>
            </div>
                 
                <footer class="footer hidden-xs-down">
                    <p> | © 2019 Myplayer | </p>
                    <br>

                </footer>
            </section>
        </main>


        <!-- Javascript -->
        <!-- Vendors -->
        <script src="vendors/jquery/jquery.min.js"></script>
        <script src="vendors/popper.js/popper.min.js"></script>
        <script src="vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <!-- Vendors: Data tables -->
        <script src="vendors/datatables/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables-buttons/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables-buttons/buttons.print.min.js"></script>
        <script src="vendors/jszip/jszip.min.js"></script>
        <script src="vendors/datatables-buttons/buttons.html5.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
    </body>


</html>