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

		/**
		 * Freemius setup
		 *
		 * @since 1.0.0
		 *
		 * @return \Freemius
		 */
		function ingot_give_fs() {
			global $ingot_give_fs;

			if ( ! isset( $ingot_give_fs ) ) {
				$ingot_give_fs = fs_dynamic_init( [
					'id'             => '225',
					'slug'           => 'ingotgive',
					'public_key'     => 'pk_24d588a393396695fcbc003bb5d30',
					'is_premium'     => true,
					'has_paid_plans' => true,
					'parent'         => [
						'id'         => '210',
						'slug'       => 'ingot',
						'public_key' => 'pk_e6a19a3508bdb9bdc91a7182c8e0c',
						'name'       => 'Ingot',
					]
				] );
			}

			return $ingot_give_fs;
		}

		/**
		 * Boot Freemius integration
		 */
		add_action( 'ingot_loaded', 'ingot_give_fs', 25 );

		add_action( 'ingot_loaded', function () {
			if ( ingot_is_give_active() ) {
				new add_destinations();
				new tracking();
			}
		}, 26 );

	}

});
