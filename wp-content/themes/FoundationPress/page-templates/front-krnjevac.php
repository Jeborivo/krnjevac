<?php /* Template Name: front-krnjevac */ ?>
<?php
/**
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
			<?php endwhile; ?>
			<?php 

// list sections
			$section = get_posts(array(
				'posts_per_page'    => -1,
				'post_type'         => 'front',                 
			));
			?>
			<?php 
				$br =0;
				$class='';
			?>

			<?php foreach( $section as $post ): 
					setup_postdata( $post );?>
					<?php $br = $br+1;?>
					<?php if($br % 2>0):?>
						<?php $class="odd"; ?>
					<?php else:?>
						<?php $class="even"; ?>
				<?php endif?>
					<?php $type = get_field('type'); ?>
					<?php include 'sections/'.$type.'.php';?>
			<?php endforeach; ?>
		</main>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
