<?php
include('../handler/db.php');


?>
<?php
session_start();
if(!isset($_SESSION['company'])){
  header('location:admin-login.php');
  exit();

}

if (isset($_POST['add'])) {
  $cityName = $_POST['cityname'];
  $streetname = $_POST['streetname'];
 
  $shopName = $_POST['shopname'];
  $categoryname = $_POST['categoryname'];
  $shopImag = $_FILES['shopeimage'];
  $shopImagName = $shopImag['name'];
  $shopImagTemp = $shopImag['tmp_name'];
  $t = time();
$nowDate = date('Y-m-d',$t);
$randomString = "$nowDate".hexdec(uniqid());
  $ext=pathinfo( $shopImagName,PATHINFO_EXTENSION);
  $newImgName="$randomString.$ext";
  move_uploaded_file($shopImagTemp,"../city/$newImgName");
  $query ="INSERT INTO shops (shopname,`street_id`,`category_id`,`image`)VALUES( '$shopName',(SELECT id FROM streets WHERE streetname ='$streetname'),(SELECT id FROM categories WHERE categoryname ='$categoryname'),' $newImgName')";
      

$insert_query = mysqli_query($conn, $query);
if($insert_query){
echo "Shop added successfully";

exit();
} else {
echo "Shop not added";
}
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
        <a class="navbar-brand" href="company.php">City guide </a>
   
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <form method="post">
                            <div class="form-group">
                            <input type="text" class="form-control"name="cityname"require placeholder="city Name">
 
                            <br>
                            <div class="form-group">
                            <input type="text" class="form-control"name="streetname"require placeholder="street Name">
 
                            <br>
                            <!-- <div class="form-group">
                             
                              <input type="text" class="form-control"name="companyname"require placeholder="company Name">
                            </div> -->
                            
                       
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="shopname"require placeholder="shop Name">
                            </div>
                            
                            <br>
                            <div class="form-group">
                             
                            <input type="text" class="form-control"name="categoryname" placeholder="Category Name" required>
                           </div>
                           
                           <br>
                            
                               
                               
                           <div class="custom-file">
                                <input type="file"  name="shopeimage" required>
                            </div>
                            <br>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="add">Add</button>
                               
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

