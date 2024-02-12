<?php

include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Category.php';

$ct = new Category();

if (isset($_GET['editId'])) {
    $id = base64_decode($_GET['editId']);
} else {
    header('location:categorylist.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];

    $upCat = $ct->UpdateCategory($catName, $id);
}

$allCat = $ct->AllCategory();


?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid"></div>
        <div class="row">
            <div class="col-xl-12">


           
            
                <span>
                    <?php
                        if (isset($upCat)){
                            echo '<p>'. $upCat .'</p>';
                        }
                    ?>
                </span>
        


                <div class="card">
                    <h4 class="card-header shadow">Category Update form</h4>
                    <div class="card-body">

                        <?php
                        $getData = $ct->getEditCat($id);
                        if ($getData) {
                            while ($row = mysqli_fetch_assoc($getData)) {
                                ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" name="catName" value="<?= $row['catName'] ?>" class="form-control"/>
                                    </div>

                                    <div>
                                        <div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light me-1">
                                                Update Category
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

<?php

include_once 'inc/footer.php';

?>