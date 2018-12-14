<div class="section <?php echo($class);?>">
	<div class="section_content">
		<div class="section_text">
			<h3  class="section_title"> 
				<?php the_title(); ?>
			</h3>
			<?php the_content(); ?>
            <?php the_post_thumbnail_url(  ); ?> 
		</div>
	</div>
</div>
