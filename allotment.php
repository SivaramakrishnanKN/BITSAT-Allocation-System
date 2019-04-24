<?php
session_start();
if(!isset($_SESSION)){
  echo 'fail';
    header("location:student.php");
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

</head>


<body>
  <div class="container" style="margin-top: 100px;">
    <div class="col-md-4 col-md-offset-4">
      <center><h1><?=$_SESSION['sess_name'];?><h></center>


      <?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "bitsat";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $num = 0;
      $sql1 = "select RegNo from Student order by Rank asc";
      $result = $conn->query($sql1);
      mysqli_query($conn, "UPDATE CollegeBranch SET OccupiedSeats=0");

      while ($row=mysqli_fetch_row($result))
      {

        $reg = $row[0];
        $q = "SELECT StudentPreference.RegNo,StudentPreference.CollegeID, StudentPreference.BranchID, TotalSeats, OccupiedSeats, PreferenceNo, Total FROM StudentPreference, CollegeBranch,Student where StudentPreference.CollegeID=CollegeBranch.CollegeID and StudentPreference.BranchID=CollegeBranch.BranchID and Student.RegNo=$reg and StudentPreference.RegNo=$reg order by PreferenceNo";
        $res=$conn->query($q);
        while($r=mysqli_fetch_row($res))
        {

            if($r[4]<$r[3])
            {
              $sql1 = "UPDATE Student SET InstiID='$r[1]', BranchID='$r[2]' WHERE RegNo=$r[0]";
              $sql2 = "UPDATE CollegeBranch SET OccupiedSeats=OccupiedSeats+1 WHERE CollegeID='$r[1]' and BranchID='$r[2]'";
              $re=mysqli_query($conn,$sql1);
                  if($re){
                    $re1=mysqli_query($conn,$sql2);
                    if($re1){
                      if($r[4]==$r[3]-1)
                      {
                        $sql5 = "UPDATE CollegeBranch SET curcutoff=$r[6] WHERE BranchID='$r[2]' and CollegeID='$r[1]'";
                        $r1=mysqli_query($conn,$sql5);
                      }
                    }
                  else {
                    echo "Failure!";
                    echo $re1;
                  }
                  break;
                  }
               else {
              echo "Failure!";
              echo $re;
              }
            }
        }
      }

      $user = $_SESSION['sess_user'];

      $pr = "SELECT Campus, BranchName FROM Student, College, Branch WHERE RegNo=$user and InstiID=CollegeID and Student.BranchID=Branch.BranchID";
      $res = $conn->query($pr);
      $rr = mysqli_fetch_row($res);
      echo "Allotment: ";
      echo $rr[0];
      echo " ";
      echo $rr[1];


      ?>
      <form action="" method="POST">
        <input type="submit" value="Back" name="back" />
      </form>

      <?php
      if(isset($_POST["back"])){

        header("Location: student.php");
      }
      ?>
    </div>
  </div>
  </body>
</html>

<?php
}
?>
