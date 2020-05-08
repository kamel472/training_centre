<?php
session_start();
?>
<!DOCTYPE html>
<html>

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
          <?php
          if (isset ($_SESSION['userid'])){
            ?>
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
    <h4>Enter new information :</h4>

     <?php
        if (isset ($_GET['error'])) {
           
          switch ($_GET['error']) {
            case $_GET['error']=="emptyfields":
              echo '<div class="alert alert-danger" role="alert">Please fill in all fields </div> ';
            break;
            case $_GET['error']=="invalidemail";
            echo ' <div class="alert alert-danger" role="alert">Please enter a valid email</div>';
            break;
            case $_GET['error']=="passwordcheck";
            echo ' <div class="alert alert-danger" role="alert">Passwords are not identical</div>';
            break;
            case $_GET['error']=="emailtaken";
            echo ' <div class="alert alert-danger" role="alert">Email already used</div>';
            break;
        }
        
        
      }?>

    <form action="edit.controller.php" id="contactForm" method="POST">
        <!-- add required to all fields that not nullable in teh database -->
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>First Name</label>
              <input type="text" class="form-control" placeholder="First Name" name="first"required value=
              "<?php echo $_SESSION['first'];?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Last Name</label>
              <input type="text" class="form-control" placeholder="Last Name" name="last" required value=
              "<?php echo $_SESSION['last'];?>">

              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Country of Residence </label>
              <input type="text" class="form-control" placeholder="Country of Residence " name="country" required value=
              "<?php echo $_SESSION['country'];?>">

              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" name="email" required value=
              "<?php echo $_SESSION['email'];?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="password" name="password" required value=
              <?php echo $_SESSION['pwd'];?> >
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Confirm Password</label>
              <input type="password" class="form-control" placeholder="confirm password" name="confirmPwd" required value=
              <?php echo $_SESSION['pwd'];?> >
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit-edit">Update</button>
          </div>
        </form>
    </div>
    <div class="col">
    <?php
    require 'dbconn.php';
    
    $id=$_SESSION['userid'];
	$sqlImg = "SELECT image_name from users where id='$id'";
	$resultImg = mysqli_query ($conn , $sqlImg); 
	while ($rowImg=mysqli_fetch_assoc($resultImg)) {

		if ($rowImg ['image_name'] == null) {
      echo "<img src='img/default.png'>";  
      		
		} else {
      $fileName=$rowImg ['image_name'];    
      echo '<img src="uploads/'.$fileName.'" style= "height: 300px; width: 300px">';
		}
		
        }
        ?>
 <br> <br>       
 <h6>Upload profile image:</h6> 

 <form action='upload.controller.php' method='POST' enctype='multipart/form-data'>
	
	<input type='file' name='file'>
	<button type='submit' name='submit-upload'>Upload</button>
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