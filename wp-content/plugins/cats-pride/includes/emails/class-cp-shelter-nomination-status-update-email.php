<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Shelter_Nomination_Status_Update_Email', false ) ) :

/**
 *
 * @extends \WC_Email
 */
class CP_Shelter_Nomination_Status_Update_Email extends WC_Email {

    /**
     * @var string
     */
    protected $message_approved;

    /**
     * @var string
     */
    protected $message_rejected_duplicate;

    /**
     * @var string
     */
    protected $message_rejected_vet;

    /**
     * @var string
     */
    protected $message_rejected_no_contact;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $recipient_name;

    /**
     * Set email defaults
     *
     * @since 0.1
     */
    public function __construct() {

        // set ID, this simply needs to be a unique name
        $this->id = 'cp_shelter_nomination_status_update_email';

        // this is the title in WooCommerce Email settings
        $this->title = 'Shelter Nomination Status Update';

        // this is the description in WooCommerce email settings
        $this->description = 'Email sent to a user that nominated a shelter after the sheltered joined, opted-out or was rejected.';

        // these are the default heading and subject lines that can be overridden using the settings
        $this->heading = 'Update on Your Shelter Nomination';
        $this->subject = 'Update on Your Shelter Nomination';

        // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
        $this->test_mode    = $this->get_option( 'test_mode' );

        $this->template_html  = 'emails/shelter-nomination-status-update-email.php';
        $this->template_plain = 'emails/plain/shelter-nomination-status-update-email.php';

        /*
         * Message body options
         */
        $this->message_approved = null;
        $this->message_rejected_duplicate = null;
        $this->message_rejected_vet = null;
        $this->message_rejected_no_contact = null;

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

        return apply_filters( 'catspride_email_body_' . $this->id, nl2br($this->format_string( $this->get_option( $message_type, $this->$message_type ) ) ), $this->object );
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
            'shelter'          => $this->object,
            'shelter_name'     => $this->object->post_title,
            'message'          => $this->get_email_body(),
            'recipient_name'   => $this->recipient_name,
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
            'shelter'          => $this->object,
            'shelter_name'     => $this->object->post_title,
            'message'          => $this->get_email_body(),
            'recipient_name'   => $this->recipient_name,
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
                'title'       => '"Approved" Email Body',
                'type'        => 'textarea',
                'description' => 'This controls the email content for notifying a user when their nominated shelter is approved.',
                'placeholder' => '',
                'default'     => ''
            ),
            'message_rejected_duplicate'    => array(
                'title'       => '"Rejected: Duplicate" Email Body',
                'type'        => 'textarea',
                'description' => 'This controls the email content for notifying a user when their nominated shelter is rejected because the same shelter already exists.',
                'placeholder' => '',
                'default'     => ''
            ),
            'message_rejected_vet'    => array(
                'title'       => '"Rejected: Vet Hospital" Email Body',
                'type'        => 'textarea',
                'description' => 'This controls the email content for notifying a user when their nominated shelter is rejected because they are not a welfare shelter.',
                'placeholder' => '',
                'default'     => ''
            ),
            'message_rejected_no_contact'    => array(
                'title'       => '"Rejected: No Contact" Email Body',
                'type'        => 'textarea',
                'description' => 'This controls the email content for notifying a user when their nominated shelter is rejected because we were unable to find an email address to contact them.',
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
     * @param $reason
     */
    function trigger( $post_id, $post, $reason )
    {
        if ( !$this->is_enabled() || ( $this->is_test_mode() === false && !empty( get_post_meta( $post_id, '_cp_nominated_by_user_notified', true) ) ) )
            return;

        // Set the reason for the email, used to get the email content
        $this->status = $reason;

        $this->object = $post;
        $user = null;

        if ( $this->is_test_mode() === true ) {

            $user = wp_get_current_user();

        } else {

            $user_id = get_post_meta($post_id, '_cp_nominated_by_user', true);

            if ( $user_id ) {
                $user = get_user_by('ID', $user_id);
            }

        }

        if ( !$user )
            return;

        $this->recipient = $user->user_email;

        /*
         * Add in custom placeholder replacement for the shelter name
         */
        $this->placeholders = array_merge($this->placeholders, array(
            '{shelter_name}' => $post->post_title,
            '{recipient_name}' => $user->first_name
        ));

        $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

        if ( $post_id !== 0 && $this->is_test_mode() === false ) {
            // Email has been sent, save meta entry so we don't inadvertently send another one to them
            update_post_meta($post_id, '_cp_nominated_by_user_notified', time());
        }

    }

    /**
     * Setup values required for preview.
     */
    public function preview() {

        $this->test_mode = true;

        $post = new stdClass();
        $post->post_title = 'Test Shelter Name';

        $this->trigger(0, $post, 'Testing the Email');

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

return new CP_Shelter_Nomination_Status_Update_Email();