
<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:student.php");
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



      <?php
      if(isset($_POST["back"])){

        header("Location: student.php");
      }
      ?>

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



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BITSAT Allocation Portal &mdash; DBS Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="">BITSAT Allocation Portal</a></div>

          <!--<div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#courses-section" class="nav-link">Preferences</a></li>
                <li><a href="#programs-section" class="nav-link">About BITS</a></li>
                <li><a href="#teachers-section" class="nav-link">Our Team</a></li>
              </ul>
            </nav>
        </div>-->


          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <!--<li class="cta"><a href="register.html" class="nav-link"><span>Register</span></a></li>-->
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>

    </header>

    <div class="intro-section" id="home-section">

      <div class="slide-1" style="background-image: url('images/bits.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">Your Preferences</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Here you can edit your preferences.</p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                   <form action="" method="post" class="form-box">
                  <!--<form action="" method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Login</h3>
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email Addresss" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="pass">
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-pill" value="Login" name="SUBMIT">
                    </div>
                  </form>-->
 <table class="table table-striped table-hover table-bordered">
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
          $sql = $con->query("SELECT Campus, BranchName, TotalSeats, Cutoff, CollegeBranch.BranchID as Bid, College.CollegeID as Cid, StudentPreference.PreferenceNo as Pno from College, CollegeBranch, StudentPreference where CollegeBranch.CollegeID=College.CollegeID and StudentPreference.CollegeID=College.CollegeID and StudentPreference.BranchID=CollegeBranch.BranchID and StudentPreference.RegNo=$user order by PreferenceNo");
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
    </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>


</div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>


  <script src="js/main.js"></script>

  </body>
</html>
