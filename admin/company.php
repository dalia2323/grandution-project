
<?php
session_start();
if(!isset($_SESSION['company'])){
  header('location:../login.php');
  exit();

}

echo "hello"; 


?>
<a href="../logout.php"> logout</a>
