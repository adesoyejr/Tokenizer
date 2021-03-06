<?php

use function PHPSTORM_META\type;

session_start();
// to get details of the session => print_r($_SESSION);
if(!isset($_SESSION['username'])){
    session_destroy();
    header('location:login.php');
}
require_once('connection.php');
require_once('controller.php');
$username=$_SESSION['username'];
$type = $_SESSION['type'];
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
  <script src="js/jquery.js"></script>
  <script src="js/glm-ajax.js"></script>
</head>
<body>
  
<div class="container">
  <?php echo "You are logged in as <b>$username</b>"; ?> 
  <button float-left onclick="window.location.href='change.php'">Change Password</button>
  <br>
  <center class="animated bounceInDown">
  <div class="jumbotron">
     <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="90" height="90" style="float:right"> 
     <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="200" height="70" style="float:left">
    <p>Bank Users' Details</p>
  </div>
  </center>
</div>

<hr>

<div class="container">
  <button class="btn btn-success" float-left onclick="window.location.href='add.php'">Add New User Details</button>
  <!-- <button class="btn btn-info" float-left onclick="window.location.href='iteller.php'">Go to iTeller</button> -->
  <div class="pull-right">
    <button class="btn btn-warning" pull-right onclick="window.location.href='logout.php'">Logout</button>
  </div>
<hr><br>
<form role="form" action='detss.php' method="GET">
  Search by Account Number<br>
    <input type="search" class="search-container" placeholder="Search.." name="AccountNumber" required>
  <button type="submit" name="submit" class="btn btn-success" float-center>Search</button>
  </form>
</div>
<br>


<?php

$sql = "SELECT * FROM staffdata ORDER BY FirstName, LastName";
$result = mysqli_query($conn, $sql);
?>

<div class="container">
<div style="overflow-x:auto;">
<table class= 'table table-bordered table-striped'>
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Account Number</th>
    <th>BVN Number</th>
    <th>Email Address</th>
    <th>Bank Branch</th>
    <th>Home Address</th>
    <th>Telephone Number</th>
    <th>Account Type</th>
    <th>Balance</th>
    <th>logon</th>
    <th>Credit Card</th>
    <th></th>
    <th></th>
  </tr>
<?php
while ($data = mysqli_fetch_array($result)){
  $bvnnum = $data['BVNNumber'];
  $balance = $data['Balance'];
  $credit = $data['CreditCard'];
  
  if ($type == 4){
    $realValues = new tokenize();
    $bvnnum = $realValues->getToken($data['AccountNumber'], $data['BVNNumber']);
    $balance = $realValues->getToken($data['AccountNumber'], $data['Balance']);
    $credit = $realValues->getToken($data['AccountNumber'], $data['CreditCard']);
  }
  if ($type == 2){
    $realValues = new tokenize();
    $halfCredit = $realValues->getToken($data['AccountNumber'], $data['CreditCard']);
    $firstSix = substr($data['CreditCard'],0,6);
    $lastFour = substr($data['CreditCard'],12,4);
    $middle = substr($halfCredit,6,6);
    $credit = "$firstSix$middle$lastFour";
  }
  if ($type == 3){
    $realValues = new tokenize();
    $bvnnum = $realValues->getToken($data['AccountNumber'], $data['BVNNumber']);
    $balance = $realValues->getToken($data['AccountNumber'], $data['Balance']);
  }
  
  
?>

  <tr>
    <td><a href="detss.php?AccountNumber=<?php echo $data['AccountNumber']; ?>"><?php echo $data['FirstName']; ?></td>
    <td><?php echo $data['LastName']; ?></td>
    <td><?php echo $data['AccountNumber']; ?></td>
    <td><?php echo $bvnnum ?></td>
    <td><?php echo $data['EmailAddress']; ?></td>
    <td><?php echo $data['BankBranch']; ?></td>
    <td><?php echo $data['HomeAddress']; ?></td>
    <td><?php echo $data['TelephoneNumber']; ?></td>
    <td><?php echo $data['AccountType']; ?></td>
    <td>NGN<?php echo $balance; ?></td>
    <td><?php echo $data['logon']; ?></td>
    <td><?php echo $credit; ?></td>
    <td>
      <?php if ($type){ ?>
        <a href="edit.php?AccountNumber=<?php echo $data['AccountNumber']; ?>">Edit</a> <?php } else{echo "";}?>
      </td>
    <td>
    <?php if ($type){ ?>
      <a onclick="return confirm('Are you sure you want to delete?');" href="remove.php?AccountNumber=<?php echo $data['AccountNumber']; ?>">Delete</a><?php } else{echo "";}?></td>
      
   </tr>
   
<?php
} 
?>
</table>
</div>
</div>

</form>
 
  
<!-- <script>
  function confirmation(){
    var result=confirm("Are you sure you want to delete this user?");
  
    if (result) {
      window.location.href = "remove.php?AccountNumber=<?php echo $data['AccountNumber']; ?>";
    } else {
    exit();
    } 
  }
</script>        -->
</body>
</html>