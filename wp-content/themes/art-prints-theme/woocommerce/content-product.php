<?php
/**
 * Product Content Template
 *
 * @package Art_Prints_Theme
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<div <?php wc_product_class( 'product-item', $product ); ?>>
	<div class="product-wrapper">
		<!-- Product Image -->
		<div class="product-image-wrapper">
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
		</div>

		<!-- Product Info -->
		<div class="product-info-wrapper">
			<!-- Product Title -->
			<h2 class="woocommerce-loop-product__title">
				<a href="<?php the_permalink(); ?>" class="product-link">
					<?php the_title(); ?>
				</a>
			</h2>

			<!-- Product Rating -->
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>

			<!-- Product Price -->
			<div class="product-price-wrapper">
				<?php
				/**
				 * Hook: woocommerce_after_shop_loop_item.
				 */
				do_action( 'woocommerce_after_shop_loop_item' );
				?>
			</div>

			<!-- Product Description Excerpt -->
			<p class="product-description">
				<?php echo wp_trim_words( $product->get_description(), 15 ); ?>
			</p>

			<!-- Add to Cart Button -->
			<div class="product-actions">
				<?php
				woocommerce_template_loop_add_to_cart();
				?>
			</div>
		</div>
	</div>
</div>
