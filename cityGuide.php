<?php
session_start();
if(!isset($_SESSION['user'])){
  header('location:login.php');
  exit();
}
include('handler/db.php');
//search section
// Check if city name is submitted
if (isset($_GET['cityName'])) {
  // Sanitize input
  $cityName = filter_var($_GET['cityName'], FILTER_SANITIZE_STRING);
 // Search for city name in database
  $sql = "SELECT * FROM cites WHERE name LIKE '%$cityName%'";
  $result = $conn->query($sql);
  $errors=[];

  // Check if search returns any result
  if ($result->num_rows > 0) {
    // Save city name in session variable
    $_SESSION['cityName'] = $cityName;

    // Redirect to city.php page
    header("Location:city/city.php");
    exit();
  } else {
    $errors[]="No results found.";
  }
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css -->
    <link rel="stylesheet" href="css/cityGuide.css" />
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
    <!-- add icon -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <!-- fonts awesome -->
    <link rel="stylesheet" href="css/all.min.css">

    <title>city Guide page</title>
</head>

<body class="mainpage">
    <div class="navbar">
        <div class="logo"></div>
        <div class="city">
            <h1> City Guide </h1>
        </div>
        <a href="cityGuide.php" title="Home page">
            <div class="homePage"> </div>
        </a>
        <a href="#" title="city">
            <div class="citys"></div>
        </a>
        <a href="#" title="profile">
            <div class="profile"></div>
        </a>
        <a href="logout.php" title="Logout">
            <div class="Logout"></div>
        </a>
    </div>
    <div class="firstPart">
        <div class="firstPart1">
            <h5>CITY Guide</h5>
            <h1>Let's Discover the best in your destination: </h1>
            <div class="search">

                <i class="fa-solid fa-magnifying-glass" style="color: #3c8067;
        padding-top: 10px; padding-left: 10px; font-size: 30px;"></i>
                <div class="search-container">

                    <form action="" method="get">

                        <input type="text" placeholder="Search city..." name="cityName">

                        <button id="sliderButton" type="submit" style="margin-left: 50px;">Let's Search</button>

                        <div style="color:red; margin-left:30px; ">
                            <?php 
                      if(isset($errors)){
                      if(!empty($errors)){
                       foreach($errors as $msg){
                        echo $msg . "<br>";
                        }
                      }
                  }?>
                        </div>
                    </form>
                </div>
                <style>
                /* Style the search container */
      
                </style>

            </div>
        </div>
        <div class="firstPart2">

        </div>
      </div>
</body>

</html>