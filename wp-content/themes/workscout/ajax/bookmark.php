<?php 
include '../../../../wp-load.php';
global $wpdb;
extract($_POST);
$user_id = get_current_user_id();
switch($action){
	case 'add':
		$wpdb->insert( 
			'wp_job_manager_bookmarks', 
			array( 
				'user_id' => $user_id, 
				'post_id' => $post_id,
				'date_created' => current_time('mysql', 1)
			), 
			array( 
				'%d', 
				'%d',
				'%s'
			) 
		);
	break;
	case 'remove':
		$wpdb->delete( 'wp_job_manager_bookmarks', array( 'user_id' => $user_id, 'post_id' => $post_id ), array( '%d', '%d' ) );
	break;
	default:
	echo 'default';
}
echo 'success';
?>