<?php

require_once 'functions.php';
session_start();
include 'connect.php';

require '../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;



$w = trim($_POST['del_id']);
 
////// Mongo connection  ///////////

$dbname = "annotationStorage";
$m = new MongoClient();
$db = $m ->$dbname; 



// delete from s3 - html,thumbnail and original

$result1 = mysqli_query($dbhandle, "SELECT uniqueFilename,extension,authid FROM files WHERE workgroupid = '".$w."'");


// delete from mysql

mysqli_query($dbhandle, "DELETE FROM workgroups where uniqueId = '".$w."'");
mysqli_query($dbhandle, "DELETE FROM files where workgroupid = '".$w."'");
mysqli_query($dbhandle, "DELETE FROM collaborators where wkUniqueId = '".$w."'");



while($row = mysqli_fetch_assoc($result1)){

	$db->annotationData->remove(array("shareId" => $row['uniqueFilename']));
     $db->annotationHistory->remove(array("shareId" => $row['uniqueFilename']));

}



?> 