<?php
add_filter('woocommerce_product_tabs', 'woo_product_tabs', 9999);

function woo_product_tabs($tabs)
{
    // Remove default tabs

    unset($tabs['description']);
    unset($tabs['additional_information']);
    unset($tabs['reviews']);

    $externalID = get_field('bazaarvoice_product_id', get_the_ID(), false);

    // Add custom tabs

    if ($externalID) {
        $tabs['reviews-b'] = array(
            'title' => __('Review', 'cats-pride'),
            'priority' => 50,
            'callback' => 'reviewsContent', // TAB CONTENT CALLBACK
        );

        $tabs['questions-answers'] = array(
            'title' => __('Questions & Answers', 'cats-pride'),
            'priority' => 50,
            'callback' => 'questionsContent', // TAB CONTENT CALLBACK
        );
    }


    return $tabs;
}

function reviewsContent()
{
    $externalID = get_field('bazaarvoice_product_id', get_the_ID(), false);

    if (isset($_COOKIE['cp_bv_incentivize'])) {
        $customReviewLink = get_field('custom_review_link', get_the_ID());
    }
    

    get_template_part('template-parts/woocommerce/single-product', 'reviews', [
        'externalID'        => $externalID,
        'reviewLinks'       => $customReviewLink
    ]);
}

function questionsContent()
{
    $externalID = get_field('bazaarvoice_product_id', get_the_ID(), false);

    get_template_part('template-parts/woocommerce/single-product', 'questions', [
        'externalID'        => $externalID,
    ]);
}
