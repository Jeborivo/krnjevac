<div class="section-info-img">
    <div class="section-info-img_content">
    <h3 class="section-info-img_content--title"><?php the_title(); ?></h3>
    <div class="section-info-img_content--desc"><?php the_content(); ?></div>
    <a href="?post_type=product&productOrderBy=menu_order&itemOrder=ASC" class="section-info-img_content--link">Gde kupiti <i class="fas fa-arrow-right"></i></a>
    </div>

   <div class="section-info-img_image" style="background-image: url('<?php the_post_thumbnail_url(  ); ?> ')">  </div>
  

</div>
<?php the_field('icon_list'); ?>