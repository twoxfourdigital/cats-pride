<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Register_Shelter_Invite_Email', false ) ) :

/**
 *
 * @extends \WC_Email
 */
class CP_Register_Shelter_Invite_Email extends WC_Email {

    /**
     * @var string
     */
    protected $registration_url;

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        // set ID, this simply needs to be a unique name
        $this->id = 'cp_register_shelter_invite_email';

        // this is the title in WooCommerce Email settings
        $this->title = 'Shelter Invitation';

        // this is the description in WooCommerce email settings
        $this->description = 'Email sent to a shelter after it has entered a draft status.';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = 'Congratulations, {shelter_name}!';
        $this->subject = 'Your supporters came through! Register to claim your donated litter.';

        // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
        $this->test_mode    = $this->get_option( 'test_mode' );

        $this->template_html  = 'emails/register-shelter-invite-email.php';
        $this->template_plain = 'emails/plain/register-shelter-invite-email.php';

        // Call parent constructor to load any other defaults not explicitly defined here
        parent::__construct();

    }

    /**
     * @return string
     */
    public function get_headers()
    {
        $headers = parent::get_headers();
        $headers .= "X-Mailgun-Tag: " . $this->id . "\r\n";

        return $headers;
    }

    /**
     * get_content_html function.
     *
     * @return string
     */
    public function get_content_html() {
        ob_start();
        wc_get_template( $this->template_html, array(
            'shelter'          => $this->object,
            'recipient'        => $this->get_recipient(),
            'address'          => cp_get_store_address(),
            'registration_url' => $this->registration_url,
            'email_heading'    => $this->get_heading(),
            'sent_to_admin'    => false,
            'plain_text'       => false,
            'email'			   => $this,
        ), CP_TEMPLATES_PATH . '/', CP_TEMPLATES_PATH . '/' );

        return ob_get_clean();
    }

    /**
     * get_content_plain function.
     *
     * @return string
     */
    public function get_content_plain() {
        ob_start();
        wc_get_template( $this->template_plain, array(
            'shelter'          => $this->object,
            'registration_url' => $this->registration_url,
            'recipient'        => $this->get_recipient(),
            'address'          => cp_get_store_address(),
            'email_heading'    => $this->get_heading(),
            'sent_to_admin'    => false,
            'plain_text'       => true,
            'email'			   => $this,
        ), CP_TEMPLATES_PATH . '/', CP_TEMPLATES_PATH . '/' );
        return ob_get_clean();
    }

    /**
     * Initialize Settings Form Fields
     *
     */
    public function init_form_fields() {

        $this->form_fields = array(
            'enabled'    => array(
                'title'   => 'Enable/Disable',
                'type'    => 'checkbox',
                'label'   => 'Enable this email notification. If disabled and Active Campaign settings are present, the shelter will be added to the Pending Shelters list within Active Campaign.',
                'default' => 'yes'
            ),
            'test_mode'    => array(
                'title'   => 'Test Mode',
                'type'    => 'checkbox',
                'label'   => 'If enabled, all email notifications will be sent to the logged in user triggering the alert.',
                'default' => 'yes'
            ),
            'subject'    => array(
                'title'       => 'Subject',
                'type'        => 'text',
                'description' => sprintf( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', $this->subject ),
                'placeholder' => '',
                'default'     => ''
            ),
            'heading'    => array(
                'title'       => 'Email Heading',
                'type'        => 'text',
                'description' => sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.' ), $this->heading ),
                'placeholder' => '',
                'default'     => ''
            ),
            'email_type' => array(
                'title'       => 'Email type',
                'type'        => 'select',
                'description' => 'Choose which format of email to send.',
                'default'     => 'html',
                'class'       => 'email_type',
                'options'     => array(
                    'plain'     => 'Plain text',
                    'html'      => 'HTML',
                    'multipart' => 'Multipart',
                )
            )
        );
    }

    /**
     * @param $post_id
     * @param $post
     * @param $update
     * @return string|void
     */
    function trigger( $post_id, $post, $update )
    {
        $token = (get_post_meta( $post_id,'_cp_shelter_token', true ) !== '')
            ? get_post_meta( $post_id,'_cp_shelter_token', true ) : cp_set_token_for_shelter( $post_id );

        $this->recipient         = get_post_meta( $post_id,'email', true );
        $this->object            = $post;
        $this->registration_url  = add_query_arg( array (
            'cp_st' => $token,
            'tab'   => 'register'
        ), wc_get_page_permalink( 'myaccount' ) );

        if ( $this->is_test_mode() === true ) {
            $user = wp_get_current_user();
            $this->recipient = $user->user_email;
        }

        // Add to Active Campaign Pending Shelter list to send out email if the email is disabled in WooCommerce
        if( ! $this->is_enabled()
            && $this->get_recipient()
            && defined( 'ACTIVECAMPAIGN_URL' )
            && defined( 'ACTIVECAMPAIGN_API_KEY' )
            && defined( 'ACTIVECAMPAIGN_SHELTER_LIST_ID' ) ) {

            $contact = array(
                "email"        => $this->recipient,
                "tags"         => 'Shelter',
                "p[" . ACTIVECAMPAIGN_SHELTER_LIST_ID . "]"      => ACTIVECAMPAIGN_SHELTER_LIST_ID,
                "status[" . ACTIVECAMPAIGN_SHELTER_LIST_ID . "]" => 1,
                "field"        => array(
                    '%PURL%,0' => $this->registration_url
                )
            );

            // Setting the Reset Requested will trigger an automated email send from Active Campaign for the user
            if( isset( $_POST['force_send_shelter_invite'] ) ) {
                $contact['field']['%RESET_REQUESTED%,0'] = date( 'c' );
            }

            $active_campaign = cp_sync_active_campaign_contact( null, $contact );

            if ( ! (int) $active_campaign->success ) {
                error_log( "Syncing contact for shelter invite failed for user: {$this->get_recipient()}. Error returned: " . $active_campaign->error);
            }

        } else {

            if ( !$this->is_enabled() || !$this->get_recipient() )
                return;

            /*
             * Add in custom placeholder replacement
             */
            $this->placeholders = array_merge($this->placeholders, array(
                '{shelter_name}' => $post->post_title
            ));

            $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

        }

        // Email has been sent, save meta entry so we don't send another one to them
        add_post_meta( $post_id,'_cp_invite_email_sent', time());

    }

    /**
     * @return bool
     */
    function is_test_mode()
    {
        return ($this->test_mode === 'yes') ? true : false;
    }

    /**
     * Setup values required for preview.
     */
    public function preview() {

        $this->trigger( null, null, null );

    }

}

endif;

return new CP_Register_Shelter_Invite_Email();