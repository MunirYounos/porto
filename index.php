<?php 
/*
@package porto theme

		===================================
		Frontend 
		===================================
*/


get_header(); ?>
<div class="container-fluid"> 
	<div class="hero">
		<div class="container">
		<div class="hero-wrapper">
			
		</div>
		</div>
	</div>
</div>
<section id="section-blog" class="section-blog">
	<div class="container">
	<div class="posts">
		<?php 
			if(have_posts( )):
				while(have_posts()): the_post();
					get_template_part('template-parts/content', get_post_format( ));
			endwhile;
		endif;
		
		?>
		</div>
	</div><!-- container -->
</section>

<?php get_footer(); ?>