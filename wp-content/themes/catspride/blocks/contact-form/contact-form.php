<?php 
/*
* Block Name: Contact Form
* Post Type: page 
*/

if( isset( $block['data']['preview_image_help'] )  ) :
    echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
else: ?>

    <section class="contact-form-wrapper">
        <div class="container">
        <p><br><br>
          <!-- <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script><br>
<script data-hubspot-rendered="true">
  hbspt.forms.create({
    region: "na1",
    portalId: "44089268",
    formId: "827d90ce-cb5a-4717-8987-1b467cc09469"
  });
</script> -->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/embed/v2.js"></script>
<script>
  hbspt.forms.create({
    portalId: "44089268",
    formId: "25d7b101-6b70-48a2-aa08-529338ac1908",
    region: "na1"
  });
</script>


</p>
        </div>
    </section><!-- .contact-form-wrapper-->
    
<?php endif; ?>