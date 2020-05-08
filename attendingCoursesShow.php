<?php
session_start ();
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

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
 <?php
 if (isset ($_SESSION['first'])){ 
  
  include_once 'dbconn.php';
  $courseid= $_GET['attendnumber'];
  $sql= "SELECT attend_id, attend_name, attend_hrs, attend_cost, attend_tutor, attend_place, attend_desc,slider_images 
  FROM attendlist WHERE attend_id='$courseid';";
  $result = mysqli_query ($conn , $sql);

  while ($row = mysqli_fetch_assoc ($result)) {?>

    <div class="container">
    <div class="row">
      <div class="col">
       
 <ul class="list-group">
    <li class="list-group-item ">
        <h4>Program Name</h4>
       <?php echo'<p>'.$row['attend_name'].'</p>';?>
    </li>
    <li class="list-group-item ">
        <h4>Tutor:</h4>
        <?php echo'<p>'.$row['attend_tutor'].'</p>';?>
    </li>
    <li class="list-group-item ">
        <h4>Place:</h4>
        <?php echo'<p>'.$row['attend_place'].'</p>';?>
    </li>
    <li class="list-group-item">
        <h4>Total Days / Hours:</h4>
        <?php echo'<p>'.$row['attend_hrs'].'</p>';?>
    
    </li>
    <li class="list-group-item">
        <h4>Cost:</h4>
        <?php echo'<p>'.$row['attend_cost'].' $</p>';?>
        

    </li>
    <li class="list-group-item">
        <h4>Course Description:</h4> 
        <?php echo'<p>'.$row['attend_desc'].'</p>';?>
        </li>
  </ul>
</div>
<div class="col">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php $filesNames=explode("," , $row['slider_images']);
        $total= count($filesNames);
        for($i=0 ; $i<$total ; $i++){ ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i?>"></li>
<?php } ?>
        </ol>


<div class="carousel-inner">

<?php


for($i=0 ; $i<$total ; $i++){ ?>

<div class="carousel-item">
<?php echo'<img class="d-block w-100" style= "height: 300px; width: 500px" src="sliders/'.$filesNames[$i].'" alt="First slide">';?>
</div>

<?php } ?>
</div>

<script>
    $(function () {
        $(".carousel-item").first().addClass("active");
        $("ol.carousel-indicators").find("li").eq(0).addClass("active");
    });
</script>

<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div><br>

      <form action="enroll.controller.php" id="contactForm" method="POST">
      <input type="hidden" name="coursenumber" value="<?PHP echo $row['attend_id']; ?> ">
      <div><button type="submit" name="submit-enroll" class="btn btn-danger" id="sendMessageButton"
      
      <?php

$coursenumber=$row['attend_id'];
$userid= $_SESSION['userid'];
$sql="SELECT userattendID FROM user_attend_course WHERE userID='$userid' AND  attendID='$coursenumber';";
$result= mysqli_query($conn , $sql);
$resultcheck= mysqli_num_rows($result);



if ($resultcheck<1){
  echo '';
  
  
} else {

  echo 'disabled';

}
 ?>
   
      >Enroll </button>

      <?php 

$sql= "SELECT COUNT(attendID) AS attendance_num FROM user_attend_course WHERE attendID='$coursenumber';";
$result= mysqli_query($conn , $sql);
$row= mysqli_fetch_assoc($result);
?>
        <span style="text-align: right;"> &emsp;&emsp; &emsp; &emsp; &emsp; &emsp;     
        Number of times Enrolled <?php echo $row['attendance_num'] ?></span>
    
    </div>
</div>
</div>
  
<?php }
    ?>
   



        
        
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
