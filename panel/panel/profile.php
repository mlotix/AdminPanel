<?php
session_start();
if(!isset($_SESSION['logged'])){
	session_destroy();
	header('Location: ../login.php');
	exit();
}
if($_POST){

}
/*
require 'userdata_class.php';

global $id = $_SESSION['id'];
global $name=false;
global $email=false;
global $plan;=false
global $firstname=false;
global $lastname=false;
global $birthday=false;
global $country=false;
global $city=false;
global $street=false;
global $number=false;
global $postal=false;
global $userdata_empty = 0;

$prof = new userdata();

$result = $prof->get_profile_data($id); */

//usunac po testach
$name = "xawess";
$firstname=false;
$lastname="mlotowski";
$birthday="2000-11-25";
$country="15";
$city="Warszawa";
$street="bora-komorowskiego";
$number="1164/20";
$postal="812400";
$plan = 2;
$userdata_empty = 0;
 ?>
 <!doctype html>
 <html lang="en">
 <head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width,initial scale=1" />
   <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
   <meta name="author" content="Michael Mlotowski" />
   <meta name="keywords" content="" />
   <title><? echo $name; ?> | Admin Panel</title>
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
   <?php require 'navbar-panel.php';  ?>
<main class="container fluid" id="main-panel">
  <section class="main_profile text-center text-dark">
    <div class="avatar">

    </div>
    <p class="huge-p" id="prof_name">
      <? echo $name; ?>
    </p>
    <p class="larger-p" id="plan">

    </p>
   <a class="btn btn-md btn-outline-info float-right" id="edit_btn" href="./profile.php?edit">Edit</a>
  </section>
  <?
  if($userdata_empty==1 || isset($_GET['edit'])==true){
    include "profile_edit.php";
  }
  if($userdata_empty==0 && !isset($_GET['edit'])){
		include "profile_data.php";
  }
  ?>
</main>
<script>
<? if($plan==3){
  echo "$('#plan').addClass('text-success').append('Premium');";
}
if($plan==2){
  echo "$('#plan').addClass('text-warning').append('Basic');";
}
if($plan==1){
  echo "$('#plan').addClass('text-dark').append('Free');";
}
?>
</script>


 </body>
 </html>
