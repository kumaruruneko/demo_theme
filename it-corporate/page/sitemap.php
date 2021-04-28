<div class="sub_key">
	<h1 class="title"><span class="">SITEMAP</span><span class="sub">サイトマップ</span></h1>
</div>

<div class="main_content">
	<main>

		<div class="container box_pd_lg">
			<div class="maxw740 center-block">

				<ul class="ul_flex">
					<li>
						<a href="<?php echo home(); ?>">TOP</a>
					</li>

					<?php
					$sitemap_obj = get_page_by_path('sitemap');
					$args = array(
						'post_status' => array('publish'),
						'orderby' => 'ID',
						'post_type' => array('page'),
						'post__not_in' => array($sitemap_obj->ID),
						'posts_per_page' => -1,
						'no_found_rows' => true,
					);
					$the_query = new WP_Query($args);
					if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
							?>

							<li><a href="<?php echo home() . urlencode($post->post_name) . '/'; ?>"><?php echo esc_html(get_the_title()); ?></a></li>

					<?php endwhile;
					endif;
					wp_reset_postdata(); ?>

				</ul>

			</div>
		</div>

	</main>