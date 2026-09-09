<?php
/**
 * Single Product Template
 *
 * @package Art_Prints_Theme
 */

get_header( 'shop' );

/**
 * Hook: woocommerce_before_single_product.
 */
do_action( 'woocommerce_before_single_product' );

if ( post_exists( get_the_ID() ) ) {
	?>
	<div class="container mt-5 mb-5">
		<div class="row">
			<?php
			while ( have_posts() ) {
				the_post();
				?>
				<!-- Product Image Gallery -->
				<div class="col-lg-6">
					<div class="product-gallery">
						<?php
						/**
						 * Hook: woocommerce_product_images.
						 */
						do_action( 'woocommerce_product_images' );
						?>
					</div>
				</div>

				<!-- Product Details -->
				<div class="col-lg-6">
					<div class="product-details">
						<!-- Product Title -->
						<h1 class="product-title">
							<?php the_title(); ?>
						</h1>

						<!-- Product Rating -->
						<div class="product-rating-wrapper">
							<?php
							/**
							 * Hook: woocommerce_single_product_summary.
							 */
							do_action( 'woocommerce_single_product_summary' );
							?>
						</div>

						<!-- Product Meta (SKU, Categories) -->
						<div class="product-meta mt-4">
							<?php
							/**
							 * Hook: woocommerce_product_meta_start.
							 */
							do_action( 'woocommerce_product_meta_start' );

							if ( wc_product_sku_enabled() && ( $sku = $GLOBALS['product']->get_sku() ) ) {
								?>
								<p class="product-sku">
									<strong><?php esc_html_e( 'SKU:', 'art-prints-theme' ); ?></strong>
									<span><?php echo esc_html( $sku ); ?></span>
								</p>
								<?php
							}

							echo wc_get_product_category_list( get_the_ID(), ', ', '<p class="product-categories"><strong>' . esc_html_e( 'Categories:', 'art-prints-theme' ) . '</strong> ', '</p>' );

							echo wc_get_product_tag_list( get_the_ID(), ', ', '<p class="product-tags"><strong>' . esc_html_e( 'Tags:', 'art-prints-theme' ) . '</strong> ', '</p>' );

							/**
							 * Hook: woocommerce_product_meta_end.
							 */
							do_action( 'woocommerce_product_meta_end' );
							?>
						</div>
					</div>
				</div>
			</div>

			<!-- Product Tabs & Reviews -->
			<div class="row mt-5">
				<div class="col-12">
					<?php
					/**
					 * Hook: woocommerce_after_single_product_summary.
					 */
					do_action( 'woocommerce_after_single_product_summary' );
					?>
				</div>
			</div>

			<?php
			}
			?>
		</div>
	</div>
	<?php
}

/**
 * Hook: woocommerce_after_single_product.
 */
do_action( 'woocommerce_after_single_product' );

get_footer( 'shop' );
