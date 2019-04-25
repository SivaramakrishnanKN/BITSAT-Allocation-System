
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BITSAT Allocation Portal &mdash; DBS Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


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
                  <h1  data-aos="fade-up" data-aos-delay="100">Your Allotment</h1>


                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="" method="post" class="form-box">


      <?php
      session_start();
      $servername = "localhost";
      $username = "root";
      $password = "";
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

      $pr = "SELECT Campus, BranchName FROM Student,College,CollegeBranch WHERE RegNo=$user and InstiID=College.CollegeID and Student.BranchID=CollegeBranch.BranchID";
      $res =mysqli_query($conn,$pr);
      $rr = mysqli_fetch_row($res);
      echo "Allotment: ";
      echo $rr[0];
      echo " ";
      echo $rr[1];


      ?>


      <?php
      if(isset($_POST["back"])){

        header("Location: student.php");
      }
      ?>



                  </form>
<br>
  <form action="" method="POST" align="center">
        <input type="submit" value="Back" name="back" class="btn btn-primary py-3 px-5 btn-pill"  />
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
