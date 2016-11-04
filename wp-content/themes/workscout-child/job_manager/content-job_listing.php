<?php global $post; 



?>

<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	<a href="<?php the_job_permalink(); ?>">
		<?php the_company_logo(); ?>
		<div class="job-list-content">
			<h4><?php the_title(); ?> <span class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></span><?php if(workscout_newly_posted()) { echo '<span class="new_job">'.esc_html__('NEW','workscout').'</span>'; } ?> 
			</h4>

			<div class="job-icons">
				<?php do_action( 'workscout_job_listing_meta_start' ); ?>
				<span><i class="fa fa-briefcase"></i> <?php the_company_name();?></span>
				<span><i class="fa fa-map-marker"></i> <?php the_job_location( false ); ?></span>

				<?php 
				$rate_min = get_post_meta( $post->ID, '_rate_min', true ); 
				if ( $rate_min) { 
					$rate_max = get_post_meta( $post->ID, '_rate_max', true );  ?>
					<span>
						<i class="fa fa-money"></i> <?php echo get_workscout_currency_symbol(); echo esc_html( $rate_min ); if(!empty($rate_max)) { echo '- '.$rate_max; } ?> <?php esc_html_e('/ hour','workscout'); ?>
					</span>
				<?php } ?>

				<?php 
				$salary_min = get_post_meta( $post->ID, '_salary_min', true ); 
				if ( $salary_min ) {
					$salary_max = get_post_meta( $post->ID, '_salary_max', true );  ?>
					<span>
						<i class="fa fa-money"></i>
						<?php echo get_workscout_currency_symbol(); echo esc_html(number_format($salary_min, 2) ); ?> <?php if(!empty($salary_max)) { echo '- '.get_workscout_currency_symbol(); echo esc_html(number_format($salary_max, 2) ); } ?>
					</span>
				<?php } ?>
				<?php do_action( 'workscout_job_listing_meta_end' ); ?>
			</div>
			<div class="listing-desc"><?php the_excerpt(); ?></div>
		</div>
	</a>
<div class="clearfix"></div>
	<div class="bookmark_selected">
	<div class="three columns">
	<?php 
	if(is_user_logged_in()){ 
		global $wpdb;
		$user_id = get_current_user_id();
		$exist = $wpdb->get_var( "SELECT COUNT(*) FROM wp_job_manager_bookmarks where user_id=".$user_id." and post_id=".$post->ID);
		if($exist){ ?>
		<a href="javascript:void(0)" class="remove-bookmark button dark" onclick="removeBookmark(this,<?php echo $post->ID; ?>)"><i class="fa fa-star"></i>Remove Bookmark</a>
		<?php }
		else{ ?>
		<a href="javascript:void(0)" class="add-bookmark button" onclick="addBookmark(this,<?php echo $post->ID; ?>)"><i class="fa fa-star"></i>Add Bookmark</a>
		<?php 
		}
	}
	else{
	?>
		<a href="<?php echo get_permalink(2466); ?>" class="button">Login to Add Bookmark</a>
		<?php 
	}
	?>
	</div>
	</div> 
	<div class="clearfix"></div>
</li>




