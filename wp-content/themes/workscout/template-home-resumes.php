<?php
/**
 * Template Name: Page with Resumes Search
 *
 * @package WordPress
 * @subpackage workscout
 * @since workscout 1.0
 */

get_header(); ?>

<div id="banner" class="workscout-search-banner" >
    <div class="container">
        <div class="sixteen columns">
            
            <div class="search-container sc-resumes">

                <!-- Form -->
                <h2><?php esc_html_e('Find Candidate','workscout') ?></h2>
                <form method="GET" action="<?php echo get_permalink(get_option('resume_manager_resumes_page_id')); ?>">
            
                    <input type="text" id="search_keywords" name="search_keywords"  class="ico-01" placeholder="<?php esc_attr_e( 'Search freelancer services (e.g. logo design)', 'workscout' ); ?>" value=""/>
                   
             
                    <input type="text" id="search_location" name="search_location" class="ico-02" placeholder="<?php esc_attr_e('city, province or region','workscout'); ?>" value=""/> 
                    
                    <button><i class="fa fa-search"></i></button>

                </form>
                
                
                <!-- Announce -->
                <div class="announce">
                    <?php $count_jobs = wp_count_posts( 'resume', 'readable' ); 
                    printf( esc_html__( 'We have %s resumes in our database', 'workscout' ), '<strong>' . $count_jobs->publish . '</strong>' ) ?>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
while ( have_posts() ) : the_post(); ?>
<!-- 960 Container -->
<div class="container page-container home-page-container">
    <article <?php post_class("sixteen columns"); ?>>
                <?php the_content(); ?>
    </article>
</div>
<?php endwhile; // end of the loop.

get_footer(); ?>