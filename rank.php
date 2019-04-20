<?php
session_start();
if(!isset($_SESSION["sess_user"])){
  echo 'fail';
    header("location:login.php");
} else {
?>
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
$sql1 = "select RegNo from Student order by Total desc, MarksPhy desc, MarksMath desc, MarksChem desc";
$result = $conn->query($sql1);
while ($row=mysqli_fetch_row($result))
{
  $num = $num+1;
  $sql = "UPDATE Student SET Rank=$num WHERE RegNo = $row[0]";
  if ($conn->query($sql) === TRUE) {

  } else {
      echo "Error updating record: " . $conn->error;
  }
}
$user = $_SESSION['sess_user'];
$sql2 = "select CollegeID, BranchID from CollegeBranch";
$res = $conn->query($sql2);
$num = 0;
while ($row=mysqli_fetch_row($res))
{
  $num = $num+1;
  $sql = "INSERT INTO StudentPreference(RegNo, CollegeID, BranchID, PreferenceNo) VALUES('$user', '$row[0]', '$row[1]', '$num')";

  if ($conn->query($sql) === TRUE) {

  } else {
      echo "Error updating record: " . $conn->error;
  }
}
  session_start();
  unset($_SESSION['sess_user']);
  session_destroy();
  header("location:login.php");
 ?>
 <?php
 }

 ?>
