<?
require './token.php';
$t = new token;
$i=0;
while($i<10){
  echo $t->generate() . "\r\n";
  echo '<br />';
  $i++;
}
if($t->sendMail("xawess@gmail.com","aaaaaaaaa")==true){
  echo 'SUCCESS';
}
