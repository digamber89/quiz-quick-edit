<?php
/*
	Plugin Name: Digthis Quick Notes
	Description: Add Quick Notes Column and Edit Abilities
	Plugin URI: URI goes here
	Author: Digamber Pradhan
	Author URI: http://www.digamberpradhan.com.np/
	Version: 1.0
	License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
	Text Domain: digthis-quick-notes
*/

/**
 * Define Plugin FILE PATH
 */
if( !defined('DQN_FILE_PATH') ){
	define('DQN_FILE_PATH', __FILE__);
}
if( !defined('DQN_DIR') ){
	define('DQN_DIR', dirname(__FILE__) );	
}

// plugin does not need this, this is for generating settings pages
//require_once( DQN_DIR.'/includes/class/class-admin.php' );
require_once( DQN_DIR.'/includes/register-post-types.php' );
require_once( DQN_DIR.'/includes/manage-edit-columns.php' );

add_action('admin_enqueue_scripts', 'dqn_scripts');
function dqn_scripts(){
	global $current_screen;
	if( $current_screen->post_type == 'quiz'){
		/* only load our script on our custom post type */
		$src = plugins_url( 'assets/js/quick-notes.js', DQN_FILE_PATH );
		wp_register_script( 'dqn-quick-edit', $src, array('jquery'), 1.0 , true );
		wp_enqueue_script('dqn-quick-edit' );
	}
}

function dnc_plugin_activate (){
/*Register post type and flush rewrite rule*/
	codex_quiz_init();
	flush_rewrite_rules();
}
register_activation_hook( DQN_FILE_PATH, 'dnc_plugin_activate' );



if( !function_exists('print_pre') ){
	function print_pre($val){
		echo '<pre>';
			var_dump($val);
		echo '</pre>';

	}
}