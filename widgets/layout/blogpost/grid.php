<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
	<div class="sina-bp-col <?php echo esc_attr( $columns ) ?>">
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
				<h2 class="sina-bp-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="sina-bp-text">
					<?php
						if ( has_excerpt() &&  'yes' == $excerpt ):
							$excerpt = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_excerpt() );
							echo wp_kses_post( wp_trim_words( $excerpt, $content_length ) );
						else:
							$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
							echo wp_kses_post( wp_trim_words( $content, $content_length ) );
						endif;
					?>
				</div>
				<?php if ( 'yes' == $posts_meta ): ?>
					<div class="sina-bp-meta">
						<?php _e('by', 'sina-ext'); ?>
						<?php the_author_posts_link(); ?>
						|
						<?php printf( '%s', get_the_date() ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>