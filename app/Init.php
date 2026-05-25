<?php
/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `config/custom/custom.php` to write your custom functions
 *
 * @package blenco
 */

//phpcs:disable

namespace RT\BlencoCore;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use RT\BlencoCore\Hooks\FilterHooks;
use RT\BlencoCore\Hooks\ActionHooks;

use RT\BlencoCore\Traits\SingletonTraits;

final class Init {

	use SingletonTraits;

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'blenco_theme_init', [ $this, 'after_theme_loaded' ] );
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ], 20 );
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );

	}

	/**
	 * Instantiate all class
	 * @return void
	 */
	public function after_theme_loaded() {
		FilterHooks::instance();
		ActionHooks::instance();
		Controllers\ScriptController::instance();
		Modules\WidgetOverwrite::instance();
		Api\RestApi::instance();
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			Controllers\PostTypeController::instance();
			Controllers\PostMetaController::instance();
			Api\WidgetInit::instance();
		}
		if ( did_action( 'elementor/loaded' ) ) {
			Controllers\ElementorController::instance();
			Controllers\ElmentorBuilderController::instance();
		}
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'blenco-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function demo_importer() {
		Controllers\DemoImportController::instance();
	}
}
