<?php
include_once(theme_dir() . 'header.php');

if (have_posts()) : the_post();
	?>
	<div class="sub_key">
		<p class="title"><span class="">NEWS</span><span class="sub">お知らせ</span></p>
	</div>
	<div class="main_content">
		<main class="single-post">


			<div class="container box_pd_lg">
				<div class="maxw740 center-block">
					<h1 class="title_page"><?php echo esc_html(get_the_title()); ?></h1>

					<p class="mgb30 text-right">
						<time datetime="<?php echo get_the_time('Y-m-d'); ?>" class="mgr10"><?php echo get_the_time('Y.m.d'); ?></time>
						<?php
							$post_taxonomy = 'category';
							$list_terms = get_the_terms($post->ID, $post_taxonomy);
							if (!is_wp_error($list_terms) && $list_terms !== false) {
								echo '<span class="label cat">' . $list_terms[0]->name . '</span>';
							}
							?>
					</p>

					<?php the_content(); ?>

					<hr class="mg_md">

					<p class="mgb0">
						<a href="javascript:void(0)" onclick="history.back(); return false;" class="btn_clear">戻る</a>
					</p>


				</div>
			</div>
		</main>


	<?php
	endif;
	include_once(theme_dir() . 'sidebar.php');
	?>
	<?php
	echo '</div>'
	?>
	<?php
	include_once(theme_dir() . 'footer.php');
	?>