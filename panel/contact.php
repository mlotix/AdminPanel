<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial scale=1" />
  <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
  <meta name="author" content="Michael Mlotowski" />
  <meta name="keywords" content="" />
  <title>Contact | Admin Panel</title>
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

  <script>
  $("#contact").removeClass("text-light").addClass("text-info");
  </script>
  <script>
    function contactSuccess(response){
      $('<div>').addClass('alert').addClass('alert-dismissible').attr('id','contact-alert').attr('role','alert').insertBefore('#contact-name');
      var a = $('.alert-dismissible');
      a.append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>');

      if(response.answer=='SUCCESS'){
        a.append('Your message has been sent. Thank you!');
        a.addClass('alert-success');

        $('#contact-name').val("");
        $('#contact-email').val("");
        $('#contact-phone').val("");
        $('#message-form').val("");
        return;
      }
      else{
        if(response.answer=='EMPTYINPUT'){
          a.append('Missing data')
        }
        else if(response.answer=='SHORTNAME'){
          a.append('Name is too short - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='LONGNAME'){
          a.append('Name is too long - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='INVALIDNAME'){
          a.append('Name is invalid - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='SHORTEMAIL'){
          a.append('E-Mail is too short - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='LONGEMAIL'){
          a.append('E-Mail is too long - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='INVALIDEMAIL'){
          a.append('E-Mail is invalid - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='INVALIDPHONE'){
          a.append('Phone number is invalid - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='SHORTMSG'){
          a.append('Message is too short - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='LONGMSG'){
          a.append('Message is too long - Try again!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='NORULES'){
          a.append('You have to accept the rules!');
          a.addClass('alert-danger');
        }
        else if(response.answer=='SERVERERROR'){
          a.append('Server error occured - Try again later!');
          a.addClass('alert-warning');
        }
        else {
          a.append('Unknown error occured - Try again later!');
          a.addClass('alert-warning');
        }
      }
    }

    function contactError(id,msg){
      if(id!="#contact-checkbox"){
        $(id).addClass('border').addClass('border-danger');
      }
      $('<p>').addClass('text-center').addClass('text-danger').addClass('contact-error').text(msg).insertBefore(id);
    }
    function contactBorderRemove(){
      $(':focus').removeClass('border').removeClass('border-danger');
    }
    function contactErrorRemove(id){
      $(id).removeClass('border').removeClass('border-danger');
      if($(id).prev().hasClass('text-danger')){
        $(id).prev().remove();
      }
    }

    function contactSubmit(){
      $('#contact-button').attr('disabled',true);
      const nameform = /[a-zA-Z]{4,60}/;
      const emailform = /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/;
      const phoneform = /^[0-9\+\-]{9,15}$/;

      var name = $('#contact-name').val();
      var email = $('#contact-email').val();
      var phone = $('#contact-phone').val();
      var message = $('#message-form').val();
      var rules = $('#contact-checkbox').val();
      var i=0;

      contactErrorRemove('#contact-name');
      contactErrorRemove('#contact-email');
      contactErrorRemove('#contact-phone');
      contactErrorRemove('#message-form');
      contactErrorRemove('#contact-checkbox');

      if($('#contact-name').prev().hasClass('alert-dismissible')){
        $('#contact-name').prev().remove();
      }
      if(name=="" || name==" " || name===false){
        contactError('#contact-name',"Name is required. Try again!");
        i++;
      }
      if(email=="" || email==" " || email===false){
        contactError('#contact-email',"E-Mail is required. Try again!");
        i++;
      }
      if(message=="" || message==" " || message===false){
        contactError('#message-form',"Message is required. Try again!");
        i++;
      }
      if(phone=="" || phone==" " || phone===false){
        var phone="none";
      }
      if(rules!=="1"||rules!=1){
        contactError('#contact-checkbox',"You have to accept the rules!");
        i++;
      }

      if(i!=0){
        $('#contact-button').attr('disabled', false);
        return;
      }
      else {
        i=0;
      }

      if(nameform.test(name)==false){
        contactError('#contact-name',"Invalid name. Try again!");
        i++;
      }
      if(phone){
        if(phoneform.test(phone)==false  && phone!="none"){
          contactError('#contact-phone',"Invalid phone. Try again!");
          i++;
        }
      }
      if(emailform.test(email)==false){
        contactError('#contact-email',"Invalid E-mail. Try again!");
        i++;
      }
      if(email.length > 64){
        contactError('#contact-email',"E-Mail too long. Try again!");
        i++;
      }
      if(message.length <10){
        contactError('#contact-form',"Message too short. Try again!");
        i++;
      }
      else if(message.length >600){
        contactError('#contact-form',"Message too long. Try again!");
        i++;
      }

      if(i!==0){
        $('#contact-button').attr('disabled', false);
        return;
      }
      else {
        $.ajax({
          type:"post",
          url:"contact-submit.php",
          data:{
            name: name,
            email: email,
            phone: phone,
            message: message,
            rules: rules
          }
        })
        .done(function(response){
          var resp = response;
          console.log(resp);
          contactSuccess(resp);
        })
        .fail(function(xhr,errorCode){
          console.log(errorCode);
          console.log(xhr);
          contactSuccess();
        })
        .always(function(){
          $('#contact-button').attr('disabled', false);
        });
      }
    }


  </script>


  <main class="container-fluid bg-light" id="main-wrapper">

    <div class="page-title jumbotron shadow-sm">
      <h1 class="font-weight-bold text-center text-info">Contact</h1>
      <p class="text-center text-dark">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus.
      </p>
      <p class="bigger-p text-center text-dark">
        Have you got any questions? We can help you!
      </p>
    </div>

    <section class=" section-space">
      <div class="contact-row row container-fluid" id="msg">
        <div class="col-md-6 col-xl-5 text-center">
          <div class="text-center space bg-gray contact-form-wrapper">
            <form method="post">
              <i class="material-icons icon-big text-info">message</i><h2>Direct Message</h2>
            <input name="name" type="text" maxlength="30" placeholder="Name" class="rounded bg-light text-dark contact-input" id="contact-name" onfocus="contactBorderRemove()" required/>
            <input name="email" type="text" maxlength="60" placeholder="E-Mail" class="rounded bg-light text-dark contact-input" id="contact-email" onfocus="contactBorderRemove()" required/>
            <input name="phone" type="text" maxlength="11" placeholder="Phone Number (optional)" class="rounded bg-light text-dark contact-input" onfocus="contactBorderRemove()" id="contact-phone"/>
            <textarea name="message" maxlength="600" placeholder="Message" class="rounded bg-light text-dark contact-input" id="message-form" onfocus="contactBorderRemove()"></textarea>
            <label for="rules" class="contact-input text-left">
              <input name="rules" type="checkbox" value="1" class="" id="contact-checkbox" />
             I accept the privacy policy</label>
            <button type="button" class="btn btn-lg btn-info" onclick="contactSubmit()" id="contact-button">Send</button>
            </form>
          </div>
        </div class="space">
        <div class="col-md-6 col-xl-7 text-center">
          <div>
            <i class="material-icons icon-big text-info">phone_in_talk</i><h2>Phone</h2>
            <p class="larger-p text-dark font-weight-bold phone-number">
              123-456-5678
            </p>
            <p class="bigger-p">
              Monday-Friday: 8.00-20.00
            </p>
          </div>
          <div class="space">
            <i class="material-icons icon-big text-info">email</i><h2>E-Mail</h2>
            <p class="bigger-p text-dark font-weight-bold phone-number">
              <a href="mailto:business@michalmlotowski.com" class="text-dark">business@michalmlotowski.com</a>
            </p>
          </div>
          <div class="space">
            <i class="material-icons icon-big text-info">web</i><h2>Social Media</h2>
            <div class="space">
              <a href="https://facebook.com" target="_blank"><ion-icon name="logo-facebook" class="icon-huge text-secondary" id="fb"></ion-icon></a>
              <a href="https://twitter.com" target="_blank"><ion-icon name="logo-twitter" class="icon-huge text-secondary" id="tt"></ion-icon></a>
              <a href="https://linkedin.com" target="_blank"><ion-icon name="logo-linkedin" class="icon-huge text-secondary" id="li"></ion-icon></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php include 'footer.php'; ?>
</body>
</html>
