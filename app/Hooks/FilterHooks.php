<?php
//phpcs:disable
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\BlencoCore\Hooks;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use RT\BlencoCore\Traits\SingletonTraits;

class FilterHooks {
	use SingletonTraits;


	public function __construct() {
		//Add user contact info
		add_filter( 'user_contactmethods', [ __CLASS__, 'rt_user_extra_contact_info' ] );
		add_filter( 'the_password_form', [ __CLASS__, 'rt_post_password_form' ] );
		add_filter( 'get_search_form', [ $this, 'search_form' ] );
		add_filter( 'upload_mimes', [ $this, 'blenco_mime_types' ] );


	}

	/**
	 * Search form modify
	 * @return string
	 */
	public function search_form() {
		$output = '
		<form method="get" class="blenco-search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <div class="search-box">
				<input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here...', 'blenco-core' ) . '" value="' . get_search_query() . '" name="s" />
				<button class="item-btn" type="submit">
					' . blenco_get_svg( 'search' ) . '
					<span class="btn-label">' . esc_html__( "Search", "blenco-core" ) . '</span>
				</button>
            </div>
		</form>
		';

		return $output;
	}


	/* User Contact Info */
	public static function rt_user_extra_contact_info( $contactmethods ) {
		$contactmethods['rt_designation'] = __( 'Designation', 'blenco-core' );
		$contactmethods['rt_phone']     = __( 'Phone Number', 'blenco-core' );
		$contactmethods['rt_facebook']  = __( 'Facebook', 'blenco-core' );
		$contactmethods['rt_twitter']   = __( 'Twitter', 'blenco-core' );
		$contactmethods['rt_linkedin']  = __( 'LinkedIn', 'blenco-core' );
		$contactmethods['rt_vimeo']     = __( 'Vimeo', 'blenco-core' );
		$contactmethods['rt_youtube']   = __( 'Youtube', 'blenco-core' );
		$contactmethods['rt_instagram'] = __( 'Instagram', 'blenco-core' );
		$contactmethods['rt_pinterest'] = __( 'Pinterest', 'blenco-core' );
		$contactmethods['rt_whatsapp']  = __( 'Whatsapp', 'blenco-core' );

		return $contactmethods;
	}

	/*
	 * change post password from
	 */
	
	public static function rt_post_password_form() {
		global $post;

		$label = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );

		$output  = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">';
		$output .= '<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'blenco-core' ) . '</p>';
		$output .= '<p><label for="' . esc_attr( $label ) . '">';
		$output .= '<span class="pass-label">' . esc_html__( 'Password:', 'blenco-core' ) . '</span> ';
		$output .= '<input name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" /> ';
		$output .= '<input type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form', 'blenco-core' ) . '" />';
		$output .= '</label></p></form>';

		return $output;
	}


	/**
	 * Enable svg upload
	 *
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public function blenco_mime_types( $mimes ) {
		if ( ! blenco_option( 'rt_svg_enable' ) ) {
			return $mimes;
		}
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

}