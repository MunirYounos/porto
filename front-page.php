<?php 
/*
@package porto theme

		===================================
		Frontend Front page
		===================================
*/
get_header();?>
<div class="container-fluid"> 
	<div class="hero">
		<div class="container">
		<?php 
		$banner = esc_attr( get_option('banner_picture') );
		$first_name = esc_attr( get_option('first_name') );
		$last_name = esc_attr( get_option('last_name') );
		$description = esc_attr( get_option('banner_description') );
		$description_two = esc_attr( get_option('banner_description_two') );
		$description_three = esc_attr( get_option('banner_description_three') );
		$fullname = $first_name . ' ' . $last_name; 
		?>
		<div class="hero-wrapper">
				<div class="hero-text">
				<p class="hero-name"><?php echo $fullname; ?></p>
				<?php animated_text_frontend_feature($description, $description_two ,$description_three); ?>
					<div class="button">
					<a href="#section-blog" class="btn btn-front">Learn More</a>
					</div>
				</div>
				<div class="hero-image">
				<img src="<?php echo $banner; ?>" alt="<?php echo $description; ?>">
				</div>
		</div>
		</div>
	</div>
</div>
<section id="section-blog" class="section-blog">
	<div class="container">
	<div class="images">
		<?php 
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 1 ) );
 
		if ( $latest_blog_posts->have_posts() ) : while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post();
				// Loop output goes here
				?>
				<article id="post-<?php the_ID(); ?>" <?php  post_class('porto-format-image'); ?>>
				<header class="format-image-header">
					<?php the_title( '<h1 class="format-image-title">', '</h1>'); ?>
					<div class="format-image-meta">
						<?php echo porto_posted_meta(); ?>
					</div>
				</header>
				<div class="format-image-content">
					<?php if(has_post_thumbnail() ): ?>
							<div class="format-image-image"><?php the_post_thumbnail(); ?>	
								<div class="image-footer">
									<?php  echo porto_posted_footer(); ?>
							</div>
						</div>
						<?php endif; ?>
						<div class="format-image-excerpt">
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="btn btn-format-image"><?php _e('Read More..'); ?></a>
						</div>
				</div>
			</article>
				<?php 
			endwhile; endif;
		?>
		</div>
		<div class="posts">
		<?php 
		$latest_blog_posts = new WP_Query( array( 'posts_per_page' => 4 ) );
 
		if ( $latest_blog_posts->have_posts() ) : while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post();
				// Loop output goes here
				get_template_part('template-parts/content');
		endwhile; endif;

		
		?>
		</div>
	</div><!-- container -->
</section>

<?php get_footer(); ?>