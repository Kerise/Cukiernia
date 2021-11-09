<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Classic Bakery
 */

get_header(); ?>

<div id="content">
  <?php
    $hidcatslide = get_theme_mod('classic_bakery_hide_categorysec', '1');
    if( $hidcatslide == ''){
  ?>
    <section id="catsliderarea">
      <div class="catwrapslider">
        <div class="owl-carousel">
          <?php if( get_theme_mod('classic_bakery_slidersection',false) ) { ?>
          <?php $queryvar = new WP_Query('cat='.esc_attr(get_theme_mod('classic_bakery_slidersection',true)));
            while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>
              <div class="slidesection"> 
                <?php esc_url(the_post_thumbnail( 'full' )); ?>
                <div class="slider-box text-center">
                  <h3><?php the_title(); ?></h3>
                  <?php
                    $trimexcerpt = get_the_excerpt();
                    $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = 15 );
                    echo '<p class="mt-4">' . esc_html( $shortexcerpt ) . '</p>'; 
                  ?>
                  <?php if ( get_theme_mod('classic_bakery_button_text',true) != "") { ?>
                    <div class="rsvp_button mt-0 mt-md-5">
                      <div class="rsvp_inner d-inline-block"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('classic_bakery_button_text',__('Shop Now','classic-bakery'))); ?></a></div>
                    </div>
                  <?php }?>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } ?>
        </div>
      </div>
    </section>
  <?php } ?>

  <section id="product_cat_slider">
    <div class="container">
      <div class="owl-carousel">
        <?php if(class_exists('woocommerce')){ ?>
          <?php
            $prod_categories = get_terms( 'product_cat', array(
              'number'     => get_theme_mod('classic_bakery_product_category_number'),
              'orderby'    => 'name',
              'order'      => 'ASC',
              'hide_empty' => 0
            ));
            foreach( $prod_categories as $prod_cat ) :
              $cat_thumb_id = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
              $cat_thumb_url = wp_get_attachment_thumb_url( $cat_thumb_id );
              $term_link = get_term_link( $prod_cat, 'product_cat' );
            ?>
            <div class="product_cat_box text-center py-5 px-3">
              <a href="<?php echo esc_url($term_link); ?>"><img src="<?php echo esc_url($cat_thumb_url); ?>" alt="<?php echo esc_html($prod_cat->name); ?>" /></a>
              <a href="<?php echo esc_url($term_link); ?>"><h3 class="pt-3"><?php echo esc_html($prod_cat->name); ?></h3></a>
            </div>
          <?php endforeach; wp_reset_query(); ?>
        <?php }?>
      </div>
    </div>
  </section>

  <section class="py-4">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  <section>
</div>

<?php get_footer(); ?>