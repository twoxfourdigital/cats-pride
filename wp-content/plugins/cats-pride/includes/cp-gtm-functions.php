<?php

function cp_gtm_hook_javascript() {

    if ( defined( 'GOOGLE_TAG_MANAGER_ID') && !empty( GOOGLE_TAG_MANAGER_ID ) ) { ?>
<!-- Google Tag Manager - inserted by cats-pride Plugin -->
<script>
    (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', '<?php echo GOOGLE_TAG_MANAGER_ID; ?>');
</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P6N6FH5M4Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
 
  gtag('config', 'G-P6N6FH5M4Q');
</script>

<!-- Active Campaign Tracking - inserted by cats-pride Plugin -->
<script type="text/javascript">
    var trackcmp_email = '';
    var trackcmp = document.createElement("script");
    trackcmp.async = true;
    trackcmp.type = 'text/javascript';
    trackcmp.src = '//trackcmp.net/visit?actid=609803706&e='+encodeURIComponent(trackcmp_email)+'&r='+encodeURIComponent(document.referrer)+'&u='+encodeURIComponent(window.location.href);
    var trackcmp_s = document.getElementsByTagName("script");
    if (trackcmp_s.length) {
      try {
        trackcmp_s[0].parentNode.appendChild(trackcmp);
      } catch (error) {
        console.log('This will fail on staging.');
        console.log(error);
      }
    } else {
        var trackcmp_h = document.getElementsByTagName("head");
        trackcmp_h.length && trackcmp_h[0].appendChild(trackcmp);
    }
</script>
<!-- End Active Campaign Tracking --><?php }
}

add_action('wp_head', 'cp_gtm_hook_javascript');

function cp_gtm_hook_noscript() {

    if ( defined( 'GOOGLE_TAG_MANAGER_ID') && !empty( GOOGLE_TAG_MANAGER_ID ) ) { ?>
<!-- Google Tag Manager (noscript) inserted by cats-pride Plugin -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo GOOGLE_TAG_MANAGER_ID; ?>" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) --><?php }
}

add_action('cp_after_body', 'cp_gtm_hook_noscript');
