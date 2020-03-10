<?php
session_start();
ob_start();
if(isset($_SESSION['logged'])){
  header('Location: ./panel/index.php');
  exit();
}

if($_POST){
  function forgot(){
    if(!isset($_POST['login']) || !isset($_POST['email'])){
      return 'EMPTYINPUT';
    }
    function secure_var($data){
      $data = strip_tags(trim($data));
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $login = secure_var($_POST['login']);
    $email = secure_var($_POST['email']);

    require "./token.php";

    if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{4,30}$/",$login)){
      return 'L';
    }
    else if (!preg_match("/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/",$email)){
      return 'L';
    }
    else {
      $username;
      $database;
      $host;
      $dbpass;

      $db = new mysqli($host, $username, $dbpass, $database);
      if($db->connect_errno){
        $db->close();
        return "CONNECT_FAIL";
      }
      $db->real_escape_string($email);
      $db->real_escape_string($login);

      $query = "SELECT COUNT(*) FROM users2 WHERE username='$login' AND email='$email'";
      if(!$result = $db->query($query)){
        return "SERVER_ERROR";
      }
      $row = $result->fetch_row();

      if($row[0]>1){
        return 'SERVER_ERROR';
      }
      else if($row[0]==0){
        return 'L';
      }
      $query = "SELECT active FROM users2 WHERE username='$login' AND email='$email'";
      if(!$result = $db->query($query)){
        return "SERVER_ERROR";
      }
      $row = $result->fetch_row();
      if($row[0]==0){
        return 'NOT_ACTIVE';
      }
      $tok = new token;
      $token = $tok->generate();

      $query = "UPDATE users2 SET token='$token' WHERE username='$login' AND email='$email'";
      if(!$result = $db->query($query)){
        return "SERVER_ERROR";
      }

      $tok->sendPass($email,$token,$login);

      return 'OK';
    }
  }

  $response = forgot();

  if($response=='CONNECT_FAIL'){
    $msg="display_alert('Database error. Try again later','orange');";
  }
  else if($response=='SERVER_ERROR'){
    $msg="display_alert('Unknown error. Try again later','orange');";
  }
  else if($response=='NOT_ACTIVE'){
    $msg="display_alert('You have to activate your account before doing that.','red');";
  }
  else if($response=='L'){
    $msg="error_message('Invalid Credentials','red');";
  }
  else if($response='OK'){
    $msg="display_alert('Email with link to reset your password has been sent','green');";
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

<?php include 'navbar.php'; ?>

  <main class="container-fluid bg-light" id="main-wrapper">

    <section class="row section-space">
      <div class="col-md-6 text-center">
        <div class="login-wrapper bg-gray rounded">
          <div>
            <h2 class="">Reset your password</h2>
            <form action="forgot.php" method="post" id="login_form">
              <input name="login" type="text" maxlength="50" placeholder="username" onfocus="clear_border()"class="rounded bg-light text-dark contact-input" id="for-log"/>
              <input name="email" type="text" maxlength="64" placeholder="email" onfocus="clear_border()"class="rounded bg-light text-dark contact-input"id="for-email"/>
              <button type="button" onclick="forgot()"class="btn btn-lg btn-info">Reset</button>
            </form>
          </div>
          </div>
        </div>
      </div>
    </section>

  </main>


<?php include 'footer.php'; ?>
</body>
<script>
function clear_border(){
  $(':focus').removeClass('border').removeClass('border-danger');
}
function display_alert(msg,color){
  $('<div>').addClass('alert').addClass('js-alert').insertBefore('#for-log');
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
  $('#for-log').addClass('border').addClass('border-danger');
  $('#for-email').addClass('border').addClass('border-danger');
  display_alert(msg,color);
}

function forgot(){
  if($('#for-log').prev().hasClass('alert')){
    $('#for-log').prev().remove();
  }
  $('#for-log').removeClass('border').removeClass('border-danger');
  $('#for-email').removeClass('border').removeClass('border-danger');

  const nameform = /^[a-zA-Z][a-zA-Z0-9-_\.]{2,30}$/;
  const emailform = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/;
  const invalid = "Invalid credentials";
  var login = $('#for-log').val();
  var email = $('#for-email').val();
  var i=0;

  if(login=="" || login==" " || login==false){
    $('#for-log').addClass('border').addClass('border-danger');
    i++;
  }
  if(email=="" || email==" " || email==false){
    $('#for-email').addClass('border').addClass('border-danger');
    i++;
  }
  if(i!==0){
    display_alert("Enter username and email","red");
    return;
  }

  if(nameform.test(login)==false){
    error_message(invalid,"red");
    return;
  }
  else if(emailform.test(email)==false){
    error_message(invalid,"red");
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
