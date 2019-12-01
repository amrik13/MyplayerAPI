<?php 
if(isset($_REQUEST['uid'])){
    
    $userId = $_REQUEST['uid'];
} else{
     ?><script>
        alert("Error Occured,Come Back Again!!");
        window.location.href = "./";
    </script><?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
         <title>Myplayer</title>
        <link rel="icon" href="img/logo.png" type="image/png" sizes="32x32">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Vendor styles -->  
        <link rel="stylesheet" href="vendors/material-design-iconic-font/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/animate.css/animate.min.css">
        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
       
    </head>

    <body data-ma-theme="green">
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    Please Set Your Password!
                </div>
<style>
    #enb{
        display:none;
    }
    #showbtn{
        display: none;
    }
</style>
                <div class="login__block__body">
                    <form action="model/Post.php" method="post">
                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" onkeyup="showIP(this.value)" class="form-control" 
                                   autocomplete="off" required>
                            <input type="hidden" name="uid" value="<?=$userId?>" >
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                        
                        <div class="form-group form-group--float form-group--centered">
                            <input type="password" onkeyup="showHint(this.value)" class="form-control" 
                                   id="enb" autocomplete="off" name="new_pwd" required>
                            
                            <label>Confirm Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <br>
                        <span id="res1"></span>
                        <br><br>
                        <center>
                            <input id="showbtn" type="submit" class="btn btn--icon login__block__btn " 
                               name="set_pwd" value="GO" >
                        </center>
                        <br>
                    </form>
                </div>
            </div>
           
        </div>

        <!-- Vendors -->
        <script src="vendors/jquery/jquery.min.js"></script>
        <script src="vendors/popper.js/popper.min.js"></script>
        <script src="vendors/bootstrap/js/bootstrap.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
        
        <script>

            function showHint(str) {
                if (str.length == 0) {
                    return;
                } else {
                    
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.responseText=="ok"){
                                document.getElementById("showbtn").style.display = "block";
                                document.getElementById("res1").innerHTML = "";
                            }else{
                                document.getElementById("showbtn").style.display = "none";
                            }
                        }
                    }
                    xmlhttp.open("GET", "player_db/Verify.php?q2="+str, true);
                    xmlhttp.send();
                }
            }
            function showIP(str){
                if(str.length != 0 ){
                    document.getElementById("enb").style.display = "block";
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("res1").innerHTML = this.responseText;
                        }
                    }
                    xmlhttp.open("GET", "player_db/Verify.php?q1="+str, true);
                    xmlhttp.send();
                }
            }

        </script>

    </body>
    
</html>