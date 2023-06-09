<?php
session_start();

include('../handler/db.php');

if (!isset($_SESSION['user'])) {
  header('location:login.php');
  exit();
}

$email = $_SESSION['user']['email'];

if (isset($_POST['item_id'])) {
  // Get the shop ID from the AJAX request
  $shopId = $_POST['item_id'];

  // Insert the shop and user IDs into the favorites table
  $query = "INSERT INTO favorites (user_id, shop_id)
    VALUES ((SELECT id FROM users WHERE email = '$email'), '$shopId')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Insertion successful
    echo 'Favorite added successfully.';
  } else {
    // Insertion failed
    echo 'Failed to add favorite.';
  }
}
?>
