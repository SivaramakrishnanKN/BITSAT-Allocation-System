<?php
if(isset($_POST["submit"])){
if(!empty($_POST['name']) && !empty($_POST['pass']) && !empty($_POST['id']) && !empty($_POST['email']) && !empty($_POST['dob']) && !empty($_POST['phy']) && !empty($_POST['chem'])&& !empty($_POST['math'])) {
  if($_POST['phy']>150||$_POST['phy']<0||$_POST['math']>150||$_POST['math']<0||$_POST['chem']>150||$_POST['chem']<0) 
{
echo "Invalid marks";
}else{
   $name=$_POST['name'];
    $pass=$_POST['pass'];
    $id=$_POST['id'];
    $email=$_POST['email'];
    $dob=$_POST['dob'];
    $phy=$_POST['phy'];
    $chem=$_POST['chem'];
    $math=$_POST['math'];
    $total = $math+$phy+$chem;
    $con=mysqli_connect('localhost','root','') or die(mysqli_error());
    mysqli_select_db($con,'bitsat') or die("cannot select DB");

    $query=mysqli_query($con,"SELECT * FROM Student WHERE regno='".$id."' or email='".$email."'");
    $numrows=mysqli_num_rows($query);
    if($numrows==0)
    {
    $sql="INSERT INTO student(RegNo, Name, Email, Password, DOB, MarksPhy, MarksChem, MarksMath, Total) VALUES ('$id','$name','$email', '$pass', '$dob', '$phy', '$chem', '$math', '$total')";
    $result=mysqli_query($con,$sql);
    if($result){
    session_start();
    $_SESSION['sess_user']=$id;
    header("Location: rank.php");
    echo "Account Successfully Created";
    
    //header("Location: login.html");
    } 
    else 
    {
    echo "Failure!";
    echo $result;
    }
    } else {
    echo "Registration number/Email ID already exists";
    }
}
}else{
    echo "All fields are required!";
}
}
?>
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
                  <small style="color:white;">Already registered?</small>
                <li class="cta"><a href="login.php" class="nav-link"><span>Login</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>

    </header>

    <div class="intro-section" id="home-section">

      <div class="slide-1" style="background-image: url('images/Reg.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                  <h1  data-aos="fade-up" data-aos-delay="100">Welcome to BITSAT Allocation Portal</h1>
                  <p class="mb-4"  data-aos="fade-up" data-aos-delay="200">Log on and access your portfolio and application preferences.</p>

                </div>

                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <form action="" method="post" class="form-box">
                    <h3 class="h4 text-black mb-4">Sign Up</h3>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control" placeholder="Registration Number" name="id">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email Addresss" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="pass">
                    </div>
                    <!--<div class="form-group mb-4">
                      <input type="password" class="form-control" placeholder="Re-type Password" name="pass2">
                    </div>-->
                    <div class="form-group">
                      <input class="form-control" type="date" value="2000-01-01" name="dob">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                          <input type="number" class="form-control" placeholder="Physics" name="phy">
                        </div>
                        <div class="form-group col-lg-4">
                          <input type="number" class="form-control" placeholder="Chemistry" name="chem">
                        </div>
                        <div class="form-group col-lg-4">
                          <input type="number" class="form-control" placeholder="Math" name="math">
                        </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-pill" value="Sign up" name="submit">
                    </div>
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
