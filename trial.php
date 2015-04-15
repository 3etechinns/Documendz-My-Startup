<?php
require_once 'functions.php';


session_start();

 
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

$unique_filename = $argv[1];
$usId = $argv[2];
$ext = $argv[3];


$s3 = S3Client::factory(array(
     'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));

//generate thumbnail and send to S3

$pdf_file   = 'uploaded/uploaded_files_' . $usId . '_original/' . $unique_filename.'.pdf';
          $save_to    = 'thumbnails/'.$unique_filename.'.jpg';
           
          $img = new imagick($pdf_file.'[0]');
           
          //set new format
          $img->setImageFormat('jpg');
           
          //save image file
          $img->writeImage($save_to);



$filepath = 'thumbnails/'.$unique_filename.'.jpg';
$bucket = 'documendz-ent';
$keyname = 'uploaded/user_'. $usId.'/thumbnails/'.$unique_filename.'.jpg';


try{
 $result = $s3 -> putObject(array(
   'Bucket'       => $bucket,
   'Key'          => $keyname,
   'SourceFile'   => $filepath
   

));

unlink($filepath);


 
}
catch(S3Exception $e){
     
   echo 'Failed to upload';

   }


 // move original to a diff location on S3



$filepath1 = 'uploaded/uploaded_files_'. $usId.'_original/'. $unique_filename.'.'.$ext;
$bucket1 = 'documendz-ent';
$keyname1 = 'uploaded/user_'.$usId.'/original/'.$unique_filename.'.'.$ext;

try{
 $result = $s3 -> putObject(array(
   'Bucket'       => $bucket1,
   'Key'          => $keyname1,
   'SourceFile'   => $filepath1

));





echo $unique_filename;
 
}

catch(S3Exception $e){
     
   echo 'Failed to upload';

   }

chown('uploaded/uploaded_files_'. $usId.'_original/'. $unique_filename.'.pdf','root');
chown('uploaded/jhg76'.$usId.'kd84/'. $unique_filename.'.html','root');
chown($filepath1,'root');

unlink($filepath1);
unlink('uploaded/uploaded_files_'. $usId.'_original/'. $unique_filename.'.pdf');
unlink('uploaded/jhg76'.$usId.'kd84/'. $unique_filename.'.html');

?>