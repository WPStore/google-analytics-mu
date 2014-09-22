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
class Admin {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 * 
	 * @since  3.0.0
	 * @return void
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'ga_add_sections', array( $this, 'add_sections' ) );
		add_action( 'ga_add_fields', array( $this, 'add_fields' ) );

	} // END __construct()

	/**
	 * Load language files
	 *
	 * @uses   load_plugin_textdomain()
	 * @since  3.0.0
	 * @return void
	 */
	public function load_textdomain() {

		load_plugin_textdomain(
			'google-analytics-mu',
			false,
			dirname( plugin_basename( \WPStore\GoogleAnalyticsMU()->get_file() ) ) . '/languages/'
		);

	} // END load_textdomain()

	public function add_sections( $sections ) {

		$sections['scroll_depth'] = array(
			'tab'	 => 'advanced',
			'title'	 => __( 'Scroll Depth', 'scroll-depth' ),
			'desc'	 => __( 'Track how far visitors scroll down on pages', 'scroll-depth' ),
		);

		return $sections;

	}

	public function add_fields( $fields ) {

		$fields['scroll_depth'] = array(
			'google_ua'	 => array(
				'label'	 => __( 'Text Input (integer validation)', 'web-analytics' ),
				'desc'	 => __( 'Text input description', 'web-analytics' ),
				'type'	 => 'google_ua',
			),
			'textarea'	 => array(
				'label'	 => __( 'Textarea Input', 'wedevs' ),
				'desc'	 => __( 'Textarea description', 'wedevs' ),
				'type'	 => 'textarea'
			),
			'checkbox'	 => array(
				'label'	 => __( 'Checkbox', 'wedevs' ),
				'desc'	 => __( 'Checkbox Label', 'wedevs' ),
				'type'	 => 'checkbox'
			),
			'radio'		 => array(
				'label'		 => __( 'Radio Button', 'wedevs' ),
				'desc'		 => __( 'A radio button', 'wedevs' ),
				'type'		 => 'radio',
				'options'	 => array(
					'yes'	 => 'Yes',
					'no'	 => 'No'
				)
			),
		);

		return $fields;

	}

	function ga_mu_plugin_menu() {
		switch_to_blog('1');
		$siteSpecificAllowed = get_option('ga_mu_site_specific_allowed');
		restore_current_blog();
		if (isset($siteSpecificAllowed) && $siteSpecificAllowed != '' && $siteSpecificAllowed != '0') {
			add_options_page( __('Google Analytics', 'google-analytics-mu'), __('Google Analytics', 'google-analytics-mu'), 'manage_options', 'google-analytics-mu', 'google_analytics_mu_options');
		}
	}

	function google_analytics_mu_options() {

		global $blog_id;

		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.', 'google-analytics-mu') );
		}

		if ( isset( $_POST['UAID'] ) && ( !empty($_POST) && check_admin_referer( 'google-analytics-mu-settings', 'google-analytics-mu-settings-nonce' ) ) ) {
			update_option('ga_mu_uaid', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['UAID']));
						update_option('ga_mu_anonymizeip_activated', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['AnonymizeIpActivated']));
						update_option('ga_mu_pagespeed_activated', preg_replace('/[^a-zA-Z\d\-]/','',$_POST['PageSpeedActivated']));
			?>
			<div id="message" class="updated fade"><p><?php _e('Analytics ID saved.', 'google-analytics-mu') ?></p></div>
		<?php }	?>

		<div class="wrap">
					<style>
						.indent {padding-left: 2em}
						h4 {margin-bottom: 0;}
					</style>
						<?php screen_icon( 'plugins' ); ?>
			<h2><?php _e('Google Analytics Settings', 'google-analytics-mu') ?></h2>

						<?php if ($blog_id == '1') { ?>
						<div style="border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background:#feb1b1;border:1px solid #fe9090;color:#820101;font-size:12px;font-weight:bold;height:auto;margin:10px 15px 0 0;font-family:arial;overflow:hidden;padding:4px 10px 6px;" id="update_sb">
							<div style="margin:2px 10px 0 0;float:left;line-height:18px;padding-left:22px; padding:10px 10px 10px 30px;">
								<?php _e('As this is the main blog it uses the same ID as the network do. Changing this would change the networkwide ID; that is why it is disabled here.', 'google-analytics-mu'); ?>
							</div>
						</div>
						<?php } ?>

			<form name="form" action="" method="post">
				<?php wp_nonce_field( 'google-analytics-mu-settings', 'google-analytics-mu-settings-nonce' ); ?>
							<ul>
								<li>
									<h4><?php _e('Google Analytics Property-ID', 'google-analytics-mu') ?>:</h4>
									<p class="indent">
										<input type="text" id="UAID" name="UAID"
					<?php
					if ($blog_id == '1') {
						echo 'disabled="disabled"';
					} ?>
					value="<?php echo get_option('ga_mu_uaid'); ?>" placeholder="UA-01234567-8"/>
										<?php _e('Format: UA-01234567-8', 'google-analytics-mu')?>
									</p>
									<p class="indent"><?php printf( __('Go to your %s to find your Property-ID', 'google-analytics-mu'), '<a href="https://www.google.com/analytics/web/" target="_blank">' . __('Google Analytics Dashboard', 'google-analytics-mu') . '</a>') ?></p>
								</li>
								<li>
									<h4><?php _e('Anonymize IPs', 'google-analytics-mu') ?>:</h4>
									<p class="indent">
										<input type="checkbox" id="AnonymizeIpActivated" name="AnonymizeIpActivated" value="Activated"
										<?php
										$anonymizeIp = get_option('ga_mu_anonymizeip_activated');
										restore_current_blog();
										if (isset($anonymizeIp) && $anonymizeIp != '' && $anonymizeIp != '0') {
												echo 'checked="checked"';
										}
										?>
										 /> <?php _e('Activated', 'google-analytics-mu') ?>
									</p>
									<p class="indent">
										<?php _e('If AnonymizeIP is activated all tracked IPs will be saved in shortened form.', 'google-analytics-mu')?>
									</p>
								</li>
								<li>
									<h4><?php _e('Google PageSpeed', 'google-analytics-mu') ?>:</h4>
									<p class="indent">
										<input type="checkbox" id="PageSpeedActivated" name="PageSpeedActivated" value="Activated"
										<?php
										$PageSpeed = get_option('ga_mu_pagespeed_activated');
										restore_current_blog();
										if (isset($PageSpeed) && $PageSpeed != '' && $PageSpeed != '0') {
												echo 'checked="checked"';
										}
										?>
										 /> <?php _e('Activated', 'google-analytics-mu') ?>
									</p>
									<p class="indent">
										<?php _e('Activate to track performance via Google PageSpeed.', 'google-analytics-mu')?>
									</p>
								</li>
								<p>
									<input type="submit" id="submit" name="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
								</p>
							</ul>
			</form>
		</div>
		<?php
	}

} // END class Admin
