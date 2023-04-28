<?php
include('../handler/db.php');
session_start();
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
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">City Guide</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Admins</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <h3>All users</h3>

                    <!-- <a href="#" class="btn btn-success">
                        Add new
                    </a> -->
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
             $query=" select * from users";
             $query_num=mysqli_query($conn,$query); 
              
              ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">status</th>
                            <th scope="col">Created AT</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
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

                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td>
                                <?php echo $row['email'];?>
                            </td>
                            <td>
                                <?php echo $row['status'];?>
                            </td>
                            <td><?php echo $row['created_at'];?></td>
                            <td>
                                <FORM method="post" action="edit-user.php">
                                  <input type="hidden" name="edit-id" value="<?php echo $row['id'];?>">
                                    <BUtton type="submit" name="edit-btn" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                        </a></BUtton>

                                </FORM>
                            </td>
                            <td>
                              <form method="post" action="code.php">
                              <input type="hidden" name="delete-id" value="<?php echo $row['id'];?>">
                              <BUtton type="submit" name="delete-btn" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                                </form>
                            </td>

                        </tr>
                    </tbody>

                    <?php }
               }?>
                </table>
            </div>

        </div>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>