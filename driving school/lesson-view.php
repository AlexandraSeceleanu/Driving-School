<?php

@include 'config.php';
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Lesson View</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lesson View Details 
                            <a href="lessons.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['lessonID']))
                        {
                            $lessonID = mysqli_real_escape_string($conn, $_GET['lessonID']);
                            $query = "SELECT * FROM lesson WHERE lessonID='$lessonID' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $lesson = mysqli_fetch_array($query_run);
                                ?>
                                
                                div class="mb-3">
                                <label>Start Time</label>
                                <input type="text" name="start_time" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Stop Time</label>
                                <input type="text" name="stop_time" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Number of Km</label>
                                <input type="text" name="km" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Remarks</label>
                                <input type="text" name="remarks" class="form-control">
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