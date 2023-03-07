<?php
include('config.php');
session_start();

$lessonID =  $_GET['lessonID'];

if (isset($_POST["submit"])) {
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $stop_time = mysqli_real_escape_string($conn, $_POST['stop_time']);
    $km = mysqli_real_escape_string($conn, $_POST['km']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    

    $sqlUpdate = "UPDATE lesson SET start_time = '$start_time', stop_time = '$stop_time', km = '$km', remarks = '$remarks', studentID = 7 WHERE lessonID=$lessonID";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Lesson Updated Successfully!";
        header("Location:lessons.php");
    }else{
        die("Something went wrong");
        header("Location: lessons.php");
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

    <title>Lesson Edit</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lesson Edit 
                            <?php echo"<a href='lessons.php?studentID=".$studentID."' class='btn btn-danger float-end'>Back</a>"?>
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
                        if(isset($_GET['lessonID']))
                        {
                            $lessonID = mysqli_real_escape_string($conn, $_GET['lessonID']);
                            $query = "SELECT * FROM lesson WHERE lessonID='$lessonID' ";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $lesson = mysqli_fetch_array($query_run);
                                ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="studentID" value="<?= $lesson['studentID']; ?>">

                                    <div class="mb-3">
                                        <label>Start time</label>
                                        <input type="text" name="start_time" value="<?=$lesson['start_time'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Stop Time</label>
                                        <input type="text" name="stop_time" value="<?=$lesson['stop_time'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Number of Km</label>
                                        <input type="text" name="km" value="<?=$lesson['km'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Remarks</label>
                                        <input type="text" name="remarks" value="<?=$lesson['remarks'];?>" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            Update Lesson
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