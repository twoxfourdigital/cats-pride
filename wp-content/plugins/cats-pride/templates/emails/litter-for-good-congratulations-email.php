<?php

if (!defined('ABSPATH') && !isset($_GET['test'])) {
    exit; // Exit if accessed directly
}

$domain_url = (function_exists('home_url')) ? trim(home_url(), '/') : $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];

?>
<html lang="en" style="margin: 0; outline: none; padding: 0;">
<head>
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

            :not(.body) thead,
            :not(.body) tbody, :not(.body) tr {
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
    <style data-ac-keep="true"> @media only screen and (max-width: 320px) {
            #layout-row12862 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row12863 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row12867 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row12870 img {
                width: 100% !important;
                height: auto !important;
                max-width: 234px !important;
            }

            #layout-row12877 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row12880 img {
                width: 100% !important;
                height: auto !important;
                max-width: 264px !important;
            }

            #layout-row12881 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row12884 img {
                width: 100% !important;
                height: auto !important;
                max-width: 320px !important;
            }

            #layout-row12885 img {
                width: 100% !important;
                height: auto !important;
                max-width: 202px !important;
            }

            #layout-row12887 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12888 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12889 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12890 .break-line {
                width: 100% !important;
                margin: auto !important;
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
            #layout-row12862 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row12863 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row12867 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row12870 img {
                width: 100% !important;
                height: auto !important;
                max-width: 234px !important;
            }

            #layout-row12877 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row12880 img {
                width: 100% !important;
                height: auto !important;
                max-width: 264px !important;
            }

            #layout-row12881 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row12884 img {
                width: 100% !important;
                height: auto !important;
                max-width: 375px !important;
            }

            #layout-row12885 img {
                width: 100% !important;
                height: auto !important;
                max-width: 202px !important;
            }

            #layout-row12887 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12888 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12889 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12890 .break-line {
                width: 100% !important;
                margin: auto !important;
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
            #layout-row12862 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row12863 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row12867 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row12870 img {
                width: 100% !important;
                height: auto !important;
                max-width: 234px !important;
            }

            #layout-row12877 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row12880 img {
                width: 100% !important;
                height: auto !important;
                max-width: 264px !important;
            }

            #layout-row12881 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row12884 img {
                width: 100% !important;
                height: auto !important;
                max-width: 414px !important;
            }

            #layout-row12885 img {
                width: 100% !important;
                height: auto !important;
                max-width: 202px !important;
            }

            #layout-row12887 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12888 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12889 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12890 .break-line {
                width: 100% !important;
                margin: auto !important;
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
            #layout-row12862 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row12863 {
                max-height: 0px !important;
                font-size: 0px !important;
                display: none !important;
                visibility: hidden !important;
            }

            #layout-row12867 img {
                width: 100% !important;
                height: auto !important;
                max-width: 600px !important;
            }

            #layout-row12870 img {
                width: 100% !important;
                height: auto !important;
                max-width: 234px !important;
            }

            #layout-row12877 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row12880 img {
                width: 100% !important;
                height: auto !important;
                max-width: 264px !important;
            }

            #layout-row12881 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row12884 img {
                width: 100% !important;
                height: auto !important;
                max-width: 667px !important;
            }

            #layout-row12885 img {
                width: 100% !important;
                height: auto !important;
                max-width: 202px !important;
            }

            #layout-row12887 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12888 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12889 .break-line {
                width: 100% !important;
                margin: auto !important;
            }

            #layout-row12890 .break-line {
                width: 100% !important;
                margin: auto !important;
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
</head>
    <body class="divbody"
         style="margin: 0px; outline: none; padding: 0px; color: #000000; font-family: arial; line-height: 1.1; width: 100%; background-color: #FFFFFF; background: #FFFFFF; text-align: center;">
        <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="100%" align="left"
               style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; background: #FFFFFF;">
            <tbody>
            <tr>
                <td align="center" valign="top" width="100%">
                    <table class="template-table" border="0" cellpadding="0" cellspacing="0" width="600"
                           bgcolor="#FFFFFF"
                           style="font-size: 13px; min-width: auto; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px;">
                        <tbody>
                        <tr>
                            <td id="layout_table_3ba3ccbe5849dfacd8854430355954a20602c330" valign="top"
                                align="center" width="600" style="background-color: #ffffff;">
                                <table cellpadding="0" cellspacing="0" border="0"
                                       class="layout layout-table root-table" width="600"
                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                    <tbody>
                                    <tr style="background-color: #ffffff;">
                                        <td id="layout-row-margin12863" valign="top"
                                            style="background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                <tbody>
                                                <tr id="layout-row12863"
                                                    class="layout layout-row widget _widget_spacer ">
                                                    <td id="layout-row-padding12863" valign="top">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td valign="top" height="30">
                                                                    <div class="spacer" style="margin: 0; outline: none;
padding: 0; height: 30px;">
                                                                        <table cellpadding="0" cellspacing="0"
                                                                               border="0" width="100%"
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
                                        <td id="layout-row-margin12862" valign="top"
                                            style="background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                <tbody>
                                                <tr id="layout-row12862"
                                                    class="layout layout-row widget _widget_picture "
                                                    align="center">
                                                    <td id="layout-row-padding12862" valign="top">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="center" valign="top"
                                                                    width="600"><img
                                                                            src="https://catspride.imgus11.com/public//cadb3e9b0bc352da2093d5cda305fdab.jpg?r=1679088648"
                                                                            alt="Help cat lovers fall in love with your shelter. Enhance your new Shelter Page to get more nominations."
                                                                            width="600"
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
                                        <td id="layout-row-margin12864" valign="top"
                                            style="padding: 0 25px 0 25px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12864"
                                                    class="layout layout-row widget _widget_text style12864"
                                                    style="margin: 0; padding: 0;">
                                                    <td id="layout-row-padding12864" valign="top"
                                                        style="padding: 35px 0px 20px 0px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11584" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 120%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.2; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 120%; margin: 0;
outline: none; padding: 0; font-size: 18px; color: #272e63; mso-line-height-rule: exactly; line-height: 1.2;"
                                                                         data-line-height="1.2">
                                                                        <div style="margin: 0; outline: none; padding: 0; color: #272e63;">
                                                                            <div style="margin: 0; outline: none; padding: 0; text-align: center; color: #272e63;"
                                                                                 class=""><span
                                                                                        style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                        class=""><span class=""
                                                                                                       style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"><span
                                                                                                style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                class=""> Your shelter is now registered for our Litter for Good program, and you’re well on your way to receiving donated litter each time a new supporter nominates your organization.</span> </span></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11584, #text_div11584 div {
                                                                        line-height: 120% !important;
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
                                        <td id="layout-row-margin12877" valign="top"
                                            style="padding: 0; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12877"
                                                    class="layout layout-row widget _widget_picture style12877"
                                                    align="center" style="background-color: #e6e7e8;">
                                                    <td id="layout-row-padding12877" valign="top"
                                                        style="background-color: #e6e7e8; padding: 0 0 0px 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="center" valign="top"
                                                                    width="600"><img
                                                                            src="https://catspride.imgus11.com/public//f7abc9993a6fc1d6c167b597ebabce90.jpg?r=473311782"
                                                                            alt="Clear the Shelters Inspiring Stories of Adoptions"
                                                                            width="600" style="display: block; border: none;
outline: none; width: 600px; opacity: 1; max-width: 100%;"></td>
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
                                        <td id="layout-row-margin12872" valign="top"
                                            style="padding: 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12872"
                                                    class="layout layout-row widget _widget_text style12872"
                                                    style="margin: 0; padding: 0; background-color: #e6e7e8;">
                                                    <td id="layout-row-padding12872" valign="top"
                                                        style="background-color: #e6e7e8; padding: 5px 5px 20px 5px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11592" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 130%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.3; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 130%; margin: 0; outline: none; padding: 0; font-size: 35px; mso-line-height-rule: exactly; line-height: 1.3;"
                                                                         class="" data-line-height="1.3">
                                                                        <div style="margin: 0; outline: none; padding: 0;"
                                                                             class="">
                                                                            <div style="margin: 0; outline: none; padding: 0;"
                                                                                 class="">
                                                                                <div style="margin: 0; outline: none; padding: 0; text-align: center;"
                                                                                     class=""><b
                                                                                            style="margin: 0; outline: none; padding: 0; text-decoration: inherit; text-align: inherit; color: #272e63;"
                                                                                            class=""></b></div>
                                                                                <div style="margin: 0; outline: none; padding: 0; text-align: center;"
                                                                                     class=""><span
                                                                                            style="color: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: inherit;"
                                                                                            class=""><span
                                                                                                style="color: #1460aa; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">Get more nominations.</span><br
                                                                                                class=""><span
                                                                                                style="color: #009fd4; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">Receive more donated litter.</span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11592, #text_div11592 div {
                                                                        line-height: 130% !important;
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
                                        <td id="layout-row-margin12873" valign="top"
                                            style="padding: 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12873"
                                                    class="layout layout-row widget _widget_text style12873"
                                                    style="margin: 0; padding: 0; background-color: #e6e7e8;">
                                                    <td id="layout-row-padding12873" valign="top"
                                                        style="background-color: #e6e7e8; padding: 0px 20px 20px 20px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11593" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 170%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.7; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 170%; margin: 0; outline: none; padding: 0; mso-line-height-rule: exactly; line-height: 1.7;"
                                                                         data-line-height="1.7">
                                                                        <div style="margin: 0; outline: none; padding: 0; text-align: center; font-size: 18px; color: #272e63;">
                                                                            <span style="color: #272e63; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit; text-align: inherit;"
                                                                                  class="">Enhance your public Shelter Page and spread the word.<br></span>
                                                                        </div>
                                                                        <div style="margin: 0; outline: none; padding: 0; text-align: center; font-size: 18px; color: #272e63;">
                                                                            <span style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: inherit;"
                                                                                  class="">Add pictures, links and complete details to make your organization really stand out. Then share your public-facing Shelter Page or download Litter for Good emails, social media posts and other resources to help get the word out to your supporters and receive more litter donations!</span>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11593, #text_div11593 div {
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
                                    <tr style="background-color: #ffffff;">
                                        <td id="layout-row-margin12870" valign="top"
                                            style="padding: 0; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12870"
                                                    class="layout layout-row widget _widget_picture style12870"
                                                    align="center" style="background-color: #e6e7e8;">
                                                    <td id="layout-row-padding12870" valign="top"
                                                        style="background-color: #e6e7e8; padding: 25px 0px 35px 0px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="center" valign="top"
                                                                    width="600"><a
                                                                            href="<?php echo $domain_url; ?>/member-dashboard/shelter-resources/?tab=manage-my-shelter-page"
                                                                            style="margin: 0; outline: none; padding: 0; color: #045FB4; display: block; min-width:
100%;"><img src="https://catspride.imgus11.com/public//3f6f59c74bf192e6934399e790a6ffd1.png?r=2058353862"
        alt="Enhance my Shelter Page" width="163"
        style="border: none; display: block; outline: none; width: 163px; opacity: 1; max-width: 100%;"></a></td>
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
                                        <td id="layout-row-margin12887" valign="top"
                                            style="padding: 50px 0px 0px 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12887"
                                                    class="layout layout-row widget _widget_break style12887"
                                                    style="">
                                                    <td id="layout-row-padding12887" valign="top"
                                                        style="line-height: 0; mso-line-height-rule: exactly; padding: 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly;">
                                                            <tbody>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" height="1" width="600"
                                                                    style="line-height: 0; mso-line-height-rule: exactly;">
                                                                    <table align="center" border="0" cellpadding="0"
                                                                           cellspacing="0" height="1" width="600"
                                                                           style="font-size: 13px; min-width: auto!important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly; width: 100%; max-width: 100%;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="break-line" bgcolor="#d3d5d8"
                                                                                height="1" width="600"
                                                                                style="line-height: 1px; mso-line-height-rule: exactly; height: 1px; width: 600px; background-color: #d3d5d8;"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr id="layout-row12886" class="layout layout-row clear-this "
                                        style="background-color: #ffffff;">
                                        <td id="layout-row-padding12886" valign="top"
                                            style="background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                <tbody>
                                                <tr>
                                                    <td id="layout_table_20b1bf983f1b8b6b8e96909a970ab430164d757b"
                                                        valign="top" width="300" style="background-color: #ffffff;">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                               class="layout layout-table " width="300"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                            <tbody>
                                                            <tr style="background-color: #ffffff;">
                                                                <td id="layout-row-margin12885" valign="top"
                                                                    style="padding: 0; background-color: #ffffff;">
                                                                    <table width="100%" border="0" cellpadding="0"
                                                                           cellspacing="0" style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial
!important;">
                                                                        <tbody>
                                                                        <tr id="layout-row12885"
                                                                            class="layout layout-row widget _widget_picture style12885"
                                                                            align="center" style="">
                                                                            <td id="layout-row-padding12885"
                                                                                valign="top"
                                                                                style="padding: 60px 0px 0px 0px;">
                                                                                <table width="100%" border="0"
                                                                                       cellpadding="0"
                                                                                       cellspacing="0"
                                                                                       style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="image-td"
                                                                                            align="center"
                                                                                            valign="top"
                                                                                            width="300"><img
                                                                                                    src="https://catspride.imgus11.com/public//2ce60084a6addfc5329f38ab50362c68.png?r=14437566"
                                                                                                    alt=""
                                                                                                    width="168"
                                                                                                    style="display: block; border: none; outline: none; width: 168px; opacity: 1; max-width: 100%;">
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
                                                    <td id="layout_table_e0084c7cb49c63bfd09e55dbac00db3cf4e891d1"
                                                        valign="top" width="300" style="background-color: #ffffff;">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                               class="layout layout-table " width="300"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;">
                                                            <tbody>
                                                            <tr style="background-color: #ffffff;">
                                                                <td id="layout-row-margin12879" valign="top"
                                                                    style="padding: 0px; background-color: #ffffff;">
                                                                    <table width="100%" border="0" cellpadding="0"
                                                                           cellspacing="0"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                                        <tbody>
                                                                        <tr id="layout-row12879"
                                                                            class="layout layout-row widget _widget_text style12879"
                                                                            style="margin: 0; padding: 0;">
                                                                            <td id="layout-row-padding12879"
                                                                                valign="top"
                                                                                style="padding: 35px 5px 35px 5px;">
                                                                                <table width="100%" border="0"
                                                                                       cellpadding="0"
                                                                                       cellspacing="0" style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt;
mso-table-rspace: 0pt;">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td id="text_div11597"
                                                                                            class="td_text td_block"
                                                                                            valign="top"
                                                                                            align="left"
                                                                                            style="line-height: 130%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.3; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                                            <div style="line-height: 130%; margin: 0; outline: none; padding: 0; font-size: 35px; mso-line-height-rule: exactly; line-height: 1.3;"
                                                                                                 class=""
                                                                                                 data-line-height="1.3">
                                                                                                <div style="margin: 0; outline: none; padding: 0;"
                                                                                                     class="">
                                                                                                    <div style="margin: 0; outline: none; padding: 0;"
                                                                                                         class="">
                                                                                                        <div style="margin: 0; outline: none; padding: 0; text-align: center;"
                                                                                                             class="">
                                                                                                            <b style="margin: 0; outline: none; padding: 0; text-decoration: inherit; color: #272e63;"
                                                                                                               class=""></b>
                                                                                                        </div>
                                                                                                        <div style="margin: 0; outline: none; padding: 0; text-align: center;"
                                                                                                             class="">
                                                                                                            <div style="margin: 0; outline: none; padding: 0; text-align: left; font-size: 21px;">
                                                                                                                <span style="color: #009fd4; font-size: inherit; font-weight: 700; line-height: inherit; text-decoration: inherit; text-align: inherit; background-color: initial;"
                                                                                                                      class="">Claim your litter in one of two easy ways.</span>
                                                                                                            </div>
                                                                                                            <span style="color: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: inherit;"
                                                                                                                  class=""><div
                                                                                                                        style="margin: 0; outline: none; padding: 0; text-align: left; font-size: 18px; color: #272e63;"><span
                                                                                                                            style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: inherit; background-color: initial;"
                                                                                                                            class=""><br
                                                                                                                                style="color: #272e63;"><span
                                                                                                                                style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                                                class="">You can pick it up, free, at any Cat’s Pride plant or warehouse. Or pay third-party shipping to have it sent directly to your shelter. <a
                                                                                                                                    href="https://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=463A788A16A5502"
                                                                                                                                    data-ac-default-color="1"
                                                                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; text-decoration: underline; font-weight: bold;"><span
                                                                                                                                        style="color: ; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;">Contact us</span></a> or visit our <a
                                                                                                                                    href="https://catspride.acemlnc.com/lt.php?notrack=1&amp;s=a9b105cd8ddc4564d32dbd8a1da78ee6&amp;i=463A788A16A5503"
                                                                                                                                    data-ac-default-color="1"
                                                                                                                                    style="margin: 0; outline: none; padding: 0; color: #045FB4; text-decoration: underline; font-weight: bold;"><span
                                                                                                                                        style="color: ; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;">FAQ page</span></a> to learn more.</span></span></div>
</span></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                                            <style data-ac-keep="true"
                                                                                                   data-ac-inline="false"> #text_div11597, #text_div11597 div {
                                                                                                line-height: 130% !important;
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
                                    <tr style="background-color: #ffffff;">
                                        <td id="layout-row-margin12888" valign="top"
                                            style="padding: 20px 0px 50px 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12888"
                                                    class="layout layout-row widget _widget_break style12888"
                                                    style="">
                                                    <td id="layout-row-padding12888" valign="top"
                                                        style="line-height: 0; mso-line-height-rule: exactly; padding: 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly;">
                                                            <tbody>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" height="1" width="600"
                                                                    style="line-height: 0; mso-line-height-rule: exactly;">
                                                                    <table align="center" border="0" cellpadding="0"
                                                                           cellspacing="0" height="1" width="600"
                                                                           style="font-size: 13px; min-width: auto!important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly; width: 100%; max-width: 100%;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="break-line" bgcolor="#d3d5d8"
                                                                                height="1" width="600"
                                                                                style="line-height: 1px; mso-line-height-rule: exactly; height: 1px; width: 600px; background-color: #d3d5d8;"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
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
                                        <td id="layout-row-margin12883" valign="top"
                                            style="padding: 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12883"
                                                    class="layout layout-row widget _widget_text style12883"
                                                    style="margin: 0; padding: 0;">
                                                    <td id="layout-row-padding12883" valign="top"
                                                        style="padding: 35px 5px 35px 5px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11601" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 130%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.3; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 130%; margin: 0; outline: none;
padding: 0; font-size: 35px; mso-line-height-rule: exactly; line-height: 1.3;" data-line-height="1.3">
                                                                        <div style="margin: 0; outline: none; padding: 0;">
                                                                            <div style="margin: 0; outline: none; padding: 0;">
                                                                                <div style="margin: 0; outline: none; padding: 0; text-align: center;">
                                                                                    <b style="margin: 0; outline: none; padding: 0; text-decoration: inherit; text-align: inherit; color: #272e63;"
                                                                                       class=""></b></div>
                                                                                <div style="margin: 0; outline: none; padding: 0; text-align: center;">
                                                                                    <span style="color: inherit; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit; text-align: inherit;"
                                                                                          class=""><span
                                                                                                style="color: #1460aa; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">Donated litter for shelters. It’s not a promotion.&nbsp;<span
                                                                                                    style="color: #1460aa; font-size: 35px; font-weight: 400; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: normal;"
                                                                                                    class=""><span
                                                                                                        style="color: #009fd4; font-size: 35px; font-weight: 700; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: normal;"
                                                                                                        class="">It's a commitment.</span></span></span><span
                                                                                                style="color: #009fd4; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                class=""></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11601, #text_div11601 div {
                                                                        line-height: 130% !important;
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
                                        <td id="layout-row-margin12884" valign="top"
                                            style="padding: 0; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12884"
                                                    class="layout layout-row widget _widget_picture style12884"
                                                    align="center" style="background-color: #e6e7e8;">
                                                    <td id="layout-row-padding12884" valign="top"
                                                        style="background-color: #e6e7e8; padding: 0 0 0px 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="center" valign="top"
                                                                    width="600"><img
                                                                            src="https://catspride.imgus11.com/public//0950c93ae818171dd49952775acea59f.jpg?r=833618262"
                                                                            alt="Clear the Shelters Inspiring Stories of Adoptions"
                                                                            width="600" style="display: block; border: none;
outline: none; width: 600px; opacity: 1; max-width: 100%;"></td>
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
                                        <td id="layout-row-margin12882" valign="top"
                                            style="padding: 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12882"
                                                    class="layout layout-row widget _widget_text style12882"
                                                    style="margin: 0; padding: 0;">
                                                    <td id="layout-row-padding12882" valign="top"
                                                        style="padding: 10px 0px 20px 0px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11600" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 170%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.7; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 170%; margin: 0; outline: none;
padding: 0; text-align: center; font-size: 17px; color: #272e63; mso-line-height-rule: exactly; line-height: 1.7;"
                                                                         data-line-height="1.7"><span
                                                                                style="color: #272e63; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit; text-align: inherit; background-color: initial;"
                                                                                class="">Click below to learn more about the Cat's Pride Litter for Good program!</span>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11600, #text_div11600 div {
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
                                    <tr style="background-color: #ffffff;">
                                        <td id="layout-row-margin12880" valign="top"
                                            style="padding: 0; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12880"
                                                    class="layout layout-row widget _widget_picture style12880"
                                                    align="center" style="">
                                                    <td id="layout-row-padding12880" valign="top"
                                                        style="padding: 25px 0px 35px 0px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="center" valign="top"
                                                                    width="600"><a
                                                                            href="<?php echo $domain_url; ?>/litterforgood"
                                                                            style="margin: 0; outline: none; padding: 0; color: #045FB4; display: block; min-width: 100%;"><img
                                                                                src="https://catspride.imgus11.com/public//6273dcf5ec134e6d1d70668a8035532f.png?r=641266259"
                                                                                alt="Enhance my Shelter Page"
                                                                                width="183"
                                                                                style="border: none; display: block; outline: none; width: 183px; opacity: 1; max-width: 100%;"></a>
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
                                        <td id="layout-row-margin12889" valign="top"
                                            style="padding: 20px 0px 50px 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12889"
                                                    class="layout layout-row widget _widget_break style12889"
                                                    style="">
                                                    <td id="layout-row-padding12889" valign="top"
                                                        style="line-height: 0; mso-line-height-rule: exactly; padding: 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly;">
                                                            <tbody>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" height="1" width="600"
                                                                    style="line-height: 0; mso-line-height-rule: exactly;">
                                                                    <table align="center" border="0" cellpadding="0"
                                                                           cellspacing="0" height="1" width="600"
                                                                           style="font-size: 13px; min-width: auto!important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly; width: 100%; max-width: 100%;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="break-line" bgcolor="#d3d5d8"
                                                                                height="1" width="600"
                                                                                style="line-height: 1px; mso-line-height-rule: exactly; height: 1px; width: 600px; background-color: #d3d5d8;"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
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
                                        <td id="layout-row-margin12881" valign="top"
                                            style="padding: 0 0 0px 0; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12881"
                                                    class="layout layout-row widget _widget_picture style12881"
                                                    align="left" style="">
                                                    <td id="layout-row-padding12881" valign="top"
                                                        style="padding: 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="left" valign="top"
                                                                    width="600"><img
                                                                            src="https://catspride.imgus11.com/public//a01285f8faf44144985ca872632cf427.jpg?r=1187760843"
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
                                        <td id="layout-row-margin12875" valign="top"
                                            style="padding: 10px 30px 30px 30px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12875"
                                                    class="layout layout-row widget _widget_text style12875"
                                                    style="margin: 0; padding: 0;">
                                                    <td id="layout-row-padding12875" valign="top"
                                                        style="padding: 5px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11595" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 90%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 90%; margin: 0; outline: none;
padding: 0; font-size: 32px; mso-line-height-rule: exactly; line-height: 1;" data-line-height="0.9">
                                                                        <div style="margin: 0; outline: none; padding: 0;">
                                                                            <div style="margin: 0; outline: none; padding: 0;">
                                                                                <div style="margin: 0; outline: none; padding: 0; text-align: center;">
                                                                                    <span style="color: inherit; font-size: 24px; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                          class=""><span
                                                                                                style="color: #272e63; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">Every jug purchased helps more shelter cats </span><span
                                                                                                style="color: #009ed3; font-size: inherit; font-weight: bold; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">find forever homes.</span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11595, #text_div11595 div {
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
                                        <td id="layout-row-margin12890" valign="top"
                                            style="padding: 0px 0px 50px 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12890"
                                                    class="layout layout-row widget _widget_break style12890"
                                                    style="">
                                                    <td id="layout-row-padding12890" valign="top"
                                                        style="line-height: 0; mso-line-height-rule: exactly; padding: 0;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly;">
                                                            <tbody>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" height="1" width="600"
                                                                    style="line-height: 0; mso-line-height-rule: exactly;">
                                                                    <table align="center" border="0" cellpadding="0"
                                                                           cellspacing="0" height="1" width="600"
                                                                           style="font-size: 13px; min-width: auto!important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse; line-height: 0; mso-line-height-rule: exactly; width: 100%; max-width: 100%;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td class="break-line" bgcolor="#d3d5d8"
                                                                                height="1" width="600"
                                                                                style="line-height: 1px; mso-line-height-rule: exactly; height: 1px; width: 600px; background-color: #d3d5d8;"></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"
                                                                    style="font-size: 10px; height: 10px; line-height: 0; mso-line-height-rule: exactly;"></td>
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
                                        <td id="layout-row-margin12867" valign="top"
                                            style="background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                <tbody>
                                                <tr id="layout-row12867"
                                                    class="layout layout-row widget _widget_picture " align="left">
                                                    <td id="layout-row-padding12867" valign="top">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td class="image-td" align="left" valign="top"
                                                                    width="600"><img
                                                                            src="https://catspride.imgus11.com/public//0cb62a68b361fde56f29e43815a203c4.png?r=1220497256"
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
                                        <td id="layout-row-margin12868" valign="top"
                                            style="padding: 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12868"
                                                    class="layout layout-row widget _widget_html style12868"
                                                    style="">
                                                    <td id="layout-row-padding12868" valign="top"
                                                        style="padding: 0px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="html_div11588" width="600" align="left">
                                                                    <table width="600" border="0" cellspacing="0"
                                                                           cellpadding="0"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td bgcolor="#DCDDDD"
                                                                                style="text-align: center"><a
                                                                                        href="http://catspride.com/"
                                                                                        style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                            src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/hong%40magnani.com/btn-website.png?rand=0.17691006730374692"
                                                                                            width="74" height="18"
                                                                                            alt="catspride.com"
                                                                                            style="border: none;"></a>
                                                                                &nbsp;&nbsp; <a
                                                                                        href="https://facebook.com/catspride/"
                                                                                        style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                            src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/hong%40magnani.com/btn-fb.png?rand=0.22839076643437517"
                                                                                            width="17" height="17"
                                                                                            alt="Facebook"
                                                                                            style="border: none;"></a>
                                                                                &nbsp;&nbsp; <a
                                                                                        href="https://twitter.com/@catspride"
                                                                                        style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                            src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/hong%40magnani.com/btn-tw.png?rand=0.36041781464079903"
                                                                                            width="17" height="17"
                                                                                            alt="Twitter"
                                                                                            style="border: none;"></a>
                                                                                &nbsp;&nbsp; <a
                                                                                        href="https://instagram.com/catspride/"
                                                                                        style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                            src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/hong%40magnani.com/btn-ig.png?rand=0.7066662001062256"
                                                                                            width="17" height="17"
                                                                                            alt="Instagram"
                                                                                            style="border: none;"></a>
                                                                                &nbsp;&nbsp; <a
                                                                                        href="https://youtube.com/user/catspride"
                                                                                        style="margin: 0; outline: none; padding: 0; color: #045FB4; display: inline-block;"><img
                                                                                            src="https://ac-image.s3.amazonaws.com/4/5/2/6/5/6/home/hong%40magnani.com/btn-yt.png?rand=0.9348141552393703"
                                                                                            width="24" height="17"
                                                                                            alt="YouTube"
                                                                                            style="border: none;"></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="10" bgcolor="#DCDDDD"
                                                                                style="font-size: 10px; height: 10px; line-height: 10px;"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td bgcolor="#DCDDDD"
                                                                                style="font-size: 14px; line-height: 18px; font-family: Arial, sans-serif; color:#2F408E; text-align: center">
                                                                                <strong style="margin: 0; outline: none; padding: 0;">Questions
                                                                                    or Comments?</strong><br> Please
                                                                                email <a
                                                                                        href="mailto:ken.berry@oildri.com"
                                                                                        style="margin: 0; outline: none; padding: 0; color: #2F408E; text-decoration: none;">ken.berry@oildri.com</a>
                                                                                or call <a href="tel:+18006453741"
                                                                                           style="margin: 0; outline: none; padding: 0; color: #2F408E; text-decoration: none;">1-800-645-3741</a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td bgcolor="#DCDDDD">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td bgcolor="#DCDDDD" height="10"
                                                                                style="font-size: 10px; height: 10px; line-height: 10px; border-top: 3px solid #e6e7e9;">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table bgcolor="#DCDDDD" border="0"
                                                                           cellspacing="0" cellpadding="0"
                                                                           class="wrapto100pc"
                                                                           style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; width: 100%; padding: 0 0 10px 0;">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td align="center">
                                                                                <table style="font-size: 13px; min-width: 100px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0 auto;">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <p style="text-align:center;">
                                                                                                <img src="https://gallery.mailchimp.com/6dbb0fa1496d8615550efda2d/images/12884f9d-1a4f-4a16-9bfe-4f74b41db657.png"
                                                                                                     width="80"
                                                                                                     height="54"
                                                                                                     style="display: inline-block;"
                                                                                                     alt="Oil-Dri">
                                                                                            </p>
                                                                                        </td>
                                                                                        <td style="font-size: 14px; line-height: 18px; font-family: Arial, sans-serif; color: #2F408E; text-align: center">
                                                                                            Maker of Cat’s Pride
                                                                                            &amp; Jonny Cat
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
                                        <td id="layout-row-margin12865" valign="top"
                                            style="padding: 0px; background-color: #ffffff;">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: initial !important;">
                                                <tbody>
                                                <tr id="layout-row12865"
                                                    class="layout layout-row widget _widget_text style12865"
                                                    style="margin: 0; padding: 0; background-color: #1460aa;">
                                                    <td id="layout-row-padding12865" valign="top"
                                                        style="background-color: #1460aa; padding: 17px;">
                                                        <table width="100%" border="0" cellpadding="0"
                                                               cellspacing="0"
                                                               style="font-size: 13px; min-width: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                            <tbody>
                                                            <tr>
                                                                <td id="text_div11585" class="td_text td_block"
                                                                    valign="top" align="left"
                                                                    style="line-height: 150%; color: inherit; font-size: 12px; font-weight: inherit; line-height: 1.5; text-decoration: inherit; font-family: Arial; mso-line-height-rule: exactly;">
                                                                    <div style="line-height: 150%; margin: 0; outline: none; padding: 0; color: #ffffff; mso-line-height-rule: exactly; line-height: 1.5;"
                                                                         class="" data-line-height="1.5">
                                                                        <div style="margin: 0; outline: none; padding: 0; color: #ffffff;"
                                                                             class=""><span
                                                                                    style="color: #ffffff; font-size: 10px; font-weight: 400; line-height: inherit; text-decoration: inherit; font-family: arial; font-style: normal;"
                                                                                    class="">"Cat’s Pride", "Fresh &amp; Light", "Fresh &amp; Light Ultimate Care", "KatKit", "Jonny Cat", "Changing Litter for Good", "Light Done Right", and "Oil-Dri" are all registered trademarks of Oil-Dri Corporation of America. "Look for the Green Jug", "The Green Jug", "Green Jug" and "Litter for Good" are all trademarks of Oil-Dri Corporation of America. "Clear The Shelters" is a trademark of NBCUniversal Owned Television Stations.<br
                                                                                        class=""><span
                                                                                        style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                        class=""><a
                                                                                            href="https://catspride.com/legal/"
                                                                                            class="" target="_blank"
                                                                                            style="margin: 0; outline: none; padding: 0; color: #ffffff; text-decoration: underline;"><span
                                                                                                style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;"
                                                                                                class="">Terms &amp; Conditions</span></a> | <a
                                                                                            href="https://catspride.com/privacy-statement/"
                                                                                            class=""
                                                                                            style="margin: 0; outline: none; padding: 0; color: #ffffff; text-decoration: underline;"
                                                                                            target="_blank"><span
                                                                                                class=""
                                                                                                style="color: #ffffff; font-size: inherit; font-weight: inherit; line-height: inherit; text-decoration: inherit;">Privacy Policy</span></a></span></span><br
                                                                                    style="color: #ffffff;"
                                                                                    class=""></div>
                                                                    </div>
                                                                    <!--[if (gte mso 12)&(lte mso 15) ]>
                                                                    <style data-ac-keep="true"
                                                                           data-ac-inline="false"> #text_div11585, #text_div11585 div {
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
                </td>
            </tr>
            </tbody>
        </table>
    </body>

</body>
</html>