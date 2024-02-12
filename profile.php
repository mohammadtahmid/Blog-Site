<?php

include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Category.php';
$ct = new Category();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];

    $catAdd = $ct->AddCategory($catName);
}

?>


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">

                    <span>
                        <?php
                        if (isset($catAdd)) {
                            echo '<p>' . $catAdd . '</p>';
                        }
                        ?>
                    </span


                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>User Profile</h5>
                                </div>
                                <div class="col-sm-6  d-flex justify-content-end">
                                    <a href="edit-profile.php?uid=<?= Session::get('userId') ?>" class="btn btn-sm btn-info">Edit
                                        Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td><label for="">User Name</label></td>
                                    <td>
                                        <?= Session::get('username') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="">User Photo</label></td>
                                    <td><img style="width: 200px" src="<?=Session::get('userImage')?>" alt=""></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->





            </div> <!-- end row -->
        </div>
    </div>
    </div>

    <?php

    include_once 'inc/footer.php';

    ?>

