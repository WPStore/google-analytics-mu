=== Google Analytics MU ===
Contributors: wp-repository, Foe Services Labs, cfoellmann
Tags: adopt-me, needs-takeover, Google Analytics, analytics, statistics, stats, lightweight, multisite, multiuser, multiblog, tracking, simple, network
Requires at least: 2.7.0
Tested up to: 3.5
Stable tag: 2.4
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

ADOPT ME -- Network admins can setup network-wide GA tracking and give individual site owners the option to use their own tracking code

== Description ==

= Adopt Me =
Since we do/can not use the plugin anymore we need to abandon this plugin.
This means that this plugin will be rotting away in the repo unless someone else picks up the development.
If you are interested contact me [@GitHub](https://github.com/cfoellmann).

= WP requirements =
* WordPress multisite installations __ONLY__
* WordPress version >= 3.0.1 (keep your installation updated for security reasons!!)

= Features =
* track the whole network with one Google Analytics UA code
* let individual site owners track their site with their on UA code (optional, set by the network admin panel)
* track Google PageSpeed (optional) (network-wide + site-specific)
* collect data with anonymized IPs (optional) (network-wide + site-specific)

= Languages =
* English (development language -> active)
* German (active)

= Development =
* Contribute Code at [https://github.com/wp-repository/Google-Analytics-MU](https://github.com/wp-repository/Google-Analytics-MU)

== Installation ==

The plugin has no special install instructions.
Just install via wp-admin by searching for 'Google Analytics MU'

= Updates =
Just update via wp-admin when an update is announced

== Frequently Asked Questions ==

= What features or changes are planned for the furure? =
Have a look at the [Roadmap](https://github.com/Foe-Services-Labs/Google-Analytics-MU#roadmap) at GitHub

= Where can I get help? =
Visit the [Issue tracker at GitHub](https://github.com/Foe-Services-Labs/Google-Analytics-MU/issues) to get help and post all other issues.
Please do not use the support section here at WordPress.org.

== Changelog ==
= 2.4 =
* added nonce check on settings pages to protect from CSRF - props @harrym

= 2.3.1 =
* proper formating (source code styling) for the GA snippet

= 2.3 =
* ADDED tabbed network settings
* minor styling improments

= 2.2.1 =
* non critical update
* correcting some versioning errors

= 2.2 =
* First published version on WordPress.org
* ADDED FEATURE 'autoupdate' via wordpress.org (v2.2)

= 2.1 =
* ADDED FEATURE '_trackPageLoadTime' (v2.1)
* ADDED FEATURE '_anonymizeIp()' (v2.1)

= 2.0 =
* Forking of [Google Analytics Multisite Async](https://wordpress.org/extend/plugins/google-analytics-multisite-async/) by [Dartus](https://profiles.wordpress.org/Dartur/)
* Git-Mirror = Upstream: [https://github.com/Foe-Services-Mirrors/google-analytics-multisite-async](https://github.com/Foe-Services-Mirrors/google-analytics-multisite-async)
* FIX XSS vulnerability (by Dan Collis-Puro) (v2.0)
* FIX language support (v2.0)