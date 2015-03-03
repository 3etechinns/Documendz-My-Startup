<?php

session_start();

if (isset($_SESSION['userid'])){

	echo $_SESSION['userid'];
}
else {

	echo 0;
}

?>