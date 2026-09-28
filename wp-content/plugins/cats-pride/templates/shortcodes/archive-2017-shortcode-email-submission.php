<?php if ( $show_title === true ) : ?>
	<h2 class="h-custom-headline tt-upper h3"><span>Join the <br><strong>Cat's Pride Club.</strong></span></h2>
<?php endif; ?>
<?php if ( $show_subtitle === true ) : ?>
	<div class="x-text man mbm">
    	<p><?php _e('Members get exclusive access to coupons and offers, and can help give back to local shelters.', 'catspride'); ?></p>
	</div>
<?php endif; ?>
<div class="gform_wrapper gf_simple_horizontal_wrapper">
    <form method="GET" enctype="multipart/form-data" class="gf_simple_horizontal" action="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
        <div class="gform_body">
            <ul class="gform_fields top_label form_sublabel_below description_below">
                <li class="gfield gf_inline gfield_contains_required field_sublabel_below field_description_below hidden_label gfield_visibility_visible">
                    <label class="gfield_label" for="input_1_1">Email<span class="gfield_required">*</span></label>
                    <div class="ginput_container ginput_container_email">
                        <input name="username" type="text" value="" class="large" placeholder="<?php _e('Email address', 'catspride'); ?>" aria-required="true" aria-invalid="false" />
                        <input type="hidden" name="tab" value="register" />
                    </div>
                </li>
            </ul>
        </div>
        <div class="gform_footer top_label">
            <input type="submit" class="gform_button button" value="Submit">
        </div>
    </form>
</div>