<?php 

    include_once '../lib/Database.php';
    include_once '../helpers/Format.php';

    include_once '../PHPmailer/PHPMailer.php';
    include_once '../PHPmailer/SMTP.php';
    include_once '../PHPmailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    // require '../vendor/autoload.php';

    class Register{

        public $db;
        public $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Format();
        }

        public function AddUser($data){

            function sendemail_varifi($name, $email,$v_token){
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

            $name = $this->fr->validation($data['name']);
            $phone = $this->fr->validation($data['phone']);
            $email = $this->fr->validation($data['email']);
            $password = $this->fr->validation(md5($data['password']));
            $v_token = md5(rand());



            if(empty($name) || empty($phone) || empty($email) || empty($password)){
                $error = "Fild Must Not Be Empty";
                return $error;
            }else{
                $e_query = "SELECT * FROM tbl_user WHERE email='$email'";
                $check_email =$this->db->select($e_query);
    
                if($check_email > '0'){
                    $error = "This email is already exisit";
                    return $error;
                    header("Location:register.php");
                }else{
                    $insert_query = "INSERT INTO tbl_user(username, email, phone, password, v_token) VALUES ('$name', '$email','$phone', '$password', '$v_token')";

                    $insert_row = $this->db->insert($insert_query);

                    if($insert_row){
                        sendemail_varifi($name, $email,$v_token);
                        $success = "Resistration Successfully. Please check your email inbox for varifi email";
                        return $success;
                    }else{
                        $error = "Ragistration Failed";
                        return $error;
                    }
                }
            }
        }
    }

?>