<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
<?php
session_start();
include('handler/db.php');

// Sanitize input
$cityName = 'qalqilia';

$query = "SELECT streets.streetname AS street
          FROM cities
          INNER JOIN streets ON cities.id = streets.cities_id
          WHERE cities.cityname = '$cityName'";

$query_run = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_run)) {
    ?>
    <form action="" method="post">
        <button type="submit" name="street-btn" value="<?php echo $row['street']; ?>" class="street"><?php echo $row['street']; ?></button>
    </form>
    <?php
}
?>

<form action="" method="post">
    <?php
    $sql = "SELECT * FROM categories";
    $query_run = mysqli_query($conn, $sql);
    foreach ($query_run as $row) {
        ?>
        <button type="submit" class="icons" name="category-btn" title="<?php echo $row['categoryname'] ?>"><i class="<?php echo $row['icone'] ?>"></i></button>
        <?php
    }
    ?>
</form>

<?php
if (isset($_POST['street-btn']) ) {
    // Sanitize the user input to prevent SQL injection
    $selectedStreet = $_POST['street-btn'];
    $selectedcatogry=$_POST['category-btn'];

    // SQL query to select data from shop table and related tables
    $query = "SELECT shops.shopname AS shop_name, shops.image 
              FROM cities
              INNER JOIN streets ON cities.id = streets.cities_id
              INNER JOIN shops ON streets.id = shops.street_id 
              INNER JOIN categories ON shops.category_id = categories.id 
              WHERE cities.cityname = '$cityName' AND streets.streetname = '$selectedStreet'
             ";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch and display the data
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the desired data from the 'shop' table or related tables
            echo "Shop Name: " . $row['shop_name'] . "<br>";
        }
    } else {
        // Error handling if the query fails
        echo "Error executing query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

?>
</body>
</html>
