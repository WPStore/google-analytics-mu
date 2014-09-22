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
 * @todo
 *
 * @since 3.0.0
 */
class Network {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 * 
	 * @since  3.0.0
	 * @return void
	 */
	public function __construct() {

		// add_action( 'network_admin_menu', array( $this, 'network_admin_menu' ) );

	} // END __construct()

	/**
	 * OLD
	function network_admin_menu() {

		add_submenu_page(
			'settings.php',
			__('Google Analytics', 'google-analytics-mu'),
			__('Google Analytics', 'google-analytics-mu'),
			'manage_network',
			'google-analytics-mu-network',
			'google_analytics_mu_network_options'
		);

	}
	 */

	function google_analytics_mu_network_options( $active_tab = '' ) {

		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.', 'google-analytics-mu') );
		}

		if ( current_user_can('manage_network') && ( !empty($_POST) && check_admin_referer( 'google-analytics-mu-settings', 'google-analytics-mu-settings-nonce' ) ) )  {

			if (isset($_POST['UAIDsuper'])) {
				if (isset($_POST['AllowSiteSpecificAccounts'])) {
					$allowSiteSpecificAccounts = 1;
				}
				else {
					$allowSiteSpecificAccounts = 0;
				}
								if (isset($_POST['AnonymizeIpActivated'])) {
					$AnonymizeIpActivated = 1;
				}
				else {
					$AnonymizeIpActivated = 0;
				}
								if (isset($_POST['PageSpeedActivated'])) {
					$AnonymizeIpActivated = 1;
				}
				else {
					$AnonymizeIpActivated = 0;
				}
				switch_to_blog('1');
				update_option('ga_mu_uaid', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['UAIDsuper']));
								update_option('ga_mu_maindomain', preg_replace('/[^a-zA-Z\d\-\.]/','',$_POST['MainDomain']));
								update_option('ga_mu_site_specific_allowed', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['AllowSiteSpecificAccounts']));
								update_option('ga_mu_anonymizeip_activated', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['AnonymizeIpActivated']));
								update_option('ga_mu_pagespeed_activated', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['PageSpeedActivated']));
				restore_current_blog();
			?>
			<div id="message" class="updated fade"><p><?php _e('Network settings saved.', 'google-analytics-mu') ?></p></div>
			<?php }	} ?>

		<div class="wrap">
						<style type="text/css">
							.tab-body {
								padding: 10px;
								border-style: solid;
								border-width: 0 1px 1px 1px;
								border-color: #CCCCCC;
							}
							.indent {padding-left: 2em}
						</style>
						<?php screen_icon( 'plugins' ); ?>
			<h2><?php _e('Google Analytics Network Settings', 'google-analytics-mu') ?></h2>

						<?php
						if (isset($_GET['tab'])) {
							$active_tab = $_GET['tab'];
						} else if ($active_tab == 'about') {
							$active_tab = 'about';
						} else {
							$active_tab = 'network-settings';
						} // end if/else
						?>

						<h2 class="nav-tab-wrapper">
							<a href="?page=google-analytics-mu-network&tab=network-settings" class="nav-tab <?php echo $active_tab == 'network-settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Network-Settings', 'google-analytics-mu'); ?></a>
							<a href="?page=google-analytics-mu-network&tab=about" class="nav-tab <?php echo $active_tab == 'about' ? 'nav-tab-active' : ''; ?>"><?php _e('About', 'google-analytics-mu'); ?></a>
						</h2>

			<?php if (current_user_can('manage_network') && $active_tab == 'about') { ?>
							<div class="tab-body">

								<h1>Google Analytics MU - WordPress Plugin</h1>
								<p>
									<a href="https://wordpress.org/extend/plugins/google-analytics-mu/" target="_blank">WordPress.org</a> |
									<a href="https://github.com/Foe-Services-Labs/Google-Analytics-MU/" target="_blank">GitHub Repository</a> |
									<a href="https://github.com/Foe-Services-Labs/Google-Analytics-MU/issues" target="_blank">Issue Tracker</a>
								</p>

								<h3><?php _e('About', 'google-analytics-mu'); ?></h3>
								<ul>
									<li>Fork of <a href="https://wordpress.org/extend/plugins/google-analytics-multisite-async/" target="_blank">Google Analytics Multisite Async</a> by <a href="http://www.darturonline.se/ga-mu-async.html" target="_blank">Niklas Jonsson</a></li>
									<li>Upstream: <a href="https://github.com/Foe-Services-Mirrors/google-analytics-multisite-async" target="_blank">Foe-Services-Mirrors / google-analytics-multisite-async</a> - Synced Git-Mirror of the official SVN-repo</li>
								</ul>

								<h3><?php _e('Development', 'google-analytics-mu'); ?></h3>
								<ul>
									<li><?php _e('Main Developer', 'google-analytics-mu'); ?>: <a href="http://labs.foe-services.com/" target="_blank">Foe Services Labs</a> | <a href="https://github.com/Foe-Services-Labs/" target="_blank">Foe Services Labs@GitHub</a> | <a href="http://profiles.wordpress.org/foe-services-labs" target="_blank">Foe Services Labs@WP.org</a></li>
								</ul>

								<h3>WordPress</h3>
								<ul>
									<li><?php printf( __('Requires at least: %s', 'google-analytics-mu'), '3.0.1'); ?></li>
									<li><?php printf( __('Tested up to: %s', 'google-analytics-mu'), '3.5.1'); ?></li>
								</ul>

								<h3><?php _e('Languages', 'google-analytics-mu'); ?></h3>
								<ul>
									<li>English</li>
									<li>German</li>
								</ul>
								<p><?php printf( __('Help to translate at %s', 'google-analytics-mu'), '<a href="https://translate.foe-services.de/projects/google-analytics-mu" target="_blank">https://translate.foe-services.de/projects/google-analytics-mu</a>'); ?></p>

								<h3><?php _e('License', 'google-analytics-mu'); ?>: <a href="http://www.gnu.org/licenses/gpl-2.0.html" target="_blank">GPLv2</a></h3>

							</div><!-- /.wrap -->

						<?php } elseif (current_user_can('manage_network')) { ?>
							<div class="tab-body">
							<form name="form" action="" method="post">
								<?php wp_nonce_field( 'google-analytics-mu-settings', 'google-analytics-mu-settings-nonce' ); ?>
								<ul>
									<li>
										<h4><?php _e('Network Google Analytics Property-ID', 'google-analytics-mu') ?>:</h4>
										<p class="indent">
											<input type="text" id="UAIDsuper" name="UAIDsuper" value="<?php
											switch_to_blog('1');
											echo get_option('ga_mu_uaid');
											restore_current_blog();
											?>" placeholder="UA-01234567-8"/>
											<?php _e('Format: UA-01234567-8', 'google-analytics-mu')?>
										</p>
										<p class="indent"><?php printf( __('Go to your %s to find your Property-ID', 'google-analytics-mu'), '<a href="https://www.google.com/analytics/web/" target="_blank">' . __('Google Analytics Dashboard', 'google-analytics-mu') . '</a>') ?></p>
									</li>
									<li>
										<h4><?php _e('Network domain', 'google-analytics-mu') ?>:</h4>
										<p class="indent">
											<input type="text" id="MainDomain" name="MainDomain" value="<?php
											switch_to_blog('1');
											echo get_option('ga_mu_maindomain');
											restore_current_blog();
											?>" />
											<?php _e('Format: ".mydomain.com"', 'google-analytics-mu')?>
										</p>
										<p class="indent">
											<?php printf( __('Start with a dot! This value goes into %s', 'google-analytics-mu'), "<i>_gaq.push(['_setDomainName', 'NETWORK_DOMAIN'])</i>"); ?>
										</p>
									</li>
									<li>
										<h4><?php _e('Site specific accounts', 'google-analytics-mu') ?>:</h4>
										<p class="indent">
											<input type="checkbox" id="AllowSiteSpecificAccounts" name="AllowSiteSpecificAccounts" value="Allowed"
											<?php
											switch_to_blog('1');
											$siteSpecificAllowed = get_option('ga_mu_site_specific_allowed');
											restore_current_blog();
											if (isset($siteSpecificAllowed) && $siteSpecificAllowed != '' && $siteSpecificAllowed != '0') {
													echo 'checked="checked"';
											}
											?>
											 /> <?php _e('Allowed', 'google-analytics-mu') ?>
										</p>
										<p class="indent">
											<?php _e('If this is disallowed the Google Analytics settings page will not be visible to site admins.', 'google-analytics-mu')?><br>
											<?php _e('That means they will not be able to use their own Google Analytics accounts to track statistics.', 'google-analytics-mu')?>
										</p>
									</li>
									<li>
										<h4><?php _e('Anonymize IPs for Network-Tracking', 'google-analytics-mu') ?>:</h4>
										<p class="indent">
											<input type="checkbox" id="AnonymizeIpActivated" name="AnonymizeIpActivated" value="Activated"
											<?php
											switch_to_blog('1');
											$anonymizeIp = get_option('ga_mu_anonymizeip_activated');
											restore_current_blog();
											if (isset($anonymizeIp) && $anonymizeIp != '' && $anonymizeIp != '0') {
													echo 'checked="checked"';
											}
											?>
											 /> <?php _e('Activated', 'google-analytics-mu') ?>
										</p>
										<p class="indent">
											<?php _e('This option activates IP-Anonymization for the network domain on the main site and all subsites.', 'google-analytics-mu')?><br>
											<?php _e('If AnonymizeIP is activated all tracked IPs will be saved in shortened form.', 'google-analytics-mu')?>
										</p>
									</li>
									<li>
										<h4><?php _e('Google PageSpeed', 'google-analytics-mu') ?>:</h4>
										<p class="indent">
											<input type="checkbox" id="PageSpeedActivated" name="PageSpeedActivated" value="Activated"
											<?php
											switch_to_blog('1');
											$PageSpeed = get_option('ga_mu_pagespeed_activated');
											restore_current_blog();
											if (isset($PageSpeed) && $PageSpeed != '' && $PageSpeed != '0') {
													echo 'checked="checked"';
											}
											?>
											 /> <?php _e('Activated', 'google-analytics-mu') ?>
										</p>
										<p class="indent"><?php _e('Activate to track network-wide performance via Google PageSpeed.', 'google-analytics-mu')?></p>
									</li>
								</ul>
								<p><input type="submit" id="submit" name="submit" class="button-primary" value="<?php _e( 'Save Changes') ?>" /></p>
							</form>
							</div><!-- /.wrap -->
						<?php } ?>
		</div>
		<?php }

} // END class Network
