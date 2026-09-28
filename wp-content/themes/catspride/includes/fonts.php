<style>
    /* 
Example :
@font-face {
    font-family: 'Titillium Web';
    src: url('<?php //echo get_template_directory_uri() 
                ?>/assets/fonts/titillium-web/TitilliumWeb-Bold.woff2') format('woff2'),
        url('<?php //echo get_template_directory_uri() 
                ?>/assets/fonts/titillium-web/TitilliumWeb-Bold.woff') format('woff');
    font-weight: bold;
    font-style: normal;
    font-display: swap;
} */

    @font-face {
        font-family: 'Montserrat-Black';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Black.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Black.woff') format('woff');
        font-weight: 900;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-BlackItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-BlackItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-BlackItalic.woff') format('woff');
        font-weight: 900;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-Bold';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Bold.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Bold.woff') format('woff');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-BoldItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-BoldItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-BoldItalic.woff') format('woff');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-ExtraBold';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraBold.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraBold.woff') format('woff');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-ExtraBoldItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraBoldItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraBoldItalic.woff') format('woff');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-ExtraLight';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraLight.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraLight.woff') format('woff');
        font-weight: 200;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-ExtraLightItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraLightItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ExtraLightItalic.woff') format('woff');
        font-weight: 200;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-Italic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Italic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Italic.woff') format('woff');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-Light';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Light.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Light.woff') format('woff');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-LightItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-LightItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-LightItalic.woff') format('woff');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-Medium';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Medium.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Medium.woff') format('woff');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-MediumItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-MediumItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-MediumItalic.woff') format('woff');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-Regular';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Regular.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Regular.woff') format('woff');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-SemiBold';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-SemiBold.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-SemiBold.woff') format('woff');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-SemiBoldItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-SemiBoldItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-SemiBoldItalic.woff') format('woff');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-Thin';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Thin.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-Thin.woff') format('woff');
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Montserrat-ThinItalic';
        src: url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ThinItalic.woff2') format('woff2'),
            url('<?php echo get_template_directory_uri() ?>/assets/fonts/montserrat/Montserrat-ThinItalic.woff') format('woff');
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }
</style>