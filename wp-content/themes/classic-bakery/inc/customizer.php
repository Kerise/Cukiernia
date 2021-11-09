<?php
/**
 * Classic Bakery Theme Customizer
 *
 * @package Classic Bakery
 */

get_template_part('/inc/select/category-dropdown-custom-control');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function classic_bakery_customize_register( $wp_customize ) {

	function classic_bakery_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function classic_bakery_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	//Theme Options
	$wp_customize->add_panel( 'classic_bakery_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'classic-bakery' ),
	) );

	// Header Section
	$wp_customize->add_section('classic_bakery_header_section', array(
        'title' => __('Manage Header Section', 'classic-bakery'),
        'priority' => null,
		'panel' => 'classic_bakery_panel_area',
 	));

	$wp_customize->add_setting('classic_bakery_preloader',array(
		'default' => true,
		'sanitize_callback' => 'classic_bakery_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'classic_bakery_preloader', array(
	   'section'   => 'classic_bakery_header_section',
	   'label'	=> __('Check to remove preloader','classic-bakery'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_bakery_shop_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_shop_text', array(
	   'settings' => 'classic_bakery_shop_text',
	   'section'   => 'classic_bakery_header_section',
	   'label' => __('Button Text', 'classic-bakery'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_bakery_shop_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_shop_link', array(
	   'settings' => 'classic_bakery_shop_link',
	   'section'   => 'classic_bakery_header_section',
	   'label' => __('Button Link', 'classic-bakery'),
	   'type'      => 'url'
	));

	// Social media Section
	$wp_customize->add_section('classic_bakery_links_section', array(
        'title' => __('Social media Section', 'classic-bakery'),
        'priority' => null,
		'panel' => 'classic_bakery_panel_area',
 	));

	$wp_customize->add_setting('classic_bakery_fb_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_fb_link', array(
	   'settings' => 'classic_bakery_fb_link',
	   'section'   => 'classic_bakery_links_section',
	   'label' => __('Facebook Link', 'classic-bakery'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_bakery_twitt_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_twitt_link', array(
	   'settings' => 'classic_bakery_twitt_link',
	   'section'   => 'classic_bakery_links_section',
	   'label' => __('Twitter Link', 'classic-bakery'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_bakery_linked_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_linked_link', array(
	   'settings' => 'classic_bakery_linked_link',
	   'section'   => 'classic_bakery_links_section',
	   'label' => __('Linkdin Link', 'classic-bakery'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_bakery_insta_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_insta_link', array(
	   'settings' => 'classic_bakery_insta_link',
	   'section'   => 'classic_bakery_links_section',
	   'label' => __('Instagram Link', 'classic-bakery'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_bakery_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_youtube_link', array(
	   'settings' => 'classic_bakery_youtube_link',
	   'section'   => 'classic_bakery_links_section',
	   'label' => __('Youtube Link', 'classic-bakery'),
	   'type'      => 'url'
	));

	// Home Category Dropdown Section
	$wp_customize->add_section('classic_bakery_one_cols_section',array(
		'title'	=> __('Manage Slider','classic-bakery'),
		'description'	=> __('Select Category from the Dropdowns for slider, Also use the given image dimension (1200 x 450).','classic-bakery'),
		'priority'	=> null,
		'panel' => 'classic_bakery_panel_area'
	));

	$wp_customize->add_setting( 'classic_bakery_slidersection', array(
		'default'	=> '0',	
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( new Classic_Bakery_Category_Dropdown_Custom_Control( $wp_customize, 'classic_bakery_slidersection', array(
		'section' => 'classic_bakery_one_cols_section',
		'label' => __('Select the post category to show slider', 'classic-bakery'),
		'settings'   => 'classic_bakery_slidersection',
	) ) );

	$wp_customize->add_setting('classic_bakery_button_text',array(
		'default' => 'Shop Now',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_button_text', array(
	   'settings' => 'classic_bakery_button_text',
	   'section'   => 'classic_bakery_one_cols_section',
	   'label' => __('Add Button Text', 'classic-bakery'),
	   'type'      => 'text'
	));
	
	$wp_customize->add_setting('classic_bakery_hide_categorysec',array(
		'default' => true,
		'sanitize_callback' => 'classic_bakery_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_bakery_hide_categorysec', array(
	   'settings' => 'classic_bakery_hide_categorysec',
	   'section'   => 'classic_bakery_one_cols_section',
	   'label'     => __('Uncheck To Enable This Section','classic-bakery'),
	   'type'      => 'checkbox'
	));

	// Footer Section 
	$wp_customize->add_section('classic_bakery_footer', array(
		'title'	=> __('Manage Footer Section','classic-bakery'),
		'priority'	=> null,
		'panel' => 'classic_bakery_panel_area',
	));

	$wp_customize->add_setting('classic_bakery_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_bakery_copyright_line', array(
	   'section' 	=> 'classic_bakery_footer',
	   'label'	 	=> __('Copyright Line','classic-bakery'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	// Color
    $wp_customize->add_setting('classic_bakery_color_scheme_one',array(
		'default' => '#ff819f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
    $wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'classic_bakery_color_scheme_one', 
	    array(
	        'label'      => __( 'Color Scheme', 'classic-bakery' ),
	        'section'    => 'colors',
	        'settings'   => 'classic_bakery_color_scheme_one',
	    ) ) 
	);

    // Google Fonts
    $wp_customize->add_section( 'classic_bakery_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'classic-bakery' ),
		'priority'       => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'classic_bakery_headings_fonts', array(
		'sanitize_callback' => 'classic_bakery_sanitize_fonts',
	));
	$wp_customize->add_control( 'classic_bakery_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'classic-bakery'),
		'section' => 'classic_bakery_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'classic_bakery_body_fonts', array(
		'sanitize_callback' => 'classic_bakery_sanitize_fonts'
	));
	$wp_customize->add_control( 'classic_bakery_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'classic-bakery' ),
		'section' => 'classic_bakery_google_fonts_section',
		'choices' => $font_choices
	));
}
add_action( 'customize_register', 'classic_bakery_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function classic_bakery_customize_preview_js() {
	wp_enqueue_script( 'classic_bakery_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'classic_bakery_customize_preview_js' );