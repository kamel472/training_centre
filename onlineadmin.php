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
 <?php if (isset ($_SESSION['userid'])){ ?> 
  <h1 style="text-align: center;">Online Courses</h1>

  <?php
        
      
      if (isset ($_GET['delete'])){
        echo '<div class="alert alert-success" role="alert">Course deleted successfully </div> ';
      }
      elseif (isset ($_GET['submit'])){
        echo '<div class="alert alert-success" role="alert">New Course added successfully </div> ';
      }
      elseif(isset($_GET['update'])){
        echo '<div class="alert alert-success" role="alert">Course data updated successfully </div> ';
      }
      ?>

  <br>
  <form action= "createonline.php" method="GET">
  <input type="submit" name="submit" id="submit" class="btn btn-primary btn-sm" value="Add course" />
  </form>
   <br> 
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Course name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
    </thead>


  <?php
  include_once 'dbconn.php';
  $sql= "SELECT online_id, online_name FROM onlinelist;";
  $result = mysqli_query ($conn , $sql);
  $rowsnumber= mysqli_num_rows($result);
  if ($rowsnumber>0) {

  while ($row = mysqli_fetch_assoc ($result)) {
    ?>
    <tbody>
      <tr>
      <th><?php echo $row['online_id'] ?> </th>
      <td><?php echo$row['online_name']?> </td>
      <td> 
      <form action= "editonline.php" method="GET">
      <input type="hidden" name="courseid" value= <?php echo $row['online_id']?> >
      <button type="submit" class="btn btn-primary btn-sm" name="submit-edit" >Edit</button>  
      </form>
      </td>
      <form action= "deleteonline.controller.php" method="GET">
      <input type="hidden" name="courseid" value= <?php echo $row['online_id']?>>
      <td><button type="submit" class="btn btn-danger btn-sm" name="submit-delete" 
      onClick="return confirm('Are you sure you want to delete?')" >Delete</button> </td>
      </form>
    </tr>
    </tbody>
     
     
    
  <?php
 } 
 ?>
 </table>
 <?php } else {
  echo' <table> No courses available! </table>';
}
  } 

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
