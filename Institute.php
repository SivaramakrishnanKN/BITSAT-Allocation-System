<?php
session_start();
if(!isset($_SESSION['sess_campus'])){
  echo 'fail';
    header("location:viewInstitute.php");
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

      <form action="" method="POST">
      <?php

        $id=$_SESSION['sess_campus'];

        $con=mysqli_connect('localhost','root','') or die(mysqli_error());
        mysqli_select_db($con, 'bitsat') or die("cannot select DB");

        $sql=mysqli_query($con,"SELECT Campus FROM college WHERE CollegeID='".$id."'");
        $numrows=mysqli_num_rows($sql);
          $row = mysqli_fetch_row($sql);
          echo "<center><h1>$row[0]<h></center><br>";
          $sq=mysqli_query($con,"SELECT BranchID,TotalSeats,OccupiedSeats FROM collegebranch WHERE collegeid='".$id."' GROUP BY BranchID");
          $numrows1=mysqli_num_rows($sq);
          if($numrows1!=0) {
            while($numrows1 != 0) {
              $row1 = mysqli_fetch_row($sq);
              echo "BranchID: ".$row1[0];
              echo "    Occupied Seats: ".$row1[2];
              echo "    Total Seats: ".$row1[1] ;
              echo '<button type="submit" value="'.$row1[0].'" name="Delete" />Delete</button>'."<br>";
              $numrows1 = $numrows1-1;
            }
          }
          else {
            echo "College has no branches";
          }
      ?>
              </form>

      <form action="" method="POST">
        <input type="submit" value="Add Branch" name="add" />
        <input type="submit" value="Back" name="back" />
      </form>

      <?php
      if(isset($_POST['Delete'])){
        $_SESSION['sess_branch'] = $_POST['Delete'];
        header("Location: deleteBranch.php");
      }
      ?>
      <?php
      if(isset($_POST["add"])){
        header("Location: addBranch.php");
      }
      ?>

      <?php
      if(isset($_POST["back"])){
        header("Location: viewInstitute.php");
      }
      ?>
    </div>
  </div>
  </body>
</html>
<?php
}
?>
