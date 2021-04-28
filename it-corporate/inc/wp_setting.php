<?php
/**
 * This file loads theme Functions and definitions.
 * @link		http://worldagent.jp/
 * @author		World agent
 * @copyright	Copyright (c) World agent
**/

/******************************************************
*
* 管理バーを非表示にする
*
*******************************************************/
function my_function_admin_bar(){
	return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');


/******************************************************
*
* 特定のテーマ機能をサポートする
*
*******************************************************/
function original_theme_setup() {
	// コメントフォーム、検索フォーム等をHTML5のマークアップに
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	// タイトルタグ追加
	add_theme_support( 'title-tag' );
	// 投稿キャプチャー画像を追加。
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(150, 150, true);
	add_image_size( 'plans', 380, 280, false );
}
add_action( 'after_setup_theme', 'original_theme_setup' );


/******************************************************
*
* タイトルのセパレーター変更
*
*******************************************************/
function custom_title_separator($sep) {
	$sep = ' | ';
	return $sep;
}
add_filter( 'document_title_separator', 'custom_title_separator' );


/******************************************************
*
* 固定ページの画像パスを相対パスへ
*
*******************************************************/
function replaceImagePath($arg) {
	$content = str_replace('"img/', '"' . get_bloginfo('template_directory') . '/src/img/', $arg);
	return $content;
}
add_action('the_content', 'replaceImagePath');


/******************************************************
*
* 固定ページのみ自動整形機能を無効化します。
*
*******************************************************/
function disable_page_wpautop() {
	if ( is_page() ) remove_filter( 'the_content', 'wpautop' );
}
add_action( 'wp', 'disable_page_wpautop' );


/******************************************************
*
* 本文からの抜粋機能
*
*******************************************************/
// 抜粋字数を指定する
function custom_excerpt_length( $length ) {

	if( is_home() || is_front_page() ){
		$return = 45;
	}else{
		$return = 70;
	}
		return $return;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// 本文からの抜粋末尾の文字列を指定する
function custom_excerpt_more($more) {
		return '・・・';
}
add_filter('excerpt_more', 'custom_excerpt_more');


/******************************************************
*
* テキストエディタにフォントサイズ変更ボタン追加
*
*******************************************************/
function editor_add_buttons($array) {
	array_push($array, 'fontsizeselect');
	return $array;
}
add_filter('mce_buttons', 'editor_add_buttons');


/******************************************************
*
* ビジュアルエディタ設定
*
*******************************************************/
function customize_tinymce_settings($array) {
	$array['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 42px 48px';
	$array['valid_elements']          = '*[*]';
	$array['extended_valid_elements'] = '*[*]';
	$array['verify_html'] = false;
	return $array;
}
add_filter( 'tiny_mce_before_init', 'customize_tinymce_settings' );

add_action('init', function() {
	remove_filter('the_title', 'wptexturize');
	remove_filter('the_content', 'wptexturize');
	remove_filter('the_excerpt', 'wptexturize');
	remove_filter('the_title', 'wpautop');
	remove_filter('the_content', 'wpautop');
	remove_filter('the_excerpt', 'wpautop');
	remove_filter('the_editor_content', 'wp_richedit_pre');
});

add_filter('tiny_mce_before_init', function($init) {
	$init['wpautop'] = false;
	$init['indent'] = true;
	return $init;
});


/******************************************************
*
* wordpressの不要な記述を削除
*
*******************************************************/
function disable_emoji() {
	// 特殊記号 画像変換を停止
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// ？
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'rsd_link');
}
add_action( 'init', 'disable_emoji' );


/******************************************************
*
* 投稿画面のカテゴリの順番を変えない
*
*******************************************************/
function my_wp_terms_checklist_args( $args, $post_id ){
	$args['checked_ontop'] = false;
	return $args;
}
add_filter('wp_terms_checklist_args', 'my_wp_terms_checklist_args',10,2);


/******************************************************
*
* 自動保存機能無効
*
*******************************************************/
function disable_autosave() {
	wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disable_autosave' );


/******************************************************
*
* セキュリティ関連
*
*******************************************************/
// WordPressバージョン情報を消す
function remove_wp_version() {
	remove_action('wp_head','wp_generator');
}
add_action( 'init', 'remove_wp_version' );

// スタイル・スクリプトのバージョン情報を消す
function remove_src_ver( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
		return $src;
}
add_filter( 'style_loader_src', 'remove_src_ver', 9999 );
add_filter( 'script_loader_src', 'remove_src_ver', 9999 );


// 不要なページを無効化
function custom_handle_404() {
	if( !is_admin() ){
		if ( is_search() || is_author() || is_attachment() ){
			global $wp_query;
			$wp_query->set_404();
			status_header( 404 );
			nocache_headers();
		}
	}
}
add_action( 'template_redirect', 'custom_handle_404' );


/******************************************************
*
* テーマ有効時 自動で固定ページ作成
*
*******************************************************/
function auto_create_page() {

	$page_slug = array(
		'sitemap'   => 'SITEMAP',
		'privacy'   => 'PRIVACY POLICY',
		'link'      => 'LINK',
		'contact'   => 'CONTACT',
		'salon'     => 'SALON',
		'treatment' => 'TREATMENT',
		'news'      => 'NEWS',
	);
	foreach ($page_slug as $slug => $value) {

		if ( is_array( $value ) ) {

			$parent_id = exist_page('page', $slug);

			if ( !$parent_id ) {
				$args = array(
					'post_type'   => 'page',
					'post_title'  => $value[0],
					'post_name'   => $slug,
					'post_status' => 'publish'
				);
				$parent_id = wp_insert_post( $args );
			}

			foreach ($value[1] as $child_slug => $child_title) {

				if ( !exist_page( 'page', $child_slug, $parent_id ) ) {
					$args = array(
						'post_type'   => 'page',
						'post_title'  => $child_title,
						'post_name'   => $child_slug,
						'post_status' => 'publish',
						'post_parent' => $parent_id
					);
					wp_insert_post( $args );
				}

			}

		} else {
			if ( !exist_page('page', $slug) ) {
				$args = array(
					'post_type'   => 'page',
					'post_title'  => $value,
					'post_name'   => $slug,
					'post_status' => 'publish'
				);
				wp_insert_post( $args );
			}
		}

	}

}
add_action( 'after_switch_theme', 'auto_create_page' );


/******************************************************
*
* クエリ書き換え
*
*******************************************************/
// function my_default_query( $query ) {
// 	if ( is_admin() || ! $query->is_main_query() ){
// 		return;
// 	}
// 	if ( is_home() ) {
// 		$query->set( 'posts_per_page', 1 );
// 		return;
// 	}
// }
// add_action( 'pre_get_posts', 'my_default_query', 1 );