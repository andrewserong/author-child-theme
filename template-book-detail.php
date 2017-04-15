<?php
/*
Template Name: Book detail template

Supports the following meta data keys:

* series_title - the title of the series (if the book is a part of a series)
* series_permalink - a URL to link to the series title
* book_number - which number the book is, within the series

*/
?>

<?php get_header(); ?>

<div class="wrapper section-inner">						

	<div class="content full-width">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="posts">
	
			<div class="post">

				<div class="post-header">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">											
					    <h2 class="post-title"><?php the_title(); ?></h2>
					</a>
			    
				    <div class="post-meta">

				    	<?php if ( !empty(get_post_meta( get_the_ID(), 'series_title', true)) ) : ?>

				    		<?php if ( !empty(get_post_meta( get_the_ID(), 'series_permalink', true)) ) : ?>
				    		<a href="<?php echo get_post_meta( get_the_ID(), 'series_permalink', true); ?>">
				    			<span>
				    				<?php echo get_post_meta( get_the_ID(), 'series_title', true); ?>
				    			</span>
				    		</a>

				    		<?php else: ?>
				    		<span>
				    			<?php echo get_post_meta( get_the_ID(), 'series_title', true); ?>
				    		</span>
				    		<?php endif; ?>

				    		<?php if ( !empty(get_post_meta( get_the_ID(), 'book_number', true)) ) : ?>
				    			<span class="date-sep"> / </span>
				    			<span>
				    				Book <?php echo get_post_meta( get_the_ID(), 'book_number', true); ?>
				    			</span>
				    		<?php endif; ?>

				    	<?php endif; ?>

					</div> <!-- /post-meta -->
			   	
				</div> <!-- /post-header -->

				<div class="post-content">

					<?php if ( has_post_thumbnail() ) : ?>
					
					<div class="inline-featured-media">
					
						<?php echo the_post_thumbnail('medium_large'); ?>
						
						<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
										
							<div class="hero-caption-container">
							
								<p class="hero-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
								
							</div>
							
						<?php endif; ?>
								
					</div> <!-- /featured-media -->
						
					<?php endif; ?>
							                                        
					<?php the_content(); ?>
		            
		            <?php if ( current_user_can( 'manage_options' ) ) : ?>
																	
						<p><?php edit_post_link( __('Edit', 'hemingway') ); ?></p>
					
					<?php endif; ?>
					
					<div class="clear"></div>
														            			                        
				</div> <!-- /post-content -->
	
			</div> <!-- /post -->
			
			<?php if ( comments_open() ) : ?>
			
				<?php comments_template( '', true ); ?>
			
			<?php endif; ?>
		
		</div> <!-- /posts -->
		
		<?php endwhile; else: ?>

			<p><?php _e("We couldn't find any posts that matched your query. Please try again.", "hemingway"); ?></p>
	
		<?php endif; ?>
	
	</div> <!-- /content -->
	
</div> <!-- /wrapper section-inner -->
								
<?php get_footer(); ?>