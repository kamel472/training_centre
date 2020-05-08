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
      <a class="navbar-brand" href="adminpanel.php">HSE Training</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="onlineadmin.php">Online</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="attendadmin.php">Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="userstatus.php">Users</a>
          </li>
          <?php
          if (isset ($_SESSION['userid'])){
            ?>
           <li class="nav-item">
            <div class="btn-group">          
    <button  type="button" class="btn-sm btn-success  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php echo $_SESSION['first'] ;?>
    </button>
    <div class="dropdown-menu">
      
      <a class="dropdown-item" href="signout.controllers.php">Sign out</a>
  </div>
    </div>
  
            </li>


            <?php
          }
          else {
            ?>
          <li class="nav-item">
            <a class="nav-link" href="signin.php">Sign in</a>
          </li>
            <?php
          }

          ?>
          


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
            <h2> Admin Panel</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

 <!-- Main Content -->
 <div class="container">
  <div class="row">
    <div class="col">
    <h4>Enter course information :</h4>

    <?php
      
        
  include_once 'dbconn.php';
  if (isset ($_GET['error'])) {
    echo '<div class="alert alert-danger" role="alert">Please fill in all fields </div> '; 
}
elseif (isset ($_GET['create'])){
  echo '<div class="alert alert-success" role="alert">New course data inserted successfully , Now upload course video </div> ';
}


  
  if (isset($_GET['submit'])){
    


    ?>
    <form action="createonline.controller.php" id="contactForm" method="POST" enctype='multipart/form-data'>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Program Name</label>
              <input type="text" class="form-control" placeholder="Program Name" name="name" required  >
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Tutor</label>
              <input type="text" class="form-control" placeholder="Tutor" name="tutor" required >

              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Total hours </label>
              <input type="text" class="form-control" placeholder="Total hours " name="hrs" required>

              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Cost</label>
              <input type="text" class="form-control" placeholder="Cost" name="cost" required>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Course Description</label>
              <input type="text" class="form-control" placeholder="Course Description" name="desc" required >
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Last updated</label>
              <input type="date/time" class="form-control" placeholder="Last updated" name="lastupdated" required>
              <p class="help-block text-danger"></p>
            </div>
            
            
            
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
            
              
              
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit-create">ADD</button>
            
            
          </div>
        
    </div>
    <div class="col">
<div class="col">
<video width="540" height="310" controls >

</video>
<h6>Upload course video:</h6> 
<input type="file" name="file">
</form>

</div>


   <?php
 }

else {
  header("Location: onlineadmin.php");
} 
  ?>
    
     
    
    
  
  
  
  
    </div>
  </div>
  <hr>

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
