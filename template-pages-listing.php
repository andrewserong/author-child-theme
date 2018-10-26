<?php
/**
 * Template Name: Pages listing
 *
 * Supports the following meta data keys:
 * - hide_in_pages_listing - hides a child page from the pages listing.
 *
 * @package author-hemingway-child-theme
 */

?>

<?php get_header(); ?>

<div class="wrapper section-inner">

	<div class="content full-width">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

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

						<p><?php edit_post_link( __( 'Edit', 'hemingway' ) ); ?></p>

					<?php endif; ?>

					<div class="clear"></div>

				</div> <!-- /post-content -->

			</div> <!-- /post -->

			<div class="tiles-container" id="tiles-container">

				<?php
				// For reference: https://codex.wordpress.org/Function_Reference/get_pages.
				$child_pages = get_pages( array(
					'child_of'    => $post->ID,
					'sort_column' => 'menu_order',
					'sort_order'  => 'asc',
				) );

				foreach ( $child_pages as $page ) {
					$content = $page->post_content;
					if ( ! $content || true === bool_from_yn( get_post_meta( $page->ID, 'hide_in_pages_listing', true ) ) ) { // Check for empty page.
						continue;
					}

					$content = apply_filters( 'the_content', $content );
					?>
					<a class="tile-outer" href="<?php echo esc_url( get_page_link( $page->ID ) ); ?>">
						<div class="tile-inner">
								<?php if ( has_post_thumbnail( $page->ID ) ) : ?>

							<div class="tile-image">
									<?php echo get_the_post_thumbnail( $page, 'category-thumb' ); ?>
							</div> <!-- /featured-media -->

							<?php endif; ?>
						</div>
					</a>
							<?php } // end foreach child_pages ?>

			</div> <!-- /tiles-container -->

							<?php if ( comments_open() ) : ?>

								<?php comments_template( '', true ); ?>

			<?php endif; ?>

		</div> <!-- /posts -->

					<?php endwhile; else : ?>

			<p><?php esc_html_e( "We couldn't find any posts that matched your query. Please try again.", 'hemingway' ); ?></p>

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

	function checkCount( currentTotal, next ) {
		if ( currentTotal % 6 ) { // Divisible by 3
			currentTotal += 1; // Proper way to do ++
			checkCount( currentTotal, next ); // Recursion!
		} else {
			next( currentTotal );
		}
	}
	function addDummyElementsToCards( containerId ) {
		var container = document.getElementById( containerId );
		var cardCount = container.children.length;
		checkCount(cardCount, function( finalCount ) {
			var dummyElement;
			for( i=0; i<( finalCount - cardCount ); i++ ) {
				dummyElement = document.createElement( 'div' );
				dummyElement.className = 'tile-outer';
				container.appendChild(dummyElement);
			}
		});
	}
	addDummyElementsToCards('tiles-container');

</script>
