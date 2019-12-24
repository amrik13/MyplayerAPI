
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
$result4 = $readCategory->readVideoDetail();
$artist_select = $readCategory->readArtist();
$lang_select = $readCategory->readLanguage();
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
                    <h1>Videos</h1>
                </header>
                <div class="row" role="tablist">
                        <ul class="container-fluid nav nav-tabs nav-fill" role="tablist"  style="width:100%;">
                            <li class="nav-item card">
                                <a style="background-color: transparent;color:gray;" class="nav-link " 
                                   data-toggle="tab" href="#addsong" role="tab">Add Videos & Meta-Data Here</a>
                            </li>
                            <li class="nav-item card">
                                <a style="background-color: transparent;color:gray;" class="nav-link" 
                                   data-toggle="tab" href="#songlist" role="tab">Video List</a>
                            </li>
                        </ul>
                        <div class="container-fluid" style="width:100%;" >
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="addsong" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Add Video</h5><br>
                                            <form action="model/Post.php" method="post" enctype="multipart/form-data">
                                                
                                                
                                                <label>Select Artist</label>(first add in artist section if not present)
                                                <select name="video_artist" class="form-control" style="border:1px solid lightgray;padding-left:10px;" required>
                                                    
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
                                                 <label>Select Video Language</label>
                                                <select name="video_language" class="form-control" style="border:1px solid lightgray;padding-left:10px;" required>
                                                    
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
                                                 <label>Select Video Type</label>
                                                <select name="video_type" class="form-control" style="border:1px solid lightgray;padding-left:10px;" required>
                                                    
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
                                                    <label>Video Title</label>
                                                    <input autocomplete="off" type="text" name="video_title" class="form-control" placeholder="Enter Song Title Here:" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Video Description</label>
                                                    <input autocomplete="off" type="text" name="video_description" class="form-control" placeholder="Enter Song Description Here:" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Upload Video</label>(Only .mp4)
                                                    <input type="file" name="video_file" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Upload Video Banner Image</label>(.jpg/.jpeg/.png)
                                                    <input type="file" name="video_banner" required>
                                                    <i class="form-group__bar"></i>
                                                </div>
                                                <br>
                                                <input type="submit" name="upload_video_data" class="btn btn-outline-info">
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="songlist" role="tabpanel">
                                    <div class="card" style="width:100%;">
                                        <div class="card-body"  style="width:100%;">
                                          <div class="row">
                                                <div class="col-md-2">
                                                    <h5>Video List</h5>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Select Artist</label>
                                                    <select onclick="myFunction(this.value,'artist')" style="padding-left:2%;width:60%;border:1px solid #CFCFCF;" class="form-control">
                                                        <option value="none">None</option>
                                                         <?php 
                                                        while($row_art = mysqli_fetch_assoc($artist_select)){
                                                             $art2 = $row_art['artistname'];
                                                            $artId2 = $row_art['artistid'];
                                                        ?>
                                                        <option value="<?=$artId2?>"><?=$art2?></option>
                                                        <?php
                                                            } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                     <label>Select Language</label>
                                                     <select onclick="myFunction(this.value,'language')" style="padding-left:2%;width:60%;border:1px solid #CFCFCF;" class="form-control">
                                                    <option value="none">None</option>
                                                    <?php 
                                                        while($lang_row = mysqli_fetch_assoc($lang_select)){
                                                            $language1 = $lang_row['languages'];
                                                            $langId1 = $lang_row['languageid'];
                                                    ?>
                                                    <option value="<?=$langId1?>"><?=$language1?></option>

                                                    <?php
                                                        } ?>
                                                </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div id="showhere"></div>
                                            <div class="table-responsive" id="list">
                                                <table id="data-table" class="table table-bordered" style="width:100%;" >
                                                    <thead class="thead-default">
                                                        <tr>
                                                            <th>S. No.</th>
                                                            <th>Video Id</th>
                                                            <th>Language</th>
                                                            <th>Artist Name</th>
                                                            <th>Video Title</th>
                                                            <th>Video Description</th>
                                                            <th>Video URL</th>
                                                            <th>Video Upload Time</th>
                                                            <th>Video Banner</th>
                                                        </tr>
                                                    </thead>

                                                  <?php 
                                                  $videocount = 1;
                                                        while($row4 = mysqli_fetch_assoc($result4)){
                                                          $videoid = $row4['videoid'];
                                                          $videotitle = $row4['videotitle'];
                                                          $videoLang = $row4['languages'];
                                                          $artistname = $row4['artistname'];
                                                          $videodesc = $row4['videodescription'];
                                                          $videourl = $row4['videourl'];
                                                          $videofilename = $row4['videofilename'];
                                                          $videoUploadTime = $row4['time'];
                                                          $videobanner = APIConstant::$VIDEOIMAGEDIRURL.$row4['videobanner'];
                                                          //echo $videobanner;
                                                  ?>
                                                            <tr>
                                                                <td><?=$videocount?></td>
                                                                <td><?=$videoid?></td>
                                                                <td><?=$videoLang?></td>
                                                                <td><?=$artistname?></td>
                                                                <td><?=$videotitle?></td>
                                                                <td><?=$videodesc?></td>
                                                                <td><?=$videourl?>
                                                                    <br>
                                                                <video style="width:100%;height:100px;" controls>
                                                                <source src="<?=APIConstant::$VIDEODIRECTORYURL.$videofilename?>">
                                                                Your browser does not support the audio element.
                                                                </video>
                                                                </td>
                                                                <td><?=$videoUploadTime?></td>
                                                                <td>
                                                                <center>
                                                                    <a href="<?=$videobanner?>" target="_blank">
                                                                <img src="<?=$videobanner?>" style="width:150px;">
                                                                </a>
                                                                </center>
                                                                </td>
                                                            </tr>
                                                   
                                                    <?php 
                                                        $videocount++;
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

<script>
function myFunction(id,type) {
  var xhttp;
  if (id == "none") {
      document.getElementById("list").style.display = "block";
      document.getElementById("showhere").style.display = "none";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("list").style.display = "none";
        document.getElementById("showhere").style.display = "block";
        document.getElementById("showhere").innerHTML = this.responseText;
        
    }
  };
  xhttp.open("GET", "getSong.php?table=video&type="+type+"&aid="+id, true);
  xhttp.send();
}

</script>
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