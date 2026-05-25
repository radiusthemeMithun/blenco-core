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

if ( ! defined( 'ABSPATH' ) ) exit;

class ProgressBar extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Progress Bar', 'blenco-core' );
		$this->rt_base = 'rt-progress-bar';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => __( 'Progress Bar', 'blenco-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'blenco-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'blenco-core' ),
				'default' => __( 'My Skill', 'blenco-core' ),
				'label_block' => true,
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
			'percent',
			[
				'label' => __( 'Percentage', 'blenco-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'display_percentage',
			[
				'label' => __('Display Percentage', 'blenco-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'blenco-core'),
				'label_off' => __('No', 'blenco-core'),
				'default'     => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => __( 'Progress Bar', 'blenco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bar_color',
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-progress-bar .skill-bar .skill-per',
				'return_value' => 'counter-gradient',
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label' => __( 'Bar Background Color', 'blenco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_height',
			[
				'label' => __( 'Bar Height', 'blenco-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_active_height',
			[
				'label' => __( 'Active Height', 'blenco-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar .skill-per' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_border_radius',
			[
				'label' => __( 'Border Radius', 'blenco-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-progress-bar .skill-bar .skill-per' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bar_padding',
			[
				'label'              => __( 'Padding', 'blenco-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-progress-bar .skill-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title Style', 'blenco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .rt-progress-bar .title-bar .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'blenco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .title-bar .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Title Space', 'blenco-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .title-bar .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_percentage',
			[
				'label' => __( 'Percentage Style', 'blenco-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typo',
				'selector' => '{{WRAPPER}} .rt-progress-bar .is-percentage .skill-per:before',
			]
		);

		$this->add_control(
			'percent_color',
			[
				'label' => __( 'Color', 'blenco-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .is-percentage .skill-per:before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'percent_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Position', 'blenco-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .is-percentage .skill-per:before' => 'bottom: {{SIZE}}{{UNIT}};',
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
		$data = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/progress-bar/$template", $data );
	}
}