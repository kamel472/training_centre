<?php
session_start();
require 'dbconn.php';

if (isset($_POST['submit-update'])) {
    $name= trim($_POST['name']);
    $tutor= trim($_POST['tutor']);
    $hours= trim($_POST['hrs']);
    $cost= trim($_POST['cost']);
    $desc= trim($_POST['desc']);
    $lastupdated= trim($_POST['lastupdated']);
    $courseid= $_POST['courseid'];
    
    $file= $_FILES['file'];
$fileName= $file['name'];
$fileSize= $file['size'];
$fileTempName= $file['tmp_name'];
$fileError= $file['error'];
$fileType= $file['type'];

$fileNameExplode = explode('.', $fileName);
$fileActualExt = strtolower(end($fileNameExplode));
$fileActualName= $fileNameExplode[0];

    


    if (empty($name) || empty($tutor) || empty($hours) || empty($cost) || empty($desc) || empty($lastupdated) ){

        header ('Location: editonline.php?submit=Add+course&error=emptyfield');


    }
    else {
        if ($fileError===0){

            if($fileSize< 40000000){
    
                $sql= "SELECT video_name from onlinelist WHERE video_name='$fileName'";
                $result= mysqli_query($conn, $sql);
                $numberOfRows= mysqli_num_rows($result);
                if ($numberOfRows>0){
                    $fileUniqueName= $fileActualName.rand(); 
                }else{
                     $fileUniqueName = $fileActualName;  
                }
                
                $fileFinalname=$fileUniqueName.".".$fileActualExt;
                $filedestination = 'videos/'. $fileFinalname;
                move_uploaded_file($fileTempName, $filedestination);

                $sql="UPDATE onlinelist set online_name='$name', online_hrs='$hours',online_cost='$cost',online_tutor='$tutor'
                ,online_desc='$desc',online_lastupdated='$lastupdated',video_name='$fileFinalname'";
                mysqli_query($conn, $sql);
                
                    header ('Location:onlineadmin.php?update=success');
            
            }
            else{
                echo "The file is too big!";  
            }
    
        }
        else {
            echo "There's an error uploading your file!";   
        }

        }

}

else {

    header ("Location: editonline.php");
}