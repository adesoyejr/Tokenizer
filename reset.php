<?php
require_once("connection.php");
session_start();
$username=$_SESSION['username'];
$question=$_SESSION['question'];
$answer=$_SESSION['answer'];
$oldpassword=$_SESSION['password'];
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
    
</head>
<body>
<div class="container">
  <center class="animated bounceInDown">
  <div class="jumbotron">
    <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="90" height="90" style="float:right"> 
    <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="200" height="70" style="float:left">
    <p>Hello <?php echo $username; ?>, Let's set a new Password</p>
  </div>
  </center>
</div>
<?php    
             
if(isset($_POST["submit"])){  
  
if(!empty($_POST['password'])) {  
    $password=$_POST['password'];
    if(!password_verify($password, $oldpassword)){
        $qry = "update users set password='$password' where username='$username'";
        $edit = mysqli_query($conn, $qry);
        
        if($edit)
        {   header( "refresh:5;url=login.php" );
            echo "
            <div class='col-lg-12'>
                <div style='background-color:green; padding: 10px 0'>
                <center><h5 style='color:white'>Password changed</h5></center>
                </div>
            </div>
            ";
            ?>
                <!-- <div class='form-group'>
                <div class='col-sm-offset-3 col-sm-8'><br>
                <button class='btn btn-success' onclick="window.location.href='login.php'">Return to login</button>
                </div>
                </div> -->

            <?php
            exit();
            
        }     

        else
        {
            
            echo "
            <div class='col-lg-12'>
                <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
                <center><h5 style='color:white'>Password not changed</h5></center>
                </div>
            </div>
            ";
            ?>
                <div class='form-group'>
                <div class='col-sm-offset-3 col-sm-8'>
                <button class='btn btn-success' onclick='window.location.href=login.php'>Return to login</button>
                </div>
                </div>

            <?php
            exit();
        } 
    }
    else{
        echo "
            <div class='col-lg-12'>
                <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
                <center><h5 style='color:white'>New Password cannot be old password!</h5></center>
                </div>
            </div>
            ";

    }   
}
}
?>
<br><hr><br>

<div class="container">
  <center class="animated bounceInDown">
    <div class="jumbotron">
        <form role="form" action="reset.php" method="POST">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <label>New Password</label>
                    <input required style="color:black" type="password" class="form-control" id="password" name="password" placeholder="Enter your new password">
                    <input type="checkbox" onclick="myFunction()">Show Password
                    <br>
                    <button type="submit" onclick="checkuser(this.value)" name="submit" class="btn btn-success">Continue</button>
                    </form>
                    <button class="btn btn-warning" onclick="window.location.href='login.php'">Cancel</button>
                </div>
                <br>
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
</script>
</body>
</html>