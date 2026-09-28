<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Transfer_Shelter_Request_Email', false ) ) :

/**
 *
 * @extends \WC_Email
 */
class CP_Transfer_Shelter_Request_Email extends WC_Email {

    /**
     * @var $test_mode bool
     */
    protected $test_mode;

    /**
     * @var $transfer_from_user WP_User
     */
    public $transfer_from_user;

    /**
     * @var $transfer_to_user WP_User
     */
    public $transfer_to_user;

    /**
     * @var $shelter WP_Post
     */
    public $shelter;

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        // set ID, this simply needs to be a unique name
        $this->id = 'cp_transfer_shelter_request_email';

        // this is the title in WooCommerce Email settings
        $this->title = 'Shelter Transfer Request';

        // this is the description in WooCommerce email settings
        $this->description = 'Email sent to a user when they are requested to take over shelter management';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = 'Shelter Transfer Request';
        $this->subject = 'Shelter Transfer Request';

        // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
        $this->test_mode    = $this->get_option( 'test_mode' );

        $this->template_html  = 'emails/transfer-shelter-request-email.php';
        $this->template_plain = 'emails/plain/transfer-shelter-request-email.php';

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
            'shelter'          => $this->shelter,
            'transfer_from_user' => $this->transfer_from_user,
            'transfer_to_user' => $this->transfer_to_user,
            'recipient'        => $this->get_recipient(),
            'from_email'       => $this->transfer_from_user->user_email,
            'shelter_name'     => $this->shelter->post_title,
            'address'          => cp_get_store_address(),
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
            'shelter'          => $this->shelter,
            'transfer_from_user' => $this->transfer_from_user,
            'transfer_to_user' => $this->transfer_to_user,
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
                    //'plain'     => 'Plain text',
                    'html'      => 'HTML',
                    //'multipart' => 'Multipart', 'woocommerce',
                )
            )
        );
    }

    /**
     * @return string|void
     */
    function trigger()
    {
        if ( !$this->is_enabled() )
            return;

        if ( $this->is_test_mode() === true ) {

            $user = wp_get_current_user();
            $this->recipient = $user->user_email;

        } else if ( $this->transfer_to_user instanceof WP_User ){

            $this->recipient = $this->transfer_to_user->user_email;

        }

        if ( !$this->get_recipient() )
            return;

        $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

    }

    /**
     * Setup values required for preview.
     */
    public function preview() {

        $this->test_mode = true;
        $this->trigger();

    }

    /**
     * @return bool
     */
    function is_test_mode()
    {
        return ($this->test_mode === 'yes') ? true : false;
    }

}

endif;

return new CP_Transfer_Shelter_Request_Email();