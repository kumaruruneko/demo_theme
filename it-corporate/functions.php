<?php
/**
 * This file loads theme Functions and definitions.
 * @link		http://worldagent.jp/
 * @author		World agent
 * @copyright	Copyright (c) World agent
 **/

/******************************************************
 *
 * デバッグ用
 *
 *******************************************************/
function pr($data)
{
	echo "<pre>";
	// ob_start();
	var_dump($data);
	// $d = ob_get_clean();
	// echo htmlspecialchars( $d , ENT_QUOTES );
	echo "</pre>";
}


/******************************************************
 *
 * インクルード
 *
 *******************************************************/
// wordpressの基本設定
require_once locate_template('inc/wp_setting.php');
// スタイル・スクリプトの設定
require_once locate_template('inc/style_script.php');
// カスタム投稿
require_once locate_template('inc/custom_post.php');
// 管理画面の設定
require_once locate_template('inc/custom_admin.php');
// ダッシュボードの基本設定
require_once locate_template('inc/wp_system.php');
// SEOの設定
require_once locate_template('inc/seo.php');


/******************************************************
 *
 * デバイス判定
 *
 *******************************************************/
function is_iphone()
{
	$is_iphone = (bool)strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
	if ($is_iphone) {
		return true;
	} else {
		return false;
	}
}
function is_android()
{
	$is_android = (bool)strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
	if ($is_android) {
		return true;
	} else {
		return false;
	}
}
function is_ipad()
{
	$is_ipad = (bool)strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
	if ($is_ipad) {
		return true;
	} else {
		return false;
	}
}
function is_kindle()
{
	$is_kindle = (bool)strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle');
	if ($is_kindle) {
		return true;
	} else {
		return false;
	}
}
function is_mobile()
{
	$useragents = array(
		'iPhone',          // iPhone
		'iPod',            // iPod touch
		'Android',         // 1.5+ Android
		'dream',           // Pre 1.5 Android
		'CUPCAKE',         // 1.5+ Android
		'blackberry9500',  // Storm
		'blackberry9530',  // Storm
		'blackberry9520',  // Storm v2
		'blackberry9550',  // Storm v2
		'blackberry9800',  // Torch
		'webOS',           // Palm Pre Experimental
		'incognito',       // Other iPhone browser
		'webmate'          // Other iPhone browser
	);
	$pattern = '/' . implode('|', $useragents) . '/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
function isBot()
{
	$bot_list = array(
		'Googlebot',
		'Yahoo! Slurp',
		'Mediapartners-Google',
		'msnbot',
		'bingbot',
		'MJ12bot',
		'Ezooms',
		'pirst; MSIE 8.0;',
		'Google Web Preview',
		'ia_archiver',
		'Sogou web spider',
		'Googlebot-Mobile',
		'AhrefsBot',
		'YandexBot',
		'Purebot',
		'Baiduspider',
		'UnwindFetchor',
		'TweetmemeBot',
		'MetaURI',
		'PaperLiBot',
		'Showyoubot',
		'JS-Kit',
		'PostRank',
		'Crowsnest',
		'PycURL',
		'bitlybot',
		'Hatena',
		'facebookexternalhit',
		'NINJA bot',
		'YahooCacheSystem',
	);
	$is_bot = false;
	foreach ($bot_list as $bot) {
		if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
			$is_bot = true;
			break;
		}
	}
	return $is_bot;
}


/******************************************************
 *
 * カテゴリー リンクを表示
 *
 *******************************************************/
function ahrcive_link($slug)
{
	if (empty($slug)) {
		return;
	}
	$category_id = get_category_by_slug($slug);
	$category_link = get_category_link($category_id->cat_ID);
	echo esc_url($category_link);
}


/******************************************************
 *
 * 親子関係のページ判定
 *
 *******************************************************/
function is_tree($slug)
{
	global $post;
	if (empty($slug)) {
		return;
	}
	$postlist = get_posts(array('posts_per_page' => 1, 'name' => $slug, 'post_type' => 'page'));
	$pageid = array();
	foreach ($postlist as $list) {
		$pageid[] = $list->ID;
	}
	if (is_page($slug)) return true;
	$anc = get_post_ancestors($post->ID);
	foreach ($anc as $ancestor) {
		if (is_page() && in_array($ancestor, $pageid)) {
			return true;
		}
	}
	return false;
}


/******************************************************
 *
 * 固定ページで親をもっているか判定
 *
 *******************************************************/
function is_subpage()
{
	global $post;
	if (is_page() && $post->post_parent) {
		$parentID = $post->post_parent;
		return $parentID;
	} else {
		return false;
	};
};


/******************************************************
 *
 * 画像までのパス
 *
 *******************************************************/
function img_dir()
{
	return get_template_directory_uri() . '/src/img/';
}


/******************************************************
 *
 * テーマまでの絶対パス
 *
 *******************************************************/
function theme_dir()
{
	return get_template_directory() . '/';
}


/******************************************************
 *
 * トップのurl
 *
 *******************************************************/
function home()
{
	return esc_url(home_url('/'));
}



/******************************************************
 *
 * ページネーション
 *
 *******************************************************/
function pagination($pages = '', $range = 2)
{
	$showitems = ($range * 2) + 1;

	global $paged;
	if (empty($paged)) $paged = 1;

	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (!$pages) {
			$pages = 1;
		}
	}

	if (1 != $pages) {
		echo "<div class='pagination'>";
		// if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i></a>";

		for ($i = 1; $i <= $pages; $i++) {
			if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				echo ($paged == $i) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged + 1) . "'><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></a>";
		// if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
	}
}


/******************************************************
 *
 * ページの存在確認
 *
 *******************************************************/
function exist_page($type, $slug, $parent = 0)
{
	$query = new WP_Query();
	$query->query("post_type={$type}&name={$slug}&post_parent={$parent}");
	if ($query->have_posts()) {
		return $query->post->ID;
	} else {
		return false;
	}
}

/******************************************************
 *
 * カスタムメニュー設置
 *
 *******************************************************/
function menu_setup()
{
	register_nav_menus(array(
		'global' => 'グローバルメニュー',
		'footer' => 'フッターメニュー',
	));
}
add_action('after_setup_theme', 'menu_setup');

/******************************************************
 *
 * ビジュアルエディタ　カスタマイズ
 *
 *******************************************************/
add_filter('tiny_mce_before_init', function ($settings) {
	$settings['font_formats'] =
		"Century Gothic='Century Gothic';" .
		"Franklin Gothic Medium='Franklin Gothic Medium';" .
		"Gulim='Gulim';" .
		"Impact='Impact';" .
		"Verdana='Verdana';" .
		"Georgia='Georgia';" .
		"Times New Roman='Times New Roman';" .
		"Courier New='Courier New';" .
		"Comic Sans MS='Comic Sans MS';" .
		"ＭＳ Ｐゴシック='ＭＳ Ｐゴシック','MS PGothic';" .
		"ＭＳ ゴシック='ＭＳ ゴシック','MS Gothic';" .
		"游ゴシック='游ゴシック','Yu Gothic';" .
		"ヒラギノ角ゴ='ヒラギノ角ゴ Pro W3','Hiragino Kaku Gothic Pro','ヒラギノ角ゴ ProN W3','Hiragino Kaku Gothic ProN';" .
		"ヒラギノ丸ゴ='ヒラギノ丸ゴ Pro W4','Hiragino Maru Gothic Pro','ヒラギノ丸ゴ ProN W4','Hiragino Maru Gothic ProN';" .
		"ＭＳ Ｐ明朝='ＭＳ Ｐ明朝','MS PMincho';" .
		"ＭＳ 明朝='ＭＳ 明朝','MS Mincho';" .
		"游明朝='游明朝','Yu Mincho';" .
		"ヒラギノ明朝='ヒラギノ明朝 Pro W3','Hiragino Mincho Pro',ヒラギノ明朝 ProN W3','Hiragino Mincho ProN';" .
		"游明朝体='游明朝体','YuMincho';";
	return $settings;
});
function tinymce_custom_fonts($setting)
{
	$setting['fontsize_formats'] = "10px 12px 14px 16px 18px 20px 22px";
	return $setting;
}
add_filter('tiny_mce_before_init', 'tinymce_custom_fonts', 5);
add_editor_style('tinymce-visual-editor.css');

add_filter('admin_body_class', 'add_admin_body_class');
function add_admin_body_class($classes)
{
	$screen = get_current_screen();
	$size = get_option('size');
	if ($screen->base == 'edit' || $screen->base == 'post') {
		$classes .= 'fs' . $size;
	}
	return $classes;
}

add_filter('tiny_mce_before_init', 'custom_tiny_mce_body_class');
function custom_tiny_mce_body_class($settings)
{
	$size = get_option('size');
	$settings['body_class'] = 'fs' . $size;
	return $settings;
}

/******************************************************
 *
 * サイドバー　ウィジット有効化
 *
 *******************************************************/


function mytheme_widgets_init()
{
	register_sidebar(array(
		'name' => 'サイドバー',
		'id' => 'sidebar',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
	));
}
add_action('widgets_init', 'mytheme_widgets_init');
