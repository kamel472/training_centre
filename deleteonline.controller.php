<?php
session_start();
require 'dbconn.php';

if (isset($_GET['submit-delete'])){


    
    $courseid = $_GET['courseid'];

        $sql = "DELETE FROM onlinelist WHERE online_id = '$courseid';";
        mysqli_query($conn, $sql);
        header ("Location: onlineadmin.php?delete=success");
    

    

}
else {
    header ("Location: onlineadmin.php");
}