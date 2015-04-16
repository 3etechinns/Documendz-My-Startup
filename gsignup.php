<?php

require_once 'a/backend/functions.php';
require_once 'unique_random_alphanumeric.php';


require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

use Aws\Common\Exception\MultipartUploadException;   //for multipart upload
use Aws\S3\Model\MultipartUpload\UploadBuilder;

use Guzzle\Http\EntityBody;

  session_start();

include 'a/backend/connect.php';

function email($recipient_email_id,$senders_name,$un){


require_once 'swiftmailer/lib/swift_required.php';

// Create the mail transport configuration
$transport = Swift_SmtpTransport::newInstance('smtpout.secureserver.net',80)
 ->setUsername('no-reply@documendz.com')
 ->setPassword('no-replyZofler6991')
        ;


// Create the message
$message = Swift_Message::newInstance(Subject);
$message->setTo(array(
 $recipient_email_id
));

$uname="$un";
$url = $link;

$message->setSubject("Welcome");
$message->setBody(
'<html>
<head>    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Minty-Multipurpose Responsive Email Template</title><style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         /*a {color: #e95353;text-decoration: none;text-decoration:none!important;}*/
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         
         /*################################################*/
         /*IPAD STYLES*/
         /*################################################*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #ffffff; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #ffffff !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         table[class="sthide"]{display: none!important;}
         img[class="bigimage"]{width: 420px!important;height:219px!important;}
         img[class="col2img"]{width: 420px!important;height:258px!important;}
         img[class="image-banner"]{width: 440px!important;height:106px!important;}
         td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}
         td[class="logo"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}
         img[class="logo"]{padding:0!important;margin: 0 auto !important;}

         }
         /*##############################################*/
         /*IPHONE STYLES*/
         /*##############################################*/
         @media only screen and (max-width: 480px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #ffffff; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #ffffff !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         table[class="sthide"]{display: none!important;}
         img[class="bigimage"]{width: 260px!important;height:136px!important;}
         img[class="col2img"]{width: 260px!important;height:160px!important;}
         img[class="image-banner"]{width: 280px!important;height:68px!important;}
         
         }
      </style>
</head><body><div class="block">
	<!-- Start of preheader -->

	<!-- End of preheader -->

</div>
<div class="block">
	<!-- start of header -->

	<!-- end of header -->

	<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
		<tbody>
			<tr>
				<td>
					<div class="innerbg">
					</div>
					<table width="580" bgcolor="#f5f5f5" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
						<tbody>
							<tr>
								<td>
									<!-- logo -->

									<table width="100%" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth" bgcolor="#f5f5f5">
										<tbody>
											<tr>
												<td align="center" valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">
													<div class="imgpop">
														<div class="uploader_wrap" style="width: 100px; margin-top: -6px; opacity: 0;">
															<div class="upload_buttons">
																<div class="img_link">
																</div>
																<div class="img_upload">
																</div>
																<div class="img_edit" style="visibility: visible;">
																</div>
															</div>
														</div> <a href="#"><img src="https://ci3.googleusercontent.com/proxy/AyJXkBZLNZ1VuBQu-rfwUyR5Xpz3aPJ2GEkEscgWqJIfEjQJv1xf7KynYqkPWdX13mnCNba4i8KUhSQ0vTnW0URGxpPyxA1qxMah3kZ-vjcDof5GjC2h_dSoBndBuekuIg=s0-d-e1-ft#https://s3-ap-southeast-1.amazonaws.com/documendz-public/documendz_logo.gif" width="120px" height="45px" alt="logo" border="0" style="display:block; border:none; outline:none; text-decoration:none;" class="logo" /></a>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<!-- End of logo -->

									<!-- menu -->

								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td>
				<div class="innerbg">
				</div>
				<table bgcolor="#ffffff" width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
						<!-- Spacing -->

						<tr>
							<td width="100%" height="30">
							</td>
						</tr>
						<!-- Spacing -->

						<tr>
							<td>
								<table width="540" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
									<tbody>
										<!-- Title -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:center;line-height: 20px;">
												<p align="left">
													Hello '.$un.'!
												</p>
												<p align="left">
												</p>
												<p align="left">
													It is great to have you onboard
												</p>
												<p align="left">
												</p>
											</td>
										</tr>
										<!-- End of Title -->

									

										<!-- Spacing -->

										<tr>
											<td width="100%" height="30">
											</td>
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
<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td width="100%">
				<div class="innerbg">
				</div>
				<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
						<!-- Spacing -->

						<tr>
							<td width="100%" height="5">
							</td>
						</tr>
						<!-- Spacing -->

						<tr>
							<td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999">
								<p>
								</p>
							</td>
						</tr>
						<!-- Spacing -->

						<tr>
							<td width="100%" height="5">
							</td>
						</tr>
						<!-- Spacing -->

					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td>
				<div class="innerbg">
				</div>
				<table bgcolor="#ffffff" width="580" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
					<tbody>
						<tr>
							<td width="100%" height="20">
							</td>
						</tr>
						<tr>
							<td>
								<table width="540" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
									<tbody>
										<!-- title -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:left;line-height: 20px;">
												<p>
													Create workgroups and collaborate
												</p>
											</td>
										</tr>
										<!-- end of title -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										<!-- Spacing -->

										<!-- content -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #666666; text-align:left;line-height: 24px;">
												<p>
													Create and manage workgroups to form a team of collaborators. Reach a larger audience and review different file types, all in one place
												</p>
											</td>
										</tr>
										<!-- end of content -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										

										<!-- Spacing -->

										<tr>
											<td width="100%" height="20">
											</td>
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
<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td>
				<div class="innerbg">
				</div>
				<table bgcolor="#ffffff" width="580" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
					<tbody>
						<tr>
							<td width="100%" height="20">
							</td>
						</tr>
						<tr>
							<td>
								<table width="540" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
									<tbody>
										<!-- title -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:left;line-height: 20px;">
												<p>
													Annotate on every type of a document
												</p>
											</td>
										</tr>
										<!-- end of title -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										<!-- Spacing -->

										<!-- content -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #666666; text-align:left;line-height: 24px;">
												<p>
													Use from a wide variety of user friendly annotation tools for an enhanced experience.
												</p>
												<p>
													Highlight, strike, comment, draw or even add texts on any document
												</p>
											</td>
										</tr>
										<!-- end of content -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										

										<!-- Spacing -->

										<tr>
											<td width="100%" height="20">
											</td>
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
<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td>
				<div class="innerbg">
				</div>
				<table bgcolor="#ffffff" width="580" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
					<tbody>
						<tr>
							<td width="100%" height="20">
							</td>
						</tr>
						<tr>
							<td>
								<table width="540" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidthinner">
									<tbody>
										<!-- title -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:left;line-height: 20px;">
												<p>
													Work in realtime
												</p>
											</td>
										</tr>
										<!-- end of title -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										<!-- Spacing -->

										<!-- content -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #666666; text-align:left;line-height: 24px;">
												<p>
													Work with reviewers in realtime. Get their reviews and provide immediate feedback for a seamless review process
												</p>
											</td>
										</tr>
										<!-- end of content -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										

										<!-- Spacing -->

										<tr>
											<td width="100%" height="20">
											</td>
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
<table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
			<td>
				<div class="innerbg">
				</div>
				<table bgcolor="#ffffff" width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
						<!-- Spacing -->

						<tr>
							<td width="100%" height="30">
							</td>
						</tr>
						<!-- Spacing -->

						<tr>
							<td>
								<table width="540" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
									<tbody>
										<!-- Title -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:center;line-height: 20px;">
												<p>
													Upload.Share.Review.Collaborate
												</p>
											</td>
										</tr>
										<!-- End of Title -->

										<!-- spacing -->

										<tr>
											<td height="5">
											</td>
										</tr>
										<!-- End of spacing -->

										<!-- content -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #95a5a6; text-align:center;line-height: 30px;">
												<p>
												</p>
											</td>
										</tr>
										<!-- End of content -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										<!-- Spacing -->


										<!-- Spacing -->

										<tr>
											<td width="100%" height="30">
											</td>
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
</table></body>
</html>','text/html');
$message->setFrom("no-reply@documendz.com","Documendz");

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);



if (!$mailer) {
		echo "Mailer Error: " . $mailer->ErrorInfo;
		
	} else {
		echo "You have registered successfully. A verification link has been sent to your email id. Please verify to start using Documendz.";
		/* session_start();
		$_SESSION['uname']=$uname;
		echo "<script>setTimeout(\"location.href = '$path';\",2000);</script>"; */
	}
}

$name= $_GET['n'];
$email= $_GET['e'];

$y = mysqli_query($dbhandle,"SELECT * FROM signup WHERE emailid ='".$email."'");
$z = mysqli_fetch_array($y);
$x = mysqli_num_rows($y);

echo "Loading ...";


function getDp($id){

$usimg = $_GET['usimg'];
$im = file_get_contents($usimg."&sz=200");

$s3 = S3Client::factory(array(
   'key' => "AKIAJDPJXX4TZK42PTAA",
   'secret' => "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",
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
        'Body'   => $im
       
    ));

    

} catch (S3Exception $e) {
    echo $e->getMessage() . "\n";
}



}

if($x > 0 ){

        $_SESSION['Username'] = $z['username'];
		$_SESSION['email'] = $email;
		$_SESSION['userid'] = $z['userid'];

getDp($z['userid']);
		 echo "<script>window.location.href ='http://www.documendz.com/a/#/workgroups'</script>";
}

else if( $x == 0){


		
mysqli_query($dbhandle, "INSERT INTO signup "."(username, password, emailid, gsign, verified, workgroups, files, collaborators) "."VALUES('$name','','$email',1,1,5,10,3)");		
$i = mysqli_fetch_array(mysqli_query($dbhandle,"SELECT userid,username FROM signup WHERE emailid ='".$email."'"));

/////  make user folder  ////

	$r1 = getToken(20);
    $r2 = getToken(20);
    
    $s1 = getToken(15);
    $s2 = getToken(15);
    $s3 = getToken(15);
    $s4 = getToken(15);
/// 2 sample wkgroups ///

	mysqli_query($dbhandle,"INSERT INTO workgroups (uniqueId,wname,wdesc,auth_id,auth_name,sample) 
                        VALUES ('".$r1."','Documents (Sample)','This is where you can add a short description for your workgroup to let your collaborators know a few details about the files, deadlines, tasks that you need to complete. ',". $i['userid'].",'".$i['username']."',1),
                               ('".$r2."','Designs (Sample)','Example: Let us get the final draft for these designs by 18th Dec. Add your designs and revisions here.',". $i['userid'].",'".$i['username']."',1)");
	
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

getDp($i['userid']);

echo "<script>window.location.href ='https://www.documendz.com/a/#/workgroups'</script>";
email($email,"Documendz",$i['username']);

}



?>