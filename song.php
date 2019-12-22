<?php

include 'player_db/Config.php';
include 'player_api/ReadData.php';
include 'player_api/APIConstant.php';
$db = new Config();
$db->checkSession();
$conn = $db->connect_db();
$readCategory = new ReadData($conn);
$result = $readCategory->readContetType();
$result1 = $readCategory->readArtist();
$result2 = $readCategory->readLanguage();
$result3 = $readCategory->readSongDetail();
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
                <header class="content__title">
                    <h1>Songs</h1>
                </header>
                <div class="row" role="tablist">
                        <ul class="container-fluid nav nav-tabs nav-fill" role="tablist"  style="width:100%;">
                            <li class="nav-item card">
                                <a style="background-color: transparent;color:gray;" class="nav-link " 
                                   data-toggle="tab" href="#addsong" role="tab">Add Song & Meta-Data Here</a>
                            </li>
                            <li class="nav-item card">
                                <a style="background-color: transparent;color:gray;" class="nav-link" 
                                   data-toggle="tab" href="#songlist" role="tab">Song List</a>
                            </li>
                        </ul>
                        <div class="container-fluid" style="width:100%;" >
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="addsong" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Add Songs</h5><br>
                                            <form action="model/Post.php" method="post" enctype="multipart/form-data">
                                                
                                                
                                                 <label>Select Artist</label>(first add artist in artist section if not present)
                                                <select name="song_artist" class="form-control" style="border:1px solid lightgray;padding-left:10px;" required>
                                                    
                                                    <?php 
                                                        while($row1 = mysqli_fetch_assoc($result1)){
                                                            $type1 = $row1['artistname'];
                                                            $typeId1 = $row1['artistid'];
                                                    ?>
                                                    <option value="<?=$typeId1?>"><?=$type1?></option>

                                                    <?php
                                                        } ?>
                                                </select>
                                                <br>
                                                 <label>Select Song Language</label>
                                                <select name="song_language" class="form-control" style="border:1px solid lightgray;padding-left:10px;" required>
                                                    
                                                    <?php 
                                                        while($row2 = mysqli_fetch_assoc($result2)){
                                                            $language = $row2['languages'];
                                                            $langId = $row2['languageid'];
                                                    ?>
                                                    <option value="<?=$langId?>"><?=$language?></option>

                                                    <?php
                                                        } ?>
                                                </select>
                                                 <br>
                                                 <label>Select Song Type</label>
                                                <select name="song_type" class="form-control" style="border:1px solid lightgray;padding-left:10px;" required>
                                                    
                                                    <?php 
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $type = $row['contenttype'];
                                                            $typeId = $row['typeid'];
                                                    ?>
                                                    <option value="<?=$typeId?>"><?=$type?></option>

                                                    <?php
                                                        } ?>
                                                </select>
                                                <br>
                                                <div class="form-group">
                                                    <label>Song Title</label>
                                                    <input autocomplete="off" type="text" name="song_title" class="form-control" placeholder="Enter Song Title Here:" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Song Description</label>
                                                    <input autocomplete="off" type="text" name="song_description" class="form-control" placeholder="Enter Song Description Here:" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Upload Song</label>(Only .mp3)
                                                    <input type="file" name="song_file" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Upload Song Banner Image</label>(.jpg/.jpeg/.png)
                                                    <input type="file" name="song_banner" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                <br>
                                                <input type="submit" name="upload_song_data" class="btn btn-outline-info">
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="songlist" role="tabpanel">
                                    <div class="card" style="width:100%;">
                                        <div class="card-body"  style="width:100%;">
                                          <h5>Song List</h5>
                                            <div class="table-responsive">
                                                <table id="data-table" class="table table-bordered" style="width:100%;" >
                                                    <thead class="thead-default">
                                                        <tr>
                                                            <th>S. No.</th>
                                                            <th>Song Id</th>
                                                            <th>Language</th>
                                                            <th>Artist Name</th>
                                                            <th>Song Title</th>
                                                            <th>Song Description</th>
                                                            <th>Song URL</th>
                                                            <th>Song Upload Time</th>
                                                            <th>Song Banner</th>
                                                        </tr>
                                                    </thead>

                                                  <?php 
                                                  $songcount = 1;
                                                        while($row3 = mysqli_fetch_assoc($result3)){
                                                          $songid = $row3['songid'];
                                                          $songtitle = $row3['songtitle'];
                                                          $songLang = $row3['languages'];
                                                          $artistname = $row3['artistname'];
                                                          $songdesc = $row3['songdescription'];
                                                          $songurl = $row3['songurl'];
                                                          $songfilename = $row3['songfilename'];
                                                          $songUploadTime = $row3['time'];
                                                          $songbanner = APIConstant::$SONGIMAGEDIRURL.$row3['songbanner'];
                                                  ?>
                                                            <tr>
                                                                <td><?=$songcount?></td>
                                                                <td><?=$songid?></td>
                                                                <td><?=$songLang?></td>
                                                                <td><?=$artistname?></td>
                                                                <td><?=$songtitle?></td>
                                                                <td><?=$songdesc?></td>
                                                                <td><?=$songurl?>
                                                                    <br>
                                                                <audio style="width:100%;" controls>
                                                                <source src="<?=APIConstant::$SONGDIRECTORYURL.$songfilename?>">
                                                                Your browser does not support the audio element.
                                                                </audio>
                                                                </td>
                                                                <td><?=$songUploadTime?></td>
                                                                <td>
                                                                <center>
                                                                    <a href="<?=$songbanner?>" target="_blank">
                                                                <img src="<?=$songbanner?>" style="width:150px;">
                                                                </a>
                                                                </center>
                                                                </td>
                                                            </tr>
                                                   
                                                    <?php 
                                                        $songcount++;
                                                    }
                                                    ?>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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