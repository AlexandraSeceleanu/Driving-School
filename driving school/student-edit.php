<?php
include('config.php');
session_start();
if (isset($_POST["submit"])) {
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $instructorID =  $_SESSION['instructorID'];
    $studentID = mysqli_real_escape_string($conn, $_POST["studentID"]);

    $sqlUpdate = "UPDATE student SET lastname = '$lastname', firstname = '$firstname', birthday = '$birthday', email = '$email',  phone = '$phone', instructorID = '$instructorID' WHERE studentID='$studentID'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Student Updated Successfully!";
        header("Location:students.php");
    }else{
        die("Something went wrong");
        header("Location: students.php");
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

    <title>Student Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit 
                            <a href="students.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['studentID']))
                        {
                            $studentID = mysqli_real_escape_string($conn, $_GET['studentID']);
                            $query = "SELECT * FROM student WHERE studentID='$studentID' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="studentID" value="<?= $student['studentID']; ?>">

                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" value="<?=$student['lastname'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" name="firstname" value="<?=$student['firstname'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Birthday</label>
                                        <input type="date" name="birthday" value="<?=$student['birthday'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="<?=$student['phone'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$student['email'];?>" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            Update Student
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>