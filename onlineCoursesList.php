<?php
// if goes here php on top 
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HSE Training</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">HSE Training</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
          <div class="btn-group">          
  <button  type="button" class="btn-sm btn-success  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?php if (isset ($_SESSION['first'])){
    echo $_SESSION['first']; ?>
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="mycourses.php">My Courses</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="accountinfo.php">Account information</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="signout.controllers.php">Sign out</a>
  </div>
  </div>

          </li>
  <?php } ?>
  
  
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/HSSE.png'); height:300px">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h2> We are Building HSE profissionais</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

 <!-- Main Content -->
 <?php if (isset ($_SESSION['first'])){ ?> 
  <h1 style="text-align: center;">Online Courses Available</h1>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Course name</th>
      <th scope="col">total hours</th>
      <th scope="col">cost</th>
    </tr>
    </thead>

  <?php
  include_once 'dbconn.php';
  $sql= "SELECT * FROM onlinelist;";
  $result = mysqli_query ($conn , $sql);
  $rowsnumber= mysqli_num_rows($result);
  if ($rowsnumber>0) {

  while ($row = mysqli_fetch_assoc ($result)) {
    echo'<tbody>
      <tr>
      <th>'.$row['online_id']. '</th>
      <td> <a href="OnlineCoursesShow.php?onlinenumber='.$row['online_id'].'">'.$row['online_name'].'</a> </td>
      <td>'.$row['online_hrs']. 'hrs  </td>
      <td>'.$row['online_cost'].'$  </td>
    </tr>
    </tbody>
    ';
  
 } 
} else {echo' <table> No courses available! </table>';
}?> 
 </table>

 <?php } 

 else {
header ("Location: signin.php");
}?>
 




  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; HSE Training 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>


</html>
