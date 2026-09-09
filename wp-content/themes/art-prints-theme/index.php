<?php
/**
 * Main template file
 * Display posts and archive content
 *
 * @package Art_Prints_Theme
 */

get_header();
?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-lg-9">
      <div class="content-primary">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post mb-4' ); ?>>
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                  <?php the_post_thumbnail( 'art-prints-featured' ); ?>
                </div>
              <?php endif; ?>

              <header class="entry-header">
                <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-meta">
                  <span class="post-date">Published on <?php echo get_the_date(); ?></span>
                  <span class="post-author"> by <?php the_author(); ?></span>
                  <span class="post-category">in <?php the_category( ', ' ); ?></span>
                </div>
              </header>

              <div class="post-content">
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-2">Read More</a>
              </div>
            </article>
            <?php
          endwhile;

          // Pagination
          echo '<div class="pagination mt-4 mb-4">';
          the_posts_pagination( array(
            'mid_size' => 2,
            'prev_text' => __( '&larr; Previous', 'art-prints-theme' ),
            'next_text' => __( 'Next &rarr;', 'art-prints-theme' ),
          ) );
          echo '</div>';

        else :
          ?>
          <div class="alert alert-info">
            <p><?php esc_html_e( 'No posts found.', 'art-prints-theme' ); ?></p>
          </div>
          <?php
        endif;
        ?>
      </div>
    </div>

    <div class="col-lg-3">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
