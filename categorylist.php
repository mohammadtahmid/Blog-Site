<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/Category.php';
$ct = new Category();

$allCat = $ct->AllCategory();

if(isset($_GET['delCat'])){
    $id = base64_decode($_GET['delCat']);

    $deleteCat = $ct->DeleteCategory($id);
}

if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
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
                        if (isset($deleteCat)){
                            echo '<p>'. $deleteCat .'</p>';
                        }
                    ?>
                </span>
                    <div class="card">
                        <h5 class="card-header">Category || List</h5>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                

                                <tbody>
                                <?php 
                                
                                    if($allCat){
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($allCat)){
                                            $i++;
                                            ?>

                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?= $row['catName'] ?></td>
                                        <td>
                                            <a href="catEdit.php?editId=<?=base64_encode($row['catId'])?>" class="btn btn-success btn-sm">Edit</a>
                                            <a href="?delCat=<?=base64_encode($row['catId'])?>" onclick="return confirm('Are you sure to Delete <?= $row['catName'] ?>')" class="btn btn-danger btn-sm">Delete</a>
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
<?php
include_once 'inc/footer.php';
?>