<?php

/******************************************************
 *
 * 管理画面で使用したいcss・jsを読み込む
 *
 *******************************************************/
add_action('admin_menu', 'add_dashboard');
function add_dashboard()
{
	add_action('admin_enqueue_scripts', 'my_admin_style');
	add_action('admin_enqueue_scripts', 'my_admin_script');
}

// 管理画面 css
function my_admin_style()
{
	if (!empty($_GET['page']) && strpos($_GET['page'], 'custom') !== false) {
		wp_enqueue_style('admin', get_template_directory_uri() . '/src/css/admin.css');
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '', 'all');
		wp_enqueue_style('font-Noto', 'https://fonts.googleapis.com/css?family=Noto+Sans+JP', array(), '', 'all');
	}
}

// 管理画面 js
function my_admin_script()
{
	if (!empty($_GET['page']) && strpos($_GET['page'], 'custom') !== false) {
		wp_enqueue_media();
		wp_enqueue_script('postcode', 'https://postcode-jp.appspot.com/js/postcodejp.js', array('jquery'), false, true);
		wp_enqueue_script('admin', get_template_directory_uri() . '/src/js/admin.js', array('jquery'), false, true);
		wp_enqueue_script('admin_custom', get_template_directory_uri() . '/src/js/admin_custom.js', array('jquery'), false, true);
	}
}



/******************************************************
 *
 * フロント画面で使用したいcss・jsを読み込む
 *
 *******************************************************/
add_action('wp_enqueue_scripts', 'my_frontend_files');
function my_frontend_files()
{

	$dir    = get_template_directory_uri() . '/src/';

	wp_enqueue_style('style',     $dir . 'css/style.css', array(), '', 'all');
	wp_enqueue_style('style_custom',     $dir . 'css/admin.css', array(), '', 'all');
	wp_enqueue_style('swipe_css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.min.css', array(), '', 'all');


	wp_enqueue_script('jquery');
	wp_enqueue_script('scroll',      $dir . 'js/iscroll-lite.js',       array('jquery'), '', true);
	wp_enqueue_script('drawer',      $dir . 'js/drawer.js',             array('jquery'), '', true);
	wp_enqueue_script('bootstrap',   $dir . 'js/bootstrap.min.js',      array('jquery'), '', true);
	wp_enqueue_script('matchHeight', $dir . 'js/jquery.matchHeight.js', array('jquery'), '', true);
	wp_enqueue_script('swipe_js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js',  array('jquery'), '', true);
	wp_enqueue_script('func',        $dir . 'js/func.js',               array('jquery'), '', true);
}



/******************************************************
 *
 * JavaScriptでtype属性を消してdeferを追加
 *
 *******************************************************/
function replace_script_tag($tag)
{
	return str_replace("type='text/javascript'", '', $tag);
}
add_filter('script_loader_tag', 'replace_script_tag');
