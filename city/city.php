<?php
session_start();

include('../handler/db.php');
if (!isset($_SESSION['user'])) {
  header('location:login.php');
  exit();
}
$email = $_SESSION['user']['email'];

if (isset($_POST['favorite'])) {
  // Get the shop ID from the form
  $shopId = $_POST['item_id'];

  // Get the user ID from the session

  // Insert the shop and user IDs into the favorites table
  $query = "INSERT INTO favorites
  (user_id, shop_id) VALUES ((SELECT id FROM users WHERE email = '$email'), '$shopId')";
  $result = mysqli_query($conn, $query);
  if ($result) {
    // Insertion successful
  }
}
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
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300&family=Montserrat:wght@600&display=swap"
        rel="stylesheet">
    <!-- add icon -->
    <link rel="icon" type="image/x-icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Qalqilia page</title>
</head>
<style>
     .fav-btn{
        
       color:red;
    }
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
        <a href="profile.php" title="profile">
            <div class="profile"></div>
        </a>
        <a href="../logout.php" title="Logout">
            <div class="Logout"></div>
        </a>

    </div>
    <div class="main">
        <div class="center">
            <div class="parent">
                <div class="child">
                    <div class="qalqilia-city">
                        <i class="fa-sharp fa-solid fa-city " style="font-size:35px;color:#3c8067;"></i>
                        <?php
            if (isset($_SESSION['cityName'])) {
              // Sanitize input
              $cityName = filter_var($_SESSION['cityName'], FILTER_SANITIZE_STRING);
              echo '<h1 style="font-size:45px; padding-left: 10px;font-family: "Fraunces", serif;text-transform: uppercase;">' . $cityName . '</h1>';
            }
            ?>
                    </div>
                </div>
            </div>
            <div id="street">choose street </div>
            <div class="streets">
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
                    <button type="submit" name="street-btn" value="<?php echo $row['street']; ?>"
                        class="street"><?php echo $row['street']; ?></button>
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
                        <button class="icons" type="submit" name="allcategory-btn" onclick="hideShopDiv()"
                            title="all">All</button>
                    </form>
                    
                    <form action="" method="post">
                        <button type="submit" class="icons" name="category-btn1" 
                            title="clothes">
                            <i class="fa-solid fa-shirt"></i>
                        </button>
                        <button type="submit" class="icons" name="category-btn2" 
                            title="Makeup">
                            <i class="fa-solid fa-paintbrush"></i>
                        </button>   
                         <button type="submit" class="icons" name="category-btn3" 
                            title="Juices">
                            <i class="fas fa-wine-glass"></i>
                        </button>   
                         <button type="submit" class="icons" name="category-btn4" 
                            title="sweets">
                            <i class="fas fa-birthday-cake"></i>
                        </button>  
                          <button type="submit" class="icons" name="category-btn5" 
                            title="Restaurants">
                            <i class="fas fa-utensils"></i>
                        </button> 
                           <button type="submit" class="icons" name="category-btn6" 
                            title="furniture">
                            <i class="fa-solid fa-couch"></i>
                        </button>

                    </form>

                </div>
            </div>
        </div>

        <div class="top">
            <div class="trend">
                <p>Shop</p>
            </div>
        </div>

        <div class="shop-trind">
            <?php
      if (isset($_POST['street-btn'])) {
        // Sanitize the user input to prevent SQL injection
        $selectedStreet = $_POST['street-btn'];
        $_SESSION['street-name'] = $selectedStreet;
        $query = "SELECT shops.shopname AS shop_name, shops.image as shopImage,shops.id as shop_id
              FROM cities
              INNER JOIN streets ON cities.id = streets.cities_id
              INNER JOIN shops ON streets.id = shops.street_id 
              INNER JOIN categories ON shops.category_id = categories.id 
              WHERE cities.cityname = '$cityName' AND streets.streetname = '$selectedStreet'";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
           
            <div class="shops" id="shopdiv">
            <div class="imgshop">
                <img src="<?php echo $row['shopImage'] ?>">
            </div>
            <div class="description">
                <p> <?php echo $row['shop_name'] ?> </p>
            </div>
            <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>
        </div>
            <?php
          }
        }
      } elseif (isset($_POST['allcategory-btn'])) {
        $street = $_SESSION['street-name'];
        
        $query = "SELECT shops.shopname AS shop_name, shops.image as shopImage ,shops.id as shop_id
              FROM cities
              INNER JOIN streets ON cities.id = streets.cities_id
              INNER JOIN shops ON streets.id = shops.street_id 
              INNER JOIN categories ON shops.category_id = categories.id 
              WHERE cities.cityname = '$cityName' AND streets.streetname = '$street'";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>

            </div>
            <?php
          }
        }
      } elseif (isset($_POST['category-btn1'])) {
        $street = $_SESSION['street-name'];

        $query = "SELECT s.shopname AS shop_name, s.image as shopImage ,
        s.id as shop_id
        FROM shops s
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = 'clothes';
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>

          </div>
<?php

          }
        }
      }
       elseif (isset($_POST['category-btn2'])) {
        $street = $_SESSION['street-name'];

        $query = "SELECT s.shopname AS shop_name, s.image as shopImage ,
        s.id as shop_id
        FROM shops s
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = 'Makeup';
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>
          </div>
          <?php
          }
        }
      }
      elseif (isset($_POST['category-btn3'])) {
        $street = $_SESSION['street-name'];

        $query = "SELECT s.shopname AS shop_name, s.image as shopImage ,
        s.id as shop_id
        FROM shops s
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = 'Juices';
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>
          </div>
          <?php
          }
        }
      } elseif (isset($_POST['category-btn4'])) {
        $street = $_SESSION['street-name'];

        $query = "SELECT s.shopname AS shop_name, s.image as shopImage ,
        s.id as shop_id
        FROM shops s
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = 'sweets';
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>
          </div>
          <?php
          }
        }
      } elseif (isset($_POST['category-btn5'])) {
        $street = $_SESSION['street-name'];

        $query = "SELECT s.shopname AS shop_name, s.image as shopImage ,
        s.id as shop_id
        FROM shops s
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = 'Restaurants';
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>
          </div>
          <?php
          }
        }
      } elseif (isset($_POST['category-btn6'])) {
        $street = $_SESSION['street-name'];

        $query = "SELECT s.shopname AS shop_name, s.image as shopImage ,
        s.id as shop_id
        FROM shops s
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = 'furniture';
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
            <div class="shops" id="shopdiv">
                <div class="imgshop">
                    <img src="<?php echo $row['shopImage'] ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                <input type="hidden" name="item_id" value="<?php echo $row['shop_id']; ?>">
                <i class="far fa-heart favorite-btn " id="<?php echo $row['shop_id']; ?>" onclick="handleFav(this)"></i>
            </div>
          </div>
          <?php
          }
        }
      }
?>


  </div>

    </div>

    <div class="fav-shop">
        <div class="fav"> Trend shops
          
        </div>
        <?php
      $trendshop_query = "SELECT s.T_shope_name	 AS shop_name,
    s.description AS description, s.image AS image
          FROM trendshops AS s
          INNER JOIN cities AS c ON s.cities_id  = c.id
          WHERE c.cityname = '$cityName'";

      $trendshop_result = mysqli_query($conn, $trendshop_query);
      if ($trendshop_result) {
        // Loop through the results and display the shop names
        while ($row = mysqli_fetch_assoc($trendshop_result)) {
      ?>
            <div class="img-fav"><img src="<?php echo $row['image'] ?>" alt=""></div>
            <div class="des-fav"><?php echo $row['shop_name'] ?></div>
            <?php
        }
      }
      ?>
        
    </div>

</body>

<script>
    //تغيير لون الفيفرت
    function handleFav (i) {
        console.log(i.id);
        i.classList.toggle("fav-btn");
    }
    // اخفاء المحلات
function hideShopDiv() {
    var shopDiv = document.getElementById("shopdiv");
    shopDiv.style.display = "none";
}
//منع تحديث الصفحة بعد الظغط على بوتن الفيفرت
$(document).ready(function() {
  $('.favorite-btn').click(function() {
    var shopId = $(this).attr('id');
    
    $.ajax({
      url: 'favorite.php', // Replace with the path to your PHP file handling the favorite functionality
      method: 'POST',
      data: { item_id: shopId },
      success: function(response) {
        // Handle the response here if needed
        console.log(response);
      }
    });
  });
});


</script>

</html>