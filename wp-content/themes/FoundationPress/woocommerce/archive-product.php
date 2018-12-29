
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
    <script src="wp-content/themes/FoundationPress/js/multirange.js"></script>
    <script src="wp-content/themes/FoundationPress/js/jquery.js"></script>
		
<div class="main-container">
	<div class="main-grid">
	<div class="filters">
	<!-- shows product categories -->
			<?php
				$taxonomy     = 'product_cat';
				$orderby      = 'name';  
				$show_count   = 0;      // 1 for yes, 0 for no
				$pad_counts   = 0;      // 1 for yes, 0 for no
				$hierarchical = 1;      // 1 for yes, 0 for no  
				$title        = '';  
				$empty        = 0;

				$args = array(
					'taxonomy'     => $taxonomy,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'hide_empty'   => $empty
				);
				$all_categories = get_categories( $args );
			?>


        <link rel="stylesheet" href="multirange.css">
        <div class="range">
        
        <input id="range_slider" type="range" multiple value="0,100" />
          <p class="low_value"></p><p class="high_value"></p>
        </div>
       

          <div>
  
</div>
          <ul class="category_filter">
            <h3>Kategorije</h3>
            <?php foreach ($all_categories as $cat):?>
            <?php if($cat->name != 'Popular'):?>
              <input type="button" id="<?php echo str_replace(' ','_',$cat->name); ?>"class="<?php echo str_replace(' ','_',$cat->name); ?>" onclick="categoryFilter(this.value)" value="<?php echo $cat->name?>"> <br>
            <?php endif;?>
            <?php endforeach; ?>
          </ul>

          <ul class="vrste_meda">
           <h3>Vrste meda</h3>
            <input type="button" id="bagremov_med" onclick="vrsteMedaFilter(this.id)" value="Bagremov med"> <br>
            <input type="button" id="livadski_med" onclick="vrsteMedaFilter(this.id)" value="Livadski med"> <br>
            <input type="button" id="lipov_med" onclick="vrsteMedaFilter(this.id)" value="Lipov med"> <br>
            <input type="button" id="cvetni_med" onclick="vrsteMedaFilter(this.id)" value="Cvetni med"> <br>
          </ul>

          <div id="gramaza" class="gramaza"></div>

	</div>
		<main class="main-content">
                <ul  id="product_list"class="products">
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
                             <!-- list categories for current product -->
                             <?php $categories=[]; ?>
                             <?php $terms = get_the_terms( $post->ID, 'product_cat' );?>
                                              <?php foreach ($terms as $term) :?>
                                                   <?php $product_cat_id = $term->term_id;?>
                                                   <?php  if( $term = get_term_by( 'id', $product_cat_id, 'product_cat' ) ):?>
                                                      <?php $catFormatted =str_replace(" ","_", $term->name); ?>
                                                      <?php array_push($categories,$catFormatted);?>
                                                   <?php endif; ?>
                                 <?php endforeach; ?>

                              <!-- Product grid classes -->
                              <div class="product         
                              <?php echo ($product->get_attributes()['gramaza']['options'][$br]); ?>                       
                              <?php the_field('vrste_meda'); ?>
                              <?php foreach($categories as $category):?>
                              <?php echo $category;?>
                              <?php endforeach;?>">
                               <h3 class="product_title"><?php the_title(); ?></h3>
                                <div id="categories">
                                       
                                </div>
                                <!-- lists  Gramaza attribute -->
                               <?php if (isset($product->get_attributes()['gramaza']['options'][$br])): ?>
                                  <p class="product_gramaza"> <?php echo ($product->get_attributes()['gramaza']['options'][$br]); ?></p>
                               <?php endif;?>
                               <!-- displays price -->
                               <h3 class="card-content_descriptio--price"> <span id="regular_price"><?php echo $single_variation->get_regular_price(); ?></span>,- 
                                <?php $sale= $single_variation->get_sale_price(); ?>
                               <?php if($sale != ''):?>
                               <span id="sale_price"> <?php echo($sale);?></span>
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
            <div class="empty_results"></div>
		</main>
		
	</div>
</div>
<?php
get_footer();