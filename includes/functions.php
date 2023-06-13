<?php
/**
 * Global OIDCG functions.
 *
 * @package   OpenID_Connect_Generic
 * @author    Jonathan Daggerhart <jonathan@daggerhart.com>
 * @copyright 2015-2020 daggerhart
 * @license   http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 */

/**
 * Return a single use authentication URL.
 *
 * @return string
 */
function oidcg_get_authentication_url() {
	return \OpenID_Connect_Generic::instance()->client_wrapper->get_authentication_url();
}

/**
 * Refresh a user claim and update the user metadata.
 *
 * @param WP_User $user             The user object.
 * @param array   $token_response   The token response.
 *
 * @return WP_Error|array
 */
function oidcg_refresh_user_claim( $user, $token_response ) {
	return \OpenID_Connect_Generic::instance()->client_wrapper->refresh_user_claim( $user, $token_response );
}

function redirect_sub_to_home($redirect_to_calculated, $redirect_url_specified, $user) {
    /* If no redirect was specified, make it the homepage */
    if (empty($redirect_to_calculated))
        $redirect_to_calculated = get_option('siteurl');

    /* If the user is not site admin, redirect to homepage */
    if (!current_user_can('manage_options'))
        $redirect_to_calculated = get_option('siteurl');

    return $redirect_to_calculated;
}

add_filter('login_redirect', 'redirect_sub_to_home', 10, 3);
