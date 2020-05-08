<?php
session_start();


?>
<html>

<?php


    require 'dbconn.php';
    $coursenumber=$_POST['coursenumber'];
    $userid= $_SESSION['userid'];
    
    $sql="INSERT into user_attend_course (userID, attendID) values ( $userid, $coursenumber);"; 
    mysqli_query($conn , $sql);
    header ("Location: {$_SERVER['HTTP_REFERER']}");



?>
</html>
