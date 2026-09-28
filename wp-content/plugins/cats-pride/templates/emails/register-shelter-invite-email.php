<?php
/**
 * Register shelter invite email
 */

if ( ! defined( 'ABSPATH' ) && !isset($_GET['test']) ) {
    exit; // Exit if accessed directly
}

$domain_url       = (function_exists( 'home_url' )) ? trim( home_url(), '/') : $_SERVER['REQUEST_SCHEME'] . '://' .$_SERVER['SERVER_NAME'];
$registration_url = (!isset( $registration_url ) && !function_exists( 'esc_url' ) ) ? '#' : esc_url( $registration_url );
$recipient        = (!isset( $recipient )) ? 'Testing' : $recipient;
$address          = (!isset( $address )) ? '123 Testing Lane' : $address;

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
    <title>Cat's Pride</title>
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
    #layout-row3169 img {
    width: 100% !important;
    height: auto !important;
            max-width: 600px !important;
        }

        #layout-row3171 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3173 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3175 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3182 img {
            width: 100% !important;
            height: auto !important;
            max-width: 600px !important;
        }

        #layout-row3185 img {
            width: 100% !important;
            height: auto !important;
            max-width: 600px !important;
        }

        #layout-row3186 img {
            width: 100% !important;
            height: auto !important;
            max-width: auto !important;
        }

        #layout-row3187 img {
            width: 100% !important;
            height: auto !important;
            max-width: 60px !important;
        }

        #layout-row3193 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3196 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3198 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3201 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3203 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3205 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3207 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3208 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3210 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3211 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3212 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
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
    #layout-row3169 img {
    width: 100% !important;
    height: auto !important;
            max-width: 414px !important;
        }

        #layout-row3171 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3173 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3175 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3182 img {
            width: 100% !important;
            height: auto !important;
            max-width: 414px !important;
        }

        #layout-row3185 img {
            width: 100% !important;
            height: auto !important;
            max-width: 414px !important;
        }

        #layout-row3186 img {
            width: 100% !important;
            height: auto !important;
            max-width: auto !important;
        }

        #layout-row3187 img {
            width: 100% !important;
            height: auto !important;
            max-width: 60px !important;
        }

        #layout-row3193 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3196 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3198 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3201 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3203 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3205 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3207 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3208 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3210 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3211 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3212 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
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
    #layout-row3169 img {
    width: 100% !important;
    height: auto !important;
            max-width: 375px !important;
        }

        #layout-row3171 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3173 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3175 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3182 img {
            width: 100% !important;
            height: auto !important;
            max-width: 375px !important;
        }

        #layout-row3185 img {
            width: 100% !important;
            height: auto !important;
            max-width: 375px !important;
        }

        #layout-row3186 img {
            width: 100% !important;
            height: auto !important;
            max-width: auto !important;
        }

        #layout-row3187 img {
            width: 100% !important;
            height: auto !important;
            max-width: 60px !important;
        }

        #layout-row3193 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3196 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3198 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3201 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3203 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3205 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3207 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3208 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3210 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3211 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3212 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
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
    #layout-row3169 img {
    width: 100% !important;
    height: auto !important;
            max-width: 375px !important;
        }

        #layout-row3171 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3173 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3175 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3182 img {
            width: 100% !important;
            height: auto !important;
            max-width: 375px !important;
        }

        #layout-row3185 img {
            width: 100% !important;
            height: auto !important;
            max-width: 375px !important;
        }

        #layout-row3186 img {
            width: 100% !important;
            height: auto !important;
            max-width: auto !important;
        }

        #layout-row3187 img {
            width: 100% !important;
            height: auto !important;
            max-width: 60px !important;
        }

        #layout-row3193 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3196 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3198 img {
            width: 100% !important;
            height: auto !important;
            max-width: 75px !important;
        }

        #layout-row3201 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3203 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3205 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3207 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3208 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
        }

        #layout-row3210 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3211 img {
            width: 100% !important;
            height: auto !important;
            max-width: 136px !important;
        }

        #layout-row3212 {
            max-height: 0px !important;
            font-size: 0px !important;
            display: none !important;
            visibility: hidden !important;
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
      style="font-family: Arial; line-height: 1.1; margin: 0px; background-color: #FFFFFF; width: 100%; text-align: center;"
      marginwidth="0" marginheight="0">
<div class="divbody"
     style="margin: 0px; outline: none; padding: 0px; color: #000000; font-family: arial; line-height: 1.1; overflow: auto; width: 100%; background-color: #FFFFFF; background: #FFFFFF; text-align: center;">
    <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="100%" align="left"
           style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; background: #FFFFFF;">
        <tbody>
        <tr>
            <td align="center" valign="top" width="100%">
                <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#FFFFFF"
                       style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px;">
                    <tbody>
                    <tr>
                        <td id="layout_table_b2141cfa5a96018ce6e1cadcb903b608a522d8f1" valign="top" align="center"
                            width="600" style="background-color: #ffffff;">
                            <table cellpadding="0" cellspacing="0" border="0" class="layout layout-table root-table"
                                   width="600"
                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                <tbody>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3171" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3171" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3171" valign="top">
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
                                    <td id="layout-row-margin3169" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3169" class="layout layout-row widget _widget_picture "
                                                align="center">
                                                <td id="layout-row-padding3169" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><img
                                                                    src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_Congratulations_Header.png'; ?>"
                                                                    alt="Congratulations!" width="600"
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
                                    <td id="layout-row-margin3170" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3170" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3170" valign="top">
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
                                <tr id="layout-row3174" class="layout layout-row clear-this "
                                    style="background-color: #ffffff;">
                                    <td id="layout-row-padding3174" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr>
                                                <td id="layout_table_8ed3cc1bdd5a991e5beb392fdc98fc8a33db7067"
                                                    valign="top" width="50">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="50"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin3173" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row3173"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding3173" valign="top">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="top" height="50">
                                                                                        <div class="spacer"
                                                                                             style="margin: 0; outline: none; padding: 0; height: 50px;">
                                                                                            <table cellpadding="0"
                                                                                                   cellspacing="0"
                                                                                                   border="0"
                                                                                                   width="100%"
                                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="spacer-body"
                                                                                                        valign="top"
                                                                                                        height="50"
                                                                                                        width="50">
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
                                                <td id="layout_table_018c25887038b256fc1a3acf62e90aa9e2125247"
                                                    valign="top" width="500" style="">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="500"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr style="">
                                                            <td id="layout-row-margin3172" valign="top"
                                                                style="padding: 0;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row3172"
                                                                        class="layout layout-row widget _widget_text style3172"
                                                                        style="margin: 0; padding: 0;">
                                                                        <td id="layout-row-padding3172" valign="top"
                                                                            style="padding: 0 10px 10px 10px;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="text_div2745"
                                                                                        class="td_text td_block"
                                                                                        valign="top" align="left"
                                                                                        style="line-height: 150%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.5; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                        <div style="line-height: 150%; margin: 0; outline: none; padding: 0; text-align: center; mso-line-height-rule: exactly; line-height: 1.5;"
                                                                                             data-line-height="1.5">
                                                                                            <span style="color: #666666; font-size: 14px; font-weight: bold; line-height: inherit; text-decoration: inherit; font-style: normal; font-family: arial, helvetica, sans;"
                                                                                                  class="">Your shelter has been nominated by supporters to participate in our Litter for Good program, where we're donating litter to animal welfare organizations like yours across America! To participate, just follow the simple steps below.</span><br>
                                                                                        </div>
                                                                                        <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                        <style data-ac-keep="true"
                                                                                               data-ac-inline="false"> #text_div2745, #text_div2745 div {
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
                                                        <tr style="">
                                                            <td id="layout-row-margin3176" valign="top" style="">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row3176"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding3176" valign="top">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="top" height="30">
                                                                                        <div class="spacer"
                                                                                             style="margin: 0; outline: none; padding: 0; height: 30px;">
                                                                                            <table cellpadding="0"
                                                                                                   cellspacing="0"
                                                                                                   border="0"
                                                                                                   width="100%"
                                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="spacer-body"
                                                                                                        valign="top"
                                                                                                        height="30"
                                                                                                        width="500">
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
                                                <td id="layout_table_a54237ad75eea963aec5ce4b57de3d777b04dbf0"
                                                    valign="top" width="50">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="50"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="layout-row-margin3175" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr id="layout-row3175"
                                                                        class="layout layout-row widget _widget_spacer ">
                                                                        <td id="layout-row-padding3175" valign="top">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="top" height="50">
                                                                                        <div class="spacer"
                                                                                             style="margin: 0; outline: none; padding: 0; height: 50px;">
                                                                                            <table cellpadding="0"
                                                                                                   cellspacing="0"
                                                                                                   border="0"
                                                                                                   width="100%"
                                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="spacer-body"
                                                                                                        valign="top"
                                                                                                        height="50"
                                                                                                        width="50">
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
                                <tr id="layout-row3189" class="layout layout-row clear-this "
                                    style="background-color: #ffffff;">
                                    <td id="layout-row-padding3189" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr>
                                                <td id="layout_table_86e64ac22bfa04534be3fc7c378f92cc832a1860"
                                                    valign="top" width="225">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="225"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr id="layout-row3202" class="layout layout-row clear-this ">
                                                            <td id="layout-row-padding3202" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="layout_table_197e535f93f0ef91cd2ce93d4f9ce7c36fd4c9bb"
                                                                            valign="top" width="50"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="50"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3201"
                                                                                        valign="top"
                                                                                        style="background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3201"
                                                                                                class="layout layout-row widget _widget_spacer ">
                                                                                                <td id="layout-row-padding3201"
                                                                                                    valign="top">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top"
                                                                                                                height="77">
                                                                                                                <div class="spacer"
                                                                                                                     style="margin: 0; outline: none; padding: 0; height: 77px;">
                                                                                                                    <table cellpadding="0"
                                                                                                                           cellspacing="0"
                                                                                                                           border="0"
                                                                                                                           width="100%"
                                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td class="spacer-body"
                                                                                                                                valign="top"
                                                                                                                                height="77"
                                                                                                                                width="50">
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
                                                                        <td id="layout_table_e464bf7ab46136057e6fa8b4e8b86c0debdb73d7"
                                                                            valign="top" width="175"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="175"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3187"
                                                                                        valign="top"
                                                                                        style="background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3187"
                                                                                                class="layout layout-row widget _widget_picture "
                                                                                                align="center">
                                                                                                <td id="layout-row-padding3187"
                                                                                                    valign="top">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td class="image-td"
                                                                                                                align="center"
                                                                                                                valign="top"
                                                                                                                width="175">
                                                                                                                <img src="https://catspride.img-us10.com/public/922e2e37f2caa6d1dd7aa2d35174c12d.png?r=931473134"
                                                                                                                     alt="Step 1"
                                                                                                                     width="39"
                                                                                                                     style="display: block; border: none; outline: none; width: 39px; opacity: 1; max-width: 100%;">
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td id="layout_table_6739838585f979b57cd8863d7a5fe194493e53dd"
                                                    valign="top" width="375" style="background-color: #ffffff;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="375"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                        <tbody>
                                                        <tr style="background-color: #ffffff;">
                                                            <td id="layout-row-margin3188" valign="top"
                                                                style="padding: 0px; background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row3188"
                                                                        class="layout layout-row widget _widget_text style3188"
                                                                        style="margin: 0; padding: 0;">
                                                                        <td id="layout-row-padding3188" valign="top"
                                                                            style="padding: 0px 15px 0px 15px;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="text_div2760"
                                                                                        class="td_text td_block"
                                                                                        valign="top" align="left"
                                                                                        style="line-height: 170%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.7; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                        <div style="line-height: 170%; margin: 0; outline: none; padding: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 1.7;"
                                                                                             data-line-height="1.7">
                                                                                            <div style="margin: 0; outline: none; padding: 0; color: #666666;">
                                                                                                <span style="color: #666666; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                      class="">Click the link below to register your shelter to receive donated litter.<br></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                        <style data-ac-keep="true"
                                                                                               data-ac-inline="false"> #text_div2760, #text_div2760 div {
                                                                                            line-height: 170% !important;
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
                                                        <tr id="layout-row3214" class="layout layout-row clear-this "
                                                            style="background-color: #ffffff;">
                                                            <td id="layout-row-padding3214" valign="top"
                                                                style="background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="layout_table_04bea38560bb82f689bcb06d2a64485d07c1eab3"
                                                                            valign="top" width="187"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="187"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3213"
                                                                                        valign="top"
                                                                                        style="padding: 0px; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3213"
                                                                                                class="layout layout-row widget _widget_html style3213"
                                                                                                style="">
                                                                                                <td id="layout-row-padding3213"
                                                                                                    valign="top"
                                                                                                    style="padding: 5px;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td id="html_div2778"
                                                                                                                width="177"
                                                                                                                align="left">
                                                                                                                <table style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td style="width: 178px; text-align: center;">
                                                                                                                            <a href="<?php echo $registration_url; ?>"
                                                                                                                               style="margin: 0 auto; outline: none; padding: 0; color: #045FB4; display: inline-block;"
                                                                                                                               title="Enroll"><img
                                                                                                                                    src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/Enroll-Blue.png'; ?>"
                                                                                                                                    alt="Enroll Button"
                                                                                                                                    style="display: block; border: none; width:140px;"></a>
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
                                                                        <td id="layout_table_c70c391ba72c16f759e71d83592c0aa6e62e3def"
                                                                            valign="top" width="188"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="188"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3212"
                                                                                        valign="top"
                                                                                        style="padding: 0; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3212"
                                                                                                class="layout layout-row widget _widget_spacer style3212"
                                                                                                style="">
                                                                                                <td id="layout-row-padding3212"
                                                                                                    valign="top"
                                                                                                    style="padding: 0;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top"
                                                                                                                height="54">
                                                                                                                <div class="spacer"
                                                                                                                     style="margin: 0; outline: none; padding: 0; height: 54px;">
                                                                                                                    <table cellpadding="0"
                                                                                                                           cellspacing="0"
                                                                                                                           border="0"
                                                                                                                           width="100%"
                                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td class="spacer-body"
                                                                                                                                valign="top"
                                                                                                                                height="54"
                                                                                                                                width="188"
                                                                                                                                style="background-color: #ffffff;">
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3190" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3190" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3190" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="15">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 15px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="15" width="600">&nbsp;
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
                                    <td id="layout-row-margin3191" valign="top"
                                        style="padding: 0; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3191"
                                                class="layout layout-row widget _widget_spacer style3191" style="">
                                                <td id="layout-row-padding3191" valign="top" style="padding: 0;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="15">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 15px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="15" width="600"
                                                                                style="background-color: #f7f7f8;">
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
                                <tr id="layout-row3195" class="layout layout-row clear-this "
                                    style="background-color: #ffffff;">
                                    <td id="layout-row-padding3195" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr>
                                                <td id="layout_table_a2c9e97ff4d4b3114f12bf6bcedf67b309136013"
                                                    valign="top" width="225" style="background-color: #ffffff;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="225"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                        <tbody>
                                                        <tr id="layout-row3204" class="layout layout-row clear-this "
                                                            style="background-color: #ffffff;">
                                                            <td id="layout-row-padding3204" valign="top"
                                                                style="background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="layout_table_c6a6997cf9cc855796667bd5a0eb53a936e638ec"
                                                                            valign="top" width="50"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="50"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3203"
                                                                                        valign="top"
                                                                                        style="padding: 0; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3203"
                                                                                                class="layout layout-row widget _widget_spacer style3203"
                                                                                                style="">
                                                                                                <td id="layout-row-padding3203"
                                                                                                    valign="top"
                                                                                                    style="padding: 0;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top"
                                                                                                                height="50">
                                                                                                                <div class="spacer"
                                                                                                                     style="margin: 0; outline: none; padding: 0; height: 50px;">
                                                                                                                    <table cellpadding="0"
                                                                                                                           cellspacing="0"
                                                                                                                           border="0"
                                                                                                                           width="100%"
                                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td class="spacer-body"
                                                                                                                                valign="top"
                                                                                                                                height="50"
                                                                                                                                width="50"
                                                                                                                                style="background-color: #f7f7f8;">
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
                                                                        <td id="layout_table_a1495bf5408cc084b7751e8b78e4b827d6b6b5ba"
                                                                            valign="top" width="175"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="175"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3193"
                                                                                        valign="top"
                                                                                        style="padding: 0; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3193"
                                                                                                class="layout layout-row widget _widget_picture style3193"
                                                                                                align="center"
                                                                                                style="background-color: #f7f7f8;">
                                                                                                <td id="layout-row-padding3193"
                                                                                                    valign="top"
                                                                                                    style="background-color: #f7f7f8; padding: 0;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td class="image-td"
                                                                                                                align="center"
                                                                                                                valign="top"
                                                                                                                width="175">
                                                                                                                <img src="https://catspride.img-us10.com/public/20f812a0a8123b2649cd4dde135eead6.png?r=658505181"
                                                                                                                     alt="Step 2"
                                                                                                                     width="48"
                                                                                                                     style="display: block; border: none; outline: none; width: 48px; opacity: 1; max-width: 100%;">
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
                                                            <td id="layout-row-margin3196" valign="top"
                                                                style="padding: 0; background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row3196"
                                                                        class="layout layout-row widget _widget_spacer style3196"
                                                                        style="">
                                                                        <td id="layout-row-padding3196" valign="top"
                                                                            style="padding: 0;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td valign="top" height="80">
                                                                                        <div class="spacer"
                                                                                             style="margin: 0; outline: none; padding: 0; height: 80px;">
                                                                                            <table cellpadding="0"
                                                                                                   cellspacing="0"
                                                                                                   border="0"
                                                                                                   width="100%"
                                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="spacer-body"
                                                                                                        valign="top"
                                                                                                        height="80"
                                                                                                        width="225"
                                                                                                        style="background-color: #f7f7f8;">
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
                                                <td id="layout_table_7c3a77e171359c48e4f4af09b9b6263b5fca35a7"
                                                    valign="top" width="375" style="background-color: #ffffff;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="375"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                        <tbody>
                                                        <tr style="background-color: #ffffff;">
                                                            <td id="layout-row-margin3194" valign="top"
                                                                style="padding: 0px; background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row3194"
                                                                        class="layout layout-row widget _widget_text style3194"
                                                                        style="margin: 0; padding: 0; background-color: #f7f7f8;">
                                                                        <td id="layout-row-padding3194" valign="top"
                                                                            style="background-color: #f7f7f8; padding: 0px 15px 0px 15px;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="text_div2765"
                                                                                        class="td_text td_block"
                                                                                        valign="top" align="left"
                                                                                        style="line-height: 170%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.7; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                        <div style="line-height: 170%; margin: 0; outline: none; padding: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 1.7;"
                                                                                             data-line-height="1.7">
                                                                                            <div style="margin: 0; outline: none; padding: 0; color: #666666;">
                                                                                                <span style="color: #666666; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                      class="">Download emails and social media posts to share with your supporters. The more nominations for your shelter, the more litter you are eligible to receive.</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                        <style data-ac-keep="true"
                                                                                               data-ac-inline="false"> #text_div2765, #text_div2765 div {
                                                                                            line-height: 170% !important;
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
                                                        <tr id="layout-row3216" class="layout layout-row clear-this "
                                                            style="background-color: #ffffff;">
                                                            <td id="layout-row-padding3216" valign="top"
                                                                style="background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="layout_table_9cc538c3cde00ec2fa6ec5a848eed8d910894374"
                                                                            valign="top" width="187"
                                                                            style="background-color: #f7f7f8;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="187"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3215"
                                                                                        valign="top"
                                                                                        style="padding: 0px; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3215"
                                                                                                class="layout layout-row widget _widget_html style3215"
                                                                                                style="background-color: #f7f7f8;">
                                                                                                <td id="layout-row-padding3215"
                                                                                                    valign="top"
                                                                                                    style="background-color: #f7f7f8; padding: 5px;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td id="html_div2779"
                                                                                                                width="177"
                                                                                                                align="left">
                                                                                                                <table style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                    <tbody>
                                                                                                                    <tr>
                                                                                                                        <td style="width: 178px; text-align: center;">
                                                                                                                            <a href="<?php echo $registration_url; ?>"
                                                                                                                               style="margin: 0 auto; outline: none; padding: 0; color: #045FB4; display: inline-block;"
                                                                                                                               title="Spread the Word"><img
                                                                                                                                    src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/SpreadTheWord-Blue.png'; ?>"
                                                                                                                                    alt="Spread the Word Button"
                                                                                                                                    style="display: block;width:140px; border: none;"></a>
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
                                                                        <td id="layout_table_906c36c620d7153551ef4334fe838783dce38a72"
                                                                            valign="top" width="188"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="188"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3207"
                                                                                        valign="top"
                                                                                        style="padding: 0; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3207"
                                                                                                class="layout layout-row widget _widget_spacer style3207"
                                                                                                style="">
                                                                                                <td id="layout-row-padding3207"
                                                                                                    valign="top"
                                                                                                    style="padding: 0;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top"
                                                                                                                height="61">
                                                                                                                <div class="spacer"
                                                                                                                     style="margin: 0; outline: none; padding: 0; height: 61px;">
                                                                                                                    <table cellpadding="0"
                                                                                                                           cellspacing="0"
                                                                                                                           border="0"
                                                                                                                           width="100%"
                                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td class="spacer-body"
                                                                                                                                valign="top"
                                                                                                                                height="61"
                                                                                                                                width="188"
                                                                                                                                style="background-color: #f7f7f8;">
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3192" valign="top"
                                        style="padding: 0; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3192"
                                                class="layout layout-row widget _widget_spacer style3192" style="">
                                                <td id="layout-row-padding3192" valign="top" style="padding: 0;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="15">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 15px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="15" width="600"
                                                                                style="background-color: #f7f7f8;">
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
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3197" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3197" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3197" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="15">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 15px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="15" width="600">&nbsp;
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
                                <tr id="layout-row3200" class="layout layout-row clear-this "
                                    style="background-color: #ffffff;">
                                    <td id="layout-row-padding3200" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr>
                                                <td id="layout_table_053fad1bef53c5bb33ea7562daec8c4e78c114f6"
                                                    valign="top" width="225">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="225"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr id="layout-row3206" class="layout layout-row clear-this ">
                                                            <td id="layout-row-padding3206" valign="top">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="layout_table_9c5d11ec22576f08ceb4b4561939f43fce07c1f3"
                                                                            valign="top" width="50"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="50"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3205"
                                                                                        valign="top"
                                                                                        style="background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3205"
                                                                                                class="layout layout-row widget _widget_spacer ">
                                                                                                <td id="layout-row-padding3205"
                                                                                                    valign="top">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top"
                                                                                                                height="78">
                                                                                                                <div class="spacer"
                                                                                                                     style="margin: 0; outline: none; padding: 0; height: 78px;">
                                                                                                                    <table cellpadding="0"
                                                                                                                           cellspacing="0"
                                                                                                                           border="0"
                                                                                                                           width="100%"
                                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td class="spacer-body"
                                                                                                                                valign="top"
                                                                                                                                height="78"
                                                                                                                                width="50">
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
                                                                        <td id="layout_table_3c1a029feffd65634ef53e3d66465aa4ce7c8448"
                                                                            valign="top" width="175"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="175"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3198"
                                                                                        valign="top"
                                                                                        style="background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3198"
                                                                                                class="layout layout-row widget _widget_picture "
                                                                                                align="center">
                                                                                                <td id="layout-row-padding3198"
                                                                                                    valign="top">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td class="image-td"
                                                                                                                align="center"
                                                                                                                valign="top"
                                                                                                                width="175">
                                                                                                                <img src="https://catspride.img-us10.com/public/e851673711b715e79d3e532479105276.png?r=785085691"
                                                                                                                     alt="Step 3"
                                                                                                                     width="48"
                                                                                                                     style="display: block; border: none; outline: none; width: 48px; opacity: 1; max-width: 100%;">
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td id="layout_table_9bd60e4fc34a6b03887ee9bb09d1243fe7cfa765"
                                                    valign="top" width="375" style="background-color: #ffffff;">
                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                           class="layout layout-table " width="375"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                        <tbody>
                                                        <tr style="background-color: #ffffff;">
                                                            <td id="layout-row-margin3199" valign="top"
                                                                style="padding: 0px; background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                    <tbody>
                                                                    <tr id="layout-row3199"
                                                                        class="layout layout-row widget _widget_text style3199"
                                                                        style="margin: 0; padding: 0;">
                                                                        <td id="layout-row-padding3199" valign="top"
                                                                            style="padding: 0px 15px 0px 15px;">
                                                                            <table width="100%" border="0"
                                                                                   cellpadding="0" cellspacing="0"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td id="text_div2769"
                                                                                        class="td_text td_block"
                                                                                        valign="top" align="left"
                                                                                        style="line-height: 170%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.7; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                        <div style="line-height: 170%; margin: 0; outline: none; padding: 0; font-size: 14px; mso-line-height-rule: exactly; line-height: 1.7;"
                                                                                             data-line-height="1.7">
                                                                                            <div style="margin: 0; outline: none; padding: 0; color: #666666;">
                                                                                                <span style="color: #666666; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                      class="">Pick up your litter from any Cat's Pride plant or warehouse, or pay for delivery.</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                        <style data-ac-keep="true"
                                                                                               data-ac-inline="false"> #text_div2769, #text_div2769 div {
                                                                                            line-height: 170% !important;
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
                                                        <tr id="layout-row3209" class="layout layout-row clear-this "
                                                            style="background-color: #ffffff;">
                                                            <td id="layout-row-padding3209" valign="top"
                                                                style="background-color: #ffffff;">
                                                                <table width="100%" border="0" cellpadding="0"
                                                                       cellspacing="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="layout_table_a3ae92ed84db0b731bf0fd61b3fcd82d23135ae9"
                                                                            valign="top" width="188"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="188"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3210"
                                                                                        valign="top"
                                                                                        style="padding: 0; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3210"
                                                                                                class="layout layout-row widget _widget_picture style3210"
                                                                                                align="center" style="">
                                                                                                <td id="layout-row-padding3210"
                                                                                                    valign="top"
                                                                                                    style="padding: 10px 0 0 0;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td class="image-td"
                                                                                                                align="center"
                                                                                                                valign="top"
                                                                                                                width="188">
                                                                                                                <a href="https://catspride.com/faq/#contact-us"
                                                                                                                   style="margin: 0; outline: none; padding: 0; color: #045FB4; display: block; min-width: 100%;"><img
                                                                                                                        src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/ContactUs-Blue.png'; ?>"
                                                                                                                        alt="Contact Us"
                                                                                                                        width="140"
                                                                                                                        style="display: block; border: none; outline: none; width: 140px; opacity: 1; max-width: 100%;"></a>
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
                                                                        <td id="layout_table_2be4ddee5eb181cd2aa1edbf6ce9c6f3e4912dad"
                                                                            valign="top" width="187"
                                                                            style="background-color: #ffffff;">
                                                                            <table cellpadding="0" cellspacing="0"
                                                                                   border="0"
                                                                                   class="layout layout-table "
                                                                                   width="187"
                                                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                                                <tbody>
                                                                                <tr style="background-color: #ffffff;">
                                                                                    <td id="layout-row-margin3208"
                                                                                        valign="top"
                                                                                        style="padding: 0; background-color: #ffffff;">
                                                                                        <table width="100%" border="0"
                                                                                               cellpadding="0"
                                                                                               cellspacing="0"
                                                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                                            <tbody>
                                                                                            <tr id="layout-row3208"
                                                                                                class="layout layout-row widget _widget_spacer style3208"
                                                                                                style="">
                                                                                                <td id="layout-row-padding3208"
                                                                                                    valign="top"
                                                                                                    style="padding: 0;">
                                                                                                    <table width="100%"
                                                                                                           border="0"
                                                                                                           cellpadding="0"
                                                                                                           cellspacing="0"
                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                        <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="top"
                                                                                                                height="54">
                                                                                                                <div class="spacer"
                                                                                                                     style="margin: 0; outline: none; padding: 0; height: 54px;">
                                                                                                                    <table cellpadding="0"
                                                                                                                           cellspacing="0"
                                                                                                                           border="0"
                                                                                                                           width="100%"
                                                                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                                        <tbody>
                                                                                                                        <tr>
                                                                                                                            <td class="spacer-body"
                                                                                                                                valign="top"
                                                                                                                                height="54"
                                                                                                                                width="187"
                                                                                                                                style="background-color: #ffffff;">
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
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3177" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3177" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3177" valign="top">
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
                                    <td id="layout-row-margin3183" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3183"
                                                class="layout layout-row widget _widget_text style3183"
                                                style="margin: 0; padding: 0; background-color: #1360ab;">
                                                <td id="layout-row-padding3183" valign="top"
                                                    style="background-color: #1360ab; padding: 40px 10px 20px 10px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div2755" class="td_text td_block" valign="top"
                                                                align="left"
                                                                style="color: inherit; font-size: 12px; font-weight: inherit; line-height: 1; text-decoration: inherit; font-family: Arial;">
                                                                <div style="margin: 0; outline: none; padding: 0; color: #ffffff; font-size: 20px;">
                                                                    <div style="margin: 0; outline: none; padding: 0; text-align: center; color: #ffffff;">
                                                                        <span style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                              class=""><span
                                                                                style="color: inherit; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                class="">Donated litter for shelters.</span> It's not a promotion. <br>It's a commitment.</span>
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
                                    </td>
                                </tr>
                                <tr style="background-color: #ffffff;">
                                    <td id="layout-row-margin3184" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3184"
                                                class="layout layout-row widget _widget_text style3184"
                                                style="margin: 0; padding: 0; background-color: #1360ab;">
                                                <td id="layout-row-padding3184" valign="top"
                                                    style="background-color: #1360ab; padding: 20px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div2756" class="td_text td_block" valign="top"
                                                                align="left"
                                                                style="line-height: 171%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.71; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                <div style="line-height: 171%; margin: 0; outline: none; padding: 0; font-size: 15px; mso-line-height-rule: exactly; line-height: 1.71;"
                                                                     data-line-height="1.71">
                                                                    <div style="margin: 0; outline: none; padding: 0; color: #ffffff;">
                                                                        <div style="margin: 0; outline: none; padding: 0; text-align: center; color: #ffffff;">
                                                                            <span style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                  class=""> Every jug of Cat’s Pride litter sold means more litter donated to shelters across America to help more cats find their forever homes.<br><br><b
                                                                                    style="margin: 0; outline: none; padding: 0;">Click below to learn more about the Cat's Pride Litter for Good program!</b> </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                <style data-ac-keep="true"
                                                                       data-ac-inline="false"> #text_div2756, #text_div2756 div {
                                                                    line-height: 171% !important;
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
                                    <td id="layout-row-margin3211" valign="top"
                                        style="padding: 0; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3211"
                                                class="layout layout-row widget _widget_picture style3211"
                                                align="center" style="background-color: #1360ab;">
                                                <td id="layout-row-padding3211" valign="top"
                                                    style="background-color: #1360ab; padding: 10px 0 0 0;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><a
                                                                    href="https://catspride.com/litterforgood/"
                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: block; min-width: 100%;"><img
                                                                    src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/LearnMore-Green.png'; ?>"
                                                                    alt="Learn More" width="140"
                                                                    style="display: block; border: none; outline: none; width: 140px; opacity: 1; max-width: 100%;"></a>
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
                                    <td id="layout-row-margin3185" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3185" class="layout layout-row widget _widget_picture "
                                                align="left">
                                                <td id="layout-row-padding3185" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="left" valign="top" width="600">
                                                                <img src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_MG_ShelterNomination_Dan.jpg'; ?>"
                                                                     alt="Dan Jaffee, President of Cat's Pride" width="600"
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
                                    <td id="layout-row-margin3178" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3178" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3178" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td valign="top" height="40">
                                                                <div class="spacer"
                                                                     style="margin: 0; outline: none; padding: 0; height: 40px;">
                                                                    <table cellpadding="0" cellspacing="0" border="0"
                                                                           width="100%"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="spacer-body" valign="top"
                                                                                height="40" width="600">&nbsp;
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
                                    <td id="layout-row-margin3186" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3186" class="layout layout-row widget _widget_picture "
                                                align="center">
                                                <td id="layout-row-padding3186" valign="top">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td class="image-td" align="center" valign="top"
                                                                width="600"><img
                                                                    src="<?php echo $domain_url . '/wp-content/plugins/cats-pride/assets/images/OD-CP-400_AC_ProfileCompletion_Jugs-noGrayBar.png'; ?>"
                                                                    alt="Every jug sold helps shelter cats find forever homes."
                                                                    style="display: block; border: none; outline: none; opacity: 1; max-width: 100%;">
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
                                    <td id="layout-row-margin3180" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3180" class="layout layout-row widget _widget_spacer ">
                                                <td id="layout-row-padding3180" valign="top">
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
                                    <td id="layout-row-margin3182" valign="top" style="background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                            <tbody>
                                            <tr id="layout-row3182" class="layout layout-row widget _widget_picture "
                                                align="left">
                                                <td id="layout-row-padding3182" valign="top">
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
                                    <td id="layout-row-margin3179" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3179"
                                                class="layout layout-row widget _widget_html style3179" style="">
                                                <td id="layout-row-padding3179" valign="top" style="padding: 0px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="html_div2751" width="600" align="left">
                                                                <table width="600" border="0" cellspacing="0"
                                                                       cellpadding="0"
                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td bgcolor="#F7F7F9"
                                                                            style="text-align: center"><a
                                                                                href="http://catspride.com/"
                                                                                style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/footer_websitebutton.png?r=644622158"
                                                                                width="74" height="17"
                                                                                alt="catspride.com"
                                                                                style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://facebook.com/catspride/"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                    src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-facebook.png?r=62755498"
                                                                                    width="17" height="17"
                                                                                    alt="Facebook"
                                                                                    style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://twitter.com/@catspride"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                    src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-twitter.png?r=2097560124"
                                                                                    width="17" height="17" alt="Twitter"
                                                                                    style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://instagram.com/catspride/"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                    src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-instagram.png?r=281172111"
                                                                                    width="17" height="17"
                                                                                    alt="Instagram"
                                                                                    style="display: block; border: none;"></a>
                                                                            &nbsp;&nbsp; <a
                                                                                    href="https://youtube.com/user/catspride"
                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                    src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/jjurek@magnani.com/global/icons_icon_social-youtube.png?r=2122732911"
                                                                                    width="24" height="17" alt="YouTube"
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
                                    <td id="layout-row-margin3181" valign="top"
                                        style="padding: 0px; background-color: #ffffff;">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                            <tbody>
                                            <tr id="layout-row3181"
                                                class="layout layout-row widget _widget_text style3181"
                                                style="margin: 0; padding: 0; background-color: #6abf4b;">
                                                <td id="layout-row-padding3181" valign="top"
                                                    style="background-color: #6abf4b; padding: 17px;">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                        <tbody>
                                                        <tr>
                                                            <td id="text_div2753" class="td_text td_block" valign="top"
                                                                align="left"
                                                                style="line-height: 150%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.5; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                <div style="line-height: 150%; margin: 0; outline: none; padding: 0; font-size: 10px; mso-line-height-rule: exactly; line-height: 1.5;"
                                                                     class="" data-line-height="1.5">
                                                                    <div style="margin: 0; outline: none; padding: 0; color: #ffffff;"
                                                                         class="">
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
                                                                </div>
                                                                <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                <style data-ac-keep="true" data-ac-inline="false">
                                                                    #text_div2753, #text_div2753 div {
                                                                        line-height: 150% !important;
                                                                    }
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
                                    <a style="color:#000000;text-decoration:underline;" href="%tag_unsubscribe_url%" target="_blank">Unsubscribe</a>
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