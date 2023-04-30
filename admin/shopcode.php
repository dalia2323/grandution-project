<?php
include('../handler/db.php');
session_start();
$conn=mysqli_connect("localhost","root","","graduation_project");

?>
<?php

if(isset($_POST['update-btn'])){
    $id = $_POST['edit-id'];
    $cityname = $_POST['edit-city'];
    $streetname = $_POST['edit-street'];
    $categoryname = $_POST['edit-category'];
    $shopname = $_POST['edit-shopname'];
    $image = $_POST['edit-shopimage'];
    
    $query = "UPDATE cities 
              INNER JOIN streets ON cities.id=streets.cities_id
              INNER JOIN shops ON streets.id=shops.street_id
              INNER JOIN categories ON categories.id = shops.category_id
           
              SET cities.cityname='$cityname',
                  streets.streetname='$streetname',
                  categories.categoryname='$categoryname',
                  shops.shopname='$shopname',
                  shops.image='$image'
              WHERE shops.id='$id'";
              
    $query_run = mysqli_query($conn, $query);
    
    if($query_run){
        $_SESSION['success'] = "The data is updated successfully";
        header("location: show.php");
    }
    else{
        $_SESSION['status'] = "The data is not updated";
    }
}




if(isset($_POST['delete-btn']))
{
    $id=$_POST['delete-id'];
    $query="DELETE FROM shops WHERE id='$id'";
    $query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Deleted";
    header("location:show.php");

}
else{
    $_SESSION['status']="Your Data NOT Deleted";
    header("show-user.php");
}
}



?>