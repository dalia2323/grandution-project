<?php
if (isset($_POST['favorite'])) {
  // Get the shop ID from the form
  $shopId = $_POST['shop_id'];

  // TODO: Implement your logic to store the favorite action in the database or perform any other desired action

  // Example: Store the favorite action in a file
  $filename = 'favorites.txt';
  file_put_contents($filename, $shopId . PHP_EOL, FILE_APPEND);

  // Redirect the user back to the original page or a different page
  header('Location: city.php');
  exit();
}
?>
