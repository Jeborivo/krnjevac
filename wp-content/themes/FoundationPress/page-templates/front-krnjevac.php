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

		<div class="hero">
			<div class="hero_content main-container">
				<div class="hero_content--bg-video">
					<video class="bg-video_content" autoplay muted loop>
						<source src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/krnjevac.webm" type="video/webm">
						<!-- <source src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/Honey.mp4" type="video/mp4"> -->
					</video>
				</div>

				<div class="hero_content--text">
					<h1 class="hero_content--title">Ne mešamo se u posao prirode</h1>
					<h4 class="hero_content--desc">Posebno i pažljivo odabran med bez dodataka.</h4>
					<button class="button hero_content--button" type="button">Krnjevac med <i class="icon-arrow-right"></i></button>
				</div>
			</div>
		</div>

<?php get_template_part( 'template-parts/featured-image' ); ?>
	<div class="main-grid">
		<main class="main-content-full-width">
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
						<?php $class="odd main-container section_about"; ?>
					<?php else:?>
						<?php $class="even main-container section_about"; ?>
				<?php endif?>
					<?php $type = get_field('type'); ?>
					<?php include 'sections/'.$type.'.php';?>
			<?php endforeach; ?>
		</main>
	</div>
<?php
get_footer();
