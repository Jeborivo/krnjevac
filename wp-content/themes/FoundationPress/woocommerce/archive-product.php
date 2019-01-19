
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

    <div class="searchsort-container">
      <div class="sort">
        <?php $site_url =  get_site_url();?>
        <select value="asd" id="product-sort" onchange="productSort('<?php echo $site_url; ?>')">
          <option value="selected" >Selected</option>
          <option value="najprodavanije">Najprodavanije</option>
          <option value="ime">Ime</option>
          <option value="cena">Cena</option>
        </select>
        <span><a id="arrow-asc" onclick="arrowAsc()" href="" >strelica gore</a></span>
        <span><a id="arrow-desc" onclick="arrowDesc()" href="" >strelica dole</a></span>
      </div>
      

      <div class="search">
          <?php get_search_form(); ?>
      </div>
    </div>
    

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



          <div class="category_filter filter-collapsible">
            <!-- <input id="filter-colapse" class="ft-toggle" type="checkbox" checked> -->
            <label for="filter-colapse" class="filter-toggle">Kategorije <span id="category-close" onclick="categoryClose()">x</span> </label>
              <div class="filter-colapse-content">
                <div class="filter-content-inner"> 
                  <?php foreach ($all_categories as $cat):?>
                    <?php if($cat->name != 'Popular'):?>
                      <input class="button filter-neutral filter-categories" type="button" id="<?php echo str_replace(' ','_',$cat->name); ?>"class=" <?php echo str_replace(' ','_',$cat->name); ?>" onclick="categoryFilter(this.value)" value="<?php echo $cat->name?>"> <br>
                    <?php endif;?>
                  <?php endforeach; ?>
                </div>
              </div>
          </div>
          
          <div class="vrste_meda vrste-collapsible filter-item">
          
            <!-- <input id="vrste-colapse" class="vr-toggle" type="checkbox" checked> -->
            <label for="vrste-colapse" class="vrste-toggle">Vrste meda <span id="vrste-meda-close" onclick="vrsteMedaClose()" href="">x</span></label>
              <div class="vrste-colapse-content">
                <div class="vrste-content-inner">
                  <input class="button filter-neutral filter-type" type="button" id="bagremov_med" onclick="vrsteMedaFilter(this.id)" value="Bagremov med"> <br>
                  <input class="button filter-neutral filter-type" type="button" id="livadski_med" onclick="vrsteMedaFilter(this.id)" value="Livadski med"> <br>
                  <input class="button filter-neutral filter-type" type="button" id="lipov_med" onclick="vrsteMedaFilter(this.id)" value="Lipov med"> <br>
                  <input class="button filter-neutral filter-type" type="button" id="cvetni_med" onclick="vrsteMedaFilter(this.id)" value="Cvetni med"> <br>
                </div>
              </div>
          </div>

          <div id="gramaza" class="gramaza gramaza-collapsible filter-item" >
          
            <!-- <input id="gramaza-colapse" class="gr-toggle" type="checkbox" checked> -->
            <label for="gramaza-colapse" class="gramaza-toggle">Gramaza <span id="gramaza-close" onclick="gramazaClose()" href="">x</span> </label>
              <div class="gramaza-colapse-content">
                <div class="gramaza-content-inner">

                </div>
              </div>
          </div>

          <div class="price price-collapsible filter-item">
          
            <!-- <input id="price-colapse" class="pr-toggle" type="checkbox" checked> -->
            <label for="price-colapse" class="price-toggle">Cena <span id="range-close" onclick="rangeClose()">x</span> </label>
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
              
               
                    $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'tax_query' => array( array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => array( 18 ), // Product category ID to exlude from display(popular cat in this case)
                        'operator' => 'NOT IN',
                    ) ),);
                    $loop = new WP_Query( $args );
                    $products_array = array();
                   
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
                          <?php $variation_number = 0;?>
                            <?php  foreach ($variations as $value) : ?>
                            <?php $variation_number ++;?>
                            <?php  $single_variation=new WC_Product_Variation($value);?>
                            <?php $popular = $single_variation->get_weight(); ?>
                            <?php $title = $single_variation->get_title();?>
                            <?php $sale= $single_variation->get_sale_price(); ?>
                            <?php $product_date = $single_variation->get_date_created();?>
                            <?php $vrstameda = get_field( "vrste_meda" ); ?>
                            <?php $variation_image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ),'full' );?> <!-- list categories for current product -->
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
                                      "product_id"       => $product->get_id(),
                                      "variation_id"     => $value,
                                      "variation_number" => $variation_number,
                                      "name"             => $title,
                                      "gramaza"          => $product->get_attributes()['gramaza']['options'][$br],
                                      "price_regular"    => $single_variation->get_regular_price(),
                                      "price_sale"       => $sale,
                                      "image"            => $variation_image[0],
                                      "vrsta_meda"       => $vrstameda,
                                      "category"         => $categories,
                                      "date"             => $product_date,
                                      "popular"          => $popular,
                                    );  ?>
                               <?php    array_push($products_array, $product_array); ?>
                               <?php $br++ ?>
                              <!-- Product grid classes -->
                            <?php endforeach; ?> 
                    <?php endwhile ?>
                    <?php 
                    $productOrderBy = $_GET["productOrderBy"];
                    $itemOrder = $_GET["itemOrder"];
                   


                     switch ($productOrderBy) {
                        case ($productOrderBy=="title" && $itemOrder=="ASC") :  
                            usort($products_array, function($a, $b) {
                              if($a['name']==$b['name']) return 0;
                              return $b['name'] < $a['name']?1:-1;
                            });                   
                        break;
                        case ($productOrderBy=="title" && $itemOrder=="DESC") :   
                             case ($productOrderBy=="title" && $itemOrder=="ASC") :    
                             usort($products_array, function($a, $b) {
                               if($a['name']==$b['name']) return 0;
                               return $a['name'] < $b['name']?1:-1;
                           });       
                        break;
                        case ($productOrderBy=="menu_order" && $itemOrder=="ASC") :
                              usort($products_array, function($a, $b) {
                                if($a['popular']==$b['popular']) return 0;
                                return $b['popular'] < $a['popular']?1:-1;
                              });          
                        break;
                        case ($productOrderBy=="menu_order" && $itemOrder=="DESC") :
                              usort($products_array, function($a, $b) {
                                if($a['popular']==$b['popular']) return 0;
                                return $a['popular'] < $b['popular']?1:-1;
                              });   
                        break;
                        case ($productOrderBy=="date" && $itemOrder=="ASC") :
                              usort($products_array, function($a, $b) {
                                  if($a['date']==$b['date']) return 0;
                                  return $a['date'] < $b['date']?1:-1;
                              });                   
                        break;
                        case ($productOrderBy=="date" && $itemOrder=="DESC") :
                              usort($products_array, function($a, $b) {
                                  if($a['date']==$b['date']) return 0;
                                  return $a['date'] < $b['date']?1:-1;
                              });  
                        break;
                        case ($productOrderBy=="cena" && $itemOrder=="ASC") :
                              usort($products_array, function($a, $b) {
                                  if($a['price_regular']==$b['price_regular']) return 0;
                                  return $b['price_regular'] < $a['price_regular']?1:-1;
                              });                   
                        break;
                        case ($productOrderBy=="cena" && $itemOrder=="DESC") :
                              usort($products_array, function($a, $b) {
                                  if($a['price_regular']==$b['price_regular']) return 0;
                                  return $a['price_regular'] < $b['price_regular']?1:-1;
                              });  
                        break;

                  }
                      
                    ?>
                    <?php foreach ($products_array as $sortable_product):?>
                    <?php  $variation_url = get_permalink( $sortable_product["product_id"]) ;?>
                    </a>
                    <div class="product card
                              <?php echo $sortable_product["gramaza"];?>      
                              <?php echo $sortable_product["vrsta_meda"];?>     
                              <?php foreach($sortable_product["category"] as $category):?>
                              <?php echo($category);?>
                              <?php endforeach;?>  
                             ">
                              <div class="card-content">
                                <div class="card-content_description">
                                <a href="<?php echo ($variation_url ."?variationNumber=".$sortable_product["variation_number"]);?>">
                                  <h4 class="card-content_description--title"><?php echo $sortable_product["name"];?></h4>
                                </a>
                                  <h6 class="product_gramaza card-content_description--weight"> <?php echo $sortable_product["gramaza"];?></h6>
                                  <!-- displays price -->
                                  <h3 class="card-content_description--price"> 
                                  <?php if($sortable_product["price_sale"] != ''):?>
                                  <span class="price-reg">
                                  <span class="line"></span>  
                                  <span class="regular_price">
                                  <?php echo($sortable_product["price_regular"]);?></span><span>,-</span>
                                  </span>
                                  <span class="sale_price"><?php echo($sortable_product["price_sale"]);?></span>
                                        <?php echo(',-');?>
                                 <?php else: ?>
                                 <span class="regular_price"><?php echo($sortable_product["price_regular"]);?></span>,-
                                <?php endif ?>
                                  </h3>
                                </div>
                                <!-- displays image url for current variation -->
                                <a href="<?php echo ($variation_url ."?variationNumber=".$sortable_product["variation_number"]);?>">
                                 <div class="card-content_image" style="background-image: url('<?php echo $sortable_product["image"]?>')">
                                </div>
                                </a>
                                <!-- custom add to cart button for current variation -->
                                <a href="?add-to-cart=<?php echo $sortable_product["product_id"]; ?>&variation_id=<?php echo $sortable_product["variation_id"];?>&attribute_gramaza=<?php echo ($sortable_product["gramaza"]); ?>" class="add_to_cart_button button"><h3>+</h3></a>
                               </div>
                              </div>
                    <?php endforeach; ?>
            </div><!--/.products-->
            </div>
		</main>
		
	</div>
</div>

          <div class="shop-newsletter main-container-full-width">
            <div class="shop-newsletter_wrap main-container">
              <div class="shop-newsletter_title newsletter-item">
                <h2 class="ntitle">Pretplati se na newsletter</h2>
                <p>Vestibulum fringilla felis in finibus elementum. Maecenas venenatis massa a ullamcorper laoreet. Aenean at ex diam.</p>
              </div>
            
              <form action="" class="shop-newsletter_email newsletter-item">
                <input type="text" class="shop-newsletter_email--text " placeholder="E mail adresa">
                <input type="submit" value="Pošalji" class="button btn-grey shop-newsletter_email--submit">
              </form>
            </div>
          </div>
<?php
get_footer();