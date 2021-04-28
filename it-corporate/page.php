<?php

include_once(theme_dir() . 'header.php');


$folder = 'page/';
$slug   = $post->post_name;

// ページに親があるかどうか
$path = (!empty($post->post_parent)) ? $folder . get_page_uri($post->post_parent) . '/' . $slug : $folder . $slug;


// page-{slug名}がある時
if (locate_template('page-' . $slug . '.php') != '') {

	$page_file = 'page-' . $slug . '.php';
} elseif (locate_template($path . '.php') != '') {

	$page_file = $path . '.php';
} elseif (locate_template($path . '/index.php') != '') {

	// 固有のテンプレートがない場合はindex
	$page_file = $path . '/index.php';
}


if (empty($page_file)) {
	$page_file = $folder . 'page_template.php';
}


include_once(theme_dir() . $page_file);

?>
<?php get_sidebar(); ?>
<?php
echo '</div>'
?>
<?php
include_once(theme_dir() . 'footer.php');
