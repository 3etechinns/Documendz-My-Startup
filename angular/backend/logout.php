<?php
// logout after closing session and destroy all

session_start();
session_unset();
session_destroy();
//header("Location: http://192.168.0.100/local_ang/");
exit();
?>