<?php
include('../handler/db.php');
session_start();
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


?>