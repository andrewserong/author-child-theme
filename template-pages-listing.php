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

			<div class="tiles-container" id="tiles-container">

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

<script>

// progressive enhancement workaround for last row of justify-content: space-between
// add additional empty tiles so that last row appears left aligned
// adjusted very slightly for this template from the code snippet by Lewis Walsh
// thanks to: https://lewiswalsh.com/flexbox-space-between-and-the-last-row/
//
// there will technically be flicker on page load using this, but since the tiles begin
// 'beneath the fold', this shouldn't be visible to the user

	function checkCount(current_total, next) {
	  if (current_total % 6) { // Divisible by 3
	    current_total += 1; // Proper way to do ++
	    checkCount(current_total, next); // Recursion!
	  } else {
	    next(current_total);
	  }
	}
	function addDummyElementsToCards(container_id) {
	  var container = document.getElementById(container_id);
	  var card_count = container.children.length;
	  checkCount(card_count, function(final_count){
	    var dummy_element;
	    for(i=0; i<(final_count-card_count); i++) {
	      dummy_element = document.createElement('div');
	      dummy_element.className = 'tile-outer';
	      container.appendChild(dummy_element);
	    }
	  });
	}
	addDummyElementsToCards('tiles-container'); 

</script>
