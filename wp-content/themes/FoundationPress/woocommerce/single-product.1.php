
<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			
			<?php 
			// prints images, it has to be this way..
			$product = new WC_Product_Variable($product->get_id());
			$variations = $product->get_available_variations();?>
		 
			
			<?php foreach ( $variations as $variation ) :?>z
			<div class="product_image">
			  <?php  echo "<img src=" . $variation['image']['thumb_src'] .">"; ?>
			</div>
			<?php endforeach;?>
			
				<?php if (isset($product->get_attributes()['gramaza']['options'][1])): ?>
                      <p><?php echo ($product->get_attributes()['gramaza']['options'][1]); ?></p>
        	   <?php endif;?>
		
		<div class="product_description"><?php echo $product->get_data()['description'];?></div>

			
							 
		<?php endwhile; // end of the loop. ?>
		
		
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>



