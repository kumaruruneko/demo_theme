<!DOCTYPE html>
<html lang="ja">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include_once(theme_dir() . 'tmp/variable.php'); ?>
	<?php
	wp_head();

	?>
</head>

<?php $side = get_post_meta($post->ID, '_cmb2_sidebar', true); ?>

<body class="drawer drawer--left theme_<?php echo $site_color; ?> fs<?php echo $site_font; ?> <?php echo $side; ?> <?php echo $layout_s; ?> <?php echo $font_type; ?>">

	<header class="header <?php echo $head_position; ?> <?php echo $follow_head; ?>">

		<div class="logo">
			<a href="<?php echo home(); ?>">
				<?php echo $logo_img; ?>
			</a>
		</div>

		<nav class="drawer-nav">

			<ul class="drawer-menu ul_nav">
				<?php wp_nav_menu(array('items_wrap' => '%3$s', 'container' => 'false', 'menu' => 'global')); ?>

				<?php if (!empty($custom_top_page['outside'])) : ?>
					<li id="menu-item-93" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-93"><a href="<?php echo $custom_top_page['outside']; ?>">外部リンク</a></li>
				<?php endif; ?>
				<!-- <?php if (!empty($sns['facebook']) || !empty($sns['twitter']) || !empty($sns['insta'])) { ?>

																																																																																																																																																																																					<li class="sp_sns">
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
																																																																																																																																																																																					</li>

				<?php } ?> -->

			</ul>
		</nav>

		<div class="sp_btn">
			<a href="javascript: void(0)" class="drawer-toggle drawer-hamburger">
				<span class="sr-only">toggle navigation</span>
				<span class="drawer-hamburger-icon"></span>
			</a>
		</div>

	</header>