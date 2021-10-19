<?php
require_once("connection.php");
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
    <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="50" height="50" style="float:right"> 
    <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="100" height="50" style="float:left">
    <p>Reset Password</p>
  </div>
  </center>
</div>
<?php    
             
if(isset($_POST["submit"])){  
  
if(!empty($_POST['username'])) {  
    $username=$_POST['username'];  
  
    $query=mysqli_query($conn,"SELECT * FROM users WHERE username='".$username."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbusername=$row['username'];
    $answer=$row['answer'];
    $question=$row['question'];
    }  
  
    if($username == $dbusername)  
    {  
    session_start();  
    $_SESSION['username'] = $username;
    $_SESSION['question'] = $question;
    $_SESSION['answer'] = $answer;
    
    header("Location: username.php");  
    }  
    } 
        else{
          echo "
          <div class='col-lg-12'>
            <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
              <center><h5 style='color:white'>Username does not exist</h5></center>
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
        <form role="form" action="forgot.php" method="POST">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <label>Username</label>
                    <input required style="color:black" type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
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
