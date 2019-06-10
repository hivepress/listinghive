<?php
/**
 * Demos configuration.
 *
 * @package HiveTheme\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
	[
		'import_file_name'         => esc_html__( 'Real Estate', 'listinghive' ),
		'import_file_url'          => HT_THEME_URL . '/assets/demos/real-estate/content.xml',
		'import_widget_file_url'   => HT_THEME_URL . '/assets/demos/real-estate/widgets.wie',
		'import_settings_file_url' => HT_THEME_URL . '/assets/demos/real-estate/settings.json',
		'import_preview_image_url' => HT_THEME_URL . '/assets/demos/real-estate/screenshot.jpg',
		'preview_url'              => 'https://listinghive.hivepress.io',
	],
];
