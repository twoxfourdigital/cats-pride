<?php

// Include Files

require_once get_template_directory() . '/includes/woo_tabs.php';

// Init Filter 

use App\Filter\Filter;

Filter::init();

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));
}

function register_my_menus()
{
    register_nav_menus(
        array(
            'footer-menu-one' => __('Footer Menu 01'),
            'footer-menu-two' => __('Footer Menu 02')
        )
    );
}
add_action('init', 'register_my_menus');


add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
    function loop_columns()
    {
        return 2;
    }
}


add_action('after_setup_theme', 'woo_support');

function woo_support()
{
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

/**
 * Retrieve the full list of products and BazaarVoice IDs associated with those products
 */

function get_product_bv_ids()
{
    global $wpdb;

    $products = maybe_unserialize(get_transient('cp_bazaarvoice_products'));

    if ($products === false) {

        $query = "SELECT p.ID as product_id, 
                         pm.meta_value as external_product_id
                  FROM {$wpdb->posts} p 
                  INNER JOIN {$wpdb->postmeta} pm 
                    ON (p.ID = pm.post_id AND pm.meta_key = 'bazaarvoice_product_id' AND pm.meta_value != '')
                  WHERE p.post_type = 'product' AND p.post_status = 'publish'";

        $results = $wpdb->get_results($query, ARRAY_A);
        $products = array();

        foreach ($results as $product) {
            $products[$product['product_id']] = $product['external_product_id'];
        }

        // Save for an hour
        set_transient('cp_bazaarvoice_products', $products, 60 * 60);
    }

    return $products;
}

// Remove Woo Breadcrumps 

add_action('init', 'woo_remove_breadcrumbs');

function woo_remove_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

// Remove Single product sidebar

add_action('wp', 'woo_remove_sidebar_product_pages');

function woo_remove_sidebar_product_pages()
{
    if (is_product()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}


//require get_template_directory() . '/catspride-functions/cats-pride.php';

// Allow all HTML tags and attributes in ACF WYSIWYG
function allow_all_tags_in_acf_wysiwyg($init)
{
    // Remove the WordPress default filters that strip unwanted tags
    $init['valid_elements'] = '*[*]';
    $init['extended_valid_elements'] = '*[*]';
    $init['valid_children'] = '+body[style|script|iframe|*],+*[*]';

    // Disable the internal format validation
    $init['verify_html'] = false;

    return $init;
}
add_filter('tiny_mce_before_init', 'allow_all_tags_in_acf_wysiwyg');

if( !function_exists('cp_register_product_settings_fields') ) :

function cp_register_product_settings_fields() {

    if( function_exists('acf_add_local_field_group') ) {

        /**
         * ----------------------------------------------------
         *  1) CUSTOM PRODUCTS (Admin manually added)
         * ----------------------------------------------------
         */
        acf_add_local_field_group(array(
            'key' => 'group_cp_dynamic_products_admin',
            'title' => 'Store Locator Add new Product',
            'fields' => array(
                array(
                    'key' => 'field_cp_custom_products',
                    'label' => 'Custom Products',
                    'name' => 'custom_products',
                    'type' => 'repeater',
                    'button_label' => 'Add Product',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_cp_custom_key',
                            'label' => 'Key',
                            'name' => 'key',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_cp_custom_id',
                            'label' => 'ID',
                            'name' => 'id',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_cp_custom_value',
                            'label' => 'Value',
                            'name' => 'value',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_cp_custom_category',
                            'label' => 'Category',
                            'name' => 'category',
                            'type' => 'select',
                            'choices' => array(
                                'clumping' => 'Clumping',
                                'non-clumping' => 'Non-Clumping',
                                'crystals' => 'Crystals',
                                'accessories' => 'Accessories',
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-general-settings',
                    ),
                ),
            ),
        ));


        /**
         * ----------------------------------------------------
         *  2) STATIC PRODUCTS (your hardcoded lists)
         * ----------------------------------------------------
         */
          $products_array = array(

            'clumping' => [
                  ['key' => '4178847115', 'id' => 'CPFRESHLIGHT_9', 'value' => 'Max Power: Total Odor Control Scented 15lb Jug'],
                  ['key' => '4178847122', 'id' => 'CPFRESHLIGHT', 'value' => 'Max Power: Total Odor Control Scented 24lb Bag'],
                  ['key' => '4178847215', 'id' => 'CPFRESHLIGHT_8', 'value' => 'Max Power: Total Odor Control Unscented 15lb Jug'],
                  ['key' => '4178847222', 'id' => 'CPFRESHLIGHT', 'value' => 'Max Power: Total Odor Control Unscented 24lb Bag'],
                  ['key' => '4178847415', 'id' => 'CPFRESHLIGHT_11', 'value' => 'Max Power: Bacterial Odor Control Scented 15lb Jug'],
                  ['key' => '4178847315', 'id' => 'CPFRESHLIGHT_10', 'value' => 'Max Power: Natural Care Unscented 15lb Jug'],
                  ['key' => '4178801455', 'id' => 'CPFRESHLIGHT_13', 'value' => 'Max Power: UltraClean Scented 15lb Jug'],
                  ['key' => '4178801485', 'id' => 'CPFRESHLIGHT_14', 'value' => 'Max Power: UltraClean Unscented 15lb Jug'],
                  ['key' => '4178847515', 'id' => 'CPFRESHLIGHT_12', 'value' => 'Max Power: Triple Odor Guard Unscented 15lb Jug'],
                  ['key' => '4178847526', 'id' => 'CPFRESHLIGHT', 'value' => "Cat's Pride Triple Odor Guard Unscented 26lb Pail"],
                  ['id' => 'CPFRESHLIGHT', 'key' => '4178847519', 'value' => "Max Power Pro Total Odor Control Scented 19lb Bag"],
                  ['id' => 'CPFRESHLIGHT', 'key' => '4178847719', 'value' => "Max Power Pro Total Odor Control Unscented 19lb Bag"],
                  ['id' => 'CPFRESHLIGHT', 'key' => '4178801419', 'value' => "Max Power Pro Ultraclean Unscented 19lb Bag"],
                  ['key' => '4178801993', 'id' => 'CPLIGHTSCOOP_9', 'value' => 'Antibacterial Scented 12lb Jug'],
                  ['key' => '4178801998', 'id' => 'CPFRESHLIGHTULT', 'value' => 'Antibacterial Scented 18lb Bag'],
                  ['key' => '4178847710', 'id' => 'CPFRESHLIGHTULT_2', 'value' => 'Complete Care Unscented 10lb Jug'],
                  ['key' => '4178847716', 'id' => 'CPFRESHLIGHTULT', 'value' => 'Complete Care Unscented 18lb Bag'],
                  ['key' => '4178847510', 'id' => 'CPFRESHLIGHTULT_1', 'value' => 'Pure & Fresh Scented 10lb Jug'],
                  ['key' => '4178847516', 'id' => 'CPFRESHLIGHTULT', 'value' => 'Pure & Fresh Scented 18lb Bag'],
                  ['key' => '4178801945', 'id' => 'CPLIGHTSCOOP_5', 'value' => 'Baking Soda Scented 10lb Jug'],
                  ['key' => '4178801325', 'id' => 'CPLIGHTSCOOP_13', 'value' => 'Baking Soda Unscented 10lb Jug'],
                  ['key' => '4178801942', 'id' => 'CPLIGHTSCOOP_2', 'value' => 'Easy Scoop Scented 10lb Jug'],
                  [ 'key' => '4178801947', 'id' => 'CPLIGHTSCOOP_1', 'value' => 'Flushable Scented 10lb Jug'],
                  ['key' => '4178801917', 'id' => 'CPLIGHTSCOOP_12', 'value' => 'Flushable Scented 17.5lb Pail'],
                  ['key' => '4178801310', 'id' => 'CPLIGHTSCOOP_6', 'value' => 'Natural Unscented 10lb Jug'],
                  [ 'key' => '4178801933', 'id' => 'CPSCOOP_1', 'value' => 'Scoopable 12lb Jug'],
                  ['key' => '4178801952',  'id' => 'CPSCOOP', 'value' => "Cat's Pride Scoopable Scented 20lb Pail"],
                  [ 'key' => '4178801910', 'id' => 'CPSCOOP', 'value' => "Cat's Pride Scoopable Scented 10lb Bag" ],
                  ['key' => '4178801924', 'id' => 'CPSCOOP_2', 'value' => 'Scoopable 20lb Bag'],
                  ['key' => '4178801323', 'id' => 'CPLIGHTSCOOP_3', 'value' => 'Unscented 10lb Jug'],
            ],

            'non-clumping' => [
                 [ 'key' => '4178801610', 'id' => 'CPLIGHTSCOOP_7', 'value' => 'Cat’s Pride Fresh & Clean 10lb Bag'],
                 ['key' => '4178801620', 'id' => 'CPLIGHTSCOOP_8', 'value' => 'Cat’s Pride Fresh & Clean 20lb Bag'],
                 [ 'key' => '4178801510', 'id' => 'CPNATURAL_1', 'value' => 'Cat’s Pride Natural 10lb Bag' ],
                 ['key' => '4178801220', 'id' => 'CPNATURAL_2', 'value' => 'Cat’s Pride Natural 20lb Bag'],
                 ['key' => '4178802620', 'id' => 'CPMULTICAT_1', 'value' => 'Cat’s Pride Complete Multi-Cat 20lb Bag'],
                 ['key' => '4178801605', 'id' => 'CPKATKIT_1', 'value' => 'Cat’s Pride KatKit Disposable Tray with Litter'],
            ],

            'crystals' => [
                 ['key' => '4178857006', 'id' => 'CPMICROCRYSTALSS', 'value' => "Cat's Pride Micro Crystals Scented 6.5lb Bag"],
                 ['key' => '4178857106', 'id' => 'CPMICROCRYSTALSUS', 'value' => "Cat's Pride Micro Crystals Unscented 6.5lb Bag"],
                 ['id' => 'CPCRYSTAL',    'key' => '4178857905', 'value' => "Cat's Pride Health Monitor Crystals Unscented 5lb Bag"],
                 ['key' => '4178857005',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Total Odor Control Micro Crystals Fresh Scent 5lb Bag"],
                 ['key' => '4178857105',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Total Odor Control Micro Crystals Unscented 5lb Bag"],
                 ['key' => '4178857707',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride UltraClean Low Tracking Crystals Unscented 5lb Bag"],
                 ['id' => 'UPCRYSTAL',    'key' => '3384387035', 'value' => 'Ultra Health Monitor Crystals Unscented 5lb Bag'],
                 ['key' => '3384385045', 'id' => 'UPCRYSTAL_3', 'value' => 'Ultra Fresh Micro Crystals Scented 5lb Bag'],
                 ['key' => '3384385050', 'id' => 'UPCRYSTAL_1', 'value' => 'Ultra Micro Crystals Unscented 5lb Bag'],
                 ['key' => '3384385300', 'id' => 'UPCRYSTAL_2', 'value' => 'Ultra Clumping Crystals Unscented  5lb Bag'],
                 ['key' => '3384385065', 'id' => 'UPCRYSTAL', 'value' => 'Ultra Pearls Crystals Unscented 5lb Bag'],
                 ['key' => '3384385055', 'id' => 'UPCRYSTAL_4', 'value' => 'Ultra Probiotic Micro Crystals Unscented 5lb Bag'],
                 ['key' => '3384385047', 'id' => 'UPCRYSTAL_5', 'value' => 'Ultra Max Probiotic Odor-Eliminating Additive 17.6oz Bag'],
            ],

            'accessories' => [
                  ['key' => '4178800615', 'id' => 'CPLINERS_1', 'value' => "Cat's Pride Unscented Liners 15ct"],
                ['id' => 'JCLINERS',     'key' => '4133400165', 'value' => "Jonny Cat Large Unscented Liners 15ct"],
                [ 'key' => '4133400154', 'id' => 'JCLINERS_3', 'value' => "Jonny Cat Jumbo Unscented Liners 5ct"],
                ['key' => '4133400150', 'id' => 'JCLINERS_6', 'value' => 'Jonny Cat Jumbo Unscented Liners 15ct'],
                ['key' => '4133400157', 'id' => 'JCLINERS_4', 'value' => 'Jonny Cat Jumbo Scented Liners 7ct'],
                ['id' => 'JCLINERS_2',     'key' => '4133400166', 'value' => "Jonny Cat Jumbo Scented Liners 15 Ct"],
                ['id' => 'JCLINERS_1',     'key' => '4133400167', 'value' => "Jonny Cat Super Unscented Liners 15ct"],
            ],

        );


        /**
         * ----------------------------------------------------
         *  3) BUILD CHOICES FOR ACF (JSON VALUE)
         * ----------------------------------------------------
         */

        $all_choices = [];

        // Static products
        foreach($products_array as $cat_choices){
            foreach($cat_choices as $p){

                if (empty($p['key']) || empty($p['value'])) continue;

                $encoded = json_encode([
                    'key'   => $p['key'],
                    'id'    => $p['id'],
                    'value' => $p['value'],
                ], JSON_UNESCAPED_UNICODE);

                $all_choices[$encoded] = $p['value'];
            }
        }

        // Custom products
        $custom_products = get_field('custom_products', 'option');
        if($custom_products){
            foreach($custom_products as $p){

                if (empty($p['key']) || empty($p['value'])) continue;

                $encoded = json_encode([
                    'key'   => $p['key'],
                    'id'    => $p['id'],
                    'value' => $p['value'],
                ], JSON_UNESCAPED_UNICODE);

                $all_choices[$encoded] = $p['value'];
            }
        }


        /**
         * ----------------------------------------------------
         *  4) PRODUCT CATEGORY ASSIGNMENTS
         * ----------------------------------------------------
         */
        acf_add_local_field_group(array(
            'key' => 'group_cp_dynamic_product_groups',
            'title' => 'Store Locator Product Category Assignments',
            'fields' => array(
                array(
                    'key' => 'field_cp_product_groups',
                    'label' => 'Product Groups',
                    'name' => 'product_groups',
                    'type' => 'repeater',
                    'layout' => 'row',
                    'button_label' => 'Add Category',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_cp_category',
                            'label' => 'Category',
                            'name' => 'category',
                            'type' => 'select',
                            'choices' => array(
                                'clumping' => 'Clumping',
                                'non-clumping' => 'Non-Clumping',
                                'crystals' => 'Crystals',
                                'accessories' => 'Accessories',
                            ),
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_cp_products',
                            'label' => 'Products',
                            'name' => 'products',
                            'type' => 'select',
                            'choices' => $all_choices,
                            'allow_null' => 0,
                            'multiple' => 1,
                            'ui' => 1,
                            'return_format' => 'value', // ← VRATI JSON STRING
                            'instructions' => 'Select one or multiple products. Use search to find them quickly.',
                            'wrapper' => array(
                                'width' => '100%',
                            ),
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'theme-general-settings',
                    ),
                ),
            ),
        ));

    }

}

add_action('acf/init', 'cp_register_product_settings_fields');

endif;


if( !function_exists('cp_register_image_hero_fields') ) :

function cp_register_image_hero_fields() {

    if( function_exists('acf_add_local_field_group') ) {

        acf_add_local_field_group(array(
            'key' => 'group_cp_image_hero',
            'title' => 'Block: Image Hero',
            'fields' => array(
                array(
                    'key' => 'field_cp_image_hero_desktop',
                    'label' => 'Desktop Image',
                    'name' => 'desktop_image',
                    'type' => 'image',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_cp_image_hero_mobile',
                    'label' => 'Mobile Image',
                    'name' => 'mobile_image',
                    'type' => 'image',
                    'return_format' => 'id',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'instructions' => 'Shown on screens up to 767px wide. Falls back to the desktop image if empty.',
                ),
                array(
                    'key' => 'field_cp_image_hero_link',
                    'label' => 'Link',
                    'name' => 'link',
                    'type' => 'link',
                    'return_format' => 'array',
                    'instructions' => 'Optional. Wraps the whole section in a link.',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/image-hero',
                    ),
                ),
            ),
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ));

    }

}

add_action('acf/init', 'cp_register_image_hero_fields');

endif;