=== Plugin Name ===
Contributors: Alasdair Boyd
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=DBZ7EUWDDRS38&lc=AU&item_name=DynaPoll&item_number=DynaPoll_WP&currency_code=AUD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: poll, survey
Requires at least: 2.9
Tested up to: 2.9
Stable tag: 1.0.2

The DynaPoll plugin enables you to embed your DynaPoll polls into your WordPress site. Create a poll at http://www.dynapoll.net. 

== Description ==

If you would like to host one of your polls or, indeed, any poll from DynaPoll on your site then this is the plugin for you!

You can setup a DynaPoll poll on http://www.dynapoll.net

It's extremely easy to install and even easier to use this plugin.You can check out the following video which demonstrates the use of the plugin.

http://www.youtube.com/watch?v=Kp707w1B4Zg

Full instructions found at: http://www.dynapoll.net/survey/dynapoll_wordpress_plugin
== Installation ==

For full detailed instructions and the usage demonstration video please check http://www.dynapoll.net/survey/dynapoll_wordpress_plugin

It's really easy to use the plugin. Before you can though you need to know the Poll Code for the poll you wish to display. You can grab your poll code from the Vote URL of the poll. 
Whereever there is a link to the poll on this DynaPoll, whether it is in your My Polls page, in the Poll Browser or anywhere else, you can see the URL for the poll by either clicking on the question or 
right clicking on the question and choosing the option to "Copy Link Address". The code is the last parameter of the vote URL which looks like this:

http://www.dynapoll.net/survey/vote/1gQXDBnMx3CDppWbaLDH4

The URL above is for the What is your favourite colour? poll and the poll code for this is: 1gQXDBnMx3CDppWbaLDH4

There are several ways you can embed a DynaPoll Poll into your Wordpress site:

In your Blog Posts or Page content put the following tag where you would like the poll to appear:

`[dynapoll: 1gQXDBnMx3CDppWbaLDH4]`

OR

Anywhere in the WordPress Template put the following code:

`<?php 
     $poll_code = '1gQXDBnMx3CDppWbaLDH4'; 
     echo dynapoll_get_poll($poll_code); 
?>`

OR

If you want to use it in a Dynamic Sidebar with a Widget we recommend downloading the [PHP Code Widget by Otto](http://wordpress.org/extend/plugins/php-code-widget "PHP Code Widget by Otto"). Drag the PHP Code Widget into 
your sidebar and paste the following code into the content of the Widget:

`<?php
      $poll_code = '1gQXDBnMx3CDppWbaLDH4';
      echo dynapoll_get_poll($poll_code);
?>`


== Frequently Asked Questions ==

There are no questions to report at this stage :)

== Screenshots ==

No screenshots but check out the demo video here: http://www.youtube.com/watch?v=Kp707w1B4Zg

== Changelog ==

= 1.0 =
* Initial release

= 1.0.1 =
* Fixed a minor problem with images referenced by css not displaying. Cosmetic only

== Upgrade Notice ==

= 1.0.1 =
* If you want it to look slightly prettier (haha) then upgrade :)