<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">
	<div id="content-area" class="clearfix">
		<div id="main-area">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $post_format = et_pb_post_format();  
			if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>

			<?php
				$et_pb_has_comments_module = has_shortcode( get_the_content(), 'et_pb_comments' );
				$additional_class = $et_pb_has_comments_module ? ' et_pb_no_comments_section' : '';
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' . $additional_class ); ?>>
				<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>
					<?php if (! $post_format == 'video'): ?>
					<div class="et_post_meta_wrapper hero-heading">
					<?php
						if ( ! post_password_required() ) :
							echo '<div class="image-wrapper">';
							the_post_thumbnail(get_the_ID());
							echo '</div>';
						?>
						<div class="container no-border">
							<h1 class="entry-title mb20"><?php the_title(); ?></h1>
							<div class="post-meta">
								<div class="avatar-wrapper">
									<div class="avatar" style="background-image:url(<?php echo get_avatar_url(get_the_author_meta( 'ID' )); ?>)"></div>
								</div>
								<div class="meta-info pl15">
									<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );  ?>" class="text-white uppercase"><strong><?php echo get_the_author_meta('display_name'); ?></strong></a>
									<span class="text-white pl10 pr10">|</span>
									<span class="uppercase text-white"><?php echo get_the_date();  ?></span>
								</div>
							</div>
						</div>
						<?php endif;
					?>
				</div> <!-- .et_post_meta_wrapper -->
				<?php endif ?>
			<?php  } ?>

				<?php 

				$text_color_class = et_divi_get_post_text_color();

					$inline_style = et_divi_get_post_bg_inline_style();

					switch ( $post_format ) {
						case 'audio' :
							printf(
								'<div class="et_audio_content%1$s"%2$s>
									%3$s
								</div>',
								esc_attr( $text_color_class ),
								$inline_style,
								et_pb_get_audio_player()
							);

							break;
						case 'quote' :
							printf(
								'<div class="et_quote_content%2$s"%3$s>
									%1$s
								</div> <!-- .et_quote_content -->',
								et_get_blockquote_in_content(),
								esc_attr( $text_color_class ),
								$inline_style
							);

							break;
						case 'link' :
							printf(
								'<div class="et_link_content%3$s"%4$s>
									<a href="%1$s" class="et_link_main_url">%2$s</a>
								</div> <!-- .et_link_content -->',
								esc_url( et_get_link_url() ),
								esc_html( et_get_link_url() ),
								esc_attr( $text_color_class ),
								$inline_style
							);

							break;
						case 'gallery' :
							echo '<div class="container no-border pb0">';
								et_pb_gallery_images();
							echo '</div>';

							break;
						case 'video' :
							if ( false !== ( $first_video = et_get_first_video() ) ) {
								printf(
									'<div class="et_main_video_container">
										%1$s
									</div>',
									$first_video
								);
							} 
							
							break;
					}
				?>

				<div class="entry-content np">
					<div class="container no-border">
					<?php
						do_action( 'et_before_content' );

						if ($post_format == 'video') {
							echo '<h1 class="mb20">'. get_the_title() . '</h1>';
						}

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
				</div>
				</div> <!-- .entry-content -->
				<div class="et_post_meta_wrapper">
					<div class="container no-border np">
						<div class="share-bar">
							<ul class="et-social-icons">
								<li class="nm"><strong>Share Story</strong></li>
								<li class="et-social-icon et-social-linkedin">
									<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class="icon" target="_blank">
										<span>Linkedin</span>
									</a>
								</li>
								<li class="et-social-icon et-social-facebook">
									<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="icon" target="_blank">
										<span>Facebook</span>
									</a>
								</li>
								<li class="et-social-icon et-social-twitter">
									<a href="https://twitter.com/share?url=<?php the_permalink(); ?>" class="icon" target="_blank">
										<span>Twitter</span>
									</a>
								</li>
							</ul>
						</div>
					<?php
					if ( et_get_option('divi_468_enable') == 'on' ){
						echo '<div class="et-single-post-ad">';
						if ( et_get_option('divi_468_adsense') <> '' ) echo( et_get_option('divi_468_adsense') );
						else { ?>
							<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
				<?php 	}
						echo '</div> <!-- .et-single-post-ad -->';
					}
				?>

					<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>
					<ul class="sticky-share-bar">
						<li class="et_pb_social_icon et_pb_social_network_link et-social-linkedin">
							<a id="linkedin-share" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class="icon circle" title="LinkedIn"><span>LinkedIn</span></a>			
						</li>
						<li class="et_pb_social_icon et_pb_social_network_link et-social-facebook">
							<a id="facebook-share" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="icon circle" title="Facebook"><span>Facebook</span></a>			
						</li>
						<li class="et_pb_social_icon et_pb_social_network_link et-social-twitter">
							<a id="twitter-share" target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" class="icon circle" title="Twitter"><span>Twitter</span></a>
						</li>
					</ul>
				</div> <!-- .et_post_meta_wrapper -->
			</article> <!-- .et_pb_post -->

			<div class="container np no-border mb20">
			<?php
				$categories = get_the_category();
				$category_id = $categories[0]->cat_ID;

				$args = array( 
					'posts_per_page' => 2, 
					'cat' => $category_id,
					'post__not_in' => array(get_the_ID()),
				);
				$related = new WP_Query( $args );

				if ( $related->have_posts() ) : ?>
					<div class="et_pb_row et_pb_equal_columns w-100 mb20">
					<?php while ( $related->have_posts() ) : $related->the_post(); ?>					
						<div class="post-card et_pb_column et_pb_column_1_2">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('blog_preview', ['class' => 'w-100']); ?>
							</a>
							<div class="card-content">
								<div class="text-gray uppercase fsize16">
									<?php
									$posttags = get_the_tags();
									$resultstr = array();
									if ($posttags) :
									  foreach($posttags as $tag) {
									    $resultstr[] = $tag->name; 
									  }
									  echo implode(", ",$resultstr);
									endif;
									?>
								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<a  class="card-more-button" href="<?php the_permalink(); ?>">Read More →</a>
							</div>
						</div>
					<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>

		<?php endwhile; ?>
		</div> <!-- #main-area -->
	</div> <!-- #content-area -->
</div> <!-- #main-content -->

<?php get_footer(); ?>