<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:login.php");
} else {
?>
<!doctype html>
<html>
<head>
<title>Welcome</title>
    <style>
        body{

    margin-top: 100px;
    margin-bottom: 100px;
    margin-right: 150px;
    margin-left: 80px;
    background-color: azure ;
    color: palevioletred;
    font-family: verdana;
    font-size: 100%

        }
            h2 {
    color: indigo;
    font-family: verdana;
    font-size: 100%;
}
        h1 {
    color: indigo;
    font-family: verdana;
    font-size: 100%;
}


    </style>
</head>
<body>
    <center><h1>CREATE REGISTRATION AND LOGIN FORM USING PHP AND MYSQL</h1></center>

<h2>Welcome, <?=$_SESSION['sess_user'];?>! <a href="logout.php">Logout</a></h2>
<p>
WE DO IT. SUCCESSFULLY CREATED REGISTRATION AND LOGIN FORM USING PHP AND MYSQL
</p>
<h2>Registration Number <?=$_SESSION['sess_user']?></h2>

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
$user = $_SESSION['sess_user'];
$sql = "select Name, Rank from Student WHERE RegNo = $user";

$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
echo "Name: ".$row[0]."<br>";
echo "Rank: ".$row[1];
?>
</body>
</html>
<?php
}
?>
