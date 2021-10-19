<?php
require_once('connection.php');
session_start();
$username=$_SESSION['username'];
$type = $_SESSION['type'];
$AccountNumber = $_GET['AccountNumber'];

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

<?php
if (!empty($AccountNumber)){     

    $sql = "SELECT * FROM `staffdata` WHERE `AccountNumber` = '$AccountNumber'"; 
    $rasberry = mysqli_query($conn, $sql);} 
    $data = mysqli_fetch_array($rasberry);
    //var_dump($data);
    //exit();
    //print_r($data);
    if ($data == false){
        header( "refresh:5;url=index.php" );?>
        <div class="container">
        <center class="animated bounceInDown">
        <div class="jumbotron">
        <p><?php echo "Account number $AccountNumber does not exist";
        exit();?></p>
    </div>
    </center>
    </div>
    <?php    
}
//var_dump($data['AccountNumber']);
?>
<body>
<div class="container">
  <center class="animated bounceInDown">
  <div class="jumbotron">
    <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="50" height="50" style="float:right"> 
    <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="100" height="50" style="float:left">
    <p><?php echo $data['FirstName']." " .$data['LastName'] ;?></p>
  </div>
  </center>
</div>

<div class="container">
<div class="row">
    <div class="col-lg-7">
    <div class="modal-content animated fadeIn slower">
        <div class="modal-header topHeader">
            <button class="btn btn-success" float-left onclick="window.location.href='deposit.php?AccountNumber=<?php echo $data['AccountNumber']; ?>'">Deposit</button>
            <button class="btn btn-info" float-left onclick="window.location.href='withdraw.php?AccountNumber=<?php echo $data['AccountNumber']; ?>'">Withdraw</button>
            <div class="pull-right">
            <button class="btn btn-warning" float-left onclick="window.location.href='index.php'">Return to Home</button>
            </div>
        
        </div>
        <div class="modal-body">
          <center><img class="img-circle img-responsive dp" src="data:image/jpeg;charset=utf8;base64,<?php echo base64_encode($data['dp']); ?>">
          </center>
          <hr>
          <center> <h3>PERSONAL INFO</h3> </center>
          <center>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">First Name</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['FirstName']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Last Name</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo$data['LastName']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Account Number</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['AccountNumber']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Bank Verification Number</div>
                <div class="col-lg-8 profile-value animated flash"><?php if ($type){echo $data['BVNNumber'];}else{echo "**********";} ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Email Address</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['EmailAddress']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Bank Branch</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['BankBranch']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Home Address</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['HomeAddress']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Telephone Number</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['TelephoneNumber']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Account Balance</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['Balance']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Logon Name</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['logon']; ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Credit Card Number</div>
                <div class="col-lg-8 profile-value animated flash"><?php if ($type){echo $data['CreditCard'];}else{echo "**********";} ?></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-4 profile-key animated flash">Account Type</div>
                <div class="col-lg-8 profile-value animated flash"><?php echo $data['AccountType']; ?></div>
            </div>
            <br>

          </center>
          <hr>
        </div>
        <center>
        <div class="modal-footer">
        </div>
        </center>
    </div>
    </div>
   

    <div class="col-lg-5">
    <div class="modal-content animated fadeIn slower">

        <center><h3>LAST 10 TRANSACTIONS</h3></center>
        <div class="modal-body">
        <center>
            <?php
                $sql = "SELECT * FROM transactions WHERE AccountNumber = '$AccountNumber' ORDER BY transtime DESC";
                $result = mysqli_query($conn, $sql);
                $vak = mysqli_num_rows($result);
                if($vak){
            ?>
            <div style="overflow-x:auto;">
                <table class= 'table table-bordered table-striped'>
                    <tr>
                        <th>Transaction Type</th>
                        <th>Amount</th>
                        <th>Person</th>
                        <th>Time</th>
                    </tr>
            <?php
            while ($data = mysqli_fetch_array($result)){
            ?>
                    <tr>
                        <td><?php echo $data['transtype']; ?></td>
                        <td><?php echo $data['amount']; ?></td>
                        <td><?php echo $data['personnel']; ?></td>
                        <td><?php echo $data['transtime']; ?></td>
                    </tr>
            <?php
            } 
            ?>
                </table>
                <?php }else{ echo "No Transactions recorded!";} ?>

        </center>
        </div>
        <div class="modal-footer">

        </div>
    </div>
    </div>
    </div>
    <div class="col-lg-1"></div>
</div>
</div>
</body>
</html>