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

class ServiceBox extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Service Box', 'blenco-core' );
		$this->rt_base = 'rt-service-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'rt_service_box',
			[
				'label' => esc_html__( 'Service Box Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'       => esc_html__( 'Layout', 'blenco-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'   => [
					'layout-1' => esc_html__( 'Layout 01', 'blenco-core' ),
					'layout-2' => esc_html__( 'Layout 02', 'blenco-core' ),
				],
				'default'     => 'layout-1',
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image', [
				'type' => Controls_Manager::MEDIA,
				'label' =>   esc_html__('Image', 'blenco-core'),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Welcome To blenco', 'blenco-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'number',
			[
				'label'       => esc_html__( 'Number', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '01', 'blenco-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'content',
			[
				'label'       => esc_html__( 'Content', 'blenco-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'our Creative Digitala ewe bring  engaging
									Digital Agenclife beach crafting', 'blenco-core' ),
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'icon_type',
			[
				'label'   => __( 'Icon Type', 'blenco-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', 'blenco-core' ),
				],
			]
		);

		$repeater->add_control(
			'service_icon',
			[
				'label'            => __( 'Choose Icon', 'blenco-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition'        => [
					'icon_type' => [ 'icon' ],
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'blenco-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'blenco-core' ),
				'show_external' => true,
				'dynamic'       => [
					'active' => true,
				],
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);
		$repeater->add_control(
			'shape', [
				'type' => Controls_Manager::MEDIA,
				'label' =>   esc_html__('Shape', 'blenco-core'),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

	

		$this->add_control(
			'items',
			[
				'label' => __('Service List', 'blenco-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Creative Development', 'blenco-core'),
					],
					[

						'title' => __('Users on Marketplaces', 'blenco-core'),

					],
					[

						'title' => __('Creative Development', 'blenco-core'),

					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'image_shape', [
				'type' => Controls_Manager::MEDIA,
				'label' =>   esc_html__('Round Shape', 'blenco-core'),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition'  => [
					'layout' => 'layout-2',
				],
			]
		);

		$this->end_controls_section();

		// Image Settings
		//==============================================================

		$this->start_controls_section(
			'service_image_settings',
			[
				'label' => esc_html__( 'Image Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'service_image_width',
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
					'{{WRAPPER}} .service-box .image-column .col-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_image_height',
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
					'{{WRAPPER}} .service-box .image-column .col-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_image_radius',
			[
				'label'      => __( 'Radius', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .service-box .image-column .col-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'service_image_horizontal',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Horizontal', 'blenco-core' ),
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
					'{{WRAPPER}} .service-box .image-column .col-img' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_image_vertical',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Image Vertical', 'blenco-core' ),
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
					'{{WRAPPER}} .service-box .image-column .col-img' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'service_image_spacing',
			[
				'label'      => __( 'Margin', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .service-box .image-column' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_color',
				'label' => __('Background', 'blenco-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'blenco-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title',
			]
		);
		$this->add_control(
			'active_fill_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Active Text Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title.active' => '-webkit-text-fill-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title:hover' => 'color: {{VALUE}} !important',
				],
			]
		);
		$this->add_responsive_control(
			'feature_spacing',
			[
				'label'      => __( 'List Feature Spacing', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .service-box .list-feature ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'feature_list_spacing',
			[
				'label'      => __( 'List Margin', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .service-box .list-feature' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Title Spacing', 'blenco-core' ),
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
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',

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
				'description' => esc_html__( 'Only use layout 2', 'blenco-core' ),
				'condition'  => [
					'layout' => 'layout-2',
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
				'default'       => 'yes',
				'return_value' => 'line-shape has-animation',
			]
		);

		$this->add_control(
			'line_shape_color',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Shape Color', 'blenco-core' ),
				'selectors'   => [
					'{{WRAPPER}} .service-box-layout-2 .list-feature ul li .list-item .list-title:after' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .service-box-layout-2 .list-feature ul li .list-item .list-title:after' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .service-box-layout-2 .list-feature ul li .list-item .list-title:after' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .service-box-layout-2 .list-feature ul li .list-item .list-title:after' => 'left: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .service-box-layout-2 .list-feature ul li .list-item .list-title:after' => 'bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .service-box-layout-2 .list-feature ul li .list-item .list-title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'title_line_shape' => 'line-shape has-animation',
				],
			]
		);

		$this->end_controls_section();

		// Icon Settings
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'type'      => Controls_Manager::NUMBER,
				'label'     => esc_html__( 'Size', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title i' => 'font-size: {{VALUE}}px',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'blenco-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-title i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		// Number Settings
		//==============================================================
		$this->start_controls_section(
			'number_settings',
			[
				'label' => esc_html__( 'Number Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .service-box .list-feature ul li .list-item .list-number',
			]
		);
		$this->add_control(
			'number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-number' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-number' => 'left: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-number' => 'top: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->end_controls_section();
		// Content Settings
		//==============================================================
		$this->start_controls_section(
			'content_settings',
			[
				'label' => esc_html__( 'Content Settings', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .service-box .list-feature ul li .list-item .list-content',
			]
		);
		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_width',
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
					'{{WRAPPER}} .service-box .list-feature ul li .list-item .list-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();

		switch ( $data['layout'] ) {
			case 'layout-2':
				$template = 'view-2';
				break;
			default:
				$template = 'view-1';
				break;
		}
		Fns::get_template( "elementor/service-box/{$template}", $data );
	}

}