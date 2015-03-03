<body>

<div style="display:block; color: grey;padding: 8px;" id="start-message">Uploading your file ...</div>
<div style="display:none; color: grey;padding: 8px;" id="end-message">File uploaded successfully</div>

<div style="display:none; padding-top:8px;" id = "display_progress" >
    
    <progress id = "prog" value="0" max="100"></progress> 
    <img style="float: left;margin-right: 5px;margin-left: 8px;" src="../images/file_uploading.gif">
    
    <div style="color:rgb(100, 102, 104);margin-top: 13px;margin-left: 8px;" id = "progress_indicator"></div>
    </div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

function link_embed(source){

 var d = "<iframe id='embedframe' style='float:left;' id='viewer' src = 'http://localhost/local_documendz/viewer/view.html?f="+ source +"' width='800' height='1000' allowfullscreen='true' webkitallowfullscreen='true' mozallowfullscreen='true' oallowfullscreen='true' msallowfullscreen='true' ></iframe>";

       parent.document.getElementById('link').value = d;
       parent.document.getElementById('previ').innerHTML = d;
       $('#preview-selector', window.parent.document).removeClass('hide');


}
   
    function display_progress(){
    
//    alert ("progress");
    document.getElementById("display_progress").style.display = "block";
    
    }
 


function progress(base, value, file_name) //assigns value and max to progress bar in html
    {
        
        var encodedStr = file_name.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
            return '&#' + i.charCodeAt(0) + ';';
        });

        document.getElementById('progress_indicator').innerHTML = "<strong>"+file_name +" </strong> : "+value + "/" + base + " pages";
        document.getElementById('prog').value = value;
        document.getElementById('prog').max = base;
    }
    
    
    function progress_100_complete(base, value, file_name,file) { //To be called only when progress 100% to hide prgress bar and display form

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
	     window.parent.$("#viewer-close-iframe").removeClass("disabled");
	     window.parent.$("#top-image").attr("src","../images/right.png");
	    
            },300);


        }
    }
         
      
         
         
</script>


<?php

require_once '../functions.php';

include '../connect.php';
include '../unique_random_alphanumeric.php';
 

    if (isset($_FILES['viewer-file'])) {          // When upload is pressed file should be uploaded
    

    echo'<script> parent.document.getElementById("viewer-iframe-upload-message").innerHTML = "";</script>';    
    echo'<script>display_progress();</script>';
     

        
        for ($i = 0; $i <= 0; $i++) {

            $file = $_FILES['viewer-file']['name'];
            $file_type = $_FILES['viewer-file']['type'];
            $file_size = $_FILES['viewer-file']['size'];
            $file_tmp = $_FILES['viewer-file']['tmp_name'];

        
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            $unique_filename =getToken(12);
            $file_name_html = $unique_filename . ".html"; //appending html extension to the uploaded file
          
	  $allowed_files = array("image/png"  ,  "image/svg+xml" , "application/x-shockwave-flash" , "image/jpeg" , "image/bmp" , "application/pdf");
            
	    
	    
	    if ($file_size > 4096000 || $file_size == 0 || !in_array($file_type,$allowed_files)) {

        echo '<script> parent.document.getElementById("viewer-iframe-upload-message").innerHTML = "Currently only Pdfs and images upto 4MB are supported. Support for other file types will be added soon";</script>';
		echo '<script>window.parent.$("#viewer-close-iframe").removeClass("disabled");</script>';
		echo'<script>document.getElementById("start-message").style.display = "none";</script>';
		echo'<script>window.parent.$("#top-image").attr("src","../images/cross.png");</script>';
		echo '<script>document.getElementById("display_progress").style.display = "none";</script>';
		
            }

             else {

           
                //then, remove single quotes '' from the variable
                // as $_SESSION[userid] and not $_SESSION['userid']  
                //This runs PDF2HTMLEX command to convert pdf to HTML
                $html_file_dest = '../uploaded/viewer_files';


// declaring the function 
               
function pdf2html($html_file_dest,$unique_filename,$file) {
        
       
        
        	header('Content-Type: text/HTML; charset=utf-8');
        	header('Content-Encoding: none; ');
        
        	$cmd = "pdf2htmlEX --process-outline 0 --fit-width 800 --fit-height 1200 --dest-dir " . $html_file_dest . " ../uploaded/viewer_orig/".$unique_filename.".pdf 2>&1 &"; //>>dta.log helps run the cmd even when a large amnt of data is printed on cmd page
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
        				echo "<script>progress(" . $base . "," . $increment . ",'" . html_entity_decode($file) . "') </script>";
        				ob_flush();
        				flush();
        				$increment++;
        			}
        

        			if ($work_pos !== false && $base_pos !== false && ($base_pos > $work_pos)) {
        				$work_pos = strrpos(preg_replace('/\s+/', '', $f), 'Working:') + 7; //to get end position of 'Working:'
        				$value = substr(preg_replace('/\s+/', '', $f), $work_pos + 1, $base_pos - $work_pos - 1);
        				$prog_val = ceil($increment + ($value * ($base - $increment)) / $base);
        				echo "<script>progress(" . $base . "," . $prog_val . ",'" .html_entity_decode($file) . "') </script>";   //calls js function to iterate progress in progress bar
        				ob_flush();
        				flush();
        			}
        		}
        		if ($prog_value !== $base) {   // will be called everytime the process runs after conversion
        			echo "<script>progress_100_complete(" . $base . "," . $base . ",'" . $unique_filename . "','".html_entity_decode($file)	."') </script>";
        		};
        		
        		fclose($pipes[1]); // no idea why it is written :P
        		proc_close($process);
        		        	
}
            


	
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
            
		move_uploaded_file($file_tmp, '../uploaded/viewer_orig/'. $unique_filename.'.'.$file_ext);
		/* the image file */
		$image = '../uploaded/viewer_orig/' .$unique_filename.'.'.$file_ext;
	
		/* a new imagick object */
		$im = new Imagick();
	
		/* ping the image */
		$im->pingImage($image);
	
		/* read the image into the object */
		$im->readImage( $image );
	
		/** convert to png */
		$im->setImageFormat( "pdf" );
	
		/* write image to disk */
		$im->writeImage( '../uploaded/viewer_orig/' .$unique_filename.'.pdf' );
	
		
		/* move_uploaded_file($file_tmp, 'uploaded/uploaded_files_' . $_SESSION['userid'] . '_original/' . $unique_filename.'.pdf'); */
		pdf2html($html_file_dest,$unique_filename,$file);
		
	
	
	$file = mysql_real_escape_string($file);
	$unique_filename = mysql_real_escape_string($unique_filename);
	$file_ext = mysql_real_escape_string($file_ext);
	
	
	mysql_query("INSERT INTO viewer VALUES('','$file','$unique_filename','$file_ext')"); //When $_SESSION is used inside a
		
	//   $s3 = S3Client::factory(array(
	//   'key' => "AKIAJ7CNKUCZLU6QSABA",
	//   'secret' => "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",
	//   'region' => "ap-southeast-1"
	//   ));
	//
	//	 $filepath =  "uploaded/uploaded_files_". $_SESSION['userid'] . "_original/". $unique_filename.".".$file_ext;
	//	 $bucket = "documendz.beta";
	//	 $keyname = $filepath;
	//
	//	 try{
	//		 $result = $s3 -> putObject(array(
	//		   'Bucket'       => $bucket,
	//		   'Key'          => $keyname,
	//		   'SourceFile'   => $filepath
	//		
	//		));
	//		
	//		unlink($filepath);
	//		unlink("uploaded/uploaded_files_". $_SESSION['userid'] . "_original/". $unique_filename.".pdf"); //delete the pdf form of uploaded image	 
	//		
	//		 
	//		}
	//		catch(S3Exception $e){
	//		     
	//		   echo 'Failed to upload';
	//		
	//		   }
	//	 
		 
	 echo '<script>link_embed("'.$unique_filename.'");</script>';	
		
		  
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
	
    break;

    case "application/pdf":
        


	$name = mysql_real_escape_string($file);
	
       // echo '<script>document.getElementById("start-message").style.display = "block"</script>';
    	move_uploaded_file($file_tmp, '../uploaded/viewer_orig/' . $unique_filename.'.pdf');
    	 
    	pdf2html($html_file_dest,$unique_filename,$name);
	
		
	mysql_query("INSERT INTO viewer VALUES('','$name','$unique_filename','$file_ext')"); //When $_SESSION is used inside a

/* move to a diff location */



//echo "<script>send_it('".$unique_filename."');</script>";
//
//$descriptorspec2 = array(
//        			0 => array("pipe", "r"), // stdin is a pipe that the child will read from
//        			1 => array("pipe", "w"), // stdout is a pipe that the child will write to
//        			2 => array("pipe", "w")    // stderr is a pipe that the child will write to
//        	);
//
//$comm = "php send_to_s3.php '".$unique_filename."!".$_SESSION['userid']."' &";
//
//echo $comm;
//		
//$process = proc_open($comm, $descriptorspec2, $pipes, __DIR__);
//
//
//proc_close($process);
   
   //} /*else {
   //   echo "Failed to upload file.";
   //}*/
   
/***********************************/

    echo '<script>link_embed("'.$unique_filename.'");</script>';
 
    break;
    
default: 
    break;
   
}             

      
}
       
        }
        
	die;
    }
    
    else{
             
            echo '<script> parent.document.getElementById("viewer-iframe-upload-message").innerHTML = "Currently only Pdfs and images upto 4MB are supported. Support for other file types will be added soon";</script>';
            echo '<script>window.parent.$("#viewer-close-iframe").removeClass("disabled");</script>';
	    echo'<script>document.getElementById("start-message").style.display = "none";</script>';
	    echo'<script>window.parent.$("#top-image").attr("src","../images/cross.png");</script>';
	    echo '<script>document.getElementById("display_progress").style.display = "none";</script>';
	}


    
    ?>