<?php
session_start();
if(!isset($_SESSION)){
  echo 'fail';
    header("location:admin.php");
} else {
?>
<!doctype html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
  <div class="container" style="margin-top: 100px;">
    <div class="col-md-4 col-md-offset-4">
      <center><h1><?=$_SESSION['sess_user'];?><h></center>
        <form action="" method="POST">
            <legend>
            <fieldset>

        RegNo: <input type="number" name="id"><br />

        <input type="submit" value="Delete" name="submit" />

                </fieldset>
                </legend>
        </form>

      <?php
      if(isset($_POST["submit"])){
      if(!empty($_POST['id'])  ) {
          $id=$_POST['id'];
          $con=mysqli_connect('localhost','root','') or die(mysqli_error());
          mysqli_select_db($con, 'bitsat') or die("cannot select DB");

          $query=mysqli_query($con,"SELECT * FROM student WHERE regno='".$id."'");
          $numrows=mysqli_num_rows($query);
          if($numrows!=0)
          {
          $sq="DELETE FROM studentpreference WHERE regno='".$id."'";
          $sql="DELETE FROM student WHERE regno='".$id."'";
          $result=mysqli_query($con,$sql);
              if($result){
          echo "Student Successfully deleted";
          header("Location: admin.php");
          } else {
          echo "Failure!";
          echo $result;
          }

          } else {
          echo "No student found!";
          }

      } else {
          echo "All fields are required!";
      }
      }
      ?>
      <form action="" method="POST">
        <input type="submit" value="Back" name="back" />
      </form>

      <?php
      if(isset($_POST["back"])){
        header("Location: admin.php");
      }
      ?>
    </div>
  </div>
  </body>
</html>
<?php
}
?>
