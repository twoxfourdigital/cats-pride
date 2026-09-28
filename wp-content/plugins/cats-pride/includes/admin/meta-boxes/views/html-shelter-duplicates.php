<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="inside cp-meta-box-shelter_duplicates">

    <?php

    $has_duplicates = ( get_post_meta( $post->ID, '_cp_has_shelter_duplicates', true ) == '1' );

    if ( $has_duplicates === true ) { ?>

        <?php $duplicates = get_post_meta( $post->ID, '_cp_shelter_duplicates', true ); ?>

        <p class="desc">We have detected potential duplicates for this shelter. They are listed below:</p>

        <ul class="cp-shelter_duplicates-list">
        <?php

        $duplicate_posts = get_posts([
            'post__in' => $duplicates,
            'post_type' => 'cp_shelter',
            'post_status' => [ 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash' ]
        ]);

        foreach( $duplicate_posts as $duplicate_post ) { ?>
            <li>
                <span class="cp_shelter_duplicate_id"><?php echo $duplicate_post->ID; ?></span>
                <a href="<?php echo get_edit_post_link( $duplicate_post->ID ); ?>">
                    <?php echo $duplicate_post->post_title; ?>
                </a>
                <span> (<?php echo cp_get_shelter_nomination_count( $duplicate_post->ID ); ?> votes)</span>
                <span class="cp_shelter_duplicate_scores">
                    <?php $shelters = get_post_meta( $post->ID, '_cp_shelter_duplicate_scores' ); ?>

                    <table style="width:100%;margin-top:10px;">
                    <?php foreach( current($shelters) as $avg_score => $shelter ) {

                        $scores = [];

                        if ( (int) $shelter['ID'] !== (int) $duplicate_post->ID )
                            continue;

                        foreach( $shelter['match_score'] as $score_key => $score ) { ?>

                            <tr>
                                <td><?php echo ucwords( str_replace( '_', ' ', $score_key ) ); ?></td>
                                <td><?php echo number_format( $score, 2 ); ?></td>
                            </tr>

                            <?php $scores[] = $score; ?>

                        <?php } ?>

                        <?php

                        $total_score = (array_sum($scores) > 0) ? array_sum($scores) / count($scores) : 0;

                        ?>

                        <tr>
                            <td>Total Average Score</td>
                            <td><?php echo number_format( $total_score, 2 ); ?></td>
                        </tr>

                    <?php } ?>
                    </table>

                </span>
            </li>
        <?php } ?>
        </ul>

        <div>

        </div>

    <?php } else { ?>

        <p class="desc">We have not detected any duplicates for this shelter.</p>

    <?php } ?>

    <a class="button button-secondary" href="<?php echo get_edit_post_link( $post->ID ) . '&update_shelter_duplicate_check=1'; ?>">
        Check Again
    </a>

</div>