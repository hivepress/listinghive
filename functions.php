<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the core class.
require_once __DIR__ . '/includes/class-core.php';

/**
 * Returns the core instance.
 *
 * @return HiveTheme\Core
 */
function hivetheme() {
	return HiveTheme\Core::instance();
}

// Initialize HiveTheme.
hivetheme();
