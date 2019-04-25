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

              <input type="radio" name="id" value="P"> Pilani<br>
              <input type="radio" name="id" value="G"> Goa<br>
              <input type="radio" name="id" value="H"> Hyderabad<br><br>
              <input type="submit" name="submit" value="Submit">

                </fieldset>
                </legend>
        </form>

      <?php
      if(isset($_POST["submit"])){
      if(!empty($_POST['id']) ) {
          $id=$_POST['id'];
          echo $_POST['id'];
          $con=mysqli_connect('localhost','root','') or die(mysqli_error());
          mysqli_select_db($con, 'bitsat') or die("cannot select DB");
          $_SESSION['sess_campus']=$id;
          // $sql=mysqli_query($con,"SELECT CollegeID FROM college WHERE campus='".$id."'");
          // $numrows=mysqli_num_rows($sql);
          // if($numrows != 0)
          // {
          //   $row = mysqli_fetch_row($sql);
          //   echo "Campus - ".$id."<br>";
          //   echo "CollegeID - ".$row[0]."<br>";
          //   $_SESSION['sess_campus']=$row[0];
          //   $sq=mysqli_query($con,"SELECT BranchID,TotalSeats,OccupiedSeats FROM collegebranch WHERE collegeid='".$row[0]."' GROUP BY BranchID");
          //   $numrows1=mysqli_num_rows($sq);
          //   if($numrows1!=0) {
          //     while($numrows1 != 0) {
          //       $row1 = mysqli_fetch_row($sq);
          //       echo "BranchID: ".$row1[0];
          //       echo "    Total Seats: ".$row1[1];
          //       echo "    Occupied Seats: ".$row1[2]."<br>";
          //       $numrows1 = $numrows1-1;
          //     }
          //
          //   }
          //   else {
          //     echo "College has no branches";
          //   }
          // } else {
          // echo "No college found";
          // }
          header("Location: Institute.php");
      } else {
          echo "Please enter a campus";
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
