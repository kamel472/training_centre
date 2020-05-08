<?php

 if (isset ($_POST['submit-login'])){

    require 'dbconn.php';

    $email=$_POST['mail'];
    $password=$_POST['pwd'];

    if (empty($email) || empty($password)) {

    header ("Location:signin.php?error=emptyfields");
    exit();

    }
    else {
     
        $sql="SELECT * FROM users WHERE Email=?;";
        $stmt= mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
        header ("Location:signin.php?error=sqlerror");   
        exit();
    }
    else{

        mysqli_stmt_bind_param($stmt,"s", $email);
        mysqli_stmt_execute($stmt);

        $result= mysqli_stmt_get_result($stmt);

        // die(var_dump($result))        ;
        if($result->num_rows==0)
        {
            header ("Location:signin.php?error=wrongcredintails");
        }

        
        if ($row= mysqli_fetch_assoc($result)){

            if($password != $row['password']){
            header ("Location:signin.php?error=wrongcredintails");   
            exit();  

            } elseif ($password = $row['password']) {
                session_start();
                $_SESSION['userid']=$row['id'];
                $_SESSION['first']=$row['First_name'];
                $_SESSION['last']=$row['Last_name'];
                $_SESSION['country']=$row['Country'];
                $_SESSION['email']=$row['Email'];
                $_SESSION['pwd']=$row['password'];
                $_SESSION['admin']=$row['is_admin'];
                

                

                header ("Location:index.php?signin=success"); 
                exit();

            }
            else{
                header("Location:signin.php?error=wrongcredintails");
                exit();
            }


        }

    }


 }
}

else {
    header ("Location:signin.php"); 
    exit(); 
}