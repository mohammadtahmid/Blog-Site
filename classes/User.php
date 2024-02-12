<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/Database.php';
include_once $filepath.'/../helpers/Format.php';

    class User{
        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function userInfo($id){
            $user_Query = "SELECT * FROM tbl_user WHERE userId = '$id'";
            $result = $this->db->select($user_Query);
            return $result;
        }

        //Show Fornend User Info
        public function userBio(){
            $user_Query = "SELECT * FROM tbl_user";
            $result = $this->db->select($user_Query);
            return $result;
        }

        //update user
        public function userUpdate($data, $file, $id){
            $username = $this->fr->validation($data['username']);
            $user_bio = $this->fr->validation($data['user_bio']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $upload_image = "upload/".$unique_image;

            if (empty($username) || empty($user_bio)){
                $error = "User name & User Bio File must not be empty";
                return $error;
            }else{
                if(!empty($file_name)){
                    if($file_size > 5242835){
                        $error = "File must be less than 5 mb";
                        return $error;
                    }elseif(in_array($file_ext, $permited) == false){
                        $error = "you Can Upload Only:-". implode(', ', $permited);
                        return $error;
                    }else{
                        move_uploaded_file($file_temp, $upload_image);
        
                        $query = "UPDATE tbl_user SET username = '$username', image = '$upload_image', user_bio = '$user_bio' WHERE userId = '$id'";
                        $result = $this->db->update($query);
                        if($result){
                            $success = "Profile update Successfully";
                            return $success;
                        }else{
                            $error = "Something Wrong Profile is not Update!";
                            return $error;
                        }
                    }
                }else{
                    $query = "UPDATE tbl_user SET username = '$username', user_bio = '$user_bio' WHERE userId = '$id'";
                        $result = $this->db->update($query);
                        if($result){
                            $success = "Profile update Successfully";
                            return $success;
                        }else{
                            $error = "Something Wrong Profile is not Update!";
                            return $error;
                        }
                }
            }
        }

        //Index total Number of Users
        public function totalUser(){
            $total_que = "SELECT * FROM tbl_user";
            $total_user = $this->db->select($total_que);
            return $total_user;
        }
    }

?>