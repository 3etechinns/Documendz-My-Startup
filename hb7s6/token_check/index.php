<?php
session_start();

$token = $_POST['token'];

if($_SESSION['userid'] == $token) {

    echo "1";
}

else{
    
    echo "0";
}

?>