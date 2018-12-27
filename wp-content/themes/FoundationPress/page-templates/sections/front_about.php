<div class="section <?php echo($class);?>">
	<div class="section_about--text">
		<h2  class="text_title" > 
			<?php the_title(); ?>
		</h2>
		<div class="text-content">
			<?php the_content(); ?>
			<a href="#" class="more-link">Više o kontroli kvaliteta <i class="icon-arrow-right"></i></a>
		</div>
	</div>
	<div class="section_about--img" style="background-image: url('<?php the_post_thumbnail_url(  ); ?> ')">
	</div>
</div>
