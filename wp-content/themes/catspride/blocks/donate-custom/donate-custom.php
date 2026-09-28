<?php
/*
* Block Name: Donate Custom
* Post Type: page 
*/

if (isset($block['data']['preview_image_help'])) :
    echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
else: 

    $donated =  (float) get_field('donated');
    $goal = (float) get_field('goal');

    $precentage = 100/($goal/$donated);
    $precentage = number_format($precentage, 2, '.', ' ');
    

    $leftover = 110 - $precentage;
    if($leftover > 100) {
        $leftover = 100;
    }
    
    
    
?>

    <section class="donate-custom-wrapper">
        <div class="container donate-custom-container">
            <div class="donate_row ">
                <?php echo get_field('donate_content'); ?>
            </div>
            <div class="donate-inner-wrapper">
                <div class="catspride">
                    <div class="cp-lfg-litter-counter">
                        <div class="cp-lfg-litter-donated-bar x-column x-3-4 x-sm">
                            <div class="cp-lfg-litter-donated-label-wrapper"><span class="cp-lfg-litter-donated-label"><?php echo get_field('donation_for'); ?></span><span class="cp-lfg-litter-donated-label"><?php echo get_field('goal_date');?></span></div>
                            <div class="cp-lfg-litter-donated-bar-wrapper">
                                <div class="cp-lfg-litter-donated-bar-filled-total cp-litter-counter"><span class="counter-total"><?php echo number_format(get_field('donated'), 0, '.', ','); ?> lbs</span></div><span class="remaining-total"><?php echo number_format(get_field('goal'), 0, '.', ','); ?> lbs</span><span class="cp-lfg-litter-donated-bar-filled" style="width:<?php echo $precentage; ?>%;"></span><span class="cp-lfg-litter-donated-bar-remaining" style="width:100%;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- .donate-custom-wrapper-->

<?php endif; ?>