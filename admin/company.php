
<?php
session_start();
if(!isset($_SESSION['user'])){
  header('location:../login.php');
  exit();

}
echo "hello"; 


?>
<a href="../logout.php"> logout</a>
