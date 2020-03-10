<?php
session_start();
if(isset($_SESSION['logged'])){
  header('Location: ./panel/index.php');
  exit();
}
  if(isset($_GET['logout'])){
    $msg = 'display_alert("Youve been successfully logged out!", "green");'; //&#10076
  }
if(isset($_SESSION['Vmsg'])){
  if($_SESSION['Vmsg']=='FAIL'){
    $msg = 'display_alert("Verification failed. Try again", "red");';
  }
  else if($_SESSION['Vmsg']=='OK'){
    $msg = 'display_alert("Verification successful. You can now log in","green");';
  }
  else if($_SESSION['Vmsg']=='RESEND_OK'){
    $msg = 'display_alert("Message has been resent. Check your mail","green");';
  }
  else if($_SESSION['Vmsg']=='RESEND_FAIL'){
    $msg = 'display_alert("Email cannot be sent. Try again", "red");';
  }
  else {
    $sess = $_SESSION['Vmsg'];
    $msg = "display_alert('$sess', 'red');";
  }
  unset($_SESSION['Vmsg']);
}

if($_POST){
  if(!isset($_POST['login']) || !isset($_POST['pass'])){    //sprawdzenie czy istnieje login i haslo
    return 'EMPTYINPUT';
  }
  function secure_var($data){                 //zabezpieczenie zmiennych przed wprowadzeniem kodu
    $data = strip_tags(trim($data));
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $login = secure_var($_POST['login']);
  $pass = secure_var($_POST['pass']);

  function login(){               //logowanie
    global $login, $pass;
    require './addons/PasswordHash.php';      //wymagany plik haszujacy hasla

    $login_length = mb_strlen($login, 'UTF-8');         //pobranie dlugosci zmiennych
    $pass_length = mb_strlen($pass, 'UTF-8');

    if($login==" "||$login=="" || $pass==" "||$pass==""){       //ponowne sprawdzenie czy zmienne nie sa puste
      return 'EMPTYINPUT';
    }
    else if($login_length<4 || $login_length>30){           //sprawdzenie czy maja odpowiednia ilosc znakow
      return 'INVALID';
    }
    else if($pass_length<8 || $pass_length>32){
      return 'INVALID';
    }
    else if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{2,30}$/",$login)){     //sprawdzzenie czy zawieraja dozwolone znaki
      return 'INVALID';
    }
    else{
      $username;         //dane do bazy danych
      $database;
      $host;
      $dbpass;

      $db = new mysqli($host,$username,$dbpass,$database);          //polaczenie z mysql
      if($db->connect_errno){         //sprawdzenie czy nie ma bledu laczenia
        $db->close();
        return 'SERVER_DOWN';
      }
      $login = $db->real_escape_string($login);       //zabezpieczenie zmiennych dla mysql
      $pass = $db->real_escape_string($pass);

      $query = "SELECT username,password,active,id FROM users2 WHERE username='$login'";     //pobranie loginu i hasla z DB
      if(!$result = $db->query($query)){        //wyslanie komendy do DB
        $db->close();
        return 'QUERY_ERROR';
      }
      $row = $db->num_rows;       //sprawdzenie czy nie ma wiecej niz jednego rekordu
      if($row>1){
        $db->close();
        return 'QUERY_ERROR';
      }
      $row = $result->fetch_row();    //przetworzenie wyniku z DB do tabeli php
      $db->close();

      if($login!=$row[0]){      //sprawdzenie czy login jest poprawny
        return 'INVALID';
      }
      $hpass = $row[1];       //przypisanie hasla
      $active = $row[2];      //sprawdzenie czy konto jest aktywne
      $id = $row[3];          //przypisanie id

      $salt = "M7EaWQMmzTGyy3RgCCpbcPCtCVvzHFmX";       //haszowanie hasla podanego przez uzytkownika
      $pass = $salt . $pass;
      $hasher = new PasswordHash(8,false);
      $check = $hasher->CheckPassword($pass, $hpass);     //sprawdzenie czy haszowane hasla sie zgadzaja

      if($check==false){
        return 'INVALID';
      }
      if($active==0){       //jezeli dane sa dobre, sprawdzenie czy konto aktywne
        return 'NOT_ACTIVE';
      }

      $_SESSION['logged']= $login;          //logowanie, jezeli wszystko jest ok
      $_SESSION['id']= $id;
      header('Location: ./panel/index.php');
      exit();

    }
  }
  $response = login();          //wywolanie funkcji logujacej

  if($response=="EMPTYINPUT"){
    $response="error_message('Enter username and password','red');";
  }
  else if($response=="INVALID"){
    $response="error_message('Invalid username or password','red');
    $('#log-log').val('$login');";
  }
  else if($response=="SERVER_DOWN"){
    $response="display_alert('Server is currently down, try again later','orange');";
  }
  else if($response=="QUERY_ERROR"){
    $response="display_alert('Database error. Try again later','orange');";
  }
  else if($response=="NOT_ACTIVE"){
    $response="display_alert('Account is not active. Confirm your email to log in.','orange');
              $('<a>').addClass('banner-log-link').attr('href','./resend?u=$login').text('Click here to resend').appendTo('.js-alert');";
  }
  else {
    $response="display_alert('Unknown error occured. try again','orange');";
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
  <title>Log in | Admin Panel</title>
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
            <h2 class="">Log in</h2>
            <form action="login.php" method="post" id="login_form">
              <input name="login" type="text" maxlength="50" placeholder="Login" onfocus="clear_border()"class="rounded bg-light text-dark contact-input" id="log-log"/>
              <input name="pass" type="password" maxlength="64" placeholder="Password" onfocus="clear_border()"class="rounded bg-light text-dark contact-input"id="log-pass"/>
              <label for="remember" class="contact-input text-left">
                <input name="remember" type="checkbox" value="1" class="" id="contact-checkbox" />
               Remember me</label>
              <button type="button" onclick="log_in()"class="btn btn-lg btn-info">Log in</button>
            </form>
          </div>
          <div class="login-addon">
              <a href="forgot.php" class="btn btn-link btn-sm text-dark">I forgot my password</a>
              <div>
                <a href="register.php" class="btn btn-link btn-sm text-dark">I'm a new user</a>
              </div>
          </div>
        </div>
      </div>
    </section>

  </main>


<?php include 'footer.php'; ?>
</body>
<script>
function clear_border(){                    //czysci inputy po klikniecu na nie
  $(':focus').removeClass('border').removeClass('border-danger');
}
function display_alert(msg,color){        //wyswirtla wiadomosc po nieudanym logowaniu
  $('<div>').addClass('alert').addClass('js-alert').insertBefore('#log-log');
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
  $('#log-log').addClass('border').addClass('border-danger');
  $('#log-pass').addClass('border').addClass('border-danger');
  display_alert(msg,color);
}

function log_in(){        //sprawdzanie poprawnosci przed wyslaniem formy do php
  if($('#log-log').prev().hasClass('alert')){
    $('#log-log').prev().remove();
  }
  $('#log-log').removeClass('border').removeClass('border-danger');
  $('#log-pass').removeClass('border').removeClass('border-danger');

  const nameform = /^[a-zA-Z][a-zA-Z0-9-_\.]{2,30}$/;
  const invalid = "Wrong username or password";
  var login = $('#log-log').val();
  var pass = $('#log-pass').val();
  var i=0;

  if(login=="" || login==" " || login==false){
    $('#log-log').addClass('border').addClass('border-danger');
    i++;
  }
  if(pass=="" || pass==" " || pass==false){
    $('#log-pass').addClass('border').addClass('border-danger');
    i++;
  }
  if(i!==0){
    display_alert("Enter username and password","red");
    return;
  }

  if(nameform.test(login)==false){
    error_message(invalid,"red");
    return;
  }
  else if(pass>32 || pass<8){
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
if($response){
  echo $response;
}
 ?>
</script>
</html>
