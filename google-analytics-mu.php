<?php
/**
 * @author    WPStore.io <code@wpstore.io>
 * @copyright Copyright (c) 2014, WPStore.io
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPStore\GoogleAnalyticsMU
 * @version   3.0.0
 */
/*
Plugin Name: Google Analytics MU
Plugin URI:  https://wordpress.org/extend/plugins/google-analytics-mu/
Description: Collect network-wide Google Analytics statistics and allow site admins to use their own tracking codes
Version:     3.0.0
Author:      WPStore.io
Author URI:  https://www.wpstore.io
License:     GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: google-analytics-mu
Domain Path: /languages
Network:     true

    Copyright 2012-2013  Foe Services Labs (http://labs.foe-services.de)
    Copyright 2011-2012  Niklas Jonsson  (email : niklas@darturonline.se)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

namespace WPStore;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

require 'libs/autoload.php';

/**
 * @since 3.0.0
 */
class GoogleAnalyticsMU {

	/**
	 * Current version of the plugin.
	 *
	 * @since 0.0.1
	 * @var string
	 */
	public $version = '3.0.0';

	/**
	 * Main File of the plugin.
	 *
	 * @since 0.0.1
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 0.0.1
	 * @static
	 * @var object $_instance
	 */
	protected static $_instance = null;

	/**
	 * Main GoogleAnalyticsMU Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since  0.0.1
	 * @static
	 * @return object Instance
	 */
	public static function get_instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	} // END instance()

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since  0.0.1
	 * @return void
	 */
	public function __construct() {

		register_activation_hook( __FILE__, array( '\\WPStore\\GoogleAnalyticsMU', 'activation' ) );

		// Frontend
		if ( ! is_admin() ) {
			new \WPStore\GoogleAnalyticsMU\Frontend();
		} // END if

		// WP-Admin
		if ( is_admin() ) {
			new \WPStore\GoogleAnalyticsMU\Admin();
		} // END if

		// WP-Admin/Network
		if ( is_network_admin() ) {
			new \WPStore\GoogleAnalyticsMU\Network();
		} // END if

	} // END __construct()

	/** Helper functions ******************************************************/

	/**
	 * Get the plugin version.
	 *
	 * @since  0.0.1
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Get the main plugin file.
	 *
	 * @since  0.0.1
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Pre-Activation checks
	 *
	 * Checks if Google Analyticator is present otherwise prevents activation
	 *
	 * @todo check for GA version >= 7.0.0
	 *
	 * @since  3.0.0
	 * @param  bool $network_wide
	 * @return void
	 */
	public function activation( $network_wide ) {

		$parent = 'google-analyticator/google-analyticator.php';

		if ( is_multisite() && $network_wide ) {

			if ( ! is_plugin_active_for_network( $parent ) ) {

				// More verbose error message
				wp_die( __( 'Google Analyticator needs to be activate network-wide to allow this extension to be activated network-wide too!', 'scroll-depth' ) );

			}

		} else {

			if ( is_plugin_inactive( $parent ) ) { // safe enough? // if ( ! class_exists( 'Google_Analyticator' ) ) {

				// More verbose error message
				wp_die( __( 'Requirements are not met! Download and activate Google Analyticator to use this plugin.', 'scroll-depth' ) );

			}

		}

	} // END activation()

} // END class GoogleAnalyticsMU

/**
 * Returns the main instance
 *
 * @since  0.0.1
 * @return object GoogleAnalyticsMU Instance
 */
function GoogleAnalyticsMU() {
	return \WPStore\GoogleAnalyticsMU::get_instance();
}

GoogleAnalyticsMU();
