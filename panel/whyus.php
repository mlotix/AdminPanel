<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial scale=1" />
  <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
  <meta name="author" content="Michael Mlotowski" />
  <meta name="keywords" content="" />
  <title>Why Us | Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="stylesheet" type="text/css" href="./style-index.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
</head>

<body>

<?php include 'navbar.php'; ?>

  <script>
  $("#whyus").removeClass("text-light").addClass("text-info");
  </script>

  <main class="container-fluid bg-light" id="main-wrapper">

    <div class="page-title jumbotron shadow-sm">
      <h1 class="font-weight-bold text-center text-info">Why Us?</h1>
      <p class="text-center text-dark">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus.
      </p>
      <p class="bigger-p text-center text-dark">
        Learn more about our admin panel solution
      </p>
    </div>
    <section class="row section-space text-center whyus-wrapper">
      <div class="space col-md whyus-element">
        <h2>Simple</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
          gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
          tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
          Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
        </p>
      </div>
      <div class="space col-md whyus-element">
        <h2 class="text-info">Powerful</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
          gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
          tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
          Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
        </p>
      </div>
      <div class="space col-md whyus-element">
        <h2>Affordable</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
          gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
          tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
          Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
        </p>
      </div>
    </section>
    <section class="section-space bg-gray carousel slide" id="js-opinions">

      <ul class="carousel-indicators">
        <li class="item1 active"></li>
        <li class="item2"></li>
        <li class="item3"></li>
      </ul>

      <div class="carousel-inner text-center">
        <div class="carousel-item active">
          <blockquote class="blackquote">
            <p class="larger-p">
              The best on the market!
            </p>
            <div class="blackquote-footer text-info">
              - John Smith
            </div>
          </blockquote>
        </div>
        <div class="carousel-item">
          <blockquote class="blackquote">
            <p class="larger-p">
              So simple. So intuitive. So good!
            </p>
            <div class="blackquote-footer text-info">
              - Zuck Markenberg
            </div>
          </blockquote>
        </div>
        <div class="carousel-item">
          <blockquote class="blackquote">
            <p class="larger-p">
              I would recommend it for everyone!
            </p>
            <div class="blackquote-footer text-info">
              - CEO of Twotter
            </div>
          </blockquote>
        </div>
      </div>

      <a class="carousel-control-prev">
        <span class="carousel-control-prev-icon"></span>
      </a>

      <a class="carousel-control-next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </section>

    <section class="section-space whyus-wrapper">
      <div class="row space">
        <div class="col-sm-4 col-md-3 whyus-icon">
          <ion-icon name="lock" class="icon-giant text-dark"></ion-icon>
        </div>
        <div class="col-sm-8 col-md-9">
          <h2 class="text-info">Highly Secure</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor. Vivamus quam erat,
            auctor accumsan massa vitae, ultrices tristique erat.
          </p>
        </div>
      </div>
      <div class="row space">
        <div class="col-sm-4 col-md-3 whyus-icon">
          <ion-icon name="phone-landscape" class="icon-giant text-dark"></ion-icon>
        </div>
        <div class="col-sm-8 col-md-9">
          <h2 class="text-info">Mobile-friendly</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor. Vivamus quam erat,
            auctor accumsan massa vitae, ultrices tristique erat.
          </p>
        </div>
      </div>
      <div class="row space">
        <div class="col-sm-4 col-md-3 whyus-icon">
          <ion-icon name="cloud-done" class="icon-giant text-dark"></ion-icon>
        </div>
        <div class="col-sm-8 col-md-9">
          <h2 class="text-info">Always synced with cloud</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor. Vivamus quam erat,
            auctor accumsan massa vitae, ultrices tristique erat.
          </p>
        </div>
      </div>
    </section>
  </main>

  <script>
  $(document).ready(function(){
    $("#js-opinions").carousel({interval: 5000, pause: false});


    $(".item1").click(function(){
        $("#js-opinions").carousel(0);
    });
    $(".item2").click(function(){
        $("#js-opinions").carousel(1);
    });
    $(".item3").click(function(){
        $("#js-opinions").carousel(2);
    });


    $(".carousel-control-prev").click(function(){
        $("#js-opinions").carousel("prev");
    });
    $(".carousel-control-next").click(function(){
        $("#js-opinions").carousel("next");
    });
});

  </script>


<?php include 'footer.php'; ?>
</body>
</html>
