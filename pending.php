<?php
include('handler/db.php');
session_start();

$sql = "SELECT name, email FROM companies";
$query=mysqli_query($conn,$sql);
$result=mysqli_fetch_assoc($query);
$conn->close();
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
						<h1 class="text-center">Your sign-up request is pending</h1>
					</div>
					<div class="card-body">
						<p class="lead">Thank you for signing up! Your request is currently pending approval from the administrator. We will send you an email once your account is activated.</p>
						<p>Your company name is: <?php echo $result['name']; ?></p>
						<p>Your email address is: <?php echo $result['email']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
</body>
</html>

