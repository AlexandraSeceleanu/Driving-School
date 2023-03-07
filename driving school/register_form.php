<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
 

   $select = " SELECT * FROM instructor WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO instructor(lastname, firstname, birthday, phone, email, password) VALUES('$lastname', '$firstname','$birthday', '$phone','$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="lastname" required placeholder="Last name">
      <input type="text" name="firstname" required placeholder="First name">
      <input type="date" name="birthday" required placeholder="Date of birth">
      <input type="phonenumber" name="phone" required placeholder="Phone number">
      <input type="email" name="email" required placeholder="Email address">
      <input type="password" name="password" required placeholder="Password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      <input type="submit" name="submit" value="Register" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login</a></p>
   </form>

</div>

</body>
</html>