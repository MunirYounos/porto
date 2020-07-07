<?php 
/*
@package porto theme

		===================================
		Frontend 
		===================================
*/


get_header(); ?>

<section id="section" class="section">
	<div class="container">
		<?php 
			if(have_posts( )):
				while(have_posts()): the_post();
					get_template_part('template-parts/content', get_post_format( ));
			endwhile;
		endif;
		
		?>
	</div><!-- container -->
</section>

<?php get_footer(); ?>