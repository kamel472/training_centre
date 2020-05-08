<?php
session_start();
if (isset ($_SESSION['first'])){
  require 'dbconn.php';

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
  <?php echo $_SESSION['first'] ;?>
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
 

 <div class="container">
    <div class="row">
      <div class="col">
       
 <ul class="list-group">
    <li class="list-group-item ">
        <h4>Courses viewed:</h4>
        
        <?php
        $userid= $_SESSION['userid'];
        $sql="SELECT onlineID FROM user_online_course WHERE userID='$userid';";
        
        $result= mysqli_query($conn , $sql);
        if(mysqli_num_rows($result)<1) {
          echo '<p> No courses viewed!</p>';
        } else{

          while ($row1= mysqli_fetch_assoc($result)) {
            
        $onlineid=$row1['onlineID'];    
        $sql2="SELECT online_name FROM onlinelist WHERE online_id='$onlineid';";
        $result2= mysqli_query($conn , $sql2);
        while($row2 = mysqli_fetch_assoc($result2)){
          $onlinname= $row2['online_name'];
          
        } 
      
            echo '<p><a href="OnlineCoursesShow.php?onlinenumber='.$onlineid.'">'.$onlinname.'</a></p>';
            
          }
        }

        ?>
        
        
    </li>
    <li class="list-group-item ">
        <h4>Courses enrolled in:</h4>
        <?php
        $userid= $_SESSION['userid'];
        $sql2="SELECT attendID FROM user_attend_course WHERE userID='$userid';";
        
        $result2= mysqli_query($conn , $sql2);
        if(mysqli_num_rows($result2)<1) {
          echo '<p> No courses enrolled!</p>';
        } else{

          while ($row2= mysqli_fetch_assoc($result2)) {
            
        $attendid=$row2['attendID'];    
        $sql3="SELECT attend_name FROM attendlist WHERE attend_id='$attendid';";
        $result3= mysqli_query($conn , $sql3);
        while($row3 = mysqli_fetch_assoc($result3)){
          $attendname= $row3['attend_name'];
          
        } 
      
            echo '<p><a href="attendingCoursesShow.php?attendnumber='.$attendid.'">'.$attendname.'</a></p>';
            
          }
        }

        ?>
    </li>
    
  </ul>
 </div>

 </div>




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
<?php }else {
header ("Location: signin.php");
}?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>


</html>
