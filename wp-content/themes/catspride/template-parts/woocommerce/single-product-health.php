<?php

$title_desc = get_field('product_health_monitoring_main_content', get_the_ID());
$health_image = get_field('health_monitoring_image', get_the_ID());
$health_monitoring_values = get_field('health_monitoring_values', get_the_ID());
$layout = get_field('health_monitoring_layout', get_the_ID());

if(!$title_desc) return;
?>

<style>
section.product-health {
    color: #282E78;
    padding: 60px 0;
}
.titile-desc h2 {
    margin-bottom: 24px;
    font-size: 36px;
    font-family: Montserrat-Bold;
}
.titile-desc p{
    font-size: 24px;
    line-height: 36px;
    max-width: 90%;
    margin: 0 auto;
}
.health-main-wrapper {
    display: grid;
    grid-template-columns: 1fr 600px 1fr;
    align-items: center;
    gap: 40px;
    max-width: 1400px;
    margin: 0 auto;
    padding: 60px 20px;
    position: relative;
}

/* Center Image */
.image-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-wrapper img {
    width: 100%;
    max-width: 600px;
}

/* Columns */
.ph-column {
    display: flex;
    flex-direction: column;
    gap: 120px;
}

.ph-column.left {
    align-items: flex-end;
}

.ph-column.right {
    text-align: left;
    align-items: flex-start;
}

/* Each Item */
.ph-item {
    max-width: 420px;
    position: relative;
}

.ph-item img {
    width: 22px;
    margin-bottom:2px;
    margin-left: -35px;
}

.ph-item h3 {
    font-size: 39px;
    font-weight: 700;
    color: #282E78;
    margin: 0;
}

.ph-item h5 {
    font-size: 15px;
    text-transform: uppercase;
    font-weight: 700;
    margin: 8px 0 12px;
        color: #68B846;
}

.ph-item p {
        font-size: 15px;
    color: #282E78;
    margin: 0;
}

/* Arrow SVG positioning */
.ph-column.left .ph-item svg {
    position: absolute;
    right: -190px;
    top: 50%;
    transform: translateY(-50%);
}

.ph-column.right .ph-item svg {
    position: absolute;
    left: -240px;
    top: 50%;
    transform: translateY(-180%);
}
.ph-column.left .ph-item:nth-child(2) svg {
display: none;
}

.ph-column.right .ph-item:nth-child(2) svg {
transform: translateY(-50%) rotateX(-190deg);
}


/* Responsive */
@media (max-width: 1200px) {
.health-main-wrapper{
        grid-template-columns: 1fr 500px 1fr;
}
}
@media (max-width: 1100px) {
    .health-main-wrapper {
        grid-template-columns: 1fr;
        gap: 60px;
        order: 1;
    }

    .ph-column {
        align-items: center;
        text-align: center;
        gap: 60px;
    }
    .ph-column.left{
        order: 2;
        align-items: center;
    }
    .ph-column.right{
        order: 3;
        align-items: center;
    }

    .ph-column.left .ph-item svg,
    .ph-column.right .ph-item svg {
        display: none;
    }

    html body .image-wrapper img {
        max-width: 60%;
    }
    .ph-item h3 {
        text-align: center;
    }
    .ph-item h5 {
        text-align: center;
    }
    .ph-item h3 span {
        display: block;
    }
    .ph-item img {
    width: 30px;
    margin-bottom:2px;
    margin-left:0;
    }
    .ph-item p {
        text-align: center;
    }
}

/* HORIZONTAL LAYOUT ONLY */
.product-health.layout-horizontal {
    background: #f3f3f3;
    padding: 70px 0;
}

.product-health.layout-horizontal .product-highlights__inner {
    max-width: 1100px;
    margin: 0 auto;
}

.product-health.layout-horizontal .titile-desc {
    text-align: center;
    max-width: 950px;
    margin: 0 auto 40px;
}

.product-health.layout-horizontal .titile-desc h2 {
    margin-bottom: 18px;
    font-size: 34px;
    line-height: 1.2;
    text-transform: uppercase;
    letter-spacing: 0.02em;
}

.product-health.layout-horizontal .titile-desc p {
    font-size: 18px;
    line-height: 1.6;
    max-width: 850px;
    margin: 0 auto;
}

/* Main wrapper becomes stacked: image first, legend below */
.product-health.layout-horizontal .health-main-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 34px;
    max-width: 980px;
    margin: 0 auto;
    padding: 20px 20px 0;
}

/* Image */
.product-health.layout-horizontal .image-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 10px auto;
}

.product-health.layout-horizontal .image-wrapper img {
    display: block;
    width: 100%;
    max-width: 760px;
    height: auto;
}

/* Items row */
.product-health.layout-horizontal .ph-column {
    display: grid;
    grid-template-columns: repeat(3, minmax(220px, 1fr));
    gap: 28px 34px;
    align-items: start;
    width: 100%;
    max-width: 980px;
}

/* Base item style */
.product-health.layout-horizontal .ph-item {
    position: relative;
    max-width: none;
    text-align: left;
    padding-left: 0;
}

/* 4th item spans full row */
.product-health.layout-horizontal .ph-item:nth-child(4) {
    grid-column: 1 / -1;
    max-width: 540px;
}

/* Hide arrows in horizontal version */
.product-health.layout-horizontal .ph-item svg {
    display: none !important;
}

/* Heading with bullet icon */
.product-health.layout-horizontal .ph-item h3 {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 6px;
    font-size: 26px;
    line-height: 1.2;
    color: #282E78;
}

.product-health.layout-horizontal .ph-item h3 span {
    display: inline;
}

.product-health.layout-horizontal .ph-item img {
    width: 14px;
    height: 14px;
    min-width: 14px;
    margin: 0;
    display: block;
}

.product-health.layout-horizontal .ph-item h5 {
    margin: 0 0 10px;
    font-size: 11px;
    line-height: 1.4;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.04em;
}

.product-health.layout-horizontal .ph-item p {
    margin: 0;
    font-size: 14px;
    line-height: 1.55;
    color: #282E78;
}

/* Optional color accents by item position */
.product-health.layout-horizontal .ph-item:nth-child(1) h5 {
    color: #4d9a43;
}

.product-health.layout-horizontal .ph-item:nth-child(2) h5 {
    color: #9db400;
}

.product-health.layout-horizontal .ph-item:nth-child(3) h5 {
    color: #f3a126;
}

.product-health.layout-horizontal .ph-item:nth-child(4) h5 {
    color: #d53a32;
}

/* Tablet */
@media (max-width: 991px) {
    .product-health.layout-horizontal .health-main-wrapper {
        gap: 28px;
    }

    .product-health.layout-horizontal .ph-column {
        grid-template-columns: repeat(2, minmax(240px, 1fr));
        gap: 24px;
    }

    .product-health.layout-horizontal .ph-item:nth-child(4) {
        grid-column: 1 / -1;
        max-width: none;
    }

    .product-health.layout-horizontal .titile-desc h2 {
        font-size: 30px;
    }

    .product-health.layout-horizontal .titile-desc p {
        font-size: 17px;
    }
}

/* Mobile */
@media (max-width: 640px) {
    .product-health.layout-horizontal {
        padding: 50px 0;
    }

    .product-health.layout-horizontal .titile-desc {
        margin-bottom: 28px;
    }

    .product-health.layout-horizontal .titile-desc h2 {
        font-size: 24px;
        margin-bottom: 14px;
    }

    .product-health.layout-horizontal .titile-desc p {
        font-size: 15px;
        line-height: 1.5;
        max-width: 100%;
    }

    .product-health.layout-horizontal .health-main-wrapper {
        padding: 10px 16px 0;
        gap: 24px;
    }
    .product-health.layout-horizontal .image-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0;
        height: 400px;
    }

    .product-health.layout-horizontal .image-wrapper img {
        display: block;
        width: 100%;
        height: auto;
        transform: rotate(90deg);
        transform-origin: center center;
    }

    .product-health.layout-horizontal .ph-column {
        grid-template-columns: 1fr;
        gap: 22px;
    }

    .product-health.layout-horizontal .ph-item:nth-child(4) {
        grid-column: auto;
    }

    .product-health.layout-horizontal .ph-item h3 {
        font-size: 22px;
        display: inline-block;
    }
    .product-health.layout-horizontal .ph-item {
        text-align: center;
    }
    .product-health.layout-horizontal .ph-item img {
        display: inline-block;
    }
    .product-health.layout-horizontal .ph-item h5 {
        font-size: 10px;
    }

    .product-health.layout-horizontal .ph-item p {
        font-size: 14px;
    }
}
</style>
<section class="product-health layout-<?php echo $layout;?>">
    <div class="container">
        <div class="product-highlights__inner">

            <?php if ($title_desc): ?>

                <div class="titile-desc"><?php echo $title_desc;?></div>

            <?php endif; ?>

            <?php if( $health_monitoring_values ): ?>
                <div class="health-main-wrapper">
                    <?php if($layout == 'horizontal'){ ?>

                    <div class="image-wrapper">
                        <?php if( $health_image ): ?>
                            <img 
                                src="<?php echo esc_url($health_image); ?>" 
                            >
                        <?php endif; ?>
                    </div>

                    <div class="ph-column ">
                        
                        <?php while( have_rows('health_monitoring_values') ): the_row(); ?>
                           
                                
                                <div class="ph-item">
                                    
                                    <h3><img src="<?php the_sub_field('color'); ?>" > <span><?php the_sub_field('title'); ?></span></h3>
                                    <h5><?php the_sub_field('subtitle'); ?></h5>
                                    <p><?php the_sub_field('description'); ?></p>
                                    <svg width="175" height="85" viewBox="0 0 175 85" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M174.802 80.8716C175.321 82.0302 174.818 83.4782 173.659 83.9966C172.41 84.5778 171.053 84.012 170.456 82.7598L169.743 81.3195L169.058 79.7256L168.345 78.2854L167.57 76.7543L166.857 75.314L166.144 73.8738L165.431 72.4335L164.618 71.0623L163.905 69.6221L163.092 68.2509L162.379 66.8106L161.635 65.5393L160.822 64.1681L159.987 62.9596L159.174 61.5884L158.424 60.3081L157.589 59.0996L156.845 57.8283L153.494 52.9762L152.631 51.9213L151.796 50.7128L150.933 49.6579L150.099 48.4494L149.236 47.3946L148.367 46.3306L147.441 45.1849L146.578 44.13L145.609 43.1351L144.746 42.0802L143.846 41.1853L142.883 40.1995L142.021 39.1446L141.12 38.2496L140.061 37.3175L139.16 36.4225L138.198 35.4367L137.207 34.6045L136.307 33.7095L135.316 32.8773L134.325 32.0451L133.334 31.2129L132.343 30.3807L131.352 29.5485L130.333 28.8699L129.342 28.0378L128.323 27.3592L127.241 26.5898L126.222 25.9112L125.141 25.1417L124.122 24.4632L123.103 23.7846L121.993 23.1688L120.883 22.553L119.864 21.8744L118.754 21.2586L117.644 20.6428L116.534 20.027L115.393 19.5802L114.284 18.9644L113.243 18.4485L112.033 17.9017L110.892 17.4549L109.682 16.9082L108.542 16.4613L107.401 16.0145L106.26 15.5677L105.022 15.1746L103.881 14.7277L102.65 14.3437L101.418 13.9596L100.18 13.5665L98.9484 13.1824L97.7795 12.8893L96.457 12.568L95.2881 12.2748L93.9594 11.9444L92.6996 11.714L91.3771 11.3927L90.1173 11.1623L88.8576 10.9318L87.5978 10.7014L86.1754 10.4492L84.9156 10.2187L83.565 10.0511L82.2772 9.97427L80.9175 9.81289L79.5668 9.64523L78.1163 9.5466L76.7657 9.37894L75.3779 9.37118L74.0273 9.20352L72.6394 9.19576L71.1889 9.09714L69.8011 9.08938L68.3224 9.14439L66.8719 9.04577L65.3932 9.10078L64.0054 9.09302L62.5267 9.14803L61.0481 9.20303L59.5694 9.25804L57.9999 9.3758L56.5212 9.43082L54.9517 9.54858L53.473 9.60359L51.9662 9.81222L50.3967 9.93L48.8272 10.0478L47.2295 10.3192L45.66 10.4369L44.0533 10.7146L42.4838 10.8324L40.8861 11.1038L39.2794 11.3814L37.619 11.562L35.9215 11.9024L34.3238 12.1738L32.6262 12.5143L31.0195 12.7919L29.3219 13.1324L27.6244 13.4728L25.9268 13.8133L24.2292 14.1537L22.7006 14.525L25.0368 24.4943L7.75516e-06 17.5888L19.2845 4.72727e-05L21.6208 9.96934L23.1493 9.59799L24.9378 9.19478L26.6354 8.85435L28.4238 8.45113L30.1214 8.11071L31.819 7.77026L33.5793 7.52069L35.177 7.24929L36.8745 6.90886L38.544 6.72204L40.1416 6.45065L41.8392 6.1102L43.5087 5.9234L45.0782 5.80563L46.6759 5.53424L48.3453 5.34742L49.9149 5.22965L51.4844 5.11188L53.1539 4.92507L54.6606 4.71644L56.2929 4.68953L57.7716 4.63453L59.3411 4.51676L60.8198 4.46175L62.3893 4.34397L63.9308 4.37984L65.4094 4.32483L66.8881 4.26983L68.4295 4.30568L69.8801 4.40431L71.3587 4.3493L72.8093 4.44792L74.2599 4.54654L75.8013 4.5824L77.0892 4.6592L78.5397 4.75782L79.9903 4.85644L81.5036 5.04593L82.8542 5.21359L84.2139 5.37497L85.5645 5.54264L86.9779 5.80115L88.3285 5.96883L89.7573 6.23015L91.017 6.46059L92.4304 6.71911L93.7529 7.0404L95.0127 7.27082L96.3352 7.59211L97.6577 7.9134L98.9802 8.23469L100.303 8.55599L101.603 9.03999L102.835 9.42404L104.158 9.74533L105.389 10.1294L106.69 10.6134L107.831 11.0602L109.131 11.5442L110.341 12.091L111.573 12.475L112.783 13.0218L113.993 13.5686L115.202 14.1153L116.412 14.6621L117.622 15.2089L118.732 15.8247L119.904 16.5314L121.114 17.0781L122.224 17.6939L123.406 18.3943L124.516 19.0101L125.598 19.7796L126.77 20.4862L127.852 21.2557L128.962 21.8715L130.044 22.6409L131.125 23.4104L132.207 24.1798L133.261 25.1028L134.343 25.8723L135.334 26.7045L136.415 27.4739L137.469 28.397L138.46 29.2292L139.514 30.1522L140.567 31.0753L141.527 32.0765L142.518 32.9087L143.481 33.8945L144.444 34.8804L145.407 35.8662L146.432 36.9429L147.395 37.9287L148.364 38.9236L149.227 39.9785L150.252 41.0552L151.115 42.11L152.041 43.2558L152.973 44.4106L153.898 45.5563L154.761 46.6112L155.602 47.8288L156.528 48.9745L161.687 56.4436L162.5 57.8148L163.313 59.186L164.148 60.3945L164.961 61.7657L165.774 63.1369L166.587 64.5081L167.3 65.9483L168.112 67.3196L168.897 68.8444L169.71 70.2156L170.423 71.6559L171.199 73.187L171.975 74.7181L172.688 76.1583L173.463 77.6895L174.148 79.2833L174.833 80.8772L174.802 80.8716Z" fill="#282E78"/>
</svg>

                                </div>

                           
                        <?php endwhile; ?>
                    </div>

                    


            

                    <?php } else { ?>
                    <div class="ph-column left">
                        <?php $i = 0; ?>
                        <?php while( have_rows('health_monitoring_values') ): the_row(); $i++; ?>
                            <?php if( $i % 2 != 0 ): ?>
                                
                                <div class="ph-item">
                                    
                                    <h3><img src="<?php the_sub_field('color'); ?>" > <span><?php the_sub_field('title'); ?></span></h3>
                                    <h5><?php the_sub_field('subtitle'); ?></h5>
                                    <p><?php the_sub_field('description'); ?></p>
                                    <svg width="175" height="85" viewBox="0 0 175 85" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M174.802 80.8716C175.321 82.0302 174.818 83.4782 173.659 83.9966C172.41 84.5778 171.053 84.012 170.456 82.7598L169.743 81.3195L169.058 79.7256L168.345 78.2854L167.57 76.7543L166.857 75.314L166.144 73.8738L165.431 72.4335L164.618 71.0623L163.905 69.6221L163.092 68.2509L162.379 66.8106L161.635 65.5393L160.822 64.1681L159.987 62.9596L159.174 61.5884L158.424 60.3081L157.589 59.0996L156.845 57.8283L153.494 52.9762L152.631 51.9213L151.796 50.7128L150.933 49.6579L150.099 48.4494L149.236 47.3946L148.367 46.3306L147.441 45.1849L146.578 44.13L145.609 43.1351L144.746 42.0802L143.846 41.1853L142.883 40.1995L142.021 39.1446L141.12 38.2496L140.061 37.3175L139.16 36.4225L138.198 35.4367L137.207 34.6045L136.307 33.7095L135.316 32.8773L134.325 32.0451L133.334 31.2129L132.343 30.3807L131.352 29.5485L130.333 28.8699L129.342 28.0378L128.323 27.3592L127.241 26.5898L126.222 25.9112L125.141 25.1417L124.122 24.4632L123.103 23.7846L121.993 23.1688L120.883 22.553L119.864 21.8744L118.754 21.2586L117.644 20.6428L116.534 20.027L115.393 19.5802L114.284 18.9644L113.243 18.4485L112.033 17.9017L110.892 17.4549L109.682 16.9082L108.542 16.4613L107.401 16.0145L106.26 15.5677L105.022 15.1746L103.881 14.7277L102.65 14.3437L101.418 13.9596L100.18 13.5665L98.9484 13.1824L97.7795 12.8893L96.457 12.568L95.2881 12.2748L93.9594 11.9444L92.6996 11.714L91.3771 11.3927L90.1173 11.1623L88.8576 10.9318L87.5978 10.7014L86.1754 10.4492L84.9156 10.2187L83.565 10.0511L82.2772 9.97427L80.9175 9.81289L79.5668 9.64523L78.1163 9.5466L76.7657 9.37894L75.3779 9.37118L74.0273 9.20352L72.6394 9.19576L71.1889 9.09714L69.8011 9.08938L68.3224 9.14439L66.8719 9.04577L65.3932 9.10078L64.0054 9.09302L62.5267 9.14803L61.0481 9.20303L59.5694 9.25804L57.9999 9.3758L56.5212 9.43082L54.9517 9.54858L53.473 9.60359L51.9662 9.81222L50.3967 9.93L48.8272 10.0478L47.2295 10.3192L45.66 10.4369L44.0533 10.7146L42.4838 10.8324L40.8861 11.1038L39.2794 11.3814L37.619 11.562L35.9215 11.9024L34.3238 12.1738L32.6262 12.5143L31.0195 12.7919L29.3219 13.1324L27.6244 13.4728L25.9268 13.8133L24.2292 14.1537L22.7006 14.525L25.0368 24.4943L7.75516e-06 17.5888L19.2845 4.72727e-05L21.6208 9.96934L23.1493 9.59799L24.9378 9.19478L26.6354 8.85435L28.4238 8.45113L30.1214 8.11071L31.819 7.77026L33.5793 7.52069L35.177 7.24929L36.8745 6.90886L38.544 6.72204L40.1416 6.45065L41.8392 6.1102L43.5087 5.9234L45.0782 5.80563L46.6759 5.53424L48.3453 5.34742L49.9149 5.22965L51.4844 5.11188L53.1539 4.92507L54.6606 4.71644L56.2929 4.68953L57.7716 4.63453L59.3411 4.51676L60.8198 4.46175L62.3893 4.34397L63.9308 4.37984L65.4094 4.32483L66.8881 4.26983L68.4295 4.30568L69.8801 4.40431L71.3587 4.3493L72.8093 4.44792L74.2599 4.54654L75.8013 4.5824L77.0892 4.6592L78.5397 4.75782L79.9903 4.85644L81.5036 5.04593L82.8542 5.21359L84.2139 5.37497L85.5645 5.54264L86.9779 5.80115L88.3285 5.96883L89.7573 6.23015L91.017 6.46059L92.4304 6.71911L93.7529 7.0404L95.0127 7.27082L96.3352 7.59211L97.6577 7.9134L98.9802 8.23469L100.303 8.55599L101.603 9.03999L102.835 9.42404L104.158 9.74533L105.389 10.1294L106.69 10.6134L107.831 11.0602L109.131 11.5442L110.341 12.091L111.573 12.475L112.783 13.0218L113.993 13.5686L115.202 14.1153L116.412 14.6621L117.622 15.2089L118.732 15.8247L119.904 16.5314L121.114 17.0781L122.224 17.6939L123.406 18.3943L124.516 19.0101L125.598 19.7796L126.77 20.4862L127.852 21.2557L128.962 21.8715L130.044 22.6409L131.125 23.4104L132.207 24.1798L133.261 25.1028L134.343 25.8723L135.334 26.7045L136.415 27.4739L137.469 28.397L138.46 29.2292L139.514 30.1522L140.567 31.0753L141.527 32.0765L142.518 32.9087L143.481 33.8945L144.444 34.8804L145.407 35.8662L146.432 36.9429L147.395 37.9287L148.364 38.9236L149.227 39.9785L150.252 41.0552L151.115 42.11L152.041 43.2558L152.973 44.4106L153.898 45.5563L154.761 46.6112L155.602 47.8288L156.528 48.9745L161.687 56.4436L162.5 57.8148L163.313 59.186L164.148 60.3945L164.961 61.7657L165.774 63.1369L166.587 64.5081L167.3 65.9483L168.112 67.3196L168.897 68.8444L169.71 70.2156L170.423 71.6559L171.199 73.187L171.975 74.7181L172.688 76.1583L173.463 77.6895L174.148 79.2833L174.833 80.8772L174.802 80.8716Z" fill="#282E78"/>
</svg>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>

                    <div class="image-wrapper">
                        <?php if( $health_image ): ?>
                            <img 
                                src="<?php echo esc_url($health_image); ?>" 
                            >
                        <?php endif; ?>
                    </div>


                    <div class="ph-column right">
                        <?php $i = 0; ?>
                        <?php while( have_rows('health_monitoring_values') ): the_row(); $i++; ?>
                            <?php if( $i % 2 == 0 ): ?>
                                
                                <div class="ph-item">
                                     <h3><img src="<?php the_sub_field('color'); ?>" > <span><?php the_sub_field('title'); ?></span></h3>
                                    <h5><?php the_sub_field('subtitle'); ?></h5>
                                    <p><?php the_sub_field('description'); ?></p>
                                    <svg width="186" height="51" viewBox="0 0 186 51" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.59508 46.8038C-0.243412 47.752 -0.19843 49.2753 0.746856 50.1082C1.75967 51.0274 3.21753 50.8888 4.1582 49.8746L5.26563 48.716L6.39227 47.4032L7.49969 46.2446L8.69387 45.0182L9.8013 43.8596L10.9087 42.701L12.0161 41.5424L13.1979 40.4788L14.3053 39.3202L15.487 38.2565L16.5944 37.0979L17.6807 36.109L18.8624 35.0453L20.0162 34.1427L21.1979 33.079L22.2929 32.0833L23.4467 31.1806L24.533 30.1916L29.1656 26.5674L30.3002 25.8189L31.454 24.9163L32.5886 24.1678L33.7424 23.2652L34.877 22.5167L36.0202 21.7614L37.2416 20.9451L38.3762 20.1966L39.5937 19.5363L40.7283 18.7879L41.8504 18.2022L43.0593 17.5487L44.1939 16.8002L45.316 16.2146L46.6011 15.6406L47.7232 15.055L48.9321 14.4014L50.1218 13.9021L51.2439 13.3165L52.4336 12.8171L53.6232 12.3178L54.8129 11.8185L56.0025 11.3192L57.1922 10.8198L58.3626 10.4747L59.5523 9.97538L60.7227 9.63024L61.9799 9.21725L63.1503 8.87211L64.4075 8.4591L65.5779 8.11397L66.7484 7.76884L67.9863 7.51003L69.2243 7.2512L70.3947 6.90608L71.6327 6.64727L72.8707 6.38844L74.1086 6.12964L75.3254 6.04044L76.5634 5.78161L77.7059 5.59746L79.0182 5.4336L80.235 5.3444L81.5473 5.18054L82.7641 5.09134L83.9809 5.00212L85.1977 4.91293L86.4908 4.90326L87.7076 4.81405L88.9919 4.81117L90.2763 4.80829L91.5693 4.79862L92.8537 4.79574L94.0513 4.86073L95.4031 4.94417L96.6007 5.00915L97.9613 5.0858L99.2264 5.23712L100.578 5.32055L101.843 5.47186L103.109 5.62317L104.374 5.77447L105.8 5.95287L107.065 6.10417L108.398 6.3418L109.644 6.6473L110.983 6.89356L112.316 7.1312L113.723 7.46377L115.055 7.7014L116.375 8.10185L117.708 8.33949L119.028 8.73994L120.435 9.07252L121.755 9.47297L123.143 9.95975L124.55 10.2923L125.938 10.7791L127.258 11.1795L128.646 11.6663L130.034 12.1531L131.421 12.6399L132.877 13.213L134.264 13.6997L135.719 14.2728L137.107 14.7596L138.476 15.4006L139.931 15.9737L141.386 16.5468L142.822 17.274L144.278 17.8471L145.72 18.5831L147.176 19.1561L148.612 19.8834L150.054 20.6193L151.577 21.2788L153.087 22.101L154.524 22.8283L156.034 23.6505L157.477 24.3864L158.987 25.2087L160.497 26.0309L162.008 26.8532L163.518 27.6754L164.859 28.4773L159.661 37.2607L185.5 38.0584L172.443 15.6838L167.245 24.4672L165.905 23.6652L164.327 22.7567L162.817 21.9344L161.239 21.0259L159.728 20.2036L158.218 19.3814L156.621 18.627L155.185 17.8997L153.675 17.0775L152.145 16.4094L150.709 15.6822L149.199 14.8599L147.669 14.1919L146.214 13.6188L144.778 12.8915L143.248 12.2234L141.793 11.6504L140.338 11.0773L138.808 10.4092L137.44 9.76824L135.898 9.26302L134.51 8.77625L133.055 8.20316L131.667 7.71638L130.212 7.14328L128.737 6.72438L127.35 6.23761L125.962 5.75084L124.487 5.33193L123.08 4.99935L121.693 4.51258L120.286 4.18L118.879 3.84741L117.404 3.42851L116.158 3.12302L114.751 2.79042L113.345 2.45785L111.851 2.19313L110.518 1.9555L109.179 1.70924L107.846 1.47161L106.427 1.30185L105.094 1.06422L103.659 0.892612L102.394 0.74131L100.975 0.571551L99.6227 0.488113L98.3576 0.3368L97.0057 0.253367L95.6538 0.169927L94.3019 0.086489L92.95 0.00304946L91.5703 0.0805873L90.2859 0.0834624L88.934 3.35936e-05L87.6497 0.00290872L86.2699 0.0804466L85.0531 0.169658L83.6733 0.24719L82.361 0.411052L81.0767 0.413931L79.7644 0.577795L78.4522 0.741652L77.1399 0.905508L75.8277 1.06937L74.5154 1.23323L73.2775 1.49204L71.9528 1.81873L70.6405 1.98259L69.4025 2.24139L68.0711 2.55945L66.8331 2.81826L65.5759 3.23127L64.2512 3.55795L62.994 3.97095L61.7561 4.22977L60.4989 4.64277L59.2417 5.05577L57.9845 5.46877L56.7081 6.03598L55.4509 6.44897L54.2613 6.9483L53.0041 7.3613L51.7277 7.9285L50.538 8.42783L49.2616 8.99501L47.9852 9.56221L46.7744 10.2311L45.5847 10.7305L44.3759 11.384L43.167 12.0375L41.9581 12.691L40.6625 13.4124L39.4536 14.0659L38.2361 14.7262L37.1015 15.4747L35.8058 16.1961L34.6712 16.9445L33.4499 17.7609L32.2199 18.584L30.9985 19.4003L29.8639 20.1488L28.7015 21.0582L27.4801 21.8746L20.349 27.4534L19.1673 28.5171L17.9856 29.5807L16.8318 30.4834L15.6501 31.547L14.4684 32.6106L13.2867 33.6743L12.1792 34.8329L10.9975 35.8965L9.79661 37.1143L8.6149 38.178L7.50747 39.3365L6.31329 40.563L5.11911 41.7895L4.01169 42.9481L2.81751 44.1745L1.69087 45.4873L0.564218 46.8001L0.59508 46.8038Z" fill="#282E78"/>
</svg>

                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <?php } ?>
</div>
                    <?php endif; ?>

        </div>
    </div>
</section>