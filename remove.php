<?php
require_once('connection.php');
session_start();
$username=$_SESSION['username'];
$type = $_SESSION['type'];

$AccountNumber = $_GET['AccountNumber'];
var_dump($AccountNumber);
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

<?php

$command = "delete from staffdata where AccountNumber = '$AccountNumber'";
$del = mysqli_query($conn, $command);

if($del)
{
    mysqli_close($conn);
    var_dump($del);
    //var_dump($AccountNumber);
    header("location:index.php");
    exit();	
}
else
{
    header("location:add.html");
    // echo "Error deleting record";
}
?>
</body>
</html>