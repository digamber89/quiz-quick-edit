<?php
function add_fc_note_columns($columns) {
    $columns['note'] = 'Note';
     return $columns;
}

function fc_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'note':
			$content = get_post_meta($post_id,'note', true);
			echo  apply_filters('the_content',$content );
			break;
	}
}
// https://codex.wordpress.org/Plugin_API/Action_Reference/manage_$post_type_posts_custom_column
// add filter manage_${post_type}_posts_columns to add a column 
// add action to display field value
add_filter('manage_quiz_posts_columns' , 'add_fc_note_columns');
add_action( 'manage_quiz_posts_custom_column' , 'fc_custom_columns', 10, 2 );


function fc_display_custom_quickedit_note( $column_name, $post_type ) {
    if( $post_type != 'quiz'){
    	return false;
    }
    wp_nonce_field( 'verify_quiz_quick_edit', 'quiz_edit_nonce' );

    ?>
    <fieldset class="inline-edit-col-right inline-edit-book">
      <div class="inline-edit-col column-<?php echo $column_name; ?>">
        <label class="inline-edit-group">
        <?php 
         switch ( $column_name ) {
         case 'note':
             ?><span class="title">Notes</span>
             <textarea name="fc_note"></textarea> <?php
             break;
         }
        ?>
        </label>
      </div>
    </fieldset>
    <?php
}


function save_fc_note_meta( $post_id ) {
    /* in production code, $slug should be set only once in the plugin,
       preferably as a class property, rather than in each function that needs it.
     */
    $slug = 'quiz';
    if ( isset($_POST['post_type']) && $slug !== $_POST['post_type'] ) {
        return;
    }
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if( isset($_POST['quiz_edit_nonce']) && !wp_verify_nonce( $_POST['quiz_edit_nonce'], 'verify_quiz_quick_edit' ) ){
    	return;
    }

    if ( isset( $_REQUEST['fc_note'] ) ) {
        update_post_meta( $post_id, 'note', $_REQUEST['fc_note'] );
    }
    
}
// add quick edit custom box
// in our case note textarea
// check post type or bail early
// https://codex.wordpress.org/Plugin_API/Action_Reference/quick_edit_custom_box
// read carefully for trickery (admin.js line no 81)
add_action( 'quick_edit_custom_box', 'fc_display_custom_quickedit_note', 10, 2 );
// save_post
// need to add your own nonce for security 
add_action( 'save_post', 'save_fc_note_meta' );