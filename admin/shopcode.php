<?php
include('../handler/db.php');
session_start();
$conn=mysqli_connect("localhost","root","","graduation_project");

?>
<?php

if(isset($_POST['update-btn'])){
    $id=$_POST['edit-id'];
$cityname=$_POST['edit-city'];
$streetname=$_POST['edit-street'];
$categoryname=$_POST['edit-category'];
$shopname=$_POST['edit-shopname'];
$image=$_POST['edit-shopimage'];
$query="UPDATE users set 	cityname='$cityname' ,streetname='$streetname',categoryname='$categoryname'shopname='$shopname'image='$image' where id='$id'";
$query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="the Data Is Update";
    header("location:show.php");
}
else{
    $_SESSION['status']="the Data  not Update";

}
}


// <!-- delete user -->
/*if(isset($_POST['delete-btn']))
{
    $id=$_POST['delete-id'];
    $query="DELETE FROM USERS WHERE id='$id'";
    $query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Deleted";
    header("location:handel-user.php");

}
else{
    $_SESSION['status']="Your Data NOT Deleted";
    header("location:handel-user.php");
}
}
// Delete company
if(isset($_POST['delete-btn']))
{
    $id=$_POST['delete-id'];
    $query="DELETE FROM companies WHERE id='$id'";
    $query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Deleted";
    header("location:handel-company.php");

}
else{
    $_SESSION['status']="Your Data NOT Deleted";
    header("location:handel-company.php");
}
}*/


?>