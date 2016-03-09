<?php
/**
 Plugin Name: Ingot - Give
 Version: 1.0.0
Plugin URI:  http://IngotHQ.com
Description: give for Ingot
Author:      Ingot LLC
Author URI:  http://IngotHQ.com
 */
use ingot\addon\give\add_destinations;
use ingot\addon\give\tracking;

/**
 * Copyright 2016 Ingot LLC
 *
 * Licensed under the terms of the GNU General Public License version 2 or later
 */

/**
 * Make add-on go if not already loaded
 */
add_action( 'ingot_before', function(){
	if( ! defined( 'INGOT_GIVE_VER' ) ) {
		define( 'INGOT_GIVE_VER', '1.0.0' );
		require_once dirname( __FILE__ ) . '/vendor/autoload.php';
		new add_destinations();
		new tracking();
	}

});
