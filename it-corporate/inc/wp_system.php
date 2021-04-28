<?php
/**
 * This file loads theme Functions and definitions.
 * @link		http://worldagent.jp/
 * @author		World agent
 * @copyright	Copyright (c) World agent
**/

/******************************************************
*
* ダッシュボードのカスタマイズ
*
*******************************************************/
// 編集者に設定権限を付与
function add_theme_caps() {
	$role = get_role( 'editor' );
	$role->add_cap( 'manage_options' );
}
add_action( 'admin_init', 'add_theme_caps');
// 特権管理者以外「参加サイト」項目を削除
function remove_admin_bar_menu( $wp_admin_bar ) {
	if ( !current_user_can('manage_network') ) {
		$wp_admin_bar->remove_menu( 'my-sites' ); // 参加サイト
	}
}
// add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 70 );
function remove_admin_sub_menu () {
	if ( !current_user_can('manage_network') ) {
		global $submenu;
		unset($submenu['index.php'][5]); // 参加サイト
	}
}
// add_action('admin_menu', 'remove_admin_sub_menu');
// 初期設定がまだのとき管理バーを非表示
function remove_admin_bar_all($WP_Admin_Bar) {
	$setting = get_option( 'initial_setting' );
	if( is_network_admin() || !empty($setting) ){
		return $WP_Admin_Bar;
	}
}
// add_filter( 'wp_admin_bar_class' , 'remove_admin_bar_all');
// 初期設定がまだのとき管理メニューを非表示
function remove_admin_menu_all ($menu) {
	$setting = get_option( 'initial_setting' );
	if( !is_network_admin() && empty($setting) ){
		return array();
	}
	return $menu;
}
// add_filter('add_menu_classes', 'remove_admin_menu_all');
// 初期設定がまだのときフッターを非表示
function remove_admin_footer_all ($menu) {
	$setting = get_option( 'initial_setting' );
	if( !is_network_admin() && empty($setting) ){
		return false;
	}
	return $menu;
}
// add_filter( 'admin_footer_text', 'remove_admin_footer_all' );
// add_filter( 'update_footer', 'remove_admin_footer_all' );
// 初期設定がまだのときのCSS
function my_custom_admin_head() {
	$setting = get_option( 'initial_setting' );
	if( !is_network_admin() && empty($setting) ){
		remove_filter('update_footer', 'core_update_footer');
		echo <<<__HTML__
<style>
html.wp-toolbar{
	padding-top: 0;
}
#adminmenumain,#wpfooter{
	display: none !important;
}
#wpcontent{
	margin:auto;
	padding:20px;
}
#wpbody-content{
	padding-bottom:0;float:none;
}
#custom_contents form{
	margin-bottom:0;
}
.wrap{
	margin:0;
}
</style>
__HTML__;
	}
}
//add_action( 'admin_head', 'my_custom_admin_head' );
// 初期設定がまだのときの設定画面へリダイレクト
function restrict_admin_with_redirect() {
	$setting = get_option( 'initial_setting' );
	if( !is_network_admin() && empty($setting) ){
		global $pagenow;
		if( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ){
			if( $pagenow != 'admin.php' || empty($_GET['page']) || $_GET['page'] != 'custom_initial_setting' ){
				wp_redirect( admin_url( 'admin.php?page=custom_initial_setting' ) );
				exit;
			}
		}
	}
}
//add_action( 'admin_init', 'restrict_admin_with_redirect', 1 );

// 初期設定がまだのときのログイン画面へリダイレクト
function restrict_front_with_redirect() {
	$setting = get_option( 'initial_setting' );
	if( empty($setting) ){
		global $pagenow;
		if( !is_admin() && strpos($pagenow, 'login') === false ){
			wp_redirect(wp_login_url());
			exit;
		}
	}
}
//add_action( 'after_setup_theme', 'restrict_front_with_redirect', 1 );