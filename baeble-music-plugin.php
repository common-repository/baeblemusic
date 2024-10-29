<?php
/*


Plugin Name: Baeblemusic Plugin
Plugin URI: http://wordpress.org/extend/plugins/baeblemusic/
Description: This enables easy syndication of Baeble Music Video Content
Author: Gene Ellis
Version: 1.0
License: GPL2


    Copyright 2012  Gene Ellis  (email : gene.ellis@gmail.com)

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

/***************************
* constants
***************************/

if(!defined('BM_BASE_DIR')) {
	define('BM_BASE_DIR', dirname(__FILE__));
}

if(!defined('BM_BASE_URL')) {
	define('BM_BASE_URL', plugin_dir_url(__FILE__));
}

/********************************
* global variables
********************************/

$bm_plugin_name = 'Baeble Music Plugin';
$bm_options = get_option('bm_settings');

/********************************
* includes
********************************/

include(BM_BASE_DIR . '/includes/admin-page.php');
include(BM_BASE_DIR . '/includes/main-functions.php');
include(BM_BASE_DIR . '/includes/press-trends.php');
include(BM_BASE_DIR . '/includes/press-trends-optin.php');

// handle activations

// activated
function plugin_activated() {
    
    // Now create the page
    global $user_ID;
    $new_post = array(
        'post_title' => 'Baeblemusic',
        'post_content' => '<!-- This is left blank intentionally -->',
        'post_status' => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => 1,
        'post_type' => 'page',
        'filter' => true 
    );
    $post_id = wp_insert_post($new_post);
    
    // lets try storing in a database instead
    $option_name = 'plugin_page_id';
    $new_value = $post_id;
    if (get_option($option_name) != $new_value) {
        update_option($option_name, $new_value );
    }
        
}

register_activation_hook( __FILE__, 'plugin_activated' );

// deactivated
function plugin_deactivated() {

    $post_id = get_option('plugin_page_id');
    
    // delete the page
    wp_delete_post($post_id,1); 

}

register_deactivation_hook( __FILE__, 'plugin_deactivated' );

