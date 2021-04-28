<?php if (!empty($reservation)) : ?>
	<div class="wrap_reserve">
		<a href="<?php echo $reservation; ?>" target="_blank" rel="noopener noreferrer"><span class="">RESERVATION</span><span class="jp">ご予約</span></a>
	</div>
<?php endif; ?>

<footer class="footer">
	<p class="foot_logo">
		<a href="<?php echo home(); ?>">
			<?php echo $logo; ?>
		</a>
	</p>


	<?php if (!empty($sns['facebook']) || !empty($sns['twitter']) || !empty($sns['insta'])) { ?>
		<ul class="ul_sns">
			<?php
				foreach ($sns as $key => $value) {
					if (!empty($value)) {
						if ($key == 'facebook') {
							echo '<li><a href="' . esc_url($value) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
						} elseif ($key == 'twitter') {
							echo '<li><a href="' . esc_url($value) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
						} elseif ($key == 'insta') {
							echo '<li><a href="' . esc_url($value) . '" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
						}
					}
				}
				?>
		</ul>
	<?php } ?>

	<ul class="foot_link">
		<?php
		if (has_nav_menu('footer')) : ?>
			<?php $menu_args = array('items_wrap' => '%3$s', 'container' => 'false', 'menu' => 'footer', 'fallback_cb' => 'false'); ?>
			<?php wp_nav_menu($menu_args); ?>
		<?php else : ?>
			<?php
				$args = array(
					'post_status' => array('publish'),
					'orderby' => 'ID',
					'post_type' => array('page'),
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
		<?php endif; ?>
	</ul>

	<p class="copyright">© Copyright 2018. <?php echo $logos['text']; ?> All rights reserved.</p>
</footer>

<?php wp_footer(); ?>
</body>

</html>