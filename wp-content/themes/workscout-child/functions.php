<?php 
add_action( 'wp_enqueue_scripts', 'workscout_enqueue_styles' );
function workscout_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css',array('workscout-base','workscout-responsive','workscout-font-awesome') );

}

 
function remove_parent_theme_features() {
   	
}
add_action( 'after_setup_theme', 'remove_parent_theme_features', 10 );

/***************Add field to Job Post*************/
add_filter( 'submit_job_form_fields', 'frontend_add_positions_n_type_fields' );

function frontend_add_positions_n_type_fields( $fields ) {
  $fields['job']['Positions'] = array(
    'label'       => __( 'Positions', 'job_manager' ),
    'type'        => 'text',
    'required'    => true,
    'placeholder' => 'e.g. 2',
    'priority'    => 7
  );
  $fields['job']['Type'] = array(
    'label'       => __( 'Type', 'job_manager' ),
    'type'        => 'text',
    'required'    => true,
    'placeholder' => 'e.g. Contract – 2 yr',
    'priority'    => 8
  );
  return $fields;
}

/*******Add Admin fields on Job Post************/
add_filter( 'job_manager_job_listing_data_fields', 'admin_add_positions_n_type_fields' );

function admin_add_positions_n_type_fields( $fields ) {
  $fields['_Positions'] = array(
    'label'       => __( 'Positions', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => 'e.g. 20000',
    'description' => ''
  );
  $fields['_Type'] = array(
    'label'       => __( 'Type', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => 'e.g. Contract – 2 yr',
    'description' => ''
  );
  return $fields;
}


add_action( 'single_job_listing_meta_end', 'display_job_positions_n_type_data' );

function display_job_positions_n_type_data() {
  global $post;

  $positions = get_post_meta( $post->ID, 'Positions', true );
  $type = get_post_meta( $post->ID, 'Type', true );

  if ( $positions ) {
	  echo '<li>
						<i class="fa fa-users"></i>
						<div>
							<strong>' . __( 'Positions:' ) . '</strong>
							<span>' . esc_html( $positions ) . '</span>
						</div>
					</li>';
  }
  if ( $type ) {
	  echo '<li>
						<i class="fa fa-history"></i>
						<div>
							<strong>' . __( 'Type:' ) . '</strong>
							<span>' . esc_html( $type ) . '</span>
						</div>
					</li>';
  }
}

//remove admin bar except admin user
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

/* //remove video field from submit resume
 add_filter( 'submit_resume_form_fields', 'remove_submit_resume_form_fields' );

function remove_submit_resume_form_fields( $fields ) {
	// Unset any of the fields you'd like to remove - copy and repeat as needed

	
  
	unset( $fields['resume_fields']['candidate_video'] );
	// And return the modified fields
	$fields['resume_fields']['candidate_rate_min']['label'] = "Minimun Rate/Hr/Yr ($)";
	return $fields;
}  */


function custom_login_action( $user_login, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		$seconds = time() - strtotime($user->data->user_registered);
		$action = '';
		if($seconds<10){
			$action = '/?success=1';
		}
		if ( in_array( 'candidate', $user->roles ) ) {
			wp_redirect(get_permalink(2871).$action); die();
		}
		else if ( in_array( 'employer', $user->roles ) ) {
			wp_redirect(get_permalink(2870).$action); die();
		}
	}
}
add_action('wp_login', 'custom_login_action', 10, 2);

function themeblvd_redirect_admin(){
	if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
		wp_redirect( site_url() );
		exit;		
	}
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );


