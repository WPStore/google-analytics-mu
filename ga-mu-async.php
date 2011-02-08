<?php
/*
Plugin Name: Google Analytics Multisite Async
Plugin URI: http://www.darturonline.se/ga-mu-async.html
Description: Google Analytics Multisite Async lets the superadmin collect statistics from all sites and it lets the regular site admins to collect statistics from their own site. This means that statistics are collected to 2 different Analytics accounts at once, assuming that the site admin have entered an ID of course. It's the async version of Analytics. There is a simple ID edit page that is only visible to the admins.
Version: 1.0
Author: Niklas Jonsson
Author URI: http://www.darturonline.se/ga-mu-async.html
License: GPL2
*/
?>
<?php
/*  Copyright 2011  Niklas Jonsson  (email : niklas@darturonline.se)

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
?>
<?php

add_action('admin_menu', 'ga_mu_plugin_menu');
add_action('wp_head', 'ga_mu_plugin_add_script_to_head');

define('UAID_OPTION','ga_mu_uaid');
define('MAINDOMAIN_OPTION', 'ga_mu_maindomain');
define('MAIN_BLOG_ID',1);

if ( !function_exists('ga_mu_plugin_menu') ) :
	function ga_mu_plugin_menu() {
		add_options_page('Google Analytics', 'Google Analytics', 'manage_options', 'ga-mu-plugin-id', 'ga_mu_plugin_options');
	}
endif;
if ( !function_exists('ga_mu_plugin_options') ) :
	function ga_mu_plugin_options() {
	
		load_plugin_textdomain('ga-mu-async', null, '/ga-mu-async/languages/');
		
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.', 'ga-mu-async') );
		}
		
		if (isset($_POST['UAID'])) {
			update_option(UAID_OPTION, $_POST['UAID']);
			?>
			<div id="message" class="updated fade"><p><?php _e('Analytics ID saved.', 'ga-mu-async') ?></p></div>
        <?php }	
			
		if (current_user_can('manage_network'))  {
			
			if (isset($_POST['UAIDsuper'])) {
				switch_to_blog(MAIN_BLOG_ID);
				update_option(UAID_OPTION, $_POST['UAIDsuper']);
				update_option(MAINDOMAIN_OPTION, $_POST['MainDomain']);
				restore_current_blog();
			?>
			<div id="message" class="updated fade"><p><?php _e('Superuser ID and domain saved.', 'ga-mu-async') ?></p></div>
			<?php }	} ?>
		
		
    	
		<div class="wrap">
			<h2><?php _e('Google Analytics Statistics', 'ga-mu-async') ?></h2>
			<form name="form" action="" method="post">
			<table style="margin-top: 20px;">
			<?php
				if (current_user_can('manage_network'))  {
					?>
					<tr>
						<td style="padding-bottom: 18px;"><?php _e('Network Google Analytics ID', 'ga-mu-async') ?>:</td>
						<td style="padding-bottom: 18px;"><input type="text" id="UAIDsuper" name="UAIDsuper" value="<?php 
						switch_to_blog(MAIN_BLOG_ID);
						echo get_option(UAID_OPTION);
						restore_current_blog();
						?>" /> 
						(<?php _e('superuser only. ex. UA-01234567-8', 'ga-mu-async')?>)</td>
					</tr>
					<tr>
						<td style="padding-bottom: 18px;"><?php _e('Network domain', 'ga-mu-async') ?>:</td>
						<td style="padding-bottom: 18px;"><input type="text" id="MainDomain" name="MainDomain" value="<?php 
						switch_to_blog(MAIN_BLOG_ID);
						echo get_option(MAINDOMAIN_OPTION);
						restore_current_blog();
						?>" /> 
						(<?php _e('superuser only. ex. ".mydomain.com". Obs! start with a dot! This value goes into', 'ga-mu-async')?> _gaq.push(['_setDomainName', 'NETWORK_DOMAIN']))</td>
					</tr>
				<?php } ?>
				<tr>
					<td style="padding-bottom: 18px;"><?php _e('Google Analytics ID', 'ga-mu-async') ?>:</td>
					<td style="padding-bottom: 18px;"><input type="text" id="UAID" name="UAID" value="<?php echo get_option(UAID_OPTION); ?>" /> (<?php _e('ex. UA-01234567-8', 'ga-mu-async') ?>)</td>
				</tr>
				<tr>
					<td>&nbsp;</td><td><input type="submit" id="submit" name="submit" class="button-primary" value="<?php _e('Save changes', 'ga-mu-async') ?>" /></td>
				</tr>
				</table>
			</form>
		</div>
		<div style="margin-top:40px;font-size:0.8em;"><?php _e('Plugin created by', 'ga-mu-async') ?>: <a href="http://www.darturonline.se/ga-mu-async.html" target="_blank">Niklas Jonsson</a></div>
		
		<?php
		
    	
	}
endif;

if ( !function_exists('ga_mu_plugin_add_script_to_head') ) :
	function ga_mu_plugin_add_script_to_head() {
	
		switch_to_blog(MAIN_BLOG_ID);
		$uaidsuper = get_option(UAID_OPTION);
		$maindomain = get_option(MAINDOMAIN_OPTION);
		restore_current_blog();

		$uaid = get_option(UAID_OPTION);
		
		$super = false;
		$user = false;
		
		if (isset($uaidsuper) && $uaidsuper != '' && $uaidsuper != '0') {
			$super = true;
		}
		if (isset($uaid) && $uaid != '' && $uaid != '0') {
			$user = true;
		}
		
		if ($super || $user)
		{
			$prefix = ''
			?>
				<script type="text/javascript">
				var _gaq = _gaq || [];
			<?php
				if ($super) {
					?>
					_gaq.push(['_setAccount', '<?php echo $uaidsuper ?>']);
					<?php
					if ($maindomain)
					{ ?>
					_gaq.push(['_setDomainName', '<?php echo $maindomain ?>']);
					<?php
					} ?>
					_gaq.push(['_trackPageview']);
					
					<?php 
					$prefix = 'b.';
				}
				
				if ($user) {
					?>
					_gaq.push(['<?php echo $prefix ?>_setAccount', '<?php echo $uaid ?>']);
					_gaq.push(['<?php echo $prefix ?>_trackPageview']);
					<?php
				}
				?>
				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				  })();
				</script>			
				<?php
		}
	}
endif;
?>