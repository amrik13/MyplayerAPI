<?php

if(isset($_SESSION['sess_email']) && isset($_SESSION['sess_password'])){
    echo "hello";
    session_start();
    $_SESSION['sess_email'] = "";
    $_SESSION['sess_password']="";
    if(session_destroy()){
        header("location:../");
    }
}else{
    header("location:../");
}

?>