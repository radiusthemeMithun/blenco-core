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

if (!defined('ABSPATH')) {
	exit;
}

class SocialText extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('RT Social Text', 'blenco-core');
		$this->rt_base = 'rt-social-text';
		parent::__construct($data, $args);
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_social_text',
			[
				'label' => esc_html__('Social Text', 'blenco-core'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text', [
				'label' => __('Social', 'blenco-core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'link', [
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'URL(optional)', 'blenco-core' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'https://your-link.com', 'blenco-core' ),
			]
		);
		
		$this->add_control(
			'list',
			[
				'label' => __('Text List', 'blenco-core'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __('Fb.', 'blenco-core'),
						
					],
					[
						'text' => __('Tw.', 'blenco-core'),
					],
					[
						'text' => __('Be.', 'blenco-core'),
					],
                    [
						'text' => __('Dr.', 'blenco-core'),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);
        $this->add_control(
			'label',
			[
				'label'     => __('Label', 'blenco-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Follow Me: ',

			]
		);
		$this->add_control(
			'transform',
			[
				'label'        => __( 'Transform', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'blenco-core' ),
				'label_off'    => __( 'Off', 'blenco-core' ),
				'return_value' => 'rotate',
			]
		);

		$this->add_responsive_control(
			'transform_rotate',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Rotate', 'blenco-core' ),
				'size_units' => [ 'px', 'deg' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'deg' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-text'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
				'condition'   => [
					'transform' => [ 'rotate' ],
				],

			]
		);

		$this->add_responsive_control(
			'rotate_position',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Left/Right', 'blenco-core' ),
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-text'   => 'left: {{SIZE}}{{UNIT}}; position:relative;',
				],
				'condition'   => [
					'transform' => [ 'rotate' ],
				],

			]
		);
        $this->add_control(
			'separator_display',
			[
				'label'        => __( 'Separator Display', 'blenco-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'blenco-core' ),
				'label_off'    => __( 'Hide', 'blenco-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		// Label setting

		$this->start_controls_section(
			'social_label_style',
			[
				'label' => esc_html__( 'Label Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-social-text label',
			]
		);
		$this->add_control(
			'label_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'blenco-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-social-text label' => 'color: {{VALUE}}',

				],
			]
		);


		$this->end_controls_section();

		

		// Text List setting
		$this->start_controls_section(
			'social_text_style',
			[
				'label' => esc_html__( 'Social Text Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'social_text_typo',
				'label'    => esc_html__( 'Typo', 'blenco-core' ),
				'selector' => '{{WRAPPER}} .rt-social-text a .social-text',
			]
		);
		$this->add_control(
			'social_text_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'blenco-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-social-text a .social-text' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_control(
			'social_text_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Hover Color', 'blenco-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-social-text a .social-text:hover' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_section();

		// Text List setting
		$this->start_controls_section(
			'separator_style',
			[
				'label' => esc_html__( 'Separator Style', 'blenco-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'separator_height',
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
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-text a .rt-separator:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->add_responsive_control(
			'separator_width',
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
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-text a .rt-separator:after' => 'width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);
		$this->add_control(
			'separator_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'blenco-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-text a .rt-separator:after' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-social-text a .rt-separator:after' => 'right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-social-text a .rt-separator:after' => 'top: {{SIZE}}{{UNIT}};',
				],

			]
		);
	
		$this->add_responsive_control(
			'separator_rotate',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Rotate', 'blenco-core' ),
				'size_units' => [ 'deg' ],
				'range'      => [
					'deg' => [
						'min'  => -360,
						'max'  => 360,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-text a .rt-separator:after'   => 'transform: rotate({{SIZE}}{{UNIT}});',
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
		Fns::get_template( "elementor/social-text/$template", $data );
	}
}