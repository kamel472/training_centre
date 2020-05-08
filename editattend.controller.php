<?php
session_start();
require 'dbconn.php';

if (isset($_POST['submit-update'])) {
    $name= trim($_POST['name']);
    $tutor= trim($_POST['tutor']);
    $hours= trim($_POST['hrs']);
    $cost= trim($_POST['cost']);
    $place= trim($_POST['place']);
    $desc= trim($_POST['desc']);
    $courseid=$_POST['courseid'];

    if (empty($name) || empty($tutor) || empty($hours) || empty($cost) || empty($place) || empty($desc) ){

        header ('Location: editattend.php?courseid='.$courseid.'&submit-edit=&error=emptyfield');


    }
    else {
        
                 $file= $_FILES['file'];
                 $fileName= $file['name'];
                 $total= count($fileName);
                 for($i=0 ; $i<$total ; $i++){
                $tmpFilePath = $file['tmp_name'][$i];
                $filedestination = 'sliders/'. date("hisa").$fileName[$i];
                move_uploaded_file($tmpFilePath, $filedestination);
                 }

                $implodedFiles = date("hisa").$fileName[0].",".date("hisa").$fileName[1].",".date("hisa").$fileName[2];

                $sql= "UPDATE attendlist SET attend_name= '$name',attend_hrs= '$hours' ,attend_cost= '$cost' ,attend_tutor= '$tutor'
                ,attend_place= '$place' ,attend_desc= '$desc' ,slider_images= '$implodedFiles'"; 
                mysqli_query($conn, $sql);
                
                    header ('Location:attendadmin.php?update=success');
 
        }

        }

else {

    header ("Location: editattend.php?courseid='.$courseid.'&submit-edit=");
}