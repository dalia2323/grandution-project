
<?php
include('../handler/db.php');
session_start();
if(!isset($_SESSION['admin'])){
    header('location:admin-login.php');
    exit();
  }


?>
<?php
if(isset($_POST['addternd'])){
                        $cityname = $_POST['cityname'];
                        $shopname = $_POST['shopname'];
                        $description= $_POST['description'];
                        $file = $_FILES['image'];
                        $sql = "INSERT INTO trendshops,cities (T_shope_name,description,image) VALUES ( $shopname, $description, $file) where cities.id=trendshops.cities_id and ceties.name=$cityname ";
                       
                       mysqli_query($conn,$sql);
                        
}
              ?>
                          