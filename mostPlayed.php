
<?php

include 'player_db/Config.php';
include 'player_api/ReadData.php';
include 'player_api/APIConstant.php';
$db = new Config();
$db->checkSession();
$conn = $db->connect_db();
$readCategory = new ReadData($conn);
$type= $_REQUEST['most_played'];
if(isset($type)){
    if($type == "song"){
        $result4 = $readCategory->readMostPlayedSongDetail();
    }else if($type == "video"){
        $result4 = $readCategory->readMostPlayedVideoDetail();
    }else{
        $result4 = null;
    }
}

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
                    <?php
                        if($type == "song"){
                            ?><h1>Most Played Songs</h1><?php
                        }else if($type == "video"){
                            ?><h1>Most Played Videos</h1><?php
                        }else{
                        }
                    ?>
                    
                </header>
                <div class="row">
                       
                        <div class="container-fluid" style="width:100%;" >
                            <div class="" >
                                
                                <div class="" >
                                    <div class="card" style="width:100%;">
                                        <div class="card-body"  style="width:100%;">
                                            <br>
                                            <div class="table-responsive" id="list">
                                                <table id="data-table" class="table table-bordered" style="width:100%;" >
                                                    <thead class="thead-default">
                                                         <?php
                                                            if($type == "song"){
                                                                ?>
                                                                    <tr>
                                                                        <th>S. No.</th>
                                                                        <th>Song Id</th>
                                                                        <th>Language</th>
                                                                        <th>Artist Name</th>
                                                                        <th>Song Title</th>
                                                                        <th>Counter</th>
                                                                        <th>Song Description</th>
                                                                        <th>Song URL</th>
                                                                        <th>Song Upload Time</th>
                                                                        <th>Song Banner</th>
                                                                    </tr>
                                                                    
                                                                <?php
                                                            }else if($type == "video"){
                                                                ?>
                                                                    <tr>
                                                                        <th>S. No.</th>
                                                                        <th>Video Id</th>
                                                                        <th>Language</th>
                                                                        <th>Artist Name</th>
                                                                        <th>Video Title</th>
                                                                        <th>Counter</th>
                                                                        <th>Video Description</th>
                                                                        <th>Video URL</th>
                                                                        <th>Video Upload Time</th>
                                                                        <th>Video Banner</th>
                                                                    </tr>
                                                    
                                                                <?php
                                                            }else{
                                                            }
                                                        ?>
                                                        
                                                    </thead>

                                                        <?php 
                                                        $contentcount = 1;
                                                        while($row4 = mysqli_fetch_assoc($result4)){
                                                            if($type=="song"){
                                                                $contentid = $row4['songid'];
                                                                $contenttitle = $row4['songtitle'];
                                                                $contentLang = $row4['languages'];
                                                                $artistname = $row4['artistname'];
                                                                $counter = $row4['counter'];
                                                                $contentdesc = $row4['songdescription'];
                                                                $contenturl = $row4['songurl'];
                                                                $contentfilename = $row4['songfilename'];
                                                                $contentUploadTime = $row4['time'];
                                                                $contentbanner = APIConstant::$SONGIMAGEDIRURL.$row4['songbanner'];
                                                            }else if($type == "video"){
                                                                $contentid = $row4['videoid'];
                                                                $contenttitle = $row4['videotitle'];
                                                                $contentLang = $row4['languages'];
                                                                $artistname = $row4['artistname'];
                                                                $counter = $row4['counter'];
                                                                $contentdesc = $row4['videodescription'];
                                                                $contenturl = $row4['videourl'];
                                                                $contentfilename = $row4['videofilename'];
                                                                $contentUploadTime = $row4['time'];
                                                                $contentbanner = APIConstant::$VIDEOIMAGEDIRURL.$row4['videobanner'];
                                                            }
                                                          //echo $videobanner;
                                                        ?>
                                                            <tr>
                                                                <td><?=$contentcount?></td>
                                                                <td><?=$contentid?></td>
                                                                <td><?=$contentLang?></td>
                                                                <td><?=$artistname?></td>
                                                                <td><?=$contenttitle?></td>
                                                                <td><?=$counter?></td>
                                                                <td><?=$contentdesc?></td>
                                                                <td><?=$contenturl?>
                                                                    <br>
                                                                    
                                                                <?php
                                                                   if($type == "song"){
                                                                       ?>
                                                                        <audio style="width:80%;" controls>
                                                                            <source src="<?=APIConstant::$SONGDIRECTORYURL.$contentfilename?>">
                                                                            Your browser does not support the audio element.
                                                                        </audio>
                                                                        <?php
                                                                   }else if($type == "video"){
                                                                       ?>
                                                                       <video style="width:100%;height:100px;" controls>
                                                                            <source src="<?=APIConstant::$VIDEODIRECTORYURL.$contentfilename?>">
                                                                            Your browser does not support the audio element.
                                                                        </video>
                                                                        <?php
                                                                   }else{
                                                                   }
                                                                ?>    
                                                                </td>
                                                                <td><?=$contentUploadTime?></td>
                                                                <td>
                                                                <center>
                                                                    <a href="<?=$contentbanner?>" target="_blank">
                                                                <img src="<?=$contentbanner?>" style="width:150px;">
                                                                </a>
                                                                </center>
                                                                </td>
                                                            </tr>
                                                   
                                                    <?php 
                                                        $contentcount++;
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