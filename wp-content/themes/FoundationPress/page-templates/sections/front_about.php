<div class="section <?php echo($class);?>">
	<div class="section_about--text">
		<h2  class="text_title" > 
			<?php the_title(); ?>
		</h2>
		<div class="text-content">
			<?php the_content(); ?>
			<a href="#" class="more-link">Više o kontroli kvaliteta <i class="fas fa-arrow-right"></i></a>
		</div>
	</div>
	<div class="section_about--img" >
		<img class="top-right-img" src="<?php the_post_thumbnail_url(  ); ?>" alt="kontrola kvaliteta">
		<img class="center-img"></img>
		<img class="even-center-img-first"></img>
		<img class="even-center-img-second"></img>
	</div>
</div>
