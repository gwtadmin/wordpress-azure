<?php
/**
 * Template Name: Page Template Login
 *
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage workscout
 * @since workscout 1.0
 */
$action = !empty( $_GET['action'] ) && ($_GET['action'] == 'register' || $_GET['action'] == 'forgot' || $_GET['action'] == 'resetpass') ? $_GET['action'] : 'login';

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php $header_image = get_post_meta($post->ID, 'pp_job_header_bg', TRUE); 
	if(!empty($header_image)) { ?>
		<div id="titlebar" class="photo-bg single" style="background: url('<?php echo esc_url($header_image); ?>')">
	<?php } else { ?>
		<div id="titlebar" class="single">
	<?php } ?>
		<div class="container">

			<div class="sixteen columns">
				<h1><?php the_title(); ?></h1>
	        	<?php if(function_exists('bcn_display')) { ?>
		        <nav id="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
					<ul>
			        	<?php bcn_display_list(); ?>
			        </ul>
				</nav>
			<?php } ?>
			</div>
		</div>
	</div>

	<?php

		$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
		if(empty($layout)) { $layout = 'full-width'; }
		$class = ($layout !="full-width") ? "eleven columns" : "sixteen columns" ;

	?>

	<div class="container <?php echo esc_attr($layout); ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
		<?php if ( !empty($_GET['change_password']) ): ?>
			<div class="columns six my-account woo-login-form">
				
					<h2><?php _e('Change password','workscout') ?></h2>
					<p><?php _e('You may change your password if you are so inclined.','workscout') ?></p>
					<?php echo do_shortcode('[password_form]'); ?> 
				
			</div>
		<?php endif; ?>
		<?php if(isset($_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
		           <div class="notification closeable success">
		                <p><?php _e('Password changed successfully', 'workscout'); ?></p>
		            </div>
        <?php } ?>
				
		<?php global $current_user; 

			if ( is_user_logged_in() ) { 
				$user = wp_get_current_user();
				if ( in_array( 'candidate', (array) $user->roles ) ) { ?>
					<div class="myaccount_user">
						<?php printf(	__( '<h2 class="my-acc-h2">Hello <strong>%1$s</strong></h2>', 'workscout' ), $current_user->display_name );	?>
						<a class="button gray" href="<?php echo wp_logout_url('index.php');  ?>"><?php esc_html_e('Log out','workscout') ?></a>
		                 &nbsp; <a class="button gray" href="?change_password=1"><i class="fa fa-user"></i> <?php esc_html_e('Change password','workscout') ?></a>
					</div>
		     		<?php
		     		if ( defined( 'RESUME_MANAGER_VERSION' ) ) {
						echo do_shortcode('[candidate_dashboard][clear] [spacer]');
					}

					if ( defined( 'JOB_MANAGER_APPLICATIONS_VERSION' ) ) {
						echo do_shortcode('[headline margintop="30"]'.esc_html__('Past Applications','workscout').'[/headline] [past_applications]');		
					}
				} elseif (in_array( 'employer', (array) $user->roles ) ) { ?>
					<div class="myaccount_user">
						<?php printf(	__( '<h2 class="my-acc-h2">Hello <strong>%1$s</strong></h2>', 'workscout' ), $current_user->display_name );	?>
						<a class="button gray" href="<?php echo wp_logout_url('index.php');  ?>"><?php esc_html_e('Log out','workscout') ?></a>
		                 &nbsp; <a class="button gray" href="?change_password=1"><i class="fa fa-user"></i> <?php esc_html_e('Change password','workscout') ?></a>
					</div>
					<?php echo do_shortcode('[job_dashboard]');
				} else {

				?>
				
				<div id="login-register-password" class="columns six my-account woo-login-form">
					<?php if ( !empty($_GET['success']) ): ?>
								<div class="notification closeable success">
									<span class="icon-thumbs-up"></span>
									<?php _e('Profile updated successfully!','workscout') ?>
								</div>
					<?php endif; ?>

					<?php if ( !empty($error) ): ?>
						<div class="notification closeable error">
							<span class="icon-thumbs-up"></span>
							<?php echo $error; ?>
						</div>
					<?php endif; ?>
					<div class="sidebox">

				        <h3><?php esc_html_e('Welcome','workscout') ?>, <?php echo esc_html($user_identity); ?></h3>
				        
				        <div class="usericon">
				            <?php global $userdata;  echo get_avatar($userdata->ID, 100); ?>
				        </div>

				        <div class="userinfo">
				            <p><?php esc_html_e('You&rsquo;re logged in as','workscout'); ?> <strong><?php echo esc_html($user_identity); ?></strong></p>
				            <p>
				                <a class="button gray" href="<?php echo wp_logout_url('index.php');  ?>"><?php esc_html_e('Log out','workscout') ?></a>
				                <a class="button gray" href="?change_password=1"><?php esc_html_e('Change password','workscout') ?></a>

				                <?php if (current_user_can('manage_options')) {
				                    echo '<a class="button gray" href="' . esc_url(admin_url()) . '">' . esc_html__('Admin','workscout') . '</a>'; } else {
				                        echo '<a class="button gray" href="' . esc_url(admin_url()) . 'profile.php">' . esc_html__('Profile','workscout') . '</a>'; } ?>
				            </p>
				        </div>

				    </div>
				
					
				</div>
			
			<?php 
			}
			} else { ?>
				<div id="login-register-password" class="columns six my-account woo-login-form">
					<?php do_action('workscout-before-login'); ?>

						<ul class="tabs-nav-o" id="login-tabs">
							<li class="<?php if ($action == 'login') echo 'active'; ?>"><a href="#tab-login"><?php esc_html_e('Login','workscout'); ?></a></li>
							<?php if ( get_option( 'users_can_register' ) ) { ?>
								<li class="<?php if ($action == 'register') echo 'active'; ?>"><a href="#tab-register"><?php esc_html_e('Register','workscout'); ?></a></li> 
							<?php } ?>
						</ul>
<?php
$args = array(
	'echo'           => true,
	'remember'       => true,
	'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
	'form_id'        => 'loginform',
	'id_username'    => 'user_login',
	'id_password'    => 'user_pass',
	'id_remember'    => 'rememberme',
	'id_submit'      => 'wp-submit',
	'label_username' => __( 'Username' ),
	'label_password' => __( 'Password' ),
	'label_remember' => __( 'Remember Me' ),
	'label_log_in'   => __( 'Log In' ),
	'value_username' => '',
	'value_remember' => false
);
?>
						<div id="tab-login" class="tab-content"  style="<?php if ( $action != 'login' ) echo 'display:none' ?>">
						
						<?php echo do_shortcode('[login_form]');    ?> 
						
						</div>
						<?php if ( get_option( 'users_can_register' ) ) { ?>
							<div id="tab-register" class="tab-content" style="<?php if ( $action != 'register' ) echo 'display:none' ?>">
								<?php echo do_shortcode('[register_form]'); ?>
								
							</div>
						<?php } ?>
					
						
				</div>			
			<?php } ?>
			<?php 
				the_content(); 
			?>
		</article>
	</div>

<?php endwhile; // End of the loop. ?>
<?php get_footer(); ?>