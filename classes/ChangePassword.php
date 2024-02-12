<?php

    include_once '../lib/Database.php';
    include_once '../helpers/Format.php';
    class ChangePassword{

        public $db;
        public $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function changePass($data){

            $email = $this->fr->validation($data['email']);
            $newPassword = $this->fr->validation(md5($data['newpassword']));
            $c_Password = $this->fr->validation(md5($data['c_password']));
            $token = $this->fr->validation($data['token']);

            if(!empty($token)) {

                if(!empty($email) || !empty($newPassword) || !empty($c_Password)){

                    $token_q = "SELECT v_token FROM tbl_user WHERE v_token = '$token'";
                    $token_result = $this->db->select($token_q);

                    if(!empty($token_result) && $token_result !== true){

                        if(mysqli_num_rows($token_result) > 0){
                            if($newPassword == $c_Password){
                                $update_pass = "UPDATE tbl_user SET password = '$newPassword' WHERE v_token = '$token'";
                                $up_result = $this->db->update($update_pass);
                                
                                if($up_result){
    
                                    $new_token = md5(rand());
                                    $up_token = "UPDATE tbl_user SET v_token = '$new_token' WHERE v_token = '$token'";
                                    $result = $this->db->update($up_token);
    
                                    $success = "Password Change successfully";
                                    return $success;
                                }else{
                                    $error = "Password do not Change";
                                    return $error;
                                }
                            }
                            else{
                                $error = "Password do not match";
                                return $error;
                            }
                        }else{
                            $error = "Invalid token";
                            return $error;
                        }
                    }else{
                        $error = "Invalid token";
                        return $error;
                    }

                    

                }else{
                    $error = "Filds Must Not be empty";
                    return $error;
                }

            }else{
                $error = "Token is not available";
                return $error;
            }


        }
    }

?>