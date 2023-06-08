<?php
include('../handler/db.php');
session_start();
if(!isset($_SESSION['admin'])){
    header('location:admin-login.php');
    exit();
  }


  if(isset($_POST['add-trend'])){
    $city=$_POST['cityname'];
    $shopName=$_POST['shop-name'];
    $description=$_POST['description'];
    $shopImag=$_FILES['shopeimage']['name'];
    $target="../images/trends/".$shopImag;
    $shopImagTempName = $_FILES['shopeimage']['tmp_name'];
     $query="INSERT INTO trendshops (`T_shope_name`, `cities_id`,`description`,`image` ) 
    VALUES ('$shopName', (SELECT id FROM cities WHERE cityname = ' $city'),'$description','$shopImag')";
    $insert_query=mysqli_query($conn,$query);
    if($insert_query){
      move_uploaded_file($shopImagTempName,$target);
      $massege[]="shop added successfully";
      header('location:show-trendshop.php');
    }
    else{
      $massege[]="shop not added";
    }
  }
              ?>
                          