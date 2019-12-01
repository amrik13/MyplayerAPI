<?php
include 'sidebar.php';
include 'player_db/Config.php';
include 'player_api/ReadData.php';
$db = new Config();
$db->checkSession();
$conn = $db->connect_db();
$readCarousel = new ReadData($conn);
$result = $readCarousel->readCarousel();
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

             <section class="content">
                <header class="content__title">
                    <h1>Carousel</h1>
                </header>
                <div class="row">
                    <div class="col-md-3">
                         <div class="card">
                            <div class="card-body">
                                  <h5>Update Carousel</h5><br>
                                  <form action="model/Post.php" method="post" enctype="multipart/form-data" >
                                      <input required type="text" name="carouseltitle" class="form-control" placeholder="Enter Carousel Title"
                                               autocomplete="off" style="border-bottom:1px solid lightgray;padding-left:1%;" >
                                        <br>
                                        <h6>Upload Banner</h6>
                                        <input required type="file"  name="carouselbanner" >
                                        <br><br>
                                        <input type="submit" value="SUBMIT" name="update_carousel" class="btn btn-outline-info" >
                                  </form>

                           </div>
                        </div>
                    </div>
                      
                    <div class="col-md-9">
                         <div id="myCarousel" class="carousel slide" data-ride="carousel">
                             <div class="carousel-inner">
                                 <?php
                                        $count1 = 1;
                                        $active ='';
                                        $sql1 = "SELECT * FROM carousel";
                                        $rs1 = mysqli_query($conn, $sql1);
                                    while($row1 = mysqli_fetch_assoc($rs1))
                                    {   
                                    ?>
                                <div class="item <?php if($count1==1){ $active='active'; echo $active; }
                                    else{ $active=''; echo $active;} ?>" >
                                      <img src="img/carouselbanner/<?=$row1['image']?>" alt="Los Angeles" style="width:100%;height:280px;">
                                </div>
                                    <?php 
                                            $count1++;
                                        }
                                    ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                    </div>
                </div>
                 <div class="card">
                    <div class="modal fade" id="modal-centered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title pull-left">Edit Carousel  <span></span></h5>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="model/Post.php?" enctype="multipart/form-data" >
                                        <div class="form-group">
                                            Enter Carousel Title: <br> 
                                            <input value="none" name="new_carousel_title" id="titleId" class="form-control textarea-autosize" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <input value="none" id="carouselIdd" name="carousel_id" type="hidden" >
                                        Upload Carousel Image: <br><br>
                                        <input type="file" name="new_carousel_banner" onchange="onImgLoad(this)" required>
                                        <br><br>
                                        <center>
                                            <img src="img/carouselbanner/error.png" id="imageId" style="width:180px;">
                                        </center>
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                        <input value="Save changes" type="submit" name="edit_carousel_form" class="btn btn-link">
                                    </form>
                                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                </div>
                            </div>
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
                                                    <th>Title</th>
                                                    <th>Image Name</th>
                                                    <th>Image</th>
                                                    <th>Action [Edit/Delete]</th>
                                                </tr>
                                            </thead>

                                            <?php
                                                $count = 1;
                                                while($row = mysqli_fetch_assoc($result))
                                                {      
                                                    $cid = $row['carouselid'];
                                                    $title = $row['title'];
                                                    $image = $row['image'];
                                                  ?>
                                                    <tr>
                                                        <td><?=$count?></td>
                                                        <td><?=$row['title']?></td>
                                                        <td><?=$row['image']?></td>
                                                        <td><center>
                                                            <a href="img/carouselbanner/<?=$row['image']?>" target="_blank">
                                                                <img src="img/carouselbanner/<?=$row['image']?>"
                                                                      title="CLICK TO SEE IMAGE"  style="width:120px;" >
                                                            </a>
                                                            </center>
                                                        </td>
                                                        <td><center>

                                                            <button onclick="editCarouselForm('<?=$cid?>','<?=$title?>','<?=$image?>')" style="cursor: pointer;background-color:transparent;border:none;" 
                                                                    data-toggle="modal" data-target="#modal-centered">         
                                                                <img src="img/editicon.jpg" title="EDIT" style="width:30px;" >
                                                            </button>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a href="model/Post.php?dlt=1&cid=<?=$cid?>">
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
<script>
     function editCarouselForm(carouselId,title,image){
          
        if(title.length != 0 ){
            document.getElementById("titleId").value = title+"";
            document.getElementById("imageId").src = "img/carouselbanner/"+image;
            document.getElementById("carouselIdd").value = carouselId+"";
        }
    }
    function onImgLoad(image2){
        //var str1 = image2;
        //var str = str1.toString().replace("C:\\fakepath\\","");
       if (image2.files && image2.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#imageId')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(image2.files[0]);
          }
        //document.getElementById("imageId").src = "C:\\fakepath\\"+str;
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