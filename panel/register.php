<?php
  if($_POST){
  function data_check(){
    global $login, $email, $email2, $pass, $pass2, $rules, $rules2, $newsletter, $plan;


    if($login==""||$login==" "|| $login==false){
      return 'EMPTY_LOGIN';
    }
    else if($email==""|| $email==" "|| $email==false){
      return 'EMPTY_EMAIL';
    }
    else if($email2==""|| $email2==" "|| $email==false){
      return 'EMPTY_EMAIL2';
    }
    else if($pass==" "|| $pass==""){
      return 'EMPTY_PASS';
    }
    else if($pass2==" " || $pass2==""){
      return 'EMPTY_PASS2';
    }
    else if($rules!="1" && $rules!=1){
      return 'NO_RULES';
    }
    else if($plan!="1" && $plan!="2" && $plan!="3"){
      return 'INVALID_PLAN';
    }
    else if($rules2!="1" && $rules2!=1){
      return 'NO_RULES2';
    }
    else {
      $login_length = mb_strlen($login,'UTF-8');
      $email_length = mb_strlen($email,'UTF-8');
      $pass_length = mb_strlen($pass,'UTF-8');

      if($newsletter!="1" && $newsletter!=1){
        $newsletter="none";
      }

      if($login_length<4){
        return 'SHORT_LOGIN';
      }
      else if($login_length>30){
        return 'LONG_LOGIN';
      }
      else if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{4,30}$/",$login)){
        return 'INVALID_LOGIN';
      }
      else if($email_length<5){
        return 'INVALID_EMAIL';
      }
      else if($email_length>64){
        return 'INVALID_EMAIL';
      }
      else if(!preg_match("/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/",$email)){
        return 'INVALID_EMAIL';
      }
      else if($email!=$email2){
        return 'EMAILS_DONT_MATCH';
      }
      else if($pass_length<8){
        return 'SHORT_PASS';
      }
      else if($pass_length>32){
        return 'LONG_PASS';
      }
      else if($pass!=$pass2){
        return 'PASS_DONT_MATCH';
      }
      else{
        return 'OK';
      }
    }
  }

  function register_user(){
    global $login, $email, $pass, $plan;

    $username;
    $database;
    $host;
    $dbpass;

    $db = new mysqli($host, $username, $dbpass, $database);

    if($db->connect_errno){
      return "SERVER_DOWN";
    }

    $db->real_escape_string($login);
    $db->real_escape_string($email);

    $query = "SELECT COUNT(*) FROM users2 WHERE username='$login'";   //CHECKS IF USERNAME EXISTS

    if(!$result = $db->query($query)){
      $db->close();
      return 'QUERY_ERROR';
    }
    if(!$row = $result->fetch_row()){
      $db->close();
      return 'INTERNAL_ERROR';
    }
    else{
      if($row[0]>0){
        $db->close();
        return 'USERNAME_EXISTS';
      }
    }

    $query2 = "SELECT COUNT(*) FROM users2 WHERE email='$email'";   //CHECKS IF EMAIL EXISTS

    if(!$result = $db->query($query2)){
      $db->close();
      return 'QUERY_ERROR';
    }
    if(!$row = $result->fetch_row()){
      $db->close();
      return 'INTERNAL_ERROR';
    }
    else{
      if($row[0]>0){
        $db->close();
        return 'EMAIL_EXISTS';
      }
    }

    require "./addons/PasswordHash.php";      //PASSWORD HASHER

    $salt = "M7EaWQMmzTGyy3RgCCpbcPCtCVvzHFmX";
    $pass = $salt . $pass;
    $hasher = new PasswordHash(8,false);
    $pass = $hasher->HashPassword($pass);

    require "./token.php";
    $t = new token;
    $token = $t->generate();

    $query3 = "INSERT INTO users2 (id, username, email, password, plan, token) VALUES (0,'$login','$email','$pass','$plan', '$token')";

    if(!$result = $db->query($query3)){
      $db->close();
      return 'QUERY_ERROR';
    }

    $count = $db->affected_rows;
      echo "<script>console.log('$newsletter');</script>";
    if($count <> 1){
      $db->close();
      return 'INTERNAL_ERROR';
    }
    else {
      echo "<script>console.log('$newsletter');</script>";
      if($newsletter=='1' ||$newsletter==1){
        echo 'ok1';                                         //SIGNING UP FOR NEWSLETTER
        $query4 = "SELECT COUNT(*) FROM newsletter WHERE email='$email'";
        if($result = $db->query($query4)){
          $rows = $result->fetch_row();
          if($rows[0]==0){
            echo 'ok2';
            $query5 = "INSERT INTO newsletter (id, email) VALUES (0, '$email')";
            $db->query($query5);
          }
        }
      }

      $db->close();
      $t->sendMail($email,$token);      //SENDING VERIFICATION MAIL
      return 'OK';
    }
    $db->close();
    return 'INTERNAL_ERROR';
  }

    if(!isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['email2'])
    || !isset($_POST['password']) || !isset($_POST['password2']) || !isset($_POST['rules'])
    || !isset($_POST['rules2']) || !isset($_POST['package'])){
      return 'EMPTYINPUT';
    }
          echo "<script>console.log('$newsletter');</script>";
    $login = $_POST['login'];
    $email = $_POST['email'];
    $email2 = $_POST['email2'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $plan = $_POST['package'];
    $rules = $_POST['rules'];
    $rules2 = $_POST['rules2'];
    $newsletter = $_POST['newsletter'];

    function secure_var($data){
      $data = strip_tags(trim($data));
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $login = secure_var($login);
    $email = secure_var($email);
    $email2 = secure_var($email2);
    $pass = secure_var($pass);
    $pass2 = secure_var($pass2);
    $plan = secure_var($plan);
    $rules = secure_var($rules);
    $rules2 = secure_var($rules2);
    $newsletter = secure_var($newsletter);

    $check = data_check();

    if($check!='OK'){
      $response = $check;
    }
    else {
      $response = register_user();
    }
  }

if($_GET){
  if($_GET['plan']=="free"){
    $package="free";
  }
  else if($_GET['plan']=="basic"){
    $package="basic";
  }
  else if($_GET['plan']=="premium"){
    $package="premium";
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
  <title>Register | Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="stylesheet" type="text/css" href="./style-index.css" />
  <link rel="stylesheet" type="text/css" href="./style-icons.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
</head>
<script>
<?

?>

</script>
<body>

<?php include 'navbar.php'; ?>


<main class="container-fluid">
  <section class="row section-space register-wrapper">
    <div class="col bg-gray spaceS text-center rounded" id="js-upper-bar">
      <div class="progress bg-white">
        <div class="progress-bar progress-bar-striped progress-bar-animated w-33 bg-info" id="js-progress-up"></div>
      </div>
      <h2 id="js-title">Enter your data</h2>
    </div>
  </section>

  <section class="row register-wrapper2 current" id='js-page1'>

    <div class="col register-form bg-gray text-center rounded">
      <form method="post" action="register.php">
        <h2>Register</h2>
        <input name="login" id="reg-login" type="text" maxlength="30" placeholder="Nickname" class="rounded bg-light text-dark contact-input" onfocus="clear_border()"/>
        <input name="email" id="reg-email" type="text" maxlength="64" placeholder="Email" class="rounded bg-light text-dark contact-input"onfocus="clear_border()"/>
        <input name="email2" id="reg-email2" type="text" maxlength="64" placeholder="Repeat email" class="rounded bg-light text-dark contact-input"onfocus="clear_border()"/>
        <input name="password" id="reg-pass" type="password" maxlength="30" placeholder="Password" class="rounded bg-light text-dark contact-input"onfocus="clear_border()"/>
        <input name="password2" id="reg-pass2" type="password" maxlength="30" placeholder="Repeat password" class="rounded bg-light text-dark contact-input"onfocus="clear_border()"/>
        <div class="form-check">
          <label for="rules" class="contact-input text-left form-check-label">
            <input name="rules" id="reg-rules" type="checkbox" value="1" class="form-check-input" />
           I accept the privacy policy & Terms of Use</label>
        </div>
         <button type="button" id="confirm-page1"class="btn btn-lg btn-info" onclick="reg_next()">Continue</button>
    </div>
  </section>

  <section class="register-wrapper2 d-none justify-content-center" id="js-page2">
      <div class="card-deck bg-gray col space rounded" id="reg-cards">
        <input type="number" maxlength="1" name="package" class="d-none js-hide" id="reg-pack" />
        <div class="card text-center" id="card-free">
          <div class="card-header text-light bg-secondary">
            <h3>Free</h3>
            <h4>0.00$/mo</h4>
          </div>
          <div class="card-body bg-light text-dark">
            <ul>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
            </ul>
          </div>
          <div class="card-footer bg-dark text-light">
              <button type="button" class="btn btn-lg btn-info" onclick="package_select('free')">Select</button>
          </div>
        </div>
        <div class="card text-center" id="card-basic">
          <div class="card-header text-light bg-warning">
            <h3>Basic</h3>
            <h4>6.99$/mo</h4>
          </div>
          <div class="card-body bg-light text-dark">
            <ul>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
            </ul>
          </div>
          <div class="card-footer bg-dark text-light">
              <button type="button" class="btn btn-lg btn-info" onclick="package_select('basic')">Select</button>
          </div>
        </div>
        <div class="card text-center" id="card-premium">
          <div class="card-header text-light bg-success">
            <h3>Premium</h3>
            <h4>12.99$/mo</h4>
          </div>
          <div class="card-body bg-light text-dark">
            <ul>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
              <li>Lorem ipsum dolor sit amet</li>
            </ul>
          </div>
          <div class="card-footer bg-dark text-light">
              <button type="button" class="btn btn-lg btn-info" onclick="package_select('premium')">Select</button>
          </div>
        </div>
      </div>
      <div class="form-group bg-gray space reg-margin-up rounded">
        <div class="form-check">
          <label for="rules2" class="contact-input text-left form-check-label">
            <input name="rules2" id="reg-rules2" type="checkbox" value="1"class="form-check-input" />
           I accept the privacy policy & Terms of Use & bla bla bla bla bla bla bla bla bla*</label>
        </div>
        <div class="form-check">
          <label for="newsletter" class="contact-input text-left form-check-label">
            <input name="newsletter" id="reg-newsletter" type="checkbox" value="1" class="form-check-input" checked/>
           I want to sign up for the newsletter and regularly get new offers from our company</label>
        </div>
        <div class="text-center">
          <button type="button" id="confirm-page2"class="btn btn-lg btn-info" onclick="reg_next()">Register</button>
        </div>
      </div>

  </section>

  <section class="row section-space register-wrapper2" id="js-bottom-bar">
    <div class="col bg-gray spaceS text-center rounded">
      <div>
        <button type="button" id="reg-prev" onclick="reg_prev()"class="btn btn-md btn-info justify-content-center invisible">&lt return</button>
        <button type="button" id="reg-next" onclick="reg_next()"class="btn btn-md btn-info btn-justify-content-center">continue &gt</button>
      </div>
      <div class="progress bg-white">
        <div class="progress-bar progress-bar-striped progress-bar-animated w-33 bg-info"id="js-progress-down"></div>
      </div>
    </div>
  </section>
      </form>
</main>

<script>
function package_select(pack){
  function select(pack){
    pack = $(pack);
    pack.removeClass('reg-card-sm').addClass('reg-card-lg').addClass('shadow-lg');
    pack.find('button').removeClass('btn-info').addClass('btn-success');
    pack.find('.card-header').removeClass('bg-secondary').removeClass('bg-warning').addClass('bg-success');
    pack.find('.card-footer').removeClass('bg-secondary').addClass('bg-dark');
  }
  function blackout(pack){
    pack = $(pack);
    pack.removeClass('reg-card-lg').removeClass('shadow-lg').addClass('reg-card-sm');
    pack.find('button').removeClass('btn-success').addClass('btn-info');
    pack.find('.card-footer').removeClass('bg-dark').addClass('bg-secondary');
    pack.find('.card-header').removeClass('bg-success').removeClass('bg-warning').addClass('bg-secondary');
  }

  $('#card-free').removeClass('border').removeClass('border-danger');
  $('#card-basic').removeClass('border').removeClass('border-danger');
  $('#card-basic').removeClass('border').removeClass('border-danger');

  if(pack=='free'){
    select("#card-free");
    blackout("#card-premium");
    blackout("#card-basic");
    $('#reg-pack').val('1');
    return;
  }
  else if(pack=='basic'){
    select("#card-basic");
    blackout("#card-premium");
    blackout("#card-free");
    $('#reg-pack').val('2');
    return;
  }
  else if(pack=='premium'){
    select("#card-premium");
    blackout("#card-free");
    blackout("#card-basic");
    $('#reg-pack').val('3');
    return;
  }
}
function package_unselect(){
  function unselect(p){
    p.removeClass('reg-card-lg').removeClass('reg-card-sm').removeClass('shadow-lg');
    p.find('button').removeClass('btn-success').addClass('btn-info');
    p.find('.card-footer').removeClass('bg-secondary').addClass('bg-dark');
    p.find('.card-header').removeClass('bg-secondary');
  }
  var p1 = $('#card-free');
  var p2 = $('#card-basic');
  var p3 = $('#card-premium');

  unselect(p1);
  unselect(p2);
  unselect(p3);

  p1.find('.card-header').addClass('bg-secondary');
  p2.find('.card-header').addClass('bg-warning');
  p3.find('.card-header').addClass('bg-success');
}

<? if($package){
  echo 'package_select("'.$package.'");';
}
?>



function data_check_error(id,msg){
  if(id!='#reg-rules' && id!='#reg-rules2'){
    $(id).addClass('border').addClass('border-danger');
  }
  $('<p>').addClass('text-center').addClass('text-danger').addClass('contact-error').text(msg).insertBefore(id);
}
function clear_border(){
  $(':focus').removeClass('border').removeClass('border-danger');
}
function clear_error(id){
  $(id).removeClass('border').removeClass('border-danger');
  if($(id).prev().hasClass('text-danger')){
    $(id).prev().remove();
  }
}
function reg_data_check(){
  const nameform = /^[a-zA-Z][a-zA-Z0-9-_\.]{2,30}$/;
  const emailform = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/;

  clear_error('#reg-login');
  clear_error('#reg-email');
  clear_error('#reg-email2');
  clear_error('#reg-pass');
  clear_error('#reg-pass2');
  clear_error('#reg-rules');

  if($('#reg-login').prev().hasClass('alert-dismissible')){
    $('#reg-login').prev().remove();
  }

  var login = $("#reg-login").val();
  var email = $("#reg-email").val();
  var email2 = $('#reg-email2').val();
  var pass = $('#reg-pass').val();
  var pass2 = $('#reg-pass2').val();
  var rules = $('#reg-rules').val();
  var i=0;

  if(login==" "|| login==""|| login==false){
    data_check_error('#reg-login','Enter your nickname');
    i++;
  }
  if(email==" "|| email==""|| email==false){
    data_check_error('#reg-email','Enter your email');
    i++;
  }
  if(email2==" "|| email2==""|| email2==false){
    data_check_error('#reg-email2','Repeat your email');
    i++;
  }
  if(pass==" "|| pass==""|| pass==false){
    data_check_error('#reg-pass','Enter your password');
    i++;
  }
  if(pass2==" "|| pass2==""|| pass2==false){
    data_check_error('#reg-pass2','Repeat your password');
    i++;
  }
  if(rules!=="1"){
    data_check_error('#reg-rules','You have to accept the rules');
    i++;
  }
  if(i!==0){
    return false;  //ZMIENIONE UWAGA - POWINNO BYC FALSE
  }


  if(login<4){
    data_check_error('#reg-login','Nickname should be min 4 characters long');
    i++;
  }
  else if(login>30){
    data_check_error('#reg-login','Nickname should be max 30 characters long');
    i++
  }
  else if(nameform.test(login)==false){
    data_check_error('#reg-login','Nickname contains invalid characters');
    i++;
  }
  if(emailform.test(email)==false){
    data_check_error('#reg-email','Email is invalid');
    i++;
  }
  if(pass<8){
    data_check_error('#reg-pass','Password should be min 8 characters long');
    i++;
  }
  else if(pass>32){
    data_check_error('#reg-pass','Password should be max 32 characters long');
    i++;
  }
  if(i!==0){
    return false;
  }


  if(pass!==pass2){
    data_check_error('#reg-pass2','Passwords do not match');
    i++;
  }
  if(email!==email2){
    data_check_error('#reg-email2','Emails do not match');
    i++;
  }
  if(i!==0){
    return false;
  }
  return true;
}
function reg_pack_check(){
  var pack = $('#reg-pack').val();
  var rules2 = $('#reg-rules2').val();
  var newsletter = $('#reg-newsletter').val();
  var i=0;

  $('#card-free').removeClass('border').removeClass('border-danger');
  $('#card-basic').removeClass('border').removeClass('border-danger');
  $('#card-basic').removeClass('border').removeClass('border-danger');
  clear_error('#reg-rules2');

  if(pack!=='1' && pack!=='2' && pack!=='3'){
    package_unselect();
    $('#card-free').addClass('border').addClass('border-danger');
    $('#card-basic').addClass('border').addClass('border-danger');
    $('#card-premium').addClass('border').addClass('border-danger');
    $('<p>').addClass('text-danger').html("You have to select the package").insertBefore('#reg-cards');
    i++;
    $('#reg-pack').val(" ");
  }
  else if($('#reg-rules2').is(':checked')==false){
    data_check_error('#reg-rules2','You have to accept the rules');
    i++;
  }
  else if($('#reg-newsletter').is(':checked')==false){
    $('#reg-newsletter').val("0");
  }
  else if($('#reg-newsletter').is(':checked')){
    $('#reg-newsletter').val("1");
  }
  if(i!==0){
    return false;
  }
  console.log(newsletter);
  return true;
}
function reg_prev(){
  $('#reg-next').attr('disabled', true);
  $('#confirm-page1').attr('disabled',true);
  $('#reg-prev').attr('disabled', true);
  $('#confirm-page2').attr('disabled',true);

  var page1 = $('#js-page1');
  var page2 = $('#js-page2');
  var bar1 = $('#js-progress-up');
  var bar2 = $('#js-progress-down');

  if($('#reg-cards').prev().hasClass('alert-dismissible')||$('#reg-cards').prev().hasClass('text-danger')){
    $('#reg-cards').prev().remove();
  }
  $('#card-free').removeClass('border').removeClass('border-danger');
  $('#card-basic').removeClass('border').removeClass('border-danger');
  $('#card-basic').removeClass('border').removeClass('border-danger');
  clear_error('#reg-rules2');

  $('#reg-rules2').prop("checked",false);
  $('#reg-newsletter').prop("checked",true);
  $('#reg-pass').val('');
  $('#reg-pass2').val('');
  $('#reg-rules').prop('checked',false);

  page2.removeClass('current').addClass('d-none');    //GOES TO THE 1ND SECTION
  page1.removeClass('d-none').addClass('current');
  $('#js-title').text('Enter your data');
  bar1.removeClass('w-66').addClass('w-33');
  bar2.removeClass('w-66').addClass('w-33');
  $('#reg-prev').addClass('invisible');
  $('#reg-next').html('continue &gt');

  $('html, body').animate({
    scrollTop: $("main").offset().top }, 500);

  $('#reg-next').attr('disabled', false);
  $('#confirm-page1').attr('disabled',false);
  $('#reg-prev').attr('disabled', false);
  $('#confirm-page2').attr('disabled',false);
}

function reg_next(){
  $('#reg-next').attr('disabled', true);
  $('#reg-prev').attr('disabled', true);

  if($('#reg-cards').prev().hasClass('alert-dismissible')||$('#reg-cards').prev().hasClass('text-danger')){
    $('#reg-cards').prev().remove();
  }
  if($('#reg-login').prev().hasClass('alert-dismissible')){
    $('#reg-login').prev().remove();
  }

  var page1 = $('#js-page1');
  var page2 = $('#js-page2');
  var bar1 = $('#js-progress-up');
  var bar2 = $('#js-progress-down');

  if(page1.hasClass('current')){        //CHECK IF 1ST PAGE IS OPEN OR NOT
    $('#confirm-page1').attr('disabled',true);

    if(reg_data_check()==false){              //CHECK IF DATA SUBMITTED IS VALID
      $('#reg-next').attr('disabled', false);
      $('#confirm-page1').attr('disabled',false);
      $('#reg-prev').attr('disabled', false);
      $('html, body').animate({
        scrollTop: $("main").offset().top }, 500);
      return;
    }
    else{
      page1.removeClass('current').addClass('d-none');    //GOES TO THE 2ND SECTION
      page2.removeClass('d-none').addClass('current');
      $('#js-title').text('Select your package');
      $('#reg-prev').removeClass('invisible');
      bar1.removeClass('w-33').addClass('w-66');
      bar2.removeClass('w-33').addClass('w-66');
      $('#reg-next').html('register &gt');
      $('#reg-next').attr('disabled', false);
      $('#reg-prev').attr('disabled', false);
      $('#confirm-page1').attr('disabled',false);
      $('html, body').animate({
        scrollTop: $("main").offset().top }, 500);
    }

  }
  else if(page2.hasClass('current')){       //CHECK IF PAGE 2 IS OPEN OR NOT
    $('#confirm-page2').attr('disabled',true);

    if(reg_pack_check()==false){          //CHECK DATA SUBMITTED IN 2ND SECTION
      $('#reg-next').attr('disabled', false);
      $('#confirm-page2').attr('disabled',false);
      $('#reg-prev').attr('disabled', false);
      $('html, body').animate({
        scrollTop: $("main").offset().top }, 500);
      return;
    }
    else if(reg_data_check()==false){   // IF DATA IN 1ST SECTION ISN'T VALID, RETURN TO 1ST PAGE
      reg_prev();
      return;
    }
    else {        //DATA IS VALID - SUBMITS FORM
      console.log('success');
      $('#reg-next').attr('disabled', false);
      $('#confirm-page2').attr('disabled',false);
      $('#reg-prev').attr('disabled', false);
      $('form').submit();
      return; //FUNCTION SUBMIT TUTAJ
    }
  }
}
function error_alert(r){
  if(r=='OK'){
    return;
  }
  else{
    $('<div>').addClass('alert').addClass('alert-dismissible').addClass('js-alert').appendTo('#js-upper-bar')
    .append('<button type="button" class="close" data-dismiss="alert">&times;</button>');
    $('<p>').addClass('text-center').addClass('js-alert-text').prependTo('.js-alert');
    var p = $('.js-alert-text');
    var a = $('.js-alert');
    if(r==false){
      p.text('Unknown error has occured. Try again later');
      a.addClass('alert-warning');
      return;
    }
    else if(r=='QUERY_ERROR'){
      p.text('Database error has occured. Contact admin');
      a.addClass('alert-warning');
      return;
    }
    else if(r=='INTERNAL_ERROR'){
      p.text('Internal server error. Try again');
      a.addClass('alert-warning');
      return;
    }
    else if (r=='INVALID_PLAN'){
      p.text('You have to select the package!');
      a.addClass('alert-danger');
      return;
    }
    else if(r=='NO_RULES' || r=='NO_RULES2'){
      p.text('You have to accept the rules');
      a.addClass('alert-danger');
      return;
    }
    else if(r=='SERVER_DOWN'){
      p.text('Server is down. Try again later');
      a.addClass('alert-warning');
      return;
    }
    else {
      p.text('Invalid credentials. Try again');
        a.addClass('alert-danger');
    }
  }
}
function registered(r){
  if(r=='OK'){
    $('#js-page1').addClass('d-none');
    $('#js-page2').addClass('d-none');
    $('#js-bottom-bar').addClass('d-none');
    $('#js-title').text("Thank you!");
    $('#js-progress-up').removeClass('w-33').removeClass('bg-info')
    .addClass('bg-success').addClass('w-100');

    $('<div>').addClass('alert').addClass('alert-success').addClass('js-alert').appendTo('#js-upper-bar');
    $('<p>').addClass('text-center').addClass('js-alert-text').addClass('bigger-p')
    .html("You've been registered successfuly!")
    .appendTo('.js-alert');
    $('<p>').addClass('text-center').addClass('js-alert-text')
    .html('<strong>Check your email</strong> and click the link in the message to activate your account. No message? <a href="./resend.php?u=<?echo $login;?>" class="btn-link banner-link">Click here to resend</a>')
    .appendTo('.js-alert');

  }
  else {
    <? if($login){
        echo "$('#reg-login').val('" . $login . "');";
      }
      if($email){
        echo "$('#reg-email').val('" . $email . "');";
      }
      if($plan){
        if($plan=='1'){ $plan='free';}
        if($plan=='2'){ $plan='basic';}
        if($plan=='3'){ $plan='premium';}
        echo "package_select('" . $plan . "');";
      }
    ?>
    if(r=='EMPTY_LOGIN'){
      data_check_error('#reg-login','Enter your nickname');
    }
    else if(r=='EMPTY_EMAIL'){
      data_check_error('#reg-email','Enter your email');
    }
    else if(r=='EMPTY_EMAIL2'){
      data_check_error('#reg-email2','Repeat your email');
    }
    else if(r=='EMPTY_PASS'){
      data_check_error('#reg-pass','Enter your password');
    }
    else if(r=='EMPTY_PASS2'){
      data_check_error('#reg-pass2','Repeat your password');
    }
    else if(r=='NO_RULES'){
      data_check_error('#reg-rules','You have to accept the rules');
    }
    else if(r=='NO_RULES2'){
      data_check_error('#reg-rules2','You have to accept the rules');
    }
    else if(r=='INVALID_PLAN'){
      $('#card-free').addClass('border').addClass('border-danger');
      $('#card-basic').addClass('border').addClass('border-danger');
      $('#card-premium').addClass('border').addClass('border-danger');
      $('<p>').addClass('text-danger').html("You have to select the package").insertBefore('#reg-cards');
      $('#reg-pack').val(" ");
    }
    else if(r=='SHORT_LOGIN'){
      data_check_error('#reg-login','Nickname should be min 4 characters long');
    }
    else if(r=='LONG_LOGIN'){
      data_check_error('#reg-login','Nickname should be max 30 characters long');
    }
    else if(r=='INVALID_LOGIN'){
      data_check_error('#reg-login','Nickname contains invalid characters');
    }
    else if(r=='INVALID_EMAIL'){
      data_check_error('#reg-email','Email is invalid');
    }
    else if(r=='EMAILS_DONT_MATCH'){
      data_check_error('#reg-email2','Emails do not match');
    }
    else if(r=='SHORT_PASS'){
      data_check_error('#reg-pass','Password should be min 8 characters long');
    }
    else if(r=='LONG_PASS'){
      data_check_error('#reg-pass','Password should be max 32 characters long');
    }
    else if(r=="PASS_DONT_MATCH"){
      data_check_error('#reg-pass','Passwords do not match');
    }
    else if(r=='USERNAME_EXISTS'){
      data_check_error('#reg-login','Nickname is already taken');
    }
    else if(r=='EMAIL_EXISTS'){
      data_check_error('#reg-email','Email is already used');
    }
    error_alert(r);
  }
}
<?
  if($response){
   echo 'registered("' . $response . '");';
  }
?>
</script>

<?php include 'footer.php'; ?>
</body>
</html>
