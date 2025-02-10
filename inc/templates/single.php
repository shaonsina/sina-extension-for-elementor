<?php
/**
 * Single Template.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="content" <?php post_class( 'site-main' ); ?>>
	<?php do_action( 'sina_ext_single_builder_content' ); ?>
</main>
<?php
get_footer();

