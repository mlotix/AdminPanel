<?php
session_start();
$_SESSION['logged']=false;
session_destroy();
header('Location: ../login.php?logout');
exit();



 ?>
