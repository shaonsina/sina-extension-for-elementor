<div class="sina-pc-col <?php echo esc_attr( $data['effects'] ); ?>">
	<div class="sina-bp <?php echo esc_attr( $data['bg_layer_effects'] ); ?>">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="sina-bg-thumb">
				<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
				<div class="sina-overlay">
					<a href="<?php the_permalink(); ?>"></a>
				</div>
			</div>
		<?php endif; ?>
		<div class="sina-bp-content sina-pc-text">
			<?php if ( 'before' == $data['grid_cats_position'] ): ?>
				<div class="sina-bp-cats">
					<span class="sina-bp-icon">
						<i class="<?php echo esc_attr( $data['grid_cats_icon'] ); ?>"></i>
					</span>
					<?php echo get_the_category_list( ' | ' ); ?>
				</div>
			<?php endif; ?>
			<h2 class="sina-pc-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php if ( 'after' == $data['grid_cats_position'] ): ?>
				<div class="sina-bp-cats">
					<span class="sina-bp-icon">
						<i class="<?php echo esc_attr( $data['grid_cats_icon'] ); ?>"></i>
					</span>
					<?php echo get_the_category_list( ' | ' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' == $data['posts_text']): ?>
				<div class="sina-bp-text">
					<?php
						if ( has_excerpt() &&  'yes' == $data['posts_excerpt'] ):
							$excerpt = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_excerpt() );
							echo wp_kses_post( wp_trim_words( $excerpt, $txt_len ) );
						else:
							$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
							echo wp_kses_post( wp_trim_words( $content, $txt_len ) );
						endif;
					?>
				</div>
			<?php endif; ?>

			<?php if ( $data['read_more_text'] ): ?>
				<div class="sina-btn-wrapper">
					<a href="<?php the_permalink(); ?>" class="sina-read-more <?php echo esc_attr( $data['read_more_effect'].' '.$data['read_btn_bg_layer_effects'] ); ?>">
						<?php Sina_Common_Data::button_html($data, 'read_more'); ?>
					</a>
				</div>
			<?php endif; ?>
			<?php if ( 'yes' == $data['posts_meta'] ): ?>
				<div class="sina-pc-meta">
					<?php if ( 'yes' == $data['posts_avatar'] ): ?>
						<?php echo get_avatar( get_the_author_meta( "ID" ), $data['grid_avatar_size']['size']); ?>
					<?php else: ?>
						<?php echo esc_html__('by', 'sina-ext'); ?>
					<?php endif; ?>
					<?php the_author_posts_link(); ?>
					|
					<?php printf( '%s', get_the_date() ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>