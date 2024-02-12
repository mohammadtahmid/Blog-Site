<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/Database.php';
    include_once $filepath.'/../helpers/Format.php';

    class Comment{
        private $db;
        private $fr;
        
        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function addComment($data){
            $userId = $this->fr->validation($data['userId']);
            $postId = $this->fr->validation($data['postId']);
            $name = $this->fr->validation($data['name']);
            $email = $this->fr->validation($data['email']);
            $website = $this->fr->validation($data['website']);
            $message = $this->fr->validation($data['message']);

            if (empty('name') || empty('email') || empty('message')) {
                $msg = "Filds Must Be empty";
                return $msg;
            }else{
                $insert_cmt = "INSERT INTO `tbl_comment`(`userId`, `postId`, `name`, `email`, `website`, `message`) VALUES ('$userId', '$postId', '$name', '$website', '$email', '$message')";
                $result = $this->db->insert($insert_cmt);
                if($result){
                    $msg = "Comment added successfully";
                    return $msg;
                }else{
                    $msg = "Comment not added successfully";
                    return $msg;
                }
            }
        }

        public function allComment($id){
            $select_cmt = "SELECT tbl_comment.*, tbl_post.postId, tbl_user.username, tbl_user.image FROM tbl_comment INNER JOIN tbl_post ON tbl_comment.postId = tbl_post.postId INNER JOIN tbl_user ON tbl_comment.userId = tbl_user.userId WHERE tbl_comment.postId = '$id' AND tbl_comment.status = '1'";
            $select_result = $this->db->select($select_cmt);
            return $select_result;
        }

        //admin comment
        public function adminComment($id){
            $admin_cmt = "SELECT tbl_comment.*, tbl_user.userId FROM tbl_comment INNER JOIN tbl_user ON tbl_comment.userId = tbl_user.userId WHERE tbl_comment.userId = '$id'";
            $result = $this->db->select($admin_cmt);
            return $result;
        }

        public function deactivePost($did){
            $dq = "UPDATE tbl_comment SET status = 0 WHERE cmtId = '$did'";
            $d_result = $this->db->update($dq);
            if($d_result){
                $msg = "Comment Active, show This comment";
                return $msg;
            }
        }

        public function activePost($aid){
            $aq = "UPDATE tbl_comment SET status = 1 WHERE cmtId = '$aid'";
            $a_result = $this->db->update($aq);
            if($a_result){
                $msg = "Comment DeActive Do not show";
                return $msg;
            }
        }

        //select Comment for update and reply
        public function commentSelect($id){
            $select_cmt = "SELECT * FROM tbl_comment WHERE cmtId = '$id'";
            $select_res = $this->db->select($select_cmt);
            return $select_res;
        }

        //Admin Sent Reply
        public function Addreply($reply,  $id){
            $reply = $this->fr->validation($reply);
            $update_date = date("M d, Y h:i:sa");
            if(empty($reply)){
                $msg = "Reply Fild must be required";
                return $msg;
            }else{
                $update = "UPDATE tbl_comment SET admin_reply = '$reply', update_date = '$update_date' WHERE cmtId ='$id'";
                $up_res = $this->db->update($update);
                if($up_res){
                    $msg = "Reply successfully";
                    return $msg;
                }else{
                    $msg = "Something is wrong";
                    return $msg; 
                }
            }
        }


        //Delete comments
        public function DeleteCmt($id){
            $delect = "DELETE FROM tbl_comment WHERE cmtId = '$id'";
            $del = $this->db->delete($delect);
            if($del){
                $msg = "Comment Delete Successfully";
                return $msg;
            }else{
                $msg = "Something is wrong, Comment Is Not Deleted";
                return $msg;
            }
        }


    }




?>