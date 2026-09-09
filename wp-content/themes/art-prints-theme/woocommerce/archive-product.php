<?php
/**
 * WooCommerce Product Archive Template
 *
 * @package Art_Prints_Theme
 */

get_header();
?>

<div class="woocommerce-wrapper">
	<?php
	/**
	 * Hook: woocommerce_before_main_content.
	 */
	do_action( 'woocommerce_before_main_content' );
	?>

	<div class="container mt-5 mb-5">
		<div class="row">
			<!-- Sidebar Filters -->
			<div class="col-lg-3 mb-4">
				<div class="woocommerce-sidebar">
					<?php
					if ( is_active_sidebar( 'primary-sidebar' ) ) {
						dynamic_sidebar( 'primary-sidebar' );
					}
					?>
				</div>
			</div>

			<!-- Main Content -->
			<div class="col-lg-9">
				<header class="woocommerce-products-header mb-4">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="woocommerce-products-header__title page-title">
							<?php woocommerce_page_title(); ?>
						</h1>
					<?php endif; ?>

					<?php
					/**
					 * Hook: woocommerce_archive_description.
					 */
					do_action( 'woocommerce_archive_description' );
					?>
				</header>

				<?php
				if ( woocommerce_product_loop() ) {
					/**
					 * Hook: woocommerce_before_shop_loop.
					 */
					do_action( 'woocommerce_before_shop_loop' );
					?>

					<div class="products-grid">
						<?php
						woocommerce_product_loop_start();

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								/**
								 * Hook: woocommerce_shop_loop.
								 */
								do_action( 'woocommerce_shop_loop' );
								wc_get_template_part( 'content', 'product' );
							}
						}

						woocommerce_product_loop_end();
						?>
					</div>

					<?php
					/**
					 * Hook: woocommerce_after_shop_loop.
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 */
					do_action( 'woocommerce_no_products_found' );
				}

				/**
				 * Hook: woocommerce_after_main_content.
				 */
				do_action( 'woocommerce_after_main_content' );
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
