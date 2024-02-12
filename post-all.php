<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Post.php';
$pt = new Post();

include_once '../helpers/Format.php';
$fr = new Format();

$userId = Session::get('userId');
$allPost = $pt->GetAllPost($userId);


// $allPost = $pt->GetAllPost();

//Deactive
if (isset($_GET['deactive'])) {
    $did = base64_decode($_GET['deactive']);
    $deactive = $pt->deactivePost($did);
}

//Active
if (isset($_GET['active'])) {
    $aid = base64_decode($_GET['active']);
    $active = $pt->activePost($aid);
}



if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
}



if(isset($_GET['delpost'])){
    $id = base64_decode($_GET['delpost']);
    $DeletePost = $pt->DeletePost($id);
}



?>



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <span>
                        <?php
                        if (isset($deleteCat)) {
                            echo '<p>' . $DeleteCat . '</p>';
                        }
                        ?>

                        <?php
                        if (isset($active)) {
                            echo $active;
                        }

                        if (isset($deactive)) {
                            echo $deactive;
                        }

                        if(isset($DeletePost)){
                            echo $DeletePost;
                        }
                        ?>

                    </span>
                    <div class="card">
                        <h5 class="card-header">Post || List</h5>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Image One</th>
                                        <th>Image Two</th>
                                        <th>PostType</th>
                                        <th>Tags</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php

                                    if ($allPost) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($allPost)) {
                                            $i++;
                                            ?>

                                            <tr>
                                                <td>
                                                    <?= $i ?>
                                                </td>
                                                <td>
                                                    <?= $row['title'] ?>
                                                </td>
                                                <td>
                                                    <?= $row['catName'] ?>
                                                </td>
                                                <td><img style="width: 80px" src="<?= $row['imageOne'] ?>" alt=""></td>
                                                <td><img style="width: 80px" src="<?= $row['imageTwo'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($row['postType'] == 1) {
                                                        echo 'Post';
                                                    } else {
                                                        echo 'Slide';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $fr->textSorten($row['tags'], 10) ?>
                                                </td>
                                                <td>
                                                    <a href="postedit.php?editPost=<?= base64_encode($row['postId']) ?>"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="?delpost=<?=base64_encode($row['postId'])?>" onclick="confirm('Are you sure to Delete')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    <a href="" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#myModal-<?= $row['postId'] ?>"><i
                                                            class="fas fa-eye"></i></a>

                                                    <?php

                                                    if ($row['status'] == 1) {
                                                        ?>
                                                        <a href="?deactive=<?= base64_encode($row['postId']) ?>" class="btn btn-sm btn-warning"><i
                                                                class="fas fa-arrow-down"></i></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <a href="?active=<?= base64_encode($row['postId']) ?>" class="btn btn-sm btn-success"><i
                                                                class="fas fa-arrow-up"></i></a>
                                                        <?php
                                                    }

                                                    ?>


                                                </td>
                                            </tr>

                                            <?php
                                        }
                                    }

                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->





        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>

<!--  Large modal example -->
<?php


$modalData = $pt->modalData();
if ($modalData) {
    while ($row = mysqli_fetch_assoc($modalData)) {
        ?>

        <div id="myModal-<?= $row['postId'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-bordered">
                            <tr>
                                <td><label for="">Title</label></td>
                                <td>
                                    <?= $row['title'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="">Category</label></td>
                                <td>
                                    <?= $row['catName'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><img style="width: 80px" src="<?= $row['imageOne'] ?>" alt=""></td>
                            </tr>
                            <tr>
                                <td><label for="">Details One</label></td>
                                <td>
                                    <?= $row['disOne'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><img style="width: 80px" src="<?= $row['imageTwo'] ?>" alt=""></td>
                            </tr>
                            <tr>
                                <td><label for="">Details Two</label></td>
                                <td>
                                    <?= $row['disTwo'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="">Post Type</label></td>
                                <td>
                                    <?php
                                    if ($row['postType'] == 1) {
                                        echo "Post";
                                    } else {
                                        echo "Slide";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="">Tags</label></td>
                                <td>
                                    <?= $row['tags'] ?>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php
    }
}


?>





<?php
include_once 'inc/footer.php';
?>