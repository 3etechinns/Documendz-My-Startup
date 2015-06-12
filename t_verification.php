<?php

require_once 'a/backend/functions.php';
require_once 'unique_random_alphanumeric.php';
include 'a/backend/connect.php';

session_start();
	

$email = $_GET['email'];
$hashcode = $_GET['hash'];

$secret = "61oeix1=-4#%e03mo";

function email($e,$n){

require_once 'mandrill/src/Mandrill.php';


$s = "Collaborating on documents was never this easy";
$m = 'Thank you for signing up for a free trial of Documendz.<br/>
      With Documendz you can: <ul>
        <li>Provide feedback on resumes or documents. This will be instantly shared with your collaborators</li>
        <li>Easily highlight, circle, underline or strike through text on legal documents and contracts</li>
        <li>Work on a proposal with your team member spread out in multiple locations in real time.</li>
      </ul>
      Click on the link to sign in to your workspace. Start adding collaborators, 
      and upload documents to get started.
      <a href="https://documendz.com">Documendz</a><br/> 
      Banish long email chains, save time, and avoid confusion.<br/><br/>
      Cheers! <br/>
      Hardik<br/>
      Co-Founder, Documendz<br/><br/>
PS: I would love to know what made you sign up for Documendz. 
Reply to this email or write to <a href="mailto:feedback@documendz.com" target="_blank">feedback@documendz.com</a> 
Your feedback will help us serve you better :)';

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
$mandrill = new Mandrill("MaTt7_WzRGIp4lTpdziLEA");

$message = new stdClass();
$message->html = $content;

$message->subject = $s;
$message->from_email = "Hardik.dave@documendz.com";
$message->from_name  = "Hardik from Documendz";
$message->to = array(array("email" => $e));
$message->track_opens = true;
$message->track_clicks = true;
$message ->tags = array('welcome-verification');
$response = $mandrill->messages->send($message);
} catch (Mandrill_error $e) {
   echo "Something went wrong, please try again"; 
}

}

if (MD5($email.$secret) == $hashcode){
	
	
$email = mysqli_real_escape_string($dbhandle,$email);
	
$check_ver = mysqli_fetch_assoc(mysqli_query($dbhandle,"SELECT verified FROM signup WHERE emailid = '".$email."'"));

if ($check_ver['verified'] == 0){
 
	
	

	$vefi_val = mysqli_query( $dbhandle, "UPDATE signup SET verified = 1 WHERE emailid ='".$email."'");

	
$new_register_user_id = mysqli_fetch_array(mysqli_query($dbhandle,"SELECT userid,username FROM signup WHERE emailid ='".$email."'"),MYSQLI_ASSOC);

	// $query_to_take_current_userid = "SELECT userid,username FROM signup WHERE emailid ='".$email."'";
	// $id = mysqli_query($dbhandle,$query_to_take_current_userid);
	// $new_register_user_id = mysqli_fetch_array($id,MYSQLI_ASSOC);

	// mysql_query("UPDATE shared_files SET receiver_id =".$new_register_user_id['userid'].",receiver_name = '".$new_register_user_id['username']."' WHERE receiver_email ='".$email."'");
	
		
	/////  make user folder  ////

	$r1 = getToken(20);
    $r2 = getToken(20);
    

    $s1 = getToken(15);
    $s2 = getToken(15);
    $s3 = getToken(15);
    $s4 = getToken(15);
/// 2 sample wkgroups ///

	mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,sample) 
                        VALUES ('".$r1."','Documents (Sample)','This is where you can add a short description for your workgroup to let your collaborators know a few details about the files, deadlines, tasks that you need to complete. ',". $new_register_user_id['userid'].",'".$new_register_user_id['username']."',1),
                               ('".$r2."','Designs (Sample)','Example: Let us get the final draft for these designs by 18th Dec. Add your designs and revisions here.',". $new_register_user_id['userid'].",'".$new_register_user_id['username']."',1)");
	
$my_date = date("Y-m-d H:i:s");

	mysqli_query($dbhandle,"INSERT INTO files VALUES('','".$s1."','Legal document.pdf','".$r1."',".$new_register_user_id['userid'].",'$my_date','pdf',11),
	                                                ('','".$s2."','Research paper.pdf','".$r1."',".$new_register_user_id['userid'].",'$my_date','pdf',12),
						                            ('','".$s3."','Creative design.jpg','".$r2."',".$new_register_user_id['userid'].",'$my_date','pdf',21),
						                            ('','".$s4."','Floor plan.jpg','".$r2."',".$new_register_user_id['userid'].",'$my_date','pdf',22)");
    

	mkdir('uploaded/uploaded_files_'.$new_register_user_id['userid'].'_original');
	mkdir('uploaded/jhg76'.$new_register_user_id['userid'].'kd84');
	

	

	$_SESSION['Username'] = $new_register_user_id['username'];			// Username of the registerd user
	$_SESSION['userid'] =  $new_register_user_id['userid']; // Will take the userid of the registered user
	$_SESSION['email'] = $email;


	email($_SESSION['email'], $_SESSION['Username']);

     echo "<script>window.location.href ='https://www.documendz.com/a/#/workgroups'</script>";
	
	// echo $_SESSION['Username'];
	// echo $_SESSION['userid'];
	
}

else {
	
echo "<script>window.location.href = 'exception_handlers/already_verified.html'</script>";
	
	}

}

else {
	
	echo "There seems to be something wrong with the verification. Please reach out to us on help@documendz.com";
}



?>
