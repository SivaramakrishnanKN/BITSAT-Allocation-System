<?php
  $dbhost = "localhost";
  $username = "root";
  $password = "root";
  $db = "bitsat";
  $con = mysqli_connect($dbhost, $username, $password, $db);
  // Check connection
  if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected";
?>
