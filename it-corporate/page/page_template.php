<?php
/*
Template Name: サイドバー右側
*/
?>
<?php if (have_posts()) : the_post(); ?>

	<main>

		<div class="sub_key">
			<h1 class="title"><span class=""><?php echo esc_html(get_the_title()); ?></span></h1>
		</div>

		<div class="container box_pd_xl">
			<div class="maxw740 center-block">
				<?php the_content(); ?>
			</div>
		</div>

	</main>

<?php endif; ?>