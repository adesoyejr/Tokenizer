<?php
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
     <img src=".\img\fcmb.png" class="w3-round" alt="FCMB" width="50" height="50" style="float:right"> 
     <img src=".\img\lumenave.png" class="w3-round" alt="Lumenave" width="100" height="50" style="float:left">
    <p>Bank Users' Details</p>
  </div>
  </center>
</div>

<hr>

<div class="container">
  <button class="btn btn-success" float-left onclick="window.location.href='add.php'">Add New User Details</button>
  <button class="btn btn-info" float-left onclick="window.location.href='iteller.php'">Go to iTeller</button>
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
  $realbvn = new tokenize();
  $bvnnum = $realbvn->deToken($data['AccountNumber'], $data['BVNNumber']);
?>

  <tr>
    <td><a href="detss.php?AccountNumber=<?php echo $data['AccountNumber']; ?>"><?php echo $data['FirstName']; ?></td>
    <td><?php echo $data['LastName']; ?></td>
    <td><?php echo $data['AccountNumber']; ?></td>
    <td><?php if ($type){echo $bvnnum;}else{echo "**********";} ?></td>
    <td><?php echo $data['EmailAddress']; ?></td>
    <td><?php echo $data['BankBranch']; ?></td>
    <td><?php echo $data['HomeAddress']; ?></td>
    <td><?php echo $data['TelephoneNumber']; ?></td>
    <td><?php echo $data['AccountType']; ?></td>
    <td>NGN<?php echo $data['Balance']; ?></td>
    <td><?php echo $data['logon']; ?></td>
    <td><?php if ($type){echo $data['CreditCard'];}else{echo "**********";} ?></td>
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