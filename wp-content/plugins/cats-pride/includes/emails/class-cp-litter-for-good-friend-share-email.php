<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Litter_For_Good_Friend_Share_Email', false ) ) :

/**
 *
 * @extends \WC_Email
 */
class CP_Litter_For_Good_Friend_Share_Email extends WC_Email {

    /**
     * @var $shared_by_name string
     */
    public $shared_by_name;

    /**
     * @var $shared_by_email string
     */
    public $shared_by_email;

    /**
     * @var $test_mode bool
     */
    protected $test_mode;

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        // set ID, this simply needs to be a unique name
        $this->id = 'cp_litter_for_good_friend_share_email';

        // this is the title in WooCommerce Email settings
        $this->title = 'Litter For Good Friend Share';

        // this is the description in WooCommerce email settings
        $this->description = 'Email sent to a user when their friend enters their email address.';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = '{shared_by_name} is helping cats in need – you can too!';
        $this->subject = '{shared_by_name} is helping cats in need – you can too!';

        // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
        $this->test_mode    = $this->get_option( 'test_mode' );

        $this->template_html  = 'emails/litter-for-good-friend-share-email.php';
        $this->template_plain = 'emails/plain/litter-for-good-friend-share-email.php';

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
            'shared_by_name'   => ($this->shared_by_name) ? $this->shared_by_name : null,
            'shared_by_email'  => ($this->shared_by_email) ? $this->shared_by_email : null,
            'recipient'        => $this->get_recipient(),
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
            'shared_by_name'   => ($this->shared_by_name) ? $this->shared_by_name : null,
            'shared_by_email'  => ($this->shared_by_email) ? $this->shared_by_email : null,
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
        if ( $this->is_test_mode() === true ) {

            $user = wp_get_current_user();
            $this->recipient = $user->user_email;

        }

        if ( !$this->get_recipient() )
            return;

        /*
         * Add in custom placeholder replacement
         */
        $this->placeholders = array_merge($this->placeholders, array(
            '{shared_by_name}' => $this->shared_by_name
        ));

        $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

    }

    /**
     * Setup values required for preview.
     */
    public function preview() {

        $this->shared_by_name  = 'Sally Shares-a-lot';
        $this->shared_by_email = 'sally@catspride.com';
        $this->trigger( null, null, null );

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

return new CP_Litter_For_Good_Friend_Share_Email();