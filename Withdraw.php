<?php
session_start();
if(!isset($_SESSION['with_user'])){
  echo 'fail';
    header("location:allotment.php");
} else {
?>
<form action="" method="POST">
  <input type="submit" value="Back" name="back" />
</form>

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
$user = $_SESSION['with_user'];
echo $user;
echo "Gayyy  ";

$sql = "DELETE FROM StudentPreference WHERE RegNo=$user";
mysqli_query($conn, $sql);
$pr = "SELECT MarksPhy, MarksChem, MarksMath, Rank, Total FROM Student WHERE RegNo=$user";
$res = mysqli_query($conn,$pr);
$rr = mysqli_fetch_row($res);
$sql1 = "DELETE FROM Student WHERE RegNo=$user";
$sq = "DELETE FROM totalmarks WHERE MarksPhy=$rr[0] AND MarksChem=$rr[1] AND MarksMath=$rr[2]";
$sqs = "DELETE FROM rankallotment WHERE RegNo=$user";
$sqq = "DELETE FROM allotment WHERE Rank=$rr[3]";
mysqli_query($conn, $sq);
mysqli_query($conn, $sqs);
mysqli_query($conn, $sqq);
mysqli_query($conn, $sql1);

echo 'Deleted';
header("Location: rank.php");


if(isset($_POST["back"])){
  header("Location: login.php");
}


?>
<?php
}

?>
