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

		<div class="hero hero_about" style="background-image: url('http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/krnja-hero.jpg')">
			<div class="hero_content main-container">
				<div class="hero_content--text">
					<h1 class="hero_content--title">Garantovano 100% prirodnimed bez ikakvih dodataka</h1>
					<h5 class="hero_content--link"><a href="#">Kupi Krnjevac proizvode <i class="icon-arrow-right"></i></a></h5>
					<h5 class="hero_content--link"><a href="#">Kontrola kvaliteta <i class="icon-arrow-right"></i></a></h5>
					<div class="hero_content--more-link"><h5>Saznaj više o Krnjevac medu</h5><i class="icon-001-down-arrow"></i></div>
				</div>
			</div>
		</div>

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
						<?php $br =0;?>
                        <?php foreach( $faq as $post ): ?>
						<?php $br++;?>
							<?php    setup_postdata( $post );?>
							<div class="faq-wrap faq_<?php echo $br?>">
							<button class="collapsible">
							<h5><?php the_title(); ?></h5>
							<i class="icon-003-down-arrow-1"></i>
							</button>
                            	<div class="content">
                                	<div class="faq-wrap_content--inner"><?php the_content(); ?></div> 
                            	</div>
							</div>
                        <?php endforeach; ?>
			</div>
			
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
		</main>
	</div>
</div>
<?php
get_footer();
