<?php

//require_once 'functions.php';

require_once 'functions.php';

session_start();
include 'connect.php';

$shared_id = filter_var($_POST["shared_id"],FILTER_SANITIZE_STRING);

mysql_query("UPDATE shared_files SET review_state = 0 WHERE shared_id=".$shared_id);

echo "hello";


?>