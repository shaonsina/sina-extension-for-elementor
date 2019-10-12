<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
	<div class="sina-bp-col <?php echo esc_attr( $data['columns'].' '.$data['effects'] ); ?>">
		<div class="sina-bp">
			<?php if ( has_post_thumbnail() ): ?>
				<div class="sina-bg-thumb">
					<?php the_post_thumbnail(); ?>
					<div class="sina-overlay">
						<a href="<?php the_permalink(); ?>"></a>
					</div>
				</div>
			<?php endif; ?>
			<div class="sina-bp-content">
				<?php if ( 'before' == $data['cats_position'] ): ?>
					<div class="sina-bp-cats">
						<span class="sina-bp-icon">
							<i class="<?php echo esc_attr( $data['cats_icon'] ); ?>"></i>
						</span>
						<?php echo get_the_category_list( ' | ' ); ?>
					</div>
				<?php endif; ?>
				<h2 class="sina-bp-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<?php if ( 'after' == $data['cats_position'] ): ?>
					<div class="sina-bp-cats">
						<span class="sina-bp-icon">
							<i class="<?php echo esc_attr( $data['cats_icon'] ); ?>"></i>
						</span>
						<?php echo get_the_category_list( ' | ' ); ?>
					</div>
				<?php endif; ?>

				<div class="sina-bp-text">
					<?php
						if ( has_excerpt() &&  'yes' == $data['excerpt'] ):
							$excerpt = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_excerpt() );
							echo wp_kses_post( wp_trim_words( $excerpt, $content_length ) );
						else:
							$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
							echo wp_kses_post( wp_trim_words( $content, $content_length ) );
						endif;
					?>
				</div>

				<?php if ( $data['read_more_text'] ): ?>
					<div class="sina-btn-wrapper">
						<a href="<?php the_permalink(); ?>" class="sina-read-more <?php echo esc_attr( $data['read_more_effect'] ); ?>">
							<?php Sina_Common_Data::button_html($data, 'read_more'); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( 'yes' == $data['posts_meta'] ): ?>
					<div class="sina-bp-meta">
						<?php if ( 'yes' == $data['posts_avatar'] ): ?>
							<?php echo get_avatar( get_the_author_meta( "ID" ), $data['avatar_size']['size']); ?>
						<?php else: ?>
							<?php _e('by', 'sina-ext'); ?>
						<?php endif; ?>
						<?php the_author_posts_link(); ?>
						|
						<?php printf( '%s', get_the_date() ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>