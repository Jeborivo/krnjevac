<?php
/**
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


<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
		<script src="../krnjevac/wp-content/themes/FoundationPress/js/single_product.js"></script>
		<div class="product-container">

			<?php while ( have_posts() ) : the_post(); ?>
			<?php
				// loads product variations
                  $product = new WC_Product_Variable($product->get_id());
				  $variations = $product->get_available_variations();
				  $br=0;
				  $br1=0;
				  $br2=0;
				 ?>

			<div class="product-var-image product">
			<?php foreach ( $variations as $variation ) :?>
				<?php $br++; ?>
				<div class="variation_image variation_image_<?php echo $br;?>">
					<!-- prints images for variations -->
					<div class="product_image" style="background-image: url('<?php echo $variation['image']['url'] ?> ')">
					</div>
				</div>
			<?php endforeach;?>
			</div><!--product-variation-image -->

			<div class="product-info product">
				<div class="product-info_title">
					<h2><?php echo $product->get_name();?></h2>
					<h3 class="active_attribute"></h3>
				</div>
				<div class="variation_select product-info_variation-select">
					<div id="product_id"><?php echo ($product->get_id()); ?></div>
					<div class="var-button-wrap">
						<?php foreach ( $variations as $variation ) :?>
						<!-- lists all atrributes -->
						<?php if (isset($product->get_attributes()['gramaza']['options'][$br1])): ?>
						<input id="attributeSelectorButton<?php echo $br1+1;?>"onclick="attributeSelect(this.name)"name="<?php echo $br1+1;?>" class="active button_<?php echo $br1;?> button button-var" type="button" value="<?php echo ($product->get_attributes()['gramaza']['options'][$br1]); ?>">
						<div class="variationId variation_<?php echo $br1+1;?>"><?php echo $variation['variation_id'];?></div>
			   			<?php endif;?>
			   			<div class="stock stock<?php echo $br1+1;?>"><?php echo $variation['is_in_stock'];?></div>
			   			<?php $br1++; ?>
						<?php endforeach;?>
					</div>
					<div class="stockIcon"></div>
				</div>
				<div class="product_description product-info_description"><?php echo $product->get_data()['description'];?></div>
					<div class="product-info_link-wrap">
						<a class="product-info_link-wrap--link tabela_nutritivnih_vrednosti" href="#">Tabela nutritivnih vrednosti <i class="fas fa-arrow-right"></i></a>
						<a class="product-info_link-wrap--link kupi_u_prodavnici" href="?post_type=product&productOrderBy=menu_order&itemOrder=ASC">Kupi u prodavnici <i class="fas fa-arrow-right"></i></a>
					</div>
					<div class="product-info_price-quantity-to-cart-wrap">
					<?php foreach ( $variations as $variation ) :?>	
					<?php $br2++;?>
						<!-- display prices -->			
						<h3 class="card-content_descriptio--price variation_price variation_price<?php echo $br2?>"> 
						<?php if( $variation['display_price'] !=  $variation['display_regular_price']):?>
						<span class="price-reg">
						<span class="regular_price">
						<span class="line"></span>	
						<?php echo $variation['display_regular_price'];?>,- </span>
						</span>
						<span class="sale_price"><?php echo $variation['display_price'];?>,-</span>
						<?php else: ?>
						<span id="regular_price"> <?php echo $variation['display_price'];?>,-</span>
						<?php endif?>
						</h3>
					<?php endforeach;?>
					
						<div class="quantity product-info_price-quantity-to-cart-wrap--quantity">
							<input id='cart_quantity'value="1" type="number" name="quantity" min="1" max="99">
							<span class="quantity-spin">
								<span class="quantity-spin_up" id="arrow-asc" onclick="quantityUp(event);"> <i class="fas fa-caret-up"></i> </span>
								<span class="quantity-spin_down" id="arrow-desc" onclick="quantityDown(event);"> <i class="fas fa-caret-up caret-down"></i>
								</span>
							</span>
						</div>

						<input type="button" id="variation_add_to_cart" class="button product-info_price-quantity-to-cart-wrap--button" onclick="addToCart()"value="Dodaj u korpu">
					</div>			
			</div><!-- product-info -->
			<?php endwhile; ?>
		</div><!--Product-container -->
		</main>
		
	</div>
</div>
</div>

		<div class="related-products cards main-container-full-width">
			<div class="related_wrap-mc main-container">
			<div class="related-filters">
				<div class="related-filters_buttons">
					<button type="button" class="button btn-grey related-filters_buttons--last">Poslednje pregledano</button>
					<button type="button" class="button btn-grey related-filters_buttons--most">Najprodavanije</button>
				</div>
				<a href="?post_type=product&productOrderBy=menu_order&itemOrder=ASC" class="related-filters_link">Internet-prodavnica <i class="fas fa-arrow-right"></i></a>
			</div>
			<div class="cards-container">

			<?php 
			// query
				$args = array( 'post_type' => 'related_product', 'posts_per_page' => -1,'meta_key'=> 'product_display','meta_value'	=> $product->get_id());
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
			<!-- custom related  -->
		</div>
	</div>
	<div class="product-buy-info-wrap">
		<div class="product-buy-info main-container">
			<div class="product-buy-info_address info-field">
				<img src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/phone.svg" alt="phone">
				<h5> Korisnička podrška<br>
				+381 26 821 080</h5>
			</div>
			<div class="product-buy-info_delivery info-field"> 
				<img src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/delivery.svg" alt="delivery">
				<h5>Besplatna dostava za <br>
				porudžbine iznad 1999,-</h5>
			</div>
			<div class="product-buy-info_safe info-field">
				<img src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/ssl.svg" alt="ssl">
				<h5>Sigurna kupovina putem<br>
				sertifikovane prodavnice</h5>
			</div>
			<div class="product-buy-info_button info-field">
				<button class="button btn-grey"><img src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/letter.svg" alt="letter"></button>
			</div>
		</div>
	</div>
<?php
get_footer();
