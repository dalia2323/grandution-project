<?php
session_start();
include('../handler/db.php');
$errors = array();

if(isset($_POST['submit-admin']))
{
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $errors = array();

    // Check if email is empty
    if(empty($email)) {
        $errors[] = "Email is required.";
    }

    // Check if password is empty
    if(empty($password)) {
        $errors[] = "Password is required.";
    }

    // If there are no errors, try to log in the user
    if(count($errors) == 0) {
        // Prepare a SELECT statement to retrieve the admin with the given email
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND type ='admin'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            // Admin exists, check password
            $row = $result->fetch_assoc();

            if($password == $row['password']) {
                // Password is correct, store user session data and redirect to dashboard
                $_SESSION['company']=[
                    "name"=>$row['name'],
                    "email"=> $email
                ];
                header("Location: admin.php");
                exit();
            } else {
                // Password is incorrect
                $errors[] = "Incorrect password.";
            }
        } else {
            // Admin does not exist
            $errors[] = "Admin not found with that email.";
        }
    }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<!-- Style -->
<style>
            body {
	font-family: sans-serif;
	background-color: #a2bbad;
}

.login-box {
	max-width: 400px;
	margin: 100px auto;
	padding: 30px;
	background-color: #eef7f2;
	box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.login-box h2 {
	margin: 0 0 30px;
	padding: 0;
	text-align: center;
	font-size: 2em;
	color: #333;
}

.login-box form {
	display: flex;
	flex-direction: column;
}

.user-box {
	position: relative;
	margin: 0 0 20px;
}

.user-box label {
	display: block;
	margin: 0 0 5px;
	font-size: 1em;
	color: #888;
}

.user-box input {
	width: 100%;
	padding: 10px;
	font-size: 1em;
	color: #333;
	border: none;
	border-bottom: 2px solid #ddd;
	background-color: transparent;
}

.user-box input:focus {
	outline: none;
	border-bottom-color: #333;
}

button[type="submit"] {
	display: block;
	margin: 20px auto 0;
	padding: 10px 20px;
	background-color: #333;
	color: #fff;
	border: none;
	border-radius: 3px;
	font-size: 1em;
	cursor: pointer;
}

        </style>
        <div class="login-box">
            <h2>Admin Login</h2>
            <form action="" method="post">
                <div class="user-box">
                    <label for="username">Email:</label>
                    <input type="text" name="email" id="username" required>
                </div>
                <div class="user-box">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div style="color:red;">
                    <?php 
                        if(count($errors) > 0) {
                          foreach($errors as $error) {
                              echo "<p>$error</p>";
                          }
                      }
                  ?>
                </div>
                <button type="submit"  name="submit-admin">Login</button>
            </form>
        </div>
    </body>
    </html>
