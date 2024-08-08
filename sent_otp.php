<?php
require('connection.inc.php');
require('function.inc.php');

$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$password=get_safe_value($con,$_POST['password']);
$added_on=date('Y-m-d h:i:s');
$res=mysqli_query($con,"select * from users where email='$email'");
$count=mysqli_num_rows($res);
if($count>0)
{
    echo 'exist';
}
else
{
    $otp=rand(1111,9999);
    mysqli_query($con,"INSERT INTO `users`(`id`, `name`, `password`, `email`, `otp`, `mobile`, `added_on`) VALUES ('','$name','$password','$email','$otp','$mobile','$added_on')");
    $_SESSION['EMAIL']=$email;
    $html="$otp is your OTP";

	require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'aungnyinyimin32439@gmail.com';                 // SMTP username
    $mail->Password = 'gdbcegflheqtzjjd';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('aungnyinyimin32439@gmail.com', 'beauty life');
    $mail->addAddress($email);               // Name is optional

    $mail->addAttachment('C:\xampp\htdocs\email _verfy\image\Slide6.JPG');         // Add attachments
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'your otp code is ';
    $mail->Body    =  $otp;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'new';
    }
}


?>