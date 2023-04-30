<?php
session_start();
include('handler/db.php');
if(isset($_POST['login']))
{
    global $conn;
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $errors=[];
 
    if(empty($email))
    {
        $errors[]="You should enter email ";
    }
    
    if(!empty($email)){
        $stm="SELECT * FROM users WHERE email='$email' ";
        $q=$conn->prepare($stm);
        $q->execute();
        $data=$q->fetch();
        $hashed_pass=$data['password'];
        $p=password_verify($password,$hashed_pass);
        if(!$data AND !$p){
            $errors[] = "incorrect email";

        }
    }
     
  if(!$data){
    $errors[]="invalid login";
  }
  else{

    $_SESSION['user']=[
        "name"=>$data['name'],
        "email"=>$email,
      ];
    header('location:cityGuide.php');
  }
  
  
  
//copmany
if(!empty($email)){
  $stm2="SELECT * FROM companies WHERE email='$email' ";
  $q2=$conn->prepare($stm2);
  $q2->execute();
  $data2=$q2->fetch();
  $hashed_pass2=$data2['password'];
  $p2=password_verify($password,$hashed_pass2);
  if(!$data2 AND !$p2){
      $errors[] = "incorrect email";

  }
}
if(!$data2){
  $errors[]="invalid login";
}
else{

  $_SESSION['user']=[
      "name"=>$data2['name'],
      "email"=>$email,
    ];
  header('location:admin/company.php');
}}?>
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