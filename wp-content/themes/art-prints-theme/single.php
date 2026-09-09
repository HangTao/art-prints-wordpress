<?php
/**
 * Single post template
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
        while ( have_posts() ) :
          the_post();
          ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="post-thumbnail">
                <?php the_post_thumbnail( 'art-prints-featured' ); ?>
              </div>
            <?php endif; ?>

            <header class="entry-header mb-3">
              <h1 class="post-title"><?php the_title(); ?></h1>
              <div class="post-meta">
                <span class="post-date">Published on <?php echo get_the_date(); ?></span>
                <span class="post-author"> by <?php the_author_posts_link(); ?></span>
                <span class="post-category">in <?php the_category( ', ' ); ?></span>
              </div>
            </header>

            <div class="post-content">
              <?php the_content(); ?>
            </div>

            <footer class="entry-footer mt-4 pt-4 border-top">
              <div class="post-tags">
                <?php
                if ( get_the_tags() ) :
                  echo '<strong>Tags:</strong> ';
                  the_tags( '', ', ' );
                endif;
                ?>
              </div>
            </footer>
          </article>

          <!-- Related Posts -->
          <?php
          $related_posts = new WP_Query( array(
            'posts_per_page' => 3,
            'orderby'        => 'rand',
            'post__not_in'   => array( get_the_ID() ),
            'tax_query'      => array(
              array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => wp_get_post_categories( get_the_ID() ),
              ),
            ),
          ) );

          if ( $related_posts->have_posts() ) :
            ?>
            <div class="related-posts mt-5">
              <h3><?php esc_html_e( 'Related Posts', 'art-prints-theme' ); ?></h3>
              <div class="gallery-grid">
                <?php
                while ( $related_posts->have_posts() ) :
                  $related_posts->the_post();
                  ?>
                  <div class="gallery-item">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <div class="gallery-item-image">
                        <?php the_post_thumbnail( 'art-prints-gallery-full' ); ?>
                      </div>
                    <?php endif; ?>
                    <div class="gallery-item-content">
                      <h4 class="gallery-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                  </div>
                  <?php
                endwhile;
                ?>
              </div>
            </div>
            <?php
          endif;
          wp_reset_postdata();
        endwhile;
        ?>
      </div>
    </div>

    <div class="col-lg-3">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
