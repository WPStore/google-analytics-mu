<?php
/**
 * @author    WPStore.io <code@wpstore.io>
 * @copyright Copyright (c) 2014, WPStore.io
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPStore\GoogleAnalyticsMU
 */

namespace WPStore\GoogleAnalyticsMU;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @since 3.0.0
 */
class Frontend {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 * 
	 * @since  3.0.0
	 * @return void
	 */
	public function __construct() {

//		add_action( 'wp_head', array( $this, 'output_parameters' ) ); // OR hook into a custom action?

	} // END __construct()

	/**
	 * Generated the javascript code controlling the library
	 *
	 * @since  0.0.1
	 * @return string
	 */
	public function output_parameters() {
		
	} // END output_parameters()

	function ga_mu_plugin_add_script_to_head() {

		switch_to_blog('1');
		$uaidsuper = get_option('ga_mu_uaid');
		$maindomain = get_option('ga_mu_maindomain');
				$anonymizeIpNetwork = get_option('ga_mu_anonymizeip_activated');
				$PageSpeedNetwork = get_option('ga_mu_pagespeed_activated');
		$siteSpecificAllowed = get_option('ga_mu_site_specific_allowed');
		restore_current_blog();

		$uaid = get_option('ga_mu_uaid');
		$anonymizeIp = get_option('ga_mu_anonymizeip_activated');
				$PageSpeed = get_option('ga_mu_pagespeed_activated');

		$super = false;
		$user = false;

		if (isset($uaidsuper) && $uaidsuper != '' && $uaidsuper != '0') {
			$super = true;
		}
		if (isset($uaid) && $uaid != '' && $uaid != '0') {
			$user = true;
		}

		if ($super && $user) {
			if ($uaidsuper == $uaid) {
				$user = false;
			}
		}

		if ($user == true && (!isset($siteSpecificAllowed) || $siteSpecificAllowed == '' || $siteSpecificAllowed == '0')) {
			$user = false;
		}

		if ($super || $user)
		{
				$prefix = ''
				?>
		<script type="text/javascript">
		var _gaq = _gaq || [];
		<?php
		if ($super) { ?>
		_gaq.push(['_setAccount', '<?php echo $uaidsuper ?>']);
		<?php
		if ($maindomain)
		{ ?>
		_gaq.push(['_setDomainName', '<?php echo $maindomain ?>']);
		<?php
		} ?>
		_gaq.push(['_trackPageview']);
		<?php
		if (isset($PageSpeedNetwork) && $PageSpeedNetwork != '' && $PageSpeedNetwork != '0')
		{ ?>
		_gaq.push(['_trackPageLoadTime']);
		<?php }
		if (isset($anonymizeIpNetwork) && $anonymizeIpNetwork != '' && $anonymizeIpNetwork != '0')
		{ ?>
		_gaq.push(['_gat._anonymizeIp']);
		<?php } $prefix = 'b.'; }
		if ($user) { ?>
		_gaq.push(['<?php echo $prefix ?>_setAccount', '<?php echo $uaid ?>']);
		_gaq.push(['<?php echo $prefix ?>_trackPageview']);
		<?php
		if (isset($PageSpeed) && $PageSpeed != '' && $PageSpeed != '0')
		{ ?>
			_gaq.push(['<?php echo $prefix ?>_trackPageLoadTime']);
		<?php }
		if (isset($anonymizeIp) && $anonymizeIp != '' && $anonymizeIp != '0')
		{ ?>
		_gaq.push(['<?php echo $prefix ?>_gat._anonymizeIp']);
		<?php } } ?>
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		</script>
		<?php }

	} // END

} // END class Frontend
