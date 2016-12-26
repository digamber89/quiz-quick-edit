<div class="wrap">
<h1>Plugin Settings Header</h2>
	<h2 class="nav-tab-wrapper">
		<?php do_action('add_settings_tab'); ?>
		<a href="<?php echo add_query_arg( array( 'page' => 'plugin-url','tab' => 'settings' ),admin_url( 'admin.php' )	); ?>" 	class="nav-tab <?php if ( !isset( $_GET['tab'] ) || 'settings' === $_GET['tab'] ): ?> nav-tab-active<?php endif; ?>">
		<?php _e( 'Settings 1', 'coach-plugin-sms' ); ?>
		</a>
		<a href="<?php echo add_query_arg( array( 'page' => 'plugin-url', 'tab' => 'check-balance' ), admin_url( 'admin.php' ) ); ?>" class="nav-tab <?php if ( isset( $_GET['tab'] ) && 'check-balance' === $_GET['tab'] ): ?> nav-tab-active<?php endif; ?>">
		<?php _e( 'Settings 2', 'coach-plugin-sms' ); ?>
		</a>
	</h2>
<div class="message">
	<?php 
		$message = $this->get_message();
		if( isset($message) && !empty($message) ){
			echo $message;
		}
		
	?>
</div>
<?php
	if( !isset($_GET['tab']) || $_GET['tab'] == 'settings' ){
		require_once(DQN_DIR.'/includes/views/settings.php');
	}elseif( isset($_GET['tab']) && $_GET['tab'] == 'check-balance' ){
		require_once(DQN_DIR.'/includes/views/check-balance.php');
	}
?>
</div>