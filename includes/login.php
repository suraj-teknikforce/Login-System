<?php
    include 'connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //For Login
        if($_POST['sign'] == 1){
            if(empty(mysqli_real_escape_string($con, $_POST['email'])) || empty(mysqli_real_escape_string($con, $_POST['password']))){
                echo "Please enter valid details.";
            }

            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = md5(mysqli_real_escape_string($con, $_POST['password']));
            $sql = "SELECT * FROM userlogin WHERE email = '$email' AND userPassword='$password'";
	        $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0){
                $row = mysqli_fetch_assoc($res);
                $result = mysqli_query($con, "SELECT * FROM userlogin WHERE email='$email' AND NOW() <= DATE_ADD(createdDate, INTERVAL 15 MINUTE)");
                $count = mysqli_num_rows($result);

                if($row['active'] == 0){
                    if(empty($count)) echo "Your verification code is expired.<br><br>
                                                                <form method='POST' id='inner-sign'>
                                                                    <input type='button' name='inner-sign-in' id='inner-sign-in' onclick='myFunction()' value='Click Here'>
                                                                    <input type='hidden' id='hiddenId' value='3'>
                                                                </form> <br><br>
                                                                To send verification code on your mail.";

                    else echo "Your email is not verified. <br>Please verify it.";
                }

                else{
                    session_start();
	        	    $_SESSION['id'] = $row['id'];
                    echo 1;
                }  
            }

            else {
                echo "Please enter valid details.";
            }
        }
        
        //For Registration
        else if($_POST['sign'] == 2){
            date_default_timezone_set("Asia/Kolkata");
            $name = mysqli_real_escape_string($con, trim($_POST['name']));
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = md5(mysqli_real_escape_string($con, $_POST['password']));
            $sql = "SELECT * FROM userlogin WHERE email = '$email'";
	        $res = mysqli_query($con, $sql);
            $count = mysqli_num_rows($res);
            $row = mysqli_fetch_assoc($res);
            $verification_id = rand(111111111, 999999999);
            
            if(empty(mysqli_real_escape_string($con, $_POST['email'])) || 
                empty(mysqli_real_escape_string($con, $_POST['password'])) || 
                empty(mysqli_real_escape_string($con, $_POST['name']))){
                    
                echo "Please enter valid details.";
            }
        
            else{            
                if($count > 0){
                    if($row['active'] == 0){
                        echo "The verification code is already sent to your email id. Please check and verify it.";
                    }
                
                    else{
                        echo "This email id is already register.";
                    }
                }
            
                else{
                    $sql = "INSERT INTO userlogin 
                            (userName, email, userPassword, active, verificationId, createdDate) 
                            VALUES ('$name', '$email', '$password', 0, '$verification_id', '". date("Y-m-d H:i:s") ."')
                            ";
                    mail_body($name, $email, $password, $verification_id, $con, $sql);
                }
            }
        }

        else if($_POST['sign'] == 3){
            if(!empty($_POST['email'])){
                $email = $_POST['email'];
                $sql = "SELECT * FROM userlogin WHERE email = '$email'";
	            $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($res);
                $verification_id = rand(111111111, 999999999);

                $sql =  "UPDATE userlogin 
                         SET verificationId='$verification_id', createdDate = NOW() 
                         WHERE email = '$email'
                        ";

                mail_body($row['userName'], $row['email'], $row['userPassword'], $verification_id, $con, $sql);
            }
        }
    }

    else{
        header('location:../');
        die();
    }

    function smtp_mailer($to, $subject, $msg) {
        require '../PHPMailer-master/src/PHPMailer.php';
        require '../PHPMailer-master/src/SMTP.php';
        require '../PHPMailer-master/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->SMTPDebug  = 0;
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "smaddheshiya561@gmail.com";
        $mail->Password = "Suraj0001@";
        $mail->SetFrom("smaddheshiya561@gmail.com");
        $mail->Subject = $subject;
        $mail->Body =$msg;
        $mail->AddAddress($to);
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if(!$mail->Send()){
            echo "Cannot sent to your mail.";
        }else{
            echo "Verification code sent to your email id.";
        }
    }

    function mail_body($name, $email, $password, $verification_id, $con, $sql){
	    mysqli_query($con, $sql);
        $template_file = "email_template.php";
        $swap_var = array( "{TO_NAME}" => $name, "{VERIFICATION_ID}" => $verification_id);
        
        if(file_exists($template_file))
            $message = file_get_contents($template_file);
        else
            die("Unable to locate the template file.");

        foreach(array_keys($swap_var) as $key){
            if(strlen($key) > 2 && trim($key) != "")
                $message = str_replace($key, $swap_var[$key], $message);
        }
        
        smtp_mailer($email, "Email Verification", $message);
    }
?>