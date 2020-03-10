<?php
session_start();
if(!isset($_SESSION['logged'])){
	session_destroy();
	header('Location: ../login.php');
	exit();
}


$username = 'Xawess';
$email = 'xawess@gmail.com';
$package = 'Diamond';
$reg_date = '2019-02-14';
$log_date = '2019-07-30 04:44';
$log_num = "23";

$browser = get_browser();

$usr_browser = $browser->browser . "Chrome";
$usr_version = "64.0";
$usr_ip = "127.0.0.0";
$usr_sys = "MacOS Mojave";
 ?>
 <!doctype html>
 <html lang="en">
 <head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width,initial scale=1" />
   <meta name="description" content="Admin Panel Created by Michael Mlotowski" />
   <meta name="author" content="Michael Mlotowski" />
   <meta name="keywords" content="" />
   <title>Stats | Admin Panel</title>
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
   <?php require 'navbar-panel.php' ?>
   <script>
   $('#stats').removeClass('text-light').addClass('text-info')
   </script>

   <main class="container-fluid bg-light row panel-wrapper bigger-p text-dark rounded">
     <div class="bg-light col-md mr-5 ml-5">
       <h3 class="text-center text-info mb-3">Website Stats</h3>
<p>
  Username: <? echo $username; ?>
</p>
<p>
  Email: <? echo $email; ?>
</p>
<p>
  Package: <? echo $package; ?>
</p>
<p>
  Register Date: <? echo $reg_date; ?>
</p>
<p>
  Last login on: <? echo $log_date; ?>
</p>
<p>
  Number of logins: <? echo $log_num; ?>
</p>
     </div>
     <div class="bg-light col-md mr-5 ml-5">
       <h3 class="text-center text-info mb-3">Your PC Stats</h3>
<p>
  Platform: <? echo $usr_sys; ?>
</p>
<p>
  IP: <? echo $usr_ip; ?>
</p>
<p>
  Browser: <? echo $usr_browser; ?>
</p>
<p>
  Version: <? echo $usr_version; ?>
</p>
<p class="small-p text-center">
  We do not collect any information about your pc
</p>
     </div>
   </main>
 </body>
 </html>
