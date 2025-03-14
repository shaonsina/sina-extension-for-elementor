<?php
/**
 * Archive Template.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="content" class="site-main">
	<?php do_action( 'sina_ext_archive_builder_content' ); ?>
</main>
<?php
get_footer();
