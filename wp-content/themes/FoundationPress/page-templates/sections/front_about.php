<div class="section <?php echo($class);?>">
	<div class="section_about--text">
		<h2  class="text_title" > 
			<?php the_title(); ?>
		</h2>
		<div class="text-content">
			<?php the_content(); ?>
			<a href="?page_id=102" class="more-link">Kontrola kvaliteta<i class="fas fa-arrow-right"></i></a>
		</div>
	</div>
	<div class="section_about--img" >
		<img class="top-right-img" src="<?php the_post_thumbnail_url(  ); ?>" alt="kontrola kvaliteta">
		<i class="center-img"></i>
		<i class="even-center-img-first"></i>
		<i class="even-center-img-second"></i>
	</div>
</div>
