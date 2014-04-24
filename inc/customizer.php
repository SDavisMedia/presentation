<?php
/**
 * Theme Customizer
 */
function presentation_customize_register( $wp_customize ) {
	
	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class presentation_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
		<?php }
	}
	

	/** ===============
	 * Site Title (Logo) & Tagline
	 */
	// section adjustments
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'presentation' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	
	//site title
	$wp_customize->get_control( 'blogname' )->priority = 10;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	
	// tagline
	$wp_customize->get_control( 'blogdescription' )->priority = 30;
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	// logo uploader
	$wp_customize->add_setting( 'presentation_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'presentation_logo', array(
		'label'		=> __( 'Custom Site Logo (replaces title)', 'presentation' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'presentation_logo',
		'priority'	=> 20
	) ) );


	/** ===============
	 * Presentation Design Options
	 */
	$wp_customize->add_section( 'presentation_style_section', array(
    	'title'       	=> __( 'Design Options', 'presentation' ),
		'description' 	=> __( 'Choose a color scheme for Presentation. Individual styles can be overwritten in your child theme stylesheet.', 'presentation' ),
		'priority'   	=> 25,
	) );
	$wp_customize->add_setting( 'presentation_stylesheet', array( 
		'default' => 'blue', 
		'sanitize_callback' => 'presentation_sanitize_stylesheet' 
	) );
	$wp_customize->add_control( 'presentation_stylesheet', array(
		'type' => 'select',
		'label' => __( 'Choose a color scheme:', 'presentation' ),
		'section' => 'presentation_style_section',
		'choices' => array(
			'blue'		=> 'Blue',
			'turquoise'	=> 'Turquoise',
			'purple'	=> 'Purple',
			'midnight'	=> 'Midnight',
			'orange'	=> 'Orange',
			'red'		=> 'Red',
			'gray'		=> 'Gray'
	) ) );	


	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'presentation_content_section', array(
    	'title'       	=> __( 'Content Options', 'presentation' ),
		'description' 	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'presentation' ),
		'priority'   	=> 20,
	) );
	// post content
	$wp_customize->add_setting( 'presentation_post_content', array( 
		'default' => 'full_content',
		'sanitize_callback' => 'presentation_sanitize_radio'  
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'presentation_post_content', array(
		'label'		=> __( 'Post Feed Content', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'settings'	=> 'presentation_post_content',
		'priority'	=> 10,
		'type'      => 'radio',
		'choices'   => array(
			'excerpt'		=> 'Excerpt',
			'full_content'	=> 'Full Content'
		),
	) ) );
	// read more link
	$wp_customize->get_setting( 'presentation_read_more' )->transport = 'postMessage';
	$wp_customize->add_setting( 'presentation_read_more', array( 
		'default' => __( 'Read More &rarr;', 'presentation' ),
		'sanitize_callback' => 'presentation_sanitize_text' 
	) );		
	$wp_customize->add_control( 'presentation_read_more', array(
	    'label' 	=> __( 'Excerpt & More Link Text', 'presentation' ),
	    'section' 	=> 'presentation_content_section',
		'settings' 	=> 'presentation_read_more',
		'priority'	=> 20,
	) );
	// show featured images on feed?
	$wp_customize->add_setting( 'presentation_featured_image', array( 
		'default' => 1,
		'sanitize_callback' => 'presentation_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'presentation_featured_image', array(
		'label'		=> __( 'Show Featured Images in post listings?', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'priority'	=> 30,
		'type'      => 'checkbox',
	) );
	// show featured images on posts?
	$wp_customize->add_setting( 'presentation_single_featured_image', array( 
		'default' => 1,
		'sanitize_callback' => 'presentation_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'presentation_single_featured_image', array(
		'label'		=> __( 'Show Featured Images on Single Posts?', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'priority'	=> 40,
		'type'      => 'checkbox',
	) );
	// show single post footer?
	$wp_customize->add_setting( 'presentation_post_footer', array( 
		'default' => 1,
		'sanitize_callback' => 'presentation_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'presentation_post_footer', array(
		'label'		=> __( 'Show Post Footer on Single Posts?', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'priority'	=> 50,
		'type'      => 'checkbox',
	) );
	// comments on pages?
	$wp_customize->add_setting( 'presentation_page_comments', array( 
		'default' => 0,
		'sanitize_callback' => 'presentation_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'presentation_page_comments', array(
		'label'		=> __( 'Display Comments on Standard Pages?', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'priority'	=> 60,
		'type'      => 'checkbox',
	) );
	// credits & copyright
	$wp_customize->get_setting( 'presentation_credits_copyright' )->transport = 'postMessage';
	$wp_customize->add_setting( 'presentation_credits_copyright', array( 
		'default' => null,
		'sanitize_callback' => 'presentation_sanitize_text' 
	) );
	$wp_customize->add_control( 'presentation_credits_copyright', array(
		'label'		=> __( 'Footer Credits & Copyright', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'settings'	=> 'presentation_credits_copyright',
		'priority'	=> 70,
	) );
	// twitter url
	$wp_customize->add_setting( 'presentation_twitter', array( 
		'default' => null,
		'sanitize_callback' => 'presentation_sanitize_text' 
	) );
	$wp_customize->add_control( 'presentation_twitter', array(
		'label'		=> __( 'Twitter Profile URL', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'settings'	=> 'presentation_twitter',
		'priority'	=> 80,
	) );
	// facebook url
	$wp_customize->add_setting( 'presentation_facebook', array( 
		'default' => null,
		'sanitize_callback' => 'presentation_sanitize_text' 
	) );
	$wp_customize->add_control( 'presentation_facebook', array(
		'label'		=> __( 'Facebook Profile URL', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'settings'	=> 'presentation_facebook',
		'priority'	=> 90,
	) );
	// google plus url
	$wp_customize->add_setting( 'presentation_gplus', array( 
		'default' => null,
		'sanitize_callback' => 'presentation_sanitize_text' 
	) );
	$wp_customize->add_control( 'presentation_gplus', array(
		'label'		=> __( 'Google Plus Profile URL', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'settings'	=> 'presentation_gplus',
		'priority'	=> 100,
	) );
	// linkedin url
	$wp_customize->add_setting( 'presentation_linkedin', array( 
		'default' => null,
		'sanitize_callback' => 'presentation_sanitize_text' 
	) );
	$wp_customize->add_control( 'presentation_linkedin', array(
		'label'		=> __( 'LinkedIn Profile URL', 'presentation' ),
		'section'	=> 'presentation_content_section',
		'settings'	=> 'presentation_linkedin',
		'priority'	=> 110,
	) );
	

	/** ===============
	 * bbPress Options
	 */
	// only if bbPress is activated
	if ( class_exists( 'bbPress' ) ) {
		$wp_customize->add_section( 'presentation_bbpress_options', array(
	    	'title'       	=> __( 'bbPress Options', 'presentation' ),
			'description' 	=> __( 'These options are specific to all pages that display bbPress forums and its components.', 'presentation' ),
			'priority'   	=> 25,
		) );
		// full-width forums?
		$wp_customize->add_setting( 'presentation_bbpress_full_width', array( 
			'default' => 1,
			'sanitize_callback' => 'presentation_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'presentation_bbpress_full_width', array(
			'label'		=> __( 'Remove sidebar & display full-width?', 'presentation' ),
			'section'	=> 'presentation_bbpress_options',
			'priority'	=> 10,
			'type'      => 'checkbox',
		) );
	}	
	
	
	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$wp_customize->add_section( 'presentation_edd_options', array(
	    	'title'       	=> __( 'Easy Digital Downloads', 'presentation' ),
			'description' 	=> __( 'All other EDD options are under Dashboard => Downloads. If you deactivate EDD, these options will no longer appear.', 'presentation' ),
			'priority'   	=> 30,
		) );
		// show comments on downloads?
		$wp_customize->add_setting( 'presentation_download_comments', array( 
			'default' => 0,
			'sanitize_callback' => 'presentation_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'presentation_download_comments', array(
			'label'		=> __( 'Comments on Downloads?', 'presentation' ),
			'section'	=> 'presentation_edd_options',
			'priority'	=> 10,
			'type'      => 'checkbox',
		) );
		// store front/downloads archive headline
		$wp_customize->get_setting( 'presentation_edd_store_archives_title' )->transport = 'postMessage';
		$wp_customize->add_setting( 'presentation_edd_store_archives_title', array( 
			'default' => null,
			'sanitize_callback' => 'presentation_sanitize_text' 
		) );
		$wp_customize->add_control( 'presentation_edd_store_archives_title', array(
			'label'		=> __( 'Store Front Main Title', 'presentation' ),
			'section'	=> 'presentation_edd_options',
			'settings'	=> 'presentation_edd_store_archives_title',
			'priority'	=> 20,
		) );
		// store front/downloads archive description
		$wp_customize->add_setting( 'presentation_edd_store_archives_description', array( 'default' => null ) );
		$wp_customize->add_control( new presentation_customize_textarea_control( $wp_customize, 'presentation_edd_store_archives_description', array(
			'label'		=> __( 'Store Front Description', 'presentation' ),
			'section'	=> 'presentation_edd_options',
			'settings'	=> 'presentation_edd_store_archives_description',
			'priority'	=> 30,
		) ) );
		// hide download description (excerpt)?
		$wp_customize->add_setting( 'presentation_download_description', array(
			'default' => 0,
			'sanitize_callback' => 'presentation_sanitize_checkbox'  
		) );
		$wp_customize->add_control( 'presentation_download_description', array(
			'label'		=> __( 'Hide Download Description', 'presentation' ),
			'section'	=> 'presentation_edd_options',
			'priority'	=> 40,
			'type'      => 'checkbox',
		) );
		//  view details link
		$wp_customize->get_setting( 'presentation_product_view_details' )->transport = 'postMessage';
		$wp_customize->add_setting( 'presentation_product_view_details', array( 
			'default' => __( 'View Details', 'presentation' ),
			'sanitize_callback' => 'presentation_sanitize_text' 
		) );
		$wp_customize->add_control( 'presentation_product_view_details', array(
		    'label' 	=> __( 'Store Item Link Text', 'presentation' ),
		    'section' 	=> 'presentation_edd_options',
			'settings' 	=> 'presentation_product_view_details',
			'priority'	=> 50,
		) );
		// store front/archive item count
		$wp_customize->add_setting( 'presentation_store_front_count', array( 'default' => 9 ) );		
		$wp_customize->add_control( 'presentation_store_front_count', array(
		    'label' 	=> __( 'Store Front Item Count', 'presentation' ),
		    'section' 	=> 'presentation_edd_options',
			'settings' 	=> 'presentation_store_front_count',
			'priority'	=> 60,
		) );
	}
	

	/** ===============
	 * Navigation Menu(s)
	 */
	// section adjustments
	$wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu(s)', 'presentation' );
	$wp_customize->get_section( 'nav' )->priority = 40;
	
	

	/** ===============
	 * Static Front Page
	 */
	// section adjustments
	$wp_customize->get_section( 'static_front_page' )->priority = 50;
}
add_action( 'customize_register', 'presentation_customize_register' );


/** ===============
 * Sanitize the theme design select option
 */
function presentation_sanitize_stylesheet( $input ) {
    $valid = array(
		'blue'		=> 'Blue',
		'turquoise'	=> 'Turquoise',
		'purple'	=> 'Purple',
		'midnight'	=> 'Midnight',
		'orange'	=> 'Orange',
		'red'		=> 'Red',
		'gray'		=> 'Gray'
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/** ===============
 * Sanitize checkbox options
 */
function presentation_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}


/** ===============
 * Sanitize radio options
 */
function presentation_sanitize_radio( $input ) {
    $valid = array(
		'excerpt'		=> 'Excerpt',
		'full_content'	=> 'Full Content'
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/** ===============
 * Sanitize text input
 */
function presentation_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}


/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function presentation_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		#customize-controls #customize-theme-controls .description { display: block; color: #999; margin: 2px 0 15px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-presentation_read_more { margin-bottom: 30px; }
		#customize-control-presentation_store_front_count input { width: 50px; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'presentation_customizer_styles');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function presentation_customize_preview_js() {
	wp_enqueue_script( 'presentation_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'presentation_customize_preview_js' );
