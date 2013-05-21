<?php
/**
 * Implements a custom header for Twenty Thirteen.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses twentythirteen_header_style() to style front-end.
 * @uses twentythirteen_admin_header_style() to style wp-admin form.
 * @uses twentythirteen_admin_header_image() to add custom markup to wp-admin form.
 * @uses register_default_headers() to set up the bundled header images.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '220e10',
		'default-image'          => '%s/images/headers/circle.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 230,
		'width'                  => 1600,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'twentythirteen_header_style',
		'admin-head-callback'    => 'twentythirteen_admin_header_style',
		'admin-preview-callback' => 'twentythirteen_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'header1' => array(
			'url'           => '%s/images/headers/header1.jpg',
			'thumbnail_url' => '%s/images/headers/header1-thumbnail.jpg',
			'description'   => _x( 'Header1', 'header image description', 'twentythirteen' )
		),
        'header2' => array(
            'url'           => '%s/images/headers/header2.jpg',
            'thumbnail_url' => '%s/images/headers/header2-thumbnail.jpg',
            'description'   => _x( 'Header2', 'header image description', 'twentythirteen' )
        ),
        'header3' => array(
            'url'           => '%s/images/headers/header3.jpg',
            'thumbnail_url' => '%s/images/headers/header3-thumbnail.jpg',
            'description'   => _x( 'Header3', 'header image description', 'twentythirteen' )
        ),
        'header4' => array(
            'url'           => '%s/images/headers/header4.jpg',
            'thumbnail_url' => '%s/images/headers/header5-thumbnail.jpg',
            'description'   => _x( 'Header4', 'header image description', 'twentythirteen' )
        ),
        'header5' => array(
            'url'           => '%s/images/headers/header5.jpg',
            'thumbnail_url' => '%s/images/headers/header5-thumbnail.jpg',
            'description'   => _x( 'Header5', 'header image description', 'twentythirteen' )
        ),
        'header6' => array(
            'url'           => '%s/images/headers/header6.jpg',
            'thumbnail_url' => '%s/images/headers/header6-thumbnail.jpg',
            'description'   => _x( 'Header6', 'header image description', 'twentythirteen' )
        ),
        'header7' => array(
            'url'           => '%s/images/headers/header7.jpg',
            'thumbnail_url' => '%s/images/headers/header7-thumbnail.jpg',
            'description'   => _x( 'Header7', 'header image description', 'twentythirteen' )
        ),
        'header8' => array(
            'url'           => '%s/images/headers/header8.jpg',
            'thumbnail_url' => '%s/images/headers/header8-thumbnail.jpg',
            'description'   => _x( 'Header8', 'header image description', 'twentythirteen' )
        ),
        'header9' => array(
            'url'           => '%s/images/headers/header9.jpg',
            'thumbnail_url' => '%s/images/headers/header9-thumbnail.jpg',
            'description'   => _x( 'Header9', 'header image description', 'twentythirteen' )
        ),

	) );

	add_action( 'admin_print_styles-appearance_page_custom-header', 'twentythirteen_fonts' );
}
add_action( 'after_setup_theme', 'twentythirteen_custom_header_setup' );

/**
 * Styles the header text displayed on the blog.
 *
 * get_header_textcolor() options: Hide text (returns 'blank'), or any hex value.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css">
	<?php
		if ( ! empty( $header_image ) ) :
	?>
		.site-header {
			background: url(<?php header_image(); ?>) no-repeat scroll top;
			background-size: 1600px auto;
		}
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
			if ( empty( $header_image ) ) :
	?>
		.site-header hgroup {
			min-height: 0;
		}
	<?php
			endif;

		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title,
		.site-description {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_admin_header_style() {
	$header_image = get_header_image();
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url(' . esc_url( $header_image ) . ') no-repeat scroll top; background-size: 1600px auto;';
		} ?>
		padding: 0 20px;
	}
	#headimg .hgroup {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $header_image ) || display_header_text() ) {
			echo 'min-height: 230px;';
		} ?>
		width: 100%;
	}
	<?php if ( ! display_header_text() ) : ?>
	#headimg h1,
	#headimg h2 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php endif; ?>
	#headimg h1 {
		font: bold 60px/1 Bitter, Georgia, serif;
		margin: 0;
		padding: 58px 0 10px;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h1 a:hover {
		text-decoration: underline;
	}
	#headimg h2 {
		font: 200 italic 24px "Source Sans Pro", Helvetica, sans-serif;
		margin: 0;
		text-shadow: none;
	}
	.default-header img {
		max-width: 230px;
		width: auto;
	}
	</style>
<?php
}

/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_admin_header_image() {
	?>
	<div id="headimg" style="background: url(<?php header_image(); ?>) no-repeat scroll top; background-size: 1600px auto;">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="hgroup">
			<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="#"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php }
