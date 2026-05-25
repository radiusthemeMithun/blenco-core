<?php
//phpcs:disable
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\BlencoCore\Api\Widgets;

use RT\BlencoCore\Helper\Fns;
use RT\Blenco\Helpers\Fns as ThemeFns;
use \WP_Widget;
use \RT_Widget_Fields;


class Post_Widget extends WP_Widget {

	public function __construct() {
		$id    = BLENCO_CORE_PREFIX . '_blog_post';
		$title = __( 'Blenco: Blog Post', 'blenco-core' );
		$args  = [
			'description' => esc_html__( 'Displays Blog Post', 'blenco-core' )
		];
		parent::__construct( $id, $title, $args );
	}


	public function form( $instance ) {
		$defaults = [
			'title'          => __( 'Latest Posts', 'blenco-core' ),
			'posts_type'     => 'post',
			'posts_per_page' => 5,
			'orderby'        => 'date',
			'order'          => 'DESC',
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = [
			'title'          => [
				'label' => esc_html__( 'Title', 'blenco-core' ),
				'type'  => 'text',
			],
			'layout'         => [
				'label'   => esc_html__( 'Layout Style', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'blog-list-style'      => __( 'List', 'blenco-core' ),
					'blog-grid-style'      => __( 'Grid', 'blenco-core' ),
				]
			],
			'query_title'    => [
				'label' => esc_html__( 'QUERY', 'blenco-core' ),
				'type'  => 'heading',
			],
			'posts_type'     => [
				'label'   => esc_html__( 'Post Type', 'blenco-core' ),
				'type'    => 'select',
				'options' => ThemeFns::get_post_types()
			],
			'posts_per_page' => [
				'label' => esc_html__( 'Posts Per Page', 'blenco-core' ),
				'type'  => 'number',
			],
			'orderby'        => [
				'label'   => esc_html__( 'Order by', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'date'          => __( 'Date', 'blenco-core' ),
					'author'        => __( 'Author', 'blenco-core' ),
					'title'         => __( 'Title', 'blenco-core' ),
					'modified'      => __( 'Last modified date', 'blenco-core' ),
					'parent'        => __( 'Post parent ID', 'blenco-core' ),
					'comment_count' => __( 'Number of comments', 'blenco-core' ),
					'menu_order'    => __( 'Menu order', 'blenco-core' ),
					'rand'          => __( 'Random order', 'blenco-core' ),
					'popular'       => __( 'Popular Post', 'blenco-core' ),
				]
			],
			'order'          => [
				'label'   => esc_html__( 'Order', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'ASC'  => __( 'ASC', 'blenco-core' ),
					'DESC' => __( 'DESC', 'blenco-core' ),
				]
			],
			'post_id'        => [
				'label' => esc_html__( 'Post by ID', 'blenco-core' ),
				'type'  => 'text',
				'desc'  => esc_html__( 'Enter post id by comma (,) separator.', 'blenco-core' ),
			],

			'meta_title'         => [
				'label' => esc_html__( 'Choose Meta', 'blenco-core' ),
				'type'  => 'heading',
			],
			'category'           => [
				'label' => esc_html__( 'Category', 'blenco-core' ),
				'type'  => 'checkbox',
			],
			'author'             => [
				'label' => esc_html__( 'Author', 'blenco-core' ),
				'type'  => 'checkbox',
			],
			'date'               => [
				'label' => esc_html__( 'Date', 'blenco-core' ),
				'type'  => 'checkbox',
			],
			'content'               => [
				'label' => esc_html__( 'Content', 'blenco-core' ),
				'type'  => 'checkbox',
			],
		];

		RT_Widget_Fields::display( $fields, $instance, $this );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']              = $new_instance['title'] ?? __( 'Latest Post', 'blenco-core' );
		$instance['layout']             = $new_instance['layout'] ?? 'blog-list-style';
		$instance['posts_type']         = $new_instance['posts_type'] ?? 'post';
		$instance['posts_per_page']     = $new_instance['posts_per_page'] ?? 5;
		$instance['orderby']            = $new_instance['orderby'] ?? 'date';
		$instance['order']              = $new_instance['order'] ?? 'DESC';
		$instance['post_id']            = $new_instance['post_id'] ?? '';
		$instance['category']           = $new_instance['category'] ?? '';
		$instance['author']             = $new_instance['author'] ?? '';
		$instance['date']               = $new_instance['date'] ?? '';
		$instance['content']            = $new_instance['content'] ?? '';

		return $instance;
	}


	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );
		if ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			echo wp_kses_post( $args['before_title'] . $html . $args['after_title'] );
		}
		else {
			$html = '';
		}

		$postArgs = [
			'post_type'           => $instance['posts_type'] ?? 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $instance['posts_per_page'] ?? 5,
			'post_status'         => 'publish',
		];

		if ( ! empty( $instance['orderby'] ) ) {
			$postArgs['orderby'] = $instance['orderby'];
		}

		if ( ! empty( $instance['order'] ) ) {
			$postArgs['order'] = $instance['order'];
		}

		if ( ! empty( $instance['post_id'] ) ) :
			$post_ids             = explode( ',', $instance['post_id'] );
			$postArgs['post__in'] = $post_ids;
		endif;

		$query = new \WP_Query( $postArgs );

		$meta_list  = [];
		$_meta_list = blenco_option( 'rt_blog_meta', false, true );
		foreach ( $_meta_list as $meta ) {
			if ( ! empty( $instance[ $meta ] ) ) {
				$meta_list[] = $meta;
			}
		}

		$data       = [
			'meta_list'          => $meta_list,
			'content' => $instance['content']??[],
		];

		$layout     = $instance['layout'] ?? 'blog-list-style';
		$post_count = 1;
		if ( $query->have_posts() ) :
			echo "<div class='dentcure-widdget-post " . esc_attr( $layout ) . "'>";
			while ( $query->have_posts() ) : $query->the_post();
				set_query_var( 'post_count', $post_count );
				Fns::get_template( "widgets/latest-posts", $data );
				$post_count ++;
			endwhile;
			echo "</div>";
			wp_reset_postdata();
		endif;

		echo wp_kses_post( $args['after_widget'] );
	}
}