<?php

require_once 'functions.php';
session_start();
include 'connect.php';


function email($e,$f,$w){

require_once '../../swiftmailer/lib/swift_required.php';

// Create the mail transport configuration
$transport = Swift_SmtpTransport::newInstance('smtpout.secureserver.net',80)
 ->setUsername('no-reply@documendz.com')
 ->setPassword('no-replyZofler6991')
        ;

//$encode_email = urlencode($recipient_email_id);
// Create the message
        
if($f == undefined){
	$s = "Updates on a file";
	$f = "a file";
}
else{

	$s = "Updates on file ".$f;
}

$u = $_SESSION['Username'];

$message = Swift_Message::newInstance(Subject);
$message->setBcc($e);

$uname="$un";
$url = $link;

$message->setSubject($s);
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
</head>
<body>
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

								<table width="100%" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth">
									<tbody>
										<tr>
											<td align="center" valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">
												<div class="imgpop">
													<div class="uploader_wrap" style="width:100px; margin-top:-6px">
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
													Hello,
												</p>
												<p>
													There are a few updates on <b>'.$f.'</b> in '.$w.' workgroup by '.$u.'.
												</p>
												<p>
													Please click on the button below to check.
												</p>
											</td>
										</tr>
										<!-- end of content -->

										<!-- Spacing -->

										<tr>
											<td width="100%" height="10">
											</td>
										</tr>
										<!-- button -->

										<tr>
											<td>
												<div class="buttonbg">
												</div>
												<table height="30" align="left" valign="middle" border="0" cellpadding="0" cellspacing="0" class="tablet-button" style="border-radius: 4px; font-size: 13px; font-family: Helvetica, arial, sans-serif; text-align: center; color: rgb(255, 255, 255); font-weight: 300; padding-left: 18px; padding-right: 18px; background-color: rgb(50, 137, 199); background-clip: padding-box;" bgcolor="#3289c7">
													<tbody>
														<tr>
															<td style="padding-left:18px; padding-right:18px;font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300;" width="auto" align="center" valign="middle" height="30">
																 <a href="https://documendz.com"> <span style="color: #ffffff; font-weight: 300;">Go</span></a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<!-- /button -->

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
			<td width="100%">
				<div class="innerbg">
				</div>
				<table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
					<tbody>
						<!-- Spacing -->

						<tr>
							<td width="100%" height=20>
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
							<td width="100%" height="20">
							</td>
						</tr>
						<!-- Spacing -->

					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table></body>
</html>','text/html');

$message->setFrom("no-reply@documendz.com", "Documendz Updates");

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);



if (!$mailer) {
		
		
	} else {
		
		/* session_start();
		$_SESSION['uname']=$uname;
		echo "<script>setTimeout(\"location.href = '$path';\",2000);</script>"; */
	}
}			
		
$w = $_POST['w'];
$f= $_POST['f'];

$cDistribArray = array();
$result = mysqli_query($dbhandle, "SELECT collabEmail FROM collaborators WHERE  wkUniqueId = '".$w."'");	
$wn = mysqli_fetch_assoc(mysqli_query($dbhandle, "SELECT wname FROM workgroups WHERE  uniqueId = '".$w."'"));


while($rowEmail = mysqli_fetch_assoc($result)) {
    $cDistribArray[] = $rowEmail['collabEmail'];
}


email($cDistribArray,$f,$wn['wname']);

			?>