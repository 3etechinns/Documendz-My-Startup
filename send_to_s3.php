<?php

$df= parse_str($argv[1], $_GET);
$pieces = explode("!", $argv[1]);


session_start();

require 'vendor/autoload.php';

use Aws\S3\S3Client;

use Aws\S3\Exception\S3Exception;

$s3 = S3Client::factory(array(
    'key' => "AKIAJ7CNKUCZLU6QSABA",
    'secret' => "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",
    'region' => "ap-southeast-1"
));

$filepath = 'uploaded/uploaded_files_'.$pieces[1].'_original/'.$pieces[0].'.pdf';
$bucket = 'documendz.beta';
$keyname = 'uploaded/uploaded_files_'.$pieces[1].'_original/'.$pieces[0].'.pdf';

try{
 $result = $s3 -> putObject(array(
   'Bucket'       => $bucket,
   'Key'          => $keyname,
   'SourceFile'   => $filepath

));

unlink($filepath);
echo "success";

}
catch(S3Exception $e){
     
   echo 'Failed to upload';

   }
   
   ?>