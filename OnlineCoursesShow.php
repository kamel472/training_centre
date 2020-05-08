<?php
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
  $courseid= $_GET['onlinenumber'] ;
  $sql= "SELECT online_id, online_name, online_hrs, online_cost, 
  online_tutor, online_desc, online_lastupdated,video_name
   FROM onlinelist WHERE online_id='$courseid';"; 
  $result = mysqli_query ($conn , $sql);

  while ($row = mysqli_fetch_assoc ($result)) {
    ?>

    <div class="container">
    <div class="row">
      <div class="col">
       
 <ul class="list-group">
    <li class="list-group-item ">
        <h4>Program Name</h4>
        <?php echo'<p>'.$row['online_name'].'</p>';?>
    </li>
    <li class="list-group-item ">
        <h4>Tutor:</h4>
        <?php echo'<p>'.$row['online_tutor'].'</p>';?>
    </li>
    <li class="list-group-item">
        <h4>Total Hours:</h4>
        <?php echo'<p>'.$row['online_hrs'].'hrs </p>';?>
    
    </li>
    <li class="list-group-item">
        <h4>Cost:</h4>
        <?php echo'<p>'.$row['online_cost'].'$ </p>';?>
        

    </li>
    <li class="list-group-item">
        <h4>Course Description:</h4> 
        <p><?php echo$row['online_desc'];?> </p>
        </li>

    </li>
    <li class="list-group-item">
        <h4>Last updated:</h4> 
        <?php echo'<p>'.$row['online_lastupdated'].' </p>';?>
        </li>
  </ul>
</div>
<div class="col">

 <video width="540" height="310" controls>
 <?php
    if ($row['video_name']==null){
      echo '';
    } else {
      echo '<source src= "videos/'.$row['video_name'].'"type="video/mp4">';
    }

 ?>
</video>
<div>
<form action="view.php" id="contactForm" method="POST">
<input type="hidden" name="coursenumber" value="<?PHP echo $row['online_id']; ?> ">

<button type="submit" name="submit-view" class="btn btn-danger " id="sendMessageButton" <?php

$coursenumber=$row['online_id'];
$userid= $_SESSION['userid'];
$sql="SELECT useronlineID FROM user_online_course WHERE userID='$userid' AND  onlineID='$coursenumber';";
$result= mysqli_query($conn , $sql);
$resultcheck= mysqli_num_rows($result);



if ($resultcheck<1){
  echo '';
  
  
} else {

  echo 'disabled';

}
 ?>>View </button>

<?php 

$sql= "SELECT COUNT(onlineID) AS viewers_num FROM user_online_course WHERE onlineID='$coursenumber';";
$result= mysqli_query($conn , $sql);
$row= mysqli_fetch_assoc($result);
?>

<span style="text-align: right;"> &emsp;&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;&emsp; Number of views 
  <?php echo $row['viewers_num'] ?>
  <!--  -->
  </span>

</form>
</div>



  <?php  
  }
?>

     
  
</div>
</div>


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
