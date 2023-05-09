<?php
include('../handler/db.php');
session_start();
?>
<!-- success session -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=>, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
    <title>Document</title>
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
    
    <div class="container-fluid py-5">
    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>All Products</h3>
                <a href="#" class="btn btn-success">
                    Add shope
                </a>
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
                    
                    <th scope="col">Edit</th>
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
                    <td><FORM method="post" action="edit-shop.php">
                                  <input type="hidden" name="edit-id" value="<?php echo $row['id'];?>">
                                    <BUtton type="submit" name="edit-btn" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                        </a></BUtton>

                                </FORM>
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
    