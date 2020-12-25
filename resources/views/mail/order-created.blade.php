@php
    $orderDetails = Helper::jsonToArray($order->order_details);
    $userAdress = Helper::jsonToArray($order->user->bill_address);
    $setting = namedSettings(App\Models\Setting::all());
    $siteUrl = env('APP_URL');
    $siteName = env('APP_NAME');
    $logo = $setting['logo']->value;
    $currency = $setting['currency']->value;
    $address = $setting['address']->value;
    $phone = $setting['phone']->value;
    $email = $setting['email']->value;
@endphp

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
 <head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="telephone=no" name="format-detection">
 <title>{{env('APP_NAME')}}</title>
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <style type="text/css">
#outlook a {
	padding:0;
}
.ExternalClass {
	width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
	line-height:100%;
}
.es-button {
	mso-style-priority:100!important;
	text-decoration:none!important;
}
a[x-apple-data-detectors] {
	color:inherit!important;
	text-decoration:none!important;
	font-size:inherit!important;
	font-family:inherit!important;
	font-weight:inherit!important;
	line-height:inherit!important;
}
.es-desk-hidden {
	display:none;
	float:left;
	overflow:hidden;
	width:0;
	max-height:0;
	line-height:0;
	mso-hide:all;
}
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-menu td a { font-size:16px!important } }
</style>
 </head>
 <body style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
  <div class="es-wrapper-color" style="background-color:#EFEFEF">
   <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#efefef"></v:fill>
			</v:background>
		<![endif]-->
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
     <tr style="border-collapse:collapse">
      <td valign="top" style="padding:0;Margin:0">
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
         <tr style="border-collapse:collapse">
          <td class="es-adaptive" align="center" style="padding:0;Margin:0">
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#EFEFEF;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px">
               <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:270px">
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;display:none"></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:270px">
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;display:none"></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
         <tr style="border-collapse:collapse">
          <td align="center" style="padding:0;Margin:0">
           <table class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ff0000;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ff0000" align="center">
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:15px;padding-right:15px">
               <!--[if mso]><table style="width:570px" cellpadding="0" cellspacing="0"><tr><td style="width:180px" valign="top"><![endif]-->
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr style="border-collapse:collapse">
                  <td class="es-m-p0r" valign="top" align="center" style="padding:0;Margin:0;width:180px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                     <td class="es-m-p0l es-m-txt-c" align="left" style="padding:0;Margin:0;padding-left:15px;font-size:0"><a href="{{env('APP_URL')}}" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#999999"><img src="{{$logo}}" alt="{{$siteName}}" title="{{$siteName}}" width="118" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td><td style="width:20px"></td><td style="width:370px" valign="top"><![endif]-->
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:370px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td style="padding:0;Margin:0">
                       <table class="es-menu" width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr class="links" style="border-collapse:collapse">
                         <td style="Margin:0;padding-left:5px;padding-right:5px;padding-top:20px;padding-bottom:10px;border:0" width="25.00%" bgcolor="transparent" align="center"><a style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:16px;text-decoration:none;display:block;color:#ffffff" href="{{env('APP_URL')}}/shop">{{__('lang.shop')}}</a></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
           </table></td>
         </tr>
       </table>
          <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
         <tr style="border-collapse:collapse">
          <td align="center" style="padding:0;Margin:0">
           <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:0px" width="100%" cellspacing="0" cellpadding="0" role="presentation">
                     <tr style="border-collapse:collapse">
                     <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px"><h1 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#333333">{{__('lang.thanks_for_your_order')}}<br></h1></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td align="center" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">{{__('lang.you_will_receive_an_email_when_your_items_status_changed')}}</p></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                     <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:15px"><span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#D48344 none repeat scroll 0% 0%;border-width:0px;display:inline-block;border-radius:5px;width:auto;border-top:0px solid #2CB543;border-bottom:0px solid #2CB543"><a href="{{env('APP_URL')}}/my-account" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:underline;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:16px;color:#FFFFFF;border-style:solid;border-color:#D48344;border-width:10px 20px 10px 20px;display:inline-block;background:#D48344 none repeat scroll 0% 0%;border-radius:5px;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center;border-top-width:10px;border-bottom-width:10px">{{__('lang.view_order_status')}}</a></span></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
         <tr style="border-collapse:collapse">
          <td align="center" style="padding:0;Margin:0">
           <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:30px">
               <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:280px" valign="top"><![endif]-->
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr style="border-collapse:collapse">
                  <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:280px">
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FEF9EF;border-color:#EFEFEF;border-width:1px 0px 1px 1px;border-style:solid" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef" role="presentation">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px"><h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif">{{__('lang.SUMMARY')}}:</h4></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="left" role="presentation">

                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0"><span style="font-size:14px;line-height:21px">{{__('lang.order')}} #:</span></td>
                          <td style="padding:0;Margin:0"><span style="font-size:14px;line-height:21px">{{$order->order_id}}</span></td>
                         </tr>

                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0"><span style="font-size:14px;line-height:21px">{{__('lang.order_date')}}:</span></td>
                         <td style="padding:0;Margin:0"><span style="font-size:14px;line-height:21px">{{$order->created_at}}</span></td>
                         </tr>

                          <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0"><span style="font-size:14px;line-height:21px">{{__('lang.order_total')}}:</span></td>
                         <td style="padding:0;Margin:0"><span style="font-size:14px;line-height:21px">{{$currency}} {{$order->price}}</span></td>
                         </tr>

                       </table><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td><td style="width:0px"></td><td style="width:280px" valign="top"><![endif]-->
               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:280px">
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FEF9EF;border-width:1px;border-style:solid;border-color:#EFEFEF" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef" role="presentation">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="Margin:0;padding-bottom:10px;padding-top:20px;padding-left:20px;padding-right:20px"><h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif">{{__('lang.SHIPPING_ADDRESS')}}:<br></h4></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">{{$userAdress['address_line1']}}, {{$userAdress['address_line2']}}, {{$userAdress['country']}}</p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
         <tr style="border-collapse:collapse">
          <td align="center" style="padding:0;Margin:0">
           <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px">
               <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]-->
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr style="border-collapse:collapse">
                  <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:270px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0;padding-left:20px"><h4 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'trebuchet ms', helvetica, sans-serif">{{__('lang.items_ordered')}}</h4></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]-->
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:270px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0"><span style="font-size:13px">{{__('lang.name')}}</span></td>
                          <td style="padding:0;Margin:0;width:60px;text-align:center"><span style="font-size:13px"><span style="line-height:100%">{{__('lang.qty')}}</span></span></td>
                          <td style="padding:0;Margin:0;width:100px;text-align:center"><span style="font-size:13px"><span style="line-height:100%">{{__('lang.price')}}</span></span></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
             <tr style="border-collapse:collapse">
              <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0">
                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;height:1px;width:100%;margin:0px"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
              @foreach ($orderDetails as $product)
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:5px;padding-bottom:10px;padding-left:20px;padding-right:20px">
               <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:178px" valign="top"><![endif]-->
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr style="border-collapse:collapse">
                  <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:178px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;font-size:0"><a href="{{$siteUrl}}" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#D48344"><img src="{{$siteUrl.$product['post']['thumbnail']}}" alt="{{$product['post']['title']}}" class="adapt-img" title="{{$product['post']['title']}}" width="125" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
                    <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:362px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p>
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0">{{substr($product['post']['title'],0,20)}}</td>
                           <td style="padding:0;Margin:0;width:60px;text-align:center">{{$product['quantity']}}</td>
                          <td style="padding:0;Margin:0;width:100px;text-align:center">{{$currency}} {{$product['post']['discounted_price'] ? $product['post']['discounted_price'] : $product['post']['price']}}</td>

                         </tr>
                       </table><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>

               <!--[if mso]></td><td style="width:20px"></td><td style="width:362px" valign="top"><![endif]-->

               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
             @endforeach
             <tr style="border-collapse:collapse">
              <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0">
                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;height:1px;width:100%;margin:0px"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr style="border-collapse:collapse">
              <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0">
                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;height:1px;width:100%;margin:0px"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr style="border-collapse:collapse">
              <td align="left" style="padding:0;Margin:0;padding-left:20px;padding-right:20px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0">
                       <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;border-bottom:1px solid #EFEFEF;height:1px;width:100%;margin:0px"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-top:5px;padding-left:20px;padding-bottom:30px;padding-right:40px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:540px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="right" style="padding:0;Margin:0">
                       <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:500px" class="cke_show_border" cellspacing="1" cellpadding="1" border="0" align="right" role="presentation">
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{__('lang.subtotal')}} ({{count($orderDetails)}} {{__('lang.items')}}):</td>
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{$currency}}{{$order->price}}</td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{__('lang.shipping_cost')}}:</td>
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px;color:#D48344"><strong>{{__('lang.free')}}</strong></td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{__('lang.discount')}}:</td>
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px">{{$currency}} 0</td>
                         </tr>
                         <tr style="border-collapse:collapse">
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px"><strong>{{__('lang.order_total')}}:</strong></td>
                          <td style="padding:0;Margin:0;text-align:right;font-size:18px;line-height:27px;color:#D48344"><strong>{{$currency}}{{$order->price}}</strong></td>
                         </tr>
                       </table><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333"><br></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
         <tr style="border-collapse:collapse">
          <td align="center" style="padding:0;Margin:0">
           <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ff0000;width:600px">
             <tr style="border-collapse:collapse">
              <td align="left" style="padding:20px;Margin:0">
               <!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:178px" valign="top"><![endif]-->
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr style="border-collapse:collapse">
                  <td class="es-m-p0r es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:178px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                      <tr style="border-collapse:collapse">
                     <td class="es-m-p0l es-m-txt-c" align="left" style="padding:0;Margin:0;padding-left:15px;font-size:0"><a href="{{env('APP_URL')}}" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#999999"><img src="{{$logo}}" alt="{{$siteName}}" title="{{$siteName}}" width="118" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"></a></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-bottom:5px;padding-top:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#ffffff">{{$address}}</p></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#ffffff"><a target="_blank" href="tel:{{$phone}}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#ffffff">{{$phone}}</a><br><a target="_blank" href="mailto:{{$email}}" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#ffffff">{{$email}}</a></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td><td style="width:20px"></td><td style="width:362px" valign="top"><![endif]-->
               <table cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td align="left" style="padding:0;Margin:0;width:362px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#ffffff"><span style="font-size:20px;line-height:30px">{{__('lang.information')}}</span></p></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td class="es-m-txt-c" align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#ffffff"><a style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#ffffff">{{__('lang.this_email_about_your_order')}}</p></td>
                     </tr>
                     <tr style="border-collapse:collapse">
                      <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:18px;color:#ffffff"><a target="_blank" href="" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:12px;text-decoration:underline;color:#ffffff;line-height:18px" class="unsubscribe">{{__('lang.unsubscribe')}}</a></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table>
               <!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
         <tr style="border-collapse:collapse">
          <td align="center" style="padding:0;Margin:0">
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" align="center">
             <tr style="border-collapse:collapse">
              <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px">
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr style="border-collapse:collapse">
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr style="border-collapse:collapse">
                      <td align="center" style="padding:0;Margin:0;display:none"></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table></td>
     </tr>
   </table>
  </div>
 </body>
</html>
