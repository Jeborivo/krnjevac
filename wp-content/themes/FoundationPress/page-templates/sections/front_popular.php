<div class="cards main-container-full-width">
  <h3 class="cards-heading">Najpopularniji Krnjevac proizvodi</h3>
  <div class="cards-container main-container">
    

    <?php 
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
      // query
      $args = array( 'post_type' => 'popular_products', 'posts_per_page' => -1);
      $loop = new WP_Query( $args );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();
    // values
      $value = get_field( "product_link" );
      $productRelated = new WC_Product_Variable($value->post_parent );
      $variation_id = $value->ID;
      $variable_products= $productRelated->get_children();
      $variable_product = wc_get_product($variation_id);
      $thumbnail = get_the_post_thumbnail_url($variation_id);
     $variation_number = 0;
    $product_url = get_permalink( $value->post_parent) ;
    ?>

    <?php foreach($variable_products as $key=>$variation): ?>			
      <?php if ($variation == $variation_id  ) :?>
      <?php $variation_number = $key +1; ?>
      <?php endif ?>
    <?php endforeach; ?>

    <div class="card">
      <div class="card-content">
        <div class="card-content_description">
          <a href="<?php echo ($product_url ."?variationNumber=".$variation_number);?>">
          <h4 class="card-content_description--title"><?php echo get_the_title( $value->post_parent ); ?></h4>
          </a>
          <h6 class="card-content_description--weight"><?php echo $variable_product->get_attributes()['gramaza']; ?></h6>
          <h3 class="card-content_description--price">
            <span class="price-reg">
            <span class="regular_price">
            <span class="line"></span>
            <?php echo $variable_product->get_regular_price(); ?>,-
            </span>
            </span>
            <?php $sale= $variable_product->get_sale_price(); ?>
            <?php if($sale != ''):?>
            <span class="sale_price"> <?php echo($sale);?><?php echo(',-');?></span>   
            <?php endif; ?>
          </h3>
        </div>

        <a href="<?php echo ($product_url ."?variationNumber=".$variation_number);?>">
          <div class="card-content_image" style="background-image: url('<?php  echo $thumbnail; ?>')" ></div>
        </a>
        <a href="?add-to-cart=<?php echo ($value->post_parent ); ?>&variation_id=<?php echo $variation_id?>&attribute_gramaza=<?php echo ( $variable_product->get_attributes()['gramaza']); ?>" class="add_to_cart_button button"><h3>+</h3></a>
    </div>
  </div>
<?php endwhile;?>

</div>
<div class="cards-info main-container">
    <div class="cards-info_text">
      <h6><i class="far fa-check-circle"></i>Sigurna kupovina</h6>
      <h6><i class="far fa-check-circle"></i>Dostava danas za sutra</h6>
      <h6><i class="far fa-check-circle"></i>Slanje paketa širom Srbije</h6>
    </div>
    <a class="button go-to-shop" type="button" href="shop?productOrderBy=menu_order&itemOrder=ASC"><h5>Internet prodavnica<i class="fas fa-shopping-cart"></i></h5></a>
  </div>
  </div>
  
</div>
