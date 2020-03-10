<?php
session_start();
$_SESSION['logged']="xawess";
if(!isset($_SESSION['logged'])){
	session_destroy();
	header('Location: ../login.php');
	exit();
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
  <title>Home | Admin Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" type="text/css" href="../style.css" />
  <link rel="stylesheet" type="text/css" href="./style-panel.css" />
  <link rel="stylesheet" type="text/css" href="./style-icons.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://unpkg.com/ionicons@4.4.8/dist/ionicons.js"></script>
</head>
<body>
<?php include 'navbar-panel.php'; ?>
<script>
$("#home").removeClass("text-light").addClass("text-info");
</script>
<main class="container-fluid bg-light" id="main-wrapper">
  <section class="row bg-gray section-space register-wrapper">
		<div class="d-flex container">

		</div>
  </section>
</main>
<?php include '../footer.php'; ?>
</body>
</html>
