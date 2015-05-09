<?php
require 'config.php';
use traderc\TradeRec,traderc\TradeRecDAO;
$tr = new TradeRec(TradeRecDAO::GetLastTradeRec());

function email($tr){
    
$bodytitle=$tr->title;
$date=$tr->date;
$time=$tr->time;
$tr_strategy=$tr->tr_strategy;
$month=$tr->month;
$futures_name=$tr->futures_name;
$entry_choice=$tr->entry_choice;
$entry_price=$tr->entry_price;
$price_target=$tr->price_target;
$stop_loss=$tr->stop_loss;
$description=$tr->description;

$email="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
        <title></title>
        
        <!--[if gte mso 6]>
        <style>
            table.FollowContent {width:100% !important;}
            table.ShareContent {width:100% !important;}
        </style>
        <![endif]-->
    <style type='text/css'>
		#outlook a{
			padding:0;
		}
		.ReadMsgBody{
			width:100%;
		}
		.ExternalClass{
			width:100%;
		}
		body{
			margin:0;
			padding:0;
		}
		a{
			word-wrap:break-word !important;
		}
		img{
			border:0;
			height:auto !important;
			line-height:100%;
			outline:none;
			text-decoration:none;
		}
		table,td{
			border-collapse:collapse;
			mso-table-lspace:0pt;
			mso-table-rspace:0pt;
		}
		#bodyTable,#bodyCell{
			height:100% !important;
			margin:0;
			padding:0;
			width:100% !important;
		}
		#bodyCell{
			padding:20px;
		}
		.Image{
			vertical-align:bottom;
		}
		.TextContent img{
			height:auto !important;
		}
		body,#bodyTable{
			background-color:#dee0e2;
		}
		#bodyCell{
			border-top:0;
		}
		#templateContainer{
			border:0;
		}
		h1{
			color:#666666 !important;
			display:block;
			font-family:Helvetica;
			font-size:40px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:-1px;
			margin:0;
			text-align:left;
		}
		h2{
			color:#404040 !important;
			display:block;
			font-family:Helvetica;
			font-size:26px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:-.75px;
			margin:0;
			text-align:left;
                        border-bottom: 1px solid #cccccc;
		}
		h3{
			color:#606060 !important;
			display:block;
			font-family:Helvetica;
			font-size:18px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:-.5px;
			margin:0;
			text-align:left;
		}
		h4{
			color:#808080 !important;
			display:block;
			font-family:Helvetica;
			font-size:16px;
			font-style:normal;
			font-weight:bold;
			line-height:125%;
			letter-spacing:normal;
			margin:0;
			text-align:left;
		}
		h1 a,h2 a,h3 a,h4 a{
			color:#6DC6DD;
			font-weight:bold;
			text-decoration:none;
		}
		#templatePreheader{
			background-color:#ffffff;
			border-top:0;
			border-bottom:2px solid #F2F2F2;
		}
		.preheaderContainer .TextContent,.preheaderContainer .TextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:11px;
			line-height:125%;
			text-align:left;
		}
		.preheaderContainer .TextContent a{
			color:#606060;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateHeader{
			background-color:#ffffff;
			border-top:0;
			border-bottom:0;
		}
		.headerContainer .TextContent,.headerContainer .TextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:15px;
			line-height:150%;
			text-align:left;
		}
		.headerContainer .TextContent a{
			color:#505050;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateBody{
			background-color:#ffffff;
			border-top:3px solid #DEE0E2;
			border-bottom:3px solid #DEE0E2;
		}
		.bodyContainer .TextContent,.bodyContainer .TextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:15px;
			line-height:150%;
			text-align:left;
		}
		.bodyContainer .TextContent a{
			color:#505050;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateFooter{
			background-color:#cccccc;
			border-top:0;
			border-bottom:0;
		}
		.footerContainer .TextContent,.footerContainer .TextContent p{
			color:#606060;
			font-family:Helvetica;
			font-size:11px;
			line-height:125%;
			text-align:left;
		}
		.footerContainer .TextContent a{
			color:#606060;
			font-weight:normal;
			text-decoration:underline;
		}
	@media only screen and (max-width: 480px){
		body,table,td,p,a,li,blockquote{
			-webkit-text-size-adjust:none !important;
		}

}	@media only screen and (max-width: 480px){
		body{
			width:100% !important;
			min-width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		td[id=bodyCell]{
			padding:10px !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=TextContentContainer]{
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=BoxedTextContentContainer]{
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=mcpreview-image-uploader]{
			width:100% !important;
			display:none !important;
		}

}	@media only screen and (max-width: 480px){
		img[class=Image]{
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=ImageGroupContentContainer]{
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageGroupContent]{
			padding:9px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageGroupBlockInner]{
			padding-bottom:0 !important;
			padding-top:0 !important;
		}

}	@media only screen and (max-width: 480px){
		tbody[class=ImageGroupBlockOuter]{
			padding-bottom:9px !important;
			padding-top:9px !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=CaptionTopContent],table[class=CaptionBottomContent]{
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=CaptionLeftTextContentContainer],table[class=CaptionRightTextContentContainer],table[class=CaptionLeftImageContentContainer],table[class=CaptionRightImageContentContainer],table[class=ImageCardLeftTextContentContainer],table[class=ImageCardRightTextContentContainer]{
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageCardLeftImageContent],td[class=ImageCardRightImageContent]{
			padding-right:18px !important;
			padding-left:18px !important;
			padding-bottom:0 !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageCardBottomImageContent]{
			padding-bottom:9px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageCardTopImageContent]{
			padding-top:18px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageCardLeftImageContent],td[class=ImageCardRightImageContent]{
			padding-right:18px !important;
			padding-left:18px !important;
			padding-bottom:0 !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageCardBottomImageContent]{
			padding-bottom:9px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=ImageCardTopImageContent]{
			padding-top:18px !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=CaptionLeftContentOuter] td[class=TextContent],table[class=CaptionRightContentOuter] td[class=TextContent]{
			padding-top:9px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=CaptionBlockInner] table[class=CaptionTopContent]:last-child td[class=TextContent]{
			padding-top:18px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=BoxedTextContentColumn]{
			padding-left:18px !important;
			padding-right:18px !important;
		}

}	@media only screen and (max-width: 480px){
		table[id=templateContainer],table[id=templatePreheader],table[id=templateHeader],table[id=templateBody],table[id=templateFooter]{
			max-width:600px !important;
			width:100% !important;
		}

}	@media only screen and (max-width: 480px){
		h1{
			font-size:24px !important;
			line-height:125% !important;
		}

}	@media only screen and (max-width: 480px){
		h2{
			font-size:20px !important;
			line-height:125% !important;
		}

}	@media only screen and (max-width: 480px){
		h3{
			font-size:18px !important;
			line-height:125% !important;
		}

}	@media only screen and (max-width: 480px){
		h4{
			font-size:16px !important;
			line-height:125% !important;
		}

}	@media only screen and (max-width: 480px){
		table[class=BoxedTextContentContainer] td[class=TextContent]{
			font-size:18px !important;
			line-height:125% !important;
		}

}	@media only screen and (max-width: 480px){
		table[id=templatePreheader]{
			display:block !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=preheaderContainer] td[class=TextContent]{
			font-size:14px !important;
			line-height:115% !important;
			padding-right:18px !important;
			padding-left:18px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=headerContainer] td[class=TextContent]{
			font-size:18px !important;
			line-height:125% !important;
			padding-right:18px !important;
			padding-left:18px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=bodyContainer] td[class=TextContent]{
			font-size:18px !important;
			line-height:125% !important;
			padding-right:18px !important;
			padding-left:18px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=footerContainer] td[class=TextContent]{
			font-size:14px !important;
			line-height:115% !important;
			padding-right:18px !important;
			padding-left:18px !important;
		}

}	@media only screen and (max-width: 480px){
		td[class=footerContainer] a[class=utilityLink]{
			display:block !important;
		}

}		.bodyContainer .TextContent{
			color:#666666;
		}
		.headerContainer .TextContent{
			color:#000000;
		}
		.bodyContainer .TextContent a,.bodyContainer .TextContent a .yshortcuts{
			color:#eb4102;
		}
		.footerContainer .TextContent{
			font-size:9px;
			line-height:110%;
			text-align:left;
		}
</style>
    </head>
    <body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0' offset='0' style='margin: 0;padding: 0;background-color: #dee0e2;'>
        <center>
            <table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 0;padding: 0;background-color: #dee0e2;height: 100% !important;width: 100% !important;'>
                <tr>
                    <td align='center' valign='top' id='bodyCell' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 0;padding: 20px;border-top: 0;height: 100% !important;width: 100% !important;'>
                        <!-- BEGIN TEMPLATE // -->
                        <table border='0' cellpadding='0' cellspacing='0' width='600' id='templateContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;border: 0;'>
                            <tr>
                                <td align='center' valign='top' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                    <!-- BEGIN PREHEADER // -->
                                    <table border='0' cellpadding='0' cellspacing='0' width='600' id='templatePreheader' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background-color: #ffffff;border-top: 0;border-bottom: 2px solid #F2F2F2;'>
                                        <tr>
                                            <td valign='top' class='preheaderContainer' style='padding-top: 9px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='TextBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='TextBlockOuter'>
                                                        <tr>
                                                            <td valign='top' class='TextBlockInner' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='366' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 9px;padding-left: 18px;padding-bottom: 9px;padding-right: 0;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;'>                                                                            
                                                                                <span style='font-family:arial,helvetica neue,helvetica,sans-serif;'>
<!--PREHEADER LEFT-->                                                               <span style='font-size: 11px;'>Trade Recommendation</span>                                                                                    
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table align='right' border='0' cellpadding='0' cellspacing='0' width='197' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 0;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;'>
                                                                                <div style='text-align: right;'>
                                                                                    <span style='font-size:11px;'>
                                                                                        <span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--PREHEADER RIGHT-->                                                                      <a href='http://www.northernadvisors.com' target='_blank' style='color: #606060;font-weight: normal;text-decoration: underline;word-wrap: break-word !important;'>Please visit our web site</a>
                                                                                        </span>
                                                                                    </span><!-- *|END:IF|* -->
                                                                                </div>
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
                                    </table>
                                    <!-- // END PREHEADER -->
                                </td>
                            </tr>
                            <tr>
                                <td align='center' valign='top' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                    <!-- BEGIN HEADER // -->
                                    <table border='0' cellpadding='0' cellspacing='0' width='600' id='templateHeader' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background-color: #ffffff;border-top: 0;border-bottom: 0;'>
                                        <tr>
                                            <td valign='top' class='headerContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='ImageBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='ImageBlockOuter'>
                                                        <tr>
                                                            <td valign='top' style='padding-top: 30px; padding-right: 0px; padding-bottom: 20px;padding-left: 9px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;' class='ImageBlockInner'>
                                                                <table align='left' width='100%' border='0' cellpadding='0' cellspacing='0' class='ImageContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class='ImageContent' valign='top' style='padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                <a href='http://northernadvisors.com/' title='' class='' target='_self' style='word-wrap: break-word !important;'>
<!--CHANGE IMAGE-->                                                                 <img align='left' alt='' src='http://gallery.mailchimp.com/266e1d2de1370b67c9c21eb60/images/Northern_Advisors_Logo.jpg' width='266' style='max-width: 266px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;line-height: 100%;outline: none;text-decoration: none;height: auto !important;' class='Image'/>
                                                                                </a>
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
                                    </table>
                                    <!-- // END HEADER -->
                                </td>
                            </tr>
                            <tr>
                                <td align='center' valign='top' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                    <!-- BEGIN BODY // -->
                                    <table border='0' cellpadding='0' cellspacing='0' width='600' id='templateBody' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background-color: #ffffff;border-top: 3px solid #DEE0E2;border-bottom: 3px solid #DEE0E2;'>
                                        <tr>
                                            <td valign='top' class='bodyContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='TextBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='TextBlockOuter'>
                                                        <tr>
                                                            <td valign='top' class='TextBlockInner' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='600' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 25px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #666666;font-family: Helvetica;font-size: 15px;line-height: 150%;text-align: left;'>
                                                                                <h1 style='display: block;font-family: Helvetica;font-size: 40px;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: -1px;margin: 0;text-align: left;color: #666666 !important;'>
                                                                                    <span style='font-size:22px;'>
                                                                                        <span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--BODY TITLE-->                                                                           ".
$bodytitle.                                                                               "</span>                                                                                            
                                                                                    </span>
                                                                                </h1>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='TextBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='TextBlockOuter'>
                                                        <tr>
                                                            <td valign='top' class='TextBlockInner' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='600' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 25px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #666666;font-family: Helvetica;font-size: 15px;line-height: 150%;text-align: left;'>
                                                                                <h2 style='border-bottom: 1px solid #cccccc; display: block;font-family: Helvetica;font-size: 26px;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: -1px;margin: 0;text-align: left;color: #666666 !important;'>
                                                                                    <span style='font-size:18px;'>
                                                                                        <span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                            Trade Details
                                                                                        </span>
                                                                                    </span>
                                                                                </h2>
                                                                                <table border='0' cellpadding='0' cellspacing='0' style='border-bottom: 1px solid #cccccc;width: 551px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;' width='551'>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style='width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Date
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--TABLE DATE-->".$date.                                                                                        "</span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Time (CST, Chicago)
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--TABLE TIME-->".$time.                                                                                       "</span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='padding-bottom: 10px;width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Strategy
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='padding-bottom: 10px;width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--TABLE STRATEGY NAME-->".$tr_strategy.                                                                                        "</span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Month
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--TABLE MONTH NAME-->".$month.                                                                                        "</span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='padding-bottom: 10px;width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Futures Contract
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='padding-bottom: 10px;width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
<!--TABLE FUTURES CONTRACT-->".$futures_name.                                                                                        "</span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                <strong>
<!--TABLE CHOICE-->".$entry_choice.                                                             "</strong>
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                <strong>
<!--TABLE CHOICE PRICE-->".$entry_price.                                                         "</strong>
                                                                                                </span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Price Target
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                <strong>
<!--TABLE TARGET PRICE-->".$price_target.                                                       "</strong>
                                                                                                </span></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td style='width: 183px;height: 23px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                    Stop Loss
                                                                                                </span></span>
                                                                                            </td>
                                                                                            <td style='width: 368px;height: 23px;text-align: right;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                                                <span style='font-size:14px;'><span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                                <strong>
<!--TABLE STOP LOSS PRICE-->".$stop_loss.                                                       "</strong>
                                                                                                </span></span>
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
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='TextBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='TextBlockOuter'>
                                                        <tr>
                                                            <td valign='top' class='TextBlockInner' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='600' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 18px;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #666666;font-family: Helvetica;font-size: 15px;line-height: 150%;text-align: left;'>
                                                                                <span style='font-size:12px;'>
                                                                                    <span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>                                                                                       
<!--TR DETAILS DESCRIPTION -->                                                          *The Entry order is a limit or better. The Stop Loss and Profit Target orders are OCO’s (one cancels the other). All orders are placed on a not held basis.
                                                                                    </span>
                                                                                </span><br>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='TextBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='TextBlockOuter'>
                                                        <tr>
                                                            <td valign='top' class='TextBlockInner' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='600' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 18px;padding-right: 18px;padding-bottom: 36px;padding-left: 18px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #666666;font-family: Helvetica;font-size: 15px;line-height: 150%;text-align: left;'>
                                                                                <span style='font-size:14px;'>
                                                                                    <span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>
                                                                                        <h2 style='display: block;font-family: Helvetica;font-size: 26px;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: -1px;margin: 0;text-align: left;color: #666666 !important;'>
                                                                                            <span style='font-size:18px;'>
                                                                                                <span style='font-family: arial, 'helvetica neue', helvetica, sans-serif;'>Description</span>
                                                                                            </span>
                                                                                        </h2>
<!--CONTRACT DESCRIPTION-->".$description.                                                                                    "<!--West Texas Intermediate (WTI) Light Sweet Crude is a grade of crude oil and it is used in benchmark oil pricing. This grade is described as light because of its relatively low density, and sweet because of its low sulfur content. WTI futures contracts are traded on the NYMEX (CME) with delivery months of nine years forward. Consecutive months are listed in the current year and the next five years. June and December months are listed beyond the sixth year. WTI Crude oil is quoted in dollars and cents per barrel.                                                                                   
                                                                                        --></span>
                                                                                </span><br>
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
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                            <tr>
                                <td align='center' valign='top' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                    <!-- BEGIN FOOTER // -->
                                    <table border='0' cellpadding='0' cellspacing='0' width='600' id='templateFooter' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;background-color: #cccccc;border-top: 0;border-bottom: 0;'>
                                        <tr>
                                            <td valign='top' class='footerContainer' style='padding-bottom: 9px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' class='TextBlock' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                    <tbody class='TextBlockOuter'>
                                                        <tr>
                                                            <td valign='top' class='TextBlockInner' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='600' class='TextContentContainer' style='border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign='top' class='TextContent' style='padding-top: 18px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;'>
                                                                                <div style='text-align: justify;'>
<!--DISCLOSURE FOOTER-->                                                              THE RISK OF LOSS IN TRADING COMMODITY FUTURES CONTRACTS CAN BE SUBSTANTIAL. YOU SHOULD THEREFORE CAREFULLY CONSIDER WHETHER SUCH TRADING IS SUITABLE FOR YOU IN LIGHT OF YOUR FINANCIAL CONDITION. YOU MAY SUSTAIN A TOTAL LOSS OF THE INITIAL MARGIN FUNDS AND ANY ADDITIONAL FUNDS THAT YOU DEPOSIT WITH YOUR BROKER TO ESTABLISH OR MAINTAIN A POSITION IN THE COMMODITY FUTURES MARKET.<br></br>HYPOTHETICAL OR SIMULATED PERFORMANCE RESULTS HAVE CERTAIN LIMITATIONS. UNLIKE AN ACTUAL PERFORMANCE RECORD, SIMULATED RESULTS DO NOT REPRESENT ACTUAL TRADING. ALSO, SINCE TRADES MAY OR MAY NOT HAVE BEEN EXECUTED, THE RESULTS MAY HAVE UNDER OR OVER-COMPENSATED FOR THE IMPACT, IF ANY OF CERTAIN MARKET FACTORS, SUCH AS LACK OF LIQUIDITY. NO REPRESENTATION CAN, WILL OR IS BEING MADE THAT ANY ACCOUNT WILL, OR IS LIKELY TO, ACHIEVE PROFITS OR LOSSES SIMILAR TO THOSE SHOWN IN ANY HYPOTHETICAL PERFORMANCE RECORD.<br></br>THIS EMAIL IS NOT INTENDED AS AN OFFER OR SOLICITATION FOR THE PURCHASE OR SALE OF ANY COMMODITY OR FUTURES CONTRACT OR OPTION OR AS AN OFFICIAL CONFIRMATION OF ANY TRANSACTION. ALL MARKET PRICES, DATA AND OTHER INFORMATION ARE NOT WARRANTED AS TO COMPLETENESS OR ACCURACY AND ARE SUBJECT TO CHANGE WITHOUT NOTICE. ANY COMMENTS OR STATEMENTS MADE HEREIN DO NOT NECESSARILY REFLECT THOSE OF NORTHERN ADVISORS, LLC OR ITS AFFILIATES.<br></br>PAST PERFORMANCE IS NOT NECESSARILY A GUIDE TO FUTURE PERFORMANCE. THE VALUE OF INVESTMENTS AND THE INCOME FROM THEM CAN GO DOWN AS WELL AS UP. YOU MAY NOT GET BACK THE AMOUNT ORIGINALLY INVESTED.                                                                                                                                                                                
                                                                                </div>
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
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
<!--ADD SENDER INFORMATION-->
        <style type='text/css'>
            @media only screen and (max-width: 480px){
                table[id='canspamBar'] td{font-size:14px !important;}
                table[id='canspamBar'] td a{display:block !important; margin-top:10px !important;}
            }
        </style>
    </body>
</html>
";
//$email=settype($email, 'string');
return $email;
}
