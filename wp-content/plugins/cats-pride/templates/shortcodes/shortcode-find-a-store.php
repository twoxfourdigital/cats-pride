<div class="find-a-store">
<?php if ( $show_title === true ) : ?>
    <div class="x-sm bk-dark-blue pam x-1-1 <?php echo $header_column_class; ?>" style="padding: 0px;">
        <h2 class="h-custom-headline cs-ta-center w-700 <?php echo esc_attr( $header_class ); ?> man h3">
            <span><?php _e('Find a Store', 'catspride'); ?></span>
        </h2>
    </div>
<?php endif; ?>
<div class="gform_wrapper gf_simple_horizontal_wrapper cp_find_a_store <?php echo esc_attr( $main_class ); ?>">
    <form method="POST" enctype="multipart/form-data" class="gf_simple_horizontal" action="<?php echo get_permalink( get_page_by_path( 'store-locator' ) ); ?>">
        <div class="gform_body">
            <ul class="gform_fields top_label form_sublabel_below description_below">
                <li class="gfield gf_inline gfield_contains_required field_sublabel_below field_description_below hidden_label gfield_visibility_visible">
                    <label class="gfield_label" for="input_1_1">Zip Code<span class="gfield_required">*</span></label>
                    <div class="ginput_container ginput_container_zipcode">
                        <input name="zip_code" required type="text" value="" class="large" placeholder="<?php _e('Zip code', 'catspride'); ?>" aria-required="true" aria-invalid="false" />
                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
                    </div>
                </li>
            </ul>
        </div>
        <div class="gform_footer top_label">
            <?php wp_nonce_field( 'catspride-store_locator' ); ?>
            <input type="hidden" name="action" value="store_locator" />
            <input type="submit" class="gform_button button" value="Find a Store">
        </div>
    </form>
</div>
</div>
