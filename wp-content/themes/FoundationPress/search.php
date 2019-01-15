<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">

	<div class="main-grid">
		<main id="search-results" class="main-content">
			<div class="search-results-content search-results-container">
				<div class="search-results-content_posts">
					<header>
						<h2 class="entry-title"><?php _e( 'Rezultati pretrage za', 'foundationpress' ); ?>
							<br>
							<span class="search-query">
							<?php echo get_search_query(); ?>
							</span>
						</h2>
					</header>
					<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
					<?php endwhile; ?>

					<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

				
				</div>
				<div class="search-results-content_sidebar">
					<?php get_search_form(); ?>

					<div class="usefull-links">
						<h4 class="usefull-links_title">Korisni linkovi</h4>
						<div class="usefull-links_wrap">
							<a href="#" class="usefull-links_link">Teglirani med</a>
							<a href="#" class="usefull-links_link">Pčelinji proizvodi sa medom</a>
							<a href="#" class="usefull-links_link">HoReCa program</a>
							<a href="#" class="usefull-links_link">Akcijski proizvodi</a>
						</div>
					</div>
				</div>
			</div>
			<?php
				if ( function_exists( 'foundationpress_pagination' ) ) :
				foundationpress_pagination();
				elseif ( is_paged() ) :
				?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
				</nav>
				<?php endif; ?>	
		</main>
	</div>
</div>
<?php get_footer();
