<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

        <title>Login</title>

        <style>
            body {
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
        h3 {
    color: indigo;
    font-family: verdana;
    font-size: 100%;
} </style>
</head>
<body>
     <center><h1>CREATE REGISTRATION AND LOGIN FORM USING PHP AND MYSQL</h1></center>
   <p><a href="register.php">Register</a> | <a href="login.php">Login</a></p>
<h3>Login Form</h3>
<form action="" method="POST">
Email: <input type="email" name="email"><br />
Password:            <input type="password" name="pass"><br />
<input type="submit" value="Login" name="submit" />
</form>
<?php
if(isset($_POST["submit"])){

                if(!empty($_POST['email']) && !empty($_POST['pass'])) {
                    $email=$_POST['email'];
                    $pass=$_POST['pass'];

                    $con=mysqli_connect('localhost','root','root') or die(mysqli_error());
                    mysqli_select_db($con, 'bitsat') or die("cannot select DB");

                    $query=mysqli_query($con,"SELECT * FROM student WHERE email='".$email."' AND password='".$pass."'");
                    $numrows=mysqli_num_rows($query);
                    if($numrows!=0) {
                        while($row=mysqli_fetch_assoc($query)) {
                            $dbemail=$row['Email'];
                            $dbpassword=$row['Password'];
                            $dbuser=$row['RegNo'];
                        }

                        if($email == $dbemail && $pass == $dbpassword) {
                        session_start();
                        $_SESSION['sess_email']=$email;
                        $_SESSION['sess_user']=$dbuser;

                        /* Redirect browser */
                        header("Location: member.php");
                        }
                    } else {
                        echo "Invalid username or password!";
                    }

                } else {
                    echo "All fields are required!";
                }
            }
        ?>
    </body>
</html>
