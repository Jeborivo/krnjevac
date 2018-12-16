<p>Najpopularniji Krnjevac proizvodi</p>


<ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => 'Popular', 'orderby' => 'rand' );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
           <h3><?php the_title(); ?></h3>
                <li class="product">   
                <p> 
                            <?php if (isset($product->get_attributes()['gramaza']['options'][0])): ?>
                              <?php echo ($product->get_attributes()['gramaza']['options'][0]); ?>
                            <?php endif;?>
                       </p> 
                    <p> <?php echo($product->get_regular_price()) ?> ,- 
                    <?php 
                    $sale= $product->get_sale_price();
                    if($sale != ''):?>
                     <?php echo($product->get_sale_price());?>
                     <?php echo(',-');?>
                    <?php endif; ?>
                    </p>
                    <?php if ( has_post_thumbnail( $product->get_id() ) ):?>
                         <?php $attachment_ids[0] = get_post_thumbnail_id( $product->get_id() );?>
                         <?php $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' ); ?>
                         <img src="<?php echo $attachment[0] ; ?>" class="card-image"  />
                    <?php endif; ?>
                    <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                    
                </li>
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul><!--/.products-->