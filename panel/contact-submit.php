<?php
header('Content-type: application/json');

if(!isset($_POST['name']) || !isset($_POST['email']) ||
  !isset($_POST['phone']) || !isset($_POST['message']) ||
  !isset($_POST['rules'])){
    $response['answer'] = 'EMPTYINPUT';
    /*$response['name'] = $_POST['name'];
    $response['email'] = $_POST['email'];
    $response['phone'] = $_POST['phone'];
    $response['message'] = $_POST['message'];
    $response['rules'] = $_POST['rules'];*/
    echo json_encode($response);
    exit();
  }

$name = strip_tags(trim($_POST['name']));
$email = strip_tags(trim($_POST['email']));
$phone = strip_tags(trim($_POST['phone']));
$message = strip_tags(trim($_POST['message']));
$rules = strip_tags(trim($_POST['rules']));

function SendMessage(){
  global $name, $email, $phone, $message, $rules;

  $name_length = mb_strlen($name, 'UTF-8');
  $email_length = mb_strlen($email, 'UTF-8');
  $phone_length = mb_strlen($phone, 'UTF-8');
  $message_length = mb_strlen($message, 'UTF-8');

  if($name_length<4){
    return 'SHORTNAME';
  }
  else if($name_length>60){
    return 'LONGNAME';
  }
  else if(!preg_match("/[a-zA-Z]{4,60}/",$name)){
    return 'INVALIDNAME';
  }
  else if($email_length<6){
    return "SHORTEMAIL";
  }
  else if($email_length>64){
    return 'LONGEMAIL';
  }
  else if(!preg_match("/^[0-9a-zA-Z_.-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,10}$/",$email)){
    return 'INVALIDEMAIL';
  }
  else if(!preg_match("/^[0-9\+\-]{9,15}$/",$phone) && $phone!='none'){
    return 'INVALIDPHONE';
  }
  else if($message_length<10){
    return "SHORTMSG";
  }
  else if($message_length>600){
    return 'LONGMSG';
  }
  else if($rules!="1" || $rules!=1){
    return "NORULES";
  }
  else {
    $topic = "Contact Message from Admin Panel | Michal Mlotowski";
    $headers = "From: contact@michalmlotowski.com\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $msg_head = "________________\n\n
                This is only test message. The design can be fully customized.\n
                Submited data:\n\n Name: " . $name . "\nE-Mail: " . $email .
                "\n Phone: " . $phone . "\n________________\n Message: \n\n";

    $message = wordwrap($message, 70, "\r\n");
    $message = $msg_head . $message;

    $send = mail($email,$topic,$message,$headers);

    if($send){
     return 'SUCCESS';
    }
    else {
     return 'SERVERERROR';
    }

    return 'NOTHING';
  }
}

$response['answer'] = SendMessage();
echo json_encode($response);
exit();




 ?>
