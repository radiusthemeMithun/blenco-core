<?php
//phpcs:disable
namespace RT\BlencoCore\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use RT\BlencoCore\Traits\SingletonTraits;
use RT\Blenco\Options\Opt;
use \RT_Posts;

class PostTypeController {
	use SingletonTraits;

	public $post_type;

	public function __construct() {
		$this->post_type = RT_Posts::getInstance();
		add_action('init', [$this, 'register_post_type'], 5);
	}

	/**
	 * Register post_type and taxonomy
	 *
	 * @return void
	 */
	public function register_post_type() {
		$this->register_custom_post_type();
		$this->register_custom_taxonomy();
	}

	/**
	 * Register custom post type
	 * @return void
	 */
	private function register_custom_post_type() {
		$custom_posts = [
			[
				'id'            => 'rt-team',
				'slug'          => get_theme_mod('rt_team_slug'),
				'singular'      => 'Team',
				'plural'        => 'Teams',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 20,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Teams Custom Post Type', 'blenco-core' ),
				'hierarchical'  => true
			],
			[
				'id'            => 'rt-service',
				'slug'          => get_theme_mod('rt_service_slug'),
				'singular'      => 'Service',
				'plural'        => 'Services',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 21,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Service Custom Post Type', 'blenco-core' ),
			],
			[
				'id'            => 'rt-project',
				'slug'          => get_theme_mod('rt_project_slug'),
				'singular'      => 'Project',
				'plural'        => 'Project',
				'menu_icon'     => 'dashicons-admin-customizer',
				'menu_position' => 22,
				'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments' ],
				'description'   => __( 'Project Custom Post Type', 'blenco-core' ),
			]
		];

		$this->post_type->add_post_types( $custom_posts );
	}

	/**
	 * Register custom taxonomy
	 * @return void
	 */
	private function register_custom_taxonomy() {
		$custom_posts = [
			[
				'id'        => 'rt-team-category',
				'post_type' => [ 'rt-team' ],
				'slug'      => get_theme_mod('rt_team_cat_slug'),
				'singular'  => __( 'Team Category', 'blenco-core' ),
				'plural'    => __( 'Team Categories', 'blenco-core' ),
			],
			[
				'id'        => 'rt-service-category',
				'post_type' => [ 'rt-service' ],
				'slug'      => get_theme_mod('rt_service_cat_slug'),
				'singular'  => __( 'Service Category', 'blenco-core' ),
				'plural'    => __( 'Service Categories', 'blenco-core' ),
			],
			[
				'id'        => 'rt-project-category',
				'post_type' => [ 'rt-project' ],
				'slug'      => get_theme_mod('rt_project_cat_slug'),
				'singular'  => __( 'Project Category', 'blenco-core' ),
				'plural'    => __( 'Project Categories', 'blenco-core' ),
			]
		];

		$this->post_type->add_taxonomies( $custom_posts );
	}
}

