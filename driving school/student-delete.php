<?php
include('config.php');
session_start();
$student_ID = $_GET['studentID'];
$id = $_SESSION['instructorID'];

if (isset($_POST['submit'])) {

    $sql = "DELETE FROM student WHERE studentID='$student_ID' AND instructorID = '$id'";
    mysqli_query($conn,$sql);    
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

    <title>Student Delete</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                Are you sure?
                                <button type="submit" name="submit" class="btn btn-primary">
                                    Yes
                                </button>
                                <a href="students.php" class="btn btn-danger">No</a>
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