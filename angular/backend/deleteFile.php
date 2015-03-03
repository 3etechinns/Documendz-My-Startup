<?php
require_once 'functions.php';
session_start();
include 'connect.php';

 
require '../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


$f = trim($_POST['unique_file']);
$e = trim($_POST['ext']); 

$result = mysqli_query($dbhandle, "DELETE FROM files where uniqueFilename = '".$f."'");

$keyname = "uploaded/user_".$_SESSION['userid']."/";

/// mongo connect ////

$dbname = "annotationStorage";
$m = new MongoClient();
$db = $m ->$dbname;



$s3 = S3Client::factory(array(
     'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));


try{

    
    
    $del_result1 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docs-ent',
        'Key' => $keyname.'converts/'.$f.'.html'                                           
                                                  
    ));
    
    $del_result2 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docs-ent',
        'Key' => $keyname.'thumbnails/'.$f.'.jpg'                                           
                                                  
    ));
   
     $del_result3 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docs-ent',
        'Key' => $keyname.'original/'.$f.'.'.$e                                           
                                                  
    ));

$db->annotationData->remove(array("shareId" => $f));
$db->annotationHistory->remove(array("shareId" => $f));

}

catch(S3Exception $e){

}

echo $keyname.'original/'.$f.'.'.$e ;

?> 