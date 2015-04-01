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
       
        'Bucket' => 'documendz-ent',
        'Key' => $keyname.'converts/'.$f.'.html'                                           
                                                  
    ));
    
    $del_result2 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => $keyname.'thumbnails/'.$f.'.jpg'                                           
                                                  
    ));
   
     $del_result3 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => $keyname.'original/'.$f.'.'.$e                                           
                                                  
    ));

$db->annotationData->remove(array("shareId" => $f));
$db->annotationHistory->remove(array("shareId" => $f));

}

catch(S3Exception $e){

}

//delete versions of the file

$result1 = mysqli_query($dbhandle, "SELECT verUniqueFilename,verExtension,ver_authid FROM versions WHERE parentUniqueFilename = '".$f."'");


while($row = mysqli_fetch_assoc($result1))
 {
  

    try{

    
    
    $del1 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => "uploaded/user_".$row['ver_authid'].'/versions/'.$row['verUniqueFilename'].'.html'                                           
                                                  
    ));
    
    $del2 = $s3 -> deleteObject(array(
       
        'Bucket' => 'docimendz-ent',
        'Key' =>  "uploaded/user_".$row['ver_authid'].'/thumbnails/'.$row['verUniqueFilename'].'.jpg'                                        
                                                  
    ));
   
     $del3 = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz-ent',
        'Key' => "uploaded/user_".$row['ver_authid'].'/original/'.$row['verUniqueFilename'].'.'.$row['verExtension']                                         
                                                  
    ));
        }

catch(S3Exception $e){
   
                      }

  }

$result = mysqli_query($dbhandle, "DELETE FROM versions where parentUniqueFilename = '".$f."'");
echo $keyname.'original/'.$f.'.'.$e ;

?>  
