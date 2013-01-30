<?php
/*
Plugin Name: Badge Fever Shortcode Plugin
Plugin URI: https://github.com/BadgeFever/WP-Shortcode-Plugin
Description: This plugin creates a shortcode [display_badges] which you can use anywhere in your wordpress content to display badges.
Version: 1.0
Author: Badge Fever - Tomas Dostal
Author URI: http://badgefever.com
License: GPL2
*/

/*  Copyright 2013  Badge Fever  (email : support@badgefever.com)

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
/* ============================================================================== */

add_shortcode('display_badges', 'bf_display_badges');
function bf_display_badges($atts, $content = null) {
	extract(shortcode_atts(
		array(
			'email' => 'test@badgefever.com',
			'offset' => 0,
			'limit' => 5,
			'size' => 'medium',
			'styles' => 'on',
		),
		$atts
	));

	$output = '';

	if ($styles == 'on'){
		wp_register_style( 'bf_shortcode_style', plugins_url('style.css', __FILE__) );
		wp_enqueue_style( 'bf_shortcode_style' );
	}

	$url = 'http://api.badgefever.com/v1/display/';
	$url .= '?email='.md5(strtolower(trim($email)));
	$url .= '&offset='.$offset;
	$url .= '&limit='.$limit;
	$url .= '&size='.$size;
	$url .= '&format=html';

	$output .= file_get_contents($url);

	return $output;
}
