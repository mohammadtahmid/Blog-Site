<?php

include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/comment.php';
$cmt = new Comment();

if(isset($_GET['replyCmt'])){
    $cmtId = base64_decode($_GET['replyCmt']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reply = $_POST['reply'];

    $cmtReply = $cmt->Addreply($reply,  $cmtId);
}


?>


?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid"></div>
        <div class="row">
            <div class="col-xl-12">

                <span>
                    <?php
                    if (isset($cmtReply)) {
                        echo '<p>' . $cmtReply . '</p>';
                    }
                    ?>
                </span>

                <div class="card">
                    <h4 class="card-header shadow">Reply Post Comment</h4>
                    <div class="card-body">

                    <?php 
                    
                        $select_cmt = $cmt->commentSelect($cmtId);
                        if($select_cmt){
                            while($row = mysqli_fetch_assoc($select_cmt)){
                                ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Reply Message</label>
                                        <textarea name="reply" id="" cols="30" rows="10" class="form-control"><?=$row['admin_reply']?></textarea>
                                    </div>

                                    <div>
                                        <div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light me-1">
                                                Sent Reply
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