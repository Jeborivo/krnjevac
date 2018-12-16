<p>Najpopularniji Krnjevac proizvodi</p>


<?php
        $featured = array(
            'post_type' => 'product',
            'posts_per_page' => 4,
            'tax_query' => array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    ),
                ),
            );
        $loop = new WP_Query( $featured );
        if ( $loop->have_posts() ):?>
       <?php     while ( $loop->have_posts() ) :?>

        <?php $loop->the_post(); ?>
            <?php    wc_get_template_part( 'content', 'product' ); ?>
          <?php  endwhile; ?>
        <?php else:?>
           <?php echo __( 'No products found' ); ?>
        <?php endif ?>
      <?php  wp_reset_postdata(); ?>
