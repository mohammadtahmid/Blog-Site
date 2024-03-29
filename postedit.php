<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';

include_once '../classes/Post.php';
$post = new Post();

include_once '../classes/Category.php';
$ct = new Category();

//Edit Post
if (isset($_GET['editPost'])) {
    $id = base64_decode($_GET['editPost']);
    $getPost = $post->getPostForEdit($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $post_add = $post->EditPost($_POST, $_FILES, $id);
}

?>



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">

                    <span>
                        <?php
                        if (isset($post_add)) {
                            echo '<p>' . $post_add . '</p>';
                        }
                        ?>
                    </span>

                    <div class="card">
                        <h4 class="card-header shadow">Post Edit form</h4>
                        <div class="card-body">

                            <?php
                            
                            if ($getPost) {
                                while ($prow = mysqli_fetch_assoc($getPost)) {
                                    ?>
                                    <form action="" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="userId" class="form-control"
                                        value="<?= Session::get('userId') ?>" />

                                    <div class="mb-3">
                                        <label class="form-label">Post Title</label>
                                        <input type="text" name="title" class="form-control" value="<?=$prow['title']?>" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Select Category</label>
                                        <div class="form-group">
                                            <select class="form-select" name="catId" id="">
                                                <option>Select</option>
                                                <?php

                                                $allCat = $ct->AllCategory();
                                                if ($allCat) {
                                                    while ($row = mysqli_fetch_assoc($allCat)) {
                                                        ?>
                                                        <option <?=$prow['catId'] == $row['catId']? 'selected':''?> value="<?= $row['catId'] ?>"><?= $row['catName'] ?></option>
                                                        <?php
                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image One</label>
                                        <input type="file" name="imageOne" class="form-control"/>
                                        <img style="width: 200px" class="img-thumbnail" src="<?=$prow['imageOne']?>" alt="">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description One</label>
                                        <textarea name="disOne" id="classic-editor"><?=$prow['disOne']?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image Two</label>
                                        <input type="file" name="imageTwo" class="form-control"/>
                                        <img style="width: 200px" class="img-thumbnail" src="<?=$prow['imageTwo']?>" alt="">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description Two</label>
                                        <textarea name="disTwo" id="classic-editor_Two"><?=$prow['disTwo']?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Post Type</label>
                                        <div>
                                            <select class="form-select" name="postType">
                                                <option>Select</option>
                                                <?php
                                                if($prow['postType'] == 1){
                                                    ?>
                                                    <option selected value="1">Post</option>
                                                    <option value="2">Slider</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <option value="1">Post</option>
                                                    <option selected value="2">Slider</option>
                                                    <?php
                                                }
                                                ?>
                                                

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <input type="text" name="tags" class="form-control" value="<?=$prow['tags']?>" />
                                    </div>

                                    <div>
                                        <div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light me-1">
                                                Edit Post
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


            </div> <!-- container-fluid -->
        </div>
    </div>
    <!-- End Page-content -->
    <?php
    include_once 'inc/footer.php';
    ?>