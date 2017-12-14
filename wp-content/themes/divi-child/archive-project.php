<?php 
    get_header(); 
    if ( isset($_GET['s']) ) {
        $search_term = $_GET['s'];
    }
    else {
        $search_term = '';
    }

    if (isset($_GET['term_id'])) {
        $x_id = $_GET['term_id'];
    }else{
        $x_id = 0;
    }

    // $local_term = get_queried_object();

    // if (isset($local_term->term_id)) {
    //     $term_id = $local_term->term_id;
    //     $term_name = $local_term->name;
    // }
    // else {
    //     $term_id = '';
    //     $term_name = '';
    // }
?>

<div class="container">
    <h1>Recent Work</h1>
</div>

<div id="main-content">
    <nav class="recent-work-navbar">
        <div class="container no-border">
            <div class="tab-menu">
                <div class="show-desktop">
                    <ul class="nav_menu">
                        <li class="tab-button <?php echo ( $x_id == 0 ? 'active': '' ) ?> ">
                            <a class="nav-item" href="/project">Show all</a>
                        </li>
                        <?php 
                            $args = array(
                                'show_option_all'       => 'All Content Types',
                                'orderby'               => 'id',
                                'show_count'            => false,
                                'use_desc_for_title'    => false,
                                'hide_empty'            => true,
                                'depth'                 => 1,
                                'taxonomy'              => 'project_category',
                                'title_li'              => 'Content Type'
                            );
                            $terms = get_terms( $args );
                            if ( $terms && !is_wp_error( $terms ) ) :
                                foreach ( $terms as $term ) {
                                ?>
                                    <li class="tab-button <?php echo ( $x_id == $term->term_id ? 'active': '' ) ?>"  >
                                        <a href="/project/?term_id=<?php echo $term->term_id; ?>">
                                            <?php echo $term->name; ?>
                                        </a>
                                    </li>
                                <?php } 
                            endif; 
                        ?>
                    </ul>    
                </div>
                <div class="show-mobile">
                    <ul id="mobile-menu">
                        <li>Choose a Category <i class="fa fa-angle-down" aria-hidden="true"></i></li>
                        <ul class="sub-menu">
                            <li class="tab-button <?php echo ( !$term_id ? 'active': '' ) ?> ">
                                <a class="nav-item" href="/project">Show all</a>
                            </li>
                            <?php 
                                $args = array(
                                    'show_option_all'       => 'All Content Types',
                                    'orderby'               => 'id',
                                    'show_count'            => false,
                                    'use_desc_for_title'    => false,
                                    'hide_empty'            => true,
                                    'depth'                 => 1,
                                    'taxonomy'              => 'project_category',
                                    'title_li'              => 'Content Type'
                                );
                                $terms = get_terms( $args );
                                if ( $terms && !is_wp_error( $terms ) ) :
                                    foreach ( $terms as $term ) {
                                    ?>
                                        <li class="tab-button <?php echo ( $term_name == $term->name ? 'active': '' ) ?>"  >
                                            <a href="/project/?term_id=<?php echo $term->term_id; ?>">
                                                <?php echo $term->name; ?>
                                            </a>
                                        </li>
                                    <?php } 
                                endif; 
                            ?>
                        </ul>
                    </ul>
                </div>
                
<!--                <span class="search-appear">
                    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
                        <input type="text" value="" name="s" id="s" placeholder="Search">
                        <input type="submit" id="searchsubmit" value="Search">
                        <input type="hidden" name="post_type" value="post">
                    </form>
                </span> -->
            </div>
        </div>
    </nav>
    <div class="container no-border w-mobile-100">
        <div id="content-area" class="clearfix">
            <div class="recent-work-content">
            <?php
                //pagination parameters
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

                if ($x_id == 0) {
                    $args = array(
                        'post_type'         => 'project', 
                        'posts_per_page'    => 100,
                        'paged'             => $paged
                    );
                }else{
                    $args = array( 
                        'post_type'         => 'project', 
                        'posts_per_page'    => 100,
                        'paged'             => $paged,
                        'tax_query'         => array(
                            array(
                                'taxonomy' => 'project_category',
                                'field' => 'ID', //can be set to ID
                                'terms' => $x_id //if field is ID you can reference by cat/term number
                            )
                        )
                    );
                }

                

            $project_posts_query = new WP_Query( $args );

            if ( $project_posts_query->have_posts() ) :
                while ( $project_posts_query->have_posts() ) : $project_posts_query->the_post();
                    $post_format = et_pb_post_format(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
                        <?php
                            $thumb = '';

                            $width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

                            $height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
                            $classtext = 'et_pb_post_main_image';
                            $titletext = get_the_title();
                            $thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
                            $thumb = $thumbnail["thumb"];

                            et_divi_post_format_content();

                            if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
                                if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
                                    printf(
                                        '<div class="et_main_video_container">
                                            %1$s
                                        </div>',
                                        $first_video
                                    );
                                elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
                                        
                                        <?php the_post_thumbnail('blog_preview', ['class' => 'w-100']); ?>

                            <?php
                                elseif ( 'gallery' === $post_format ) :
                                    et_pb_gallery_images();
                                endif;
                            } ?>
                        
                        <div class="holder">
                            <!-- TAG SECTION -->
                            <div class="tags">
                                <?php
                                    $current_id = $project_posts_query->the_ID();
                                    $posttags = get_the_terms($current_id, 'project_tag');
                                    if ($posttags) {
                                      foreach($posttags as $tag) { ?>
                                        <div class="tag-item">
                                            <?php echo $tag->name . '  '; ?>
                                        </div>
                                        <?php
                                      }
                                    }
                                ?>
                            </div>
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>  
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="mt15 view-link">
                            <a href="<?php the_permalink(); ?>">View Case Study</a>
                        </div>
                        
                    </article> <!-- .et_pb_post -->
            <?php
                    endwhile;

                else :
                    get_template_part( 'includes/no-results', 'index' );
                endif;
            ?>
            </div> <!-- #left-area -->
        </div> <!-- #content-area -->
    </div> <!-- .container -->
    
    
</div> <!-- #main-content -->

<?php get_footer(); ?>