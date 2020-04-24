<?php
/**
 * Theme mods configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	'title_tagline' => [
		'fields' => [
			'copyright_notice' => [
				'label' => esc_html__( 'Copyright Notice', 'listinghive' ),
				'type'  => 'textarea',
			],
		],
	],

	'colors'        => [
		'fields' => [
			'primary_color'   => [
				'label'   => esc_html__( 'Primary Color', 'listinghive' ),
				'type'    => 'color',
				'default' => '#ffc107',
			],

			'secondary_color' => [
				'label'   => esc_html__( 'Secondary Color', 'listinghive' ),
				'type'    => 'color',
				'default' => '#15cd72',
			],
		],
	],

	'header_image'  => [
		'fields' => [
			'header_image_parallax' => [
				'label'   => esc_html__( 'Enable parallax effect', 'listinghive' ),
				'type'    => 'checkbox',
				'default' => true,
			],
		],
	],

	'fonts'         => [
		'title'  => esc_html__( 'Fonts', 'listinghive' ),

		'fields' => [
			'heading_font' => [
				'label'   => esc_html__( 'Heading Font', 'listinghive' ),
				'type'    => 'font',
				'default' => 'Poppins:500',
			],

			'body_font'    => [
				'label'   => esc_html__( 'Body Font', 'listinghive' ),
				'type'    => 'font',
				'default' => 'Open Sans:400,600',
			],
		],
	],
];
