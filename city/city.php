<?php session_start();
include('../handler/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css -->
    <link rel="stylesheet" href="../css/qalqiliapage.css" />
    <!-- font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Text&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,700&display=swap" rel="stylesheet"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300&family=Montserrat:wght@600&display=swap" rel="stylesheet">
<!-- add icon -->
 <link rel="icon" type="image/x-icon" href="../img/icon.png">
 <link rel="stylesheet" href="../css/all.min.css">
    <title>Qalqilia page</title>
</head>
<style>
  /* width */
  ::-webkit-scrollbar {
    width: 10px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    /* border-radius: 50px; */
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #a8bdb1; 
    border-radius: 50px;
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #c8d6cd; 
  }
  </style>
<body class="qalqiliapage">
    
    <div class="navbar">
      <div class="logo"></div>
      <!-- <div class="city">
        <h1> City Guide </h1>
      </div> -->
    
      <a href="../cityGuide.php" title="Home page">
        <div class="homePage"> </div>
      </a>
      <a href="#" title="profile">
        <div class="profile"></div>
      </a>
      <a href="#" title="Logout">
        <div class="Logout"></div>
      </a>
      
    </div>
    <div class="main">
      <div class="center">
        <div class="parent">
          <div class="child">
        <div class="qalqilia-city">
          <i class="fa-sharp fa-solid fa-city "
          style="font-size:35px;color:#3c8067;""></i>
         <?php 
         if (isset($_SESSION['cityName'])) {
          // Sanitize input
          $cityName = filter_var($_SESSION['cityName'], FILTER_SANITIZE_STRING);
        echo '<h1 style="font-size:45px; padding-left: 10px;font-family: "Fraunces", serif;text-transform: uppercase;">' . $cityName . '</h1>';}?>
        </div>
      </div>
      </div>
        <div id="street">choose street </div>
        <div  class="streets">

        <?php
if (isset($_SESSION['cityName'])) {
    // Sanitize input
    $cityName = filter_var($_SESSION['cityName'], FILTER_SANITIZE_STRING);

    $query = "SELECT streets.streetname as street
              FROM cities
              INNER JOIN streets ON cities.id = streets.cities_id
              WHERE cities.cityname = '$cityName'";

    $query_run = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($query_run)) {
        ?>
        <form action="" method="post">
        <button name="street-btn" class="street"><?php echo $row['street']; ?></button>
        </form>
        <?php
    }
}
?>

      </div>
     <div class="category-section">
      <!-- <div class="type-title">Choose Category</div> -->
     <div class="type">
      <form action="" method="post">
      <?php
      $sql="select * from categories";
      $query_run=mysqli_query($conn,$sql);
      foreach($query_run as $row)
      {?>
      <button class="icons" name="category-btn" title="<?php echo $row['categoryname']?>"><i class="<?php echo $row['icone']?>"></i></button>
      </form>
      <?php  }?>
     </div>
     </div>
     
     <div class="top">
      <div class="trend"><p> Trending Shop</p></div>
     <!-- <div class="img-trend"><img src="../img/Qalqilia page Imag/trend.png" style="height: 200px; width: 424px;margin-top: -48px;" ></div> -->
     </div>
     <div class="shop-trind"> 
  <div class="shops"> 
  <?php
     if (isset($_SESSION['cityName'])) {
  if (isset($_POST['street-btn'])){
   if(isset($_POST['category-btn'])) {
    $streetName = $_POST['street-btn'];
    $categoryName = $_POST['category-btn'];
    $query ="SELECT shops.shopname as shop,shops.image as image
     FROM cities
      INNER JOIN streets ON cities.id = streets.cities_id
      INNER JOIN shops ON streets.id = shops.street_id 
      INNER JOIN categories ON shops.category_id = categories.id 
      WHERE cities.cityname = '$cityName' AND streets.streetname = '$streetName'
      AND categories.categoryname = '$categoryName'";
      $query_run = mysqli_query($conn, $query);  
      while ($row = mysqli_fetch_assoc($query_run)) {
        ?>
      <div class="imgshop">
        <img src="<?php echo $row['image']; ?>"  ></div>
      <div class="description"><p><?php echo $row['shopname']; ?></p></div>
      <div class="react">
        <i class="fa-regular fa-heart"></i>
        <i class="fa-solid fa-star"></i>  
      </div>
      <?php 
      }
    }
   } } ?>
  </div>
</div>

     
   
      </div>
      </div>
      <div class="fav-shop">
        <div class="fav"> Favorite shops</div>
        <div class="Favorite"> 
          <div class="img-fav" ><img  src="../img/Qalqilya/10.jpg" alt="" ></div>
          <div class="des-fav">قلقيلية -الشارع الرئيسي</div>
        </div>
        <div class="Favorite"> 
          <div class="img-fav" ><img  src="../img/Qalqilya/10.jpg" alt="" ></div>
          <div class="des-fav">قلقيلية -الشارع الرئيسي</div>
        </div>
        
      </div>
     </div>

 </body>
</html>