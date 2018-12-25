<?php /* Template Name: shop */ ?>
<?php
/**
 * 
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
                <ul class="products">
                <?php
                    $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'orderby'=>'title', 'order'=>'desc', 'tax_query' => array( array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => array( 18 ), // Product category ID to exlude from display(popular cat in this case)
                        'operator' => 'NOT IN',
                    ) ),);
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                         <?php $productId= $product->get_id();?>
                         <?php
                        //  gets variations of the product
                          $handle=new WC_Product_Variable($productId);
                          $variations=$handle->get_children();
                          ?>
                        
                          <?php $br=0;?>
                            <?php  foreach ($variations as $value) : ?>
                            
                            <?php  $single_variation=new WC_Product_Variation($value);?>
                              <div class="product">
                               <h3><?php the_title(); ?></h3>
                                <div id="vrsta_meda"> <?php the_field('vrste_meda'); ?></div>
                                <div id="categories">
                                        <!-- list categories for current product -->
                                        <?php $terms = get_the_terms( $post->ID, 'product_cat' );?>
                                              <?php foreach ($terms as $term) :?>
                                                   <?php $product_cat_id = $term->term_id;?>
                                                   <?php  if( $term = get_term_by( 'id', $product_cat_id, 'product_cat' ) ):?>
                                                      <?php echo $term->name;?>
                                                      <?php break;?>
                                                   <?php endif; ?>
                                 <?php endforeach; ?>
                                </div>
                                <!-- lists  Gramaza attribute -->
                               <?php if (isset($product->get_attributes()['gramaza']['options'][$br])): ?>
                                  <?php echo ($product->get_attributes()['gramaza']['options'][$br]); ?>
                               <?php endif;?>
                               <!-- displays price -->
                               <h3 class="card-content_descriptio--price"> <?php echo $single_variation->get_regular_price(); ?>,- 
                                <?php $sale= $single_variation->get_sale_price(); ?>
                               <?php if($sale != ''):?>
                                        <?php echo($sale);?>
                                        <?php echo(',-');?>
                                <?php endif; ?>
                                </h3>
                                <!-- displays image url for current variation -->
                                <?php $variation_image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ) );?>
                                <img src="<?php echo $variation_image[0]?>" alt="">
                                <!-- custom add to cart button for current variation -->
                                <a href="?add-to-cart=<?php echo ($product->get_id()); ?>&variation_id=<?php echo $value?>&attribute_gramaza=<?php echo ($product->get_attributes()['gramaza']['options'][$br]); ?>">+</a>

                               <?php $br++;?>
                              </div>
                            <?php endforeach; ?>
                            <?php if ($br==0): ?>
                            <!-- case if product has no variation :D -->
                             <?php endif;?>
                    <?php endwhile ?>
            </ul><!--/.products-->
		</main>
		
	</div>
</div>
<?php
get_footer();