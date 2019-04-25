<?php
session_start();
if(!isset($_SESSION['sess_branch'])){
  echo 'fail';
    header("location:Institute.php");
} else {
?>

  <?php
      $cid=$_SESSION['sess_campus'];
      $id = $_SESSION['sess_branch'];
          $con=mysqli_connect('localhost','root','') or die(mysqli_error());
          mysqli_select_db($con, 'bitsat') or die("cannot select DB");

          $sql=mysqli_query($con,"SELECT * FROM CollegeBranch WHERE BranchId='".$id."' AND CollegeId='".$cid."'");
          $numrows=mysqli_num_rows($sql);
          $row=mysqli_fetch_assoc($sql);
          if($numrows != 0)
          {
            $c= $row['CollegeID'];
            $b= $row['BranchID'];
            echo $c;
            echo $b;
            $s = "DELETE FROM StudentPreference WHERE BranchId='".$b."' AND CollegeId='".$c."'";
            $res=mysqli_query($con,$s);
            echo $res;
            $sq="DELETE FROM CollegeBranch WHERE BranchId='".$b."' AND CollegeId='".$c."' ";
            $ret=mysqli_query($con,$sq);
            echo $ret;
            if($ret) {
              echo "Branch Deleted";
              header("Location: Institute.php");
            }
            else {
              echo "Failure";
            }
          }
      ?>
?>
<?php
}
