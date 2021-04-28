<main>

	<div class="sub_key">
		<h1 class="title"><span class="">LINK</span><span class="sub">リンク集</span></h1>
	</div>

	<div class="container box_pd_lg">
		<div class="maxw740 center-block">

			<ul class="ul_flex">

				<?php
				$args = array(
					'post_status' => array('publish'),
					'orderby' => 'ID',
					'post_type' => array('links'),
					'posts_per_page' => -1,
					'no_found_rows' => true,
				);
				$the_query = new WP_Query($args);
				if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
						?>

						<li><a href="<?php echo esc_url($post->links_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(get_the_title()); ?></a></li>

				<?php endwhile;
				endif;
				wp_reset_postdata(); ?>

			</ul>

		</div>
	</div>

</main>