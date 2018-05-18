<?php

/**
 * USAGE:
 *
 * To display a particular campaign's button, just add this to your template:

ed_charitable_get_campaign_donate_button( 123 );

 * Replace 123 with the ID of your campaign.
 */

/**
 * Display a donate button for a specific campaign.
 *
 * Clicking on "Donate" will open the donation form modal directly
 * on the page.
 *
 * @param   int $campaign_id
 */
function ed_charitable_get_campaign_donate_button( $campaign_id ) {

	$campaign = charitable_get_campaign( $campaign_id );

	charitable_template_donate_button( $campaign );

	charitable_template( 'campaign/donate-modal-window.php', array( 'campaign' => $campaign ) );

	Charitable_Public::get_instance()->enqueue_donation_form_scripts();

}

/**
 * To add a shortcode to display a campaign's donate button, include this function below.
 *
 * @param  array $atts User-defined shortcode attributes.
 * @return string
 */
function ed_charitable_campaign_donate_button_shortcode( $atts ) {
	if ( ! array_key_exists( 'campaign_id', $atts ) ) {
		return '';
	}

	return ed_charitable_get_campaign_donate_button( $atts['campaign_id'] );
}

add_shortcode( 'charitable_donate_button', 'ed_charitable_campaign_donate_button_shortcode' );
