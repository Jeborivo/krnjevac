
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
  <main class="main-content">
  <div class="shop-container">

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

        <!-- Sort -->
          <div class="cort">
            <span>SORTIRAJ</span>
            <?php $site_url =  get_site_url();?>
            <select id="product-sort" onchange="productSort('<?php echo $site_url; ?>')">
              <option value="najprodavanije">Najprodavanije</option>
              <option value="datum">Datum</option>
              <option value="ime">Ime</option>
            </select>
            <span><a id="arrow-asc" onclick="arrowAsc()" href="" >strelica gore</a></span>
            <span><a id="arrow-desc" onclick="arrowDesc()" href="" >strelica dole</a></span>
          </div>

          <div class="category_filter filter-collapsible">
            <input id="filter-colapse" class="ft-toggle" type="checkbox" checked>
            <label for="filter-colapse" class="filter-toggle">Kategorije</label>
              <div class="filter-colapse-content">
                <div class="filter-content-inner">
                  <?php foreach ($all_categories as $cat):?>
                    <?php if($cat->name != 'Popular'):?>
                      <input class="button" type="button" id="<?php echo str_replace(' ','_',$cat->name); ?>"class="<?php echo str_replace(' ','_',$cat->name); ?>" onclick="categoryFilter(this.value)" value="<?php echo $cat->name?>"> <br>
                    <?php endif;?>
                  <?php endforeach; ?>
                </div>
              </div>
          </div>
          
          <div class="vrste_meda vrste-collapsible">
            <input id="vrste-colapse" class="vr-toggle" type="checkbox" checked>
            <label for="vrste-colapse" class="vrste-toggle">Vrste meda</label>
              <div class="vrste-colapse-content">
                <div class="vrste-content-inner">
                  <input class="button" type="button" id="bagremov_med" onclick="vrsteMedaFilter(this.id)" value="Bagremov med"> <br>
                  <input class="button" type="button" id="livadski_med" onclick="vrsteMedaFilter(this.id)" value="Livadski med"> <br>
                  <input class="button" type="button" id="lipov_med" onclick="vrsteMedaFilter(this.id)" value="Lipov med"> <br>
                  <input class="button" type="button" id="cvetni_med" onclick="vrsteMedaFilter(this.id)" value="Cvetni med"> <br>
                </div>
              </div>
          </div>

          <div id="gramaza" class="gramaza gramaza-collapsible">
            <input id="gramaza-colapse" class="gr-toggle" type="checkbox" checked>
            <label for="gramaza-colapse" class="gramaza-toggle">Gramaza</label>
              <div class="gramaza-colapse-content">
                <div class="gramaza-content-inner">
                  <p>Gramaza</p>
                </div>
              </div>
          </div>

          <div class="price price-collapsible">
            <input id="price-colapse" class="pr-toggle" type="checkbox" checked>
            <label for="price-colapse" class="price-toggle">Cena</label>
              <div class="price-colapse-content">
                <div class="price-content-inner">
                  <div class="range">
                    <input id="range_slider" type="range" multiple value="0,100" />
                    <div class="value-container">
                      <span class="low_value"></span>
                      <span class="high_value"></span>
                    </div>
                  </div>    
                </div>
              </div>
          </div>
	      </div>

        <div class="product-list">
        

                <div   class="products-container">
                <?php
                if (isset($_GET['productOrderBy'])){
                  $productOrderBy = $_GET['productOrderBy'];
                }
                else {
                  $productOrderBy = 'title';
                }
                if (isset($_GET['itemOrder'])){
                  $productOrder= $_GET['itemOrder'];
                }
                else {
                  $productOrder = 'ASC';
                }
               
                    $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'orderby'=>$productOrderBy, 'order'=> $productOrder, 'tax_query' => array( array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => array( 18 ), // Product category ID to exlude from display(popular cat in this case)
                        'operator' => 'NOT IN',
                    ) ),);
                    $loop = new WP_Query( $args );
                    $products_array = array();
                   
                    // SORTING NE MOZE DIREKTNO IZ  QUERYIJA, MORACU DIREKTNO NIZ DA SORTIRAM, MOZDA CAK I PRAVITI NOV, ZA SAD MOZE DA SE STILIZUJE
                    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                         <?php $productId= $product->get_id();?>
                         <?php
                        //  gets variations of the product
                          $handle=new WC_Product_Variable($productId);
                          $variations=$handle->get_children();
                          ?>
                          <?php $br=0;?>
                          <?php 
                          
                            $counter=0;
                          ?>
                            <?php  foreach ($variations as $value) : ?>
                            <?php  $single_variation=new WC_Product_Variation($value);?>
                            <?php $title = $single_variation->get_title();?>
                            <?php $sale= $single_variation->get_sale_price(); ?>
                            <?php $vrstameda = get_field( "vrste_meda" ); ?>
                            <?php $variation_image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ) );?> <!-- list categories for current product -->
                             <?php $categories=[]; ?>
                             <?php $terms = get_the_terms( $post->ID, 'product_cat' );?>
                                              <?php foreach ($terms as $term) :?>
                                                   <?php $product_cat_id = $term->term_id;?>
                                                   <?php  if( $term = get_term_by( 'id', $product_cat_id, 'product_cat' ) ):?>
                                                      <?php $catFormatted =str_replace(" ","_", $term->name); ?>
                                                      <?php array_push($categories,$catFormatted);?>
                                                   <?php endif; ?>
                                 <?php endforeach; ?>
                            <?php  $product_array = array(
                              "product_id"=>$product->get_id(),
                              "variation_id"=>$value,
                              "name"=>$title,
                              "gramaza"=>$product->get_attributes()['gramaza']['options'][$br],
                              "price_regular"=>$single_variation->get_regular_price(),
                              "price_sale"=>$sale,
                              "image"=>$variation_image[0],
                              "vrsta_meda"=> $vrstameda,
                              "category"=> $categories,
                            );  ?>

                               <?php    array_push($products_array, $product_array); ?>
                               <?php $br++ ?>
               
                            

                              <!-- Product grid classes -->
                             
                             
                            <?php endforeach; ?> 
                           
                          
                            
                    <?php endwhile ?>
                    <?php foreach ($products_array as $sortable_product):?>
                    <div class="product card
                              <?php echo $sortable_product["gramaza"];?>                       
                              <?php echo $sortable_product["vrsta_meda"];?>     
                              <?php foreach($sortable_product["category"] as $category):?>
                              <?php echo($category);?>
                              <?php endforeach;?> 
                                 
                             ">
                        

                              <div class="card-content">
                                <div class="card-content_description">
                                  <h4 class="card-content_description--title"><?php echo $sortable_product["name"];?></h4>
                                  <h6 class="card-content_description--weight"> <?php echo $sortable_product["gramaza"];?></h6>
                                  <!-- displays price -->
                                  <h3 class="card-content_description--price"> <span id="regular_price"><?php echo $sortable_product["price_regular"]; ?></span>,- 
                                  
                                  <?php if($sortable_product["price_sale"] != ''):?>
                                  <span id="sale_price"> <?php echo($sortable_product["price_sale"]);?></span>
                                        <?php echo(',-');?>
                                  <?php endif; ?>
                                  </h3>
                                </div>
                                <!-- displays image url for current variation -->
                                <div class="card-content_image" style="background-image: url('<?php echo $sortable_product["image"]?>')">
                                </div>
                                <!-- custom add to cart button for current variation -->
                                <a href="?add-to-cart=<?php echo $sortable_product["product_id"]; ?>&variation_id=<?php echo $sortable_product["variation_id"];?>&attribute_gramaza=<?php echo ($sortable_product["gramaza"]); ?>" class="add_to_cart_button button"><h3>+</h3></a>
                               </div>
                              </div>
                    <?php endforeach; ?>
                
            </div><!--/.products-->
            </div>
            <div class="empty_results"></div>
            </div>
		</main>
		
	</div>
</div>
<?php
get_footer();