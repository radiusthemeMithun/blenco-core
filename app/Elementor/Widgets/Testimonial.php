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
use RT\BlencoCore\Helper\Fns;
use RT\BlencoCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Testimonial extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Testimonial', 'blenco-core' );
		$this->rt_base = 'rt-testimonial';
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'blenco-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Title', 'blenco-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Name', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Name', 'blenco-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'designation',
			[
				'label'       => __( 'Designation', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'blenco-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'blenco-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'blenco-core' ),
			]
		);

		$repeater->add_control(
			'rating',[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Rating', 'blenco-core' ),
				'default' => '5',
				'options' => [
					'1' => esc_html__( 'Rating 1', 'blenco-core' ),
					'2' => esc_html__( 'Rating 2', 'blenco-core' ),
					'3' => esc_html__( 'Rating 3', 'blenco-core' ),
					'4' => esc_html__( 'Rating 4', 'blenco-core' ),
					'5' => esc_html__( 'Rating 5', 'blenco-core' ),
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'blenco-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Slider', 'blenco-core' ),
					'layout-2' => __( 'Slider 02', 'blenco-core' ),
					'layout-3' => __( 'Slider 03', 'blenco-core' ),
					'layout-4' => __( 'Card Slider', 'blenco-core' ),
					'layout-5' => __( 'Marquee Horizontal', 'blenco-core' ),
					'layout-6' => __( 'Marquee Vertical', 'blenco-core' ),
					'layout-7' => __( 'Grid 01', 'blenco-core' ),
					'layout-8' => __( 'Grid 02', 'blenco-core' ),
					'layout-9' => __( 'Grid 03', 'blenco-core' ),
				],
			]
		);

		$this->add_control(
			'main_title',
			[
				'label'       => esc_html__( 'Title', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Join Thousands of Satisfied Customers', 'blenco-core' ),
				'condition' => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->add_control(
			'marquee_direction',
			[
				'label'   => __( 'Marquee', 'blenco-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'marquee-left',
				'options' => [
					'marquee-left' => __( 'Left Direction', 'blenco-core' ),
					'marquee-right' => __( 'Right Direction', 'blenco-core' ),
				],
				'condition' => [
					'layout' => 'layout-5',
				],
			]
		);

		$this->add_control(
			'marquee_direction_two',
			[
				'label'   => __( 'Marquee', 'blenco-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'marquee-top',
				'options' => [
					'marquee-top' => __( 'Top Direction', 'blenco-core' ),
					'marquee-bottom' => __( 'Bottom Direction', 'blenco-core' ),
				],
				'condition' => [
					'layout' => 'layout-6',
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Testimonial List', 'blenco-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name'        => __( 'Mr.Marke Josefer', 'blenco-core' ),
						'designation' => __( 'CEO, PSDBOSS', 'blenco-core' ),
						'content'     => __( 'Manage and streamline operations acrosers multiple locations wear sales channels, and employees toter improve efficiency streamline',
							'blenco-core' ),
					],
					[
						'name'        => __( 'Ronald Richards', 'blenco-core' ),
						'designation' => __( 'WordPress Developer', 'blenco-core' ),
						'content'     => __( 'Manage and streamline operations acrosers multiple locations wear sales channels, and employees toter improve efficiency streamline',
							'blenco-core' ),
					],
					[
						'name'        => __( 'Merry Jiucy', 'blenco-core' ),
						'designation' => __( 'Web Designer', 'blenco-core' ),
						'content'     => __( 'Manage and streamline operations acrosers multiple locations wear sales channels, and employees toter improve efficiency streamline', 'blenco-core' ),
					],

				],
				'title_field' => '{{{ name }}}',
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
					'layout' => ['layout-7', 'layout-8', 'layout-9'],
				],
			]
		);

		$this->add_control(
			'quote_icon',
			[
				'label'            => __( 'Quote Icon', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'icon-rt-quote-2',
					'library' => 'solid',
				],
			]
		);

		$this->end_controls_section();

		//Option setting
		$this->start_controls_section(
			'section_option',
			[
				'label' => __( 'Option', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_display',
			[
				'label'        => __( 'Rating Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'thumb_display',
			[
				'label'        => __( 'Thumb Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'designation_display',
			[
				'label'        => __( 'Designation Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'quote_display',
			[
				'label'        => __( 'Quote Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'no',
				'default'      => 'no',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Radius', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_bag_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item',
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'blenco-core' ),
				'type'      => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .rt-testimonial-slider .slider-item' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Content setting
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'blenco-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'thumb_size',
			[
				'label'      => __( 'Thumb Size', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-img img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_radius',
			[
				'label'      => __( 'Radius', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'title_style_heading',
			[
				'label'     => __( 'Title Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'test_title_typo',
				'label'    => esc_html__( 'Title Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .testimonial-title',
			]
		);

		$this->add_control(
			'test_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .testimonial-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'test_title_space',
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
					'{{WRAPPER}} .rt-testimonial-slider .testimonial-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_style_heading',
			[
				'label'     => __( 'Name Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Name Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Name Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-layout-1 .rt-title:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'layout-1',
				],
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label'      => __( 'Name Space', 'blenco-core' ),
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
					'{{WRAPPER}} .rt-testimonial-slider .rt-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'designation_style_heading',
			[
				'label'     => __( 'Designation Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typo',
				'label'    => esc_html__( 'Designation Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle',
			]
		);

		$this->add_control(
			'designation_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Designation', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'designation_space',
			[
				'label'      => __( 'Designation Space', 'blenco-core' ),
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
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label'      => __( 'Content Space', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .rt-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quote_style_heading',
			[
				'label'     => __( 'Quote Icon Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quote_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Quote Icon', 'blenco-core' ),
				'description' => esc_html__( 'If you would like to use only icon color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'quote_icon_size',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Quote Size', 'blenco-core' ),
				'description' => esc_html__( 'If you would like to use only icon size', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'font-size: {{VALUE}}px',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_horizontal',
			[
				'label'      => __( 'Horizontal Position', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_icon_vertical',
			[
				'label'      => __( 'Vertical Position', 'blenco-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .quote' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-3 .quote' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_style_heading',
			[
				'label'     => __( 'Rating Style', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating .deactive' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'rating_active_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Rating Active Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating .active' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[
				'label'     => __( 'Font Size', 'blenco-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 10,
				'max'       => 50,
				'step'      => 1,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating' => 'font-size: {{VALUE}}px',
				],
				'condition' => [
					'rating_display' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'rating_space',
			[
				'label'      => __( 'Rating Space', 'blenco-core' ),
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
					'{{WRAPPER}} .rt-testimonial-slider .slider-item .item-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-4 .slider-item .item-rating' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-testimonial-layout-9 .slider-item .item-rating' => 'top: {{SIZE}}{{UNIT}};',
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
					'layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
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
					'display_arrow' => 'yes', 'layout!' => 'layout-4',
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
					'display_arrow' => 'yes', 'layout!' => 'layout-4',
				],
			]
		);
		$this->add_responsive_control(
			'next_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
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
					'display_arrow' => 'yes', 'layout!' => 'layout-4',
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
				'name' => 'button_border',
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
				'name' => 'button_hover_border',
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

		$this->end_controls_section();

		// Responsive Settings
		$this->start_controls_section(
			'sec_grid_responsive',
			[
				'label' => esc_html__( 'Number of Responsive Columns', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition'  => [
					'layout' => ['layout-7', 'layout-8', 'layout-9'],
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
					'layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
				],
			]
		);

		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'blenco-core' ),
				'default' => '2',
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
				'default' => '2',
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
		$this->add_control(
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'blenco-core' ),
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
		$this->add_control(
			'mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 576px', 'blenco-core' ),
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
					'layout' => ['layout-1', 'layout-2', 'layout-3', 'layout-4'],
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
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'blenco-core' ),
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
		$data = $this->get_settings();

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

		if ( 'layout-4' == $data['layout'] ) {
			$swiper_data['effect'] = "cards";
		}

		$data['swiper_data'] = json_encode( $swiper_data );

		//$template = 'view-1';

		if ( 'layout-1' == $data['layout'] ) {
			$template = 'view-1';
		} elseif ( 'layout-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'layout-3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'layout-4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'layout-5' == $data['layout'] ) {
			$template = 'view-5';
		} elseif ( 'layout-6' == $data['layout'] ) {
			$template = 'view-6';
		} elseif ( 'layout-7' == $data['layout'] ) {
			$template = 'view-grid-1';
		} elseif ( 'layout-8' == $data['layout'] ) {
			$template = 'view-grid-2';
		} elseif ( 'layout-9' == $data['layout'] ) {
			$template = 'view-grid-3';
		}

		Fns::get_template( "elementor/testimonial/$template", $data );
	}

}