<?php

    // Sending email from our group email

    use \PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function sendEmail($email , $name , $body , $subject){
        //Load Composer's autoloader
        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'cs29groupproject@gmail.com';                  
            $mail->Password   = 'azwq irtg fuej dfxs';                               
            $mail->SMTPSecure = 'ssl';            
            $mail->Port       = 465;                                 

            //Recipients
            $mail->setFrom('cs29groupproject@gmail.com', 'Labora');
            $mail->addAddress($email, $name);    

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();

        } catch (Exception $e) {
        }
    }



?>
