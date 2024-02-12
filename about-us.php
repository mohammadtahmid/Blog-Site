<?php

include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/SiteOption.php';
$sop = new SiteOption();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update = $sop->aboutUpdate($_POST, $_FILES);
}

?>


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">

                    <span>
                        <?php
                        if (isset($update)) {
                        ?>
                            <?= $update ?>
                            </div>
                        <?php
                        }
                        ?>
                        <span>

        <div class="card shadow">
            <h4 class="card-header">About Us Form</h4>
            <div class="card-body">

            <?php 
                $getAbout = $sop->aboutInfo();
                if ( $getAbout) {
                    while ($row = mysqli_fetch_assoc($getAbout)) {
                        ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">User Name</label>
                        <input type="text" name="username" class="form-control" value="<?=$row['username']?>" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">User Photo</label>
                        <input type="file" name="image" class="form-control"/>
                        <img style="width: 200px;" src="<?=$row['image']?>" alt="" class="img-thumbnail">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">User details</label>
                        <textarea class="form-control" name="user_details"><?=$row['userDetails']?></textarea>
                    </div>


                    <div>
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                Update About
                            </button>

                        </div>
                    </div>
                </form>
                        <?php
                    }
                }
            ?>
                

            </div>
        </div>
                </div> <!-- end col -->


            </div> <!-- end row -->

        </div>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>