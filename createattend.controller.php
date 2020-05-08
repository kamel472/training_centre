<?php
session_start();
require 'dbconn.php';

if (isset($_POST['submit-create'])) {
    $name= trim($_POST['name']);
    $tutor= trim($_POST['tutor']);
    $hours= trim($_POST['hrs']);
    $cost= trim($_POST['cost']);
    $place= trim($_POST['place']);
    $desc= trim($_POST['desc']);
    
  /**Array ( [name] => Array ( [0] => cairo1.jpg [1] => cairo2.jpg [2] => cairo3.jpg ) 
  [type] => Array ( [0] => image/jpeg [1] => image/jpeg [2] => image/jpeg ) 
  [tmp_name] => Array ( [0] => C:\xampp\tmp\php43C5.tmp [1] => C:\xampp\tmp\php43D5.tmp [2] => C:\xampp\tmp\php43D6.tmp ) 
  [error] => Array ( [0] => 0 [1] => 0 [2] => 0 ) 
  [size] => Array ( [0] => 176615 [1] => 186056 [2] => 355476 ) )**/





    if (empty($name) || empty($tutor) || empty($hours) || empty($cost) || empty($place) || empty($desc) ){

        header ('Location: createattend.php?submit=Add+course&error=emptyfield');


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

                $sql= "INSERT INTO attendlist (attend_name,attend_hrs,attend_cost,attend_tutor,attend_place,attend_desc,slider_images)
                VALUES ('$name' ,'$hours', '$cost', '$tutor','$place', '$desc','$implodedFiles');";
                mysqli_query($conn, $sql);
                
                    header ('Location:attendadmin.php?create=success');
 
        }

        }

else {

    header ("Location: createattend.php");
}