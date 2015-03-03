<?php

session_start(); 
require_once 'functions.php';


include 'connect.php';

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Model\ClearBucket;
use Aws\S3\Exception\S3Exception;

if($_POST['toki'] == "3qf97459lefh"){

if($_POST['token'] != $_SESSION['userid']){
      
      echo "999";
}
else
{



$unique_filename = mysql_real_escape_string(filter_var($_POST["file_to_delete"],FILTER_SANITIZE_STRING));

//get file_id and type
$file_info = mysql_query("SELECT file_id,file_type FROM uploaded_files WHERE unique_filename = '".$unique_filename."'"); 

$shared_json = mysql_fetch_array(mysql_query("SELECT json_file_name FROM shared_files WHERE unique_filename = '".$unique_filename."'"),MYSQL_ASSOC); 

$file_info = mysql_fetch_array($file_info, MYSQL_ASSOC);

//delete from shared_file table
$deletion_shared = mysql_query("DELETE FROM shared_files WHERE file_id=".$file_info['file_id']);

//delete from uploaded table
$deletion_uploaded  = mysql_query("DELETE FROM uploaded_files WHERE unique_filename = '".$unique_filename."'");

$total_files_remaining = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS count FROM uploaded_files WHERE user_id =".$_SESSION['userid']),MYSQL_ASSOC);

////////////////////////



$filepath = "uploaded/uploaded_files_". $_SESSION['userid']."_original/". $unique_filename.".pdf";
$keyname = "uploaded/uploaded_files_".$_SESSION['userid']."_original/".$unique_filename.".".$file_info['file_type'];

$s3 = S3Client::factory(array(
    'key' => "AKIAJ7CNKUCZLU6QSABA",
    'secret' => "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",
    'region' => "ap-southeast-1"
));


try{

    
    
    $del_result = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz.beta',
        'Key' => $keyname                                           
                                                  
    ));
    
   
}

catch(S3Exception $e){

}



unlink("uploaded/jhg76".$_SESSION['userid']."kd84/".$unique_filename.".html");
unlink("uploaded/jhg76".$_SESSION['userid']."kd84/".$shared_json['json_file_name']);


//////////////////////////


 
echo ' File deleted successfully'.'#'.$total_files_remaining['count']; // Use # for sending multiple data
mysql_close($mysql_conn);
}
}
else {
      
}
?>
