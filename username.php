<?php
require_once("connection.php");
session_start();
$username=$_SESSION['username'];
$question=$_SESSION['question'];
$answer=$_SESSION['answer'];
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
    <p><?php echo $username; ?> Password Reset</p>
  </div>
  </center>
</div>

<?php    
             
if(isset($_POST["submit"])){  
  
    if(!empty($_POST['answer'])) {  
        $answergiven =$_POST['answer']; 
        if($answer == $answergiven)  
        {  
        header("Location: reset.php");  
        }   
        else{
        echo "
        <div class='col-lg-12'>
        <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
            <center><h5 style='color:white'>Invalid Answer to the security question</h5></center>
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
        <form role="form" action="username.php" method="POST">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <label><?php echo $question;?></label>
                    <input required style="color:black" type="text" class="form-control" id="answer" name="answer" placeholder="Security Answer">
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
</body>
</html>