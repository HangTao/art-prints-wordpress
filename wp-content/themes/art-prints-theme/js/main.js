/**
 * Art Prints Theme - Main JavaScript
 * @version 1.0.0
 */

(function($) {
  'use strict';

  $(document).ready(function() {
    // Initialize theme features
    initGalleryFilter();
    initSmoothScroll();
    initMobileMenu();
  });

  /**
   * Gallery Filter Functionality
   */
  function initGalleryFilter() {
    const filterBtns = $('.filter-btn');
    const galleryItems = $('.gallery-item');

    filterBtns.on('click', function() {
      const filterValue = $(this).attr('data-filter');

      // Update active button
      filterBtns.removeClass('active');
      $(this).addClass('active');

      // Filter gallery items
      if (filterValue === '*') {
        galleryItems.fadeIn(300);
      } else {
        galleryItems.fadeOut(300);
        $(filterValue).fadeIn(300);
      }
    });
  }

  /**
   * Smooth Scroll for Anchor Links
   */
  function initSmoothScroll() {
    $('a[href^="#"]').on('click', function(e) {
      e.preventDefault();
      const target = $(this.getAttribute('href'));
      if (target.length) {
        $('html, body').stop().animate({
          scrollTop: target.offset().top - 100
        }, 1000);
      }
    });
  }

  /**
   * Mobile Menu Toggle
   */
  function initMobileMenu() {
    // Add mobile menu functionality
    const menuToggle = $('.menu-toggle');
    const menu = $('.main-navigation');

    if (menuToggle.length) {
      menuToggle.on('click', function() {
        $(this).toggleClass('active');
        menu.toggleClass('active');
      });
    }
  }

  /**
   * Add to Cart Handler
   */
  $(document).on('click', '.add-to-cart-btn', function(e) {
    e.preventDefault();
    const productId = $(this).attr('data-product-id');
    const quantity = $(this).attr('data-quantity') || 1;

    // AJAX add to cart
    $.ajax({
      type: 'POST',
      url: artPrintsTheme.ajax_url,
      data: {
        action: 'add_to_cart',
        product_id: productId,
        quantity: quantity,
        nonce: artPrintsTheme.nonce
      },
      success: function(response) {
        if (response.success) {
          // Show success message
          showNotification('Product added to cart!', 'success');
        } else {
          showNotification('Error adding product to cart.', 'error');
        }
      }
    });
  });

  /**
   * Show Notification
   */
  function showNotification(message, type) {
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const notification = $('<div class="alert ' + alertClass + ' alert-notification" role="alert">' + message + '</div>');

    $('body').prepend(notification);

    setTimeout(function() {
      notification.fadeOut(function() {
        $(this).remove();
      });
    }, 3000);
  }

  /**
   * Image Lightbox
   */
  $(document).on('click', '.gallery-item-image', function() {
    const imageUrl = $(this).find('img').attr('src');
    const imageAlt = $(this).find('img').attr('alt');

    const lightbox = $('<div class="lightbox">' +
      '<div class="lightbox-content">' +
      '<span class="lightbox-close">&times;</span>' +
      '<img src="' + imageUrl + '" alt="' + imageAlt + '">' +
      '</div>' +
      '</div>');

    $('body').append(lightbox);

    lightbox.fadeIn(300);

    lightbox.on('click', '.lightbox-close', function() {
      lightbox.fadeOut(300, function() {
        $(this).remove();
      });
    });
  });

})(jQuery);
