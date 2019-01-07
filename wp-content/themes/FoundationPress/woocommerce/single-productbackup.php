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
			<!-- custom related  -->
			<?php 
			// query
				$args = array( 'post_type' => 'related_product', 'posts_per_page' => -1,'meta_key'=> 'product_display','meta_value'	=> $product->get_id());
				$loop = new WP_Query( $args );
			?>
			<h2> Related</h2>
			<?php while ( $loop->have_posts() ) : $loop->the_post();
			// values
				$value = get_field( "product_link" );
				$productRelated = new WC_Product_Variable($value->post_parent );
				
				$variable_product = wc_get_product($value->ID);
			$thumbnail = get_the_post_thumbnail_url($value->ID);
				
			?>
		


			<div class="card">
        		<div class="card-content">
					<h3 class="title"><?php echo get_the_title( $value->post_parent ); ?></h3>
					<h4 class="gramaza"><?php echo $variable_product->get_attributes()['gramaza']; ?></h4>
					<div class="cena">	<?php echo $variable_product->get_regular_price(); ?></span>,- 
                                <?php $sale= $variable_product->get_sale_price(); ?>
                               <?php if($sale != ''):?>
                               <span id="sale_price"> <?php echo($sale);?></span>
                                        <?php echo(',-');?>
								<?php endif; ?>
			
			</div>
					<img class="card-content_image" src="<?php  echo $thumbnail; ?>" >
					<a href="?add-to-cart=<?php echo ($value->post_parent ); ?>&variation_id=<?php echo $value->ID?>&attribute_gramaza=<?php echo ( $variable_product->get_attributes()['gramaza']); ?>">+</a>
				</div>
			</div>
			
				
			
		<?php	endwhile;?>
			 
				
		
		
		

		</main>
	
	</div>
</div>
<?php
get_footer();
