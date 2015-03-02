<?php

session_start();

if ($_SESSION['userid'] != '')
{

	echo 1;
}
else {

	echo 0;
}

?>