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
function indiedev_gameblck_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'indiedev-gameblck/index.js';
	wp_register_script(
		'indiedev-gameblck-block-editor',
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
	
	$collect_array_string = '['; 
    $game_results = Indiedev_Game_Marketer_Public::get_games('`id`,`name`');
    if(isset($game_results[0])) {
    	foreach($game_results as $game) {
        	$collect_array_string .= "{value: '{$game['id']}', label: '{$game['name']}'},";
		}
	}
	$collect_array_string .= ']';
	
	wp_localize_script('indiedev-gameblck-block-editor', 'indieDevGameMarketerGameBlockScript', array(
    	'gamesArray' => $collect_array_string,
	));

	$editor_css = 'indiedev-gameblck/editor.css';
	wp_register_style(
		'indiedev-gameblck-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'indiedev-gameblck/style.css';
	wp_register_style(
		'indiedev-gameblck-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'indiedev-game-marketer/indiedev-gameblck', array(
		'editor_script' => 'indiedev-gameblck-block-editor',
		'editor_style'  => 'indiedev-gameblck-block-editor',
		'style'         => 'indiedev-gameblck-block',
		'render_callback' => 'indiedev_game_marketer_gameblock_handler',
		'attributes' => [
			'game' => [
				'type' => 'number',
				'default' => '1'
			],		
			'display' => [
				'type' => 'string',
				'default' => 'presskit'
			],
			'label' => [
				'type' => 'boolean',
				'default' => false
			]
			
		]	
	) );
}
add_action( 'init', 'indiedev_gameblck_block_init' );

function indiedev_game_marketer_gameblock_handler($atts) {
	return do_shortcode("[indiedev game={$atts['game']} display={$atts['display']} label={$atts['label']}]");
}
