<?php
class token {
  function __construct(){
    require_once 'addons/PHPMailer/PHPMailer.php';
  }
  public function generate(){
    $t = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm';
    $t = str_shuffle($t);
    $t = substr($t, 0, 16);
    return $t;
  }
  public function sendMail($email, $token){;
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->setFrom('noreply@michalmlotowski.com','Michal Mlotowski');
    $mail->addAddress($email);
    $mail->Subject = 'Please verify your account on michalmlotowski.com';
    $mail->isHTML(true);
    $mail->Body = "To verify your account click on the link below: <br/></br/>
    <a href='https://www.michalmlotowski.com/panel/verify?u=$email&t=$token'>Verify now</a>";
    $mail->send();
  }
  public function sendPass($email,$token,$login){
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->setFrom('noreply@michalmlotowski.com','Michal Mlotowski');
    $mail->addAddress($email);
    $mail->Subject = 'Reset your password on michalmlotowski.com';
    $mail->isHTML(true);
    $mail->Body = "To reset your password click on the link below: <br/></br/>
    Username: $login <br/></br/>
    <a href='https://www.michalmlotowski.com/panel/reset?u=$login&t=$token'>reset now</a>";
    $mail->send();
  }
}

 ?>
