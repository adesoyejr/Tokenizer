<?php

$conn = new mysqli('localhost', 'root', '', 'rand');

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }         
?>