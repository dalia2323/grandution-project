<?php
session_start();
include('../handler/db.php');
if (!isset($_SESSION['user'])) {
  header('location:login.php');
  exit();
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
                    <?php
                    $sql = "SELECT * FROM categories";
                  $query_run = mysqli_query($conn, $sql);
                 foreach ($query_run as $row) {
                    ?>
                    <form action="" method="post">
                        <button type="submit" class="icons" name="category-btn" onclick="hideShopDiv()"
                            title="<?php echo $row['categoryname'] ?>">
                            <i class="<?php echo $row['icone'] ?>"></i>
                        </button>
                    </form>
                    <?php } ?>

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
        $query = "SELECT shops.shopname AS shop_name, shops.image as shopImage
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
                <img src="<?php echo $row['shopImage']; ?>">
                </div>
                <div class="description">
                    <p> <?php echo $row['shop_name'] ?> </p>
                </div>
                <div class="react">
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
            <?php
          }
        }
      } elseif (isset($_POST['allcategory-btn'])) {
        $street = $_SESSION['street-name'];
        
        $query = "SELECT shops.shopname AS shop_name, shops.image as shopImage
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
                   <form action="" method="post"> <i class="fa-regular fa-heart"></i>
                   </form>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
            <?php
          }
        }
      } elseif (isset($_POST['category-btn'])) {
        $street = $_SESSION['street-name'];
        $selectedCategory = $_POST['category-btn'];

        $query = "SELECT s.shopname 
        FROM shops s 
        JOIN streets st ON s.street_id = st.id 
        JOIN cities c ON st.cities_id = c.id 
        JOIN categories cat ON s.category_id = cat.id
         WHERE c.cityname = '$cityName' AND st.streetname = '$street' AND cat.categoryname  = '$selectedCategory';
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
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-star"></i>
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
        <div class="fav"> Trend shops</div>
        <div class="Favorite">
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
    </div>

</body>

<script>
function hideShopDiv() {
    var shopDiv = document.getElementById("shopdiv");
    shopDiv.style.display = "none";
}
</script>

</html>