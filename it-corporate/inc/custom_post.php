<?php
/**
 * This file loads theme Functions and definitions.
 * @link		http://worldagent.jp/
 * @author		World agent
 * @copyright	Copyright (c) World agent
 **/

/******************************************************
 *
 * カスタムフィールド
 *
 *******************************************************/
if (file_exists(get_template_directory() . '/vendors/cmb2/init.php')) {
	require_once get_template_directory() . '/vendors/cmb2/init.php';
}
add_action('cmb2_admin_init', 'add_custom_meta_box');
function add_custom_meta_box()
{

	$cmb2_list = array(
		'plans' => array(
			array(
				'name' => 'TOPに表示',
				'desc' => '',
				'id'   => 'plans_top',
				'type'    => 'radio_inline',
				'options' => array(
					'display' => '表示する',
					'hide'    => '表示しない',
				),
				'default' => 'hide',
			),
			array(
				'name' => 'プラン画像',
				'desc' => '',
				'id'   => 'plans_img',
				'type' => 'file',
				'options' => array(
					'url' => false,
				),
				'text'    => array(
					'add_upload_file_text' => 'アップロード',
				),
				'query_args' => array(
					'type' => array(
						'image/gif',
						'image/jpeg',
						'image/png',
					),
				),
				'preview_size' => 'medium',
			),
			array(
				'name' => 'プラン補足1',
				'desc' => 'タイトル下（左側）',
				'id'   => 'plans_price',
				'type' => 'text',
			),
			array(
				'name' => 'プラン補足2',
				'desc' => 'タイトル下（右側）',
				'id'   => 'plans_time',
				'type' => 'text',
			),
			array(
				'name' => 'プラン詳細',
				'desc' => '',
				'id'   => 'plans_detail',
				'type' => 'wysiwyg',
				'options' => array(),
			),
		),
		'links' => array(
			array(
				'name' => 'リンクURL',
				'desc' => '',
				'id'   => 'links_url',
				'type' => 'text_url',
			),
		),
	);


	$plans_meta = new_cmb2_box(array(
		'id'            => 'plans_meta',
		'title'         => '詳細設定',
		'object_types'  => array('plans'),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	));
	foreach ($cmb2_list['plans'] as $key => $value) {
		$plans_meta->add_field($value);
	}

	$links_meta = new_cmb2_box(array(
		'id'            => 'links_meta',
		'title'         => 'リンク設定',
		'object_types'  => array('links'),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	));
	foreach ($cmb2_list['links'] as $key => $value) {
		$links_meta->add_field($value);
	}
}

// function cmb2_sidebar_metabox()
// {
// 	$cmb = new_cmb2_box(array(
// 		'id'           => 'cmb2_sidebar_metabox',
// 		'title'        => 'サイドバーレイアウト',
// 		'object_types' => array('post', 'page', 'plans'),
// 	));
// 	$cmb->add_field(array(
// 		'name' => '選択',
// 		'id'   => '_cmb2_sidebar',
// 		'type'    => 'radio_inline',
// 		'options' => array(
// 			'def' => '右側',
// 			'reverse' => '左側',
// 			'noside' => 'なし'
// 		),
// 		'default' => 'noside',
// 	));
// }
// add_action('cmb2_admin_init', 'cmb2_sidebar_metabox');



/******************************************************
 *
 * 投稿の名称変更
 *
 *******************************************************/
function change_post_menu_label()
{
	global $menu;
	global $submenu;
	$menu[5][0] = 'NEWS';
	$submenu['edit.php'][5][0] = 'NEWS 一覧';
	$submenu['edit.php'][10][0] = '新規追加';
	$submenu['edit.php'][15][0] = 'カテゴリ';
}
function change_post_object_label()
{
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'NEWS';
	$labels->singular_name = 'NEWS';
	$labels->add_new = _x('新規追加', 'NEWS');
	$labels->add_new_item = 'NEWSの新規追加';
	$labels->edit_item = 'NEWSの編集';
	$labels->new_item = '新規NEWS';
	$labels->view_item = 'NEWSを表示';
	$labels->search_items = 'NEWSを検索';
	$labels->not_found = '記事が見つかりませんでした';
	$labels->not_found_in_trash = 'ゴミ箱に記事は見つかりませんでした';


	global $wp_taxonomies;
	/* 投稿機能から「タグ」を削除 */
	if (!empty($wp_taxonomies['post_tag']->object_type)) {
		foreach ($wp_taxonomies['post_tag']->object_type as $i => $object_type) {
			if ($object_type == 'post') {
				unset($wp_taxonomies['post_tag']->object_type[$i]);
			}
		}
	}
	return true;
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');



/******************************************************
 *
 * カスタム投稿追加
 *
 *******************************************************/
add_action('init', 'add_post_type');
function add_post_type()
{
	register_post_type(
		'plans',
		array(
			'labels' => array(
				'name' => __('プラン'),
				'singular_name' => __('プラン')
			),
			'public'        => false,
			'show_ui'       => true,
			'has_archive'   => false,
			'menu_position' => 5,
			'supports'      => array('title'),
			'taxonomies'            => array(),
		)
	);

	register_post_type(
		'links',
		array(
			'labels' => array(
				'name' => __('リンク'),
				'singular_name' => __('リンク')
			),
			'public'        => false,
			'show_ui'       => true,
			'has_archive'   => false,
			'menu_position' => 5,
			'supports'      => array('title'),
			'taxonomies'            => array(),
		)
	);
}
