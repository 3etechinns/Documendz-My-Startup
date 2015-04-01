

<?php

require_once 'functions.php';


session_start();
include 'connect.php';
include 'unique_random_alphanumeric.php';

    
    include 'connect.php';
 
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use Aws\Common\Exception\MultipartUploadException;   //for multipart upload
use Aws\S3\Model\MultipartUpload\UploadBuilder;

 use Guzzle\Http\EntityBody;
// if (isset($_POST['drp-file-url'])) {


// 	$url = $_POST['drp-file-url'];
// 	$size = $_POST['drp-file-size'];
// 	$name = $_POST['drp-file-name'];



    if (isset($_FILES['file'])) {          // When upload is pressed file should be uploaded
    
    $wgId = $_POST['wgId'];
$og = $_POST['ogFile'];

    // echo'<script> parent.document.getElementById("iframe_upload_message").innerHTML = "";</script>';    
    // echo'<script>display_progress();</script>';
    
        // $file_cnt = count($_FILES['file']['name']);

        

// set_time_limit(0);
// $fp = fopen (dirname(__FILE__) . '/localfile', 'w+');//This is the file where we save the information
// $ch = curl_init($url);//Here is the file we are downloading, replace spaces with %20
// curl_setopt($ch, CURLOPT_TIMEOUT, 50);
// curl_setopt($ch, CURLOPT_FILE, $fp); // write curl response to file
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// curl_exec($ch); // get curl response
// curl_close($ch);
// fclose($fp);


// $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension

//    $type = finfo_file($finfo, 'localfile');

// finfo_close($finfo);



        
        for ($i = 0; $i <= 0; $i++) {

            $file = $_FILES['file']['name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];




            // $file = $name;
            // $file_type = $type;
            // $file_size = $size;
            // $file_tmp =  'localfile';


        
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            $unique_filename =getToken(15);
            $file_name_html = $unique_filename . ".html"; //appending html extension to the uploaded file
          
	  $allowed_files = array("image/png"  ,  "image/svg+xml" , "application/x-shockwave-flash" , "image/jpeg" , "image/bmp" , "application/pdf","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword");
            
	    
	    
	    if ($file_size > 4096000 || $file_size == 0 || !in_array($file_type,$allowed_files)) {
	
	    			echo "some error";

		
            }

             else {

           
                //then, remove single quotes '' from the variable
                // as $_SESSION[userid] and not $_SESSION['userid']  
                //This runs PDF2HTMLEX command to convert pdf to HTML
                $html_file_dest = 'uploaded/jhg76'.$_SESSION['userid'].'kd84';


//            shell_exec('pdf2htmlEX --zoom 1.3  --override-fstype 1 --dest-dir '.$html_file_dest.' uploaded/uploaded_files_'.$_SESSION[userid].'_original/'.$file );

 
// declaring the function 
// declaring the function 
function ParseHeader($header='')
{
	$resArr = array();
	$headerArr = explode("\n",$header);
	foreach ($headerArr as $key => $value) {
		$tmpArr=explode(": ",$value);
		if (count($tmpArr)<1) continue;
		$resArr = array_merge($resArr, array($tmpArr[0] => count($tmpArr) < 2 ? "" : $tmpArr[1]));
	}
	return $resArr;
}

function CallToApi($fileToConvert, $pathToSaveOutputFile, $apiKey, &$message,$unique_filename)
{
		try
		{
			
		
			$fileName = $unique_filename.".pdf";
			 
			$postdata =  array('OutputFileName' => $fileName, 'ApiKey' => $apiKey, 'file'=>"@".$fileToConvert);
			$ch = curl_init("http://do.convertapi.com/word2pdf");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
  			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			$result = curl_exec($ch); 
			$headers = curl_getinfo($ch);
			
			$header=ParseHeader(substr($result,0,$headers["header_size"]));
			$body=substr($result, $headers["header_size"]);
			
			curl_close($ch);
			if ( 0 < $headers['http_code'] && $headers['http_code'] < 400 ) 
			{
				// Check for Result = true
				
				if (in_array('Result',array_keys($header)) ?  !$header['Result']=="True" : true)
				{
					$message = "Something went wrong with request, did not reach ConvertApi service.<br />";
			 		return false;
				}
				// Check content type 
				if ($headers['content_type']<>"application/pdf")
				{
			 		$message = "Exception Message : returned content is not PDF file.<br />";
			 		return false;
				}
				$fp = fopen($pathToSaveOutputFile.$fileName, "wbx");
				
				fwrite($fp, $body);

				$message = "The conversion was successful! The word file $fileToConvert converted to PDF and saved at $pathToSaveOutputFile$fileName";
				return true;
			}
			else 
			{
			 $message = "Exception Message : ".$result .".<br />Status Code :".$headers['http_code'].".<br />";
			 return false; 
			}
		}
		catch (Exception $e) 
		{	
			$message = "Exception Message :".$e.Message."</br>";
			return false; 
		}
}
 


function pdf2html($html_file_dest,$unique_filename,$file,$width,$ext) {
      
     $u = $_SESSION['userid'];    
     shell_exec('/usr/bin/php trial.php '.$unique_filename.' '.$u.' '.$ext.' > uploaded/tt.txt 2>&1 &');    
        
        	header('Content-Type: text/HTML; charset=utf-8');
        	header('Content-Encoding: none; ');
        
        	// $cmd = "pdf2htmlEX --process-outline 0 --fit-width 800 --fit-height 1200 --dest-dir " . $html_file_dest . " uploaded/uploaded_files_".$_SESSION['userid'] . "_original/".$unique_filename.".pdf 2>&1 &"; 
        	
   	        $cmd = "pdf2htmlEX --process-outline 0 --fit-width ".$width." --dest-dir " . $html_file_dest . " uploaded/uploaded_files_".$_SESSION['userid'] . "_original/".$unique_filename.".pdf 2>&1 &"; //>>dta.log helps run the cmd even when a large amnt of data is printed on cmd page
	        // This may be affecting stdout memory


        	$descriptorspec = array(
        			0 => array("pipe", "r"), // stdin is a pipe that the child will read from
        			1 => array("pipe", "w"), // stdout is a pipe that the child will write to
        			2 => array("pipe", "w")    // stderr is a pipe that the child will write to
        	);
        
        
        	$process = proc_open($cmd, $descriptorspec, $pipes, __DIR__);  //runs the pdf2html commmand as in cmd prompt
        	//__DIR__ will set CWD
    	
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
        				
        				ob_flush();
        				flush();
        			}
        		}
        		if ($prog_value !== $base) {   // will be called everytime the process runs after conversion
        	
       			

///////multipart uploader to s3 in parallel for speed//////////

 
$s3 = S3Client::factory(array(
     'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));

$uploader = UploadBuilder::newInstance()
    ->setClient($s3)
    ->setSource($html_file_dest.'/'.$unique_filename.'.html')
    ->setBucket('documendz-ent')
    ->setKey('uploaded/user_'. $_SESSION["userid"].'/versions/'.$unique_filename.'.html')
    ->setConcurrency(4)
    ->build();


try {
    $uploader->upload();
    
} catch (MultipartUploadException $e) {
    $uploader->abort();
    echo "Upload failed.\n";
}



echo $unique_filename;

        		};
        		
        		fclose($pipes[1]); // no idea why it is written :P
        		proc_close($process);
        		        	
}
            
$n = mysql_real_escape_string($_SESSION['userid']);
	    
$uploaded_file_id = mysql_query("SELECT max(file_id) FROM uploaded_files WHERE user_id =" . $n);
$uploaded_file_id = mysql_fetch_array($uploaded_file_id, MYSQL_NUM);
       
       	
        }
              
                
                
   
   
   
   switch($file_type) {
   
case "image/png":
case "image/svg+xml":
case "application/x-shockwave-flash":
case "image/jpeg":
case "image/bmp":
	  

	try
	{
            
	$ui = mysql_real_escape_string($_SESSION[userid]);
	$file = mysql_real_escape_string($file);
	$unique_filename = mysql_real_escape_string($unique_filename);
	$file_ext = mysql_real_escape_string($file_ext);

        // echo '<script>document.getElementById("start-message").style.display = "block"</script>';
            
		move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.'.$file_ext);
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
	
	$name = mysql_real_escape_string($file);
    $my_date = date("Y-m-d H:i:s");
		
	mysql_query("INSERT INTO versions VALUES('','$og','$unique_filename','$_SESSION[userid]','$my_date','$file_ext')"); //When $_SESSION is used inside a


 
		
		
		  
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	
    break;

    case "application/pdf":
        


	$name = mysql_real_escape_string($file);
	
       // echo '<script>document.getElementById("start-message").style.display = "block"</script>';
    	rename($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.pdf');
    	 
    	pdf2html($html_file_dest,$unique_filename,$name,"800",$file_ext);
	$my_date = date("Y-m-d H:i:s");
		
	mysql_query("INSERT INTO versions VALUES('','$og','$unique_filename','$_SESSION[userid]','$my_date','$file_ext')"); //When $_SESSION is used inside a




 
    	break;


case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
    
    
    move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.docx');
    
    //////////////  cloud conversion initiated   /////////////////
    



$physicalPath = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/';
	
	
	$uploadedFile = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.docx' ;
	
	$apiKey = 293619483;
	
	chmod($uploadedFile,0755);
	$result = CallToApi($uploadedFile, $physicalPath, $apiKey, $message,$unique_filename);

	$name = mysql_real_escape_string($file);

pdf2html($html_file_dest,$unique_filename,$name,"800","docx");

$my_date = date("Y-m-d H:i:s");
mysql_query("INSERT INTO versions VALUES('','$og','$unique_filename','$_SESSION[userid]','$my_date','$file_ext')"); //When $_SESSION is used inside a


/* move to a diff location */



// $s3 = S3Client::factory(array(
//    'key' => "AKIAJD2CWX4IQ6USEPGA",
//    'secret' => "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",
//    'region' => "ap-southeast-1"
// ));

// $filepath = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.docx';
// $bucket = 'docs-ent';
// $keyname = 'uploaded/user_'. $_SESSION["userid"].'/original/'.$unique_filename.'.docx';

// try{
//  $result = $s3 -> putObject(array(
//    'Bucket'       => $bucket,
//    'Key'          => $keyname,
//    'SourceFile'   => $filepath

// ));



// unlink($filepath);
// unlink('uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.docx'); 

 
// }

// catch(S3Exception $e){
     
//    echo 'Failed to upload';

//    }

   
// $filepath = $html_file_dest.'/'.$unique_filename.'.html';
// $bucket = 'docs-ent';
// $keyname = 'uploaded/user_'. $_SESSION["userid"].'/converts/'.$unique_filename.'.html';

// try{
//  $result = $s3 -> putObject(array(
//    'Bucket'       => $bucket,
//    'Key'          => $keyname,
//    'SourceFile'   => $filepath

// ));



// unlink($filepath);
// unlink($html_file_dest.'/'.$unique_filename.'.html'); 

 
// }

// catch(S3Exception $e){
     
//    echo 'Failed to upload';

//    }

 
    break;



case "application/msword":
    
    
    move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.doc');
    
    //////////////  cloud conversion initiated   /////////////////
    



$physicalPath = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/';
	
	
	$uploadedFile = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.doc' ;
	
	$apiKey = 293619483;
	
	chmod($uploadedFile,0755);
	$result = CallToApi($uploadedFile, $physicalPath, $apiKey, $message,$unique_filename);

	$name = mysql_real_escape_string($file);

pdf2html($html_file_dest,$unique_filename,$name,"800","doc");

$my_date = date("Y-m-d H:i:s");
mysql_query("INSERT INTO versions VALUES('','$og','$unique_filename','$_SESSION[userid]','$my_date','$file_ext')"); //When $_SESSION is used inside a
 
    break;

    
default: 
    break;
   
}             

      
}
       
        }
        
	die;
    }
    
    else{
             
            // echo '<script> parent.document.getElementById("iframe_upload_message").innerHTML = "Currently only Pdfs and images upto 4MB are supported. Support for other file types will be added soon";</script>';
            // echo '<script>window.parent.$("#feedback_close_iframe").removeClass("disabled");</script>';
	    // echo'<script>document.getElementById("start-message").style.display = "none";</script>';
	    // echo'<script>window.parent.$("#top-image").attr("src","images/cross.png");</script>';
	    // echo '<script>document.getElementById("display_progress").style.display = "none";</script>';

	    echo "error2";
	}


    
    ?>