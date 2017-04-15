<?php
/*
Template Name: Pages listing
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
			    </div> <!-- /post-header -->																	

			   				        			        		                
				<div class="post-content">
							                                        
					<?php the_content(); ?>
		            
		            <?php if ( current_user_can( 'manage_options' ) ) : ?>
																	
						<p><?php edit_post_link( __('Edit', 'hemingway') ); ?></p>
					
					<?php endif; ?>
					
					<div class="clear"></div>
														            			                        
				</div> <!-- /post-content -->
	
			</div> <!-- /post -->

			<div class="tiles-container">

			<?php
			// reference: https://codex.wordpress.org/Function_Reference/get_pages
			$child_pages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'menu_order', 'sort_order' => 'asc' ) );
			
			foreach( $child_pages as $page ) {		
				$content = $page->post_content;
				if ( ! $content ) // Check for empty page
					continue;

				$content = apply_filters( 'the_content', $content );
				?>
					<a class="tile-outer" href="<?php echo get_page_link( $page->ID ); ?>">
						<div class="tile-inner">
							<?php if ( has_post_thumbnail($page->ID) ) : ?>
							
							<div class="tile-image">
								<?php echo get_the_post_thumbnail($page, 'category-thumb'); ?>									
							</div> <!-- /featured-media -->
								
							<?php endif; ?>

							<!-- Commenting out details, but these should be used for screen readers
							<h2>
								
									<?php echo $page->post_title; ?>

							</h2>
							<div class="entry">
								<?php echo $page->post_excerpt ?>
							</div>
							-->
						</div>
					</a>
			<?php }	// end foreach child_pages ?>

			</div> <!-- /tiles-container -->
			
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