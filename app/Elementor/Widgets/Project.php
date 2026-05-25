<?php
//phpcs:disable
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\BlencoCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\BlencoCore\Abstracts\ElementorBase;
use RT\BlencoCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Project extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Project', 'blenco-core' );
		$this->rt_base = 'rt-project';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'blenco-core' ),
				'6'  => esc_html__( '2 Col', 'blenco-core' ),
				'4'  => esc_html__( '3 Col', 'blenco-core' ),
				'3'  => esc_html__( '4 Col', 'blenco-core' ),
				'2'  => esc_html__( '6 Col', 'blenco-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Project Layout', 'blenco-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => esc_html__( 'Project Grid 01', 'blenco-core' ),
					'layout-2' => esc_html__( 'Project Grid 02', 'blenco-core' ),
					'layout-3' => esc_html__( 'Project Grid 03', 'blenco-core' ),
					'layout-4' => esc_html__( 'Project Grid 04', 'blenco-core' ),
					'layout-5' => esc_html__( 'Project Grid 05', 'blenco-core' ),
					'layout-6' => esc_html__( 'Project Grid 06', 'blenco-core' ),
					'layout-7' => esc_html__( 'Project Grid 07', 'blenco-core' ),
					'layout-13' => esc_html__( 'Project Grid 08', 'blenco-core' ),
					'layout-8' => esc_html__( 'Project Slider 01', 'blenco-core' ),
					'layout-9' => esc_html__( 'Project Slider 02', 'blenco-core' ),
					'layout-10' => esc_html__( 'Project Slider 03', 'blenco-core' ),
					'layout-11' => esc_html__( 'Project Slider 04', 'blenco-core' ),
					'layout-12' => esc_html__( 'Project Slider 05', 'blenco-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => esc_html__( 'Alignment', 'blenco-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'blenco-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'blenco-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'blenco-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label'       => esc_html__( 'Project Limit', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Enter Project Limit', 'blenco-core' ),
				'description' => esc_html__( 'Enter number of team to show.', 'blenco-core' ),
				'default'     => '3',
				// 'condition'  => [
				// 	'layout!' => ['layout-6'],
				// ],
			]
		);

		$this->add_control(
			'item_space',
			[
				'type'        => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Item Gutter', 'blenco-core' ),
				'options' => [
					'g-0' => __( 'Gutters 0', 'blenco-core' ),
					'g-1' => __( 'Gutters 1', 'blenco-core' ),
					'g-2' => __( 'Gutters 2', 'blenco-core' ),
					'g-3' => __( 'Gutters 3', 'blenco-core' ),
					'g-4' => __( 'Gutters 4', 'blenco-core' ),
					'g-5' => __( 'Gutters 5', 'blenco-core' ),
				],
				'default' => 'g-4',
				'condition'  => [
					'layout' => ['layout-1','layout-2','layout-3','layout-4','layout-5', 'layout-6', 'layout-7','layout-13'],
				],
			]
		);

		$this->add_control(
			'query_type',
			[
				'label' => esc_html__( 'Query type', 'blenco-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => array(
					'category'  => esc_html__( 'Category', 'blenco-core' ),
					'posts' => esc_html__( 'Posts', 'blenco-core' ),
				),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label' => esc_html__( 'Selects posts', 'blenco-core' ),
				'type' => Controls_Manager::SELECT2,
				'options'     => rt_all_posts('rt-project'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'query_type' => 'posts',
				],
			]
		);

		$this->add_control(
			'cat_id',
			[
				'label' => esc_html__( 'Selects Category', 'blenco-core' ),
				'type' => Controls_Manager::SELECT2,
				'options' => rt_taxonomy_post('rt-project-category'),
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'query_type' => 'category',
				],
			]
		);

		$this->add_control(
			'post_ordering',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Ordering', 'blenco-core' ),
				'options' => [
					'DESC'	=> esc_html__( 'Desecending', 'blenco-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'blenco-core' ),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Sorting', 'blenco-core' ),
				'options' => [
					'recent' 		=> esc_html__( 'Recent Post', 'blenco-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'blenco-core' ),
					'title' 		=> esc_html__( 'By Name', 'blenco-core' ),
				],
				'default' => 'recent',
			]
		);

		$this->end_controls_section();

		// Option Settings
		$this->start_controls_section(
			'sec_option',
			[
				'label' => esc_html__( 'Option', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'enable_scroll_animation',
			[
				'label' => esc_html__( 'Scroll Animation', 'blenco-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'blenco-core' ),
				'label_off' => esc_html__( 'Off', 'blenco-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'  => [
					'layout' => ['layout-1'],
				],
			]
		);

		$this->add_control(
			'category_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Category Display', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Category. Default: On', 'blenco-core' ),
			]
		);

		$this->add_control(
			'project_number_display',
			[
				'label'        => __( 'Number Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'project_date_display',
			[
				'label'        => __( 'Date Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		// $this->add_control(
		// 	'pin_animation',
		// 	[
		// 		'label'        => __( 'Pin Animation Display', 'blenco-core' ),
		// 		'type'         => \Elementor\Controls_Manager::SWITCHER,
		// 		'label_on'     => __( 'On', 'blenco-core' ),
		// 		'label_off'    => __( 'Off', 'blenco-core' ),
		// 		'default'       => 'no',
		// 		'condition'  => [
		// 			'layout' => ['layout-1','layout-2'],
		// 		],
		// 	]
		// );

		$this->add_control(
			'content_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Content Display', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'blenco-core' ),
			]
		);

		$this->add_control(
			'content_type',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Content Type', 'blenco-core' ),
				'options' => array(
					'content' => esc_html__( 'Conents', 'blenco-core' ),
					'excerpt' => esc_html__( 'Excerpts', 'blenco-core' ),
				),
				'default'     => 'content',
				'description' => esc_html__( 'Display contents from Editor or Excerpt field', 'blenco-core' ),
				'condition'   => [
					'content_display' => ['yes'],
				],
			]
		);

		$this->add_control(
			'content_count',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Word count', 'blenco-core' ),
				'description' => esc_html__( 'Maximum number of words', 'blenco-core' ),
				'default' => 17,
				'condition'   => [
					'content_display' => ['yes'],
				],
			]
		);

		$this->add_control(
			'button_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Button Display', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Button. Default: On', 'blenco-core' ),
			]
		);

		$this->add_control(
			'item_heading',
			[
				'label'     => __( 'Box Item Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_item_radius',
			[
				'label'      => __( 'Box Radius', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-thumbs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
		'box_alignment',
			[
				'label'     => __( 'Box Alignment', 'blenco-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => true,
				'options'   => [
					'row'   => [
						'title' => __( 'Left', 'blenco-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'row-reverse'  => [
						'title' => __( 'Right', 'blenco-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'row',
				'condition' => [
					'layout' => ['layout-1'],
				],
				'selectors' => [
					'{{WRAPPER}} .project-grid-layout-1 .even .project-item' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_space',
			[
				'label'      => __( 'Margin', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_margin',
			[
				'label' => __('Content Margin', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'layout' => ['layout-4'],
				],
			]
		);

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'blenco-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => rt_get_all_image_sizes(),
			]
		);

		$this->add_control(
			'grayscale_display',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Grayscale Display', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'return_value' => 'is-blend',
				'description' => esc_html__( 'Show or Hide Image Grayscale. Default: Off', 'blenco-core' ),
			]
		);

		$this->add_control(
			'link_popup',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Link Button Option', 'blenco-core' ),
				'description' => esc_html__( 'Display contents details and image popup', 'blenco-core' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'blenco-core' ),
					'popup' => esc_html__( 'Image Popup', 'blenco-core' ),
				),
				'default'     => 'default',
			]
		);

		$this->end_controls_section();

		//project Content Settings
		$this->start_controls_section(
			'project_content_style',
			[
				'label' => esc_html__( 'Project Content Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'  => [
					'layout' => ['layout-1','layout-3'],
				],
			]
		);
		$this->add_control(
			'project_content_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-content' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'project_content_padding',
			[
				'label' => __('Padding', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'project_content_border',
				'label' => __('Border', 'blenco-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .project-content',
			]
		);

		$this->add_responsive_control(
			'project_content_radius',
			[
				'label' => __('Radius', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'project_content_space',
			[
				'label'      => __( 'Space', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Settings
		$this->start_controls_section(
			'sec_title_style',
			[
				'label' => esc_html__( 'Title Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .project-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Hover Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'title_space',
			[
				'label'      => __( 'Title Space', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'blenco-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'blenco-core' ),
					'h2' => esc_html__( 'H2', 'blenco-core' ),
					'h3' => esc_html__( 'H3', 'blenco-core' ),
					'h4' => esc_html__( 'H4', 'blenco-core' ),
					'h5' => esc_html__( 'H5', 'blenco-core' ),
					'h6' => esc_html__( 'H6', 'blenco-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Category Settings
		$this->start_controls_section(
			'sec_category_style',
			[
				'label' => esc_html__( 'Category Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typo',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-cat',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cat_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Hover Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cat_space',
			[
				'label'      => __( 'Category Space', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-cat' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cat_padding',
			[
				'label' => __('Padding', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'cat_radius',
			[
				'label' => __('Radius', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-cat a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Content Settings
		$this->start_controls_section(
			'sec_content_style',
			[
				'label' => esc_html__( 'Content Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .project-excerpt',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_space',
			[
				'label'      => __( 'Content Space', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Button More Settings
		//==============================================================
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__('Button Settings', 'blenco-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'button_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'See More',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'blenco-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);

		$this->add_control(
			'btn_space',
			[
				'label'      => __( 'Top Space', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .rt-button ' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Padding', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Radius', 'blenco-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		//Start button Style Tab
		$this->start_controls_tabs(
			'button_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __('Normal', 'blenco-core'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'blenco-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg',
				'label' => __('Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'blenco-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __('Border', 'blenco-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn',
			]
		);
		

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __('Hover', 'blenco-core'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'blenco-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .rt-button .btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-default .rt-button .btn:hover path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover',
				'label' => __('Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'label' => __('Box Shadow', 'blenco-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __('Border', 'blenco-core'),
				'selector' => '{{WRAPPER}} .rt-project-default .rt-button .btn:hover',
			]
		);
		$this->add_responsive_control(
			'icon_hover_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Hover Width', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn:hover .btn-icon:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// Button Icon
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Button Icon Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'button_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label'            => __( 'Choose Icon', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-arrow-right-1',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 40,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-button .btn i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-button .btn svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Icon Space', 'blenco-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn .btn-text' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Height', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn .btn-icon:after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Width', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-button .btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-button .btn .btn-icon:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_color',
				'label' => __('Icon Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-button .btn .btn-icon:after',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg_hover_color',
				'label' => __('Icon Hover Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Icon Hover Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .rt-button .btn:hover .btn-icon:after',
			]
		);
		$this->end_controls_section();

		// Date setting
		$this->start_controls_section(
			'date_style',
			[
				'label' => esc_html__( 'Date Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'project_date_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typo',
				'label'    => esc_html__( 'Date Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .project-date',
			]
		);
		$this->add_control(
			'date_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .project-date' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'date_space',
			[
				'label'      => __( 'Space', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .project-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();


		// Number setting
		$this->start_controls_section(
			'number_style',
			[
				'label' => esc_html__( 'Number Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'project_number_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typo',
				'label'    => esc_html__( 'Number Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-project-default .project-item .rt-project-number',
			]
		);
		$this->add_control(
			'number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .rt-project-number' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'position_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Horizontal', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .rt-project-number' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'position_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Position Vertical', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1200,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-project-default .project-item .rt-project-number' => 'bottom: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_control(
			'number_space',
			[
				'label'      => __( 'Space', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-project-default .project-item .rt-project-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		//....Project Cursor..........//
		$this->start_controls_section(
			'sec_cursor_style',
			[
				'label' => esc_html__( 'Project Cursor Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'enable_cursor_button',
			[
				'label'        => __( 'Enable Cursor Button', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'blenco-core' ),
				'label_off'    => __( 'No', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'cursor_btn_text',
			[
				'label'     => esc_html__( 'Cursor Button Text', 'blenco-core' ),
				'type'      => Controls_Manager::TEXTAREA, // Textarea for multi-line text (line break-er jonno)
				'default'   => 'View All <br> Project',
				'description' => esc_html__( 'Use <br> tag for a line break.', 'blenco-core' ),
				'condition' => [
					'enable_cursor_button' => 'yes',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cursor_typo',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '.cb-cursor.-portfolio .rt-project-btn .btn-text',
			]
		);

		$this->add_control(
    		'cursor_color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color (Button Text/Icon)', 'blenco-core' ),
				'selectors' => [
					'.cb-cursor.-portfolio .rt-project-btn .btn-text' => 'color: {{VALUE}};',
					'.cb-cursor.-portfolio .rt-project-btn i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'cursor_bg_color',
			[
				'label'     => __( 'Background Color', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'.cb-cursor.-portfolio .rt-project-btn' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'cursor_radius',
			[
				'label'      => __( 'Radius', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.cb-cursor.-portfolio .rt-project-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'cursor_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Width', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'body .cb-cursor.-portfolio .rt-project-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cursor_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Height', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'selectors' => [
					'body .cb-cursor.-portfolio .rt-project-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Content Box setting
		$this->start_controls_section(
			'content_box_style',
			[
				'label' => esc_html__( 'Content Box Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-2'],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_box_bg_color',
				'label' => __('Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .project-grid-layout-2 .project-item .project-content',
			]
		);
		$this->add_responsive_control(
			'content_box_padding',
			[
				'label' => __('Padding', 'blenco-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .project-grid-layout-2 .project-item .project-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_box_border',
				'label' => __('Border', 'blenco-core'),
				'selector' => '{{WRAPPER}} .project-grid-layout-2 .project-item .project-content',
			]
		);
		$this->add_control(
			'content_box_border_radius',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Radius', 'blenco-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .project-grid-layout-2 .project-item .project-content' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);


		$this->end_controls_section();

		
		// Slider setting
		$this->start_controls_section(
			'slider_style',
			[
				'label' => esc_html__( 'Slider Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => ['layout-8', 'layout-9', 'layout-10', 'layout-11', 'layout-12'],
				],
			]
		);

		$this->add_control(
			'arrow_hover_visibility',
			[
				'label'   => esc_html__( 'Arrow Visibility', 'blenco-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'blenco-core' ),
					'hover-visibility' => __( 'Hover', 'blenco-core' ),
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_radius',
			[
				'label'      => __( 'Radius', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Navigation Width', 'blenco-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Navigation Height', 'blenco-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'nex_prev_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Arrow Top / Bottom', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'prev_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Prev Arrow', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'next_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'next_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -500,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->start_controls_tabs(
			'navigation_style_tabs',
			[
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]

		);

		$this->start_controls_tab(
			'navigation_style_tab',
			[
				'label' => __( 'Normal', 'blenco-core' ),
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'arrow_button_border',
				'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'navigation_style_hover_tab',
			[
				'label' => __( 'Hover', 'blenco-core' ),
			]
		);
		$this->add_control(
			'arrow_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'ArrowHover Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Hover Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'arrow_button_hover_border',
				'selector' => '{{WRAPPER}} .swiper-navigation .swiper-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pagination_heading',
			[
				'label'     => __( 'Pagination Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_up_down',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Pagination UP / Down', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination Color', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);
		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __( 'Pagination Active Color', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'scrollbar_heading',
			[
				'label'     => __( 'Scrollbar Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'   => [
					'display_scrollbar' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scrollbar_up_down',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Scrollbar UP / Down', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-scrollbar' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'display_scrollbar' => 'yes',
				],
			]
		);

		$this->add_control(
			'scrollbar_border_color',
			[
				'label'     => __( 'Border Color', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-scrollbar' => 'border-color: {{VALUE}}',
				],
				'condition'   => [
					'display_scrollbar' => 'yes',
				],
			]
		);
		$this->add_control(
			'scrollbar_drag_color',
			[
				'label'     => __( 'Scrollbar Drag Color', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-scrollbar .swiper-scrollbar-drag' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_scrollbar' => 'yes',
				],
			]
		);
		$this->add_control(
			'scrollbar_drag_bg_color',
			[
				'label'     => __( 'Scrollbar Drag BG Color', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-scrollbar .swiper-scrollbar-drag' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_scrollbar' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'  => [
					'layout' => ['layout-1','layout-2','layout-3','layout-4','layout-5'],
				],
			]
		);

		$this->add_control(
			'col_xl',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 1199px', 'blenco-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_lg',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Desktops: > 991px', 'blenco-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			]
		);
		$this->add_control(
			'col_md',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Tablets: > 767px', 'blenco-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_sm',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Phones: < 768px', 'blenco-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			]
		);
		$this->add_control(
			'col_xs',
			[
				'type' => Controls_Manager::SELECT,
				'label'   => esc_html__( 'Small Phones: < 480px', 'blenco-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			]
		);

		$this->end_controls_section();

		// Slider responsive
		$this->start_controls_section(
			'section_slider_grid',
			[
				'label' => __( 'Slider Grid', 'blenco-core' ),
				'condition' => [
					'layout' => ['layout-8', 'layout-9', 'layout-10', 'layout-11', 'layout-12'],
				],
			]
		);

		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'blenco-core' ),
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1', 'blenco-core' ),
					'2' => esc_html__( '2', 'blenco-core' ),
					'3' => esc_html__( '3',  'blenco-core' ),
					'4' => esc_html__( '4',  'blenco-core' ),
					'5' => esc_html__( '5',  'blenco-core' ),
					'6' => esc_html__( '6',  'blenco-core' ),
				),
			]
		);
		$this->add_control(
			'md_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1200px', 'blenco-core' ),
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1', 'blenco-core' ),
					'2' => esc_html__( '2', 'blenco-core' ),
					'3' => esc_html__( '3',  'blenco-core' ),
					'4' => esc_html__( '4',  'blenco-core' ),
					'5' => esc_html__( '5',  'blenco-core' ),
					'6' => esc_html__( '6',  'blenco-core' ),
				),
			]
		);
		$this->add_control(
			'sm_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 992px', 'blenco-core' ),
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1', 'blenco-core' ),
					'2' => esc_html__( '2', 'blenco-core' ),
					'3' => esc_html__( '3',  'blenco-core' ),
					'4' => esc_html__( '4',  'blenco-core' ),
					'5' => esc_html__( '5',  'blenco-core' ),
				),
			]
		);
		$this->add_control(
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'blenco-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'blenco-core' ),
					'2' => esc_html__( '2', 'blenco-core' ),
					'3' => esc_html__( '3',  'blenco-core' ),
					'4' => esc_html__( '4',  'blenco-core' ),
					'5' => esc_html__( '5',  'blenco-core' ),
				),
			]
		);
		$this->add_control(
			'mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 576px', 'blenco-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'blenco-core' ),
					'2' => esc_html__( '2', 'blenco-core' ),
					'3' => esc_html__( '3',  'blenco-core' ),
					'4' => esc_html__( '4',  'blenco-core' ),
					'5' => esc_html__( '5',  'blenco-core' ),
				),
			]
		);
		$this->add_control(
			'sm_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 425px', 'blenco-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'blenco-core' ),
					'2' => esc_html__( '2', 'blenco-core' ),
					'3' => esc_html__( '3',  'blenco-core' ),
					'4' => esc_html__( '4',  'blenco-core' ),
					'5' => esc_html__( '5',  'blenco-core' ),
				),
			]
		);

		$this->end_controls_section();

		// Slider option
		$this->start_controls_section(
			'section_slider_option',
			[
				'label' => __( 'Slider Option', 'blenco-core' ),
				'condition' => [
					'layout' => ['layout-8', 'layout-9', 'layout-10', 'layout-11', 'layout-12'],
				],
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Autoplay', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'blenco-core' ),
			]
		);
		$this->add_control(
			'display_arrow',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Navigation Arrow', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'blenco-core' ),
			]
		);
		$this->add_control(
			'display_pagination',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Pagination', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Display Pagination. Default: Off', 'blenco-core' ),
			]
		);
		$this->add_control(
			'display_scrollbar',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Scrollbar', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Display Scrollbar. Default: Off', 'blenco-core' ),
			]
		);
		$this->add_control(
			'slides_per_group',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'slides Per Group', 'blenco-core' ),
				'default' => array(
					'size' => 1,
				),
				'description' => esc_html__( 'slides Per Group. Default: 1', 'blenco-core' ),
			]
		);
		$this->add_control(
			'centered_slides',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Centered Slides', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Centered Slides. Default: On', 'blenco-core' ),
			]
		);
		$this->add_control(
			'slides_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'Slides Space', 'blenco-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 24,
				),
				'description' => esc_html__( 'Slides Space. Default: 24', 'blenco-core' ),
			]
		);
		$this->add_control(
			'slider_autoplay_delay',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Delay', 'blenco-core' ),
				'default' => 5000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'blenco-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_autoplay_speed',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Speed', 'blenco-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'blenco-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Loop', 'blenco-core' ),
				'label_on'    => esc_html__( 'On', 'blenco-core' ),
				'label_off'   => esc_html__( 'Off', 'blenco-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'blenco-core' ),
			]
		);
		$this->end_controls_section();

		//Animation setting
		$this->start_controls_section(
			'animation_style',
			[
				'label' => esc_html__( 'Animation Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animation',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Animation', 'blenco-core' ),
				'options' => [
					'wow' => esc_html__( 'On', 'blenco-core' ),
					'wow-off'         => esc_html__( 'Off', 'blenco-core' ),
				],
				'default' => 'wow-off',
			]
		);

		$this->add_control(
			'animation_effect',
			[
				'type'    => Controls_Manager::SELECT,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'blenco-core' ),
				'options' => [
					'bounce' => esc_html__( 'bounce', 'blenco-core' ),
					'flash' => esc_html__( 'flash', 'blenco-core' ),
					'pulse' => esc_html__( 'pulse', 'blenco-core' ),
					'headShake' => esc_html__( 'headShake', 'blenco-core' ),
					'swing' => esc_html__( 'swing', 'blenco-core' ),
					'hinge' => esc_html__( 'hinge', 'blenco-core' ),
					'flipInX' => esc_html__( 'flipInX', 'blenco-core' ),
					'flipInY' => esc_html__( 'flipInY', 'blenco-core' ),
					'fadeIn' => esc_html__( 'fadeIn', 'blenco-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'blenco-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'blenco-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'blenco-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'blenco-core' ),
					'bounceIn' => esc_html__( 'bounceIn', 'blenco-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'blenco-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'blenco-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'blenco-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'blenco-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'blenco-core' ),
					'slideInDown' => esc_html__( 'slideInDown', 'blenco-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'blenco-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'blenco-core' ),
					'zoomIn' => esc_html__( 'zoomIn', 'blenco-core' ),
					'zoomInDown' => esc_html__( 'zoomInDown', 'blenco-core' ),
					'zoomInUp' => esc_html__( 'zoomInUp', 'blenco-core' ),
					'zoomInLeft' => esc_html__( 'zoomInLeft', 'blenco-core' ),
					'zoomInRight' => esc_html__( 'zoomInRight', 'blenco-core' ),
					'zoomOut' => esc_html__( 'zoomOut', 'blenco-core' ),
				],
				'default' => 'fadeInUp',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			]
		);

		$this->add_control(
			'delay',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Delay', 'blenco-core' ),
				'default' => '200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->add_control(
			'duration',
			[
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'blenco-core' ),
				'default' => '1200',
				'condition'   => [
					'animation' => [ 'wow' ]
				],
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data     = $this->get_settings();

		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$swiper_data = array(
			'slidesPerView' 	=>2,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		=>$data['slides_space']['size'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'slideToClickedSlide' =>true,
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['slider_autoplay_speed'],
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'425'    =>array('slidesPerView' =>$data['sm_mobile']),
				'576'    =>array('slidesPerView' =>$data['mobile']),
				'768'    =>array('slidesPerView' =>$data['tablet']),
				'992'    =>array('slidesPerView' =>$data['sm_desktop']),
				'1200'    =>array('slidesPerView' =>$data['md_desktop']),
				'1600'    =>array('slidesPerView' =>$data['desktop'])
			),
			'auto'   =>$data['slider_autoplay']
		);

		switch ( $data['layout'] ) {
			case 'layout-12':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-5';
				break;
			case 'layout-11':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-4';
				break;
			case 'layout-10':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-3';
				break;
			case 'layout-9':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-2';
				break;
			case 'layout-8':
				$data['swiper_data'] = json_encode( $swiper_data );
				$template = 'view-slider-1';
				break;
			case 'layout-13':
				$template = 'view-8';
				break;
			case 'layout-7':
				$template = 'view-7';
				break;
			case 'layout-6':
				$template = 'view-6';
				break;
			case 'layout-5':
				$template = 'view-5';
				break;
			case 'layout-4':
				$template = 'view-4';
				break;
			case 'layout-3':
				$template = 'view-3';
				break;
			case 'layout-2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}

		$data['cursor_btn_text'] = $data['cursor_btn_text'];
		$data['enable_cursor_button'] = $data['enable_cursor_button'];

		Fns::get_template( "elementor/project/$template", $data );
	}

}