<?php
session_start();
include_once 'dbconn.php';

$id = $_SESSION['userid'];

if (isset($_POST['submit-upload'])){

$file = $_FILES['file'];
$fileName = $file['name'];
$fileSize = $file['size'];
$fileTempName = $file['tmp_name'];
$fileError = $file['error'];
$fileType = $file['type'];

$fileNameExplode = explode('.', $fileName);
$fileActualExt = strtolower(end($fileNameExplode));
$allowed = array('jpg' , 'jpeg' , 'pdf', 'png');
$fileActualName= $fileNameExplode[0];


if (in_array($fileActualExt, $allowed)){

if ($fileError===0){

if($fileSize < 15000000){

    $sql= "SELECT image_name from users WHERE image_name='$fileName'";
    $result= mysqli_query($conn, $sql);
    $numberOfRows= mysqli_num_rows($result);
    if ($numberOfRows>0){
        $fileUniqueName= $fileActualName.rand(); 
    }else{
         $fileUniqueName = $fileActualName;  
    }
    
    $fileFinalname=$fileUniqueName.".".$fileActualExt;
    $filedestination = 'uploads/'. $fileFinalname;
    move_uploaded_file($fileTempName, $filedestination);

$sql3= "UPDATE users SET image_name='$fileFinalname' where id ='$id';";
$result3 = mysqli_query ($conn, $sql3);

header("location: accountinfo.php?uploadsuccess");
}else{
echo "The file is too big!";

}
}else{
echo "There's an error uploading your file!";
}
}else{
echo "You can't upload files of this type!";
}
}
?>