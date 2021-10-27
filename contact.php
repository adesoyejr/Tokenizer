<?php
require_once("connection.php");
require_once("controller.php");
if(isset($_POST["submit"])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $type = $_POST['type'];
  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $hash = password_hash($password, PASSWORD_DEFAULT);

  $newUser = new user($conn);
  $user = $newUser->create($username, $password, $type, $question, $answer);
  
  if($user){
    echo "successful";
  }else{
    echo "user not ccreated";
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Randtronics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/pass.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      $("#password").keyup(function(){
        check_pass();
      });
      });

      function check_pass()
      {
        var val=document.getElementById("password").value;
        var meter=document.getElementById("meter");
        var no=0;
        if(val!="")
        {
          // If the password length is less than or equal to 6
          if(val.length<=6)no=1;

          // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
          if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;

          // If the password length is greater than 6 and contain alphabet,number,special character respectively
          if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;

          // If the password length is greater than 6 and must contain alphabets,numbers and special characters
          if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;

          if(no==1)
          {
            $("#meter").animate({width:'50px'},300);
            meter.style.backgroundColor="red";
            document.getElementById("pass_type").innerHTML="Password is Very Weak";
          }

          if(no==2)
          {
            $("#meter").animate({width:'100px'},300);
            meter.style.backgroundColor="#F5BCA9";
            document.getElementById("pass_type").innerHTML="Password is Weak";
          }

          if(no==3)
          {
            $("#meter").animate({width:'150px'},300);
            meter.style.backgroundColor="#FF8000";
            document.getElementById("pass_type").innerHTML="Password is Good";
          }

          if(no==4)
          {
            $("#meter").animate({width:'200px'},300);
            meter.style.backgroundColor="#00FF40";
            document.getElementById("pass_type").innerHTML="Password is Strong";
          }
        }

        else
        {
          meter.style.backgroundColor="white";
          document.getElementById("pass_type").innerHTML="";
        }
      }
    </script>
  </head>

  <body>
    <div class="container">
      <center class="animated bounceInDown">
      <div class="jumbotron">
        <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="90" height="90" style="float:right"> 
        <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="200" height="70" style="float:left">
        <p>Please Enter User Details</p>
      </div>
      </center>

    <br><hr><br>

    <div class="container">
      <center class="animated bounceInDown">
        <div class="jumbotron">
          <form role="form" action='contact.php' method="POST">
            <div class="form-group">
              <div class="col-sm-6">
                <label>Username</label>
                <input required style="color:black" type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                
              </div>

              <div class="col-sm-6">
                <label>Password</label> 
                <input required style="color:black" type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                  <div id="meter_wrapper">
                    <div id="meter"></div>
                  </div>
                  <span id="pass_type"></span>
                  <br>
                <input type="checkbox" onclick="myFunction()">Show Password
                <br> 
              </div>

              <div class="col-sm-6">
                <label for="security">Security Question</label> 
                <select class="form-control" id="security" name="question">
                  <option value="">Select...</option>
                  <option value="What is your first pet\'s name">What is your first pet's name</option>
                  <option value="What hospital were you born">What hospital were you born</option>
                  <option value="What is the name of your favourite uncle">What is the name of your favourite uncle</option>
                  <option value="What is the first phone number you remember">What is the first phone number you remember</option>
                  <option value="What is your mother\'s maiden name">What is your mother's maiden name</option>
                  <option value="What year did you graduate high school">What year did you graduate high school</option>
                  <option value="Who was your role model growing up">Who was your role model growing up</option>
                  <option value="What is your favorite sport">What is your favorite sport</option>
                </select>          
              </div>

              <div class="col-sm-6">
                <label>Security Question Answer</label> 
                <input required style="color:black" type="text" class="form-control" id="answer" name="answer" placeholder="Enter Security Question Answer">
                <br>
              </div>
          
              <div class="col-sm-12"> 
                <label style="color:black" class="radio-inline"><input required type="radio" name="type" value="1">Finance Department User</label>
                <label style="color:black" class="radio-inline"><input required type="radio" name="type" value="2">Call Center Agent</label>
                <label style="color:black" class="radio-inline"><input required type="radio" name="type" value="3">E-Settlement</label>
                <label style="color:black" class="radio-inline"><input required type="radio" name="type" value="4">Other User</label>
                </div>
                <br><br>
              </div>
              
              <div class="col-sm-offset-2 col-sm-8">
                <button type="submit"  name = "submit" class="btn btn-success">Create User</button>
          </form>
                <br><br>
                <a>Already a user?</a><input type="button"  onclick="window.location.href = 'login.php';" class="btn btn-warning" Value="Sign in"/>
              </div>
                <br><br><br><br><br><br><br><br><br><br><br>

            </div>
          </div>
      </center>
    </div>
    <script>
      function myFunction() {
        var show = document.getElementById("password");
        if (show.type === "password") 
        {
          show.type = "text";
        } else 
        {
          show.type = "password";
        }
      } 
    </script>
  </body>
</html>