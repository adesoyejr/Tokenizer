<?php
require_once("connection.php");
require_once("controller.php");
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['password'];

if(isset($_POST["submit"])){  
    
  $newpassword=$_POST['newpassword'];
  $oldpassword=$_POST['oldpassword'];
  
  $user = new user($conn);
  $changePassword = $user->changePassword($username, $password, $oldpassword, $newpassword);
    
  if($changePassword){
    header( "refresh:2;url=index.php" );
    echo "
    <div class='col-lg-12'>
        <div style='background-color:green; padding: 10px 0'>
          <center><h5 style='color:white'>Password changed</h5></center>
        </div>
    </div>
    ";
  }else
  {
    echo "
    <div class='col-lg-12'>
      <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
        <center><h5 style='color:white'>Password not changed</h5></center>
      </div>
    </div>
    ";
  }   
}
//print_r($_SESSION);
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
    $("#newpassword").keyup(function(){
      check_pass();
    });
    });

    function check_pass()
    {
    var val=document.getElementById("newpassword").value;
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
    <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="50" height="50" style="float:right"> 
    <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="100" height="50" style="float:left">
    <p><?php echo $username; ?> Password Change</p>
  </div>
  </center>
</div>
<?php    
             

?>

<br><hr><br>

<div class="container">
  <center class="animated bounceInDown">
    <div class="jumbotron">
        <form role="form" action="change.php" method="POST">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <label>Current Password</label>
                    <input required style="color:black" type="password" class="form-control" id="password" name="oldpassword" placeholder="Enter your current password">
                    <!-- <input type="checkbox" onclick="myFunction()">Show Password -->
                    <br><br>

                    <label>New Password</label>
                    <input required style="color:black" type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter your new password">
                    <div id="meter_wrapper">
                      <div id="meter"></div>
                    </div>
                    <span id="pass_type"></span>
                    <br>
                    <input type="checkbox" onclick="myFunc()">Show Password

                    <br><br>
                    <button type="submit" onclick="checkuser(this.value)" name="submit" class="btn btn-success">Continue</button>
                    </form>
                    <button class="btn btn-warning" onclick="window.location.href='index.php'">Cancel</button>
                </div>
                <br><br><br><br><br><br><br><br><br><br>
                <br>
                <br>
            </div>
    </div>         
   
</center>
</div>
<script>
  function myFunction() {
    var show = document.getElementById("password");
    if (show.type === "password") {
      show.type = "text";
    } else {
      show.type = "password";
    }
  } 
  function myFunc() {
    var show = document.getElementById("newpassword");
    if (show.type === "password") {
      show.type = "text";
    } else {
      show.type = "password";
    }
  } 
</script>
</body>
</html>