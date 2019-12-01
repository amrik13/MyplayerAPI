<?php
include '../player_db/Config.php';
$db = new Config();
$conn = $db->connect_db();

if(isset($_REQUEST['q1'])){
    $pwd1 = $_REQUEST['q1'];
    $sql = "UPDATE checkPassword SET temppassword='$pwd1' WHERE id=1";
    mysqli_query($conn, $sql);
    if(!mysqli_affected_rows($conn)>0){
        echo "error occured!";
    }      
    
}

if(isset($_REQUEST['q2'])){
    $pwd2 = $_REQUEST['q2'];
    $sql = "SELECT temppassword from checkPassword WHERE id=1";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($rs);
    if($pwd2==$row['temppassword']){
        echo "ok";
    }else
    {
        echo "error occured!";
    }
}

?>