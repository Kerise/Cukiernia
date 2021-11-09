<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Classic Bakery
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('classic_bakery_preloader',true) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'classic-bakery' ); ?></a>

<div class="row m-0">
  <div class="col-lg-12 col-md-12 bg-color">
    <div class="header">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="logo text-center py-5 py-md-5">
            <?php classic_bakery_the_custom_logo(); ?>
            <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
              <?php $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) : ?>
                <span class="site-description"><?php echo esc_html( $description ); ?></span>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </div>
        <?php if(class_exists('woocommerce')){ ?>
          <div class="col-lg-12 col-md-4 col-12 p-0 search-cart mb-5">
            <?php get_product_search_form(); ?>
            <span class="cartbox text-center">
              <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"><i class="fas fa-shopping-cart"></i></a>
              <span class="cartcount"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
            </span>
          </div>
        <?php }?>
        <div class="col-lg-12 col-md-2 col-6">
          <div class="toggle-nav text-right text-md-right">
            <?php if(has_nav_menu('primary')){ ?>
              <button role="tab"><?php esc_html_e('MENU','classic-bakery'); ?></button>
            <?php }?>
          </div>
        </div>
        <div id="mySidenav" class="nav sidenav text-center">
          <nav id="site-navigation" class="main-nav my-2" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu','classic-bakery' ); ?>">
            <?php if(has_nav_menu('primary')){
              wp_nav_menu( array( 
                'theme_location' => 'primary',
                'container_class' => 'main-menu clearfix' ,
                'menu_class' => 'clearfix',
                'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                'fallback_cb' => 'wp_page_menu',
              ) );
            } ?>
            <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE','classic-bakery'); ?></a>
          </nav>
        </div>
        <?php if ( get_theme_mod('classic_bakery_shop_link') != "" || get_theme_mod('classic_bakery_shop_text') != "") { ?>
        <div class="col-lg-12 col-md-2 col-6 p-0">
          <div class="rsvp_button my-lg-5 my-md-0 text-center">
            <div class="rsvp_inner d-inline-block"><a href="<?php echo esc_url(get_theme_mod( 'classic_bakery_shop_link','') ); ?>"><?php echo esc_html(get_theme_mod( 'classic_bakery_shop_text','') ); ?></a></div>
          </div>
        </div>
        <?php }?>
        <div class="col-lg-12 col-md-4 col-12 social-icons text-center my-3">
          <?php if ( get_theme_mod('classic_bakery_fb_link') != "") { ?>
            <a title="<?php esc_attr('facebook', 'classic-bakery'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_bakery_fb_link')); ?>"><i class="fab fa-facebook-f"></i></a> 
          <?php } ?>
          <?php if ( get_theme_mod('classic_bakery_twitt_link') != "") { ?>
            <a title="<?php esc_attr('twitter', 'classic-bakery'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_bakery_twitt_link')); ?>"><i class="fab fa-twitter"></i></a>
          <?php } ?>
          <?php if ( get_theme_mod('classic_bakery_linked_link') != "") { ?>
            <a title="<?php esc_attr('linkedin', 'classic-bakery'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_bakery_linked_link')); ?>"><i class="fab fa-linkedin-in"></i></a>
          <?php } ?>
          <?php if ( get_theme_mod('classic_bakery_insta_link') != "") { ?>
            <a title="<?php esc_attr('instagram', 'classic-bakery'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_bakery_insta_link')); ?>"><i class="fab fa-instagram"></i></a>
          <?php } ?>
          <?php if ( get_theme_mod('classic_bakery_youtube_link') != "") { ?>
            <a title="<?php esc_attr('youtube', 'classic-bakery'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_bakery_youtube_link')); ?>"><i class="fab fa-youtube"></i></a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="outer-area">
    <div class="scroll-box">