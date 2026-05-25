<?php
/**
 * Theme Demo Configuration File
 *
 * This file contains the configuration for the demo importer.
 *
 * @package @package Radiustheme\Blenco
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

return [
	// Basic theme information.
	'blog_slug'           => 'blog',
	'demo_url'            => 'https://www.radiustheme.com/demo/wordpress/themes/blenco/',
	'commenter_email'     => 'dev-email@wpengine.local',
	'menus'               => [
		'primary'  => 'Primary Menu',
	],

	// File paths.
	'demo_content_zip'    => 'demo-files/demo-content.zip',

	// Demo variants.
	'demo_variants'       => [
		'home' => [
			'name'    => 'Home',
			'preview' => 'screenshots/home-1.webp',
			'url'     => '',
		],
		'home-02' => [
			'name'    => 'Home 02',
			'preview' => 'screenshots/home-2.webp',
			'url'     => 'home-02/',
		],
		'home-03' => [
			'name'    => 'Home 03',
			'preview' => 'screenshots/home-3.webp',
			'url'     => 'home-03/',
		],
		'home-04' => [
			'name'    => 'Home 04',
			'preview' => 'screenshots/home-4.webp',
			'url'     => 'home-04/',
		],
		'home-05' => [
			'name'    => 'Home 05',
			'preview' => 'screenshots/home-5.webp',
			'url'     => 'home-05/',
		],
		'home-06' => [
			'name'    => 'Home 06',
			'preview' => 'screenshots/home-6.webp',
			'url'     => 'home-06/',
		],
	
		'home-07' => [
			'name'    => 'Home 07',
			'preview' => 'screenshots/home-7.webp',
			'url'     => 'home-07/',
		],
		'home-08' => [
			'name'    => 'Home 08',
			'preview' => 'screenshots/home-8.webp',
			'url'     => 'home-08/',
		],
		'home-09' => [
			'name'    => 'Home 09',
			'preview' => 'screenshots/home-9.webp',
			'url'     => 'home-09/',
		],
		'home-10' => [
			'name'    => 'Home 10',
			'preview' => 'screenshots/home-10.webp',
			'url'     => 'home-10/',
		],
		'home-11' => [
			'name'    => 'Home 11',
			'preview' => 'screenshots/home-11.webp',
			'url'     => 'home-11/',
		],
	],

	// Additional settings.
	'settings_json'       => [
		'_fluentform_global_form_settings',
		'rtsb_extra_settings',
		'rtsb_settings',
		'rtsb_template_settings',
	],
	'fluent_forms_json'   => 'fluentform',

	// WordPress repository plugins.
	'wp_plugins'          => [
		'breadcrumb-navxt'               => 'Breadcrumb NavXT',
		'elementor'                      => 'Elementor Page Builder',
		'fluentform'                     => 'WP Fluent Forms',
		// 'woocommerce'                    => 'WooCommerce',
		// 'shopbuilder'                    => 'ShopBuilder – Elementor WooCommerce Builder Addons',
	],

	// Bundled/Premium plugins.
	'bundled_plugins'     => [
		'blenco-core' => [
			'name' => 'Blenco Core',
			'file' => 'plugin-bundle/blenco-core.zip',
		],
		'rt-framework'                       => [
			'name' => 'RT Framework',
			'file' => 'plugin-bundle/rt-framework.zip',
		],
	],

	// Enable/disable import features.
	'features'            => [
		// 'woo_support'     => true,
		'elementor_fixes' => true,
	],

	'elementor_fixes' => [
		'rt-project' => [ 'cat_id' ],
		'rt-post' => [ 'categories' ],
	],

	// Pre-import options.
	'pre_import_options'  => [
		'elementor_experiment-e_font_icon_svg' => 'inactive',
	],

	// Post-import options.
	'post_import_options' => [
		'elementor_unfiltered_files_upload' => true,
	],
];
