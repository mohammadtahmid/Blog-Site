<?php

    include_once '../lib/Database.php';
    include_once '../helpers/Format.php';

    include_once '../PHPmailer/PHPMailer.php';
    include_once '../PHPmailer/SMTP.php';
    include_once '../PHPmailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class Resendemail{

        private $db;
        private $fr;

        public function __construct(){
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function resendEmail($email){

            function resend_email_varifi($name, $email, $v_token){
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                
                $mail->Host = 'smtp.gmail.com';

                $mail->Username = 'tahmidalmaruf99@gmail.com';

                $mail->Password = 'vgyenrkwuvvtvjuo';

                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('tahmidalmaruf99@gmail.com', $name);
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Email varification From web Master';

                $email_template = "
                    <h2>you have register with web master</h2>
                    <h5>verify your email address to login please click the link below</h5>
                    <a href='http://localhost/pweb/admin/verifi-email.php?token=$v_token'>Click Here</a>
                ";
                $mail->Body = $email_template;
                $mail->send();
                //echo "Email has been sent";
            }

            $email = $this->fr->validation($email);
            $email = mysqli_real_escape_string($this->db->link, $email);

            if(!empty($mail)){
                $error = "Email must not be empty";
                return $error;
            }else{
                $cheakEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
                $emailResult = $this->db->select($cheakEmail);

                if(mysqli_num_rows($emailResult) > 0){

                    $row = mysqli_fetch_assoc($emailResult);

                    if($row['v_status'] == 0){

                        $name = $row['username'];
                        $email = $row['email'];
                        $v_token = $row['v_token'];

                        resend_email_varifi($name, $email, $v_token);
                        $success = "Varification Email link has been sent in your email";
                        return $success;

                    }else{
                        $error = "Email Already Verified. Please Login";
                        return $error;
                    }

                }else{
                    $error = "Email is not register please register first";
                    return $error;
                }
            }
        }
    }

?>