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
                        <form action="codetrend.php" method="post">
                            <form method="post">
                            <div class="form-group">
                                
                              
                                <select name="cityname" id=""  require >
                                <option value="city">  cityname </option>

                                    <?php
                                  
                                    $query1 ="SELECT * FROM cities";
                                    $query_run1 = mysqli_query($conn, $query1);  
                                    if(mysqli_num_rows($query_run1) > 0){
                                    foreach($query_run1 as $row1) {
                                   
                                   ?>
                                        <option value="<?= $row1['id']; ?>">  <?= $row1['cityname']; ?>  </option>
                                
                                        </div>
                                    
                                <?php
                                    }}?>
                                    </select>
                              </form>
                           
                           
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="shopname"require placeholder="shop Name">
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                             
                              <input type="text" class="form-control"name="description"require placeholder="description	">
                            </div>
                            <br>
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile"name="image"require>
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            <br>
                            

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="addtrend">Add</button>
                               
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