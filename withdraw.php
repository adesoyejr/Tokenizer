<?php
require_once('connection.php');
session_start();
$username=$_SESSION['username'];
$acct = $_GET['AccountNumber'];

    

$seql = "SELECT * FROM `staffdata` WHERE `AccountNumber` = '$acct'"; 
$rquery = mysqli_query($conn, $seql); 
$data = mysqli_fetch_array($rquery);
// print_r($data);
//var_dump($data['AccountNumber']);
$_SESSION['account'] = $data['AccountNumber'];
$_SESSION['balance'] = $data['Balance'];
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
    <p><?php echo $data['FirstName']." " .$data['LastName'] ;?> Withdrawal</p>
  </div>
  </center>
</div>
<br><hr><br>

<div class="container">
  <center class="animated bounceInDown">
    <div class="jumbotron">
        <form role="form" action="withaction.php" method="POST">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <label>Name</label>
                    <input required style="color:black" type="text" class="form-control" id="withdrawer" name="withdrawer" placeholder="Enter the name">
                    <br>

                    <label>Amount to be Withdrawn</label>
                    <input required style="color:black" type="text" class="form-control" id="amount" name="amount" placeholder="Enter the amount to be withdrawn">

                    <br><br>
                    <button type="submit" onclick="checkuser(this.value)" name="submit" class="btn btn-success">Confirm Withdrawal</button>
                    </form>
                    <button class="btn btn-warning" onclick="window.location.href='javascript:history.go(-1)'">Cancel</button>
                </div>
                <br><br><br><br><br><br><br><br><br><br>
                <br>
                <br>
            </div>
    </div>         
   
</center>
</div>
</body>
</html>