<?php /* Template Name: about */ ?>
<?php
/**
 * 
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template(); ?>
                	<?php 

// list sections
			$section = get_posts(array(
				'posts_per_page'    => -1,
				'post_type'         => 'about',                 
			));
			?>
			<?php foreach( $section as $post ): 
					setup_postdata( $post );?>
					<?php $type = get_field('Type'); ?>
					<?php include 'sections/'.$type.'.php';?>
			<?php endforeach; ?>
			<?php endwhile; ?>


            <div class="faq">
                <?php 
                    // list sections
                        $faq = get_posts(array(
                            'posts_per_page'    => -1,
                            'post_type'         => 'faq',                 
                        ));
                        ?>
    
                        <?php foreach( $faq as $post ): ?>
                            <?php    setup_postdata( $post );?>
                            <div class="faq_single">
                                <h3><?php the_title(); ?></h3>
                                <div class="faq_content"><?php the_content(); ?></div> 
                            </div>
                        <?php endforeach; ?>
            </div>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
