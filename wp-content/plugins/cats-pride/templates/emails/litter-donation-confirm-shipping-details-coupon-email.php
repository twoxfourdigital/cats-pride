<?php

if ( ! defined( 'ABSPATH' ) && !isset($_GET['test']) ) {
    exit; // Exit if accessed directly
}

$domain_url       = (function_exists( 'home_url' )) ? trim( home_url(), '/') : $_SERVER['REQUEST_SCHEME'] . '://' .$_SERVER['SERVER_NAME'];
$edit_shelter_url = (!isset( $edit_shelter_url ) && !function_exists( 'esc_url' ) ) ? '#' : esc_url( $edit_shelter_url );

?>
<html lang="en" style="margin: 0; outline: none; padding: 0;">
<head>
    <style>
        .ac-social-icon {
            display: inline-block !important;
        }
    </style>
    <!--[if !mso]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <title>Litter Donation Coupons</title>
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

        [owa] #ac-footer {
            padding: 20px 0px !important;
            background: inherit;
            background-color: inherit;
        }
    </style>
    <style data-ac-keep="true">
        @media only screen and (max-width: 600px) {
            /*-------------------------------------------------------------------------*\ Abandoned Cart widget \*------------------------------------------------------------------------*/
            .td_abandoned-cart img {
                display: block;
                padding-right: 0 !important;
                padding-bottom: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

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
            td[height="14"] {
                height: 14px !important;
                font-size: 14px !important;
                line-height: 14px !important;
            }

            td[height="11"] {
                height: 11px !important;
                font-size: 11px !important;
                line-height: 11px !important;
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
    <style data-ac-keep="true"> @media only screen and (max-width: 320px) {
            #layout-row9207 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row9208 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9210 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9212 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9217 img {
                width: 100% !important;
                height: auto !important;
                max-width: 146px !important;
            }

            #layout-row9218 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row9222 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row9223 img {
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

        @media only screen and (max-width: 375px) {
            #layout-row9207 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row9208 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9210 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9212 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9217 img {
                width: 100% !important;
                height: auto !important;
                max-width: 146px !important;
            }

            #layout-row9218 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row9222 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row9223 img {
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

        @media only screen and (max-width: 414px) {
            #layout-row9207 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row9208 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9210 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9212 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9217 img {
                width: 100% !important;
                height: auto !important;
                max-width: 146px !important;
            }

            #layout-row9218 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row9222 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row9223 img {
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

        @media only screen and (max-width: 667px) {
            #layout-row9207 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row9208 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9210 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9212 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row9217 img {
                width: 100% !important;
                height: auto !important;
                max-width: 146px !important;
            }

            #layout-row9218 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row9222 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row9223 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
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
    </style><!--[if !mso]><!-- webfonts --><!--<![endif]--><!--[if lt mso 12]> <![endif]--></head>
<body id="ac-designer" class="body"
      style="font-family: Arial; line-height: 1.1; margin: 0px; background-color: #ffffff; width: 100%; text-align: center;"
      marginwidth="0" marginheight="0">
<div class="divbody"
     style="margin: 0px; outline: none; padding: 0px; color: #000000; font-family: arial; line-height: 1.1; width: 100%; background-color: #ffffff; background: #ffffff; text-align: center;">
    <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="100%" align="left"
           style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; background: #ffffff;">
        <tbody>
        <tr>
            <td align="center" valign="top" width="100%">
                <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#ffffff"
                       style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px;">
                    <tbody>
                    <tr>
                        <td id="layout_table_0e3df8ecd848854429143d74fdc9ebe8d764b376" valign="top" align="center"
                            width="600" style="background-color: #ffffff;">
                            <table cellpadding="0" cellspacing="0" border="0" class="layout layout-table root-table"
                                   width="600"
                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                <tbody>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin9208" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9208" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding9208" valign="top">
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
                                    <td id="layout-row-margin9207" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9207" class="layout layout-row widget _widget_picture "
                                                align="center">
                                                <td id="layout-row-padding9207" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><img
                                                                        src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_Donation_Header.jpg'; ?>"
                                                                        alt="We thank you." width="600"
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
                                    <td id="layout-row-margin9225" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9225" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding9225" valign="top">
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
                                <tr id="layout-row9211" class="layout layout-row clear-this "
                                    style="background-color: #ffffff;">
                                    <td id="layout-row-padding9211" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr>
                                                <td id="layout_table_4ce9cc8cdd3432e01428973ef562544069da154c"
                                                    valign="top" width="25">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="25"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin9210" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row9210"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding9210" valign="top">
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
                                                                                                        width="25">
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
                                                <td id="layout_table_21d25bbaa259e5131666a5eaff29f61c4d234bf8"
                                                    valign="top" width="550" style="">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="550"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr style="">
                                                            <td id="layout-row-margin9209" valign="top"
                                                                style="padding: 0;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row9209"
                                                                        class="layout layout-row widget _widget_text style9209"
                                                                        style="margin: 0; padding: 0;">
                                                                        <td id="layout-row-padding9209" valign="top"
                                                                            style="padding: 0 15px 10px 15px;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="text_div8205"
                                                                                        class="td_text td_block"
                                                                                        valign="top" align="left"
                                                                                        style="line-height: 150%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.5; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                        <div style="line-height: 150%; margin: 0; outline: none; padding: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 1.5;"
                                                                                             class=""
                                                                                             data-line-height="1.5">
                                                                                            <div style="margin: 0; outline: none; padding: 0;"
                                                                                                 class=""><span
                                                                                                        style="color: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; font-family: arial, helvetica, sans;"
                                                                                                        class=""><br
                                                                                                            class=""><span
                                                                                                            style="color: #000000; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                            class="">Thank you for your support and participation in the Cat’s Pride Litter for Good program. It's shelters like yours that inspire us every single day! <br
                                                                                                                class=""><br
                                                                                                                class=""></span><span
                                                                                                            style="color: #000000; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                            class="">Your shelter has been nominated by supporters to receive litter donations! We have reviewed the number of Litter for Good nominations and the Cat’s Pride jug sales, and you are eligible to receive coupons for free non-clumping litter.<br
                                                                                                                class=""><br
                                                                                                                class="">Based on your nominations, the litter donation would be less than a pallet, so sending coupons is more economical for you (no shipping cost) and more environmentally friendly — by putting fewer trucks on the road.</span><br
                                                                                                            class=""><br
                                                                                                            class=""><span
                                                                                                            style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                            class="">If you could please <a
                                                                                                                href="<?php echo $edit_shelter_url; ?>"
                                                                                                                style="margin: 0; outline: none; padding: 0; color: #0b3861; text-decoration: underline;"
                                                                                                                class=""
                                                                                                                target="_blank"><span
                                                                                                                    style="color: #0b3861; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                                    class="">fill out this quick form</span></a> with your shipping</span><span
                                                                                                            style="color: #000000; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                            class=""> </span><span
                                                                                                            style="color: #000000; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                            class=""><span
                                                                                                                style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                                class="">address</span>, our team </span>will then mail coarse (non-clumping) litter coupons based on the number of nominations you received. <br
                                                                                                            class=""><br
                                                                                                            class="">Feel free to also check out our <span
                                                                                                            style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                            class=""><a
                                                                                                                href="https://catspride.com/store-locator/"
                                                                                                                style="margin: 0; outline: none; padding: 0; color: #0b3861; text-decoration: underline;"
                                                                                                                target="_blank"
                                                                                                                class=""><span
                                                                                                                    class=""
                                                                                                                    style="color: #0b3861; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;">store locator</span></a> </span>to find a store in your area to pick up your Cat’s Pride non-clumping litter and redeem your free coupons.<br
                                                                                                            class=""><span
                                                                                                            style="color: #000000; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: inherit;"
                                                                                                            class=""><br
                                                                                                                class="">If you have any questions at all, please call our program manager at 312-706-3121. </span><span
                                                                                                            style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                            class=""><br
                                                                                                                class=""><br
                                                                                                                class=""></span></span><br
                                                                                                        class=""
                                                                                                        style="font-family: arial, helvetica, sans;">
                                                                                                <div style="margin: 0; outline: none; padding: 0; text-align: center;"
                                                                                                     class=""><span
                                                                                                            style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit; text-align: inherit; font-family: arial, helvetica, sans;"
                                                                                                            class="">Thank you for helping us change litter for good!</span>
                                                                                                </div>
                                                                                                <br class=""></div>
                                                                                        </div>
                                                                                        <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                        <style data-ac-keep="true"
                                                                                               data-ac-inline="false"> #text_div8205, #text_div8205 div {
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
                                                <td id="layout_table_e440f70904b039fcd9e405fe0fc71e936b8a9cc6"
                                                    valign="top" width="25">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="25"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin9212" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row9212"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding9212" valign="top">
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
                                                                                                        width="25">
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
                                    <td id="layout-row-margin9217" valign="top"
                                        style="padding: 0; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row9217"
                                                class="layout layout-row widget _widget_picture style9217"
                                                align="center" style="">
                                                <td id="layout-row-padding9217" valign="top"
                                                    style="padding: 0px 0 0 0;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><a
                                                                        href="https://catspride.com/litterforgood/"
                                                                        style="margin: 0; outline: none; padding: 0; color: #ffffff; display: block; min-width: 100%;"><img
                                                                            src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/LearnMore-Blue.png'; ?>"
                                                                            alt="Learn More" width="146"
                                                                            style="border: none; display: block; outline: none; width: 146px; opacity: 1; max-width: 100%;"></a>
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
                                    <td id="layout-row-margin9214" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9214" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding9214" valign="top">
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin9219" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row9219"
                                                class="layout layout-row widget _widget_text style9219"
                                                style="margin: 0; padding: 0; background-color: #6abf4b;">
                                                <td id="layout-row-padding9219" valign="top"
                                                    style="background-color: #6abf4b; padding: 30px 30px 20px 30px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div8214" class="td_text td_block" valign="top"
                                                                align="left"
                                                                style="line-height: 100%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                <div style="line-height: 100%; margin: 0; outline: none; padding: 0; mso-line-height-rule: exactly; line-height: 1;"
                                                                     data-line-height="1">
                                                                    <div style="margin: 0; outline: none; padding: 0; font-size: 20px;">
                                                                        <div style="margin: 0; outline: none; padding: 0; text-align: center;">
                                                                            <span style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                  class=""><span
                                                                                        style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                        class=""><b
                                                                                            style="margin: 0; outline: none; padding: 0;"
                                                                                            class="">Increase your nominations and more litter will be donated. </b> </span><br
                                                                                        style="color: #ffffff;"></span><span
                                                                                    style="color: inherit; font-size: 14px; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                    class=""><span
                                                                                        style="color: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: center;"><span
                                                                                            style="color: #ffffff; font-size: 14px; font-weight: inherit; line-height: inherit; text-decoration: inherit; font-family: arial;"><br> Make the most of your registration by sharing the program and asking your supporters to nominate you on <span
                                                                                                style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">catspride.com,</span> if they have not already. <br><br> Simply download free resources via the button below to help get the word out. Tell your supporters about the </span><a
                                                                                            href="http://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a16a010e0d2f2add512f6630dcd43ad5&amp;i=183A222A7A1744"
                                                                                            target="_blank"
                                                                                            data-ac-default-color="1"
                                                                                            style="margin: 0; outline: none; padding: 0; color: #ffffff; text-decoration: underline;"><b
                                                                                                style="margin: 0; outline: none; padding: 0; color: ;"><span
                                                                                                    style="color: #ffffff; font-size: 14px; font-weight: inherit; line-height: inherit; text-decoration: inherit; font-family: arial;"
                                                                                                    class="">Litter for Good program</span></b></a><span
                                                                                            style="color: inherit; font-size: 14px; font-weight: inherit; line-height: inherit; text-decoration: inherit; font-family: arial;"><span
                                                                                                style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                class=""> </span><span
                                                                                                style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;">by placing the image and message resources in your emails, social channels and website to get more nominations, and be eligible to receive more litter into the future.</span></span></span><br
                                                                                        style="color: #ffffff;"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                <style data-ac-keep="true"
                                                                       data-ac-inline="false"> #text_div8214, #text_div8214 div {
                                                                    line-height: 100% !important;
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin9222" valign="top"
                                        style="padding: 0; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row9222"
                                                class="layout layout-row widget _widget_picture style9222" align="left"
                                                style="background-color: #6abf4b;">
                                                <td id="layout-row-padding9222" valign="top"
                                                    style="background-color: #6abf4b; padding: 0 0 0px 0;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="left" valign="top" width="600">
                                                                <a href="/member-dashboard/shelter-resources/"
                                                                   style="margin: 0; outline: none; padding: 0; color: #ffffff; display: block; min-width: 100%;"><img
                                                                            src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/DownloadHere-Blue.png'; ?>"
                                                                            alt="Download Here" width="170"
                                                                            style="border: none; margin:0 auto; display: block; outline: none; width: 170px; opacity: 1; max-width: 100%;"></a>
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
                                    <td id="layout-row-margin9224" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row9224"
                                                class="layout layout-row widget _widget_text style9224"
                                                style="margin: 0; padding: 0; background-color: #6abf4b;">
                                                <td id="layout-row-padding9224" valign="top"
                                                    style="background-color: #6abf4b; padding: 15px 0px 30px 0px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div8219" class="td_text td_block" valign="top"
                                                                align="center">
                                                                <div>
                                                                    <div>
                                                                        <span
                                                                              class=""><span
                                                                                    style="color: #ffffff; font-size: inherit; font-weight: 400; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: italic;">~20 MB Download (</span><span
                                                                                    style="color: #ffffff; font-size: inherit; font-weight: 400; line-height: inherit; text-decoration: inherit; font-style: normal; font-family: arial;">Cat's Pride Shelter Assets.zip</span><span
                                                                                    style="color: #ffffff; font-size: inherit; font-weight: 400; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: italic;">)</span></span><br
                                                                                style="color: #ffffff;"></div>
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
                                    <td id="layout-row-margin9220" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9220" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding9220" valign="top">
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin9218" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9218" class="layout layout-row widget _widget_picture "
                                                align="center">
                                                <td id="layout-row-padding9218" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><a
                                                                        href="https://catspride.com/litterforgood/?utm_source=ActiveCampaign&amp;utm_medium=email&amp;utm_content=Your+response+is+needed%3A+Get+your+donated+cat+litter&amp;utm_campaign=Your+Response+is+Needed%3A+Litter+Donation+Coordination+Email"
                                                                        style="margin: 0; outline: none; padding: 0; color: #ffffff; display: block; min-width: 100%;"><img
                                                                            src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_ProfileCompletion_Jugs-noGrayBar.png'; ?>"
                                                                            alt="Look for the Green Jug" width="386"
                                                                            style="border: none; display: block; outline: none; width: 600px; opacity: 1; max-width: 100%;"></a>
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
                                    <td id="layout-row-margin9221" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9221" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding9221" valign="top">
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin9223" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row9223" class="layout layout-row widget _widget_picture "
                                                align="left">
                                                <td id="layout-row-padding9223" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="left" valign="top" width="600">
                                                                <img src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_LogoBar.jpg'; ?>"
                                                                     alt="" width="600"
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
                                    <td id="layout-row-margin9216" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row9216"
                                                class="layout layout-row widget _widget_html style9216" style="">
                                                <td id="layout-row-padding9216" valign="top" style="padding: 0px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="html_div8211" width="600" align="left">
                                                                <table width="600" border="0" cellspacing="0"
                                                                       cellpadding="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td bgcolor="#F7F7F9"
                                                                            style="text-align: center"><a
                                                                                    href="http://catspride.com/"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #ffffff; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/footer_websitebutton.png?r=644622158"
                                                                                        width="74" height="17"
                                                                                        alt="catspride.com"
                                                                                        style="border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://facebook.com/catspride/"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #ffffff; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-facebook.png?r=62755498"
                                                                                        width="17" height="17"
                                                                                        alt="Facebook"
                                                                                        style="border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://twitter.com/@catspride"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #ffffff; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-twitter.png?r=2097560124"
                                                                                        width="17" height="17"
                                                                                        alt="Twitter"
                                                                                        style="border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://instagram.com/catspride/"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #ffffff; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-instagram.png?r=281172111"
                                                                                        width="17" height="17"
                                                                                        alt="Instagram"
                                                                                        style="border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://youtube.com/user/catspride"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #ffffff; display: inline-block;"><img
                                                                                        src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-youtube.png?r=2122732911"
                                                                                        width="24" height="17"
                                                                                        alt="YouTube"
                                                                                        style="border: none;"></a></td>
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
                                                                            <a href="mailto:litterforgood@catspride.com"
                                                                               style="margin: 0; outline: none; padding: 0; color: #2F408E; text-decoration: none;">litterforgood@catspride.com</a>
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
                                                                                                 alt="Oil-Dri"></p></td>
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
                                    <td id="layout-row-margin9215" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row9215"
                                                class="layout layout-row widget _widget_text style9215"
                                                style="margin: 0; padding: 0; background-color: #6abf4b;">
                                                <td id="layout-row-padding9215" valign="top"
                                                    style="background-color: #6abf4b; padding: 17px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div8210" class="td_text td_block" valign="top"
                                                                align="left"
                                                                style="color: inherit; font-size: 12px; font-weight: inherit; line-height: 1; text-decoration: inherit; font-family: Arial;">
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
                    <tr>
                        <td align="center">
                            <div style="margin: 0; outline: none; padding: 0; width: 100%;"><br clear="all">
                                <div align="center"
                                     style="margin: 5px 0 0 0; outline: none; padding: 10px 10px 0 10px; border-top: 1px solid #333333; background: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; clear: both;">
                                    Sent to: <?php echo $recipient; ?>
                                    <br><br><br><br>
                                    <span class="perstag_address">
                                        <?php echo $address; ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <div style="margin: 0; outline: none; padding: 0; width: 100%;"><br clear="all">
                                <div align="center"
                                     style="margin: 0; outline: none; background: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 11px; clear: both;">
                                    <br><br>
                                    <a style="color:#000000;text-decoration:underline;" href="%tag_unsubscribe_url%"
                                       target="_blank">Unsubscribe</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>