<?php
include('../handler/db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
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
                <h3 class="mb-3">Edit Shop information</h3>
                <div class="card">
                    <div class="card-body p-5">
                       
                    <?php  
                  if(isset($_POST['edit-btn'])){
                    $id=$_POST['edit-id'];
                    $query="SELECT cities.cityname, streets.streetname, categories.categoryname, shops.shopname, shops.image, shops.id FROM cities, streets, categories, shops WHERE cities.id = streets.cities_id AND streets.id = shops.street_id AND categories.id = shops.category_id and shops.id='$id'";
                    $query_run=mysqli_query($conn,$query);
                    foreach($query_run as $row){
                        ?>
                    <form method="post" action="shopcode.php">
                    <div class="form-group">
                              
                              <input type="hidden" class="form-control"name="edit-id" value="<?php echo $row['id'];?>">
                            </div>
                            <BR>
                            <div class="form-group">
                              <label>City Name</label>
                              <input type="text" class="form-control"name="edit-city" value="<?php echo $row['cityname'];?>">
                            </div>
                            <BR>
                        
                            <div class="form-group">
                              <label>Street Name</label>
                              <input type="text" class="form-control"name="edit-street"value="<?php echo $row['streetname'];?>">
                            </div>
                            <BR>
                            <div class="form-group">
                              <label>Category Name</label>
                              <input type="text" class="form-control"name="edit-category"value="<?php echo $row['categoryname'];?>">
                            </div>
                            <BR>
                            <div class="form-group">
                              <label>Shop Name</label>
                              <input type="text" class="form-control"name="edit-shopname"value="<?php echo $row['shopname'];?>">
                            </div>
                            <BR>
                            <div class="form-group">
                              <label>Image</label>
                              <input type="file" class="form-control"name="edit-shopimage"value="<?php echo $row['image'];?>">
                            </div>
                            <BR>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="update-btn">Update</button>
                                <a class="btn btn-dark" href="show.php">Back</a>
                            </div>
                        </form>
                     
                        <?php   }

}?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  
</body>

</html>
