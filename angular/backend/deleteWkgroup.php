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



$s3 = S3Client::factory(array(
     'key' => "AKIAJQPVOOQRLNHZ4UEA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));

// delete from s3 - html,thumbnail and original

$result1 = mysqli_query($dbhandle, "SELECT uniqueFilename,extension,authid FROM files WHERE workgroupid = '".$w."'");


while($row = mysqli_fetch_assoc($result1))
 {
  

 	try{

    
    
    $del1 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docs-ent',
        'Key' => "uploaded/user_".$row['authid'].'/converts/'.$row['uniqueFilename'].'.html'                                           
                                                  
    ));
    
    $del2 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docs-ent',
        'Key' =>  "uploaded/user_".$row['authid'].'/thumbnails/'.$row['uniqueFilename'].'.jpg'                                        
                                                  
    ));
   
     $del3 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docs-ent',
        'Key' => "uploaded/user_".$row['authid'].'/original/'.$row['uniqueFilename'].'.'.$row['extension']                                         
                                                  
    ));
    

     $db->annotationData->remove(array("shareId" => $row['uniqueFilename']));
     $db->annotationHistory->remove(array("shareId" => $row['uniqueFilename']));

        }

catch(S3Exception $e){
   
                      }

  }

 

// delete from mysql

mysqli_query($dbhandle, "DELETE FROM workgroups where uniqueId = '".$w."'");
mysqli_query($dbhandle, "DELETE FROM files where workgroupid = '".$w."'");
mysqli_query($dbhandle, "DELETE FROM collaborators where wkUniqueId = '".$w."'");




?> 