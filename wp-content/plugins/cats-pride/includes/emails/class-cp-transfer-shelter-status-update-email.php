<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Transfer_Shelter_Status_Update_Email', false ) ) :

/**
 *
 * @extends \WC_Email
 */
class CP_Transfer_Shelter_Status_Update_Email extends WC_Email {

    /**
     * @var string
     */
    protected $message_accepted;

    /**
     * @var string
     */
    protected $message_declined;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $recipient_name;

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        // set ID, this simply needs to be a unique name
        $this->id = 'cp_transfer_shelter_status_update_email';

        // this is the title in WooCommerce Email settings
        $this->title = 'Shelter Transfer Request Status Update';

        // this is the description in WooCommerce email settings
        $this->description = 'Email sent to a shelter manager that requested a transfer informing them of the result.';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = 'Update on Your Shelter Transfer Request';
        $this->subject = 'Update on Your Shelter Transfer Request';

        // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
        $this->test_mode    = $this->get_option( 'test_mode' );

        $this->template_html  = 'emails/transfer-shelter-status-update-email.php';
        $this->template_plain = 'emails/plain/transfer-shelter-status-update-email.php';

        /*
         * Message body options
         */
        $this->message_accepted = 'Your shelter manager transfer request has been accepted by the member. Your account has been changed to a standard Cat\'s Pride Club member account and you will no longer have access to edit any shelter details. Thank you!';
        $this->message_declined = 'You shelter manager transfer request has been declined by the member. To submit a different member as a shelter manager, simply visit your Edit Shelter account page and submit a new request.';

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
     * @return mixed|void
     */
    public function get_email_body()
    {
        $message_type = 'message_' . $this->status;

        return apply_filters( 'catspride_email_body_' . $this->id, nl2br($this->format_string( $this->get_option( $message_type, $this->$message_type ) ) ), $this->shelter );
    }

    /**
     * get_content_html function.
     *
     * @return string
     */
    public function get_content_html()
    {
        ob_start();
        wc_get_template( $this->template_html, array(
            'shelter'          => $this->shelter,
            'shelter_name'     => $this->shelter->post_title,
            'status'           => $this->status,
            'message'          => $this->get_email_body(),
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
    public function get_content_plain()
    {
        ob_start();
        wc_get_template( $this->template_plain, array(
            'shelter'          => $this->shelter,
            'shelter_name'     => $this->shelter->post_title,
            'status'           => $this->status,
            'message'          => $this->get_email_body(),
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
            'message_approved'    => array(
                'title'       => '"Accepted" Email Body',
                'type'        => 'textarea',
                'description' => 'This controls the email content for notifying the shelter manager when their transfer request is accepted. {shelter_name} can be used as a variable in this content.',
                'placeholder' => '',
                'default'     => $this->message_accepted
            ),
            'message_declined'    => array(
                'title'       => '"Declined" Email Body',
                'type'        => 'textarea',
                'description' => 'This controls the email content for notifying the shelter manager when their transfer request is declined. {shelter_name} can be used as a variable in this content.',
                'placeholder' => '',
                'default'     => $this->message_declined
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
                    //'multipart' => 'Multipart',
                )
            )
        );
    }
    
    function trigger()
    {
        if ( !$this->is_enabled() )
            return;

        if ( $this->is_test_mode() === true ) {

            $user = wp_get_current_user();
            $this->recipient = $user->user_email;

        } else if ( $this->transfer_from_user instanceof WP_User ){

            $this->recipient = $this->transfer_from_user->user_email;

        }

        if ( !$this->get_recipient() )
            return;

        /*
         * Add in custom placeholder replacement for the shelter name
         */
        $this->placeholders = array_merge($this->placeholders, array(
            '{shelter_name}' => $this->shelter->post_title
        ));

        $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

    }

    /**
     * Setup values required for preview.
     */
    public function preview() {

        $this->test_mode = true;

        $this->shelter = new stdClass();
        $this->shelter->post_title = 'Test Shelter Name';

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

return new CP_Transfer_Shelter_Status_Update_Email();