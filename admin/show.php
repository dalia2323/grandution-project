<?php
session_start();
if(!isset($_SESSION['admin'])){
  header('location:admin-login.php');
  exit();
}
include('../handler/db.php');

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
                <li class="nav-item active">
                  <a class="nav-link" href="show.php">Shops</a>
                </li>
            
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['admin']['name'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="admin-profile.php">Profile</a>
                      <a class="dropdown-item" href="admin-login.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    
  
    
    <div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Products</h3>
                <div class="text-center mt-5">
                <a class="btn btn-dark" href="add.php"name="add-shop">Add shop</a>                            </div>
            </div>


            <?php
if(isset($_SESSION['success'])&& $_SESSION['success']!='')
{
  echo '<div class="alert alert-success" role="alert">' .$_SESSION['success'].'</div>';
  unset($_SESSION['success']);
}
if(isset($_SESSION['status'])&& $_SESSION['status']!='')
{
  echo '<h2 class="bg-info">'.$_SESSION['status']. '</h2>';
  unset($_SESSION['status']);
}

?> 
            <?php

             $query=" SELECT cities.cityname, streets.streetname, categories.categoryname, shops.shopname, shops.image, shops.id FROM cities, streets, categories, shops WHERE cities.id = streets.cities_id AND streets.id = shops.street_id AND categories.id = shops.category_id
             ";
             $query_num = mysqli_query($conn,$query); 
              
              ?>

            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">City Name</th>
                    <th scope="col">street name</th>
                    <th scope="col">Category</th>
                    <th scope="col">shop name</th>
                    <th scope="col">Image</th>
                    <th scope="col">delete</th>
                    
                  </tr>
                </thead>
                <?php
                    if(mysqli_num_rows($query_num)>0)
                    {
                      while($row=mysqli_fetch_assoc($query_num))
                     {
                   ?>
                
                <tbody>
                  <tr>
                    <th scope="row"><?php echo $row['id'];?></th>
                    <td><?php echo $row['cityname'];?></td>
                    <td><?php echo $row['streetname'];?></td>
                    <td>
                    <?php echo $row['categoryname'];?> 
                    </td>
                    <td><?php echo $row['shopname'];?></td>
                    <td><?php echo $row['image'];?></td>
                   <td>
                        
                    <form method="post" action="shopcode.php">
                              <input type="hidden" name="delete-id" value="<?php echo $row['id'];?>">
                              <BUtton type="submit" name="delete-btn" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                </form>
                    </td>
                  </tr>
                </tbody>
                <?php }}
               ?>
            </table>
        </div>

    

</body>
</html>
    