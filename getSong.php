<!DOCTYPE html>
<html lang="en">
<body>
<?php
include 'player_db/Config.php';
include 'player_api/APIConstant.php';
$db = new Config();
$db->checkSession();
$conn = $db->connect_db();

// get song list depends on artist ID
if(isset($_REQUEST['table'])){
    $table = $_REQUEST['table'];
    $type = $_REQUEST['type'];
    $dedendedIdKey="artistid";
    if($type == "artist"){
        $dedendedIdKey="artistid";
    }
    if($type == "language"){
        $dedendedIdKey="languageid";
    }
    
    
    $Id = $_REQUEST['aid'];
    $sql = "SELECT * FROM ".$table." M LEFT JOIN artist A ON M.artistid=A.artistid "
            . "LEFT JOIN language L ON M.languageid=L.languageid WHERE M.".$dedendedIdKey."='$Id'";
    $rs = mysqli_query($conn, $sql);
    $contentcount = 1;
?>
  
<div class="table-responsive">
    <table id="data-table" class="table table-bordered" style="width:100%;" >
        <thead class="thead-default">
            <tr>
                <th style="width:5%">S. No.</th>
                <th style="width:5%">Song Id</th>
                <th>Language</th>
                <th>Artist Name</th>
                <th>Song Title</th>
                <th style="width:100%">Song Description</th>
                <th>Song URL</th>
                <th>Song Upload Time</th>
                <th>Song Banner</th>
            </tr>
        </thead>    
<?php
    while($row = mysqli_fetch_assoc($rs)){
        if($table=="song"){
            $contentid = $row['songid'];
            $contenttitle = $row['songtitle'];
            $contentLang = $row['languages'];
            $artistname = $row['artistname'];
            $contentdesc = $row['songdescription'];
            $contenturl = $row['songurl'];
            $contentfilename = $row['songfilename'];
            $contentUploadTime = $row['time'];
            $contentbanner = APIConstant::$SONGIMAGEDIRURL.$row['songbanner'];
        }
        if($table=="video"){
            $contentid = $row['videoid'];
            $contenttitle = $row['videotitle'];
            $contentLang = $row['languages'];
            $artistname = $row['artistname'];
            $contentdesc = $row['videodescription'];
            $contenturl = $row['videourl'];
            $contentfilename = $row['videofilename'];
            $contentUploadTime = $row['time'];
            $contentbanner = APIConstant::$VIDEOIMAGEDIRURL.$row['videobanner'];
        }
?>
    <tr>
        <td><?=$contentcount?></td>
        <td><?=$contentid?></td>
        <td><?=$contentLang?></td>
        <td><?=$artistname?></td>
        <td><?=$contenttitle?></td>
        <td style="width:100%"><?=$contentdesc?></td>
        <td><?=$contenturl?>
            <br>
        <?php 
            if($table=="song"){ ?>
            <audio style="width:80%;" controls>
            <source src="<?=APIConstant::$SONGDIRECTORYURL.$contentfilename?>">
            Your browser does not support the audio element.
            </audio>
        <?php } 
            if($table == "video"){ ?>
            <video style="width:100%;height:100px;" controls>
            <source src="<?=APIConstant::$VIDEODIRECTORYURL.$contentfilename?>">
                Your browser does not support the audio element.
            </video>  
        <?php }
        ?>
        </td>
        <td><?=$contentUploadTime?></td>
        <td>
        <center>
            <a href="<?=$contentbanner?>" target="_blank">
        <img src="<?=$contentbanner?>" style="width:100px;">
        </a>
        </center>
        </td>
    </tr>
    
<?php  
    $contentcount++;
    }
}

?>
 
    </table>
</div>
</body>
</html>