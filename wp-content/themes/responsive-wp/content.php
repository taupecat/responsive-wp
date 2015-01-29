<?php
/**
 * @package Responsive WP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php echo get_the_date(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<div class="entry-author">by <strong><?php the_author(); ?></strong></div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s&nbsp;<span class="meta-nav">&rarr;</span>', 'responsive-wp' ),
				the_title( '"', '"', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'responsive-wp' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->