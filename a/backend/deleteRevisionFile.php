<?php
require_once 'functions.php';
session_start();
include 'connect.php';

 
require '../../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


$v = trim($_POST['v']);
$e = trim($_POST['ext']); 

$result = mysqli_query($dbhandle, "DELETE FROM versions where verUniqueFilename = '".$v."'");

$keyname = "uploaded/user_".$_SESSION['userid']."/";

$s3 = S3Client::factory(array(
     'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));


try{

    
    
    $del_result1 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => $keyname.'versions/'.$v.'.html'                                           
                                                  
    ));
    
    $del_result2 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => $keyname.'thumbnails/'.$v.'.jpg'                                           
                                                  
    ));
   
     $del_result3 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => $keyname.'original/'.$v.'.'.$e                                           
                                                  
    ));
}

catch(S3Exception $e){

}


$dbname = "annotationStorage";
$m = new MongoClient();
$db = $m ->$dbname;

$db->annotationData->remove(array("shareId" => $v));
$db->annotationHistory->remove(array("shareId" => $v));





?> 