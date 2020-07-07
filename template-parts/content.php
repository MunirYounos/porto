<?php 
/*
@package porto theme

		===================================
		Frontend standard post format
		===================================
*/


?>
<article id="post-<?php the_ID(); ?>" <?php  post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>'); ?>
		<div class="entry-meta">
			<?php porto_posted_meta(); ?>
		</div>
	</header>
	<div class="entry-content">
		<?php if(has_post_thumbnail() ): ?>
				<div class="standard-image"><?php the_post_thumbnail(); ?></div>
			<?php endif; ?>
			<div class="entry-excerpt">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="btn btn-main"><?php _e('Read More..'); ?></a>
			</div>
	</div>

	<footer class="entry-footer">
	<?php porto_posted_footer(); ?>
	</footer>


</article>