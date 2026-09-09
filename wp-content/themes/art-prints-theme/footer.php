<?php
/**
 * Footer template
 *
 * @package Art_Prints_Theme
 */
?>

  </main><!-- #main -->

  <footer class="site-footer">
    <div class="container">
      <div class="footer-content">
        <?php
        if ( is_active_sidebar( 'footer-widgets' ) ) {
          dynamic_sidebar( 'footer-widgets' );
        } else {
          ?>
          <div class="footer-widget">
            <h4><?php esc_html_e( 'About Our Gallery', 'art-prints-theme' ); ?></h4>
            <p><?php esc_html_e( 'Discover beautiful, unique decorative art prints perfect for any home or office.', 'art-prints-theme' ); ?></p>
          </div>
          <div class="footer-widget">
            <h4><?php esc_html_e( 'Quick Links', 'art-prints-theme' ); ?></h4>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/shop' ) ); ?>"><?php esc_html_e( 'Shop', 'art-prints-theme' ); ?></a></li>
              <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'art-prints-theme' ); ?></a></li>
              <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'art-prints-theme' ); ?></a></li>
            </ul>
          </div>
          <div class="footer-widget">
            <h4><?php esc_html_e( 'Customer Service', 'art-prints-theme' ); ?></h4>
            <ul>
              <li><a href="<?php echo esc_url( home_url( '/shipping' ) ); ?>"><?php esc_html_e( 'Shipping Info', 'art-prints-theme' ); ?></a></li>
              <li><a href="<?php echo esc_url( home_url( '/returns' ) ); ?>"><?php esc_html_e( 'Returns', 'art-prints-theme' ); ?></a></li>
              <li><a href="<?php echo esc_url( home_url( '/faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'art-prints-theme' ); ?></a></li>
            </ul>
          </div>
          <?php
        }
        ?>
      </div>

      <div class="footer-bottom">
        <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'art-prints-theme' ); ?></p>
        <p><?php printf( esc_html__( 'Proudly powered by %s', 'art-prints-theme' ), '<a href="https://wordpress.org" target="_blank">WordPress</a>' ); ?></p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
