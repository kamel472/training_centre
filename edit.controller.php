<?php
session_start();
require 'dbconn.php';


if(isset($_POST['submit-edit'])){

$first = trim($_POST ['first']);
$last = trim($_POST ['last']);
$email = trim($_POST ['email']);
$country= trim($_POST ['country']);
$password = trim($_POST ['password']);
$confirmPwd = trim($_POST ['confirmPwd']);

if(empty($first) || empty($last)|| empty($email)|| empty($password)|| empty($confirmPwd) || empty($country)  ){
    header ("Location:edit.php?error=emptyfields");
    exit();}
    
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header ("Location:edit.php?error=invalidemail"); 
    exit();
}

    else if($password!== $confirmPwd){
    header ("Location:edit.php?error=passwordcheck"); 
    exit();
}
else {
        $id= $_SESSION['userid'];
        $sql1="SELECT Email FROM users WHERE Email='$email'AND NOT id='$id' ";
        $result1= mysqli_query($conn, $sql1);
        $resultCheck= mysqli_num_rows($result1);
         if($resultCheck>0){
                header ("Location:edit.php?error=emailtaken");  
                exit();
         }
             
             else {

                $id= $_SESSION['userid'];
            $sql2= "UPDATE users SET First_name=?, Last_name=?, Country=?, Email=?, password=? WHERE id='$id'";
            $stmt2= mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)){
                header ("Location:edit.php?error=sqlerror");   
                exit();
                }
            else {

            mysqli_stmt_bind_param($stmt2, "sssss",$first, $last, $country, $email,$password );
            mysqli_stmt_execute($stmt2);
            

                $_SESSION['first']=$first;
                $_SESSION['last']=$last;
                $_SESSION['email']= $email;
                $_SESSION ['country'] = $country;
      
            header ("Location:accountinfo.php?submit=success"); 
            exit();

             }
            
        
        
            
        }
        

        }
    


}




else {
    header ("Location:edit.php");
    exit();

}
