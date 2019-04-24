<!doctype html>
<html>
<head>
<title>Register</title>
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
            h1 {
    color: indigo;
    font-family: verdana;
    font-size: 100%;
}
         h2 {
    color: indigo;
    font-family: verdana;
    font-size: 100%;
}</style>
</head>
<body>

    <center><h1>CREATE REGISTRATION AND LOGIN FORM USING PHP AND MYSQL</h1></center>
   <p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>
    <center><h2>Registration Form</h2></center>
<form action="" method="POST">
    <legend>
    <fieldset>

RegistrationNo: <input type="number" name="id"><br />
Password: <input type="password" name="pass"><br />
Email: <input type="email" name="email"><br />
Date of Birth: <input type="date" name="dob"><br />
Name: <input type="text" name="name"><br />
Physics: <input type="number" name="phy"><br />
Chemistry: <input type="number" name="chem"><br />
Maths: <input type="number" name="math"><br />

<input type="submit" value="Register" name="submit" />

        </fieldset>
        </legend>
</form>
<?php
if(isset($_POST["submit"])){
if(!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['id']) && !empty($_POST['email']) && !empty($_POST['dob']) && !empty($_POST['phy']) && !empty($_POST['chem'])&& !empty($_POST['math'])) {
    $name=$_POST['name'];
    $pass=$_POST['pass'];
    $id=$_POST['id'];
    $email=$_POST['email'];
    $dob=$_POST['dob'];
    $phy=$_POST['phy'];
    $chem=$_POST['chem'];
    $math=$_POST['math'];
    $total = $math+$phy+$chem;
    $con=mysqli_connect('localhost','root','root') or die(mysqli_error());
    mysqli_select_db($con, 'bitsat') or die("cannot select DB");

    $query=mysqli_query($con,"SELECT * FROM Student WHERE regno='".$id."' or Email='".$email."'");
    $numrows=mysqli_num_rows($query);
    if($numrows==0)
    {
    $sql="INSERT INTO student(RegNo, Name, Email, Password, DOB, MarksPhy, MarksChem, MarksMath, Total) VALUES ('$id','$name', '$email', '$pass', '$dob', '$phy', '$chem', '$math', '$total')";

    $result=mysqli_query($con,$sql);
        if($result){
    session_start();
    $_SESSION['sess_user']=$id;
    header("Location: rank.php");
    echo "Account Successfully Created";


    } else {
    echo "Failure!";
    echo $result;
    }

    } else {
    echo "That Registration number already exists! Please try again with another.";
    }

} else {
    echo "All fields are required!";
}
}
?>


</body>
</html>
