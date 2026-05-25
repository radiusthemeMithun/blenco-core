<?php
//phpcs:disable
namespace RT\BlencoCore\Controllers;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use RT\Blenco\Helpers\Fns;
use \RT_Postmeta;
use RT\BlencoCore\Traits\SingletonTraits;
use RT\BlencoCore\Builder\Builder;
use RT\BlencoCore\Helper\FnsBuilder;
use RT\BlencoCore\Modules\IconList;

class PostMetaController {
	use SingletonTraits;

	public $postmeta;

	public function __construct() {
		$this->postmeta = RT_Postmeta::getInstance();
//		$this->add_meta_box();
		add_action( 'init', [ $this, 'add_meta_box' ] );
	}

	/**
	 * Add all metabox
	 * @return void
	 */
	function add_meta_box() {

		$this->postmeta->add_meta_box(
			"rt_page_settings",
			__( 'Layout Settings', 'blenco-core' ),
			[ 'page', 'post', 'rt-team', 'rt-service', 'rt-project' ],
			'',
			'',
			'high',
			[
				'fields' => [
					"rt_layout_meta_data" => [
						'label' => __( 'Layouts', 'blenco-core' ),
						'type'  => 'group',
						'value' => $this->get_post_page_meta_args(),
					],
				],
			]
		);

		//Post Info
		$this->postmeta->add_meta_box(
			"rt_post_info",
			__( 'Post Info', 'blenco-core' ),
			[ 'post' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_post_info_meta(),
			]
		);

		//Team meta
		$this->postmeta->add_meta_box(
			"rt_team_info",
			__( 'Team Info', 'blenco-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_info_meta(),
			]
		);
		$this->postmeta->add_meta_box(
			"rt_team_social",
			__( 'Team Social', 'blenco-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_social_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_skill",
			__( 'Team Skill', 'blenco-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_skill_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_contact",
			__( 'Team Contact', 'blenco-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_contact_meta(),
			]
		);

		$this->postmeta->add_meta_box(
			"rt_team_personal",
			__( 'Personal Info', 'blenco-core' ),
			[ 'rt-team' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_team_personal_meta(),
			]
		);

        //service meta
        $this->postmeta->add_meta_box(
            "rt_service_icon",
            __( 'Service Icon', 'blenco-core' ),
            [ 'rt-service' ],
            '',
            '',
            'high',
            [
                'fields' => $this->get_service_icon_meta(),
            ]
        );

		//Project meta
		$this->postmeta->add_meta_box(
			"rt_project_info",
			__( 'Project Info', 'blenco-core' ),
			[ 'rt-project' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_project_info_meta(),
			]
		);

        //header footer build
		$this->postmeta->add_meta_box(
			"rt_el_builder_settings",
			__( 'Header - Footer Builder Settings', 'blenco-core' ),
			[ 'elementor-blenco' ],
			'',
			'',
			'high',
			[
				'fields' => $this->get_el_builder_meta_args(),
			]
		);
	}

	function get_el_builder_meta_args() {
		return apply_filters( 'blenco_layout_meta_field', [
			'template_type' => [
				'label'   => __( 'Template Type', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Choose Options', 'blenco-core' ),
					'header'  => __( 'Header', 'blenco-core' ),
					'footer'  => __( 'Footer', 'blenco-core' ),
				],
				'default' => 'default',
			],

			'show_on' => [
				'label'   => __( 'Show On', 'blenco-core' ),
				'type'    => 'multi_select2',
				'options' => FnsBuilder::get_builder_type(),
				'default' => [],
				'class'   => 'rt-header-footer-select'
			],

			'choose_post' => [
				'label'       => __( 'Choose posts or pages', 'blenco-core' ),
				'type'        => 'ajax_select',
				'data_source' => 'post',
				'default'     => [],
			],

		] );
	}

	function get_post_page_meta_args() {
		$sidebars = [ 'default' => __( 'Default from customizer', 'blenco-core' ) ] + Fns::sidebar_lists();

		return apply_filters( 'blenco_layout_meta_field', [
			'layout'            => [
				'label'   => __( 'Layout', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default'       => __( 'Default from customizer', 'blenco-core' ),
					'full-width'    => __( 'Full Width', 'blenco-core' ),
					'left-sidebar'  => __( 'Left Sidebar', 'blenco-core' ),
					'right-sidebar' => __( 'Right Sidebar', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'single_post_style' => [
				'label'   => __( 'Post View Style', 'blenco-core' ),
				'type'    => 'select',
				'options' => [ 'default' => __( 'Default from customizer', 'blenco-core' ) ] + Fns::single_post_style(),
				'default' => 'default',
			],
			'header_style'      => [
				'label'   => __( 'Header Style', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'1'       => __( 'Layout 1', 'blenco-core' ),
					'2'       => __( 'Layout 2', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'sidebar'           => [
				'label'   => __( 'Custom Sidebar', 'blenco-core' ),
				'type'    => 'select',
				'options' => $sidebars,
				'default' => 'default',
			],
			'top_bar'           => [
				'label'   => __( 'Top Bar Visibility', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'on'      => __( 'ON', 'blenco-core' ),
					'off'     => __( 'OFF', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'topbar_style'      => [
				'label'   => __( 'Top Bar Style', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'1'       => __( 'Layout 1', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'header_width'      => [
				'label'   => __( 'Header Width', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'box'     => __( 'Box Width', 'blenco-core' ),
					'full'    => __( 'Full Width', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'menu_alignment'    => [
				'label'   => __( 'Menu Alignment', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default'     => __( 'Default from customizer', 'blenco-core' ),
					'menu-left'   => __( 'Left Alignment', 'blenco-core' ),
					'menu-center' => __( 'Center Alignment', 'blenco-core' ),
					'menu-right'  => __( 'Right Alignment', 'blenco-core' ),
				],
				'default' => 'default',
			],

			'tr_header'        => [
				'label'   => __( 'Transparent Header', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'on'      => __( 'ON', 'blenco-core' ),
					'off'     => __( 'OFF', 'blenco-core' ),
				],
				'default' => 'default',
			],

			'tr_header_color' => [
				'label'   => __( 'Transparent color', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default'   => __( 'Default from customizer', 'blenco-core' ),
					'tr-header-light'   => __( 'Light Color', 'blenco-core' ),
					'tr-header-dark'    => __( 'Dark Color', 'blenco-core' ),
				],
				'default' => 'default',
			],

			'banner'           => [
				'label'   => __( 'Banner Visibility', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'on'      => __( 'ON', 'blenco-core' ),
					'off'     => __( 'OFF', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb_title' => [
				'label'   => __( 'Banner Title', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'on'      => __( 'ON', 'blenco-core' ),
					'off'     => __( 'OFF', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'breadcrumb'       => [
				'label'   => __( 'Banner Breadcrumb', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'on'      => __( 'ON', 'blenco-core' ),
					'off'     => __( 'OFF', 'blenco-core' ),
				],
				'default' => 'default',
			],

			'banner_image'    => [
				'type'  => 'image',
				'label' => __( 'Banner Background Image', 'blenco-core' ),
			],
			'banner_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Banner Background Color', 'blenco-core' ),
			],


			'footer_style'     => [
				'label'   => __( 'Footer Layout', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default' => __( 'Default from customizer', 'blenco-core' ),
					'1'       => __( 'Layout 1', 'blenco-core' ),
					'2'       => __( 'Layout 2', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'footer_schema'    => [
				'label'   => __( 'Footer Schema', 'blenco-core' ),
				'type'    => 'select',
				'options' => [
					'default'      => __( 'Default from customizer', 'blenco-core' ),
					'footer-light' => __( 'Light Footer', 'blenco-core' ),
					'footer-dark'  => __( 'Dark Footer', 'blenco-core' ),
				],
				'default' => 'default',
			],
			'padding_top'    => [
				'label' => __( 'Padding Top (Page Content)', 'blenco-core' ),
				'type'  => 'number',
			],
			'padding_bottom'   => [
				'label' => __( 'Padding Bottom (Page Content)', 'blenco-core' ),
				'type'  => 'number',
			],
			'page_bg_image'    => [
				'type'  => 'image',
				'label' => __( 'Background Image', 'blenco-core' ),
			],
			'page_bg_color'    => [
				'type'  => 'color_picker',
				'label' => __( 'Background Color', 'blenco-core' ),
			],

		] );
	}

	function get_post_info_meta() {
		return apply_filters( 'rt_post_info', [
			'rt_youtube_link' => [
				'label'   => __( 'Youtube Link', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'rt_post_gallery' => [
				'label' => __( 'Post Gallery', 'blenco-core' ),
				'type'  => 'gallery',
				'desc'  => __( 'Only work for the gallery post format', 'blenco-core' ),
			],
		] );
	}

	//Team meta info
	function get_team_info_meta() {
		return apply_filters( 'rt_team_meta_field', [
			'rt_team_info_title' => array(
				'label' => __( 'Information Title', 'blenco-core' ),
				'type'  => 'text',
			),

			'rt_team_designation' => [
				'label'   => __( 'Team Designation', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_phone' => [
				'label'   => __( 'Team Phone', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_website' => [
				'label'   => __( 'Team Website', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_email' => [
				'label'   => __( 'Team Email', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_team_address' => [
				'label'   => __( 'Team Address', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

		] );
	}
	function get_team_social_meta() {
		return apply_filters( 'rt_team_meta_social', [
			'rt_team_socials' => array(
				'type'  => 'group',
				'value' => Fns::get_team_socials(),
			),
		] );
	}

	function get_team_skill_meta() {
		return apply_filters( 'rt_team_meta_skill', [

			'rt_team_skill_title' => array(
				'label' => __( 'Skill Title', 'blenco-core' ),
				'type'  => 'text',
			),

			'rt_team_skill_info' => [
				'label'   => __( 'Team Skill Info', 'blenco-core' ),
				'type'    => 'textarea',
			],

			'rt_team_skill' => [
				'type'  => 'repeater',
				'button' => __( 'Add New Skill', 'blenco-core' ),
				'value'  => [
					'skill_name' => [
						'label' => __( 'Skill Name', 'blenco-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. Marketing', 'blenco-core' ),
					],
					'skill_value' => [
						'label' => __( 'Skill Percentage (%)', 'blenco-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. 75', 'blenco-core' ),
					],
					'skill_color' => [
						'label' => __( 'Skill Color', 'blenco-core' ),
						'type'  => 'color_picker',
						'desc'  => __( 'If not selected, primary color will be used', 'blenco-core' ),
					],
				]
			],
		] );
	}

	function get_team_personal_meta() {
		return apply_filters( 'rt_team_meta_personal', [
			'rt_team_personal_title' => array(
				'label' => __( 'Personal Title', 'blenco-core' ),
				'type'  => 'text',
			),
			'rt_team_personal_content' => [
				'label'   => __( 'Content', 'blenco-core' ),
				'type'    => 'text',
			],
			'rt_team_personal_list' => [
				'type'  => 'repeater',
				'button' => __( 'Add New item', 'blenco-core' ),
				'value'  => [
					'info_text' => [
						'label' => __( 'Text', 'blenco-core' ),
						'type'  => 'text',
						'desc'  => __( 'eg. Close deals faster with view', 'blenco-core' ),
					],
				]
			],

		] );
	}

	function get_team_contact_meta() {
		return apply_filters( 'rt_team_meta_contact', [
			'rt_team_contact_form' => array(
				'label' => __( 'Contact Form Shortcode', 'blenco-core' ),
				'type'  => 'text',
			),
		] );
	}


    // Service meta info

    function get_service_icon_meta() {
        return apply_filters( 'rt_service_meta_icon', [
            'rt_service_icon'    => [
                'label'   => __( 'Service Icon', 'blenco-core' ),
                'type'    => 'select',
                'options' => IconList::fontello_service(),
            ],
            'rt_service_color'    => [
	            'label'   => __( 'Service Color', 'blenco-core' ),
	            'type'  => 'color_picker',
            ],
        ] );
    }


	//Project meta info
	function get_project_info_meta() {
		return apply_filters( 'rt_project_meta_field', [
			'rt_project_title' => [
				'label'   => __( 'Info Title', 'blenco-core' ),
				'type'    => 'text',
				'default' => __( 'Project Info', 'blenco-core' ),
			],

			'rt_project_text' => [
				'label'   => __( 'Info Text', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_client' => [
				'label'   => __( 'Client', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_start' => [
				'label'   => __( 'Starts On', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_end' => [
				'label'   => __( 'End On', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_weblink' => [
				'label'   => __( 'Weblink', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'rt_project_location' => [
				'label'   => __( 'Location', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'project_contact_title' => [
				'label'   => __( 'Box Title', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'project_contact_address' => [
				'label'   => __( 'Address', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'project_contact_phone' => [
				'label'   => __( 'Phone', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],
			'project_contact_email' => [
				'label'   => __( 'Email', 'blenco-core' ),
				'type'    => 'text',
				'default' => '',
			],

			'rt_project_rating' => [
				'label' => __( 'Select the Rating', 'blenco-core' ),
				'type'  => 'select',
				'options' => array(
					'-1' => __( 'Default', 'blenco-core' ),
					'1'    => '1',
					'2'    => '2',
					'3'    => '3',
					'4'    => '4',
					'5'    => '5'
				),
				'default'  => '-1',
			],

		] );
	}
}

