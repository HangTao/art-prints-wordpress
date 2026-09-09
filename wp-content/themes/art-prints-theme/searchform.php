<?php
/**
 * Search Form Template
 *
 * @package Art_Prints_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-field" class="screen-reader-text">
		<?php esc_html_e( 'Search for:', 'art-prints-theme' ); ?>
	</label>
	<div class="search-input-wrapper">
		<input 
			type="search" 
			id="search-field" 
			class="search-field" 
			placeholder="<?php esc_attr_e( 'Search...', 'art-prints-theme' ); ?>" 
			value="<?php echo get_search_query(); ?>" 
			name="s"
		>
		<button type="submit" class="search-button">
			<i class="fas fa-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'art-prints-theme' ); ?></span>
		</button>
	</div>
</form>
