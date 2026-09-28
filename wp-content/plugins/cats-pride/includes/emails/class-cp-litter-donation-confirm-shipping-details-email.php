<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'CP_Litter_Donation_Confirm_Shipping_Details_Email', false ) ) :

    /**
     *
     * @extends \WC_Email
     */
    class CP_Litter_Donation_Confirm_Shipping_Details_Email extends WC_Email {

        /**
         * @var $test_mode bool
         */
        protected $test_mode;

        /**
         * @var $donation_amount float
         */
        public $donation_amount;

        /**
         * Set email defaults
         *
         * @since 0.1
         */
        public function __construct() {

            // set ID, this simply needs to be a unique name
            $this->id = 'cp_litter_donation_confirm_shipping_details_email';

            // this is the title in WooCommerce Email settings
            $this->title = 'Litter Donation Confirm Shipping Details';

            // this is the description in WooCommerce email settings
            $this->description = 'Email sent to a user when they need to confirm their donation shipping details.';

            // these are the default heading and subject lines that can be overridden using the settings
            $this->heading = 'Your Response Is Needed: Litter Donation Coordination';
            $this->subject = 'Your Response Is Needed: Litter Donation Coordination';

            // If activated, we will send any emails to the logged in user triggering the email rather than the email assigned
            $this->test_mode    = $this->get_option( 'test_mode' );

            $this->template_html  = 'emails/litter-donation-confirm-shipping-details-email.php';
            $this->template_plain = 'emails/plain/litter-donation-confirm-shipping-details-email.php';

            $this->donation_amount = 0;

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
                'recipient'        => $this->get_recipient(),
                'address'          => cp_get_store_address(),
                'email_heading'    => $this->get_heading(),
                'edit_shelter_url' => wc_get_account_endpoint_url('edit-shelter'),
                'donation_amount'  => $this->donation_amount,
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
                'recipient'        => $this->get_recipient(),
                'address'          => cp_get_store_address(),
                'email_heading'    => $this->get_heading(),
                'edit_shelter_url' => wc_get_account_endpoint_url('edit-shelter'),
                'donation_amount'  => $this->donation_amount,
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

            $this->send($this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments());

        }

        /**
         * Setup values required for preview.
         */
        public function preview() {

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

return new CP_Litter_Donation_Confirm_Shipping_Details_Email();