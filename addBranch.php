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
      <center><h1><?=$_SESSION['sess_user'];?><h></center>
        <form action="" method="POST">
            <legend>
            <fieldset>

        BranchID: <input type="text" name="id" placeholder="Enter BranchID"><br />
        Branch Name: <input type="text" name="name" placeholder="Enter Branch Name"><br />
        Total Seats: <input type="number" name="seats" placeholder="Enter total seats"><br />
        Cut off: <input type="number" name="cutoff" placeholder="Enter cut off"><br />

        <input type="submit" value="Add" name="submit" />

                </fieldset>
                </legend>
        </form>

      <?php
      $cid =  $_SESSION['sess_campus'];
      if(isset($_POST["submit"])){
      if(!empty($_POST['id'])  && !empty($_POST['seats']) && !empty($_POST['cutoff']) && !empty($_POST['name']) ) {
          $id=$_POST['id'];
          $seats=$_POST['seats'];
          $cutoff=$_POST['cutoff'];
          $name=$_POST['name'];
          $con=mysqli_connect('localhost','root','') or die(mysqli_error());
          mysqli_select_db($con, 'bitsat') or die("cannot select DB");

          $sql=mysqli_query($con,"SELECT * FROM collegebranch WHERE branchid='".$id."' AND collegeid='".$cid."'");

          $numrows=mysqli_num_rows($sql);
          if($numrows == 0)
          {
            echo $cid;
            echo $id;
            $s= mysqli_query($con,"SELECT * FROM branch WHERE branchid='".$id."'");
            $numrows1=mysqli_num_rows($s);
            if($numrows1 == 0) {
              echo "hey";
              $st="INSERT INTO branch(BranchID, BranchName) VALUES ('$id','$name')";
              $res=mysqli_query($con,$st);
              echo $res;
            }
            $sq="INSERT INTO collegebranch(CollegeID, BranchID, TotalSeats, OccupiedSeats, Cutoff) VALUES ('$cid','$id','$seats','0','$cutoff')";
            $result=mysqli_query($con,$sq);
            if($result) {
              echo "Branch Added";
              $trigger = "CREATE OR REPLACE DEFINER=`root`@`localhost` TRIGGER update_pref
              AFTER INSERT ON CollegeBranch FOR EACH ROW
              BEGIN

                 DECLARE num NUMBER;
                 reg NUMBER;
                 SELECT Count(*) INTO num FROM CollegeBranch;
                 SELECT regno INTO reg from student;
                 INSERT INTO VALUES('regno','$_SESSION['sess_campus']','$_SESSION['sess_branch']','num');
                 INSERT INTO StudentPreference
                   ( RegNo,
                     CollegeID,
                     BranchID,
                     PreferenceNo)
                   VALUES
                   ( reg,
                    $_SESSION['sess_campus'],
                    $_SESSION['sess_branch'],
                    num);
              END;
              ";
              $result=$con->query($trigger);
              echo $result;

              //header("Location: admin.php");
            }
            else {
              echo "Failure";
            }
          } else {
          echo "Branch in that college already exists";
          }

      } else {
          echo "Please enter all fields";
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
?>
<?php
}

?>
