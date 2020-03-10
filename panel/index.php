<? session_start(); ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial scale=1" />
  <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
  <meta name="author" content="Michael Mlotowski" />
  <meta name="keywords" content="" />
  <title>Welcome | Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="stylesheet" type="text/css" href="./style-index.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
</head>

<body>

<?php include 'navbar.php'; ?>

  <script>
  $("#home").removeClass("text-light").addClass("text-info");
  </script>
  <main class="container-fluid bg-light" id="main-wrapper">
    <div class="jumbotron jumbotron-fluid text-center shadow-sm">
      <h1 class="text-bold">Admin Panel</h1>
      <h3>Created by <span class="text-info">Michael Mlotowski</span></h3>
      <p class="bigger-p">
        The best solution on the market. Start using now!
      </p>
      <div>
        <a role="button" href="register.php" class="btn btn-lg btn-info">Get me started!</a>
        <a role="button" href="whyus.php" class="btn btn-md btn-outline-info">More info</a>
      </div>
    </div>
    <section class="container-fluid bg-light">
      <div class="row section-row">
        <div class="col-md-3"></div>
        <div class="col-md-8">
            <h2 class="text-info">MultiFunctional</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor. Vivamus quam erat,
            auctor accumsan massa vitae, ultrices tristique erat.
          </p>
        </div>
        <div class="col-md-1"></div>
      </div>
      <div class="row section-row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <h2 class="text-info">Simple to use</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor. Vivamus quam erat,
            auctor accumsan massa vitae, ultrices tristique erat.
          </p>
        </div>
        <div class="col-md-3"></div>
      </div>
      <div class="row section-row">
        <div class="col-md-3"></div>
        <div class="col-md-8">
            <h2 class="text-info">Affordable</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor. Vivamus quam erat,
            auctor accumsan massa vitae, ultrices tristique erat.
          </p>
        </div>
        <div class="col-md-1"></div>
      </div>
    </section>
    <section class="container-fluid bg-gray section-space">
        <p class="huge-p text-center">
          Starting for <span class="font-weight-bold">Free</span>. Try now!
        </p>
        <div class="text-center">
            <a class="btn btn-lg btn-outline-info text-center" href="pricing.php">Learn more</a>
        </div>
      </section>
      <section class="container-fluid section-space" id="newsletter">

          <div class="rounded row newsletter-wrapper">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center newsletter-inside bg-gray rounded">
              <p class="larger-p text-center text-dark">
                Sign up for newsletter!
              </p>
              <form method="post" action="newsletter-submit.php" id="newsletter-submit">
                <input type="text" maxlength="64" name="email" id="email" placeholder="E-Mail" class="rounded-left email-input bg-light" />
                  <button type="button" onclick="newsletter()"class="btn-info email-button text-center rounded-right">Sign up</button>
              </form>
            </div>
            <div class="col-md-2"></div>
          </div>
    </section>
  </main>


<?php include 'footer.php'; ?>
</body>

<script>
  function errorM(){
    $('<p>').addClass('text-danger').addClass('text-center').addClass('nl-ms').text('Invalid E-Mail! Try again!').insertBefore('#newsletter-submit');
  }

  function newsletter(){
    const emailform= /^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/;
    var email = $("#email").val();

    $('.nl-ms').remove();

    if(email=="" || email==" " || email==false){
      errorM();
    }
    else if(email<6 || email>50){
      errorM();
    }
    else if(emailform.test(email)==false){
      errorM();
    }
    else{
      $('#newsletter-submit').submit();
    }
  }
<?php
if(isset($_SESSION['answer'])){
  echo $_SESSION['answer'];
  unset($_SESSION['answer']);
} ?>

</script>
</html>
