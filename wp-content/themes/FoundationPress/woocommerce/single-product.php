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
		<script src="wp-content/themes/FoundationPress/js/single_product.js"></script>
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
					<div class="product_image">
			 				 <?php  echo "<img src=" . $variation['image']['thumb_src'] .">"; ?>
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
						<a class="product-info_link-wrap--link tabela_nutritivnih_vrednosti" href="#">Tabela nutritivnih vrednosti <i class="icon-arrow-right"></i></a>
						<a class="product-info_link-wrap--link kupi_u_prodavnici" href="#">Kupi u prodavnici <i class="icon-arrow-right"></i></a>
					</div>

					<div class="product-info_price-quantity-to-cart-wrap">

					<?php foreach ( $variations as $variation ) :?>	
					<?php $br2++;?>
						<!-- display prices -->			
						<h3 class="card-content_descriptio--price variation_price variation_price<?php echo $br2?>"> <?php echo $variation['display_regular_price'];?>,- 
                            <?php if( $variation['display_price']!= ''):?>
							<?php echo $variation['display_price'];?>
                                    <?php echo(',-');?>
                        	<?php endif; ?>
						</h3>
					<?php endforeach;?>
	
						<input id='cart_quantity' class="quantity product-info_price-quantity-to-cart-wrap--quantity" value="1" type="number" name="quantity" min="1" max="99">
						<input type="button" id="variation_add_to_cart" class="button product-info_price-quantity-to-cart-wrap--button" onclick="addToCart()"value="Dodaj u korpu">
					</div>

			
			</div><!-- product-info -->
			<?php endwhile; ?>
		</div><!--Product-container -->
		<div class="related-products cards">
			<div class="related-filters">
				<div class="related-filters_buttons">
					<button type="button" class="button btn-grey related-filters_buttons--last">Poslednje pregledano</button>
					<button type="button" class="button btn-grey related-filters_buttons--most">Najprodavanije</button>
				</div>
				<a href="#" class="related-filters_link">Internet-prodavnica <i class="icon-arrow-right"></i></a>
			</div>
			<div class="cards-container">
			<?php $relatedProducts = wc_get_related_products($product->get_id())?>

				<?php foreach ($relatedProducts as $related):?>
				<div class="card">
        			<div class="card-content">
						<?php $relatedProduct = wc_get_product( $related );?>
						<h4 class="card-content_description--title"><?php echo $relatedProduct->get_title();?></h4>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $related ), 'single-post-thumbnail' );?>
						<div class="card-content_image" style="background-image: url('<?php  echo $image[0]; ?>')"></div>
						<a href="<?php echo get_permalink($related); ?>"> Jos</a>
					</div>
				</div>
				<?php endforeach;?>
			</div> 
		</div> <!--related-product-container -->

		<div class="product-buy-info">
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
				<button class="button btn-grey"><img 			src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/letter.svg" alt="letter"></button>
			</div>
		</div>
		</main>
	</div>
</div>
<?php
get_footer();
