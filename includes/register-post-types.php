<?php
/*Register  post type Quiz*/
add_action( 'init', 'codex_quiz_init' );
/**
 * Register a Quiz post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_quiz_init() {
	$labels = array(
		'name'               => _x( 'Quizzes', 'post type general name', 'digthis-quick-notes' ),
		'singular_name'      => _x( 'Quiz', 'post type singular name', 'digthis-quick-notes' ),
		'menu_name'          => _x( 'Quizzes', 'admin menu', 'digthis-quick-notes' ),
		'name_admin_bar'     => _x( 'Quiz', 'add new on admin bar', 'digthis-quick-notes' ),
		'add_new'            => _x( 'Add New', 'Quiz', 'digthis-quick-notes' ),
		'add_new_item'       => __( 'Add New Quiz', 'digthis-quick-notes' ),
		'new_item'           => __( 'New Quiz', 'digthis-quick-notes' ),
		'edit_item'          => __( 'Edit Quiz', 'digthis-quick-notes' ),
		'view_item'          => __( 'View Quiz', 'digthis-quick-notes' ),
		'all_items'          => __( 'All Quizs', 'digthis-quick-notes' ),
		'search_items'       => __( 'Search Quizs', 'digthis-quick-notes' ),
		'parent_item_colon'  => __( 'Parent Quizs:', 'digthis-quick-notes' ),
		'not_found'          => __( 'No Quizs found.', 'digthis-quick-notes' ),
		'not_found_in_trash' => __( 'No Quizs found in Trash.', 'digthis-quick-notes' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'digthis-quick-notes' ),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => array( 'slug' => 'quiz' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title',  'author'  )
	);

	register_post_type( 'quiz', $args );
}