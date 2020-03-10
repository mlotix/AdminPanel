<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial scale=1" />
  <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
  <meta name="author" content="Michael Mlotowski" />
  <meta name="keywords" content="" />
  <title>Pricing | Admin Panel</title>
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
  $("#pricing").removeClass("text-light").addClass("text-info");
  </script>

  <main class="container-fluid bg-light" id="main-wrapper">

    <div class="page-title jumbotron shadow-sm">
      <h1 class="font-weight-bold text-center text-info">Pricing</h1>
      <p class="text-center text-dark">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus.
      </p>
      <p class="bigger-p text-center text-dark">
        Choose the plan that's suitable for you
      </p>
    </div>

    <section class="row pricing-wrapper card-deck" id="offer">
      <div class="card text-center">
        <div class="card-header text-light bg-secondary">
          <h3>Free</h3>
          <h4>0.00$/mo</h4>
        </div>
        <div class="card-body bg-light text-dark">
          <ul>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
          </ul>
        </div>
        <div class="card-footer bg-dark text-light">
          <form method="get" action="register.php">
            <button type="submit" name="plan" class="btn btn-lg btn-info" value="free">Choose</button>
          </form>
        </div>
      </div>
      <div class="card text-center">
        <div class="card-header text-light bg-warning">
          <h3>Basic</h3>
          <h4>6.99$/mo</h4>
        </div>
        <div class="card-body bg-light text-dark">
          <ul>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
          </ul>
        </div>
        <div class="card-footer bg-dark text-light">
          <form method="get" action="register.php">
            <button type="submit" name="plan" class="btn btn-lg btn-info" value="basic">Choose</button>
          </form>
        </div>
      </div>
      <div class="card text-center">
        <div class="card-header text-light bg-success">
          <h3>Premium</h3>
          <h4>12.99$/mo</h4>
        </div>
        <div class="card-body bg-light text-dark">
          <ul>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
            <li>
              Lorem ipsum dolor sit amet
            </li>
          </ul>
        </div>
        <div class="card-footer bg-dark text-light">
          <form method="get" action="register.php">
            <button type="submit" name="plan" class="btn btn-lg btn-info" value="premium">Choose</button>
          </form>
        </div>
      </div>
    </section>

    <section class="bg-gray section-space">
      <div class="row pricing-wrapper">
        <div class="col-sm-6">
          <h2>Free</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
          </p>
          <a href="#offer" class="btn btn-lg btn-info pricing-button">Select</a>
          <form method="get" action="contact.php" class="pricing-form">
            <button name="plan" value="free" class="btn btn-md btn-outline-info pricing-button">Ask a question</button>
          </form>
        </div>
        <div class="col-sm-6">
          <h2>Basic</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
          </p>
          <a href="#offer" class="btn btn-lg btn-info pricing-button">Select</a>
          <form method="get" action="contact.php" class="pricing-form">
            <button name="plan" value="basic" class="btn btn-md btn-outline-info pricing-button">Ask a question</button>
          </form>
        </div>
      </div>
      <div class="row pricing-wrapper">
        <div class="col-sm-6">
          <h2>Premium</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
          </p>
          <a href="#offer" class="btn btn-lg btn-info pricing-button">Select</a>
          <form method="get" action="contact.php" class="pricing-form">
            <button name="plan" value="Premium" class="btn btn-md btn-outline-info pricing-button">Ask a question</button>
          </form>
        </div>
        <div class="col-sm-6">
          <h2>Individual</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin cursus tempus arcu nec tempus. Aliquam erat metus,
            gravida condimentum velit ultrices, iaculis consectetur eros. Curabitur volutpat, massa suscipit porttitor dictum,
            tortor ante cursus metus, vel sollicitudin est est eget arcu. Nam tempor dapibus est facilisis consequat.
            Suspendisse facilisis urna at magna mollis, vitae pulvinar tellus auctor.
          </p>
          <form method="get" action="contact.php" class="pricing-form">
            <button name="plan" value="invidual" class="btn btn-lg btn-info pricing-button">Contact us</button>
          </form>
        </div>
      </div>
    </section>

    <section class="section-space container-fluid">
      <p class="huge-p text-center">
        Got a <span class="font-weight-bold">question?</span> We can answer!
      </p>
      <div class="text-center">
          <a class="btn btn-lg btn-outline-info text-center" href="contact.php">Contact us now</a>
      </div>
    </section>



  </main>


<?php include 'footer.php'; ?>
</body>
</html>
