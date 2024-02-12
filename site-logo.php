<?php

include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/SiteOption.php';
$site = new SiteOption();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $update_logo = $site->updateLogo($_POST);
}


if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
}

?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid"></div>
        <div class="row">
            <div class="col-xl-8">

                <span>
                    <?php
                    if (isset($update_logo)) {
                        echo '<p>' . $update_logo . '</p>';
                    }
                    ?>
                </span>

                <div class="card">
                    <h4 class="card-header shadow">Social Link</h4>
                    <div class="card-body">

                        <?php

                        $logo = $site->siteLogo();
                        if ($logo) {
                            while ($row = mysqli_fetch_assoc($logo)) {
                                ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Logo</label>
                                        <input type="text" name="logo" class="form-control" value="<?= $row['logoName'] ?>" />
                                    </div>

                                    <div>
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">Update Logo</button>
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

<?php

include_once 'inc/footer.php';

?>