<?php
	require_once 'functions.php';
	session_start();
	include 'connect.php';

	$w = $_POST['wid'];
	// $result = mysqli_query($dbhandle, "SELECT a.*,s.username as authname FROM archives AS a LEFT JOIN signup AS s ON a.ver_authid = s.userid WHERE f.workgroupid = '".$w."'");	

	$result = mysqli_query($dbhandle, "SELECT v.*,s.username as authname, f.filename FROM versions AS v LEFT JOIN signup AS s ON v.ver_authid = s.userid LEFT JOIN files AS f ON f.uniqueFilename = v.parentUniqueFilename WHERE f.workgroupid = '".$w."' ORDER BY v.verUploadtime");
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
	    $data[] = $row;
	}

	print json_encode($data);
?>