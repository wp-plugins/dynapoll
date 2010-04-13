<?php
/*
Plugin Name: DynaPoll
Plugin URI: http://www.dynapoll.net/survey/dynapoll_wordpress_plugin
Description: Grab a DynaPoll and embed it into your WP site
Version: 1.0.1
Author: Alasdair Boyd
Author URI: http://www.dynapoll.net
*/

/*  Copyright 2010  Alasdair Boyd  (email : al@alboydweb.com.au)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*

DYNAPOLL USAGE
USAGE 1:
Paste the following into any part of your site and it will output the poll as per the poll code.
<?php
	$poll_code = 'rnACCLw2ccTwyOG9e2htY';
	echo dynapoll_get_poll($poll_code);
?>

USAGE 2:
Paste the following into your content (ie; within a blog post or page content) and it will be replaced with
the poll which corresponds to the poll code.

[dynapoll: rnACCLw2ccTwyOG9e2htY]

 */

function dynapoll_writeCSS() {
	$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	echo ( '<link rel="stylesheet" type="text/css" href="'. $x . 'dynapoll_css.css">' . "\r\n" );
}

function dynapoll_writeJS() {
	$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$js_inc = '<script type="text/javascript" src="'. $x . 'dynapoll_js.js"></script>' . "\r\n";
	$js_inc .= '<script type="text/javascript">var base_url = "' . $x . '";</script>';
	echo $js_inc;
}

add_action( 'wp_head', 'dynapoll_writeCSS' );
add_action('wp_head', wp_enqueue_script('jquery'));
add_action('wp_head', 'dynapoll_writeJS');

require_once(dirname(__FILE__)."/dynapoll_rpc.php");

function dynapoll_get_poll($poll_code)
{
	$user_ip = $_SERVER["REMOTE_ADDR"];

	$f=new xmlrpcmsg('get_poll', array(new xmlrpcval($poll_code, "string"),
									new xmlrpcval($user_ip, "string")));
	$returned_html = send_rpc_request($f);

	switch(trim($returned_html))
					{
					case '900':
						$returned_html = "IP Address has been implicated in a previous SPAM answer suggestion.";
						return false;
					  break;
					case '901':
						$returned_html = "Spam question was not answered correctly.";
						return false;
					  break;
					case '902':
						$returned_html = "Poll not found.";
						return false;
					  break;
					case '903':
						$returned_html = "Poll code was not sent.";
						return false;
					  break;
					case '904':
						$returned_html = "IP Address has logged a vote within the last 24 hours.";
						return false;
					  break;
					default:
					  /* do nothing - therefore load content */
					}

	return $returned_html;
}

function filter_dynapoll_tag($content) {

    while (($start = strpos($content, "[dynapoll:")) !== false) {

        $end = $start + strpos(substr($content, $start), "]") - 1;

        if (!$end) {
            $content = substr($content, 0, $start + 10)."]".substr($content, $start + 11);
        } else {
            $tag = substr($content, $start, $end - $start + 2);

	    $params = str_replace("[dynapoll:","",$tag);
	    $params = str_replace("]","",$params);
	    $params = rtrim(ltrim($params));
	    $params = explode("#",$params);

	    $content = str_replace($tag, dynapoll_get_poll($params[0]), $content);
        }
    }

    return $content;
}

add_filter('the_content', 'filter_dynapoll_tag');
?>
