<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package indiedev-game-marketer
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function indiedev_blck_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'indiedev-blck/index.js';
	wp_register_script(
		'indiedev-blck-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor',
			'wp-components',
		),
		filemtime( "$dir/$index_js" )
	);
	wp_localize_script('indiedev-blck-block-editor', 'indieDevGameMarketerBlockScript', array(
    	'pluginsUrl' => plugins_url(),
	));

	$editor_css = 'indiedev-blck/editor.css';
	wp_register_style(
		'indiedev-blck-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'indiedev-blck/style.css';
	wp_register_style(
		'indiedev-blck-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'indiedev-game-marketer/indiedev-blck', array(
		'editor_script' => 'indiedev-blck-block-editor',
		'editor_style'  => 'indiedev-blck-block-editor',
		'style'         => 'indiedev-blck-block',
		'render_callback' => 'indiedev_game_marketer_block_handler',
		'attributes' => [
			'display' => [
				'type' => 'string',
				'default' => 'company'
			],
			'label' => [
				'type' => 'boolean',
				'default' => false
			]
			
		]	
	) );
}
add_action( 'init', 'indiedev_blck_block_init' );

function indiedev_game_marketer_block_handler($atts) {
	return do_shortcode("[indiedev display={$atts['display']} label={$atts['label']}]");
}
