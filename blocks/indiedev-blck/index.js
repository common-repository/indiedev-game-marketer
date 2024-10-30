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

	// Access PHP variables from indiedev-blck.php, in this file use indieDevGameMarketerBlockScript.pluginsUrl

	var iconGameCompanyEl = wp.element.createElement('svg', { width: 20, height: 20 },
	  wp.element.createElement('path', { d: "M11,4V2c0-1-1-1-1-1H5.0497c0,0-1.1039,0.0015-1.0497,1v2H2c0,0-1,0-1,1v7c0,1,1,1,1,1h11c0,0,1,0,1-1V5c0-1-1-1-1-1H11z M5.5,2.5h4V4h-4V2.5z" } )
	);

	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	registerBlockType( 'indiedev-game-marketer/indiedev-blck', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __( 'Game Company Info', 'indiedev-game-marketer' ),
		icon: iconGameCompanyEl,
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
			display: {
				type: 'string',
				default: 'company',
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
			var display = props.attributes.display;
			var label = props.attributes.label;
			
			return [ 
					wp.element.createElement(wp.components.SelectControl, {
						value: props.attributes.display,
						label: __('Game company information to display', 'indiedev-game-marketer') + ':',
						onChange: function onChangeDisplay( newDisplay ) {
						    props.setAttributes( { display: newDisplay } );
						},			
						options: [
							{value: 'company', label: __('Full company information', 'indiedev-game-marketer')},
							{value: 'name', label: __('Company name', 'indiedev-game-marketer')},
							{value: 'description', label: __('Company description', 'indiedev-game-marketer')},
							{value: 'roles', label: __('Company primary & secondary business activity', 'indiedev-game-marketer')},
							{value: 'email', label: __('Company main press email address', 'indiedev-game-marketer')},
							{value: 'website', label: __('Company website', 'indiedev-game-marketer')},
							{value: 'facebook', label: __('Company Facebook link', 'indiedev-game-marketer')},
							{value: 'twitter', label: __('Company Twitter link', 'indiedev-game-marketer')},
							{value: 'youtube', label: __('Company YouTube link', 'indiedev-game-marketer')},
							{value: 'phone', label: __('Company PR phone number', 'indiedev-game-marketer')},
						]
					}),
	   				wp.element.createElement( wp.components.ToggleControl, {
						label: __('Hide prefix labels for company information', 'indiedev-game-marketer'),
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
