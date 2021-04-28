<?php
/*
Template Name: プランページのテンプレート
*/
?>
<?php include_once(theme_dir() . 'header.php'); ?>

<div class="sub_key">
	<h1 class="title">
		<span class=""><?php echo get_the_title(); ?></span><span class="sub"><?php $slug_name = 'サービス';
																																					echo $slug_name; ?></span></h1>
</div>
<div class="main_content">
	<main>


		<div class="container box_pd_lg">

			<?php
			$args = array(
				'post_status' => array('publish'),
				'post_type' => array('plans'),
				'orderby' => 'menu_order',
				'order' => 'asc',
				'posts_per_page' => 10,
				'paged' => get_query_var('paged'),
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
					if (!empty($post->plans_img_id)) {
						$img_obj = wp_get_attachment_image_src($post->plans_img_id, 'plans');
						$img_src = $img_obj[0];
						$img_alt = esc_html(get_the_title() . 'のプラン画像');
					} else {
						$img_src = img_dir() . 'common/noimage.png';
						$img_alt = '';
					}
					?>
					<div class="maxw740 plan_detail" id="<?php echo 'plan_' . get_the_ID(); ?>">
						<div class="img">
							<img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>" class="w100p block">
						</div>
						<div class="contents">
							<p class="title"><?php echo esc_html(get_the_title()); ?></p>
							<div class="text">
								<?php echo $post->plans_detail; ?>
							</div>
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
						</div>
					</div>
				<?php endwhile;
				else : ?>
				<p class="mgb0 text-center">まだプラン情報はありません。<br>更新まで今しばらくお待ち下さい。</p>
			<?php endif;
			wp_reset_postdata(); ?>

			<?php pagination($the_query->max_num_pages); ?>

		</div>

	</main>

	<?php get_sidebar(); ?>
	<?php
	echo '</div>'
	?>

	<?php include_once(theme_dir() . 'footer.php'); ?>