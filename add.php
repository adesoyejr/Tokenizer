<?php
require_once("connection.php");
require_once("controller.php");
session_start();
$username=$_SESSION['username'];

if(isset($_POST["submit"])){

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
  $filename = basename($_FILES["image"]["name"]);
  $fileType = pathinfo($filename, PATHINFO_EXTENSION);
  $image = $_FILES['image']['tmp_name']; 
  $imgContent = addslashes(file_get_contents($image));

  $newAccount = new account($conn);
  $account = $newAccount->create($FirstName, $LastName, $AccountNumber, $BVNNumber, $EmailAddress, $BankBranch, $HomeAddress, $TelephoneNumber, $AccountType, $Balance, $logon, $CreditCard, $imgContent);
  
  if($account)
  {
    header( "refresh:2;url=index.php" );
    echo "
      <div class='col-lg-12'>
        <div style='background-color:green; padding: 10px 0'>
          <center><h5 style='color:white'>New Customer Added</h5></center>
        </div>
      </div>
      ";
  }else
  {
    header( "refresh:3;url=index.php" );
    echo "
      <div class='col-lg-12'>
        <div style='background-color:darkred; padding: 10px 0'>
          <center><h5 style='color:white'>Account Not Added</h5></center>
        </div>
      </div>
      ";
  }
}
?>

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
    <p>Please Enter User Details</p>
  </div>
  </center>

<br><hr><br>

<div class="container">
  <center class="animated bounceInDown">
  <div class="jumbotron">
    <form role="form" action='add.php' method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <div class="col-sm-5">
            <label>First Name</label>
            <input required style="color:black" type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name">
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-5">
            <label>Last Name</label> 
            <input required style="color:black" type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name">
          </div>
        </div>
        <br>
        <br>

        <div class="form-group">
          <div class="col-sm-5">
            <label>Account Number</label> 
            <input required style="color:black" type="text" class="form-control" id="AccountNumber" name="AccountNumber" placeholder="Enter Account Number" maxlength="10">
          </div>
        </div>
        

        <div class="form-group">
          <div class="col-sm-5">
            <label>Bank Verification Number</label> 
            <input required style="color:black" type="text" class="form-control" id="BVNNumber" name="BVNNumber" placeholder="Enter BVN" maxlength="11">
          </div>
        </div>
        <br>
        <br>

        <div class="form-group">
          <div class="col-sm-5">
            <label>Email Address</label> 
            <input required style="color:black" type="email" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="Enter Email Address">
          </div>
        </div>
        

        <div class="form-group">
          <div class="col-sm-5">
            <label>Bank Branch</label> 
            <input required style="color:black" type="text" class="form-control" id="BankBranch" name="BankBranch" placeholder="Enter Bank Branch">
          </div>
        </div>
        <br>
        <br>

        <div class="form-group">
          <div class="col-sm-5">
            <label>Home Address</label> 
            <input required style="color:black" type="text" class="form-control" id="HomeAddress" name="HomeAddress" placeholder="Enter Home Address">
          </div>
        </div>
        

        <div class="form-group">
          <div class="col-sm-5">
            <label>Telephone Number</label> 
            <input required style="color:black" type="tel" class="form-control" id="TelephoneNumber" name="TelephoneNumber" placeholder="eg 0809992233" pattern="[0-9]{11}" maxlength="11">
          </div>
        </div>
        <br>
        <br>

        

        <div class="form-group">
          <div class="col-sm-5">
            <label>Balance</label> 
            <input required style="color:black" type="text" class="form-control" id="Balance" name="Balance" placeholder="Enter Account Balance">
          </div>
        </div>
        

        <div class="form-group">
          <div class="col-sm-5">
            <label>Logon</label> 
            <input required style="color:black" type="text" class="form-control" id="logon" name="logon" placeholder="Enter Logon">
          </div>
        </div>
        <br>
        <br>
       

        <div class="form-group">
          <div class="col-sm-5">
            <label>Credit Card</label> 
            <input required style="color:black" type="text" class="form-control" id="CreditCard" name="CreditCard" placeholder="Enter Credit  Card" maxlength="16">
          </div>
        </div>

        
        <div class="form-group"> 
          <div class="col-sm-5"> 
            <label>Account Type</label>
            <label style="color:black" class="radio-inline"><input required type="radio" name="AccountType" value="Savings">Savings</label>
            <label style="color:black" class="radio-inline"><input required type="radio" name="AccountType" value="Current">Current</label>
          </div>
        </div>
      	<br>
        <br>

        <div class="form-group"> 
          <div class="col-sm-5"> 
            <label>Upload Profile Picture</label>
            <input style="color:black" required type="file" name="image" id="image" value="image">
          </div>
        </div>
      	<br>
        <br>

        <div class="pull-right">
          <div class="form-group"> 
            <button type="submit"  name = "submit" class="btn btn-success">Register Account</button>
        </form>
            <button class="btn btn-warning" onclick="window.location.href='index.php'">Cancel</button>
          </div>
        </div>
          
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#dp').click(function(){
            var image_name = $('#image').val();
            if(image_name == ''){
                alert('Please select an image');
                return false;
            }
            else{
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['png','jpg','jpeg']) == -1){
                    alert('Invalid file type');
                    $('#image').val('');
                    return false;
                }
            }
        });
    });
</script>

</body>
</html>