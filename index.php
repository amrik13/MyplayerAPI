
<?php 
session_start();
session_destroy();
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
        
        
<script>
function showPassword() {
  var x = document.getElementById("showP");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
        
    </head>

    <body data-ma-theme="green">
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    Hi there! Please Sign in

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-register" href="#">Create an account</a>
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <form action="model/Post.php" method="post">
                        <div class="form-group form-group--float form-group--centered">
                            <input type="email" class="form-control" autocomplete="off" name="lemail" required>
                            <label>Email Address</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="password" class="form-control"  autocomplete="off" name="lpwd" required >
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <input type="submit" class="btn btn--icon login__block__btn" name="user_login" value="IN" >
                    </form>
                </div>
            </div>

            <!-- Register -->
            <div class="login__block" id="l-register">
                <div class="login__block__header palette-Blue bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Create an account

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="#">Already have an account?</a>
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <form action="model/Post.php" method="post">
                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" class="form-control" autocomplete="off" name="namer" required>
                            <label>Name</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float form-group--centered">
                            <input type="email" class="form-control" autocomplete="off" name="emailr" required>
                            <label>Email Address</label>
                            <i class="form-group__bar"></i>

                        </div>
                        <span>Please Give Actual Email So that you can receive password recovery mail.. </span>
                        <div class="form-group form-group--float form-group--centered">
                            <input type="password" class="form-control" autocomplete="off" name="pwdr" id="showP" maxlength="8" required>
                            <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <input type="checkbox" onclick="showPassword()" style="margin-top:-30px;"> &nbsp;Show Password
                        <br><br>
                        <input type="submit" class="btn btn--icon login__block__btn" name="myplayer_user_reg" value="GO">
                    </form>
                </div>
            </div>

            <!-- Forgot Password -->
            <div class="login__block" id="l-forget-password">
                <div class="login__block__header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Forgot Password?

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="#">Already have an account?</a>
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-register" href="#">Create an account</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <p class="mt-4">Enter your registered mail-id and then check your mail..</p>
                    <form action="model/Post.php" method="post">   
                        <div class="form-group form-group--float form-group--centered">
                            <input type="text" name="pwd_reset_mail" class="form-control" autocomplete="off" required>
                            <label>Email Address</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <button name="forget_pwd_mail" type="submit" class="btn btn--icon login__block__btn">
                            <i class="zmdi zmdi-check"></i></button>
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
    </body>
</html>