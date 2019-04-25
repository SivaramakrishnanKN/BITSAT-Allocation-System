<?php
session_start();
if(!isset($_SESSION['sess_branch'])){
  echo 'fail';
    header("location:Institute.php");
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
$bid = $_SESSION['sess_branch'];
$cid = $_SESSION['sess_campus'];
$sql2 = "select RegNo from Student";
$res = $conn->query($sql2);
$sql3 = "select count(*) from CollegeBranch";
$res1 = $conn->query($sql2);
$num = mysqli_fetch_row($res1);

while ($row=mysqli_fetch_row($res))
{
  $sql = "DELETE FROM StudentPreference WHERE BranchID = $bid and CollegeID = $cid";

  if ($conn->query($sql) === TRUE) {
    header("Location: Institute.php");

  } else {
      echo "Error updating record: " . $conn->error;
  }
}
 ?>
<?php
}

?>
