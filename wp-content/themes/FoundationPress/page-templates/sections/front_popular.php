<div class="cards main-container-full-width">
  <h3 class="cards-heading">Najpopularniji Krnjevac proizvodi</h3>
  <div class="cards-container main-container">
    <?php
      $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => 'Popular', 'orderby' => 'rand' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
      <?php $productId= $product->get_id();?>
        <div class="card">
          <div class="card-content">
              <div class="card-content_description">
                <h4 class="card-content_description--title"><?php the_title(); ?></h4>
                <h6 class="card-content_description--weight">
                  <?php if (isset($product->get_attributes()['gramaza']['options'][0])): ?>
                  <?php echo ($product->get_attributes()['gramaza']['options'][0]); ?>
                  <?php endif;?>
                </h6>
                <h3 class="card-content_description--price">
                  <?php 
                  $sale= $product->get_sale_price();
                  if($sale != ''):?>
                    <span class="regular_price">
                      <span class="line"></span>
                      <?php echo($product->get_regular_price()) ?>,- </span>
                    <span class="sale_price"><?php echo($sale);?></span>
                    <?php echo(',-');?>
                  <?php else: ?>
                    <span id="regular_price"><?php echo($product->get_regular_price()) ?> ,- </span>
                  <?php endif;?>
                </h3>
              </div>
              <?php if ( has_post_thumbnail( $product->get_id() ) ):?>
              <?php $attachment_ids[0] = get_post_thumbnail_id( $productId );?>
              <?php $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' ); ?>
              <div class="card-content_image" style="background-image: url('<?php the_post_thumbnail_url(  ); ?> ')">
              </div>
              <?php endif; ?>
              <a href="?add-to-cart=<?php echo ($productId); ?>" class="add_to_cart_button button"><h3>+</h3></a>
           
            </div>
        </div>
      <?php endwhile; ?>
    <?php wp_reset_query(); ?>
  </div>
  <div class="cards-info main-container">
    <div class="cards-info_text">
      <h6><i class="far fa-check-circle"></i>Besplatna dostava preko 2000,-</h6>
      <h6><i class="far fa-check-circle"></i>Dostava danas za sutra</h6>
      <h6><i class="far fa-check-circle"></i>Slanje paketa sirom Srbije</h6>
    </div>
    <button class="button go-to-shop" type="button"> <a href="?post_type=product&productOrderBy=menu_order&itemOrder=ASC"><h5>Internet prodavnica<i class="fas fa-shopping-cart"></i></h5></a></button>
  </div>
</div>
