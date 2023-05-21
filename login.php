<?php
session_start();
include('handler/db.php');
if (isset($_POST['login'])) {
    global $conn;
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $errors = [];

    if (empty($email)) {
        $errors[] = "You should enter an email";
    }


    if (!empty($email)) {
      $stm = "SELECT * FROM users WHERE email=? AND password=?";
      $q = $conn->prepare($stm);
      $q->bind_param("ss", $email, $password);
      $q->execute();
      $result = $q->get_result();
  
      if ($result->num_rows == 0) {
          $errors[] = "Incorrect email";
      } else {
          $data = $result->fetch_assoc();
          $_SESSION['user'] = [
              "name" => $data['name'],
              "email" => $email,
          ];
          $q->close(); // Close the prepared statement
          header('location: cityGuide.php');
          exit(); // Add exit after redirection
      }
  }
  

   // Company
if (!empty($email)) {
  $stm2 = "SELECT * FROM companies WHERE email=? AND password=?";
  $q2 = $conn->prepare($stm2);
  $q2->bind_param("ss", $email, $password);
  $q2->execute();
  $result2 = $q2->get_result();

  if ($result2->num_rows == 0) {
      $errors[] = "Invalid login";
  } else {
      $data2 = $result2->fetch_assoc();
      $_SESSION['company'] = [
          "name" => $data2['name'],
          "email" => $email,
      ];
      $q2->close(); // Close the prepared statement
      header('location:admin/company.php');
      exit(); // Add exit after redirection
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
    <!-- link css -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Login</title>
        <!-- add icon -->
        <link rel="icon" type="image/x-icon" href="img/icon.png">
</head>
<body class="login">
    <!-- Div 1 first -->
    <div class="first">
        <!-- Div2 second -->
        <div class="second">
          
        </div>
        <!-- Div3 third -->
        <div class="third">
            <form action="" method="post">
                    <h2>Get started</h2></br>
                    <p>please login with your Email and use for your City Guide Account</p></br>
                    
                    <input type="text"  class="" placeholder='Email'  name='email' /></br>
                    
                    <input type="password" class="" placeholder='password'  name='password' /></br>
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
                    
                    
                    <button type="submit" name="login" class="button"><a>login</a></button>
            </br> </br></br>
        

                    <a class="Imcompany" href="signUp.php">Create account?</a>
                    <a class="Imcompany" href="admin/admin-login.php">Admin Login</a>


                </form>

        </div>
        

    </div>
    
</body>
</html>