<?php
/**
 * Popup Template.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elementor_plugin = \Elementor\Plugin::$instance;

get_header();
?>
<div class="sina-ext-popup">
    <?php $elementor_plugin->modules_manager->get_modules( 'page-templates' )->print_content(); ?>
</div>
<?php
get_footer();
