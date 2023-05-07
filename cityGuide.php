<?php
session_start();
if(!isset($_SESSION['user'])){
  header('location:login.php');
  exit();
}
?><?php
include('handler/db.php');

// Start session

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
    header("Location:city/Qalqilia.php");
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
    <a href="homepage.php" title="Home page">
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
          
          <form action="#" method="get">
            
            <input type="text" placeholder="Search city..." name="cityName">
            
      <button id="sliderButton" type="submit">Let's Search</button>
     
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
        <div id="cityTable"></div>
<style>
  /* Style the search container */
.search-container {
  display: flex;
  justify-content: center;
 

}
/* Style the search input and button */
.search-container input[type="text"] {
  padding: 10px;
  border: none;
  font-size: 16px;
  width: 200px;
  border-radius: 10px;
  margin-top: px;
  margin-left: 50px;
}


</style>        

      </div>
    </div> 
    <div class="firstPart2"></div>
    <div class="firstPart3">

      <h1>Or By  this Selector: </h1>

      <div class="divslider">

        <i class="fa-solid fa-slider"></i>
        <select name="city" class="selecter" onchange="window.location.href=this.value;">
          <option value="cityGuide.html">city</option>
          <option value="tulkarm.html">Tulkarem</option>
          <option value="nablus.html">Nablus</option>
          <option value="Ramallah.html">Ram allah</option>
          <option value="Hebron.html">Hebron</option>
          <option value="Jenin.html">Jenin</option>
          <option value="Jericho.html">Jericho</option>
          <option value="Bethlehem.html">Bethlehem </option>
          <option value="city/Qalqilia.html">Qalqilia</option>
    
        </select>
        <!-- <a href="#"><button id="sliderButton">Use City slider</button></a> -->

      </div>
    </div>
  </div> 
    
  <!-- <a href="logout.php"> logout</a> -->
    <!-- <div>
        <select name="city" onchange="window.location.href=this.value;">
          <option value="cityGuide.html">المدينة</option>
          <option value="tulkarm.html">طولكرم</option>
          <option value="nablus.html">نابلس</option>
          <option value="Ramallah.html">رام الله</option>
          <option value="Hebron.html">الخليل</option>
          <option value="Jenin.html">جنين</option>
          <option value="Jericho.html">اريحا</option>
          <option value="Bethlehem.html">بيت لحم</option>
          <option value="Qalqilia.html">قلقيلية</option>
    
        </select>
      </div> -->
        <!-- <div style=" width: 500px  ;height: 154px;">
                <img  class="image"src="img/slider.jpg" width="100% "height="449px">
              </div> -->
      <!-- <div class="slideshow" style=" width: 600px; margin-left: 400px;height: 155px; margin-top: -154px; display:none;">
        <div class="slideshow-container">
    
          <div class="mySlides fade">
            <div class="numbertext">1 / 8</div>
            <a href="tulkarm.html"><img src="img/Tulkrem.png" style="width:600px; height: 450px;"></a>
    
          </div>
    
          <div class="mySlides fade">
            <div class="numbertext">2 / 8</div>
            <a href="nablus.html"> <img src="img/Nablus.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
    
          <div class="mySlides fade">
            <div class="numbertext">3 / 8</div>
            <a href="Ramallah.html"><img src="img/Ramallah.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
          <div class="mySlides fade">
            <div class="numbertext">4 / 8 </div>
            <a href="Hebron.html"> <img src="img/Hebron.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
          <div class="mySlides fade">
            <div class="numbertext">5 / 8 </div>
            <a href="Jenin.html"> <img src="img/Jenin.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
          <div class="mySlides fade">
            <div class="numbertext">6 / 8 </div>
            <a href="Jericho.html"> <img src="img/Jericho.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
          <div class="mySlides fade">
            <div class="numbertext">7 / 8</div>
            <a href="Bethlehem.html"> <img src="img/Bethlehem.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
          <div class="mySlides fade">
            <div class="numbertext">8 / 8 </div>
            <a href="Qalqilia.html"> <img src="img/Qalqilia.jpg" style="width:600px; height: 450px;"></a>
    
          </div>
    
          <a class="prev" onclick="plusSlides(-1)">❮</a>
          <a class="next" onclick="plusSlides(1)">❯</a>
    
        </div>
    
        <br>
    
        <div class="circle">
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
          <span class="dot" onclick="currentSlide(4)"></span>
          <span class="dot" onclick="currentSlide(5)"></span>
          <span class="dot" onclick="currentSlide(6)"></span>
          <span class="dot" onclick="currentSlide(7)"></span>
          <span class="dot" onclick="currentSlide(8)"></span>
        </div>
      </div>
      <script>
        let slideIndex = 1;
        showSlides(slideIndex);
    
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
    
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
    
        function showSlides(n) {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("dot");
          if (n > slides.length) { slideIndex = 1 }
          if (n < 1) { slideIndex = slides.length }
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex - 1].style.display = "block";
          dots[slideIndex - 1].className += " active";
        }
        function myFunction() {
      document.getElementsByClassName("slideshow").style.display = "block";
    }
      </script> -->

 
</body>
</html>