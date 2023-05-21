<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}
$name = $_SESSION['user']['name'];
$email = $_SESSION['user']['email'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile Page</title>
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
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
</head>


  <body class="mainpage">
    <div class="navbar">
        <div class="logo"></div>
        <div class="city">
            <h1> City Guide </h1>
        </div>
        <a href="../cityGuide.php" title="Home page">
            <div class="homePage"> </div>
        </a>
        <a href="" title="city">
            <div class="citys"></div>
        </a>
        <a href="profile.php" title="profile">
            <div class="profile"></div>
        </a>
        <a href="../logout.php" title="Logout">
            <div class="Logout"></div>
        </a>
    </div>
    <div class="card">
      <div class="card-content">
      <h1>WELCOME <?php echo $name; ?></h1>

        <h3>City Guide member </h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor nibh id placerat gravida. Nullam hendrerit, enim non gravida scelerisque, mauris enim pellentesque est, ac aliquam massa elit et velit.</p>
        <div class="contact-info">
          <h3>Contact Information</h3>
          <ul>
          <li>Name: <?php echo $name; ?></li>
         <li>Email: <?php echo $email; ?></li>
            

          </ul>
        </div>
      </div>
<div class="footer">

</div>









<!-- 
  <div class="container">
    <img src="../profile-picture.jpg" alt="Profile Picture">
    <h1>John Doe</h1>
    <h3>Front-end Developer</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor nibh id placerat gravida. Nullam hendrerit, enim non gravida scelerisque, mauris enim pellentesque est, ac aliquam massa elit et velit.</p>
    <div class="contact-info">
      <h3>Contact Information</h3>
      <ul>
      <li>Name: +1 123 456 7890</li>
        <li>Email:<?php echo $name; ?></li>
        
      </ul>
    </div>
  </div> -->
</body>
</html>
