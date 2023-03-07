<?php
include('config.php');
session_start();

$instructorID =  $_SESSION['instructorID'];

if (isset($_POST["submit"])) {
    $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
    $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
    $update_birthday = mysqli_real_escape_string($conn, $_POST['update_birthday']);
    $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

    $sqlUpdate = "UPDATE `instructor` SET lastname = '$update_lastname', firstname = '$update_firstname', birthday = '$update_birthday', phone = '$update_phone', email = '$update_email' WHERE instructorID = '$instructorID'";
    mysqli_query($conn, $sqlUpdate);
    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   
    if(!empty($update_pass) || !empty($new_pass)){
        if($update_pass != $old_pass){
        }else{
            mysqli_query($conn, "UPDATE `instructor` SET password = '$new_pass' WHERE instructorID = '$instructorID'"); 
        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Profile Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile Edit 
                            <a href='admin_page.php' class='btn btn-danger float-end'>Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                            if (isset($_SESSION["create"])) {
                            ?>
                            <div class="alert alert-success">
                                <?php 
                                echo $_SESSION["create"];
                                ?>
                            </div>
                            <?php
                            unset($_SESSION["create"]);
                            }
                            ?>
                            <?php
                            if (isset($_SESSION["update"])) {
                            ?>
                            <div class="alert alert-success">
                                <?php 
                                echo $_SESSION["update"];
                                ?>
                            </div>
                            <?php
                            unset($_SESSION["update"]);
                            }
                            ?>
                            <?php
                            if (isset($_SESSION["delete"])) {
                            ?>
                            <div class="alert alert-success">
                                <?php 
                                echo $_SESSION["delete"];
                                ?>
                            </div>
                            <?php
                            unset($_SESSION["delete"]);
                            }
                            ?>

<?php
      $select = mysqli_query($conn, "SELECT * FROM `instructor` WHERE instructorID = '$instructorID'");
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>
                                <form action="" method="POST">

                                    <div class="mb-3">
                                        <label>Last name:</label>
                                        <input type="text" name="update_lastname" value="<?=$fetch['lastname'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>First name:</label>
                                        <input type="text" name="update_firstname" value="<?=$fetch['firstname'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Birthday:</label>
                                        <input type="text" name="update_birthday" value="<?=$fetch['birthday'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone:</label>
                                        <input type="text" name="update_phone" value="<?=$fetch['phone'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email:</label>
                                        <input type="email" name="update_email" value="<?=$fetch['email'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                    <input type="hidden" name="old_pass" value="<?php echo $fetch['password'];?>" class="form-control">
                                        <label>Old password:</label>
                                        <input type="password" name="update_pass" placeholder="Your previous password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>New password:</label>
                                        <input type="password" name="new_pass" placeholder="Your new password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            Update Profile
                                        </button>
                                    </div>

                                </form>
    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>