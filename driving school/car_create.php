<?php
include('config.php');
session_start();
if (isset($_POST["submit"])) {
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $registration_number = mysqli_real_escape_string($conn, $_POST['registration_number']);
    $color = mysqli_real_escape_string($conn, $_POST['color']);


    $sqlInsert1 = "INSERT INTO car(model, registration_number, color ) VALUES ('$model','$registration_number','$color')";
    if(mysqli_query($conn,$sqlInsert1)){
        
        $_SESSION["submit"] = "Car Added Successfully!";
       
    }else{
        die("Something went wrong");
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

    <title>Car Create</title>
</head>
<body>
  
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Car Add 
                            <a href="cars.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="mb-3">
                                <label>Model</label>
                                <input type="text" name="model" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Registration Number</label>
                                <input type="text" name="registration_number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Color</label>
                                <input type="text" name="color" class="form-control">
                            </div>
                           
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-primary">Save Car</button>
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
