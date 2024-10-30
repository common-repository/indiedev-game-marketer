( function( wp ) {
	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://github.com/WordPress/gutenberg/tree/master/blocks#api
	 */
	var registerBlockType = wp.blocks.registerBlockType;

	/**
	 * Retrieves the translation of text.
	 * @see https://github.com/WordPress/gutenberg/tree/master/i18n#api
	 */
	var __ = wp.i18n.__;

	// Access PHP variables from indiedev-gameblck.php, in this file use indieDevGameMarketerGameBlockScript.gamesArray

	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	
	
	var iconGameEl = wp.element.createElement('svg', { width: 20, height: 20 },
	  wp.element.createElement('path', { d: "M13.1,12.5c-0.6,0.3-1.4,0.1-1.8-0.5l-1.1-1.4H4.8L3.7,12l0,0c-0.5,0.7-1.4,0.8-2.1,0.3c-0.5-0.4-0.7-1-0.6-1.5l0.7-3.7l0,0C1.9,5.9,3,5,4.2,5v0H7V3.5C7,2.7,7.6,2,8.4,2h3.1C11.8,2,12,2.2,12,2.5S11.8,3,11.5,3h-3C8.2,3,8,3.2,8,3.4c0,0,0,0.1,0,0.1V5h2.8v0c1.2,0,2.3,0.9,2.5,2.1l0,0l0.7,3.7l0,0C14.1,11.5,13.8,12.2,13.1,12.5z M6,7.5C6,6.7,5.3,6,4.5,6S3,6.7,3,7.5S3.7,9,4.5,9S6,8.3,6,7.5z M12,7.5C12,7.2,11.8,7,11.5,7H11V6.5C11,6.2,10.8,6,10.5,6S10,6.2,10,6.5V7H9.5C9.2,7,9,7.2,9,7.5S9.2,8,9.5,8H10v0.5C10,8.8,10.2,9,10.5,9S11,8.8,11,8.5V8h0.5C11.8,8,12,7.8,12,7.5z" } )
	);
	
	registerBlockType( 'indiedev-game-marketer/indiedev-gameblck', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'Game Info', 'indiedev-game-marketer' ),
		icon: iconGameEl,
		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'indiedev-game-marketer-blocks',

		/**
		 * Optional block extended support features.
		 */
		supports: {
			// Removes support for an HTML mode.
			html: false,
		},
		attributes: {
			game: {
				type: 'number',
				default: "1",
			},			
			display: {
				type: 'string',
				default: 'presskit',
			},
			label: {
				type: 'boolean',
				default: false,
			}
		},
		
		/**
		 * The edit function describes the structure of your block in the context of the editor.
		 * This represents what the editor will render when the block is used.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#edit
		 *
		 * @param {Object} [props] Properties passed from the editor.
		 * @return {Element}       Element to render.
		 */
		edit: function( props ) {
			
			return [ 
					wp.element.createElement(wp.components.SelectControl, {
						value: props.attributes.game,
						label: __('Select the game', 'indiedev-game-marketer') + ':',
						onChange: function onChangeGame( newGame ) {
						    props.setAttributes( { game: newGame } );
						},			
						options: eval(indieDevGameMarketerGameBlockScript.gamesArray)
						
					}),			
					wp.element.createElement(wp.components.SelectControl, {
						value: props.attributes.display,
						label: __('Select the game information to display', 'indiedev-game-marketer') + ':',
						onChange: function onChangeDisplay( newDisplay ) {
						    props.setAttributes( { display: newDisplay } );
						},			
						options: [
							{value: 'presskit', label: __('Full game presskit', 'indiedev-game-marketer')},
							{value: 'name', label: __('Game\'s Name', 'indiedev-game-marketer')},
							{value: 'icon', label: __('Main Image/Icon', 'indiedev-game-marketer')},
							{value: 'small_desc', label: __('Quick Description', 'indiedev-game-marketer')},
							{value: 'long_desc', label: __('Full Description', 'indiedev-game-marketer')},
							{value: 'genres', label: __('Genres', 'indiedev-game-marketer')},
							{value: 'multiplayer', label: __('Multiplayer Modes', 'indiedev-game-marketer')},
							{value: 'home_url', label: __('Home URL', 'indiedev-game-marketer')},
							{value: 'developers', label: __('Developers', 'indiedev-game-marketer')},
							{value: 'publishers', label: __('Publishers', 'indiedev-game-marketer')},
							{value: 'distributors', label: __('Distributors', 'indiedev-game-marketer')},
							{value: 'producers', label: __('Producers', 'indiedev-game-marketer')},
							{value: 'designers', label: __('Designers', 'indiedev-game-marketer')},
							{value: 'programmers', label: __('Programmers', 'indiedev-game-marketer')},
							{value: 'artists', label: __('Artists', 'indiedev-game-marketer')},
							{value: 'writers', label: __('Writers', 'indiedev-game-marketer')},
							{value: 'composers', label: __('Composers', 'indiedev-game-marketer')},
							{value: 'game_engine', label: __('Game Engine', 'indiedev-game-marketer')},
							{value: 'franchise_series', label: __('Franchise/Series', 'indiedev-game-marketer')},
							{value: 'platform_a', label: __('Platform One', 'indiedev-game-marketer')},
							{value: 'release_date_a', label: __('Release Date on Platform One', 'indiedev-game-marketer')},
							{value: 'platform_b', label: __('Platform Two', 'indiedev-game-marketer')},
							{value: 'release_date_b', label: __('Release Date on Platform Two', 'indiedev-game-marketer')},
							{value: 'platform_c', label: __('Platform Three', 'indiedev-game-marketer')},
							{value: 'release_date_c', label: __('Release Date on Platform Three', 'indiedev-game-marketer')},
							{value: 'platform_d', label: __('Platform Four', 'indiedev-game-marketer')},
							{value: 'release_date_d', label: __('Release Date on Platform Four', 'indiedev-game-marketer')},
							{value: 'platform_e', label: __('Platform Five', 'indiedev-game-marketer')},
							{value: 'release_date_e', label: __('Release Date on Platform Five', 'indiedev-game-marketer')},
							{value: 'platform_f', label: __('Platform Six', 'indiedev-game-marketer')},
							{value: 'release_date_f', label: __('Release Date on Platform Six', 'indiedev-game-marketer')},
							{value: 'platform_g', label: __('Platform Seven', 'indiedev-game-marketer')},
							{value: 'release_date_g', label: __('Release Date on Platform Seven', 'indiedev-game-marketer')},
							{value: 'platform_h', label: __('Platform Eight', 'indiedev-game-marketer')},
							{value: 'release_date_h', label: __('Release Date on Platform Eight', 'indiedev-game-marketer')},
							{value: 'platform_i', label: __('Platform Nine', 'indiedev-game-marketer')},
							{value: 'release_date_i', label: __('Release Date on Platform Nine', 'indiedev-game-marketer')},
							{value: 'platform_j', label: __('Platform Ten', 'indiedev-game-marketer')},
							{value: 'release_date_j', label: __('Release Date on Platform Ten', 'indiedev-game-marketer')},

						]
					}),
	   				wp.element.createElement( wp.components.ToggleControl, {
						label: __('Hide prefix labels for game information', 'indiedev-game-marketer'),
						checked: props.attributes.label,
						onChange: function onChangeLabel( newLabel ) {
						    props.setAttributes( { label: newLabel } );
						},		
					})
				];
		},

		/**
		 * The save function defines the way in which the different attributes should be combined
		 * into the final markup, which is then serialized by Gutenberg into `post_content`.
		 * @see https://wordpress.org/gutenberg/handbook/block-edit-save/#save
		 *
		 * @return {Element}       Element to render.
		 */
		save: function() {
			return null;
		}
	});
} )(
	window.wp
);
