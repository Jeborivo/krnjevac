<div class="cards main-container">
  <h3 class="cards-heading">Najpopularniji Krnjevac proizvodi</h3>
  <div class="cards-container ">
    <?php
      $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => 'Popular', 'orderby' => 'rand' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
        <div class="card">
          <div class="card-content">
              <div class="card-content_description">
                <h4 class="card-content_description--title"><?php the_title(); ?></h4>
                <h6 class="card-content_description--weight">
                  <?php if (isset($product->get_attributes()['gramaza']['options'][0])): ?>
                  <?php echo ($product->get_attributes()['gramaza']['options'][0]); ?>
                  <?php endif;?>
                </h6>
                <h3 class="card-content_descriptio--price"><?php echo($product->get_regular_price()) ?> ,- 
                  <?php 
                  $sale= $product->get_sale_price();
                  if($sale != ''):?>
                  <?php echo($product->get_sale_price());?>
                  <?php echo(',-');?>
                  <?php endif; ?>
                </h3>
              </div>
              <?php if ( has_post_thumbnail( $product->get_id() ) ):?>
              <?php $attachment_ids[0] = get_post_thumbnail_id( $product->get_id() );?>
              <?php $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' ); ?>
              <div class="card-content_image" style="background-image: url('<?php the_post_thumbnail_url(  ); ?> ')">
              </div>
              <?php endif; ?>
              <!-- <a href="?add-to-cart=1">+</a> sta je ovo jbga? -->
              <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
            </div>
        </div>
      <?php endwhile; ?>
    <?php wp_reset_query(); ?>
  </div>
  <div class="cards-info">
    <div class="cards-info_text">
      <h6><i class="icon-check-circle"></i>Besplatna dostava preko 2000,-</h6>
      <h6><i class="icon-check-circle"></i>Dostava danas za sutra</h6>
      <h6><i class="icon-check-circle"></i>Slanje paketa sirom Srbije</h6>
    </div>
    <button class="button go-to-shop" type="button"><h5>Internet prodavnica<i class="icon-cart"></i></h5></button>
  </div>
</div>
