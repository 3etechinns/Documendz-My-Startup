<?php
require_once 'functions.php';
session_start();
include 'connect.php';

$f = trim($_POST['unique_file']);
$e = trim($_POST['ext']); 

$result = mysqli_query($dbhandle, "DELETE FROM files where uniqueFilename = '".$f."'");


$dbname = "annotationStorage";
$m = new MongoClient();
$db = $m ->$dbname;

$db->annotationData->remove(array("shareId" => $f));
$db->annotationHistory->remove(array("shareId" => $f));

?> 