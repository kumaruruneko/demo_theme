	<div class="sub_key">
		<h1 class="title"><span class="">NEWS</span><span class="sub">お知らせ</span></h1>
	</div>
	<div class="main_content">
		<main>
			<div class="container box_pd_xl">
				<ul class="ul_news">

					<?php
					$args = array(
						'post_status' => array('publish'),
						'post_type' => array('post'),
						'posts_per_page' => 10,
						'paged' => get_query_var('paged'),
					);
					$the_query = new WP_Query($args);
					if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
							?>

							<li>
								<a href="<?php the_permalink(); ?>">
									<span class="time">
										<time datetime="<?php echo get_the_time('Y-m-d'); ?>"><?php echo get_the_time('Y.m.d'); ?></time>
										<?php
												$post_taxonomy = 'category';
												$list_terms = get_the_terms($post->ID, $post_taxonomy);
												if (!is_wp_error($list_terms) && $list_terms !== false) {
													echo '<span class="label cat">' . $list_terms[0]->name . '</span>';
												}
												?>
									</span>
									<span class="contents">
										<span class="bold"><?php echo esc_html(get_the_title()); ?></span>
										<span class="block text"><?php echo get_the_excerpt(); ?></span>
									</span>
								</a>
							</li>

						<?php endwhile;
						else : ?>
						<li>
							<p class="mgt30 mgb30 text-center">まだ新着情報はありません。</p>
						</li>
					<?php endif;
					wp_reset_postdata(); ?>

				</ul>

				<?php pagination($the_query->max_num_pages); ?>
			</div>

		</main>