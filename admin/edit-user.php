<?php
include('../handler/db.php');
session_start();

if(!isset($_SESSION['admin'])){
  header('location:admin-login.php');
  exit();
}

?>
<?php
$conn=mysqli_connect("localhost","root","","graduation_project");


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
                <li class="nav-item ">
                  <a class="nav-link" href="addtrend.php">addtrend</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="show-trendshop.php">Trend shop</a>
</li>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['admin']['name'];?>
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
                <h3 class="mb-3">Edit User</h3>
                <div class="card">
                    <div class="card-body p-5">
                      
                  <?php  
                  if(isset($_POST['edit-btn'])){
                    $id=$_POST['edit-id'];
                    $query="select * from users where id='$id'";
                    $query_run=mysqli_query($conn,$query);
                    foreach($query_run as $row){
                        ?>

              

                    <form method="post" action="code.php" >
                            <div class="form-group">
                            <input type="hidden" name="edit-id" value="<?php echo $row['id']?>">

                              <label>User Name</label>
                              <input type="text" class="form-control" name="edit-username" value="<?php echo $row['name']?>" placeholder="enter user name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="edit-email" value="<?php echo $row['email']?>"  placeholder="enter email">

                            </div>
                            

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="edit-password" value="<?php echo $row['password']?>" placeholder="enter password">
                            </div>

                              
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary" name="update-btn">Update</button>
                                <a class="btn btn-dark" href="handel-user.php">Back</a>
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







