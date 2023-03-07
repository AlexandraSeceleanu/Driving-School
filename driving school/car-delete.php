<?php
if (isset($_GET['carID'])) {
include("config.php");
$carID = $_GET['carID'];
$sql = "DELETE FROM car WHERE carID='$carID'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Car Deleted Successfully!";
    header("Location:cars.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Student does not exist";
}
?>