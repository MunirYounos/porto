<?php 
/*
@package porto theme

		===================================
		Frontend Front page
		===================================
*/


get_header(); ?>

<section id="section-blog" class="section-blog">
	<div class="container">
	<div class="posts">
		<?php 
			if(have_posts( )):
				while(have_posts()): the_post();
					get_template_part('template-parts/content');
			endwhile;
		endif;
		
		?>
		</div>
	</div><!-- container -->
</section>

<?php get_footer(); ?>