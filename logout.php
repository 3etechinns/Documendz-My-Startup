<?php

require_once 'functions.php';
session_start();
session_destroy();
redirect_to('register.php');


?>
