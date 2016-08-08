<?php
/**
 * Template Name: Home Map Template, No Sidebar
 *
 * @package wpjobboard_theme
 * @since 1.2.2
 */
?>
<?php

    wp_enqueue_style( 'jobeleon-nouislider' );
    wp_enqueue_style( 'jobeleon-nouislider-pips' );
    
    wp_enqueue_script( 'jobeleon-nouislider' );
    
    $map_radius_unit = get_post_meta($post->ID, "_map_radius_unit", true);
    $map_max_radius = get_post_meta($post->ID, "_map_max_radius", true);
    $map_center = get_post_meta($post->ID, "_map_center", true);
    $map_height = get_post_meta($post->ID, "_map_height", true);
    $map_auto_locate = get_post_meta($post->ID, "_map_auto_locate", true);
    
    $map_radius_unit = $map_radius_unit ? $map_radius_unit : "km";
    $map_max_radius = $map_max_radius ? $map_max_radius : "200";
    $map_center = $map_center ? $map_center : "USA";
    $map_height = $map_height ? $map_height : "550px";
    

?>
<?php get_header() ?>

        </div> <!-- .wrapper -->
        
        <script type="text/javascript">
            var jblMap = {
                map_max_radius: <?php echo (int)$map_max_radius ?>,
                map_radius_unit: "<?php echo $map_radius_unit ?>"
            }
            
            jQuery(function($) {
                $(".map-radius").noUiSlider({
                    start: 50,
                    step: 1,
                    connect: "lower",
                    range: {
                      'min': 0,
                      'max': jblMap.map_max_radius
                    },
                    format: {
                        to: function(value) {
                            return value.toFixed(0)+" "+jblMap.map_radius_unit;
                        },
                        from: function(value) {
                            return value;
                        }
                    }
                });
                
                $(".map-radius").Link('lower').to($('.map-distance'));
                $("#wpjb-paginate-links").hide();
                
                wpjb_ls_jobs();
                
                $(".jobeleon-map-search").click(function(e) {
                    e.preventDefault();
                    wpjb_map_load_data();
                    
                    WPJB_SEARCH_CRITERIA.location = jQuery("#map_location").val();
                    WPJB_SEARCH_CRITERIA.query = jQuery("#map_keyword").val();
                    WPJB_SEARCH_CRITERIA.radius = jQuery(".map-radius").val();
                    
                    wpjb_ls_jobs();
                });
                
                wpjbMapCallbacks.loadData.location = function(data) {
                    data.location = jQuery("#map_location").val();
                    data.query = jQuery("#map_keyword").val();
                    data.radius = jQuery(".map-radius").val();
                };
            })
        </script>
        
        <div class="jobeleon-normal-border jobeleon-map" style="">
            <?php echo wpjb_map(array("data"=>"jobs", "width"=>"100%", "center"=>$map_center, "height"=>$map_height, "auto_locate"=>$map_auto_locate)) ?>
            
            <div class="jobeleon-map-filter jobeleon-normal-border">
                <form action="" method="">
                    
                    <div class="jobeleon-map-filter-column jobeleon-map-filter-column-text">
                        <input type="text" id="map_keyword" name="query" placeholder="<?php esc_attr_e("Keyword ...", "jobeleon") ?>" autocomplete="off" />
                    </div>
                    
                    <div class="jobeleon-map-filter-column  jobeleon-map-filter-column-text">
                        <input type="text" id="map_location" name="location" placeholder="<?php esc_attr_e("Location ...", "jobeleon") ?>" autocomplete="off" />
                    </div>
                    
                    <div class="jobeleon-map-filter-column jobeleon-map-filter-column-radius">
                        <div class="map-input map-input-radius"><div class="map-radius"></div></div>
           
                    </div>
                    
                   <div class="jobeleon-map-filter-column jobeleon-map-filter-column-radius-text">
                        <div class="map-input" style="">
                            <span class="map-distance-wrap wpjb-glyphs wpjb-icon-direction">
                                <?php _e('Radius <span class="map-distance"></span>', "jobeleon") ?>
                            </span>
                        </div>
                   </div>
                    
                   <div class="jobeleon-map-filter-column jobeleon-map-filter-column-filter">
                        <button class="wpjb-glyphs wpjb-icon-search jobeleon-map-search"><?php _e("Filter", "jobeleon") ?></button>
                   </div>
                   
                </form>
            </div>
            
        </div>
        
        <div class="wrapper wpjb-template-map" style="margin-top:30px">
            <div class="table-row">
                <div id="primary" class="primary">
                    <div id="main" class="site-main">

    
                        <div id="content" class="site-content full-widthx" role="main">
                            <article class="page type-page status-publish hentry">
                                <div class="entry-content">
                                    <?php echo wpjb_jobs_list(array()) ?>
                                </div>
                            </article>


                            <?php while (have_posts()) : the_post(); ?>
                            <?php if(get_the_content()): ?>
                            <article class="page type-page status-publish hentry">
                                <div class="entry-content">
                                    <?php the_content(); ?> 
                                </div>
                            </article>
                            <?php endif; ?>
                            <?php endwhile; // end of the loop. ?>
                            
                        </div><!-- #content -->
                    </div> <!-- #main .site-main -->
                </div> <!-- #primary .primary -->
            </div> <!-- .table-row -->
       
        

<?php get_footer() ?>
