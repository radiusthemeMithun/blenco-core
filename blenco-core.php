<?php
/*
Plugin Name: Blenco Core
Plugin URI: https://www.radiustheme.com
Description: Blenco Theme Core Plugin
Version: 1.0.2
Author: RadiusTheme
Author URI: https://www.radiustheme.com
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'BLENCO_CORE' ) ) {
	define( 'BLENCO_CORE', '1.0.0' );
	define( 'BLENCO_CORE_PREFIX', 'blenco' );
	define( 'BLENCO_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'BLENCO_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\BlencoCore\\Init' ) ) :
	RT\BlencoCore\Init::instance();
endif;

define( 'RDTHEME_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . 'demo-importer/' );
define( 'RDTHEME_CORE_BASE_URL', plugin_dir_url( __FILE__ ) . 'demo-importer/' );
require_once RDTHEME_CORE_DEMO_CONTENT . 'init.php';