<?php
/**
 * Popup Template.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$elementor_instance = \Elementor\Plugin::$instance;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
        <title><?php echo esc_html(wp_get_document_title()); ?></title>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="sina-ext-popup">
        <?php $elementor_instance->modules_manager->get_modules( 'page-templates' )->print_content(); ?>
    </div>

    <?php wp_footer(); ?>
</body>
</html>