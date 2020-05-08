<?php
require 'dbconn.php';
if(isset($_POST['checkbox_mark'])) {
    foreach($_POST['checkbox_mark'] as $id => $dummy) {
            

            if (isset($_POST['checkbox'][$id])) {
                $option = 1;
              } else {
                $option = 0;
              }
              

            $sql2="UPDATE users SET is_admin='$option' WHERE id='$id';";
            mysqli_query($conn, $sql2 );
            header("Location: userstatus.php?statuschanged");

    }
}
else{
    header("Location: userstatus.php");
}
?>