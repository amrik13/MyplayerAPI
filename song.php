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
                    
                    <div class="container-fluid" style="width:100%;">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item card">
                                <a style="background-color: transparent;color:gray;" class="nav-link " 
                                   data-toggle="tab" href="#type" role="tab">Add Song & Meta-Data Here</a>
                            </li>
                            <li class="nav-item card">
                                <a style="background-color: transparent;color:gray;" class="nav-link" 
                                   data-toggle="tab" href="#artist" role="tab">Song List</a>
                            </li>
                        </ul>
                        <div class="container-fluid" style="width:100%;" >
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="type" role="tabpanel">
                                    <div class="card">
                            <div class="card-body">
                                <h5>Add Songs</h5><br>
                                <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="email" class="form-control" placeholder="David Smith">
                                        <i class="form-group__bar"></i>
                                    </div>
                                
                           </div>
                        </div>
                                </div>
                                <div class="tab-pane fade" id="artist" role="tabpanel">
                                    <div class="card" style="width:100%;">
                                        <div class="card-body"  style="width:100%;">
                                          <h5>Artist List</h5>
                                            <div class="table-responsive">
                                                <table id="data-table" class="table table-bordered" style="width:100%;" >
                                                    <thead class="thead-default">
                                                        <tr>
                                                            <th>S. No.</th>
                                                            <th>Artist Id</th>
                                                            <th>Artist</th>
                                                        </tr>
                                                    </thead>

                                                    <?php
                                                        $count1 = 1;
                                                        while($row1 = mysqli_fetch_assoc($result1))
                                                        {      
                                                            $aid = $row1['artistid'];
                                                            $artist = $row1['artistname'];

                                                          ?>
                                                            <tr>
                                                                <td><?=$count1?></td>
                                                                <td><?=$aid?></td>
                                                                <td><?=$artist?></td>


                                                            </tr>
                                                        <?php 
                                                            $count1++;
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