<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:login.php");
} else {
?>

<?php
	$conn = new mysqli("localhost", "root", "", "bitsat");

    if (isset($_POST['update'])) {
        foreach($_POST['positions'] as $position) {
           $branch = $position[0];
           $college = $position[1];
           $newPosition = $position[2];
           $sql = "UPDATE StudentPreference SET PreferenceNo = '$newPosition' WHERE CollegeId='$college' and BranchID='$branch'";
           $result=mysqli_query($conn,$sql);
           if($result){
             echo "Updated Successfully";
           }
        }

        exit('success');
    }
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

      <table class="table table-striped table-hover table-bordered">
        <caption>Preference List</caption>
        <thead>
          <tr>
            <td>Campus</td>
            <td>Branch</td>
            <td>Cut Off</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $dbhost = "localhost";
          $username = "root";
          $password = "";
          $db = "bitsat";
          $con = mysqli_connect($dbhost, $username, $password, $db);
          // Check connection
          if (!$con) {
              die("Connection failed: " . mysqli_connect_error());
          }
          $user = $_SESSION['sess_user'];
          $sql = $con->query("SELECT Campus, BranchName, TotalSeats, Cutoff, Branch.BranchID as Bid, College.CollegeID as Cid, StudentPreference.PreferenceNo as Pno from College, Branch, CollegeBranch, StudentPreference where CollegeBranch.CollegeID=College.CollegeID and CollegeBranch.BranchID=Branch.BranchID and StudentPreference.CollegeID=College.CollegeID and StudentPreference.BranchID=Branch.BranchID and StudentPreference.RegNo=$user order by PreferenceNo");
          while($data = $sql->fetch_array()) {
            echo '
              <tr data-position="'.$data['Pno'].'"  data-branch="'.$data['Bid'].'" data-college="'.$data['Cid'].'">
                <td>'.$data['Campus']. '</td>
                <td>'.$data['BranchName']. '</td>
                <td>'.$data['Cutoff']. '</td>
              </tr>
            ';
          }
           ?>
        </tbody>
      </table>
      <form action="" method="POST">
        <input type="submit" value="Back" name="back" />
      </form>

      <?php
      if(isset($_POST["back"])){
        header("Location: member.php");
      }
      ?>
    </div>

  </div>


  <script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>

  <script type="text/javascript">
      $(document).ready(function () {
         $('table tbody').sortable({
             update: function (event, ui) {
                 $(this).children().each(function (index) {
                      if ($(this).attr('data-position') != (index+1)) {
                          $(this).attr('data-position', (index+1)).addClass('updated');
                      }
                 });
                 saveNewPositions();
             }
         });
      });

      function saveNewPositions() {
          var positions = [];
          $('.updated').each(function () {
             positions.push([$(this).attr('data-branch'),$(this).attr('data-college'), $(this).attr('data-position')]);
             $(this).removeClass('updated');
          });

          $.ajax({
             url: 'PreferenceList.php',
             method: 'POST',
             dataType: 'text',
             data: {
                 update: 1,
                 positions: positions
             }, success: function (response) {
                  console.log(response);
             }
          });
      }
  </script>

</body>

</html>
<?php
}
?>
