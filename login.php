<?php

    include_once '../classes/AdminLogin.php';

    $al = new AdminLogin();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $chkLogin = $al->LoginUser($email, $password);
    }



?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Login Form</title>
  </head>
  <body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">


            <span>
            <?php 
                if(isset($_SESSION['status'])){
                    ?>
                    <?= $_SESSION['status'] ?>

                    <?php
                }
            ?>
            </span>
                
            <span>
            <?php 
                if(isset($chkLogin)){
                    ?>
                    <?= $chkLogin ?>

                    <?php
                }
            ?>
            </span>

                <div class="card">
                    <h5 class="card-header">Login Form</h5>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="Password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Login</button>
                            <a href="register.php" class="btn btn-primary">Sign Up</a>

                            <a href="password-reset.php" class="float-right">Forget Your Password</a>
                        </form>
                        
                        <hr>

                        <h5>Did not receive your varification mail? <a href="resend-email.php">Resend</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


  </body>
</html>