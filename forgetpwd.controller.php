<?php

if (isset($_POST['RecievePwd'])) {

$email= $_POST['mail'];

if (empty ($email)) {

    header ("Location: forgetpwd.php?error=emptyfield");
    exit();

}
else {
    require 'dbconn.php';
$sql= "SELECT Email FROM users where Email='$email';";
$result = mysqli_query ($conn, $sql);
if (mysqli_num_rows($result)<1){
header ("Location: forgetpwd.php?error=wrongemail");
exit();
}
else{
     
    

    $sql2= "SELECT password FROM users where Email='$email';";
    $result2 = mysqli_query ($conn, $sql2);
    $row2= mysqli_fetch_assoc($result2);
    $pwd= $row2['password'];


    $mailTo = $email;
    $headers="From: HSE training website";
    $txt= "Your account password";
    $message = "Your account password is  (".$pwd.")";

    if (mail ($mailTo, $txt, $message, $headers )) {
      
        header("Location: forgetpwd.php?submit");
      
    } else {
        header("Location: forgetpwd.php?error=mailnotsent");
    }
    

    
}

}

}

else {
    header ("Location:forgetpwd.php");
    exit();

}