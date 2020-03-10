<?php
ob_start();
session_start();

function leave(){
  session_unset();
  session_destroy();
  header('Location: ./login.php');
  exit();
}
function verify_fail(){
  $_SESSION['Vmsg']='FAIL';
  header('Location: ./login.php');
  exit();
}
function secure_var($data){
  $data = strip_tags(trim($data));
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function verify(){

    $email = secure_var($_GET['u']);
    $token = secure_var($_GET['t']);

    if(!preg_match('/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/',$email)){
      return 'L';
    }
    if(!preg_match('/[a-zA-Z0-9]{16}/',$token)){
            echo '<html><script>console.log("2");</script></html>';
      return 'L';
    }

    $username;
    $database;
    $host;
    $dbpass;

    $db = new mysqli($host, $username, $dbpass, $database);
    if($db->connect_errno){
      $db->close();
      return "DATABASE_verify_fail_CONNECTION";
    }

    $db->real_escape_string($email);
    $db->real_escape_string($token);

    $query = "SELECT COUNT(*) FROM users2 WHERE email='$email' AND active=0 AND token='$token'";
    if(!$result = $db->query($query)){
      $db->close();
      return "QUERY_ERROR";
    }
    $row = $result->fetch_row();
    if($row[0] > 1){
      $db->close();
      return "QUERY_ROW_ERROR";
    }
    else if($row[0]==0){
      $db->close();
      return "L";
    }
    else if($row[0] == 1){
      $row = $result->fetch_row();
      $id = $row[0];
      $query = "UPDATE users2 SET active=1, token=NULL WHERE email='$email' AND token='$token'";
      if(!$result = $db->query($query)){
        $db->close();
        return "QUERY2_ERROR";
      }
      $db->close();
      return "OK";
    }
}


if(!$_GET){
  leave();
}
else {
  if(!isset($_GET['u']) || !isset($_GET['t'])){
    leave();
  }

  $ver = verify();

  if($ver=='L'){
    leave();
  }
  else if($ver=='OK'){
    $_SESSION['Vmsg']='OK';
    header('Location: ./login.php');
    exit();
  }
  else {
    verify_fail();
  }

}
$db->close();
$_SESSION['Vmsg']='FAIL';
header('Location: ./login.php');
exit();


 ?>
