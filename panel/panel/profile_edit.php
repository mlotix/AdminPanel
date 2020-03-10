<section class=" user_data" id="edit_sec">
  <h3 id="info_title">Your Information</h3>
  <div class="info_wrapper">
    <form method="post" id="edit_form">
    <div class="row">
      <div class="col-md">
        <p class="profile_p">
          First Name:
        </p>
        <input type="text" name="firstname" class="form-control profile_input" id="prof_fn" maxlength="30" value="<? if($firstname==true){echo $firstname;}?>"/>
      </div>
      <div class="col-md">
        <p class="profile_p">
          Last Name:
        </p>
        <input type="text" name="lastname" class="form-control profile_input" id="prof_ln"maxlength="30" value="<? if($lastname==true){echo $lastname;}?>"/>
      </div>
    </div>
    <div class="row">
      <div class="col-md">
        <p class="profile_p">
          Date of Birth:
        </p>
        <input type="date" name="birthday" class="form-control profile_input" id="prof_bd"value="<? if($birthday==true){echo $birthday;}?>"/>
      </div>
      <div class="col-md">
        <p class="profile_p">
          Country:
        </p>
        <select name="country" class="form-control profile_input select_input" id="prof_ct">
          <option value="1">Australia</option>
          <option value="2">Brazil</option>
          <option value="3">Canada</option>
          <option value="4">China</option>
          <option value="5">France</option>
          <option value="6">Germany</option>
          <option value="7">India</option>
          <option value="8">Italy</option>
          <option value="9">Mexico</option>
          <option value="10">Poland</option>
          <option value="11">Russia</option>
          <option value="12">Spain</option>
          <option value="13">Turkey</option>
          <option value="14">United Kingdom</option>
          <option value='15'>United States</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md">
        <p class="profile_p">
          Postal:
        </p>
        <input type="text" name="postal" class="form-control profile_input profile_input_short" id="prof_post" maxlength="12" value="<? if($postal==true){echo $postal;}?>"/>
      </div>
      <div class="col-md">
        <p class="profile_p">
          City:
        </p>
        <input type="text" name="city" class="form-control profile_input" maxlength="30" id="prof_city" value="<? if($city==true){echo $city;}?>"/>
      </div>
    </div>
    <div class="row">
      <div class="col-md">
        <p class="profile_p">
          Street:
        </p>
        <input type="text" name="street" class="form-control profile_input" maxlength="60" id="prof_street" value="<? if($street==true){echo $street;}?>"/>
      </div>
      <div class="col-md">
        <p class="profile_p">
          Number:
        </p>
        <input type="text" name="number" class="form-control profile_input profile_input_short" id="prof_no" maxlength="10" value="<? if($number==true){echo $number;}?>"/>
      </div>
    </div>
  <button type="button" class="btn btn-info btn-lg float-right profile_btn" onclick="send_profile()">Save</button>
  <a class="btn btn-outline-info btn float-right profile_btn2" href="./profile.php">Cancel</a>
  </form>
  </div>
</section>
<script>
<? if($userdata_empty==1){
  echo "$('.profile_btn2').attr('disabled',true).addClass('active').addClass('btn-light').removeClass('btn-outline-info');";
}
if($userdata_empty==0 && $country==true){
  $command = "$('.select_input option[value=\"$country\"]').attr('selected', true);";
  echo $command;
}
?>
function send_profile(){

  $('#prof_fn').removeClass('prof_input_red');
  $('#prof_ln').removeClass('prof_input_red');
  $('#prof_bd').removeClass('prof_input_red');
  $('#prof_ct').removeClass('prof_input_red');
  $('#prof_city').removeClass('prof_input_red');
  $('#prof_post').removeClass('prof_input_red');
  $('#prof_street').removeClass('prof_input_red');
  $('#prof_no').removeClass('prof_input_red');

  var regex1 = /^[a-zA-Z]{3,30}$/;
  var regex2 = /^[a-zA-Z\s]{3,30}$/;
  var regex3 = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
  var regex5 = /^[a-zA-Z0-9-]{4,12}$/;
  var regex8 = /\d/;
  var firstname = $('#prof_fn').val();
  var lastname = $('#prof_ln').val();
  var birthday = $('#prof_bd').val();
  var country = $('#prof_ct').val();
  var postal = $('#prof_post').val();
  var city = $('#prof_city').val();
  var street = $('#prof_street').val();
  var number = $('#prof_no').val();
  var i=0;

  if(firstname.length>30 || firstname.length<3 || !regex1.test(firstname) || firstname==" " || firstname==false){
    ++i;
    $('#prof_fn').addClass('prof_input_red');
  }
  if(lastname.length>30 || lastname.length<3 || !regex2.test(lastname) || lastname==" " || lastname==false){
    ++i;
    $('#prof_ln').addClass('prof_input_red');
  }
  if(!regex3.test(birthday)){
    ++i;
    $('#prof_bd').addClass('prof_input_red');
  }
  if(country==false){
    ++i;
    $('#prof_ct').addClass('prof_input_red');
  }
  if(!regex5.test(postal)){
    ++i;
    $('#prof_post').addClass('prof_input_red');
  }
  if(city.length>30 || city.length<3 || city==false || city==" "){
    ++i;
    $('#prof_city').addClass('prof_input_red');
  }
  if(street.length>30 || street.length<3 || street==false || street==" "){
    ++i;
    $('#prof_street').addClass('prof_input_red');
  }
  if(!regex8.test(number)){
    ++i;
    $('#prof_no').addClass('prof_input_red');
  }
  if(i==0){
    //$('#edit_form').submit();
    alert('good');
  }
  else {
    alert('bad');
  }
}
$('#edit_btn').hide();

$('#prof_fn').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_ln').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_ct').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_bd').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_post').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_city').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_street').focus(function(){
  $(this).removeClass('prof_input_red');
});
$('#prof_no').focus(function(){
  $(this).removeClass('prof_input_red');
});
</script>
