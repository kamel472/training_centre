<?php
session_start();
require 'dbconn.php';

if (isset($_GET['submit-delete'])){


    
    $courseid = $_GET['courseid'];

        $sql = "DELETE FROM attendlist WHERE attend_id = '$courseid';";
        mysqli_query($conn, $sql);
        header ("Location: attendadmin.php?delete=success");
    

    

}
else {
    header ("Location: attendadmin.php");
}