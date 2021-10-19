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
    <p>Please enter your details to login.</p>
  </div>
  </center>
</div>
<?php    
             
if(isset($_POST["submit"])){  
  
if(!empty($_POST['username']) && !empty($_POST['password'])) {  
    $username=$_POST['username'];  
    $password=$_POST['password'];  
  
  
    $query=mysqli_query($conn,"SELECT * FROM users WHERE username='".$username."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows!=0)  
    {  
    while($row=mysqli_fetch_assoc($query))  
    {  
    $dbusername=$row['username'];  
    $dbpassword=$row['password'];
    $type=$row['type']; 
    }  
  
    if($username == $dbusername && password_verify($password, $dbpassword))  
    {  
    session_start();  
    $_SESSION['username'] = $username;
    $_SESSION['type'] = $type;
    $_SESSION['password'] = $dbpassword;  
  
    /* Redirect browser */  
    header("Location: index.php");  
    }  
    } 
        else{
          echo "
          <div class='col-lg-12'>
            <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
              <center><h5 style='color:white'>Invalid username or password!</h5></center>
            </div>
          </div>
          ";
          }
      } else {  
    echo "All fields are required!"; 

  }
}
?>
<br><hr><br>

<div class="container">
  <center class="animated bounceInDown">
    <div class="jumbotron">
      <form role="form" action="login.php" method="POST">
        <div class="form-group">
          <div class="col-sm-6">
            <label>Username</label>
            <input required style="color:black" type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
            <br>
            <br>
          </div>
        
          <div class="col-sm-6">
            <label>Password</label> 
            <input required style="color:black" type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            <input type="checkbox" onclick="myFunction()">Show Password 
          </div>
          <br>
          <br>
  
          <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" onclick="checkuser(this.value)" name="submit" class="btn btn-success">Login</button>
      </form>
            <br>
            <a href = 'forgot.php'>Forgot Password</a>
            <br>
          </div>

          <br>
          <div class="col-sm-offset-2 col-sm-8">
            <input type="button" class="btn btn-success" onclick="window.location.href = 'contact.php';" value="Create User"/>
          </div>
          <br><br><br><br>

    
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