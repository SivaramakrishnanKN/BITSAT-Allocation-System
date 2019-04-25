<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:login.php");
} else {
?>


    <?php
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
      $user = $_SESSION['sess_user'];
      unset($_SESSION['sess_campus']);
      // $sql = "select Name, Rank from Student WHERE RegNo = $user";

      // $result = $conn->query($sql);
      // $row = mysqli_fetch_row($result);
      // echo "Name: ".$row[0]."<br>";
      // echo "Rank: ".$row[1];
      // $_SESSION['sess_name']=$row[0];
    ?>

    <?php
    if(isset($_POST["view_inst"])){
      header("Location: viewInstitute.php");
    }
    ?>
    <?php
    if(isset($_POST["del"])){
      header("Location: deleteUser.php");
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <title>BITSAT &mdash; DBS</title>
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
      <style>
        .tac {
          text-align: center;
          margin: auto;
        }
      </style>


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
              <div class="site-logo mr-auto w-25"><a href="index.html">BITSAT Allocation Portal</a></div>

              <div class="mx-auto text-center">
                <nav class="site-navigation position-relative text-right" role="navigation">
                  <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                    <li><a href="#home-section" class="nav-link">Home</a></li>
                    <li><a href="#courses-section" class="nav-link">Campuses</a></li>
                    <li><a href="#programs-section" class="nav-link">About BITS</a></li>
                    <li><a href="#teachers-section" class="nav-link">Our Team</a></li>
                  </ul>
                </nav>
              </div>

              <div class="ml-auto w-25">
                <nav class="site-navigation position-relative text-right" role="navigation">
                  <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                    <li class="cta"><a href="logout.php" class="nav-link"><span>Log Out</span></a></li>
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
                    <div class="">
                      <h1  data-aos="fade-up" data-aos-delay="100">Welcome Admin</h1>
                      <p data-aos="fade-up" data-aos-delay="300">
                        <!--					<form method="post">

                          <a href="" class="btn btn-primary py-3 px-5 btn-pill" name="add_inst">Add Institute</a>
                          <a href="" class="btn btn-primary py-3 px-5 btn-pill" style="margin-left:15px;" name="del">Delete User</a>
                          <a href="" class="btn btn-primary py-3 px-5 btn-pill" style="margin-left:15px;" name="view_inst">View Institute</a>

                          <div class="form-row">
                            <div class="form-group col-lg-4">
                              <input type="submit" value="Add Institute" name="add_inst" class="btn btn-primary py-3 px-5 btn-pill"/>
                            </div>
                            <div class="form-group col-lg-4">
                              <input type="submit" value="Delete User" name="del" class="btn btn-primary py-3 px-5 btn-pill"/>
                            </div>
                            <div class="form-group col-lg-4">
                              <input type="submit" value="View Institute" name="view_inst" class="btn btn-primary py-3 px-5 btn-pill"/>
                            </div>
                            <!--
                              <input type="submit" value="Add Institute" name="add_inst" class="btn btn-primary py-3 px-5 btn-pill"/>
                              <input type="submit" value="Delete User" name="del" class="btn btn-primary py-3 px-5 btn-pill"/>
                              <input type="submit" value="View Institute" name="view_inst" class="btn btn-primary py-3 px-5 btn-pill"/>

                            </div>
                          </form>-->
                          <form method="post" action ="">
                            <div class="container" >
                              <div class="nav-spacer">.</div>
                              <div class="card-deck-wrapper spacer" >
                                <div class="card-deck bg-dark text-white mx-auto" >
                                  <div class="card bg-secondary" style="width: 300px">
                                    <button type="text" class="btn btn-info btn-block" name="del" value="P">
                                      <img class="card-img-top" src="images/student.png" alt="Card image">
                                      <div class="card-block">
                                        <h4 class="card-title tac"><i class="fa fa-paw"></i>Delete User</h4>
                                      </div>
                                    </button>
                                  </div>
                                  <div class="card bg-secondary" style="width: 300px">
                                    <button type="text" class="btn btn-info btn-block" name="view_inst" value="P">
                                      <img class="card-img-top" src="images/campus.png" alt="Card image">
                                      <div class="card-block">
                                        <h4 class="card-title tac"><i class="fa fa-paw"></i>View Institute</h4>
                                      </div>
                                    </button>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </form>
                        </p>
                        <!--                  <p data-aos="fade-up" data-aos-delay="300"><a href="#" class="btn btn-danger py-3 px-5 btn-pill">Withdraw</a></p>-->

                      </div>
                      <!--

                        <form action="" method="POST">
                          <input type="submit" value="Add Institute" name="add_inst" />
                          <input type="submit" value="Delete User" name="del" />
                          <input type="submit" value="View Institute" name="view_inst" />
                        </form>

                      -->

                      <!--
                        <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                          <form action="" method="post" class="form-box">
                            <h3 class="h4 text-black mb-4">Sign Up</h3>
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Email Addresss">
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group mb-4">
                              <input type="password" class="form-control" placeholder="Re-type Password">
                            </div>
                            <div class="form-group">
                              <input type="submit" class="btn btn-primary btn-pill" value="Sign up">
                            </div>
                          </form>

                        </div>
                      -->
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


          <footer class="footer-section bg-white">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <h3>About Our Project</h3>
                  <p>This Project aims to emulate the allotment process for the prestigious BITSAT examination.</p>
                </div>

                <div class="col-md-3 ml-auto">
                  <h3>Links</h3>
                  <ul class="list-unstyled footer-links">
                    <li><a href="#home-section">Home</a></li>
                    <li><a href="#courses-section">Campuses</a></li>
                    <li><a href="#programs-section">About BITS</a></li>
                    <li><a href="#teachers-section">Our Team</a></li>
                  </ul>
                </div>

              </div>


            </div>
          </footer>



        </div> <!-- .site-wrap -->

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
<?php
}
?>
