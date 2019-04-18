<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bitsat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$num = 0;
$sql = "select RegNo from Student order by Total desc, MarksPhy desc, MarksMath desc, MarksChem desc";
$result = $conn->query($sql);
while ($row=mysqli_fetch_row($result))
{
  $num = $num+1;
  $sql = "UPDATE Student SET Rank=$num WHERE RegNo = $row[0]";
  if ($conn->query($sql) === TRUE) {
      
  } else {
      echo "Error updating record: " . $conn->error;
  }
}



 ?>
