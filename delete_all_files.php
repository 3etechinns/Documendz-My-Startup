<?php
require_once 'functions.php';

session_start();
include 'connect.php';


require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Model\ClearBucket;
use Aws\S3\Exception\S3Exception;

if($_POST['toki'] == "pipi7463kjg"){

if($_POST['token'] != $_SESSION['userid']){
      
      echo "999";
}
else
{


$folder = "uploaded/uploaded_files_".$_SESSION['userid']."_original/";

$s3 = S3Client::factory(array(
    'key' => "AKIAJ7CNKUCZLU6QSABA",
    'secret' => "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",
    'region' => "ap-southeast-1"
));


try{
    
$iterator = $s3->getIterator('ListObjects', array(
    'Bucket' => 'documendz.beta',
    'Prefix' => $folder
        
));

foreach($iterator as $val)
{
    
    
    $del_result = $s3 -> deleteObject(array(
       
        'Bucket' => 'documendz.beta',
        'Key' => $val['Key']                                           
                                                  
    ));
    
    echo $val['Key']."\n";
}
}
catch(S3Exception $e){
    
   echo $e->getMessage() . "\n";
}



unlink("uploaded/jhg76".$_SESSION['userid']."kd84/".$unique_filename.".html");


//array_map('unlink',glob('uploaded/uploaded_files_'.$_SESSION['userid'].'_original/*'));
array_map('unlink',glob('uploaded/jhg76'.$_SESSION['userid'].'kd84/*'));

$us = mysql_real_escape_string($_SESSION['userid']);

$delete_all_uploaded = mysql_query('DELETE FROM uploaded_files WHERE user_id ='.$us);
$delete_all_shared = mysql_query('DELETE FROM shared_files WHERE sender_id ='.$us);
$delete_all_pending = mysql_query('DELETE FROM shared_files WHERE sender_id ='.$us);

$fp=fopen('uploaded/jhg76'.$_SESSION['userid'].'kd84/editor_change.php','w');
fwrite($fp, '<?php
$json_path = $_GET["json_path"];
$edited_data = $_POST["edited_data"];
$result = file_put_contents($json_path, $edited_data);

if($result === false){   // file_put_contents returns boolean
    echo "false";
}
else{
echo "true";
}
?>');
fclose($fp);

mysql_close($mysql_conn);
}
}
else{
    
    
}

?>