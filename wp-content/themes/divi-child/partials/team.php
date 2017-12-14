<?php

$args = array( 
	'posts_per_page'	=> -1,
	'post_type' 		=> 'team',
	'meta_key'			=> 'weight',
	'orderby'			=> 'meta_value',
	'order'				=> 'DESC'
);
$loop = new WP_Query( $args );

if ( $loop->have_posts() ) : ?>
	<div id="team-masonry" class="card-deck">

		<?php $post_position = 0; ?>
		<?php $type_position = ''; ?>
		<?php $row_position = 0; ?>
		<?php $type_row = ''; ?>
		<?php while ( $loop->have_posts() ) : 
			$loop->the_post(); 
			
			$post_position += 1;
			if(($post_position % 2) == 0){
				$type_position = 'even';
			}else{
				$type_position = 'odd';
				$row_position += 1;
			}

			if(($row_position % 2) == 0){
				$type_row = 'row-even';
			}else{
				$type_row = 'row-odd';
			}

			$image = get_the_post_thumbnail_url(get_the_ID(), 'medium'); 
			$icon = get_field('icon');
			$content = get_the_content();
			$content = wp_filter_nohtml_kses($content); // this removes all html tags
			$linkedin = get_field('linkedin');
			$mail = get_field('email');

			if ($image && $content) : ?>

				<div class="card team-card <?php echo $type_position . 
						 ' ' . 
						 'row-' . $row_position . 
						 ' ' . 
						 $type_row;
						 // if($post_position==1): echo " active"; endif
					?>"

					 data-post_id="<?php the_ID(); ?>"
					 data-name="<?php the_title(); ?>"
					 data-position="<?php the_field('position'); ?>"
					 data-description="<?php echo $content; ?>"
					 data-picture="<?php echo $image; ?>"
					 data-email="<?php the_field('email'); ?>"
					 data-linkedin="<?php the_field('linkedin'); ?>"
					 data-post-position="<?php echo $post_position; ?>"
				><!-- start content -->


					<div class="card-img">
						<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
					</div>
					<div class="card-content">
						<div class="default">
							<?php 
								if(!empty($icon)): ?>
									<img src="<?php echo $icon['url'] ?>" alt="">
							<?php endif; ?>
							
							<h3 class="card-title"><?php the_title() ?></h3>
							<h5 class="card-position"><?php the_field('position'); ?></h5>
						</div>
						<div class="active">
							<h3 class="card-title"><?php the_title() ?></h3>
							<h5 class="card-position"><?php the_field('position'); ?></h5>
							<p class="description"><?php echo $content; ?></p>
							
							<div class="profile-social-icons">
								<?php 
									if(!empty($linkedin)): ?>
										<a href="<?php echo $linkedin; ?>" class="icon" target="_blank">
											<i class="fa fa-linkedin" aria-hidden="true"></i>
										</a>
								<?php endif; ?>
								
								<?php 
									if(!empty($mail)): ?>
										<a href="mailto:<?php echo $mail; ?>" class="icon" target="_top">
											<i class="fa fa-envelope" aria-hidden="true"></i>
										</a>
								<?php endif; ?>
								
							</div>
							
						</div>
					</div>


				</div> <!-- close content -->
			
			<?php endif; 
		endwhile; ?>

		<!-- <div class="card boxed verticaly-centered">
 			<div class="card-content">
 				<h3 class="card-title fsize28"><strong>Join The Team</strong></h3>
 				<p class="fsize20 mb20">We are looking for talent</p>
 				<a href="/positions" class="fsize18">View Open Positions →</a>
 			</div>
 		</div> -->

	</div>
<?php 
endif;

?>