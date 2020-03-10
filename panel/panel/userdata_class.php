<?
class userdata {
  public $username;
  public $database;
  public $host;
  public $dbpass;

  public function get_profile_data($id){
    $db = new mysqli($this->host,$this->username,$this->dbpass,$this->database);     //connecting with db
    if($db->connect_errno){       //if failed
      $db->close();
      return "SERVER_DOWN";
    }
    $query1 = "SELECT username,email,plan FROM users2 WHERE id='$id';";    //pobranie danych podstawowych
    if(!$result = $db->query($query1)){
        $db->close();
      return "QUERY_ERROR";
    }
    $row = $db->num_rows;
    if($row<>1){
      $db->close();
      return 'QUERY_ERROR';
    }
    $row = $result->fetch_row();
    global $name = $row[0];    //odwolanie do globalnych zmiennych
    global $email = $row[1];
    global $plan = $row[2];

    $query2 = "SELECT * FROM userdata WHERE id='$id';";       //pobranie danych uzytkownika
    if(!$result = $db->query($query2)){
      $db->close();
      return 'QUERY_ERROR';
    }
    $row = $db->num_rows;
    if($row>1){
      $db->close();
      return 'QUERY_ERROR';
    }
    if($row==0){
      $db->close();
      global $userdata_empty = 1;
      return 'NO_PROFILE_SETUP';
    }
    $row = $result->fetch_row();
    $db->close();

    global $firstname = $row[1];
    global $lastname = $row[2];
    global $birthday = $row[3];
    global $country = $row[4];
    global $city = $row[5];
    global $street = $row[6];
    global $number = $row[7];
    global $postal = $row[8];

    return 'OK';

  }

  public function enter_profile_data($id){
    if(!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['birthday']) || !isset($_POST['country'])
    || !isset($_POST['city']) || !isset($_POST['street']) || !isset($_POST['number']) || !isset($_POST['postal'])){
      return 'EMPTY_INPUT';
    }
    function secure_var($data){
      $data = strip_tags(trim($data));
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $fn = secure_var($_POST['firstname']);
    $ln = secure_var($_POST['lastname']);
    $bd = secure_var($_POST['birthday']);
    $ct = secure_var($_POST['country']);
    $city = secure_var($_POST['city']);
    $st = secure_var($_POST['street']);
    $no = secure_var($_POST['number']);
    $post = secure_var($_POST['postal']);

    $st_len = mb_strlen($st, 'UTF-8');
    $no_len = mb_strlen($no, 'UTF-8');

    if(!preg_match("/^[a-zA-Z]{3,30}$/",$fn)){
      $db->close();
      return 'INVALID_FN';
    }
    else if(!preg_match("/^[a-zA-Z\s]{3,30}$/",$ln)){
      $db->close();
      return 'INVALID_LN';
    }
    else if(!preg_match("/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/",$bd)){
      $db->close();
      return 'IVALID_BD';
    }
    else if($ct!="1" && $ct!="2" && $ct!="3" && $ct!="4" && $ct!="5" && $ct!="6" && $ct!="7" && $ct!="8" && $ct!="9" && $ct!="10" &&
    $ct!="11" && $ct!="12" && $ct!="13" && $ct!="14" && $ct!="15"){
      $db->close();
      return 'INVALID_CT';
    }
    else if(!preg_match("/^[a-zA-Z\s]{3,30}$/",$city)){
      $db->close();
      return 'INVALID_CITY';
    }
    else if($st_len>60 || $st_len<3){
      $db->close();
      return 'INVALID_ST';
    }
    else if(!preg_match("/\d/",$no) || $no_len>10 || $no_len<1 || $no=="0"){
      $db->close();
      return "IVALID_NO";
    }
    else if(!preg_match("/^[a-zA-Z0-9-]{4,12}$/",$post)){
      $db->close();
      return 'IVALID_POST';
    }
    else {

      $fn= real_escape_string($fn);
      $ln= real_escape_string($ln);
      $bd= real_escape_string($bd);
      $ct= real_escape_string($ct);
      $city= real_escape_string($city);
      $st= real_escape_string($st);
      $no= real_escape_string($no);
      $post= real_escape_string($post);

      $db = new mysqli($host,$username,$dbpass,$database);
      if($db->connect_errno){
        $db->close();
        return 'DB_ERROR';
      }
      $query = "SELECT COUNT(*) from userdata WHERE id='$id'";
      if(!$result=$db->query($query)){
        $db->close();
        return 'QUERY_ERROR';
      }
      if(!$row=$result->fetch_row()){
        $db->close();
        return 'QUERY_ERROR';
      }


      if($row[0]>0){      //USER ALREADY EXISTS - EDITING DATA
        $query2 = "UPDATE userdata SET firstname='$fn', lastname='$ln', birthday='$bd',
        country='$ct', city='$city', street='$st', number='$no', postal='$post' WHERE id='$id';";
        if(!$result2=$db->query($query2)){
          $db->close();
          return 'QUERY_ERROR';
        }
        if($result2->affected_rows>1){
          $db->close();
          return 'QUERY_ERROR';
        }
        $db->close();
        return 'EDIT_OK';
      }
      else{     //NEW USER - INSERTING DATA
        $query2 = "INSERT INTO userdata VALUES ('$id','$fn','$ln','$bd','$ct','$city','$st','$no','$post');";
        if(!$result2=$db->query($query2)){
          $db->close();
          return 'QUERY_ERROR';
        }
        if($result2->affected_rows>1){
          $db->close();
          return 'QUERY_ERROR';
        }
        $db->close();
        return 'NEW_OK';
      }
    }
  }



}
?>
