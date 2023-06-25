<?php
$page_title = 'seller_login'; 
session_start(); 
include('connection.php');

if(isset($_POST['log'])){ 
   $username = $_POST['username'];
   $pass     = $_POST['password'];  
   $pwd      = md5($pass);
   $query    = "SELECT * FROM company_account WHERE username = '$username' && password = '$pwd'" ;
   $run      = mysqli_query($conn, $query);
   $row      = mysqli_fetch_assoc($run);

      if($row){   
          $_SESSION['id'] = $row['buyer_id']; 
          $_SESSION['role'] = $row['role']; 
          $_SESSION['username'] = $row['username']; 
          header("Location:index.php");
      } else{
         $_SESSION['error'] = 'Please enter valid username';
      } 
}
?>
<div class="container">
      <div class="row">
         <div class="col-12"> 
               <?php
               if(isset($_SESSION['error'])){
               $msg =  $_SESSION['error']; 
               ?>
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>ERROR!</strong> <?php echo $msg; ?>.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
               <?php
                  unset($_SESSION['error']);
               }
               ?>
         </div>      
      </div> 
   </div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="upload_images/bar-logo.PNG" type="image/bar-icon">
    <title><?php 
      if($page_title == 'seller_login'){
       echo 'Login';
     } 
    ?></title>
    <link rel="stylesheet" href="../newproject/assets/css/style1.css">
</head>
<body>
   <div class="container">
         <div class="row">
               <div class="col-12"> 
                  <div class="box">
                     <form class="form" method="post" enctype="multipart/form-data" autocomplete="off" >
                        <h2>Sign in</h2>
                        <div class="inputBox">
                           <input type="text" name="username">
                           <span>Username</span>
                           <i></i>
                        </div>
                        <div class="inputBox">
                           <input type="password" name="password">
                           <span>Password</span>
                           <i></i>
                        </div>
                        <div class="links">
                           <a href="#">Forgot Password</a>
                           <a href="buyer_register.php">Don't have an Account ?</a>
                        </div>
                        <input type="submit" name="log" value="Login">
                     </form>
                  </div> 
               </div>
         </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>