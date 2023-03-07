<?php

@include 'config.php';
session_start();
$instructor_firstname = $_SESSION['instructor_fname'] ;
$instructor_lastname = $_SESSION['instructor_lname'] ;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student View</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details 
                            <a href="students.php" class="btn btn-danger float-end">Back</a>
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
                                
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <p class="form-control">
                                            <?=$student['lastname'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <p class="form-control">
                                            <?=$student['firstname'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Birthday</label>
                                        <p class="form-control">
                                            <?=$student['birthday'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <p class="form-control">
                                            <?=$student['email'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Phone</label>
                                        <p class="form-control">
                                            <?=$student['phone'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Instructor name</label>
                                        <p class="form-control">
                                            <?php
                                            echo $instructor_firstname;  
                                            ?>
                                            <?php
                                            echo $instructor_lastname;
                                            ?>
                                        </p>
                                    </div>


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