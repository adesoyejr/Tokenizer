<?php
require_once('connection.php');
require_once('controller.php');
session_start();
$username=$_SESSION['username'];
$AccountNumber = $_SESSION['account'];
$Balance = $_SESSION['balance'];
if(isset($_POST['submit'])) 
{        
    $Withdrawer = $_POST['withdrawer'];
    $Amount = $_POST['amount'];
    $newWithdraw = new account($conn);
    $withdraw = $newWithdraw->doWithdrawal($AccountNumber, $Amount, $Withdrawer, $Balance);
    if($withdraw){
        header("refresh:2;url=detss.php?AccountNumber=$AccountNumber");
        echo "
        <div class='col-lg-12'>
            <div style='background-color:green; padding: 10px 0'>
            <center><h5 style='color:white'>Withdrawal done successfully</h5></center>
            </div>
        </div>
        ";
    }else
    {
        header( "refresh:2;url=detss.php?AccountNumber=$AccountNumber" );
        echo "
        <div class='col-lg-12'>
            <div style='background-color:darkred; padding: 10px 0'>
            <center><h5 style='color:white'>Cannot process transaction, try again later.</h5></center>
            </div>
        </div>
        ";
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
    
</head>
<body>

</body>
</html>