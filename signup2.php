<?php
include('handler/db.php');
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$errors=[];

// Process the sign-up form
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $status = 'pending';
    
    $stm="SELECT * FROM users WHERE email='$email' ";

    // Insert the new company into the database with a 'pending' status
    $sql = "INSERT INTO companies (username, email, phone, password, status)
            VALUES ('$username', '$email', '$phone', '$password', '$status')";
    
    if ($sql) {
        $errors[]="Your sign-up request is pending. Please wait for the admin to accept it.";
        $_SESSION['company_name'] = $username;
        $_SESSION['company_email'] = $email;
        header("location:pending.php");
        exit();
    }
}

// Show a list of all the companies with a 'pending' status for the admin to accept
// if (isset($_SESSION['admin'])) {
//     $sql = "SELECT * FROM companies WHERE status='pending'";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//             echo "Name: " . $row['username'] . "<br>";
//             echo "Email: " . $row['email'] . "<br>";
//             echo "Phone: " . $row['phone'] . "<br>";
//             echo "<a href='accept_company.php?id=" . $row['id'] . "'>Accept</a><br><br>";
//         }
//     } else {
//         echo "No companies found with a 'pending' status.";
//     }
// }

// // Accept a company's sign-up request
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $sql = "UPDATE companies SET status='accepted' WHERE id='$id'";
//     if ($conn->query($sql) === TRUE) {
//         echo "The company's sign-up request has been accepted.";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
// }

$conn->close();
?>
<!-- Note: This is just an example code snippet, and it's important to note that there are several security considerations and best practices that should be followed when implementing user authentication and authorization features. It's recommended to use a secure authentication library or framework instead of writing your own authentication code to avoid security vulnerabilities. -->











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Sign Up as company</title>
    <!-- add icon -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">

</head>
<body class="login">
    <!-- Div 1 first -->
    <div class="first">
        <!-- Div2 second -->
        <div class="second secondsignupcompany">
           
    </div>
        <!-- Div3 third -->
        <div class="third">
            <form action="" method="post">
                    <h2>Get started</h2></br>
                    <p>Create your own account to be able to enter the site</p></br>
                   
                    <input type="text" class="" name="username" placeholder="Enter your  Name" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];}?>" required> <br>
                    
                    <input type="email" class="" name="email" placeholder="Enter your  Email" required 
                    value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>">
                    <br>
                    <input type="tel" class="" name="phone" placeholder="Enter your  phone" required>
                    <br>
                    <input type="password"  class="" placeholder='password'  name='password' /></br>
                    <input id="show" type="password" class="" name="Cpass" placeholder="conform password" required><br>
                      <div style="color:red;">
                    <?php 
                      if(isset($errors)){
                      if(!empty($errors)){
                       foreach($errors as $msg){
                        echo $msg . "<br>";
                        }
                      }
                  }?>
                </div>
                    <button type="submit" name="submit" class="scompany button"><a>sign up</a></button> 

            </form>

        </div>
        

    </div>




    
    
</body>
</html>