<?php

$shelter_page_url      = get_permalink( $manage_shelter_id );
$shelter               = get_post( $manage_shelter_id );
$twitter_page_share    = "Every jug of Cat's Pride® cat litter you buy helps shelter cats across the country find their forever homes. Visit our Shelter Page to nominate our shelter to receive litter donations—the more nominations, the more litter we are eligible to receive!";
$twitter_video_share   = "Cat’s Pride®’s Litter for Good™ program helps shelters like ours find more cats forever homes. Every jug of Cat’s Pride cat litter you buy donates a pound of litter to animal welfare organizations like ours.";

?>

<?php /* if ( $profile_completed === false ) { */ ?>
    <div class="x-container max width colorbox clearfix" style="background-color: #6abf4b;">
            <div class="x-column x-sm x-2-3 mobile-mbm col-md-9">
                <h2 class="h-custom-headline white s-28 mobile-s-28 mbs" style="max-width: 550px">Your shelter page can help <strong>maximize your nominations.</strong></h2>
                <p class="man s-14 Montserrat" style="max-width: 560px;letter-spacing: -0.2px;">Complete and share your public-facing Shelter Page to help spread the word about your shelter and get more nominations, which means more donated litter!</p>
            </div>
            <div class="x-column x-sm x-1-3 cs-ta-center col-md-3" style="padding: 40px 0px">
            <a id="x-legacy-tab-2a" aria-selected="true" aria-controls="x-legacy-panel-2" role="tab" data-x-toggle="tab" data-x-toggleable="x-legacy-tab-2" data-x-toggle-group="5d79755d87ff9" class="primary-button--white green-rev">Edit Shelter Page</a>
                <!--a class="x-btn green-rev" href="<?php echo wc_get_account_endpoint_url('edit-shelter'); ?>" title="Edit Shelter Page">Edit Shelter Page</a-->
            </div>
    </div>
<?php /* } */ ?>

<div class="x-container max width spread-the-word" style="padding: 50px 0 40px;">
	<div class="x-column x-sm x-1-1 cs-ta-center" style="">
		<h2 class="s-36 w-700 mbm  mobile-s-36 h-custom-headline">Spread the word</h2>
		<h3 class="s-24  mobile-s-24 mobile-mbs">More nominations <strong>= More donated litter.</strong></h3>
		<p class="s-14" style="max-width: 640px;letter-spacing: -0.2px;margin: 0 auto;">Start receiving more donated litter by asking your supporters to nominate you on catspride.com.<br/>Click below to get started.</p>
	</div>
</div>

<div class="x-container max width spread-the-word-sharing clearfix" style="">
	<div class="share-item x-column x-sm x-1-4 cs-ta-center col-md-3">
		<img class="x-img top x-img-none man" style="" alt="Share Shelter Page" src='<?php echo $plugin_dir; ?>/assets/images/share-public-page@2x.jpg'>
		<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_attr( $shelter_page_url ); ?>" class="x-btn blue-alt primary-button--light-blue" target="_blank">Share<br/>Shelter Page</a>
	</div>
	<div class="share-item x-column x-sm x-1-4 cs-ta-center col-md-3">
		<img class="x-img top x-img-none man" alt="Post on Social" src="<?php echo $plugin_dir; ?>/assets/images/postonsocial.png">
        <a href="https://www.facebook.com/sharer.php?u=<?php echo get_permalink( get_page_by_path( 'litterforgood' ) ); ?>&t=Join Litter for Good to help more shelter cats!" target="_blank" class="x-btn blue-alt primary-button--light-blue">Post<br/>on Social</a>
    </div>
	<div class="share-item x-column x-sm x-1-4 cs-ta-center col-md-3">
		<img class="x-img top x-img-none man" style="" alt="Share Video" src="<?php echo $plugin_dir; ?>/assets/images/Video@2x.jpg">
        <a href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fyoutu.be%2FOti_7g1NBCI&t=Join Litter for Good to help more shelter cats!" target="_blank" class="x-btn blue-alt primary-button--light-blue">Share<br/>Video</a>
    </div>
	<div class="share-item x-column x-sm x-1-4 cs-ta-center last col-md-3">
		<img class="x-img top x-img-none man" alt="Send Email" src="<?php echo $plugin_dir; ?>/assets/images/sendemail.png">
		<a href="<?php echo get_stylesheet_directory_uri(); ?>/downloads/CatsPride_Email_SocialMedia_Messaging.docx" target="_blank" class="x-btn blue-alt primary-button--light-blue">Send<br/>Email</a>
	</div>
</div>



