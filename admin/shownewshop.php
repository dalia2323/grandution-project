<?php
include('../handler/db.php');
session_start();

// $sql = "SELECT name, email FROM companies";
// $query=mysqli_query($conn,$sql);
// $result=mysqli_fetch_assoc($query);
// $conn->close();


if(!isset($_SESSION['add'])){
   
    exit();
}

$cityname = $_SESSION['add']['cityname'];
$streetname = $_SESSION['add']['streetname'];
$categoryname = $_SESSION['add']['categoryname'];
$shopname = $_SESSION['add']['shopname'];

// clear the session
unset($_SESSION['add']);





?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign-up request pending</title>
	<link rel="stylesheet" href="css/pending.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
	<title>Sign-up request pending</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-5 " id="pending">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header">
						<h1 class="text-center">Your shop is </h1>
					</div>
					<div class="card-body">
						
						<p>city name is:<?php echo $cityname; ?></p>
						<p>street name is: <?php echo $streetname; ?></p>
                        <p>shop name:<?php echo $shopname; ?></p>
						<p>category: <?php echo $categoryname; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>

