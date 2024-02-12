<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/SiteOption.php';
$sop = new SiteOption();

include_once '../helpers/Format.php';
$fr = new Format();



if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
}



if(isset($_GET['delCnt'])){
    $id = base64_decode($_GET['delCnt']);
    $DeleteCnt = $sop->DeleteContact($id);
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

                        if(isset($DeleteCnt)){
                            echo $DeleteCnt;
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $allContact = $sop->allContact();
                                    if ($allContact) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($allContact)) {
                                            $i++;
                                            ?>

                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                
                                                <td>
                                                    <?= $fr->textSorten($row['message'], 50) ?>
                                                </td>
                                                <td>
                                                    <a href="?delCnt=<?=base64_encode($row['contactId'])?>" onclick="confirm('Are you sure to Delete')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                    <a href="" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#myModal-<?= $row['contactId'] ?>"><i
                                                            class="fas fa-eye"></i></a>


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


$modalData = $sop->allContact();
if ($modalData) {
    while ($row = mysqli_fetch_assoc($modalData)) {
        ?>

        <div id="myModal-<?= $row['contactId'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                <td><label for="">Name</label></td>
                                <td>
                                    <?= $row['name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="">Email</label></td>
                                <td>
                                    <?= $row['email'] ?>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="">Phone</label></td>
                                <td>
                                    <?= $row['phone'] ?>
                                </td>
                            </tr>

                            <tr>
                                <td><label for="">message</label></td>
                                <td>
                                    <?= $row['message'] ?>
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