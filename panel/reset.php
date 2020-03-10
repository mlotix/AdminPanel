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

if($_GET){

  if(!isset($_GET['u']) || !isset($_GET['t'])){
    leave();
  }
  $login = secure_var($_GET['u']);
  $token = secure_var($_GET['t']);

  if($_GET['u']==false || $_GET['t']==false){
    leave();
  }

  if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{2,30}$/",$login)){
    leave();
  }
  if(!preg_match("/[a-zA-Z0-9]{16}/",$token)){
    leave();
  }
  function verify(){
    global $login,$token;

    $username;
    $database;
    $host;
    $dbpass;

    $db = new mysqli($host,$username,$dbpass,$database);
    if($db->connect_errno){
      $db->close();
      return 'SERVER_ERROR';
    }
    $login = $db->real_escape_string($login);
    $token = $db->real_escape_string($token);

    $query = "SELECT COUNT(*), id FROM users2 WHERE username='$login' AND token='$token' AND active=1";
    if(!$result = $db->query($query)){
      $db->close();
      return 'SERVER_ERROR';
    }
    $row = $result->fetch_row();

    if($row[0]!=1){
      $db->close();
      return 'FAIL';
    }
    else{
      $_SESSION['id'] = $row[1];
      $query2 = "UPDATE users2 SET token=NULL WHERE username='$login' AND token='$token'";
      if(!$result = $db->query($query2)){
        $db->close();
        return 'SERVER_ERROR';
      }
      $db->close();
      return 'OK';
    }
  }
  $ver = verify();
  if($ver=='SERVER_ERROR'){
    leave();
  }
  else if($ver=='FAIL'){
    leave();
  }
  else if(!$ver=='OK'){
    leave();
  }
}

if($_POST){
  function change_pass(){
    if(!isset($_POST['pass1']) || !isset($_POST['pass2'])){
      return 'EMPTYINPUT';
    }
    $login = secure_var($_POST['pass1']);
    $email = secure_var($_POST['pass2']);
    $id = $_SESSION['id'];

    if($pass1==false || $pass1=="" || $pass1==" "){
      return 'EMPTYINPUT';
    }
    if($pass2==false || $pass2=="" || $pass2==" "){
      return 'EMPTYINPUT';
    }
    if($pass1>32 || $pass1<8){
      return 'INVALID';
    }
    if($pass1!=$pass2){
      return 'NOT_MATCH';
    }

    require "./addons/PasswordHash.php";

      $username = "michalmlhyroot";
      $database = "michalmlhyroot";
      $host = "michalmlhyroot.mysql.db";
      $dbpass = "Marcheeta1822dm1822";

      $db = new mysqli($host, $username, $dbpass, $database);
      if($db->connect_errno){
        $db->close();
        return "CONNECT_FAIL";
      }
      $pass1 = $db->real_escape_string($pass1);
      $pass2 = $db->real_escape_string($pass2);

      $query = "SELECT COUNT(*),password FROM users2 WHERE id='$id'";
      if(!$result = $db->query($query)){
        $db->close();
        return "SERVER_ERROR";
      }
      $row = $result->fetch_row();

      if($row[0]>1){
        $db->close();
        return 'SERVER_ERROR';
      }
      else if($row[0]==0){
        $db->close();
        return 'SERVER_ERROR';
      }

      $oldpass = $row[1];

      $salt = "M7EaWQMmzTGyy3RgCCpbcPCtCVvzHFmX";
      $pass = $salt . $pass1;
      $hasher = new PasswordHash(8,false);
      $check = $hasher->CheckPassword($pass, $hpass);

      if($check==true){
        $db->close();
        return 'SAME_PASS';
      }
      $pass = $hasher->HashPassword($pass);


      $query = "UPDATE users2 SET token=NULL, password='$pass' WHERE id='$id'";
      if(!$result = $db->query($query)){
        $db->close();
        return "SERVER_ERROR";
      }
      $db->close();
      unset($_SESSION['id']);
      return 'OK';
  }

  $response = verify();

  if($response=='CONNECT_FAIL'){
    $msg="display_alert('Database error. Try again later','orange');";
  }
  else if($response=='SERVER_ERROR'){
    $msg="display_alert('Unknown error. Try again later','orange');";
  }
  else if($response=='INVALID'){
    $msg="display_alert('Invalid passwords','red');";
  }
  else if($response=='EMPTYINPUT'){
    $msg="display_alert('Enter new password','red');";
  }
  else if($response=='NOT_MATCH'){
    $msg="display_alert('Passwords do not match','red');";
  }
  else if($response=='SAME_PASS'){
    $msg="display_alert('Password cannot be the same as previous','red');";
  }
  else if($response='OK'){                          //PRZENIESC DO PAGE LOGIN, DOKONCZYC TUTAJ
    $msg="display_alert('Your password has been reset','green');";
  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial scale=1" />
  <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
  <meta name="author" content="Michael Mlotowski" />
  <meta name="keywords" content="" />
  <title>Reset your password | Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="stylesheet" type="text/css" href="./style-index.css" />
  <link rel="stylesheet" type="text/css" href="./style-icons.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
</head>

<body>
  <main class="container-fluid bg-light" id="main-wrapper">

    <section class="row section-space">
      <div class="col-md-6 text-center">
        <div class="login-wrapper bg-gray rounded">
          <div>
            <h2 class="">Update your password</h2>
            <form action="forgot.php" method="post" id="login_form">
              <input name="pass1" type="password" maxlength="64" placeholder="new password" onfocus="clear_border()"class="rounded bg-light text-dark contact-input" id="pass1"/>
              <input name="pass2" type="password" maxlength="64" placeholder="repeat password" onfocus="clear_border()"class="rounded bg-light text-dark contact-input"id="pass2"/>
              <button type="button" onclick="reset_pass()"class="btn btn-lg btn-info">confirm</button>
            </form>
          </div>
          </div>
        </div>
      </div>
    </section>

  </main>
</body>
<script>
function clear_border(){
  $(':focus').removeClass('border').removeClass('border-danger');
}
function display_alert(msg,color){
  $('<div>').addClass('alert').addClass('js-alert').insertBefore('#pass1');
  if(color=='red'){
    $('.js-alert').addClass('alert-danger');
  }
  else if(color=='orange'){
    $('.js-alert').addClass('alert-warning');
  }
  else if(color=='green'){
    $('.js-alert').addClass('alert-success');
  }
  else {
    $('.js-alert').addClass('alert-danger');
  }
  $('<p>').addClass('js-alert-text').addClass('text-center').text(msg).prependTo('.js-alert');
}
function error_message(msg, color){
  $('#pass1').addClass('border').addClass('border-danger');
  $('#pass2').addClass('border').addClass('border-danger');
  display_alert(msg,color);
}

function forgot(){
  if($('#pass1').prev().hasClass('alert')){
    $('#pass1').prev().remove();
  }
  $('#pass1').removeClass('border').removeClass('border-danger');
  $('#pass2').removeClass('border').removeClass('border-danger');

  const invalid = "Invalid password";
  var pass1 = $('#pass1').val();
  var pass2 = $('#pass2').val();
  var i=0;

  if(pass1=="" || pass1==" " || pass1==false){
    $('#pass1').addClass('border').addClass('border-danger');
    i++;
  }
  if(pass2=="" || pass2==" " || pass2==false){
    $('#pass2').addClass('border').addClass('border-danger');
    i++;
  }
  if(i!==0){
    display_alert("Enter new password","red");
    return;
  }

  if(pass1>32 || pass1<8){
    error_message(invalid,"red");
    return;
  }
  else if(pass1!=pass2){
    error_message('Passwords do not match',"red");
    return;
  }
  else{
    $('#login_form').submit();
    return;
  }
  return;
}
<?php
if($msg){
  echo $msg;
}
 ?>
</script>
</html>
