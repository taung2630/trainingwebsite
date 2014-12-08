=== User Profile ===
	Contributors: paratheme
	Donate link: http://paratheme.com
	Tags: user profile, Custom User Profile
	Requires at least: 3.8
	Tested up to: 4.0
	Stable tag: 1.1
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Creating unlimited user profile field.

== Description ==


By this plugin you can create unlimited user input field on user profile and display anywhere via shortcodes.

We have designed special author profile for users as like social profile. displaying author latest post, comment and about.

### User Profile by http://paratheme.com


<strong>Plugin Features</strong><br />

* Responsive admin settings.
* Easy way to create input field on user profile.
* Unlimited user profile field.

N.B. We are working on this plugin making some fancy social feature.




== Installation ==

1. Install as regular WordPress plugin.<br />
2. Go your plugin setting via WordPress Dashboard and find "<strong>User Profile</strong>" activate it.<br />

After activate plugin you will see "User Profile" menu at left side on WordPress dashboard.<br />

<strong>Short-code for Author Profile</strong>

This short-code for user profile, you can paste short-code anywhere on content by fixed author id or auhtor.php page by making dynamic author id.
Display on content:

`[up_author_profile themes="flat" id="1"]`

Display on author.php

`<?php
$author = get_queried_object();
$authorid = $author->ID;
echo do_shortcode( '[up_author_profile themes="flat" id="'.$authorid.'"]' ); 
?>`




== Screenshots ==

1. screenshot-1
2. screenshot-2

== Changelog ==


	= 1.1 =
	
    * 07/11/2014 Fix - Empty post issue.
    * 07/11/2014 Fix - Empty commemts issue.
    * 07/11/2014 Fix - Empty porfile description issue.

	= 1.0 =
	
    * 05/11/2014 Initial release.
