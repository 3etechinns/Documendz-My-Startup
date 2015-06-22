<?php
require "connect.php";

include '../../unique_random_alphanumeric.php';

$fid = $_POST['fid'];
$newID = getToken(15);
$SQL = mysqli_query($dbhandle, "INSERT INTO publicLinks (origId, newid) SELECT * FROM (SELECT '$fid', '$newID') AS tmp where not exists (SELECT 1 from publicLinks WHERE origId='" . $fid . "') limit 1");

if (mysqli_affected_rows($dbhandle) == 0)
	{
	$SQL2 = mysqli_query($dbhandle, "SELECT newId FROM publicLinks WHERE origId ='" . $fid . "' LIMIT 1");
	$row = mysqli_fetch_array($SQL2);
	$newID = $row['newId'];
	}

echo $newID;


?>