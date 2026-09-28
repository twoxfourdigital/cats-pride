<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Optout_Shelter_Confirmation_Email', false ) ) :

/**
 *
 * @extends \WC_Email
 */
class CP_Optout_Shelter_Confirmation_Email extends WC_Email {

    /**
     * @var string
     */
    protected $optout_url;

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        // set ID, this simply needs to be a unique name
        $this->id = 'cp_optout_shelter_confirmation_email';

        // this is the title in WooCommerce Email settings
        $this->title = 'Shelter Opt-out Confirmation';

        // this is the description in WooCommerce email settings
        $this->description = 'Email sent to a shelter if they choose to opt-out.';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = 'Please Confirm Your Opt-Out';
        $this->subject = 'Confirm Your Opt-Out Request';

        // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
        $this->test_mode    = $this->get_option( 'test_mode' );

        $this->template_html  = 'emails/optout-shelter-confirmation-email.php';
        $this->template_plain = 'emails/plain/optout-shelter-confirmation-email.php';

        // Call parent constructor to load any other defaults not explicitly defined here
        parent::__construct();

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
            'optout_url'       => $this->optout_url,
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
            'optout_url' => $this->optout_url,
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
                'label'   => 'Enable this email notification.',
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
     * @param $user_id
     */
    function trigger( $post_id, $post, $user )
    {
        $token = (get_post_meta( $post_id,'_cp_shelter_token', true ) !== '')
            ? get_post_meta( $post_id,'_cp_shelter_token', true ) : cp_set_token_for_shelter( $post_id );

        // Set the email of the user requesting the opt-out
        $this->recipient         = $user->user_email;
        $this->object            = $post;
        $this->optout_url  = add_query_arg( array (
            'cp_ot' => $token,
            'tab'   => 'login'
        ), wc_get_page_permalink( 'myaccount' ) );

        if ( $this->is_test_mode() === true ) {
            $user = wp_get_current_user();
            $this->recipient = $user->user_email;
        }

        if ( !$this->is_enabled() || !$this->get_recipient() )
            return;

        /*
         * Add in custom placeholder replacement
         */
        $this->placeholders = array_merge($this->placeholders, array(
            '{shelter_name}' => $post->post_title
        ));

        if ( $this->is_test_mode() === true ) {
            $user = wp_get_current_user();
            $this->recipient = $user->user_email;
        }

        $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

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

return new CP_Optout_Shelter_Confirmation_Email();