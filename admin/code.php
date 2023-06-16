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
//update company pending
if(isset($_POST['update-btn2'])){
    $id=$_POST['edit-id'];
$username=$_POST['edit-username'];
$email=$_POST['edit-email'];
$password=$_POST['edit-password'];
$phonNumber=$_POST['edit-phone'];
$query="UPDATE companies set name='$username' ,email='$email',
phone_number='$phonNumber',password='$password' where id='$id'";
$query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Update";
    header("location:handel-company.php");
}
else{
    $_SESSION['status']="Your Data  not Update";

}
}
// Delete company pending
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
//update accept company
if(isset($_POST['update-btn-accept'])){
    $id=$_POST['edit-id-accept'];
$username=$_POST['edit-username'];
$email=$_POST['edit-email'];
$password=$_POST['edit-password'];
$phonNumber=$_POST['edit-phone'];
$query="UPDATE companies set name='$username' ,email='$email',
phone_number='$phonNumber',password='$password' where id='$id'";
$query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Update";
    header("location:accept-company.php");
}
else{
    $_SESSION['status']="Your Data  not Update";

}
}
//delete accept company
if(isset($_POST['delete-btn1-accept']))
{
    $id=$_POST['delete-id1-accept'];
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
//edit trend shop
if(isset($_POST['update-btn3'])){
    $id=$_POST['edit-id'];
$username=$_POST['edit-username'];
$desc=$_POST['edit-descrption'];
$image=$_FILES['edit-img'];
$shopImagName = $image['name'];
$shopImagTemp = $image['tmp_name'];
$t = time();
$nowDate = date('Y-m-d',$t);
$randomString = "$nowDate".hexdec(uniqid());
$ext=pathinfo( $shopImagName,PATHINFO_EXTENSION);
$newImgName="$randomString.$ext";
move_uploaded_file($shopImagTemp,"../city/$newImgName");

$query="UPDATE trendshops set T_shope_name='$username' ,description='$desc',
image='$newImgName' where id='$id'";
$query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Update";
    header("location:show-trendshop.php");
}
else{
    $_SESSION['status']="Your Data  not Update";

}
}
//delete trend shop
if(isset($_POST['delete-btn3']))
{
    $id=$_POST['delete-id3'];
    $query="DELETE FROM trendshops WHERE id='$id'";
    $query_run=mysqli_query($conn,$query);
if($query_run){
    $_SESSION['success']="Your Data Is Deleted";
    header("location:show-trendshop.php");

}
else{
    $_SESSION['status']="Your Data NOT Deleted";
    header("location:show-trendshop.php");
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