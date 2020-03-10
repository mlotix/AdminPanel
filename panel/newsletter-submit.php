<?php
session_start();
unset($_SESSION['answer']);

function errorM(){
  $_SESSION['answer']="$('<p>').addClass('text-danger').addClass('text-center').addClass('nl-ms').text('Invalid E-Mail! Try again').insertBefore('#newsletter-submit');";
  header('Location: index.php#newsletter');
}
function errorS(){
  $_SESSION['answer']="$('<p>').addClass('text-warning').addClass('text-center').addClass('nl-ms').text('Unknown Error! Try again!').insertBefore('#newsletter-submit');";
  header('Location: index.php#newsletter');
}
function errorT(){
  $_SESSION['answer']="$('<p>').addClass('text-danger').addClass('text-center').addClass('nl-ms').text('Email is already in the newsletter!').insertBefore('#newsletter-submit');";
  header('Location: index.php#newsletter');
}
function newsletter_success(){
  $_SESSION['answer']="$('<p>').addClass('text-success').addClass('text-center').addClass('nl-ms').text('Thank you for signing up!').insertBefore('#newsletter-submit');";
  header('Location: index.php#newsletter');
}

function sendMail($email){
  $topic = "Newsletter | Michael Mlotowski";
  $message = "This is only a test newsletter mail. Everything works fine. Mails can be fully customized";
  $message = wordwrap($message,70,"\r\n")."\n";
  $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

  $send = mail($email, $topic, $message, $headers);

  if($send){
    return true;
  }
  else {
    return false;
  }
}
function addMail($email){
  $host;
  $dbname;
  $dbpass;

  $db = new mysqli($host, $dbname, $dbpass, $dbname);
  if($db->connect_errno){
    return 'ERROR';
  }
  $query = "SELECT email FROM newsletter WHERE email='$email'";

  if(!$result = $db->query($query)){
    $db->close();
    return 'ERROR';
  }
  else {
    $rows = $db->num_rows;
    if($rows>0){
      $db->close();
      return 'TAKEN';
    }
    else {
      $query = "INSERT INTO newsletter (id, email) VALUES (0, '$email')";
      if(!$result = $db->query($query)){
        $db->close();
        return 'ERROR';
        }
      if($db->affected_rows <> 1){
        $db->close();
        return 'ERROR';
      }
    }
  }
  $db->close();
  return 'OK';
}

if(isset($_POST['email'])==false){
  errorM();
}
$email = strip_tags(trim($_POST['email']));
$email = str_replace(array("\r","\n"),array(" "," "),$email);

if($email==false || $email==" " || $email==""){
  errorM();
}

$email_length= mb_strlen($email, 'UTF-8');

if($email_length<6 || $email_length>64){
  errorM();
}
else if(!preg_match("/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/", $email)){
  errorM();
}
else{
  $n = addMail($email);
  if($n=='ERROR'){
    errorS();
  }
  if($n=='TAKEN'){
    errorT();
  }
  if($n=='OK'){
    if(sendMail($email)==true){
      newsletter_success();
    }
    else{
      errorS();
    }
  }
}

header('Location: index.php#newsletter');
exit();


 ?>
