<?php

if (isset($_POST['submit-message'])){

    $name= trim($_POST['name']);
    $emailFrom= trim($_POST['email']);
    $phone= trim($_POST['phone']);
    $message= trim($_POST['message']);
    

    if (empty($name)||empty($emailFrom)||empty($phone)||empty($message)||empty($name)){
        header("Location: contact.php?emptyfields");
    }
    else {

    $mailTo="eng_kamel2009@ymail.com";
    $headers="From:".$emailFrom;
    $txt= "You have received an e-mail from   ".$name;

    if (mail ($mailTo, $txt, $message, $headers )) {
      
        header("Location: contact.php?submit=mailsent");
      
    } else {
        header("Location: contact.php?mailnotsent");
    }
}
    


}