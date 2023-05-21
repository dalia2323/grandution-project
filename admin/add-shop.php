<?php
include('../handler/db.php');
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Techstore | Dashboard</title>

   <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
</head>
<body>  
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php">City guide </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" href="handel-user.php">user</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="handel-company.php">Company</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="show.php">Shops</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Admins</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Your name
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Profile</a>
                      <a class="dropdown-item" href="#">Logout</a>
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
                            
                            <div class="form-group">
                                <label>city name</label>
                                <br><br>
                                <select name="cityname" id=""  require>
                                <option value="">    </option>

                                    <option value="Qalqilia">Qalqilia   </option>
                                    <option value="Nablus">Nablus   </option>
                                    <option value="Ramallah">Ramallah   </option>
                                    <option value="Tulkarm">Tulkarm   </option>
                                    <option value="Jenin">Jenin   </option>
                                    <option value="Jericho">Jericho  </option>
                                    <option value="Hebron">Hebron   </option>
                                    <option value="Bethlehem">Bethlehem  </option>
                                </select>
                              </div>
                              <br>
                              <div class="form-group">
                              <label>street Name</label>
                              <input type="text" class="form-control"name="streetname"require>
                            </div>
                            <br>
                            <div class="form-group">
                              <label>company Name</label>
                              <input type="text" class="form-control"name="companyname"require>
                            </div>
                            
                            <br>
                            <div class="form-group">
                                <label>Category</label>
                                <br><br>
                                <select name="categoryname" id=""require>
                                <option value="">    </option>

                                    <option value="ملابس">ملابس  </option>
                                    <option value="مكياج">مكياج   </option>
                                    <option value="كافيهات">كافيهات   </option>
                                    <option value="حلويات">حلويات  </option>
                                    <option value="مطاعم">مطاعم   </option>
                                    <option value="اثاث">اثاث  </option>
                                    
                                </select>
                                 </div>
                              <br>
                             
                              <div class="form-group">
                                <label>Shop Name</label>
                                <input type="text" class="form-control"name="shopname">require
                              </div>
                              <br>
                            
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"name="image"require>
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            <br>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="add">Add</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                        
                        <?php
                        if(isset($_POST['add'])){

                            $cityname=$_POST ['cityname'];
                            $streetname=$_POST ['streetname'];
                            $categoryname=$_POST ['categoryname'];
                            $shopname=$_POST ['shopname'];
                            $image=$_POST ['image'];
                            $_companyname ['companyname'];
                       
                        $query1="INSERT INTO cities (cityname)  VALUES ('$cityname')";
                        $query_run1=mysqli_query($conn,$query1);
                        if($query_run1){
                        $query2="INSERT INTO streets (streetname)  VALUES ('$streetname')";
                        $query_run2=mysqli_query($conn,$query2);
                        if($query_run2){
                        $query3="INSERT INTO categories (categoryname)  VALUES ('$categoryname')";
                        $query_run3=mysqli_query($conn,$query3);
                        if($query_run3){
                        $query4="INSERT INTO companies (_companyname) VALUES ('$_companyname')";
                        $query_run4=mysqli_query($conn,$query4);
                        if($query_run4){
                        $query5="INSERT INTO shops (shopname,image) VALUES ('$shopname', '$image')";
                        $query_run5=mysqli_query($conn,$query5);
                        if($query_run5){
                            $_SESSION['success']="Your Data Is added";
                            header("location:show.php");
                        
                        }}}}}
                        else{
                            $_SESSION['status']="Your Data NOT added";
                            header("show.php");
                        }
                        }
                        ?>
                       
                      
             </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../js/jquery-3.5.1.min.js"></script>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>