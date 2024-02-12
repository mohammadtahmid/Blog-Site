<?php

    include_once '../classes/Register.php';
    $re = new Register();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $addUser = $re->AddUser($_POST);
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

    <title>Registration Form</title>
  </head>
  <body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
            
            <span>
            <?php 
                if(isset($addUser)){
                    ?>
                    <?=$addUser?>

                    <?php
                }
            ?>
            </span>


                <div class="card">
                    <h5 class="card-header">Registration Form</h5>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="phone" name="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="Password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Sign Up</button>
                            
                            <a href="login.php" class="btn btn-info">Login</a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="alert success">
		<input type="checkbox" id="alert2"/>
		<label class="close" title="close" for="alert2">
      <i class="icon-remove"></i>
    </label>
		<p class="inner">
			Your alerts have dismissed successfully.
		</p>
	</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


  </body>
</html>