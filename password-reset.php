<?php

    include_once '../classes/PasswordReset.php';

    $pwr = new PasswordReset();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST['email'];

        $reset = $pwr->PasswordReset($email);
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

    <title>Password Reset</title>
  </head>
  <body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                
            <span>
            <?php 
                if(isset($resend)){
                    ?>
                    <?= $resend ?>

                    <?php
                }
            ?>
            </span>

                <div class="card">
                    <h5 class="card-header">Password Reset Form</h5>
                    <div class="card-body">
                        <form method="POST">

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info">Send password Reset Link</button>

                            
                        </form>
                        
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