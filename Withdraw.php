<?php
session_start();
if(!isset($_SESSION['with_user'])){
  echo 'fail';
    header("location:member.php");
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
$sql1 = "DELETE FROM Student WHERE RegNo=$user";
mysqli_query($conn, $sql1);

echo 'Deleted';


if(isset($_POST["back"])){
  header("Location: login.php");
}


?>
<?php
}

?>
