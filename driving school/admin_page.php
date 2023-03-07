<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['instructor_fname']) && !isset($_SESSION['instructor_lname'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Instructor page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h1>Hi, <span><?php echo $_SESSION['instructor_fname']?> </span><span><?php echo $_SESSION['instructor_lname']  ?> </span> !</h1>

   <ul>
      <li><a href="students.php" class="btn">Students</a></li>
      <li><a href="cars.php" class="btn">Cars</a></li>
      <li><a href="statistic.php" class="btn">Statistic</a></li>
      <li><a href="profile-edit.php" class="btn">Update profile</a></li>
      <li><a href="logout.php" class="btn">Logout</a></li>
   </ul>
      <!-- <a href="lessons.php" class="btn">Lessons</a> -->
      </div>
   </div>

</div>

</body>
</html>