<?php
include 'sidebar.php';
include 'player_db/Config.php';
include 'player_api/ReadData.php';
$db = new Config();
$db->checkSession();
$conn = $db->connect_db();
$readTopImg = new ReadData($conn);
$result = $readTopImg->readTopImage();
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


             <section class="content">
                <header class="content__title">
                    <h1><b>Top Image Block</b></h1>
                    Note: Top 4 Images Will Be Selected
                </header>
                <div class="row">
                    <div class="col-md-4">
                         <div class="card">
                            <div class="card-body">
                                  <h5>Upload Images</h5><br>
                                  <form action="model/Post.php" method="post" enctype="multipart/form-data" >
                                     
                                        <input required type="file"  name="topImage"required>
                                        <br><br>
                                        <input type="submit" value="SUBMIT" name="upload_top_image" class="btn btn-outline-info" >
                                  </form>

                           </div>
                        </div>
                    </div>
                      
                    <div class="col-md-8">
                        <div class="row">
                                
                                <?php
                                    $count1 = 1;
                                    $active ='';
                                    $sql1 = "SELECT * FROM topimage";
                                    $rs1 = mysqli_query($conn, $sql1);
                                    while($row1 = mysqli_fetch_assoc($rs1))
                                    {   
                                    ?>
                                    <div class="col-md-3">
                                        <center>
                                            Image - <?=$count1."<br><br>"?>
                                            <img src="img/topImageBlock/<?=$row1['image']?>" alt="Los Angeles" style="width:70%;">
                                        </center>
                                      </div>
                                     <?php 
                                            $count1++;
                                        }
                                ?>
                                   `
                           
                        </div>
                    </div>
                </div>
                 <div >
                      <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="width:100%;">
                                <div class="card-body"  style="width:100%;">
                                  <h5>Carousel list</h5>
                                    <div class="table-responsive">
                                        <table id="data-table" class="table table-bordered" style="width:100%;" >
                                            <thead class="thead-default">
                                                <tr>
                                                    <th>S. No.</th>
                                                    <th>Image Name</th>
                                                    <th>Image</th>
                                                    <th>Action [Delete]</th>
                                                </tr>
                                            </thead>

                                            <?php
                                                $count = 1;
                                                while($row = mysqli_fetch_assoc($result))
                                                {      
                                                    $image = $row['image'];
                                                    $topImgId = $row['topimageid'];
                                                  ?>
                                                    <tr>
                                                        <td><?=$count?></td>
                                                        <td><?=$image?></td>
                                                        <td><center>
                                                            <a href="img/topImageBlock/<?=$image?>" target="_blank">
                                                                <img src="img/topImageBlock/<?=$image?>"
                                                                      title="CLICK TO SEE IMAGE"  style="width:50px;" >
                                                            </a>
                                                            </center>
                                                        </td>
                                                        <td><center>
                                                            <a href="model/Post.php?dltTopImg=1&topImgid=<?=$topImgId?>">
                                                                <img src="img/dlticon.png" title="DELETE" style="width:30px;" >
                                                            </a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                <?php 
                                                    $count++;
                                                }
                                            ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                     
                 
                <footer class="footer hidden-xs-down">
                    <p> | © 2019 Myplayer | </p>

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