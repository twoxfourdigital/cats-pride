<?php

if ( ! defined( 'ABSPATH' ) && !isset($_GET['test']) ) {
    exit; // Exit if accessed directly
}

$message     = (!isset( $message )) ? 'This is a test message.' : $message;
$recipient   = (!isset( $recipient )) ? 'Testing' : $recipient;
$address     = (!isset( $address )) ? '123 Testing Lane' : $address;

?>
<html lang="en" style="margin: 0; outline: none; padding: 0;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <title>Shelter Nomination Status Update</title>
    <!--[if !mso]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <style data-ac-keep="true">
        .ExternalClass {
            width: 100%;
            background: inherit;
            background-color: inherit;
        }

        .ExternalClass p, .ExternalClass ul, .ExternalClass ol {
            Margin: 0;
        }

        .undoreset div p, .undoreset p {
            margin-bottom: 20px;
        }

        div[class^="aolmail_divbody"] {
            overflow: auto;
        }
    </style>
    <style data-ac-keep="true">
        @media only screen and (max-width: 600px) {
            body {
                padding: 0 !important;
                font-size: 1em !important;
            }

            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            *[class].divbody {
                -webkit-text-size-adjust: none !important;
                width: auto !important;
            }

            *[class].td_picture img {
                width: auto !important;
            }

            *[class].td_text {
                line-height: 110%;
            }

            *[class].td_button {
                width: auto;
            }

            /* Collapse all block elements */
            :not(.body) table {
                display: block !important;
                float: none !important;
                border-collapse: collapse !important;
                width: 100% !important;
                min-width: 100% !important;
                clear: both !important;
            }

            :not(.body) thead, :not(.body) tbody, :not(.body) tr {
                display: block !important;
                float: none !important;
                width: 100% !important;
            }

            :not(.body) th, :not(.body) td, :not(.body) p {
                display: block !important;
                float: none !important;
                width: 100% !important;
                clear: both !important;
            }

            /* Remove browser default styling for elements */
            ul, ol {
                margin-left: 20px;
                margin-bottom: 10px;
                margin-top: 10px;
                -webkit-margin-before: 0;
                -webkit-margin-after: 0;
                -webkit-padding-start: 0;
            }

            /* Set default height for spacer once collapse */
            *[class].spacer {
                height: auto !important;
            }

            a[href^=date] {
                color: inherit !important;
                text-decoration: none !important;
            }

            a[href^=telephone] {
                color: inherit !important;
                text-decoration: none !important;
            }

            a[href^=address] {
                color: inherit !important;
                text-decoration: none !important;
            }

            a[href^=email] {
                color: inherit !important;
                text-decoration: none !important;
            }

            /* Default table cell height */
            td[height="12"] {
                height: 12px !important;
                font-size: 12px !important;
                line-height: 12px !important;
            }

            td[height="14"] {
                height: 14px !important;
                font-size: 14px !important;
                line-height: 14px !important;
            }

            td[height="10"] {
                height: 10px !important;
                font-size: 10px !important;
                line-height: 10px !important;
            }

            /* Default social icons */
            *[class].ac-social-icon-16 {
                width: 16px !important;
                height: 16px !important;
            }

            *[class].ac-social-icon-24 {
                width: 24px !important;
                height: 24px !important;
            }

            *[class].ac-social-icon-28 {
                width: 28px !important;
                height: 28px !important;
            }

            *[class].__ac_social_icons {
                margin-right: 0px !important;
            }
        }
    </style>
    <style data-ac-keep="true"> @media only screen and (max-width: 667px) {
            #layout-row3995 img {
                width: 100% !important;
                height: auto !important;
                max-width: 600px !important;
            }

            #layout-row3997 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4000 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4002 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4007 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row4008 img {
                width: 100% !important;
                height: auto !important;
                max-width: 600px !important;
            }

            .td_rss .rss-item img.iphone_large_image {
                width: auto !important;
            }

            u + .body {
                display: table !important;
                width: 100vw !important;
                min-width: 100vw !important;
            }

            u + .body table {
                display: table !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body td {
                display: block !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body img {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                vertical-align: bottom !important;
            }

            u + .body center {
                display: block !important;
                margin: auto !important;
                width: 100% !important;
                min-width: 100% !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table, u + .body table._ac_social_table td, u + .body table._ac_social_table div, u + .body table._ac_social_table a {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                min-width: auto !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table img {
                display: inline-block !important;
                margin: auto !important;
                width: 32px !important;
                min-width: 32px !important;
                max-width: 32px !important;
            }
        }

        @media only screen and (max-width: 414px) {
            #layout-row3995 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row3997 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4000 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4002 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4007 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row4008 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            .td_rss .rss-item img.iphone_large_image {
                width: auto !important;
            }

            u + .body {
                display: table !important;
                width: 100vw !important;
                min-width: 100vw !important;
            }

            u + .body table {
                display: table !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body td {
                display: block !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body img {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                vertical-align: bottom !important;
            }

            u + .body center {
                display: block !important;
                margin: auto !important;
                width: 100% !important;
                min-width: 100% !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table, u + .body table._ac_social_table td, u + .body table._ac_social_table div, u + .body table._ac_social_table a {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                min-width: auto !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table img {
                display: inline-block !important;
                margin: auto !important;
                width: 32px !important;
                min-width: 32px !important;
                max-width: 32px !important;
            }
        }

        @media only screen and (max-width: 375px) {
            #layout-row3995 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row3997 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4000 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4002 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4007 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row4008 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            .td_rss .rss-item img.iphone_large_image {
                width: auto !important;
            }

            u + .body {
                display: table !important;
                width: 100vw !important;
                min-width: 100vw !important;
            }

            u + .body table {
                display: table !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body td {
                display: block !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body img {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                vertical-align: bottom !important;
            }

            u + .body center {
                display: block !important;
                margin: auto !important;
                width: 100% !important;
                min-width: 100% !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table, u + .body table._ac_social_table td, u + .body table._ac_social_table div, u + .body table._ac_social_table a {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                min-width: auto !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table img {
                display: inline-block !important;
                margin: auto !important;
                width: 32px !important;
                min-width: 32px !important;
                max-width: 32px !important;
            }
        }

        @media only screen and (max-width: 320px) {
            #layout-row3995 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row3997 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4000 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4002 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row4007 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row4008 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            .td_rss .rss-item img.iphone_large_image {
                width: auto !important;
            }

            u + .body {
                display: table !important;
                width: 100vw !important;
                min-width: 100vw !important;
            }

            u + .body table {
                display: table !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body td {
                display: block !important;
                width: 100% !important;
                min-width: 100% !important;
            }

            u + .body img {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                vertical-align: bottom !important;
            }

            u + .body center {
                display: block !important;
                margin: auto !important;
                width: 100% !important;
                min-width: 100% !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table, u + .body table._ac_social_table td, u + .body table._ac_social_table div, u + .body table._ac_social_table a {
                display: inline-block !important;
                margin: auto !important;
                width: auto !important;
                min-width: auto !important;
                text-align: center !important;
            }

            u + .body table._ac_social_table img {
                display: inline-block !important;
                margin: auto !important;
                width: 32px !important;
                min-width: 32px !important;
                max-width: 32px !important;
            }
        }
    </style><!--[if !mso]><!-- webfonts --><!--<![endif]--><!--[if lt mso 12]> <![endif]-->

<body id="ac-designer" class="body"
      style="font-family: Arial; line-height: 1.1; margin: 0px; background-color: #ffffff; width: 100%; text-align: center;"
      marginwidth="0" marginheight="0">
<div class="divbody"
     style="margin: 0px; outline: none; padding: 0px; color: #000000; font-family: arial; line-height: 1.1; width: 100%; background-color: #FFFFFF; background: #FFFFFF; text-align: center;">
    <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="100%" align="left"
           style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; background: #FFFFFF;">
        <tbody>
        <tr>
            <td align="center" valign="top" width="100%">
                <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#FFFFFF"
                       style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px;">
                    <tbody>
                    <tr>
                        <td id="layout_table_8cbdfbd79fe8b41d40d0879e79943daff113ce5a" valign="top" align="center"
                            width="600" style="background-color: #ffffff;">
                            <table cellpadding="0" cellspacing="0" border="0" class="layout layout-table root-table"
                                   width="600"
                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                <tbody>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3997" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3997" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3997" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="30">
                                                                <div class="spacer" style="margin: 0; outline: none;
padding: 0; height: 30px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="30" width="600">&nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3995" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3995" class="layout layout-row widget _widget_picture "
                                                align="center">
                                                <td id="layout-row-padding3995" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><img
                                                                        src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_PurpleHeader.jpg'; ?>"
                                                                        alt="Shelter Nomination Status Update" width="600"
                                                                        style="display: block; border: none; outline: none; width: 600px; opacity: 1; max-width: 100%;">
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3996" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3996" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3996" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="50">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 50px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="50" width="600">&nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
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
                                <tr id="layout-row4001" class="layout layout-row clear-this "
                                    style="background-color: #ffffff;">
                                    <td id="layout-row-padding4001" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr>
                                                <td id="layout_table_608f06ce99f46c632218fb83e7ecdc3130d4875e"
                                                    valign="top" width="75">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="75"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin4000" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row4000"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding4000" valign="top">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="top" height="125">
                                                                                        <div class="spacer"
                                                                                             style="margin: 0; outline: none; padding: 0; height: 125px;">
                                                                                            <table cellpadding="0"
                                                                                                   cellspacing="0"
                                                                                                   border="0"
                                                                                                   width="100%"
                                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="spacer-body"
                                                                                                        valign="top"
                                                                                                        height="125"
                                                                                                        width="75">
                                                                                                        &nbsp;
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody>
                                                                                            </table>
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td id="layout_table_3f9f6188597cfd0e6488cabaf16db5751daf9de6"
                                                    valign="top" width="450">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="450"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin3998" valign="top"
                                                                style="padding: 0;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row3998"
                                                                        class="layout layout-row widget _widget_text style3998"
                                                                        style="margin: 0; padding: 0;">
                                                                        <td id="layout-row-padding3998" valign="top"
                                                                            style="padding: 0 0px 10px 0px;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="text_div3487"
                                                                                        class="td_text td_block"
                                                                                        valign="top" align="left"
                                                                                        style="line-height: 150%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.5; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                        <div style="line-height: 150%; margin: 0; outline: none; padding: 0; text-align: left; mso-line-height-rule: exactly;
line-height: 1.5;" class="" data-line-height="1.5">
                                                                                            <div style="color: inherit; font-size: 14px; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                  class=""><?php echo $message; ?></div>
                                                                                        </div>
                                                                                        <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                        <style data-ac-keep="true"
                                                                                               data-ac-inline="false"> #text_div3487, #text_div3487 div {
                                                                                            line-height: 150% !important;
                                                                                        }

                                                                                        ;
                                                                                        </style>
                                                                                        <![endif]--></td>
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
                                                </td>
                                                <td id="layout_table_ee6b4cbffd841188fce242dd3a47181846a91f8d"
                                                    valign="top" width="75">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="75"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin4002" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row4002"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding4002" valign="top">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="top" height="125">
                                                                                        <div class="spacer"
                                                                                             style="margin: 0; outline: none; padding: 0; height: 125px;">
                                                                                            <table cellpadding="0"
                                                                                                   cellspacing="0"
                                                                                                   border="0"
                                                                                                   width="100%" style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt;
mso-table-rspace: 0pt;">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="spacer-body"
                                                                                                        valign="top"
                                                                                                        height="125"
                                                                                                        width="75">
                                                                                                        &nbsp;
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody>
                                                                                            </table>
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin4010" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row4010" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding4010" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="30">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 30px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="30" width="600">&nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
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

                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin4003" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row4003" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding4003" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="30">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 30px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="30" width="600">&nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin4008" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row4008" class="layout layout-row widget _widget_picture "
                                                align="left">
                                                <td id="layout-row-padding4008" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="left" valign="top" width="600">
                                                                <img src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_LogoBar.jpg'; ?>"
                                                                     alt="Cat's Pride Logo" width="600"
                                                                     style="display: block; border: none; outline: none; width: 600px; opacity: 1; max-width: 100%;">
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin4009" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row4009"
                                                class="layout layout-row widget _widget_html style4009" style="">
                                                <td id="layout-row-padding4009" valign="top" style="padding: 0px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="html_div3497" width="600" align="left">
                                                                <table width="600" border="0" cellspacing="0"
                                                                       cellpadding="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td bgcolor="#F7F7F9"
                                                                            style="text-align: center"><a
                                                                                    href="http://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=131A155A0A1086"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/footer_websitebutton.png?r=644622158"
                                                                                        width="74" height="17"
                                                                                        alt="catspride.com"
                                                                                        style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="http://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=131A155A0A1087"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-facebook.png?r=62755498"
                                                                                        width="17" height="17"
                                                                                        alt="Facebook"
                                                                                        style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="http://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=131A155A0A1088"
                                                                                    style="margin: 0; outline: none; padding: 0; color:
#045FB4; display: inline-block;"><img src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-twitter.png?r=2097560124"
                                      width="17" height="17" alt="Twitter" style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="http://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=131A155A0A1089"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-instagram.png?r=281172111"
                                                                                        width="17" height="17"
                                                                                        alt="Instagram"
                                                                                        style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="http://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=131A155A0A1090"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-youtube.png?r=2122732911"
                                                                                        width="24" height="17"
                                                                                        alt="YouTube"
                                                                                        style="display: block; border: none;"></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="10" bgcolor="#F7F7F9"
                                                                            style="font-size: 10px; height: 10px; line-height: 10px;"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td bgcolor="#F7F7F9"
                                                                            style="font-size: 14px; line-height: 18px; font-family: Arial, sans-serif; color:#2F408E; text-align: center">
                                                                            <strong style="margin: 0; outline: none; padding: 0;">Questions
                                                                                or Comments?</strong><br> Please email
                                                                            <a href="mailto:ken.berry@oildri.com"
                                                                               style="margin: 0; outline: none; padding: 0; color: #2F408E; text-decoration: none;">ken.berry@oildri.com</a>
                                                                            or call <a href="tel:+18006453741"
                                                                                       style="margin: 0; outline: none; padding: 0; color: #2F408E; text-decoration: none;">1-800-645-3741</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td bgcolor="#F7F7F9">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td bgcolor="#F7F7F9" height="10"
                                                                            style="font-size: 10px; height: 10px; line-height: 10px; border-top: 3px solid #e6e7e9;">
                                                                            &nbsp;
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <table bgcolor="#F7F7F9" border="0" cellspacing="0"
                                                                       cellpadding="0" class="wrapto100pc"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; width: 100%; padding: 0 0 10px 0;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="center">
                                                                            <table style="font-size: 13px; min-width: 100px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0 auto;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td><p style="text-align:center;">
                                                                                            <img src="https://gallery.mailchimp.com/6dbb0fa1496d8615550efda2d/images/12884f9d-1a4f-4a16-9bfe-4f74b41db657.png"
                                                                                                 width="80" height="54"
                                                                                                 style="display: inline-block;"
                                                                                                 alt="Oil-Dri"></p>
                                                                                    </td>
                                                                                    <td style="font-size: 14px; line-height: 18px; font-family: Arial, sans-serif; color: #2F408E; text-align: center">
                                                                                        Maker of Cat’s Pride &amp; Jonny
                                                                                        Cat
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
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin4004" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row4004"
                                                class="layout layout-row widget _widget_text style4004"
                                                style="margin: 0; padding: 0; background-color: #6abf4b;">
                                                <td id="layout-row-padding4004" valign="top"
                                                    style="background-color: #6abf4b; padding: 17px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div3492" class="td_text td_block" valign="top"
                                                                align="left"
                                                                style="line-height: 150%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.5; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                <div style="margin: 0; outline: none; padding: 0; color: #ffffff;"
                                                                     class=""><span
                                                                            style="color: #ffffff; font-size: inherit; font-weight: 400; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: normal;"
                                                                            class="">"Cat's Pride", "Fresh & Light", "Fresh & Light Ultimate Care", "KatKit", "Jonny Cat", "Changing Litter for Good", "Light Done Right", "Oil-Dri", "Look for the Green Jug", "The Green Jug", "Green Jug" and "Litter for Good" are all registered trademarks of Oil-Dri Corporation of America. <br><a
                                                                                href="https://catspride.com/legal/"
                                                                                target="_blank"
                                                                                style="margin: 0; outline: none; padding: 0; color: #ffffff; text-decoration: underline; font-family: arial; font-weight: 400; font-size: 10px; font-style: normal;"><span
                                                                                    style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; font-family: arial;"
                                                                                    class="">Terms &amp; Conditions</span></a><span
                                                                                style="color: #ffffff; font-size: 10px; font-weight: 400; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: normal;"> | </span><a
                                                                                href="https://catspride.com/privacy-statement/"
                                                                                target="_blank"
                                                                                style="margin: 0; outline: none; padding: 0; color: #ffffff; text-decoration: underline; font-family: arial; font-weight: inherit; font-size: 10px; font-style: normal;"><span
                                                                                    style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; font-family: arial;"
                                                                                    class="">Privacy Policy</span></a></span><br
                                                                            style="color: #ffffff;" class="">
                                                                </div>
                                                                <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                <style data-ac-keep="true"
                                                                       data-ac-inline="false"> #text_div3492, #text_div3492 div {
                                                                    line-height: 150% !important;
                                                                }

                                                                ;
                                                                </style>
                                                                <![endif]--></td>
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
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<img src="https://catspride.acemlnc.com/lt.php?notrack=1&amp;nl=0&amp;c=131&amp;m=155&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;l=open"
     border="0" width="1" height="1"
     style="display:block;width:1px!important;min-width:1px!important;max-width:1px!important;height:1px!important;border:0;overflow:hidden;"><br>
<div style="background-color:#FFFFFF;background:#FFFFFF;min-width:100%;mso-table-lspace:0pt;mso-table-rspace:0pt;padding:20px;color:#000000;font-size:11px;font-family:arial,helvetica,sans-serif;line-height:140%;line-height:1.4;text-align:center;box-sizing:border-box;">
    <center>
        Sent to: <span
                style="font-size:11px;font-family:arial,helvetica,sans-serif;font-weight:normal;text-decoration:none;outline:none;"><?php echo $recipient; ?></span>
        <br>
        <br>
        <a style="color:#000000;text-decoration:underline;" href="%tag_unsubscribe_url%" target="_blank">Unsubscribe</a>
        <br>
        <br><?php echo $address; ?>
    </center>
</div>
</body>
</html>