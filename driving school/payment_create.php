<?php
include('config.php');
session_start();
$id =  $_GET['lessonID'];
if (isset($_POST["submit"])) {
    $data = mysqli_real_escape_string($conn, $_POST['data']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    

    $sqlInsert1 = "INSERT INTO payment(data, amount, studentID ) VALUES ('$data','$amount','$id' )";
    
    if(mysqli_query($conn,$sqlInsert1)){
        $_SESSION["create"] = "Payment Created Successfully!";
       // header("Location:students.php");
    }else{
        die("Something went wrong");
       // header("Location: students.php");
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

    <title>Payment Create</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment Add 
                            <a href="students.php" class="btn btn-danger float-end">Back</a>
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
                        <form action="" method="POST">

                            <div class="mb-3">
                                <label>Data </label>
                                <input type="date" name="data" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Amount </label>
                                <input type="text" name="amount" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-primary">Save Payment</button>
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
