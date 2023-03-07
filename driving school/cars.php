
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Cars Details</title>
</head>
<body>
  
    <div class="container mt-4">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Cars
                        <a href="admin_page.php" class="btn btn-danger float-end">Back</a>
                        
                         
                            <a href="car_create.php" class="btn btn-info float-end">Add New Car</a> </h4>
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
                                    
                                    <th>Model</th>
                                    <th>Registration Number</th>
                                    <th>Color </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include('config.php') ;
                                    $query = "SELECT * FROM car";
                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $car)
                                        {
                                            ?>
                                            <tr>
                                               
                                                <td><?= $car['model']; ?></td>
                                                <td><?= $car['registration_number']; ?></td>
                                                <td><?= $car['color']; ?></td>
                                                <td>
                                                    <a href="allocation.php?carID=<?= $car['carID']; ?>" class="btn btn-info">View Instructors</a>
                                                    <a href="car-delete.php?carID=<?= $car['carID']; ?>" class="btn btn-danger">Delete</a>
                </td>
                                                </td>
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