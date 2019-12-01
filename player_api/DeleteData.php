<?php

class DeleteData{
    
    private $conn;
    private $CAROUSEL_TABLE = "carousel";
    private $TOPIMAGE_TABLE='topimage';
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    //delete carousel from DB
    public function deleteCarousel($carousel_id){
        
        $dltImgFromDirSql  = "SELECT image FROM ".$this->CAROUSEL_TABLE." WHERE carouselid = '$carousel_id'";
        $rs = mysqli_query($this->conn, $dltImgFromDirSql);
        $imgRow = mysqli_fetch_assoc($rs);
        $image = $imgRow['image'];
        $dir = "../img/carouselbanner/";
        if(unlink($dir.$image)){
            $sql = "DELETE FROM ".$this->CAROUSEL_TABLE." WHERE carouselid = '$carousel_id'";
            mysqli_query($this->conn,$sql);
            if(mysqli_affected_rows($this->conn)){
                header("location:../Carousel.php");
            }else{
                echo 'Error occcured while deleting carousel Image from DB!';
            }
        
        } else{
             ?><script>
                alert("Sorry! Error While Deleting Carousel From Directory!");
                window.location.href = "../Carousel.php";
            </script><?php
        }
    }
     //delete TOPIMAGE from DB
    public function deleteTopImage($img_id){
        
        $dltImgFromDirSql  = "SELECT image FROM ".$this->TOPIMAGE_TABLE." WHERE topimageid = '$img_id'";
        $rs = mysqli_query($this->conn, $dltImgFromDirSql);
        $imgRow = mysqli_fetch_assoc($rs);
        $image = $imgRow['image'];
        $dir = "../img/topImageBlock/";
        if(unlink($dir.$image)){
            $sql = "DELETE FROM ".$this->TOPIMAGE_TABLE." WHERE topimageid = '$img_id'";
            mysqli_query($this->conn,$sql);
            if(mysqli_affected_rows($this->conn)){
                header("location:../top4ImageBlock.php");
            }else{
                echo 'Error occcured while deleting TOP Image from DB!';
            }
        
        } else{
             ?><script>
                alert("Sorry! Error While Deleting TopImg From Directory!");
                window.location.href = "../top4ImageBlock.php";
            </script><?php
        }
    }
    
}


?>