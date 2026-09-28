<?php

/**
 * Return an array of the product codes used for store locator lookups
 *
 * @return array
 */
function cp_get_store_locator_products() {

                $products_array = [[ 'key' => 'ALLPROD', 'id' => 'ALLPROD', 'value' => __('All Products', 'catspride') ]];

                $args = array(
                    'post_type'      => 'product',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1,
                );
                
                $query = new WP_Query($args);
                
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $product = wc_get_product( get_the_ID() );

                        $product_name = $product->get_name();
                        $product_title = get_field('store_locator_product_title',get_the_ID());

                         if($product_title==''){
                            $product_name = $product_name;
                         }else{
                            $product_name = $product_title;
                         }
                        


                        $products_array[] = [
                            'key' => get_field('store_locator_product_key',get_the_ID()),
                            'id' => get_field('store_locator_product_id',get_the_ID()),
                            'value' => $product_name,
                        ];
                    }
                    wp_reset_postdata();
                }
                
                // all

                // $products_array[] = ['key' => '4178847115', 'id' => 'CPFRESHLIGHT_9', 'value' => 'Max Power: Total Odor Control Scented 15lb Jug'];
                // $products_array[] = ['key' => '4178847122', 'id' => 'CPFRESHLIGHT', 'value' => 'Max Power: Total Odor Control Scented 24lb Bag'];
                // $products_array[] = ['key' => '4178847215', 'id' => 'CPFRESHLIGHT_8', 'value' => 'Max Power: Total Odor Control Unscented 15lb Jug'];
                // $products_array[] = ['key' => '4178847222', 'id' => 'CPFRESHLIGHT', 'value' => 'Max Power: Total Odor Control Unscented 24lb Bag'];
                // $products_array[] = ['key' => '4178847415', 'id' => 'CPFRESHLIGHT_11', 'value' => 'Max Power: Bacterial Odor Control Scented 15lb Jug'];
                // $products_array[] = ['key' => '4178847315', 'id' => 'CPFRESHLIGHT_10', 'value' => 'Max Power: Natural Care Unscented 15lb Jug'];
                // $products_array[] = ['key' => '4178801455', 'id' => 'CPFRESHLIGHT_13', 'value' => 'Max Power: UltraClean Scented 15lb Jug'];
                // $products_array[] = ['key' => '4178801485', 'id' => 'CPFRESHLIGHT_14', 'value' => 'Max Power: UltraClean Unscented 15lb Jug'];
                // $products_array[] = ['key' => '4178847515', 'id' => 'CPFRESHLIGHT_12', 'value' => 'Max Power: Triple Odor Guard Unscented 15lb Jug'];
                // $products_array[] = ['key' => '4178847526', 'id' => 'CPFRESHLIGHT', 'value' => "Cat's Pride Triple Odor Guard Unscented 26lb Pail"];
                // $products_array[] = ['key' => '4178847519', 'id' => 'CPFRESHLIGHT', 'value' => "Max Power Pro Total Odor Control Scented 19lb Bag"];
                // $products_array[] = ['key' => '4178847719', 'id' => 'CPFRESHLIGHT', 'value' => "Max Power Pro Total Odor Control Unscented 19lb Bag"];
                // $products_array[] = ['key' => '4178801419', 'id' => 'CPFRESHLIGHT', 'value' => "Max Power Pro Ultraclean Unscented 19lb Bag"];
                // $products_array[] = ['key' => '4178801993', 'id' => 'CPLIGHTSCOOP_9', 'value' => 'Antibacterial Scented 12lb Jug'];
                // $products_array[] = ['key' => '4178801998', 'id' => 'CPFRESHLIGHTULT', 'value' => 'Antibacterial Scented 18lb Bag'];
                // $products_array[] = ['key' => '4178847710', 'id' => 'CPFRESHLIGHTULT_2', 'value' => 'Complete Care Unscented 10lb Jug'];
                // $products_array[] = ['key' => '4178847716', 'id' => 'CPFRESHLIGHTULT', 'value' => 'Complete Care Unscented 18lb Bag'];
                // $products_array[] = ['key' => '4178847510', 'id' => 'CPFRESHLIGHTULT_1', 'value' => 'Pure & Fresh Scented 10lb Jug'];
                // $products_array[] = ['key' => '4178847516', 'id' => 'CPFRESHLIGHTULT', 'value' => 'Pure & Fresh Scented 18lb Bag'];
                // $products_array[] = ['key' => '4178801945', 'id' => 'CPLIGHTSCOOP_5', 'value' => 'Baking Soda Scented 10lb Jug'];
                // $products_array[] = ['key' => '4178801325', 'id' => 'CPLIGHTSCOOP_13', 'value' => 'Baking Soda Unscented 10lb Jug'];
                // $products_array[] = ['key' => '4178801942', 'id' => 'CPLIGHTSCOOP_2', 'value' => 'Easy Scoop Scented 10lb Jug'];
                // $products_array[] = ['key' => '4178801947', 'id' => 'CPLIGHTSCOOP_1', 'value' => 'Flushable Scented 10lb Jug'];
                // $products_array[] = ['key' => '4178801917', 'id' => 'CPLIGHTSCOOP_12', 'value' => 'Flushable Scented 17.5lb Pail'];
                // $products_array[] = ['key' => '4178801310', 'id' => 'CPLIGHTSCOOP_6', 'value' => 'Natural Unscented 10lb Jug'];
                // $products_array[] = ['key' => '4178801933', 'id' => 'CPSCOOP_1', 'value' => 'Scoopable 12lb Jug'];
                // $products_array[] = ['key' => '4178801952', 'id' => 'CPSCOOP', 'value' => "Cat's Pride Scoopable Scented 20lb Pail"];
                // $products_array[] = ['key' => '4178801910', 'id' => 'CPSCOOP', 'value' => "Cat's Pride Scoopable Scented 10lb Bag"];
                // $products_array[] = ['key' => '4178801924', 'id' => 'CPSCOOP_2', 'value' => 'Scoopable 20lb Bag'];
                // $products_array[] = ['key' => '4178801323', 'id' => 'CPLIGHTSCOOP_3', 'value' => 'Unscented 10lb Jug'];
                // $products_array[] = ['key' => '4178801610', 'id' => 'CPLIGHTSCOOP_7', 'value' => 'Cat’s Pride Fresh & Clean 10lb Bag'];
                // $products_array[] = ['key' => '4178801620', 'id' => 'CPLIGHTSCOOP_8', 'value' => 'Cat’s Pride Fresh & Clean 20lb Bag'];
                // $products_array[] = ['key' => '4178801510', 'id' => 'CPNATURAL_1', 'value' => 'Cat’s Pride Natural 10lb Bag'];
                // $products_array[] = ['key' => '4178801220', 'id' => 'CPNATURAL_2', 'value' => 'Cat’s Pride Natural 20lb Bag'];
                // $products_array[] = ['key' => '4178802620', 'id' => 'CPMULTICAT_1', 'value' => 'Cat’s Pride Complete Multi-Cat 20lb Bag'];
                // $products_array[] = ['key' => '4178801605', 'id' => 'CPKATKIT_1', 'value' => 'Cat’s Pride KatKit Disposable Tray with Litter'];
                // $products_array[] = ['key' => '4178857006', 'id' => 'CPMICROCRYSTALSS', 'value' => "Cat's Pride Micro Crystals Scented 6.5lb Bag"];
                // $products_array[] = ['key' => '4178857106', 'id' => 'CPMICROCRYSTALSUS', 'value' => "Cat's Pride Micro Crystals Unscented 6.5lb Bag"];
                // $products_array[] = ['key' => '4178857905', 'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Health Monitor Crystals Unscented 5lb Bag"];
                // $products_array[] = ['key' => '4178857005', 'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Total Odor Control Micro Crystals Fresh Scent 5lb Bag"];
                // $products_array[] = ['key' => '4178857105', 'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Total Odor Control Micro Crystals Unscented 5lb Bag"];
                // $products_array[] = ['key' => '4178857707', 'id' => 'CPCRYSTAL', 'value' => "Cat's Pride UltraClean Low Tracking Crystals Unscented 5lb Bag"];
                // $products_array[] = ['key' => '3384387035', 'id' => 'UPCRYSTAL', 'value' => 'Ultra Health Monitor Crystals Unscented 5lb Bag'];
                // $products_array[] = ['key' => '3384385045', 'id' => 'UPCRYSTAL_3', 'value' => 'Ultra Fresh Micro Crystals Scented 5lb Bag'];
                // $products_array[] = ['key' => '3384385050', 'id' => 'UPCRYSTAL_1', 'value' => 'Ultra Micro Crystals Unscented 5lb Bag'];
                // $products_array[] = ['key' => '3384385300', 'id' => 'UPCRYSTAL_2', 'value' => 'Ultra Clumping Crystals Unscented  5lb Bag'];
                // $products_array[] = ['key' => '3384385065', 'id' => 'UPCRYSTAL', 'value' => 'Ultra Pearls Crystals Unscented 5lb Bag'];
                // $products_array[] = ['key' => '3384385055', 'id' => 'UPCRYSTAL_4', 'value' => 'Ultra Probiotic Micro Crystals Unscented 5lb Bag'];
                // $products_array[] = ['key' => '3384385047', 'id' => 'UPCRYSTAL_5', 'value' => 'Ultra Max Probiotic Odor-Eliminating Additive 17.6oz Bag'];
                // $products_array[] = ['key' => '4178800615', 'id' => 'CPLINERS_1', 'value' => "Cat's Pride Unscented Liners 15ct"];
                // $products_array[] = ['key' => '4133400165', 'id' => 'JCLINERS', 'value' => "Jonny Cat Large Unscented Liners 15ct"];
                // $products_array[] = ['key' => '4133400154', 'id' => 'JCLINERS_3', 'value' => "Jonny Cat Jumbo Unscented Liners 5ct"];
                // $products_array[] = ['key' => '4133400150', 'id' => 'JCLINERS_6', 'value' => 'Jonny Cat Jumbo Unscented Liners 15ct'];
                // $products_array[] = ['key' => '4133400157', 'id' => 'JCLINERS_3', 'value' => 'Jonny Cat Jumbo Scented Liners 7ct'];
                // $products_array[] = ['key' => '4133400166', 'id' => 'JCLINERS', 'value' => "Jonny Cat Jumbo Scented Liners 15 Ct"];
                // $products_array[] = ['key' => '4133400167', 'id' => 'JCLINERS', 'value' => "Jonny Cat Super Unscented Liners 15ct"];

                                
                
                $products_array[] = ['key' => '3384387035',    'id' => 'UPCRYSTAL', 'value' => 'Ultra Health Monitor Crystals Unscented 5lb Bag'];
                $products_array[] = ['key' => '4178857005',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Total Odor Control Micro Crystals Fresh Scent 5lb Bag"];
                $products_array[] = ['key' => '4178857105',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Total Odor Control Micro Crystals Unscented 5lb Bag"];
                $products_array[] = ['key' => '4178857707',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride UltraClean Low Tracking Crystals Unscented 5lb Bag"];
                $products_array[] = ['key' => '4178857905',    'id' => 'CPCRYSTAL', 'value' => "Cat's Pride Health Monitor Crystals Unscented 5lb Bag"];
                $products_array[] = [ 'key' => '4178847215', 'id' => 'CPFRESHLIGHT_8', 'value' => "Cat's Pride Max Power: Total Odor Control Unscented"];
                $products_array[] = [ 'key' => '4178847115', 'id' => 'CPFRESHLIGHT_9', 'value' => "Cat's Pride Max Power: Total Odor Control Scented"];
                $products_array[] = ['key' => '4178801952',  'id' => 'CPSCOOP', 'value' => "Cat's Pride Scoopable Scented 20lb Pail"];
                $products_array[] = ['key' => '4178847515', 'id' => 'CPFRESHLIGHT_12', 'value' => 'Max Power: Triple Odor Guard Unscented 15lb Jug'];
                $products_array[] = ['id' => '4133400166',     'key' => 'JCLINERS', 'value' => "Jonny Cat Jumbo Scented Liners 15 Ct"];
                $products_array[]=  ['id' => '4133400167',     'key' => 'JCLINERS', 'value' => "Jonny Cat Super Unscented Liners 15ct"];
                $products_array[]=  ['id' => '4133400165',     'key' => 'JCLINERS', 'value' => "Jonny Cat Large Unscented Liners 15ct"];


            //return $products_array; Array ( [0] => Array ( [key] => ALLPROD [id] => ALLPROD [value] => All Products ) [1] => Array ( [key] => Antibacterial [id] => CPLIGHTSCOOP_9 [value] => Antibacterial Scented ) [2] => Array ( [key] => [id] => CPMICROCRYSTALSS [value] => Micro Crystals Scented ) [3] => Array ( [key] => [id] => CPMICROCRYSTALSUS [value] => Micro Crystals Unscented ) [4] => Array ( [key] => 73 [id] => CPFRESHLIGHT_9 [value] => Max Power: Total Odor Control Scented ) [5] => Array ( [key] => 210 [id] => CPFRESHLIGHT_8 [value] => Max Power: Total Odor Control Unscented ) [6] => Array ( [key] => 2020 [id] => CPFRESHLIGHT_11 [value] => Max Power: Bacterial Odor Control Scented ) [7] => Array ( [key] => 2021NC [id] => CPFRESHLIGHT_10 [value] => Max Power: Natural Care Unscented ) [8] => Array ( [key] => UltraCleanUnscent [id] => CPFRESHLIGHT_14 [value] => Max Power: UltraClean Unscented ) [9] => Array ( [key] => UltraCleanScented [id] => CPFRESHLIGHT_13 [value] => Max Power: UltraClean Scented ) [10] => Array ( [key] => TOG2020 [id] => CPFRESHLIGHT_12 [value] => Max Power: Triple Odor Guard Unscented ) [11] => Array ( [key] => 1159 [id] => CPFRESHLIGHTULT_2 [value] => Complete Care ) [12] => Array ( [key] => 1155 [id] => CPFRESHLIGHTULT_1 [value] => Pure & Fresh ) [13] => Array ( [key] => FLUSHJ2021 [id] => CPLIGHTSCOOP_12 [value] => Flushable ) [14] => Array ( [key] => 2274 [id] => CPLIGHTSCOOP_2 [value] => Easy Scoop ) [15] => Array ( [key] => 2271 [id] => CPLIGHTSCOOP_3 [value] => Unscented ) [16] => Array ( [key] => 201810242 [id] => CPLIGHTSCOOP_13 [value] => Baking Soda Unscented ) [17] => Array ( [key] => 201810241 [id] => CPLIGHTSCOOP_5 [value] => Baking Soda Scented ) [18] => Array ( [key] => 69 [id] => CPSCOOP_2 [value] => Scoopable ) [19] => Array ( [key] => 222 [id] => CPLIGHTSCOOP_6 [value] => Natural Unscented Clumping ) [20] => Array ( [key] => 75 [id] => CPLIGHTSCOOP_8 [value] => Cat's Pride Fresh & Clean ) [21] => Array ( [key] => 233 [id] => CPNATURAL_2 [value] => Cat's Pride Natural ) [22] => Array ( [key] => 231 [id] => CPMULTICAT_1 [value] => Cat's Pride Complete Multi-Cat ) [23] => Array ( [key] => 235 [id] => CPKATKIT_1 [value] => Cat's Pride KatKit ) [24] => Array ( [key] => 237 [id] => CPLINERS_1 [value] => Cat's Pride Litter Box Liners ) [25] => Array ( [key] => 677 [id] => JCLINERS_3 [value] => Jonny Cat Scented Heavy Duty Litter Box Liners ) [26] => Array ( [key] => 675 [id] => JCLINERS_6 [value] => Jonny Cat Heavy Duty Litter Box Liners ) )

            $array_old =  [ [ 'key' => 'ALLPROD', 'id' => 'ALLPROD', 'value' => __('All Products', 'catspride') ],
            [ 'key' => '4178801993', 'id' => 'CPLIGHTSCOOP_9', 'value' => __("Cat's Pride Antibacterial Scented", 'catspride') ],
            [ 'key' => '4178847115', 'id' => 'CPFRESHLIGHT_9', 'value' => __("Cat's Pride Max Power: Total Odor Control Scented", 'catspride') ],
            [ 'key' => '4178847215', 'id' => 'CPFRESHLIGHT_8', 'value' => __("Cat's Pride Max Power: Total Odor Control Unscented", 'catspride') ],
            [ 'key' => '4178847415', 'id' => 'CPFRESHLIGHT_11', 'value' => __("Cat's Pride Max Power: Bacterial Odor Control Scented", 'catspride') ],
            [ 'key' => '4178847315', 'id' => 'CPFRESHLIGHT_10', 'value' => __("Cat's Pride Max Power: Natural Care Unscented", 'catspride') ],
            [ 'key' => '4178801485', 'id' => 'CPFRESHLIGHT_14', 'value' => __("Cat's Pride Max Power: UltraClean Unscented", 'catspride') ],
            [ 'key' => '4178801455', 'id' => 'CPFRESHLIGHT_13', 'value' => __("Cat's Pride Max Power: UltraClean Scented", 'catspride') ],
            [ 'key' => '4178847515', 'id' => 'CPFRESHLIGHT_12', 'value' => __("Cat's Pride Max Power: Triple Odor Guard Unscented", 'catspride') ],
            [ 'key' => '4178847710', 'id' => 'CPFRESHLIGHTULT_2', 'value' => __("Cat's Pride Complete Care", 'catspride') ],
            [ 'key' => '4178847510', 'id' => 'CPFRESHLIGHTULT_1', 'value' => __("Cat's Pride Pure & Fresh", 'catspride') ],
            [ 'key' => '4178801917', 'id' => 'CPLIGHTSCOOP_12', 'value' => __("Cat's Pride Flushable", 'catspride') ],
            [ 'key' => '4178801942', 'id' => 'CPLIGHTSCOOP_2', 'value' => __("Cat's Pride Easy Scoop", 'catspride') ],
            [ 'key' => '4178801323', 'id' => 'CPLIGHTSCOOP_3', 'value' => __("Cat's Pride Unscented", 'catspride') ],
            [ 'key' => '4178801325', 'id' => 'CPLIGHTSCOOP_13', 'value' => __("Cat's Pride Baking Soda Unscented", 'catspride') ],
            [ 'key' => '4178801945', 'id' => 'CPLIGHTSCOOP_5', 'value' => __("Cat's Pride Baking Soda Scented", 'catspride') ],
            [ 'key' => '4178801924', 'id' => 'CPSCOOP_2', 'value' => __("Cat's Pride Scoopable", 'catspride') ],
            [ 'key' => '4178801310', 'id' => 'CPLIGHTSCOOP_6', 'value' => __("Cat's Pride Natural Unscented Clumping", 'catspride') ],
            [ 'key' => '4178801620', 'id' => 'CPLIGHTSCOOP_8', 'value' => __("Cat's Pride Fresh & Clean", 'catspride') ],
            [ 'key' => '4178801220', 'id' => 'CPNATURAL_2', 'value' => __("Cat's Pride Natural", 'catspride') ],
            [ 'key' => '4178802620', 'id' => 'CPMULTICAT_1', 'value' => __("Cat's Pride Complete Multi-Cat", 'catspride') ],
            [ 'key' => '4178801605', 'id' => 'CPKATKIT_1', 'value' => __("Cat's Pride KatKit", 'catspride') ],
            [ 'key' => '4178800615', 'id' => 'CPLINERS_1', 'value' => __("Cat's Pride Litter Box Liners", 'catspride') ],
            [ 'key' => '4133400157', 'id' => 'JCLINERS_3', 'value' => __('Jonny Cat Scented Heavy Duty Litter Box Liners', 'catspride') ],
            [ 'key' => '4133400150', 'id' => 'JCLINERS_6', 'value' => __('Jonny Cat Heavy Duty Litter Box Liners', 'catspride') ],
            [ 'key' => '41788571061', 'id' => 'CPMICROCRYSTALSUS', 'value' => __("Cat's Pride Micro Crystals Unscented", 'catspride') ],
            [ 'key' => '41788570064', 'id' => 'CPMICROCRYSTALSS', 'value' => __("Cat's Pride Micro Crystals Scented", 'catspride') ]];


            //print_r($array_old);
	    return  $products_array; 

}



/**
 * This is used by the store locator to retrieve the key to send to Wilke from the searched product unique ID.
 *
 * @param $id
 * @return mixed
 */
function cp_get_store_locator_product_key_from_id( $id )
{
    $products = cp_get_store_locator_products();
    $product  = array_search( $id, array_column( $products, 'id') );

    return ($product !== false) ? $products[$product]['key'] : false;
}

/**
 * @return array
 */
function cp_get_valid_store_locator_product_keys()
{
    $keys = array_map( function( $product ) {
        return $product['key'];
    }, cp_get_store_locator_products());

    return array_values( array_unique( $keys ) );
}

/**
 * @return array
 */
function cp_get_valid_store_locator_product_ids()
{
    $keys = array_map( function( $product ) {
        return $product['id'];
    }, cp_get_store_locator_products());

    

    return array_values( array_unique( $keys ) );
}