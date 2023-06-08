<?php
include('../handler/db.php');
session_start();
if(!isset($_SESSION['admin'])){
    header('location:admin-login.php');
    exit();
}




if(isset($_POST['add-trend'])){
    $city = $_POST['cityname'];
    $shopName = $_POST['shop-name'];
    $description = $_POST['description'];
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
    $query = "INSERT INTO trendshops (`T_shope_name`, `cities_id`, `description`, `image`) 
              VALUES ('$shopName', (SELECT id FROM cities WHERE cityname = '$city'), '$description', ' $newImgName')";
    $insert_query = mysqli_query($conn, $query);
    if($insert_query){
        $message[] = "Shop added successfully";
        header('location:show-trendshop.php');
        exit();
    } else {
        $message[] = "Shop not added";
    }
}
?>


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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                  <a class="nav-link" href="handel-user.php">user</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="handel-company.php">Company</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="show.php">Shops</a>
                </li>
                <li class="nav-item active ">
                  <a class="nav-link" href="addtrend.php">addtrend</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="show-trendshop.php">Trend shop</a>
</li>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['admin']['name'];?>                    </a>
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
                <h3 class="mb-3">Add trend shop</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <form action="addtrend.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control" name="cityname" required placeholder="City Name">
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="text" class="form-control" name="shop-name" required placeholder="Shop Name">
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <input type="text" class="form-control" name="description" required placeholder="Description">
                            </div>
                            <br>
                            <br>
                            <div class="custom-file">
                                <input type="file"  name="shopeimage" required>
                            </div>
                            <br>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="add-trend">Add</button>
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