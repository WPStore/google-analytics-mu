# Google Analytics MU
__Provides info to site admins as to which plugins are activated sitewide, and which blogs plugins are activated on.__

## Details
[Homepage][1.1] | [WordPress.org][1.2]

| WordPress					| Version			| *		| Development				|					|
| ----:						| :----				| :---: | :----						| :----				|
| Requires at least:		| __3.1__			| *		| [GitHub-Repository][1.3]	| [Translate][1.7]	|
| Tested up to:				| __3.5.1__			| *		| [Issue-Tracker][1.4]		| 					|
| Current stable release:	| __[2.3][1.5]__	| *		| Current dev version:		| [2.4-dev][1.8]	|

[1.1]: http://labs.foe-services.de/
[1.2]: http://wordpress.org/extend/plugins/google-analytics-mu/
[1.3]: https://github.com/wp-repository/google-analytics-mu
[1.4]: https://github.com/wp-repository/google-analytics-mu/issues
[1.5]: https://github.com/wp-repository/google-analytics-mu/archive/2.3.zip
[1.7]: https://translate.foe-services.de/projects/google-analytics-mu
[1.8]: https://github.com/wp-repository/google-analytics-mu/archive/master.zip

### Description
Features
* track the whole network with one Google Analytics UA code
* let individual site owners track their site with their on UA code (optional, set by the network admin panel)
* track Google PageSpeed (optional) (network-wide + site-specific)
* collect data with anonymized IPs (optional) (network-wide + site-specific)


## Development
### Developers
| Name					| GitHub				| WordPress.org			| Web									| Status				|
| :----					| :----					| :----					| :----									| ----:					|
| Christian Foellmann	| [cfoellmann][2.4.1]	| [cfoellmann][2.4.2]	| http://www.foe-services.de			| Current maintainer	|

### Fork
Fork of [Google Analytics Multisite Async](https://wordpress.org/extend/plugins/google-analytics-multisite-async/) by [Niklas Jonsson](http://www.darturonline.se/ga-mu-async.html)

[2.4.1]: https://github.com/cfoellmann
[2.4.2]: http://profiles.wordpress.org/cfoellmann


## License
__[GPLv2](http://www.gnu.org/licenses/gpl-2.0.html)__

    Google Analytics MU

    Copyright (C) 2012-2013  Foe Services Labs (http://labs.foe-services.de)
    Copyright (C) 2011-2012  Niklas Jonsson  (email : niklas@darturonline.se)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.


## Changelog
* __2.4__ _[future plans/roadmap][4.1]_
    * TBD
* __2.3__
	* ADDED tabbed network settings + minor styling improments
* __2.2__
	* ADDED FEATURE 'autoupdate' via wordpress.org
* __2.1__
	* ADDED FEATURE '_trackPageLoadTime'
	* ADDED FEATURE '_anonymizeIp()'
* __2.0__
	* FIX XSS vulnerability (by Dan Collis-Puro)
	* FIX language support

[4.1]: ../../issues