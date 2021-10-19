<?php

require_once('connection.php');
session_start();
$username=$_SESSION['username'];

$AccountNumber = $_GET['AccountNumber'];

$query = "select * from staffdata where AccountNumber = '$AccountNumber'";

$res = mysqli_query($conn, $query);

$data = mysqli_fetch_array($res);

if(isset($_POST['update'])) 
{
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $AccountNumber = $_POST['AccountNumber'];
    $BVNNumber = $_POST['BVNNumber'];
    $EmailAddress = $_POST['EmailAddress'];
    $BankBranch = $_POST['BankBranch'];
    $HomeAddress = $_POST['HomeAddress'];
    $TelephoneNumber = $_POST['TelephoneNumber'];
    $AccountType = $_POST['AccountType'];
    $Balance = $_POST['Balance'];
    $logon = $_POST['logon'];
    $CreditCard = $_POST['CreditCard'];
	
    $qry = "update staffdata set FirstName='$FirstName', LastName='$LastName', BVNNumber='$BVNNumber', EmailAddress='$EmailAddress', BankBranch='$BankBranch', HomeAddress='$HomeAddress', TelephoneNumber='$TelephoneNumber', AccountType='$AccountType', Balance='$Balance', logon='$logon', CreditCard='$CreditCard' where AccountNumber='$AccountNumber'";
    $edit = mysqli_query($conn, $qry);
	
    if($edit)
    {
        header("location:index.php"); 
        
    }
    else
    {
        echo mysqli_error($conn);
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
    <!-- <script src="main.js"></script> -->
</head>

<body>
<div class="container">
  <center class="animated bounceInDown">
  <div class="jumbotron">
  <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="50" height="50" style="float:right"> 
     <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="100" height="50" style="float:left">
    <p>Update  Details</p>
  </div>
  </center>

<br><hr><br>

<div class="container">
  <center class="animated bounceInDown">
  <div class="jumbotron">
    <form role="form" action='edit.php' method="POST">
        <div class="form-group">
            <div class="col-sm-5">
              <label>First Name</label>
            <input required style="color:black" value="<?php echo $data['FirstName'] ?>" type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name">
            <br>
            <br>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
            <label>Last Name</label> 
            <input required style="color:black" value="<?php echo $data['LastName'] ?>" type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name">
            </div>
        </div>
        <br>
        <br>

        <div class="form-group">
            <div class="col-sm-5">
            <label>Account Number</label> 
            <input required style="color:black" value="<?php echo $data['AccountNumber'] ?>" type="number" class="form-control" id="AccountNumber" name="AccountNumber" placeholder="Enter Account Number" disabled>
            </div>
        </div>
        

        <div class="form-group">
            <div class="col-sm-5">
            <label>Bank Verification Number</label> 
            <input required style="color:black" value="<?php echo $data['BVNNumber'] ?>" type="number" class="form-control" id="BVNNumber" name="BVNNumber" placeholder="Enter BVN" disabled>
            </div>
        </div>
        <br>
        <br>

        <div class="form-group">
            <div class="col-sm-5">
            <label>Email Address</label> 
            <input required style="color:black" value="<?php echo $data['EmailAddress'] ?>" type="email" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="Enter Email Address">
            </div>
        </div>
        

        <div class="form-group">
            <div class="col-sm-5">
            <label>Bank Branch</label> 
            <input required style="color:black" value="<?php echo $data['BankBranch'] ?>" type="text" class="form-control" id="BankBranch" name="BankBranch" placeholder="Enter Bank Branch">
            </div>
        </div>
        <br>
        <br>

        <div class="form-group">
            <div class="col-sm-5">
            <label>Home Address</label> 
            <input required style="color:black" value="<?php echo $data['HomeAddress'] ?>" type="text" class="form-control" id="HomeAddress" name="HomeAddress" placeholder="Enter Home Address">
            </div>
        </div>
        

        <div class="form-group">
            <div class="col-sm-5">
            <label>Telephone Number</label> 
            <input required style="color:black" value="<?php echo $data['TelephoneNumber'] ?>" type="text" class="form-control" id="TelephoneNumber" name="TelephoneNumber" placeholder="Enter Telephone Number" maxlength="11">
            </div>
        </div>
        <br>
        <br>

        

        <div class="form-group">
            <div class="col-sm-5">
            <label>Balance</label> 
            <input required style="color:black" value="<?php echo $data['Balance'] ?>" type="text" class="form-control" id="Balance" name="Balance" placeholder="Enter Account Balance">
            </div>
        </div>
        

        <div class="form-group">
            <div class="col-sm-5">
            <label>Logon</label> 
            <input required style="color:black" value="<?php echo $data['logon'] ?>" type="text" class="form-control" id="logon" name="logon" placeholder="Enter Logon">
            </div>
        </div>
        <br>
        <br>
       

        <div class="form-group">
            <div class="col-sm-5">
            <label>Credit Card</label> 
            <input required style="color:black" value="<?php echo $data['CreditCard'] ?>" type="text" class="form-control" id="CreditCard" name="CreditCard" placeholder="Enter Credit  Card" maxlength="16">
            </div>
        </div>
        <br>
        <br>
        
        <div class="form-group"> 
            <div class="col-sm-5"> 
            <label>Account Type</label>
            <?php

             ?>
            <label style="color:black" class="radio-inline"><input required <?php if($data['AccountType']=="Savings") echo "checked"?> type="radio" name="AccountType" value="Savings">Savings</label>
            <label style="color:black" class="radio-inline"><input required <?php if($data['AccountType']=="Current") echo "checked"?> type="radio" name="AccountType" value="Current">Current</label>

            </div>
        </div>
        <br>
        <br>
        <div class="pull-right">
          <div class="form-group"> 
            <button type="submit"  name = "update" class="btn btn-success">Update User Details</button>
          </div>
        </div>
    </form> 
    <div class="pull-right">
    <div class="form-group">
            <button class="btn btn-warning" onclick="window.location.href='index.php'">Cancel</button>
    </div>
    </div>
            
  </div>
</div>
</body>
</html>
