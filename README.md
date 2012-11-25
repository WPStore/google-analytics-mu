## Google Analytics MU - WordPress Plugin

[Info@GitHub](https://github.com/foe-services/google-analytics-mu) | 
[Issue-Tracker](https://github.com/foe-services/google-analytics-mu/issues) | 
[Foe Services Labs](http://labs.foe-services.de/) | Current stable release: __v2.1__

### WordPress
* Requires at least: 3.1
* Tested up to: 3.5beta3

### About
* Fork of [Google Analytics Multisite Async](https://wordpress.org/extend/plugins/google-analytics-multisite-async/) by [Niklas Jonsson](http://www.darturonline.se/ga-mu-async.html)
* Upstream: [foe-services-mirrors / google-analytics-multisite-async](https://github.com/foe-services-mirrors/google-analytics-multisite-async) - Synced Git-Mirror of the official SVN-repo

### Languages
* English (active)
* German (active) (Thanks Jenny at http://www.professionaltranslation.com)
* Swedish (outdated)
* Dutch (outdated) (Thanks Rene at http://wpwebshop.com)
* Persian (outdated)(Thanks Sushynat at http://www.zavarzadeh.org)

* Help to translate at [http://translate.foe-services.de](http://translate.foe-services.de)

### Changelog
* FIX XSS vulnerability (by Dan Collis-Puro) (v2.0)
* FIX language support (v2.0)
* ADDED FEATURE '_trackPageLoadTime' (v2.1)
* ADDED FEATURE '_anonymizeIp()' (v2.1)

### Roadmap
* ADD autoupdate via network dashboard
* ADD tabbed settings page
* minified javascript snippet

* ensure compatibility with WordPress in the future

### Installation (manual)
1. Download the newest version from [the Tags](https://github.com/foe-services/google-analytics-mu/tags)
2. Unzip + rename the containing folder (google-analytics-mu-*.*) in the .zip file to `google-analytics-mu`
3. Upload the folder and files to the `/wp-content/plugins/` directory
4. Verify that your networks main blog ID is 1. If so, jump to step 4.
5. Open the plugin file and change the number next to MAIN_BLOG_ID to your main blog ID.
6. Activate the plugin network-wide
7. You (network admin) will find a new option in the network admin page in the Settings menu called "Google Analytics"
8. Site admins will find a new option in the Settings menu called "Google Analytics" if activated

### Installation (automatic)
coming soon

### Update (automatic)
coming soon

### License
License: [GPLv2](https://github.com/foe-services/google-analytics-mu/blob/master/LICENSE)
  
### Developers
* Christian Foellmann (cfoellmann): [Github](https://github.com/cfoellmann) | [Web](http://www.foe-services.de) | [Mail](mailto:foellmann@foe-services.de)

* Upstream (Google Analytics Multisite Async) by Niklas Jonsson (Dartur): [http://darturonline.se/ga_mu_async.html](http://darturonline.se/ga_mu_async.html)

### Contributations are always welcome