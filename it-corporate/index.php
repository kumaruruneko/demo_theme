<?php include_once(theme_dir() . 'header.php'); ?>

<main>
	<!-- ### empty or flex_center or flex_right ### -->
	<div class="mv">
		<?php if (!empty($slide_01) && empty($slide_02) && empty($slide_03) && empty($slide_04) && empty($slide_05)) : ?>
			<div class="swiper-slide">
				<h1 class="<?php echo $font; ?>"><?php echo $logo_text; ?></h1>
				<span><?php echo $slide_01_src ?></span>
			</div>
		<?php else : ?>
			<section class="d-flex align-items-center" id="head">
				<div class="swiper-container">
					<!-- 全スライドをまとめるラッパー -->
					<div class="swiper-wrapper">
						<h1><?php echo $logo_text; ?></h1>
						<!-- 各スライド -->

						<?php if (!empty($slide_01_src)) : ?>
							<div class="swiper-slide">
								<span><?php echo $slide_01_src ?></span>
							</div>
						<?php endif; ?>
						<?php if (!empty($slide_02_src)) : ?>
							<div class="swiper-slide">
								<span><?php echo $slide_02_src ?></span>
							</div>
						<?php endif; ?>
						<?php if (!empty($slide_03_src)) : ?>
							<div class="swiper-slide">
								<span><?php echo $slide_03_src ?></span>
							</div>
						<?php endif; ?>
						<?php if (!empty($slide_04_src)) : ?>
							<div class="swiper-slide">
								<span><?php echo $slide_04_src ?></span>
							</div>
						<?php endif; ?>
						<?php if (!empty($slide_05_src)) : ?>
							<div class="swiper-slide">
								<span><?php echo $slide_05_src ?></span>
							</div>
						<?php endif; ?>


					</div>

					<!-- ページネーションを表示する場合 -->
					<div id="swiper-pagination" class="swiper-pagination"></div>



					<!-- 前後スライドへのナビゲーションボタン(矢印)を表示する場合 -->

					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>


				</div>


			</section>
		<?php endif; ?>


	</div>


	<?php
	$args = array(
		'post_status' => array('publish'),
		'post_type' => array('plans'),
		'orderby' => 'menu_order',
		'order' => 'asc',
		'posts_per_page' => -1,
		'no_found_rows' => true,
		'meta_query' => array(
			array(
				'key' => 'plans_top',
				'value' => 'display',
				'compare' => '='
			)
		),
	);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :
		?>
		<section class="container box_pd_lg">
			<?php $options = get_option(mySettingPage::getKey()); ?>
			<h2 class="sec_title"><?php echo esc_html($options['item1']); ?><span class="jp"><?php echo esc_html($options['item2']); ?></span></h2>

			<div class="row">

				<?php while ($the_query->have_posts()) : $the_query->the_post();
						if (!empty($post->plans_img_id)) {
							$img_obj = wp_get_attachment_image_src($post->plans_img_id, 'plans');
							$img_src = $img_obj[0];
							$img_alt = esc_html(get_the_title() . 'のプラン画像');
						} else {
							$img_src = img_dir() . 'common/noimage.png';
							$img_alt = '';
						}
						?>
					<div class="col-xs-12 col-sm-4 box_plan">
						<a href="<?php echo home() . 'service/#plan_' . get_the_ID(); ?>">
							<img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>" class="w100p block">
							<p class="title"><?php echo esc_html(get_the_title()); ?></p>
							<p class="price">
								<?php
										if (!empty($post->plans_price)) {
											echo esc_html($post->plans_price);
										}
										if (!empty($post->plans_time)) {
											if (!empty($post->plans_price)) {
												echo "&ensp;/&ensp;";
											}
											echo esc_html($post->plans_time);
										}
										?>
							</p>
						</a>
					</div>
				<?php endwhile; ?>

			</div>

			<p class="mgb0 box_pd_md box_pdb0">
				<a href="<?php echo home() . mb_strtolower($options['item1']); ?>/" class="btn_clear"><?php echo esc_html($options['item2']); ?>一覧</a>
			</p>
		</section>
	<?php endif;
	wp_reset_postdata(); ?>


	<?php if (!empty($movie['youtube_URL'])) : ?>
		<section class="box_pd_lg bg_gywhite youtube">
			<div class="container">
				<h2 class="sec_title mgb_sm"><?php echo $movie['youtube_title']; ?><span class="jp"><?php echo $movie['youtube_subtitle']; ?></span></h2>

				<div class="box_youtube">
					<?php echo wp_oembed_get(esc_url($movie['youtube_URL'])); ?>
					<iframe width="500" height="281" src="<?php echo $movie['youtube_URL']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div>
			</div>
			</div>
		</section>

	<?php endif; ?>

	<section class="wrap_service">
		<div class="img" style="background-image: url('<?php echo $subimg; ?>')"><?php echo $service_src ?></div>
		<div class="contents">
			<div class="inner">
				<h2 class="sec_title mgb_xs left"><?php echo $service['service_title']; ?><span class="jp"><?php echo $service['service_disc']; ?></span></h2>
				<p class="text">
					<?php echo nl2br($service['service_text']); ?>
				</p>
			</div>
		</div>
	</section>



	<section class="container box_pd_lg">
		<h2 class="sec_title">NEWS<span class="jp">お知らせ</span></h2>

		<ul class="ul_news mgb0">

			<?php
			$args = array(
				'post_status' => array('publish'),
				'post_type' => array('post'),
				'posts_per_page' => 5,
				'no_found_rows' => true,
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
							<span class="contents"><?php echo esc_html(get_the_title()); ?></span>
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

		<?php if ($the_query->have_posts()) : ?>
			<p class="mgb0 box_pd_md box_pdb0">
				<a href="<?php echo home() . 'news/'; ?>" class="btn_clear">お知らせ一覧</a>
			</p>
		<?php endif; ?>

	</section>

</main>



<?php include_once(theme_dir() . 'footer.php'); ?>