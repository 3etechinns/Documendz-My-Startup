<body>

<div style="display:block; color: grey;padding: 8px;" id="start-message">Processing your file ...</div>
<div style="display:none; color: grey;padding: 8px;" id="end-message">File uploaded successfully</div>

<div style="display:none; padding-top:8px;" id = "display_progress" >
    
    <progress id = "prog" value="0" max="100"></progress> 
    <img style="float: left;margin-right: 5px;margin-left: 8px;" src="images/file_uploading.gif">
    
    <div style="color:rgb(100, 102, 104);margin-top: 13px;margin-left: 8px;" id = "progress_indicator"></div>
    </div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">


   
    function display_progress(){
    
//    alert ("progress");
    document.getElementById("display_progress").style.display = "block";
    
    }
 


function progress(base, value, session_user_id,file_name) //assigns value and max to progress bar in html
    {
        
        var encodedStr = file_name.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
            return '&#' + i.charCodeAt(0) + ';';
        });

        document.getElementById('progress_indicator').innerHTML = "<strong>"+file_name +" </strong> : "+value + "/" + base + " pages";
        document.getElementById('prog').value = value;
        document.getElementById('prog').max = base;
    }
    
    
    function progress_100_complete(base, value, session_user_id, file_name,file) { //To be called only when progress 100% to hide prgress bar and display form

        var encodedStr = file_name.replace(/[\u00A0-\u9999<>\&]/gim, function(i) { //encode file name 'filemane.html' #htmlentities
            return '&#' + i.charCodeAt(0) + ';';
        });

        if (value == base && base != '') {             //if fully loaded hide progress bar
            document.getElementById('prog').value = value;
            document.getElementById('prog').max = base;
            document.getElementById('progress_indicator').innerHTML = value + "/" + base + "pages";
            
	    
	    window.setTimeout(function() {
                document.getElementById("display_progress").style.display = "none";
                document.getElementById('prog').value = 0;
            document.getElementById('prog').max = 100;
            document.getElementById('progress_indicator').innerHTML ="";
	    
	     document.getElementById("start-message").style.display = "none";
	     document.getElementById("end-message").style.display = "block";
	     window.parent.$("#feedback_close_iframe").removeClass("disabled");
	     window.parent.$("#top-image").attr("src","images/right.png");
	    
            },1500);

	 
	       
	       
	         
            theParent = document.getElementById("self_uploaded"); //Append form when upload and convert done
            theKid = document.createElement("form");
            theKid.enctype = "multipart/form-data";
            $(theKid).addClass("share-file-form");    //theKid.class cannot work, hence jquery
            theKid.method = "POST";
            theKid.innerHTML ="<input type='text' class='form-control input-sm' style='width:180px;margin-bottom:10px' name='Email' placeholder='Emailid' /> "
                    + "<input type='hidden' name='unique_filename' value='" + encodedStr + "' /> "
                    + "<input type='hidden' name='file_name' value="+file+">"
                    + "<input id='send-file-button'type='submit' class='btn btn-primary btn-sm' name='share_file' value='Send' />";

                     
            theKid = "<div class='individual_file_container' data-file-identity ='"+file_name+"'>"+
	    
	    "<table width='520px' table-layout='fixed' style='margin-bottom:2px;'>"+
	      "<tr>"+
	       "<td width='20px' ><i class='glyphicon glyphicon-file' style='color:#393c3f'></i></td>"+
	    "<td width='350px'><a class='file_name self_view' style='color:#393c3f;' name='file_name' href='uploaded/jhg76"+ session_user_id +"kd84/" + file_name + ".html?file=" +file+ "&key=0'> " + file + "</a></td>"+
	    "<td width='130px' style='text-align:right;' ><a><i class='glyphicon glyphicon-remove delete_file'></i></a></td>"+
	    "</tr></table>"+
	    
            "<table width='520px' table-layout='fixed' style='margin-bottom:2px;'>"+
	    "<tr>"+
	    "<td width='200px' ><div class='dropdown'>"+
            
	    
            "<a class='dropdown-toggle btn btn-success btn-xs' href='#' data-toggle='dropdown'>Share&nbsp;<i class='glyphicon glyphicon-share-alt'></i></a>"+
	    
            "<div class='dropdown-menu' style='padding: 15px;'>"+theKid.outerHTML+
            
            "</div></div>" +
	    "</td>"+
	    "<td width='100px'><span class='badge new-review-count'></span></td>"+
	    
	    "<td width='200px' style='text-align:right;'><div class='dropdown keep-open'>"+
	    
            "<a class='dropdown-toggle' data-toggle='dropdown' href='#'><i class='glyphicon glyphicon-list'></i>&nbsp;Shared files</a>" +
            	
            "<ul class='share_summary_container dropdown-menu' style='left: 104%;width: 400px;top: -140%'>"+
			"<li class='ssc-content ssc-header'>"+
			
			
			"<table cellpadding='0' cellspacing='0' style='table-layout:fixed; width:400px'>"+
    "<tr>"+
    "<td style='width: 40%;text-align:center;overflow:hidden'><i class='glyphicon glyphicon-user'></i></td>"+
    "<td style='width: 15%;text-align: center;'><i class='glyphicon glyphicon-eye-open'></i></td>"+
    "<td style='width: 15%;text-align: center;'><i class='glyphicon glyphicon-calendar'></i></td>"+
    "<td style='width: 30%;text-align: center;'><i class='glyphicon glyphicon-time'></i></td>"+
    "</tr>"+
  "</table>"+
			

            "</li>"+
            
			"</ul>"+
			"</div>"+
			
			"</td></tr></table>"+
            "</div>";
        

            
// append theKid to the end of theParent
           
            window.parent.$("#self_uploaded_no_search").after(theKid);
	     window.parent.$(".self_view").colorbox({iframe:true, width:"80%", height:"90%"});
            /* theParent.appendChild(theKid); */


        }
    }
         
         
  
 function update_limit(){
  
    
   $.ajax({
        type:"POST",
        cache:false,
        url:"hb7s6/limit_update/",
	datatype: "text",
	data:{update_check : "update_it"},
	success: function(){
	
	 var new_used = window.parent.$("#file-remain-progress").val() + 1;
	
	 window.parent.$("#file-remain-text").html(new_used);
	 
	 
	}
 });
  
  
 }        
         
         
</script>


<?php

require_once 'functions.php';
require_once 'email.php';

session_start();
include 'connect.php';
include 'unique_random_alphanumeric.php';

include 'connect.php';
 
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
 

  
    if (isset($_FILES['file'])) {          // When upload is pressed file should be uploaded
    
    echo'<script> parent.document.getElementById("iframe_upload_message").innerHTML = "";</script>';
    echo'<script> parent.document.getElementById("loading_display").style.display = "none";</script>';
    echo'<script>parent.document.getElementById("viewit").checked = "false";</script>';
    echo'<script>display_progress();</script>';
    
        $file_cnt = count($_FILES['file']['name']);

        
        
        for ($i = 0; $i <= $file_cnt - 1; $i++) {

            $file = $_FILES['file']['name'][$i];
            $file_type = $_FILES['file']['type'][$i];
            $file_size = $_FILES['file']['size'][$i];
            $file_tmp = $_FILES['file']['tmp_name'][$i];

        
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            $unique_filename =getToken(8);
            $file_name_html = $unique_filename . ".html"; //appending html extension to the uploaded file
          
	  $allowed_files = array("application/msword","application/vnd.openxmlformats-officedocument.wordprocessingml.document","image/png"  ,  "image/svg+xml" , "application/x-shockwave-flash" , "image/jpeg" , "image/bmp" , "application/pdf");
            
	    
	    
	    if ($file_size > 4096000 || $file_size == 0 || !in_array($file_type,$allowed_files)) {
                echo '<script> parent.document.getElementById("iframe_upload_message").innerHTML = "Currently images, pdf and word files upto 4MB are supported. Support for other file types will be added soon";</script>';
		echo '<script>window.parent.$("#feedback_close_iframe").removeClass("disabled");</script>';
		echo'<script>document.getElementById("start-message").style.display = "none";</script>';
		echo'<script>window.parent.$("#top-image").attr("src","images/cross.png");</script>';
		echo '<script>document.getElementById("display_progress").style.display = "none";</script>';
		echo'<script> parent.document.getElementById("loading_display").style.display = "none";</script>';
            }

             else {

                
                //then, remove single quotes '' from the variable
                // as $_SESSION[userid] and not $_SESSION['userid']  
                //This runs PDF2HTMLEX command to convert pdf to HTML
                $html_file_dest = 'uploaded/jhg76'.$_SESSION['userid'].'kd84';
//            shell_exec('pdf2htmlEX --zoom 1.3  --override-fstype 1 --dest-dir '.$html_file_dest.' uploaded/uploaded_files_'.$_SESSION[userid].'_original/'.$file );

 
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


               
function pdf2html($html_file_dest,$unique_filename,$file) {
        
       
        
        	header('Content-Type: text/HTML; charset=utf-8');
        	header('Content-Encoding: none; ');
        
        	$cmd = "pdf2htmlEX --process-outline 0 --fit-width 800 --fit-height 1200 --dest-dir " . $html_file_dest . " uploaded/uploaded_files_".$_SESSION['userid'] . "_original/".$unique_filename.".pdf 2>&1 &"; //>>dta.log helps run the cmd even when a large amnt of data is printed on cmd page
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
        				echo "<script>progress(" . $base . "," . $increment . "," . $_SESSION[userid] . ",'" . $file . "') </script>";
        				ob_flush();
        				flush();
        				$increment++;
        			}
        

        			if ($work_pos !== false && $base_pos !== false && ($base_pos > $work_pos)) {
        				$work_pos = strrpos(preg_replace('/\s+/', '', $f), 'Working:') + 7; //to get end position of 'Working:'
        				$value = substr(preg_replace('/\s+/', '', $f), $work_pos + 1, $base_pos - $work_pos - 1);
        				$prog_val = ceil($increment + ($value * ($base - $increment)) / $base);
        				echo "<script>progress(" . $base . "," . $prog_val . "," . $_SESSION[userid] . ",'" . $file . "') </script>";   //calls js function to iterate progress in progress bar
        				ob_flush();
        				flush();
        			}
        		}
        		if ($prog_value !== $base) {   // will be called everytime the process runs after conversion
        			echo "<script>progress_100_complete(" . $base . "," . $base . "," . $_SESSION['userid'] . ",'" . $unique_filename . "','".$file."') </script>";
        		};
        		
        		fclose($pipes[1]); // no idea why it is written :P
        		proc_close($process);
        		        	
}
            
$n = mysql_real_escape_string($_SESSION['userid']);
	    
$uploaded_file_id = mysql_query("SELECT max(file_id) FROM uploaded_files WHERE user_id =" . $n);
$uploaded_file_id = mysql_fetch_array($uploaded_file_id, MYSQL_NUM);
       
       
/////////////////////////////  
//// update limit feature ///
/////////////////////////////

echo '<script>update_limit();</script>';
	
        }
              
                
                
   
   
   
   switch($file_type) {
   
case "image/png":
case "image/svg+xml":
case "application/x-shockwave-flash":
case "image/jpeg":
case "image/bmp":
	  

	try
	{
            
            echo '<script>document.getElementById("start-message").style.display = "block"</script>';
            
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
	
		
		/* move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.pdf'); */
		pdf2html($html_file_dest,$unique_filename,$file);
		
	
	$ui = mysql_real_escape_string($_SESSION[userid]);
	$file = mysql_real_escape_string($file);
	$unique_filename = mysql_real_escape_string($unique_filename);
	$file_ext = mysql_real_escape_string($file_ext);
	
	
	mysql_query("INSERT INTO uploaded_files VALUES('','$ui','$file','$unique_filename','$file_ext')"); //When $_SESSION is used inside a
		
		   $s3 = S3Client::factory(array(
	   'key' => "AKIAJ7CNKUCZLU6QSABA",
	   'secret' => "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",
	   'region' => "ap-southeast-1"
	   ));

		 $filepath =  "uploaded/uploaded_files_". $_SESSION['userid'] . "_original/". $unique_filename.".".$file_ext;
		 $bucket = "documendz.beta";
		 $keyname = $filepath;

		 try{
			 $result = $s3 -> putObject(array(
			   'Bucket'       => $bucket,
			   'Key'          => $keyname,
			   'SourceFile'   => $filepath
			
			));
			
			unlink($filepath);
			unlink("uploaded/uploaded_files_". $_SESSION['userid'] . "_original/". $unique_filename.".pdf"); //delete the pdf form of uploaded image	 
			
			 
			}
			catch(S3Exception $e){
			     
			   echo 'Failed to upload';
			
			   }
		 
		 
		
		
		  
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	
    break;

    case "application/pdf":
        
        echo '<script>document.getElementById("start-message").style.display = "block"</script>';
    	move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.pdf');
    	 
    	pdf2html($html_file_dest,$unique_filename,$file);
	
		
	mysql_query("INSERT INTO uploaded_files VALUES('','$_SESSION[userid]','$file','$unique_filename','$file_ext')"); //When $_SESSION is used inside a

/* move to a diff location */


$s3 = S3Client::factory(array(
    'key' => "AKIAJ7CNKUCZLU6QSABA",
    'secret' => "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",
    'region' => "ap-southeast-1"
));

$filepath = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.pdf';
$bucket = 'documendz.beta';
$keyname = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'.$unique_filename.'.pdf';

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

/***********************************/

 
    	break;


case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
    
    echo '<script>document.getElementById("start-message").style.display = "block"</script>';
    move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.docx');
    
    //////////////  cloud conversion initiated   /////////////////
    



$physicalPath = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/';
	
	
	$uploadedFile = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.docx' ;
	
	$apiKey = 293619483;
	
	chmod($uploadedFile,0755);
	$result = CallToApi($uploadedFile, $physicalPath, $apiKey, $message,$unique_filename);


pdf2html($html_file_dest,$unique_filename,$file);


mysql_query("INSERT INTO uploaded_files VALUES('','$_SESSION[userid]','$file','$unique_filename','$file_ext')"); //When $_SESSION is used inside a

/* move to a diff location */



$s3 = S3Client::factory(array(
   'key' => "AKIAJD2CWX4IQ6USEPGA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));

$filepath = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.docx';
$bucket = 'zofler';
$keyname = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'.$unique_filename.'.docx';

try{
 $result = $s3 -> putObject(array(
   'Bucket'       => $bucket,
   'Key'          => $keyname,
   'SourceFile'   => $filepath

));

unlink($filepath);
unlink('uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.pdf'); 

 
}
catch(S3Exception $e){
     
   echo 'Failed to upload';

   }

    //////////////// cloud conversion ends    //////////////////
 
    break;

case "application/msword":
    
    echo '<script>document.getElementById("start-message").style.display = "block"</script>';
    move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.doc');
    
    //////////////  cloud conversion initiated   /////////////////
    



$physicalPath = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/';
	
	
	$uploadedFile = dirname(__FILE__).'/uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.doc' ;
	
	$apiKey = 293619483;
	
	chmod($uploadedFile,0755);
	$result = CallToApi($uploadedFile, $physicalPath, $apiKey, $message,$unique_filename);


pdf2html($html_file_dest,$unique_filename,$file);


mysql_query("INSERT INTO uploaded_files VALUES('','$_SESSION[userid]','$file','$unique_filename','$file_ext')"); //When $_SESSION is used inside a

/* move to a diff location */



$s3 = S3Client::factory(array(
   'key' => "AKIAJD2CWX4IQ6USEPGA",
   'secret' => "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",
   'region' => "ap-southeast-1"
));

$filepath = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.doc';
$bucket = 'zofler';
$keyname = 'uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'.$unique_filename.'.doc';

try{
 $result = $s3 -> putObject(array(
   'Bucket'       => $bucket,
   'Key'          => $keyname,
   'SourceFile'   => $filepath

));

unlink($filepath);
unlink('uploaded/uploaded_files_'. $_SESSION["userid"].'_original/'. $unique_filename.'.pdf'); 

 
}
catch(S3Exception $e){
     
   echo 'Failed to upload';

   }

    //////////////// cloud conversion ends    //////////////////
 
    break;



    
default: 
    break;
   
}             

      
}
       
        }
        
	die;
    }
    
    else{
            
            echo '<script> parent.document.getElementById("iframe_upload_message").innerHTML = "Currently images, pdf and word files upto 4MB are supported. Support for other file types will be added soon";</script>';
            echo '<script>window.parent.$("#feedback_close_iframe").removeClass("disabled");</script>';
	    echo'<script>document.getElementById("start-message").style.display = "none";</script>';
	    echo'<script>window.parent.$("#top-image").attr("src","images/cross.png");</script>';
	    echo '<script>document.getElementById("display_progress").style.display = "none";</script>';
	    echo'<script> parent.document.getElementById("loading_display").style.display = "none";</script>';
	}


    
    ?>