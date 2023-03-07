<?php
include('config.php');
session_start();
if (isset($_POST["submit"])) {
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    $instructorID =  $_SESSION['instructorID'];

    $sqlInsert = "INSERT INTO student(lastname, firstname , birthday , email ,phone,instructorID) VALUES ('$lastname','$firstname','$birthday', '$email','$phone','$instructorID')";
    if(mysqli_query($conn,$sqlInsert)){
        
        $_SESSION["submit"] = "Student Added Successfully!";
       
    }else{
        die("Something went wrong");
    }
    header('location:students.php');
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

    <title>Student Create</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Add 
                            <a href="students.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="mb-3">
                                <label>Last Name</label>
                                <input type="text" name="lastname" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="firstname" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Birtday</label>
                                <input type="date" name="birthday" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                           
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-primary">Save Student</button>
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
