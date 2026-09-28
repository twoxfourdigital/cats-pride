<?php

if ( function_exists( 'wc_print_notices' ) ) {
    wc_print_notices();
}

if ( isset( $response ) && !empty( $response ) && $stores === false && current_user_can( 'administrator' ) ) {
    echo '<div style="border: 2px solid #eb5439;color: #eb5439;padding:20px;margin-bottom:30px;">
            <p><strong>You are seeing this because you are logged in as an admin.</strong></p>
            <textarea style="width:500px;height:150px;">' . $response . '</textarea>
          </div>';
}

?>


<form class="catspride-StoreLocatorForm edit-shelter" 
      action="<?php echo get_permalink(get_page_by_path('store-locator')); ?>" 
      method="post"
      style="width:100%; display:flex; justify-content:center; margin-top:30px; flex-direction: column;">

    <?php do_action('catspride_store_locator_form_start'); ?>

    <div style="
        width:100%; 
        max-width:900px; 
        display:grid; 
        grid-template-columns:1fr 1fr; 
        grid-column-gap:30px; 
        grid-row-gap:25px;
    ">

        <!-- Select Type -->
        <div>
            <select 
                name="product_type" 
                id="product_type"
                style="width:100%; height:40px; padding:0 10px; border:1px solid #ccc; border-radius:4px;">
                <option value="">Select Type</option>
                <option value="clumping" <?php selected($product_type,'clumping') ?>>Clumping</option>
                <option value="non-clumping" <?php selected($product_type,'non-clumping') ?>>Non-Clumping</option>
                <option value="crystals" <?php selected($product_type,'crystals') ?>>Crystals</option>
                <option value="accessories" <?php selected($product_type,'accessories') ?>>Accessories</option>
            </select>
        </div>

        <!-- Select Product -->
        
        <div>
            <select 
                name="item_id" 
                id="item_id"
                style="width:100%; height:40px; padding:0 10px; border:1px solid #ccc; border-radius:4px;">
                <option value="">Select Product</option>
            </select>
        </div>

        <!-- Zip Field -->
        <div style="grid-column:1 / 2;">
            <input 
                type="text" 
                required 
                name="zip_code" 
                id="zip_code" 
                placeholder="Enter Zip Code..."
                value="<?php echo esc_attr($zip_code); ?>"
                style="width:100%; height:40px; padding:0 10px; border:1px solid #ccc; border-radius:4px;">
        </div>



        <!-- Search Button -->
        <div style="
            grid-column:2 / 3; 
            align-items:center;
        ">
            <input 
                type="submit" 
                class="catspride-Button button"
                name="store_locator" 
                value="<?php esc_attr_e('Search', 'catspride'); ?>"
                >
            <?php wp_nonce_field('catspride-store_locator'); ?>
            <input type="hidden" name="action" value="store_locator" />
        </div>

    </div>

    <?php do_action('catspride_store_locator_form'); ?>

    <hr>
    <div class="x-container-store-locator-results">

        <?php if( isset( $_POST['item_id'] ) && $_POST['item_id'] != '0' && isset( $_REQUEST['zip_code'] ) && isset( $stores ) ) {

        /*
         * Output params
         */
        $columns = 3;
        $loop = 0;
        $total_stores = count( $stores );

        if( is_array( $stores ) && $total_stores > 0 ) {

            ?>

            <p><?php _e('Showing results within 25 miles of <strong>' . $_REQUEST['zip_code'] . '</strong>', 'catspride'); ?></p>

            <?php

            foreach($stores as $store) {

                if($loop % $columns === 0) { ?>
                    <div class="x-container-item">
                <?php }

                $address = $store['address'] . ' ' . ( ( !empty( $store['address2'] ) ) ? $store['address2'] . ' ' : '' ) . '<br>' . $store['city'] . ', ' . $store['state'] . ' ' . $store['zip'];

                ?>

                <div class="x-column x-sm x-1-<?php echo $columns; ?> catspride-StoreLocator-single bk-blue bb-blue colorbox">
                    <h4 class="h-custom-headline white tt-upper h3"><?php echo $store['name']; ?></h4>
                    <div class="x-text mbm white w-300">
                    <p>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($address);?>" title="<?php _e('Get Directions', 'catspride');?>" target="_blank">
                            <?php echo $address; ?>
                        </a>
                    </p>
                    <p>
                        <a href="tel:<?php echo preg_replace('/\D/', '', $store['phone']); ?>" title="<?php _e('Call Store', 'catspride');?>" target="_blank">
                            <?php echo $store['phone']; ?>
                        </a>
                    </p>
		        	</div>
                    <a class="x-btn blue-rev mtm catspride-StoreLocator-button" href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($address);?>" title="<?php _e('Get Directions', 'catspride');?>" target="_blank">
                        <?php _e('Get Directions', 'catspride'); ?>
                    </a>
                </div>

                <?php $loop++; ?>

                <?php if($loop % $columns === 0 || $loop === $total_stores) { ?>
                    </div>
                <?php } ?>

            <?php }

        } ?>

    <?php } ?>

    </div>

    <?php do_action( 'catspride_store_locator_form_end' ); ?>

</form>




<style>
	.x-container-item{
        display: flex;
    	justify-content: center;
        flex-wrap: wrap;
        gap: 20px;

    }

    .x-container-store-locator-results {
    display: flex;
    flex-direction: column;
    justify-content: center;

    p{
        text-align: center;
        margin-bottom: 20px;
    }
}

html body .x-btn.blue-rev, html body .button.blue-rev, html body [type="submit"].blue-rev {
    color: #009fd4;
    background-color: #fff;
    border: 2px solid #fff;
    padding: 20px;
}

html body .x-btn, html body .button, html body [type="submit"], html body .x-btn a {
font-family:Montserrat-Bold;   
 text-transform: uppercase;
    cursor: pointer;
    font-weight: 700;
    padding: 0 35px;
    white-space: nowrap;
    line-height: 50px;
    text-align: center;
    vertical-align: middle;
    border-width: 2px;
    border-radius: 100em;
    text-decoration: none !important;
    -webkit-box-shadow: 0 2px 11px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 11px 0 rgba(0, 0, 0, 0.2);
}

.mbm{
    margin-bottom: 40px !important;
}

</style>


<script>
const products = <?php 
$acf_products = get_field('product_groups', 'option');
$products_js = [
    'clumping' => [],
    'non-clumping' => [],
    'crystals' => [],
    'accessories' => [],
];

if($acf_products) {
    foreach($acf_products as $group) {
        $cat = $group['category'] ?? '';
        if(!isset($products_js[$cat])) $products_js[$cat] = [];

        if(!empty($group['products'])) {
            foreach($group['products'] as $p_json) {
                $p_data = json_decode($p_json, true);
                if($p_data){
                    $products_js[$cat][] = [
                        'id'    => $p_data['id'] ?? $p_data['key'],
                        'key'   => $p_data['key'] ?? ($p_data['id'] ?? ''),
                        'value' => $p_data['value'] ?? $p_data['key'],
                    ];
                }
            }
        }
    }
}

echo json_encode($products_js, JSON_UNESCAPED_UNICODE);
?>;

const productTypeSelect = document.getElementById('product_type');
const itemSelect        = document.getElementById('item_id');

function populateProducts(type, selectedItem = '') {
    itemSelect.innerHTML = '<option value="">Select Product</option>';

    let list = [];

    if(type && products[type]) {
        list = products[type];
    } else {
        Object.values(products).forEach(arr => {
            list = list.concat(arr);
        });
    }

    list.forEach(p => {
        const opt = document.createElement('option');
        // Send the product key (UPC) directly. The `id` is not unique across
        // products, so resolving id->key server-side returned the wrong item.
        opt.value = p.key || p.id;
        opt.textContent = p.value;
        if(opt.value === selectedItem) opt.selected = true;
        itemSelect.appendChild(opt);
    });
}

populateProducts('<?php echo esc_js($product_type); ?>', '<?php echo esc_js($item_id); ?>');

productTypeSelect.addEventListener('change', function() {
    populateProducts(this.value);
});
</script>