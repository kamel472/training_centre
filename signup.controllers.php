<?php

if(isset($_POST['submit'])){

  require 'dbconn.php';

$first = trim($_POST ['first']);
$last = trim($_POST ['last']);
$age = trim($_POST ['age']);
$country = trim($_POST ['country']);
$email = trim($_POST ['email']);
$password = trim($_POST ['password']);
$confirmPwd = trim($_POST ['confirmPwd']);


if(empty($first) || empty($last)|| empty($age)|| empty($country)|| empty($email)|| empty($password)|| empty($confirmPwd) ){
    header ("Location:signup.php?error=emptyfields&first=".$first."&last=".$last."&age=".$age."&country=".$country."&email=".$email);
    exit();}
    
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header ("Location:signup.php?error=invalidemail&first=".$first."&last=".$last."&age=".$age."&country=".$country); 
    exit();
}

else if($password!== $confirmPwd){
    header ("Location:signup.php?error=passwordcheck&first=".$first."&last=".$last."&age=".$age."&country=".$country."&email=".$email); 
    exit();
}
else {
    $sql="SELECT Email FROM users WHERE Email=?";
    $stmt= mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
    header ("Location:signup.php?error=sqlerror");   
    exit();
    }
    else{

        mysqli_stmt_bind_param($stmt, "s", $email );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck= mysqli_stmt_num_rows($stmt);
        if($resultCheck>0){
            header ("Location:signup.php?error=emailtaken&first=".$first."&last=".$last."&age=".$age."&country=".$country);  
            exit();
        }
        else {

            $sql= "INSERT INTO users (First_name, Last_name, Age, Country, Email, password) VALUES (?,?,?,?,?,?)";
            $stmt= mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                header ("Location:signup.php?error=sqlerror");   
                exit();
                }
            else {

            mysqli_stmt_bind_param($stmt, "ssisss",$first, $last, $age, $country, $email,$password );
            mysqli_stmt_execute($stmt);

            $sql1="SELECT id from users WHERE Email='$email'";
            $result= mysqli_query($conn, $sql1);
            $row= mysqli_fetch_assoc($result);
            $id= $row['id'];
            
            session_start();
                $_SESSION['first']=$first;
                $_SESSION['last']=$last;
                $_SESSION['email']= $email;
                $_SESSION['userid']= $id;
                $_SESSION['country']= $country;
                $_SESSION['pwd']= $password;
                $_SESSION['admin']= 0;

            header ("Location:index.php?signup=success"); 
            exit();
            }    



        }
    }


}

mysqli_stmt_close($stmt);
mysqli_close($conn);

}

else {
    header ("Location:signup.php");
    exit();

}













