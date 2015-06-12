<body>
  <div style="right:50%;bottom:50%;transform:translate(50%,50%);position:absolute;">
    <div id="bar2" style="display: none;">
      <span id="bar3" style="width:0%" ></span>
    </div>
  </div>
</body>

<style type="text/css">
  div#bar2{
  width: 400px;
  height: 8px;
  background:rgb(0, 18, 17);
  margin: 20px 0 0 20px;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  border-top: 1px solid rgba(0,0,0,.5);
  border-bottom: 1px solid rgba(255,255,255,.2);
  padding: 4px 5px 5px;
  display: inline-block;
}

div#bar2 span{
  height: 100%;
  display: block;
  background: #1DBFB1;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  -webkit-animation: pulse1 .6s infinite, grow .5s ease-out;
  -moz-animation: pulse1 .6s infinite, grow .5s ease-out;
  -ms-animation: pulse1 .6s infinite, grow .5s ease-out;
  -o-animation: pulse1 .6s infinite, grow .5s ease-out;
  animation: pulse1 .6s infinite, grow .5s ease-out;
}

div#bar2 span{
  background: #1DBFB1;
  -webkit-animation:pulse2 .6s infinite, grow .5s ease-out;
  -moz-animation:pulse2 .6s infinite, grow .5s ease-out;
  -ms-animation:pulse2 .6s infinite, grow .5s ease-out;
  -o-animation:pulse2 .6s infinite, grow .5s ease-out;
  animation:pulse2 .6s infinite, grow .5s ease-out;
}


@-webkit-keyframes pulse2 {
  0% {  box-shadow: white 0px 0px 8px; }
  50% {  box-shadow: white 0px 0px 4px; }
  100% {  box-shadow: white 0px 0px 8px; }
}

@-webkit-keyframes grow {
  0% {width: 0;}
}

@-moz-keyframes pulse1 {
  0% {  box-shadow: #ddd1ff 0px 0px 8px;  }
  50% {  box-shadow: #ddd1ff 0px 0px 4px; }
  100% {  box-shadow: #ddd1ff 0px 0px 8px; }
} 

@-moz-keyframes pulse2 {
  0% {  box-shadow: white 0px 0px 8px; }
  50% {  box-shadow: white 0px 0px 4px; }
  100% {  box-shadow: white 0px 0px 8px; }
}

@-moz-keyframes grow {
  0% {width: 0;}
}



@-ms-keyframes pulse2 {
  0% {  box-shadow: #8aff51 0px 0px 8px; }
  50% {  box-shadow: #8aff51 0px 0px 4px; }
  100% {  box-shadow: #8aff51 0px 0px 8px; }
}

@-ms-keyframes grow {
  0% {width: 0;}
}

@-o-keyframes pulse2 {
  0% {  box-shadow: #8aff51 0px 0px 8px; }
  50% {  box-shadow: #8aff51 0px 0px 4px; }
  100% {  box-shadow: #8aff51 0px 0px 8px; }
}

@-o-keyframes grow {
  0% {width: 0;}
}



@keyframes pulse2 {
  0% {  box-shadow: #8aff51 0px 0px 8px; }
  50% {  box-shadow: #8aff51 0px 0px 4px; }
  100% {  box-shadow: #8aff51 0px 0px 8px; }
}

@keyframes grow {
  0% {width: 0;}
}
</style>

<?php

require_once 'a/backend/functions.php';

include 'unique_random_alphanumeric.php';

include 'a/backend/connect.php';

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use Aws\Common\Exception\MultipartUploadException;   //for multipart upload
use Aws\S3\Model\MultipartUpload\UploadBuilder;

 use Guzzle\Http\EntityBody;

session_start();

require_once 'google-api-php-client/src/Google/autoload.php';



/************************************************
  We'll setup an empty 1MB file to upload.
 ************************************************/

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/fileupload.php
 ************************************************/
function getDp($id,$im){
  if($im != NULL) {

$r = str_replace("/s64/", "/s200/", $im );

// echo $im."<br>";
// echo $r;

$im1 = file_get_contents($r);

$s3 = S3Client::factory(array(
   'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "c4umM24NiRKoXYzZGF23k2IfSEH15WjNN9td/zC7",
   'region' => "ap-southeast-1"
));


$bucket= "documendz-ent";
$keyname = 'uploaded/user_'.$id.'/profile_image/dp.jpg';
            
try {
    // Upload data.
    $result = $s3->putObject(array(
        'Bucket' => $bucket,
        'Key'    => $keyname,
        'ContentType'  => 'image/jpeg',
        'Body'   => $im1
       
    ));

    

} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}
}
}


$client_id = '12504660612-jkfaqlf2dloo7eccnr5kjq9mfdi2m6g0.apps.googleusercontent.com';
$client_secret = 'UotuGH9qR0ERK1gSKLrOlTaE';
$redirect_uri = 'https://documendz.com/driveapp.php';
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/drive");
$service = new Google_Service_Drive($client);


if (isset($_REQUEST['logout'])) {
  unset($_SESSION['upload_token']);
}
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['upload_token'] = $client->getAccessToken();
  
}
if (isset($_SESSION['upload_token']) && $_SESSION['upload_token']) {
  $client->setAccessToken($_SESSION['upload_token']);
  if ($client->isAccessTokenExpired()) {
    unset($_SESSION['upload_token']);
  }
} else {
  $authUrl = $client->createAuthUrl();
}



if ($client->getAccessToken()) {
  // This is uploading a file directly, with no metadata associated.
  if (isset($_GET['state'])) {
    $type = "";
    $a = urldecode(urldecode($_GET['state'])); //we decode the value of 'state' parameter twice so we can get the file's ID
    $state = json_decode(stripslashes($a)); //if there are slashes used to export something
    $_SESSION['mode'] = $state->action;

  //a native file has 'ids' whereas a Google Doc file has exportIds, so accordingly we get 
  //the File's ID and then pass the file's type in printFile's call
  
    if (isset($state->ids)){
      $fileId = $state->ids;
      $type = "native"; 
    } else if(isset($state->exportIds)) {
       $fileId = $state->exportIds;
       $type = "gdoc";
    }
    if (isset($state->parentId)) {
      $_SESSION['parentId'] = $state->parentId;
    } else {
      $_SESSION['parentId'] = null;
    }        
    // $fileId = $_SESSION['fileIds'];
     $file1 = $service->files->get($fileId[0]);

    if($file1->getFileSize() > 10240000) {
      echo '<div style="background-color: #eee; text-align:center; width:100%; height:100%"><h1></h1><p style="padding-top: 21px;font-size: 21px;font-weight: 200;">Sorry, you cannot import files of size larger than 10MBs.</p></div>';
    }

    else {

      try {
            $about = $service->about->get();
            $user = $about->getUser();
            $email = $user['emailAddress'];
            $name = $user['displayName'];
            $im = $user['picture'];


            echo '<div id="processingWrapper" style="right:50%;bottom:50%;transform:translate(50%,50%);position:absolute;">Processing</div>'; //loading and progress bar
            $y = mysqli_query($dbhandle,"SELECT * FROM signup WHERE emailid ='".$email."'");
            $z = mysqli_fetch_array($y);
            $x = mysqli_num_rows($y);

            if($x > 0 ){  //if user exists

                $_SESSION['Username'] = $z['username'];
              $_SESSION['email'] = $email;
              $_SESSION['userid'] = $z['userid'];
              
              $fc =  mysqli_query($dbhandle,"SELECT count(*) as total from files where authid=".$_SESSION['userid']);
              $count = mysqli_fetch_assoc($fc);
            if($count['total']<$z['files']) {            
              $wr1 = mysqli_query($dbhandle,"SELECT uniqueId FROM workgroups WHERE auth_id =".$_SESSION['userid']." AND webapp=1");
              $w = mysqli_fetch_array($wr1);

              if(mysqli_num_rows($wr1) == 0) {
                // echo "no found";
                  $w1 = getToken(20);
                  mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,webapp) 
                                  VALUES ('".$w1."','My Files','It contains all files that you have opened directly from Gmail or Google drive.',". $_SESSION['userid'].",'".$_SESSION['Username']."',1)");

              }
              else {
                  $w1 = $w['uniqueId'];
                }

               getDp($z['userid'],$im['url']);
                printFile($service, $fileId[0], $type, $file1);
            }
            else {
                echo '<div style="background-color: #eee; text-align:center; width:100%; height:100%"><h1></h1><p style="padding-top: 21px;font-size: 21px;font-weight: 200;">You have reached the maximum file limit on your account.</p></div>';

            }
 

        }

        else if($x == 0){ //if a new user

            // echo "im in";
            

      mysqli_query($dbhandle, "INSERT INTO signup (username, password, emailid, gsign, verified, workgroups, files, collaborators) VALUES('".$name."','','".$email."',1,1,5,50,3)");    
        $i = mysqli_fetch_array(mysqli_query($dbhandle,"SELECT userid,username FROM signup WHERE emailid ='".$email."'"));
        /////  make user folder  ////

          $r1 = getToken(20);
            $r2 = getToken(20);
            
            $s1 = getToken(15);
            $s2 = getToken(15);
            $s3 = getToken(15);
            $s4 = getToken(15);
            
            $w1 = getToken(20);
        
        /// 2 sample wkgroups ///

          mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,sample) 
                                VALUES ('".$r1."','Documents (Sample)','This is where you can add a short description for your workgroup to let your collaborators know a few details about the files, deadlines, tasks that you need to complete. ',". $i['userid'].",'".$i['username']."',1),
                                       ('".$r2."','Designs (Sample)','Example: Let us get the final draft for these designs by 18th Dec. Add your designs and revisions here.',". $i['userid'].",'".$i['username']."',1)");
          
          mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,webapp) 
                                VALUES ('".$w1."','My Files','The files which you imported from your Google account.',". $i['userid'].",'".$i['username']."',1)");
          
        $my_date = date("Y-m-d H:i:s");

          mysqli_query($dbhandle,"INSERT INTO files VALUES('','".$s1."','Legal document.pdf','".$r1."',".$i['userid'].",'$my_date','pdf',11),
                                                          ('','".$s2."','Research paper.pdf','".$r1."',".$i['userid'].",'$my_date','pdf',12),
                                                ('','".$s3."','Creative design.jpg','".$r2."',".$i['userid'].",'$my_date','pdf',21),
                                                ('','".$s4."','Floor plan.jpg','".$r2."',".$i['userid'].",'$my_date','pdf',22)");
            

          mkdir('uploaded/uploaded_files_'.$i['userid'].'_original');
          mkdir('uploaded/jhg76'.$i['userid'].'kd84');

            $_SESSION['Username'] = $i['username'];
            $_SESSION['email'] = $email;
            $_SESSION['userid'] = $i['userid'];

           getDp($i['userid'],$im['url']);

              email($_SESSION['email'], $_SESSION['Username']);

            printFile($service, $fileId[0], $type, $file1);

       
      }
        
      } catch (Exception $e) {
        echo "Oops, something went wrong. Please report it here: ";
        //user's info was to be fetched and create account and/or folder(s)        
      }
  }

  }
}


function printFile($service, $fileId, $type, $file) {
  try {
    $flag = "";
    $ext = $file->getFileExtension();
    $title = $file->getTitle();
    $mime = $file->getMimeType();
    // print "Title: " . $title;
    // print "Description: " . $file->getDescription();
    // print "MIME type: " . $mime;
    //print "MIME type: " . $file->getWebContentLink();

    // if($file->getFileSize() > 10240) {
    //   echo "Sorry, file size cannot be more than 10MBs";
    // }
    // else {
    
//Check for native files that are to be converted to Google's Doc
if($ext == "docx" || $ext == "doc" || $ext == "ppt" || $ext == "pptx" || $ext == "xls" || $ext == "xlsx" || $ext == "odt" || $ext == "ods" || $ext== "txt") {
  
  $copiedFile = new Google_Service_Drive_DriveFile();
  $copiedFile->setTitle($title);
  $arr['convert'] = true; //parameter to be passed while we call copy function where we say to convert native to Google Doc
  $flag = "c"; //tells that the file will be exported as a pdf in the end

  try {
    $newfile =  $service->files->copy($fileId, $copiedFile, $arr); //make a copy of the file and get the file object
    $newId = $newfile->getId(); //get the new file's ID which will be used to fetch the converted file and then delete it
    
    downloadFile($newfile, $service, $flag,$mime, $title);
    $service->files->delete($newId);
  } catch (Exception $e) {
    $service->files->delete($newId);
      print "Oops, something went wrong. Please report it here: <br/>Error code: " . $e->getMessage();
    //file was to be converted and then that file is to be downloaded on server; and that converted file once used must be deleted.
  } 
}
else if($type == "gdoc") 
{
  $flag = "c"; //tells that the file will be exported as a pdf in the end
  downloadFile($file, $service, $flag,$mime, $title);

}
  else {
    $flag = "n";
    downloadFile($file, $service, $flag,$mime, $title);
  }
// }


  } catch (Exception $e) {
    print "Oops, something went wrong. Please report it here: <br/>Error code: " . $e->getMessage();
  }
}

function downloadFile($file, $service, $flag,$mime, $title) {

  try {
        $ext_check= array(
              "image/png"=> "png",
              "image/svg+xml"=> "svg",
              "application/x-shockwave-flash"=> "swf",
              "image/jpeg"=> "jpg",
              "image/bmp"=> "bmp",
              "application/pdf"=> "pdf",
              "application/vnd.openxmlformats-officedocument.wordprocessingml.document"=> "pdf",
              "application/vnd.openxmlformats-officedocument.presentationml.presentation" => "pdf",
              "application/vnd.ms-powerpoint" => "pdf",
              "application/vnd.ms-excel" => "pdf",
              "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "pdf",
              "application/msword" => "pdf",
              "text/plain" => "pdf",
              "application/vnd.google-apps.document" => "pdf",
              "application/vnd.google-apps.drawing" => "pdf",
              "application/vnd.google-apps.spreadsheet" => "pdf",
              "application/vnd.google-apps.presentation" => "pdf",
              "application/vnd.oasis.opendocument.text" => "pdf",


          );


   
        
       //if a convertable file, export it as PDF
       if ($flag == "c") {
        $fileId = $file->getId();
      
        $exportLinks = $file->getExportLinks();
        $downloadUrl = $exportLinks['application/pdf'];

       // echo "kjkjvb:   ".$downloadUrl;
    }

       //else get the original native file
       else if($flag == "n"){
          $downloadUrl = $file->getDownloadUrl();
       }
      if ($downloadUrl) {
        //use the downloadUrl to save the document on mentioned path
        $request = new Google_Http_Request($downloadUrl, 'GET', null, null);
        $httpRequest = $service->getClient()->getAuth()->authenticatedRequest($request);
        if ($httpRequest->getResponseHttpCode() == 200) {
             $unique_filename =getToken(15);
          file_put_contents('uploaded/uploaded_files_'.$_SESSION['userid'].'_original/'.$unique_filename.'.'.$ext_check[$mime], $httpRequest->getResponseBody());
          
          try {
                convert($title, $unique_filename, $ext_check[$mime], $mime);
            
          } catch (Exception $e) {
              print "Oops, something went wrong. Please report it here: <br/>Error code: " . $e->getMessage();
              //conversion failed
          }
              
        } else {
          // An error occurred.
          return null;
        }
      } else {
        // The file doesn't have any content stored on Drive.
        return null;
      }
        // file_put_contents("uploaded/demo/".$file->getTitle(), file_get_contents($file->getWebContentLink()));

    
  } catch (Exception $e) {
      print "Oops, something went wrong. Please report it here: <br/>Error code: " . $e->getMessage();
      //any kind of file(converted/native/google doc) comes here 
      //and from the details fetched, we upload the file and then convert it  
  }

   // print $file->getWebContentLink();


}

 
function convert($name,$unique_filename,$file_ext, $mimetype)
{
  global $w1, $dbhandle;

  $wgId = $w1;

 $html_file_dest = 'uploaded/jhg76'.$_SESSION['userid'].'kd84';


if($mimetype == "image/bmp" || $mimetype == "image/png" || $mimetype == "image/jpeg" || $mimetype == "image/svg+xml"){

//echo "I am here";
  /* the image file */
    $image = __DIR__.'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' .$unique_filename.'.'.$file_ext;
  
    /* a new imagick object */
    $im = new Imagick();
  
    /* ping the image */
    $im->pingImage($image);
  
    /* read the image into the object */
    $im->readImage( $image );
  
    /** convert to png */
    $im->setImageFormat( "pdf" );
  
    /* write image to disk */
    $im->writeImage( __DIR__.'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' .$unique_filename.'.pdf' );
  
    $d = $im->getImageGeometry();

    if ($d['width'] > 800) {
    
    pdf2html($html_file_dest,$unique_filename,$file,"800",$file_ext); 

    }
    else {
       
         pdf2html($html_file_dest,$unique_filename,$file,$d['width'],$file_ext);  

    }
  

  
  
  //mysql_query("INSERT INTO uploaded_files VALUES('','$ui','$file','$unique_filename','$file_ext')"); //When $_SESSION is used inside a
  
 
    $my_date = date("Y-m-d H:i:s");
    
  mysqli_query($dbhandle,"INSERT INTO files VALUES('','$unique_filename','$name','$wgId','$_SESSION[userid]','$my_date','$file_ext',0)"); //When $_SESSION is used inside a
echo "<script>window.location.href ='https://www.documendz.com/a/#/workgroups/g/".$w1."/".$_SESSION['userid'].$unique_filename."'</script>";

}

       // echo '<script>document.getElementById("start-message").style.display = "block"</script>';
             
  else{    

      pdf2html($html_file_dest,$unique_filename,$name,"800",$file_ext);
      $my_date = date("Y-m-d H:i:s");
    
  mysqli_query($dbhandle, "INSERT INTO files VALUES('','$unique_filename','$name','$wgId','$_SESSION[userid]','$my_date','$file_ext',0)"); //When $_SESSION is used inside a

 echo "<script>window.location.href ='https://www.documendz.com/a/#/workgroups/g/".$w1."/".$_SESSION['userid'].$unique_filename."'</script>";
}

}

function pdf2html($html_file_dest,$unique_filename,$file,$width,$ext) {
      
     $u = $_SESSION['userid'];    
     
     shell_exec('/usr/bin/php trial.php '.$unique_filename.' '.$u.' '.$ext.' > uploaded/tt.txt 2>&1 &');    
        
          header('Content-Type: text/HTML; charset=utf-8');
          header('Content-Encoding: none; ');
        
          // $cmd = "pdf2htmlEX --process-outline 0 --fit-width 800 --fit-height 1200 --dest-dir " . $html_file_dest . " uploaded/uploaded_files_".$_SESSION['userid'] . "_original/".$unique_filename.".pdf 2>&1 &"; 
          
            $cmd = "pdf2htmlEX --process-outline 0 --tounicode 1 --decompose-ligature 1 --fit-width ".$width." --dest-dir " . $html_file_dest . " uploaded/uploaded_files_".$_SESSION['userid'] . "_original/".$unique_filename.".pdf 2>&1 &"; //>>dta.log helps run the cmd even when a large amnt of data is printed on cmd page
          // This may be affecting stdout memory


          $descriptorspec = array(
              0 => array("pipe", "r"), // stdin is a pipe that the child will read from
              1 => array("pipe", "w"), // stdout is a pipe that the child will write to
              2 => array("pipe", "w")    // stderr is a pipe that the child will write to
          );
        
        
          $process = proc_open($cmd, $descriptorspec, $pipes, __DIR__);  //runs the pdf2html commmand as in cmd prompt
          //__DIR__ will set CWD
                    

           echo '<script>document.getElementById("processingWrapper").style.display = "none";</script>'; //loading and progress bar
           echo '<script>document.getElementById("bar2").style.display="block";</script>';
          if (is_resource($process)) {


            //stream_set_blocking($pipes[1],FALSE);  
            $s = fgets($pipes[1], 1024);
      
      
  
  
            $pos_slash = strpos(preg_replace('/\s+/', '', $s), '/', 0);
            $pos_p = strpos(preg_replace('/\s+/', '', $s), 'P', 1);
        
            $base = substr(preg_replace('/\s+/', '', $s), $pos_slash + 1, $pos_p - $pos_slash - 1); //provides max value for progress bar
            //initializing for preprocessing progress display
            $increment = 0.5 / $base;  //assumed
            $cnt = 0;
        
            while ($f = fgets($pipes[1], 50)) {
        
              $work_pos = strrpos(preg_replace('/\s+/', '', $f), 'Working:');
              $base_pos = strrpos(preg_replace('/\s+/', '', $f), '/');
        
              if ($work_pos !== false) {  //When working: has not been started
                $cnt++;
              }
        
              if ($cnt == 0) {  //When first 'Working:' detected
                $increment = ceil($increment);
          
                ob_flush();
                flush();
                $increment++;



              }


              if ($work_pos !== false && $base_pos !== false && ($base_pos > $work_pos)) {
                $work_pos = strrpos(preg_replace('/\s+/', '', $f), 'Working:') + 7; //to get end position of 'Working:'
                $value = substr(preg_replace('/\s+/', '', $f), $work_pos + 1, $base_pos - $work_pos - 1);
                $prog_val = ceil($increment + ($value * ($base - $increment)) / $base);
                
                echo '<script>document.getElementById("bar3").style.width ="'.$prog_val.'%";</script>'; //loading and progress bar

                ob_flush();
                flush();
              }
            }
            if ($prog_value !== $base) {   // will be called everytime the process runs after conversion
          
            
function gzCompressFile($source,$gzdest,$level = 9){ 
    $dest = $gzdest; 
    $mode = 'wb' . $level; 
    $error = false; 
    if ($fp_out = gzopen($dest, $mode)) { 
        if ($fp_in = fopen($source,'rb')) { 
            while (!feof($fp_in)) 
                gzwrite($fp_out, fread($fp_in, 1024 * 512)); 
            fclose($fp_in); 
        } else {
            $error = true; 
        }
        gzclose($fp_out); 
    } else {
        $error = true; 
    }
    if ($error)
        return false; 
    else
        return $dest; 
} 

gzCompressFile($html_file_dest.'/'.$unique_filename.'.html',$html_file_dest.'/'.$unique_filename.'_gz.html');
///////multipart uploader to s3 in parallel for speed//////////

 $s3 = S3Client::factory(array(
   'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));

$uploader = UploadBuilder::newInstance()
    ->setClient($s3)
    ->setSource($html_file_dest.'/'.$unique_filename.'_gz.html')
    ->setBucket('documendz-ent')
    ->setKey('uploaded/user_'. $_SESSION["userid"].'/converts/'.$unique_filename.'.html')
    ->setHeaders(array('Content-Encoding'=>'gzip'))
    ->setConcurrency(4)
    ->build();


try {
    $uploader->upload();
    
} catch (MultipartUploadException $e) {
    $uploader->abort();
    echo "Upload failed.\n";
}

unlink($html_file_dest.'/'.$unique_filename.'.html');
unlink($html_file_dest.'/'.$unique_filename.'_gz.html');
              

            };
            
            fclose($pipes[1]); // no idea why it is written :P
            proc_close($process);
                      
}
            
$n = mysql_real_escape_string($_SESSION['userid']);
      
$uploaded_file_id = mysql_query("SELECT max(file_id) FROM uploaded_files WHERE user_id =" . $n);
$uploaded_file_id = mysql_fetch_array($uploaded_file_id, MYSQL_NUM);
       
        
        }
  
function email($e,$n){

require_once 'mandrill/src/Mandrill.php';


$s = "Collaborating on documents was never this easy";
$m = 'Thank you for signing up for a free trial of Documendz.<br/>
      With Documendz you can: <ul>
        <li>Provide feedback on resumes or documents. This will be instantly shared with your collaborators</li>
        <li>Easily highlight, circle, underline or strike through text on legal documents and contracts</li>
        <li>Work on a proposal with your team member spread out in multiple locations in real time.</li>
      </ul>
      Click on the lnk to sign in to your workspace. Start adding collaborators, 
      and upload documents to get started.
      <a href="https://documendz.com">Documendz</a><br/> 
      Banish long email chains, save time, and avoid confusion.<br/><br/>
      Cheers! <br/>
      Sagar<br/>
      Co-Founder, Documendz<br/><br/>
PS: I would love to know what made you sign up for Documendz. 
Reply to this email or write to <a href="mailto:feedback@documendz.com" target="_blank">feedback@documendz.com</a> 
Your feedback will help us make it better :)';

$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Simples-Minimalistic Responsive Template</title>
      
      <style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.*/
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         a {color: #0a8cce;text-decoration: none;text-decoration:none!important;}
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         /*IPAD STYLES*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         img[class=banner] {width: 440px!important;height:220px!important;}
         img[class=colimg2] {width: 440px!important;height:220px!important;}
         
         
         }
         /*IPHONE STYLES*/
         @media only screen and (max-width: 480px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         img[class=banner] {width: 280px!important;height:140px!important;}
         img[class=colimg2] {width: 280px!important;height:140px!important;}
         td[class=mobile-hide]{display:none!important;}
         td[class="padding-bottom25"]{padding-bottom:25px!important;}
        
         }
      </style>
   </head>
   <body>
<!-- Start of preheader -->
     



<!-- Start Full Text -->
<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                       <tbody>
                                          <!-- Title -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #343434; text-align:left; line-height: 30px;" st-title="fulltext-heading">
                                                Hello '.$n.',
                                             </td>
                                          </tr>
                                          <!-- End of Title -->
                                  
                  
                                         
                                          <!-- End of content -->
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>

<table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                      
                            
                              <tr>
                                 <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                       <tbody>
                                  
                                  
                                          <!-- content -->
                                          <tr>
                                             <td style="font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #343434; text-align:left; line-height: 30px;" st-content="fulltext-content">
                                              '.$m.'
                                             </td>
                                          </tr>
                                          <!-- End of content -->
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>
                              <!-- Spacing -->
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>


<!-- End of postfooter -->
   
   </body>
   </html>';
try{
$mandrill = new Mandrill("L6NsmnJBpL-IAeJuJWzA8g");

$message = new stdClass();
$message->html = $content;

$message->subject = $s;
$message->from_email = "sagar.tamboli@documendz.com";
$message->from_name  = "Sagar from Documendz";
$message->to = array(array("email" => $e));
$message->track_opens = true;
$message->track_clicks = true;
$message ->tags = array('welcome-webapp');
$response = $mandrill->messages->send($message);
echo "1";
} catch (Mandrill_error $e) {
   echo "Something went wrong, please try again"; 
}

}

?>