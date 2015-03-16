

<?php


function email(){


require_once 'swiftmailer/lib/swift_required.php';

// Create the mail transport configuration
$transport = Swift_SmtpTransport::newInstance('smtpout.secureserver.net',80)
 ->setUsername('no-reply@documendz.com')
 ->setPassword('no-replyZofler6991')
        ;


// Create the message
$message = Swift_Message::newInstance(Subject);
$message->setBcc(array(
"dave.hardik30@gmail.com"
));



$message->setSubject("What's new");
$message->setBody(
'<html>
<head>    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Tempo-Responsive Email Template</title><style type="text/css">
        /* Client-specific Styles */
        div, p, a, li, td { -webkit-text-size-adjust:none; }
        #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
        html{width: 100%; }
        body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
        .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing. */
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
        img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 0px 0px !important;}
        table td {border-collapse: collapse;}
        table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
        a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
        /*STYLES*/
        table[class=full] { width: 100%; clear: both; }
        /*IPAD STYLES*/
        @media only screen and (max-width: 640px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #33b9ff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #33b9ff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 440px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
            img[class=banner] {width: 440px!important;height:220px!important;}
            img[class=col2img] {width: 440px!important;height:220px!important;}


        }
        /*IPHONE STYLES*/
        @media only screen and (max-width: 480px) {
            a[href^="tel"], a[href^="sms"] {
                text-decoration: none;
                color: #33b9ff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                text-decoration: default;
                color: #33b9ff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 280px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
            img[class=banner] {width: 280px!important;height:140px!important;}
            img[class=col2img] {width: 280px!important;height:140px!important;}


        }
    </style>
</head><body>   


<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table bgcolor="#eacb3c" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- logo -->

                                                <table width="140" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td width="140" height="50" align="center">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 140px; opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div> <a href="https://documendz.com"><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/617e4a57efd64880947d5ae83608f2db.png" alt="" border="0" width="140" style="display:block; border:none; outline:none; text-decoration:none;" /></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of logo -->

                                                <!-- start of menu -->

                                                <table width="250" height="50" border="0" align="right" valign="middle" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td height="50" align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 13px;color: #282828">
                                                                <p style="text-align: center;">
                                                                    <a style="color: #282828;text-decoration: none;" href="https://documendz.com">w</a>ww.documendz.com
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of menu -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <!-- start of image -->

                                            <td align="center">
                                                <div class="imgpop">
                                                    <div class="uploader_wrap" style="width: 600px; opacity: 0;">
                                                        <div class="upload_buttons">
                                                            <div class="img_link">
                                                            </div>
                                                            <div class="img_upload">
                                                            </div>
                                                            <div class="img_edit" style="visibility: visible;">
                                                            </div>
                                                        </div>
                                                    </div> <a href="https://www.documendz.com"><img width="600" border="0" alt="" style="display:block; border:none; outline:none; text-decoration:none;" src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/100e3bcdd3c74ab6bcd568cd94512d58.png" class="banner" /></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- end of image -->

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <!-- Spacing -->

                                        <tr>
                                            <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                            </td>
                                        </tr>
                                        <!-- Spacing -->

                                        <tr>
                                            <td>
                                                <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                                    <tbody>
                                                        <!-- Title -->

                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:center; line-height: 24px;">
                                                                <p>
                                                                    Thanks a lot for being a part of the Documendz family
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <!-- End of Title -->

                                                        <!-- spacing -->

                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                        <!-- End of spacing -->

                                                        <!-- content -->

                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
                                                                <p>
                                                                    Your support and feedbacks have helped us improve the service and continuously provide you with an even better product.
                                                                </p>
                                                                <p>
                                                                    Have a look at what is new and exciting in our new release on documendz.com
                                                                </p>
                                                                <p>
                                                                </p>
                                                                <p>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <!-- End of content -->

                                                        <!-- Spacing -->

                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                        <!-- Spacing -->

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- Spacing -->

                                        <tr>
                                            <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Start of left column -->

                                                <table width="280" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <!-- image -->

                                                        <tr>
                                                            <td width="280" height="140" align="center" class="devicewidth">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 280px;  opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/3807d711a696434ebc9a1f9e131dac99.png" alt="" border="0" width="280" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /image -->

                                                    </tbody>
                                                </table>
                                                <!-- end of left column -->

                                                <!-- spacing for mobile devices-->

                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->

                                                <!-- start of right column -->

                                                <table width="280" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="280" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                    <tbody>
                                                                        <!-- title -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Create workgroups
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of title -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        <!-- content -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Create and manage workgroups to form a team of collaborators. Reach a larger audience and review different file types, all in one place
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of content -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        

                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of right column -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Start of left column -->

                                                <table width="280" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <!-- image -->

                                                        <tr>
                                                            <td width="280" height="140" align="center" class="devicewidth">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 280px;  opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/53866bfb1cf3427a96d3c8f32d91a2ce.png" alt="" border="0" width="280" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /image -->

                                                    </tbody>
                                                </table>
                                                <!-- end of left column -->

                                                <!-- spacing for mobile devices-->

                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->

                                                <!-- start of right column -->

                                                <table width="280" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="280" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                    <tbody>
                                                                        <!-- title -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Work with your peers in realtime
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of title -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        <!-- content -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    No more saving your feedbacks and reviews. Carry out live discussions over any document, all in realtime
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of content -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of right column -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Start of left column -->

                                                <table width="280" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <!-- image -->

                                                        <tr>
                                                            <td width="280" height="140" align="center" class="devicewidth">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 280px; opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/29c43f0d5f9743cc8fcaf2ca9b838e11.png" alt="" border="0" width="280" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /image -->

                                                    </tbody>
                                                </table>
                                                <!-- end of left column -->

                                                <!-- spacing for mobile devices-->

                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->

                                                <!-- start of right column -->

                                                <table width="280" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="280" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                    <tbody>
                                                                        <!-- title -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Excellent collaboration tools
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of title -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        <!-- content -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Highlight, strike, comment, draw or even add texts precisely on any type of a document
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of content -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                    
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of right column -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Start of left column -->

                                                <table width="280" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <!-- image -->

                                                        <tr>
                                                            <td width="280" height="140" align="center" class="devicewidth">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 280px;  opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/0da85d64159a437c883eed52e12897dd.png" alt="" border="0" width="280" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /image -->

                                                    </tbody>
                                                </table>
                                                <!-- end of left column -->

                                                <!-- spacing for mobile devices-->

                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->

                                                <!-- start of right column -->

                                                <table width="280" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="280" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                    <tbody>
                                                                        <!-- title -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Chat with your collaborators
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of title -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        <!-- content -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Discuss reviews on live chats with your peers for an enhanced and efficient review experience
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of content -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                    
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of right column -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Start of left column -->

                                                <table width="280" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <!-- image -->

                                                        <tr>
                                                            <td width="280" height="140" align="center" class="devicewidth">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 280px;  opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/d214b6444ea74a3fbbb884ef5c4270e2.png" alt="" border="0" width="280" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /image -->

                                                    </tbody>
                                                </table>
                                                <!-- end of left column -->

                                                <!-- spacing for mobile devices-->

                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->

                                                <!-- start of right column -->

                                                <table width="280" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="280" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                    <tbody>
                                                                        <!-- title -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Track your changes
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of title -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        <!-- content -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    Use our analytical dashboard to keep track of all the changes made to your documents
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of content -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                    

                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of right column -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <!-- Start of left column -->

                                                <table width="280" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <!-- image -->

                                                        <tr>
                                                            <td width="280" height="140" align="center" class="devicewidth">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width: 280px;  opacity: 0;">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/5cc13580bcb0445486f6f8f71b05d7f7.png" alt="" border="0" width="280" style="display:block; border:none; outline:none; text-decoration:none;" class="col2img" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- /image -->

                                                    </tbody>
                                                </table>
                                                <!-- end of left column -->

                                                <!-- spacing for mobile devices-->

                                                <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of for mobile devices-->

                                                <!-- start of right column -->

                                                <table width="280" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="280" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                                    <tbody>
                                                                        <!-- title -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    It is all gonna be mobile !
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of title -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                        <!-- content -->

                                                                        <tr>
                                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:left; line-height: 24px;">
                                                                                <p>
                                                                                    You will soon be able to download the Documendz Mobile app to review and manage content on the go
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- end of content -->

                                                                        <!-- Spacing -->

                                                                        <tr>
                                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Spacing -->

                                                                    

                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of right column -->

                                            </td>
                                        </tr>
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <!-- Spacing -->

                                        <tr>
                                            <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                            </td>
                                        </tr>
                                        <!-- Spacing -->

                                        <tr>
                                            <td>
                                                <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                                    <tbody>
                                                        <!-- Title -->

                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #282828; text-align:center; line-height: 24px;">
                                                                <p>
                                                                    And a lot more coming your way ....
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <!-- End of Title -->

                                                        <!-- spacing -->

                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                        <!-- End of spacing -->

                                                        <!-- content -->

                                                        <tr>
                                                            <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #889098; text-align:center; line-height: 24px;">
                                                                <p>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <!-- End of content -->

                                                        <!-- Spacing -->

                                                        <tr>
                                                            <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                                            </td>
                                                        </tr>
                                                        <!-- Spacing -->

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- Spacing -->

                                        <tr>
                                            <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table bgcolor="#eacb3c" width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                    <tbody>
                        <tr>
                            <td width="100%">
                                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                                    <tbody>
                                        <!-- Spacing -->

                                        <tr>
                                            <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
                                            </td>
                                        </tr>
                                        <!-- Spacing -->

                                        <tr>
                                            <td>
                                                <!-- Social icons -->

                                                <table width="150" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                                    <tbody>
                                                        <tr>
                                                            <td width="43" height="43" align="center">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width:43px; margin-top:1.5px">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div> <a href="https://www.facebook.com/pages/Documendz/347727192061458"><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/facebook.png" alt="" border="0" width="43" height="43" style="display:block; border:none; outline:none; text-decoration:none;" /></a>
                                                                </div>
                                                            </td>
                                                            <td align="left" width="20" style="font-size:1px; line-height:1px;">
                                                            </td>
                                                            <td width="43" height="43" align="center">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width:43px; margin-top:1.5px">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div> <a href="https://twitter.com/documendz"><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/twitter.png" alt="" border="0" width="43" height="43" style="display:block; border:none; outline:none; text-decoration:none;" /></a>
                                                                </div>
                                                            </td>
                                                            <td align="left" width="20" style="font-size:1px; line-height:1px;">
                                                            </td>
                                                            <td width="43" height="43" align="center">
                                                                <div class="imgpop">
                                                                    <div class="uploader_wrap" style="width:43px; margin-top:1.5px">
                                                                        <div class="upload_buttons">
                                                                            <div class="img_link">
                                                                            </div>
                                                                            <div class="img_upload">
                                                                            </div>
                                                                            <div class="img_edit" style="visibility: visible;">
                                                                            </div>
                                                                        </div>
                                                                    </div> <a href="https://www.linkedin.com/company/documendz"><img src="https://stamplia.com/edit/7420_55w39c9l9sw08ggk8koww8c8kc0cocsocgskkwwwwwkockggo8_9071/img/linkedin.png" alt="" border="0" width="43" height="43" style="display:block; border:none; outline:none; text-decoration:none;" /></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end of Social icons -->

                                            </td>
                                        </tr>
                                        <!-- Spacing -->

                                        <tr>
                                            <td height="10" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">
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
<table width="100%" bgcolor="#fcfcfc" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td>
                <div class="innerbg">
                </div>
                <table width="600" align="center" cellspacing="0" cellpadding="0" border="0" class="devicewidth">
                    <tbody>
                        <tr>
                            <td align="center" height="30" style="font-size:1px; line-height:1px;">
                                <p>
                                </p>
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



}

//email();

echo "done";
?>