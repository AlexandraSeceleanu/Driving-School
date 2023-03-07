<?php
    $student_id = $_GET['studentID'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Lessons</title>
</head>
<body>
  
    <div class="container mt-4">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lessons
                        <a href="students.php" class="btn btn-danger float-end">Back</a>
                              
                    <a href="lesson_create.php?lessonID=<?= $student_id; ?>" class="btn btn-info float-end">Add New Lesson</a> </h4>
                            
                    </div>
                    <div class="card-body">
                    <?php
                            session_start();
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

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Start Time</th>
                                    <th>Stop Time</th>
                                    <th>Km </th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include('config.php') ;
                                    $query = "SELECT * FROM lesson,student where lesson.studentID = student.studentID AND student.studentID = $student_id";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $lesson)
                                        {
                                            ?>
                                            <tr>
                                               
                                                <td><?= $lesson['start_time']; ?></td>
                                                <td><?= $lesson['stop_time']; ?></td>
                                                <td><?= $lesson['km']; ?></td>
                                                <td><?= $lesson['remarks']; ?></td>
                                                
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>