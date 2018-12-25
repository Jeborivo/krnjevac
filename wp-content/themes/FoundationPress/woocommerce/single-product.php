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
			
			<?php while ( have_posts() ) : the_post(); ?>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
			<?php
				// loads product variations
                  $product = new WC_Product_Variable($product->get_id());
				  $variations = $product->get_available_variations();
				  $br=0;
				  $br1=0;
				  $br2=0;
				 ?>

			
			<h2><?php echo $product->get_name();?></h2>
			<h3 class="active_attribute"></h3>
			<div class="variation_select">
				<div id="product_id"><?php echo ($product->get_id()); ?></div>
			<?php foreach ( $variations as $variation ) :?>
	
			<!-- lists all atrributes -->
			
				<?php if (isset($product->get_attributes()['gramaza']['options'][$br1])): ?>
					  <input id="attributeSelectorButton<?php echo $br1+1;?>"onclick="attributeSelect(this.name)"name="<?php echo $br1+1;?>" class="active button_<?php echo $br1;?> " type="button" value="<?php echo ($product->get_attributes()['gramaza']['options'][$br1]); ?>">
					  <div class="variationId variation_<?php echo $br1+1;?>"><?php echo $variation['variation_id'];?></div>
			   <?php endif;?>
			   <div class="stock stock<?php echo $br1+1;?>"><?php echo $variation['is_in_stock'];?></div>
			   <?php $br1++; ?>
			<?php endforeach;?>
			<div class="stockIcon"></div>
			</div>
				
			<?php foreach ( $variations as $variation ) :?>
				<?php $br++; ?>
				<div class="variation_image variation_image_<?php echo $br;?>">
					<!-- prints images for variations -->
					<div class="product_image">
			 				 <?php  echo "<img src=" . $variation['image']['thumb_src'] .">"; ?>
					</div>
				</div>
			<?php endforeach;?>
			
			<div class="product_description"><?php echo $product->get_data()['description'];?></div>
			<a class="tabela_nutritivnih_vrednosti" href="#">Tabela nutritivnih vrednosti</a>
			<br>
			<a class="kupi_u_prodavnici" href="#">Kupi u prodavnici</a>
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
	
			<input id='cart_quantity' class="quantity" value="1" type="number" name="quantity" min="1" max="99">
			<input type="button" id="variation_add_to_cart" onclick="addToCart()"value="Add to cart">
			
		 
			</div>
			
			<?php endwhile; ?>
		</main>
	
	</div>
</div>
<?php
get_footer();
