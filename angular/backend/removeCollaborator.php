<?php

require_once 'functions.php';
session_start();
include 'connect.php';

$c = $_POST['collabEmail'];
$w = $_POST['wkGroupId']; 

$result = mysqli_query($dbhandle, "DELETE FROM collaborators where wkUniqueId = '".$w."' AND collabEmail ='".$c."'");




?> 