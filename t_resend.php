<?php

$un = $_POST['uname'];
$em = $_POST['email'];

function email($recipient_email_id,$senders_name,$un,$link){


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

$message->setSubject("Email verification");
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

										<!-- spacing -->

										<tr>
											<td height="5">
											</td>
										</tr>
										<!-- End of spacing -->

										<!-- content -->

										<tr>
											<td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #95a5a6; text-align:center;line-height: 30px;">
												<p style="text-align: left;">
													Just click on the button below and have your account verified
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

										<!-- button -->

										<tr>
											<td>
												<div class="buttonbg">
												</div>
												<table height="36" align="center" valign="middle" border="0" cellpadding="0" cellspacing="0" class="tablet-button" style="border-radius: 4px; font-size: 13px; font-family: Helvetica, arial, sans-serif; text-align: center; color: rgb(255, 255, 255); font-weight: 300; padding-left: 25px; padding-right: 25px; background-color: rgb(50, 137, 199); background-clip: padding-box; float:left" bgcolor="#3289c7">
													<tbody>
														<tr>
															<td style="padding-left:18px; padding-right:18px;font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300;" width="auto" align="center" valign="middle" height="36">
																 <span style="color: #ffffff; font-weight: 300;"> <a style="color: #ffffff; text-align:center;text-decoration: none;" href="'.$url.'" tabindex="-1">Verify</a></span>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<!-- /button -->

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
$message->setFrom("no-reply@documendz.com", $senders_name);

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);


if (!$mailer) {
		echo "Mailer Error: " . $mailer->ErrorInfo;
		
	} else {
		echo "The verification email was resent on your email ID.";
		/* session_start();
		$_SESSION['uname']=$uname;
		echo "<script>setTimeout(\"location.href = '$path';\",2000);</script>"; */
	}
}

if(strlen($un)!=0 && strlen($em)!=0){
$secret = "61oeix1=-4#%e03mo";
$email = urlencode($em);
$hash = MD5($em.$secret);
$link = "https://www.documendz.com/t_verification.php?email=$email&hash=$hash&user=$un";

email($em,"Documendz",$un,$link);
}

?>