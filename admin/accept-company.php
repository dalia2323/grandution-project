<?php
include('../handler/db.php');
session_start();

if(!isset($_SESSION['admin'])){
  header('location:admin-login.php');
  exit();
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

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php">City guide </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="handel-user.php">user</a>
                </li>
                <li class="nav-item active">
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Accept Company</h3>

                    <a href="handel-company.php" class="btn btn-dark">
                        pending company </a>
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
             $query=" select * from companies where status='accept'";
             $query_num=mysqli_query($conn,$query); 
              
              ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Created AT</th>
                            <th scope="col">status</th>
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
                                <?php echo $row['phone_number'];?>
                            </td>

                            <td><?php echo $row['created_at'];?></td>
                            <td>
                                <?php echo $row['status'];?>

                            </td>
                            <td>
                                <FORM method="post" action="edit-accept-company.php">
                                    <input type="hidden" name="edit-id" value="<?php echo $row['id'];?>">
                                    <BUtton type="submit" name="edit-btn" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                        </a></BUtton>

                                </FORM>
                            </td>
                            
                            <td>
                                <form method="post" action="code.php" >
                                    <input type="hidden" name="delete-id1-accept" value="<?php echo $row['id'];?>">
                                    <button type="submit" name="delete-btn1-accept" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

    <!-- <delete alert> -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="deleteRecord()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete(event) {
        event.preventDefault(); // prevent form submission
        $('#confirmDeleteModal').modal('show'); // show the modal
    }

    function deleteRecord() {
        $('#confirmDeleteModal').modal('hide'); // hide the modal
        $('form').submit(); // submit the form
    }





    //send accept email 
    function sendEmail(email) {
        var subject = 'Accepted Company'; // email subject
        var body =
            'Dear Company,\n\nWe are pleased to inform you that your account has been accepted.\n\nBest regards,'; // email body
        window.open('mailto:' + email + '?subject=' + subject + '&body=' + body);
    }
    //مش زابط
    function hideShopDiv() {
        console.log("hideShopDiv() function called"); // Add this line
        var acceptBtn = document.getElementById("accept-btn");
        acceptBtn.style.display = "none";
        var rejectBtn = document.getElementById("reject-btn");
        rejectBtn.style.display = "none";

    }
    </script>

</body>

</html>