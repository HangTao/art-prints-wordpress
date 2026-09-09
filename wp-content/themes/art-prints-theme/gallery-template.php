<?php
/**
 * Template for displaying art gallery
 * 
 * @package Art_Prints_Theme
 */

get_header();
?>

<div class="hero-section">
  <div class="hero-content">
    <h1><?php esc_html_e( 'Our Art Gallery', 'art-prints-theme' ); ?></h1>
    <p><?php esc_html_e( 'Discover our beautiful collection of decorative art prints', 'art-prints-theme' ); ?></p>
  </div>
</div>

<div class="container mt-5 mb-5">
  <div class="art-gallery">
    <!-- Gallery Filter -->
    <div class="gallery-filter mb-4">
      <div class="filter-options">
        <button class="filter-btn active" data-filter="*"><?php esc_html_e( 'All', 'art-prints-theme' ); ?></button>
        <button class="filter-btn" data-filter=".abstract"><?php esc_html_e( 'Abstract', 'art-prints-theme' ); ?></button>
        <button class="filter-btn" data-filter=".landscape"><?php esc_html_e( 'Landscape', 'art-prints-theme' ); ?></button>
        <button class="filter-btn" data-filter=".portrait"><?php esc_html_e( 'Portrait', 'art-prints-theme' ); ?></button>
      </div>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid">
      <?php
      $gallery_query = new WP_Query( array(
        'posts_per_page' => 12,
        'post_type'      => 'post',
      ) );

      if ( $gallery_query->have_posts() ) :
        while ( $gallery_query->have_posts() ) :
          $gallery_query->the_post();
          ?>
          <div class="gallery-item" data-category="abstract">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="gallery-item-image">
                <?php the_post_thumbnail( 'art-prints-gallery-full' ); ?>
              </div>
            <?php endif; ?>
            <div class="gallery-item-content">
              <h3 class="gallery-item-title"><?php the_title(); ?></h3>
              <p class="gallery-item-description"><?php echo wp_trim_words( get_the_excerpt(), 15 ); ?></p>
              <div class="gallery-item-footer">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">View Details</a>
              </div>
            </div>
          </div>
          <?php
        endwhile;
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
