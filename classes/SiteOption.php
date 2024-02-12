<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/Database.php';
include_once $filepath.'/../helpers/Format.php';

class SiteOption{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function allSocial(){
        $select_que = "SELECT * FROM tbl_social WHERE sId = '1'";
        $result_res = $this->db->select($select_que);
        return $result_res;
    }

    public function updateLinks($data){
        $tw = $data['twtter'];
        $fb = $data['facebook'];
        $insta = $data['insta'];
        $you = $data['youtube'];
        $update_que = "UPDATE tbl_social SET twtter = '$tw', facebook = '$fb', insta = '$insta', youtube = '$you'";
        $update_res = $this->db->update($update_que);
        if($update_res){
            $msg = "Link Update Successfully";
            return $msg;
        }else{
            $msg = "Link Update failed";
            return $msg;
        }
    }
    


    // Logo Update
    public function siteLogo(){
        $select_query = "SELECT * FROM tbl_logo WHERE logoId = '1'";
        $result = $this->db->select($select_query);
        return $result;
    }

    //Update Logo
    public function updateLogo($data){
        $logo = $this->fr->validation($data['logo']);
        $update_logo = "UPDATE tbl_logo SET logoName = '$logo' WHERE logoId = '1'";
        $logo_result = $this->db->update($update_logo);
        if($logo_result){
            $msg = "logo updated successfully";
            return $msg;
        }else{
            $msg = "logo not updated successfully";
            return $msg;
        }
    }


          //About Us Option
          public function aboutInfo(){
            $about_que = "SELECT * FROM tbl_about WHERE aboutId = '1'";
            $about_result = $this->db->select($about_que);
            return $about_result;
        }

        public function aboutUpdate($data, $file){
            $username = $this->fr->validation($data['username']);
            $user_details = $this->fr->validation($data['user_details']);
        
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $upload_image = "upload/".$unique_image;

            if (empty($username) || empty($user_details)) {
                $msg = "User Name & User Details Fild must not be empty";
                return $msg;
            }else {
                if (!empty($file_name)) {
                    if($file_size > 1048567){
                        $msg = "File Size Must Be less than 1 MB";
                        return $msg;
                    }elseif (in_array($file_ext, $permited) == false) {
                        $msg = "You Can Upload Only:-". implode(', ', $permited);
                        return $msg;
                    }else {
                        move_uploaded_file($file_temp, $upload_image);

                        $query = "UPDATE tbl_about SET username='$username', image = '$upload_image', user_details = '$user_details' WHERE aboutId = '1'";

                        $result = $this->db->update($query);
                        if ($result) {
                            $msg = "About Updated Successfully";
                            return $msg;
                        }else {
                            $msg = "Something Wrong About is not Updated";
                            return $msg;
                        }
                    }
                }else {

                        $query = "UPDATE tbl_about SET username='$username', user_details = '$user_details' WHERE aboutId = '1'";    
                        $result = $this->db->update($query);
                        if ($result) {
                            $msg = "About Updated Successfully";
                            return $msg;
                        }else {
                            $msg = "Something Wrong About is not Updated";
                            return $msg;
                        }
                }
            }
        
        }

    //About Page Latest Post
    public function latestPost($offset, $limit){
        $post_query = "SELECT tbl_post.*, tbl_user.username, tbl_user.image FROM tbl_post INNER JOIN tbl_user ON tbl_post.userId = tbl_user.userId WHERE tbl_post.status = '0' ORDER BY tbl_post.postId DESC LIMIT $offset, $limit";
        $post_result = $this->db->select($post_query);
        return $post_result;
    }

    // public function catNum($id){
    //     $ct_query = "SELECT * FROM tbl_post WHERE tbl_post.catId = '$id'";
    //     $ct_res = $this->db->select($ct_query);
    //     return $ct_res;
    // }

    //Add Contact Page
    public function addContact($data){
        $name = $this->fr->validation($data['name']);
        $phone = $this->fr->validation($data['phone']);
        $email = $this->fr->validation($data['email']);
        $message = $this->fr->validation($data['message']);

        if($name == '' || $phone == '' || $email == '' || $message == ''){
            $msg = "File must not be empty";
            return $msg;
        }else{
            $contact_insert = "INSERT INTO tbl_contact (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";
            $contact = $this->db->insert($contact_insert);
            if($contact){
                $msg = "Update Successfully";
                return $msg;
            }else{
                $msg = "Something Is Wrong";
                return $msg;
            }
        }
    }

    //All Contact
    public function allContact(){
        $select = "SELECT * FROM tbl_contact ORDER BY contactId DESC";
        $result = $this->db->select($select);
        return $result;
    }
    //Delete contact
    public function DeleteContact($id){
        $delete = "DELETE FROM tbl_contact WHERE contactId = '$id'";
        $resutl = $this->db->delete($delete);
        if($resutl){
            $msg = "Contact deleted successfully";
            return $msg;
        }else{
            $msg = "Something is wrong";
            return $msg;
        }
    }
    
    

}   

?>