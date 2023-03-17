<?php
session_start();
require_once('handler/db.php');
if(isset($_POST['submit'])){
$name=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
$password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
}
$errors=[];
//validate name
if(empty($name))
{
    $errors[]="You should enter name";
}
elseif(strlen($name)>255){
    $errors[]="The name must be less or equal 255 character ";

}
//validate email
if(empty($email))
{
    $errors[]="You should enter email ";
}
elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
{
    $errors[]="Invalid Email";

} 
if(!empty($email)){
$stm="SELECT email FROM users WHERE email='$email' ";
$q=$conn->prepare($stm);
$q->execute();
$data=$q->fetch();

if($data){
    $errors[]="Email Already In use";
}
}
//validate Password
if(empty($password))
{
    $errors[]="You should enter Password";
}
elseif(strlen($password)<8){
    $errors[]="Password should be 8 or more";
}


if(empty($errors)){
    $password=password_hash($password,PASSWORD_DEFAULT);
    $stm="INSERT INTO users ( name, email, password) VALUES ('$name','$email','$password')";
    $conn ->prepare($stm)->execute();
    $_POST['username']='';
    $_POST['email']='';
    $_SESSION['user']=[
        "name"=>$name,
        "email"=>$email
    ];
    header('location:cityGuide.php');
}


else{
    var_dump($errors);
}
//INSERT

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
    <title>Sign up</title>
        <!-- add icon -->
        <link rel="icon" type="image/x-icon" href="img/icon.png">
</head>
<body class="login">
    <!-- Div 1 first -->
    <div class="first">
        <!-- Div2 second -->
        <div class="second secondsignup">
           
    </div>
        <!-- Div3 third -->
        <div class="third">
            <form action="signUp.php" method="post">
                    <h2>Get started</h2></br>
                    <p>Create your own account to be able to enter the site.</p></br>
                   
         <input type="text" class="icon1" name="username" placeholder="      Enter your  Name" required
          value="<?php if(isset($_POST['username'])){ echo $_POST['username'];}?>" > <br>
                    
          <input type="email" class="icon2" name="email" placeholder="      Enter your  Email" 
          required value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>" >
                    <br>
                  
                    <input type="password"  class="icon3" placeholder='        password'  
                    name='password'  /></br>
                    
                    
                    <input id="show" type="password" class="icon3" name="Cpass"
                     placeholder="        conform password"><br>
                    <button type="submit" name="submit" class="scompany button"><a>sign up</a></button> 
                    <!-- <button type="submit" name="signupcompany"class="scompany button"><a>Iam Company</a></button>  -->
            </br> 
        </br>
                    <a class="Imcompany" href="signupcompany.html">Im company?</a>
                <a class="Imcompany" href="login.html">Do you Have account?</a>

            </form>

        </div>
        

    </div>
    
</body>
</html>