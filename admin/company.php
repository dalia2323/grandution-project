<?php
include('../handler/db.php');


?>
<?php
session_start();
if(!isset($_SESSION['company'])){
  header('location:admin-login.php');
  exit();

}

if(isset($_POST['add'])){
  $city = $_POST['citytname'];
  $streetname = $_POST['streetname'];
  $companyname = $_POST['companyname'];
  $shopName = $_POST['shopname'];
  $catrgoryname =$_POST['catrgoryname'];

  $shopImag = $_FILES['shopeimage'];
  $shopImagName = $shopImag['name'];

  $shopImagTemp = $shopImag['tmp_name'];
  $t = time();
$nowDate = date('Y-m-d',$t);
$randomString = "$nowDate".hexdec(uniqid());
  $ext=pathinfo( $shopImagName,PATHINFO_EXTENSION);
  $newImgName="$randomString.$ext";
  move_uploaded_file($shopImagTemp,"../city/$newImgName");
  // Insert the record into the database
  $query1 = "INSERT INTO cities (cityname) VALUES (SELECT id FROM cities WHERE cityname ='$city')";
  $query2="INSERT INTO streets (streetname, city_id) VALUES ('$streetname', LAST_INSERT_ID())";
  $query3="INSERT INTO companies (companyname) VALUES ('$companyname')"; 
  $query4="INSERT INTO shop (shopname, street_id, company_id,image) 
  VALUES ('$shopname', LAST_INSERT_ID(), LAST_INSERT_ID(),$newImgName)
  "  ; 
  $query5="INSERT INTO category (categoryname, shop_id) 
  VALUES ('$catrgoryname', LAST_INSERT_ID())"; 
   
  $insert_query1 = mysqli_query($conn, $query1);
  $insert_query2 = mysqli_query($conn, $query2);
  $insert_query3 = mysqli_query($conn, $query3);
  $insert_query4 = mysqli_query($conn, $query4);
  $insert_query5 = mysqli_query($conn, $query5);
  
  
  if($insert_query1 ){
  if ($insert_query2) {
    
    if ($insert_query3) {
      if ($insert_query4) {
        if ($insert_query5) {

  
      $message[] = "Shop added successfully";
      header('location:show.php');
      exit();
  } }

}}}}
else {
  $message[] = "Shop not added";
}
?>


<!-- success session -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Guide | Dashboard</title>
    <!-- fonts awesome -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
select{
   margin-bottom:30px;
}
</style>

<body>
     
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php">City guide </a>
   
</li>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['company']['name'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="admin-profile.php">Profile</a>
                      <a class="dropdown-item" href="admin-logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
   

      <div class="container py-5">
     <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add new shop</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="show.php" method="post">
                            <form method="post">
                           
                          
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="cityname"require placeholder="city Name">
                            </div>
                            
                   
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="streetname"require placeholder="street Name">
                            </div>
                            
                           
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="companyname"require placeholder="company Name">
                            </div>
                            
                       
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="shopname"require placeholder="shop Name">
                            </div>
                            
                            <br>
                            <div class="form-group">
                             
                             <input type="text" class="form-control"name="catrgoryname"require placeholder="catrgory name">
                           </div>
                           
                           <br>
                            
                               
                               
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"name="shopimage"require>
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            <br>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="add">Add</button>
                                <a class="btn btn-dark" href="show.php">Back</a>
                            </div>
                        </form>
                        
                       
                       
                      
             </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>

