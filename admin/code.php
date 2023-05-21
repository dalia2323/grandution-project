<?php
include('../handler/db.php');
session_start();
if(!isset($_SESSION['admin'])){
  header('location:admin-login.php');
  exit();
}

$conn=mysqli_connect("localhost","root","","graduation_project");

?>
<?php

if(isset($_POST['update-btn'])){
    $id=$_POST['edit-id'];
$username=$_POST['edit-username'];
$email=$_POST['edit-email'];
$password=$_POST['edit-password'];
$query="UPDATE users set name='$username' ,email='$email',password='$password' where id='$id'";
$query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Update";
    header("location:handel-user.php");
}
else{
    $_SESSION['status']="Your Data  not Update";

}
}


// <!-- delete user -->
if(isset($_POST['delete-btn']))
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
if(isset($_POST['delete-btn1']))
{
    $id=$_POST['delete-id1'];
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
}


?>

<!-- handel Login Admin -->
<?php
if(isset($_POST['submit-admin'])){}
?>
<!-- Approval company  -->
<?php
// accept company 
if(isset($_POST['accept-btn']))
{
    $id=$_POST['accept-id'];

    $query="UPDATE  companies
    SET status= 'accept'
    WHERE id='$id'";

    $query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="this account is accept ";
    header("location:handel-company.php");

}
}
// reject company 
if(isset($_POST['reject-btn'])){
    $id=$_POST['reject-id']; 
       $query="UPDATE  companies
    SET status= 'accept'
    WHERE id='$id'";

    $query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="this account is accept ";
    header("location:handel-company.php");

}
}









?>