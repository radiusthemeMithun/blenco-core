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
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use RT\BlencoCore\Abstracts\ElementorBase;
use RT\BlencoCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Title extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Section Title', 'blenco-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}


	protected function register_controls() {
		/* General Options */

		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_layout',
			[
				'label'       => esc_html__( 'Title Layout', 'blenco-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => __( 'Layout 01', 'blenco-core' ),
					'layout-2' => __( 'Layout 02', 'blenco-core' ),
				],
				'default'     => 'layout-1',
			]
		);

		$this->add_control(
			'top_sub_title',
			[
				'label'       => esc_html__( 'Top Sub Title', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Why Choose Our About', 'blenco-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Main Title', 'blenco-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'default'     => __( 'Welcome To Our Blenco', 'blenco-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span>.", 'blenco-core' ),
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'blenco-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default'     => __('Manage and streamline operations across multiple locations, sales channels, and employees to improve efficiency and your bottom line.', 'blenco-core' ),
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);
		$this->add_control(
			'text_animation',
			[
				'label'        => __( 'Animation Title Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'blenco-core' ),
				'label_off'    => __( 'Off', 'blenco-core' ),
				'default'       => 'no',
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);
			$this->add_control(
			'title_animation_2',
			[
				'label'        => __( 'Animation Title  Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'blenco-core' ),
				'label_off'    => __( 'Off', 'blenco-core' ),
				'default'       => 'no',
				'condition'  => [
					'title_layout' => 'layout-2',
				],
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_text',
			[
				'label'       => __( 'List Text', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Powerful database store', 'blenco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_icon',
			[
				'label'            => __( 'Choose Icon', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-correct',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'show_feature_list',
			[
				'label'        => __( 'Feature List', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'blenco-core' ),
				'label_off'    => __( 'Off', 'blenco-core' ),
				'return_value' => 'is-feature',
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'feature_lists',
			[
				'label'       => __( 'Feature List', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'list_text'        => __( 'Powerful database store', 'blenco-core' ),
					],
					[
						'list_text'        => __( 'Easy to access all projects', 'blenco-core' ),
					],
					[
						'list_text'        => __( 'Effortless courier allocation', 'blenco-core' ),
					],
					[
						'list_text'        => __( 'Widest coverage network', 'blenco-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
				'condition'   => [
					'show_feature_list' => [ 'is-feature' ],
					'title_layout' => ['layout-1'],
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'blenco-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'       => '',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'blenco-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'blenco-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'blenco-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .main-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_two',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Color 2', 'blenco-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span> from main title.", 'blenco-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .main-title span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_gradient_change_display',
			[
				'label'        => __( 'Gradient Title', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'title-gradient',
				'default'      => 'no',
				'condition' => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'title_gradient_animation',
			[
				'label'       => esc_html__( 'Title Animation', 'blenco-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'default-animation' => __( 'Default', 'blenco-core' ),
					'title-gradient-animation' => __( 'Animation', 'blenco-core' ),
				],
				'default'     => 'title-gradient-animation',
				'condition' => [
					'title_layout' => ['layout-1'], 'title_gradient_change_display' => ['title-gradient'],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_gradient_color',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .section-title-wrapper .title-gradient',
				'return_value' => 'title-gradient',
				'condition' => [
					'title_layout' => ['layout-1'], 'title_gradient_change_display' => ['title-gradient'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_span_typo',
				'label'    => esc_html__( 'Typo 2', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title span',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_image_aline',
			[
				'label'       => esc_html__( 'Title Inline Image Align', 'blenco-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'baseline' => __( 'Baseline', 'blenco-core' ),
					'middle' => __( 'Middle', 'blenco-core' ),
					'bottom' => __( 'Bottom', 'blenco-core' ),
				],
				'default'     => 'middle',
			]
		);

		$this->add_control(
			'main_title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'blenco-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__( 'H1', 'blenco-core' ),
					'h2' => esc_html__( 'H2', 'blenco-core' ),
					'h3' => esc_html__( 'H3', 'blenco-core' ),
					'h4' => esc_html__( 'H4', 'blenco-core' ),
					'h5' => esc_html__( 'H5', 'blenco-core' ),
					'h6' => esc_html__( 'H6', 'blenco-core' ),
					'span' => esc_html__( 'Span', 'blenco-core' ),
					'div' => esc_html__( 'Div', 'blenco-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Top Sub Title
		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( 'Sub Title Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_title_style',
			[
				'label'     => __( 'Sub Title Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'  => __( 'Default', 'blenco-core' ),
					'left-right-shape'  => __( 'Sub Title Shape', 'blenco-core' ),
				],
			]
		);

		$this->add_control(
			'animation_spin',
			[
				'label'        => __( 'Animation Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'blenco-core' ),
				'label_off'    => __( 'Off', 'blenco-core' ),
				'default'       => 'no',
			]
		);

		// Left Shape Switch
		$this->add_control(
			'left_shape_display',
			[
				'label'        => esc_html__( 'Left Shape Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'blenco-core' ),
				'label_off'    => esc_html__( 'Off', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		// Left Shape Image
		$this->add_control(
			'left_shape_image',
			[
				'label'     => esc_html__( 'Left Shape Image', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'left_shape_display' => 'yes',
				],
			]
		);

		// Right Shape Switch
		$this->add_control(
			'right_shape_display',
			[
				'label'        => esc_html__( 'Right Shape Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'blenco-core' ),
				'label_off'    => esc_html__( 'Off', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		// Right Shape Image
		$this->add_control(
			'right_shape_image',
			[
				'label'     => esc_html__( 'Right Shape Image', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'right_shape_display' => 'yes',
				],
			]
		);


		$this->add_control(
			'top_title_icon',
			[
				'label'   => __( 'Choose Icons', 'blenco-core' ),
				'type'    => \Elementor\Controls_Manager::ICON,
				'include' => [
					'icon-rt-arrow-right-1',
					'icon-rt-correct',
					'icon-rt-arrow-vector',
					'icon-rt-chevron-right',
				],
				'default' => '',
			]
		);


		$this->add_control(
			'icon_position',
			[
				'label'     => __( 'Icon Position', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Left', 'blenco-core' ),
					'right' => __( 'Right', 'blenco-core' ),
					'both'  => __( 'Both', 'blenco-core' ),
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_control(
			'top_title_icon_size',
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
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'   => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'top_title_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-title-wrapper .top-sub-title svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'top_title_bg_color',
				'label' => __('Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
				'condition' => [
					'sub_title_style!' => 'default',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_typo',
				'label'    => esc_html__( 'Typography', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_responsive_control(
			'top_title_padding',
			[
				'label'              => __( 'Padding', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'sub_title_style!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => __( 'Margin', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%'],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Line Shape Settings
		$this->start_controls_section(
			'line_shape_settings',
			[
				'label' => esc_html__( 'Line Shape Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'description' => esc_html__( 'Only use layout 1', 'blenco-core' ),
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_control(
			'title_line_shape',
			[
				'label'        => __( 'Title Line Shape', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'blenco-core' ),
				'label_off'    => __( 'Off', 'blenco-core' ),
				'default'       => 'no',
				'return_value' => 'line-shape has-animation',
			]
		);

		$this->add_control(
			'line_shape_color',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Shape Color', 'blenco-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'background-color: {{VALUE}}',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Width', 'blenco-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape.active-animation:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Height', 'blenco-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Horizontal', 'blenco-core' ),
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
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);
		$this->add_responsive_control(
			'line_shape_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Shape Vertical', 'blenco-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
					],
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->add_responsive_control(
			'line_shape_radius',
			[
				'label'              => __( 'Shape Radius', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .line-shape:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->end_controls_section();


		// Description Settings
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description & List Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'  => [
					'title_layout' => 'layout-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%','px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'list_typo',
				'label'    => esc_html__( 'List Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper ul.feature-list li',
			]
		);

		$this->add_control(
			'list_column',
			[
				'label'     => __( 'List Column', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'  => __( 'One Column', 'blenco-core' ),
					'two-column' => __( 'Two Column', 'blenco-core' ),
				],
			]
		);

		$this->add_control(
			'list_layout',
			[
				'label'     => __( 'List Layout', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'list-layout-1',
				'options'   => [
					'list-layout-1' => __( 'Layout 1', 'blenco-core' ),
					'list-layout-2' => __( 'layout 2', 'blenco-core' ),
				],
			]
		);

		$this->add_control(
			'list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_icon_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon BG Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'list_icon_border',
				'label'    => __( 'Border', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .feature-list li span',
			]
		);
		$this->add_responsive_control(
			'list_icon_radius',
			[
				'label'              => __( 'Radius', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .feature-list li span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'list_padding',
			[
				'label'              => __( 'Padding', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ '%','px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper ul.feature-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Background Title Settings
		//==============================================================
		$this->start_controls_section(
			'Common Settings',
			[
				'label' => esc_html__( 'Common Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_title_wrap_margin',
			[
				'label'              => __( 'Wrapper Margin', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
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

		switch ( $data['title_layout'] ) {
			case 'layout-2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}

		Fns::get_template( "elementor/title/$template", $data );
	}

}