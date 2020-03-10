<?php
session_start();
ob_start();

function secure_var($data){
  $data = strip_tags(trim($data));
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function leave(){
  session_unset();
  session_destroy();
  header('Location: ./login.php');
  exit();
}
function failed($m){
  $_SESSION['Vmsg']="RESEND_FAIL";
  header('Location: ./login.php');
  exit();
}
function resend_mail(){
  global $login;

  $username;
  $database;
  $host;
  $dbpass;

  $db = new mysqli($host, $username, $dbpass, $database);
  if($db->connect_errno){
    failed("DATABASE_FAILED_CONNECTION");
  }

  $db->real_escape_string($login);
  $query = "SELECT id,token,email from users2 WHERE username='$login' AND active=0";
  if(!$result = $db->query($query)){
    return "QUERY_ERROR";
  }
  $row = $db->num_rows;
  if($row > 1){

    return "QUERY_ROW_ERROR";
  }
  else if($row != 0){
    return "NO_USER";
  }
  else if($row == 0){
    $row = $result->fetch_row();
    $id = $row[0];
    $token = $row[1];
    $email = $row[2];

    require "./token.php";
    $t = new token;

    if(!preg_match('/[a-zA-Z0-9]{16}/',$token)){
      $token = $t->generate();
      $query = "UPDATE users2 SET token='$token' WHERE id='$id'";
      if(!$result = $db->query($query)){
        return "QUERY2_ERROR";
      }
      $db->close();
    }
    else {
      $db->close();
    }
    $t->sendMail($email,$token);
    return 'OK';
  }
}

if(!$_GET){
  leave();
}
else {
  if(!isset($_GET['u'])){
    leave();
  }
  if($_GET['u']==false || $_GET['u']==""){
    leave();
  }
  $login = secure_var($_GET['u']);

  if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{4,30}$/",$login)){
    leave();
  }
  $res = resend_mail();
  if($res=='OK'){
    $_SESSION['Vmsg']="RESEND_OK";
    header('Location: ./login.php');
    exit();
  }
  else {
    resend_fail($res);
  }
}
header('Location: ./login.php');
exit();



 ?>
