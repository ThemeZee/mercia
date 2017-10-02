/**
 * Customizer Controls JS
 *
 * Adds Javascript for Customizer Controls.
 *
 * @package Mercia
 */

( function( wp, $ ) {

	// Based on https://make.xwp.co/2016/07/24/dependently-contextual-customizer-controls/
	wp.customize( 'mercia_theme_options[blog_content]', function( setting ) {
		var setupControl = function( control ) {
			var setActiveState, isDisplayed;
			isDisplayed = function() {
				return 'excerpt' === setting.get();
			};
			setActiveState = function() {
				control.active.set( isDisplayed() );
			};
			setActiveState();
			setting.bind( setActiveState );
			control.active.validate = isDisplayed;
		};
		wp.customize.control( 'mercia_theme_options[excerpt_length]', setupControl );
	} );

})( this.wp, jQuery );
