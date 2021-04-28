<?php
function my_plugin_menu()
{
  add_menu_page('サイト設定', 'サイト設定', 'manage_categories', 'custom_top_page', '', 'dashicons-desktop', '4.9');
  add_submenu_page('custom_top_page', 'サイト設定', 'サイト設定', 'manage_categories', 'custom_top_page', 'custom_top_page');
  add_submenu_page('custom_top_page', 'ヘッダー設定', 'ヘッダー設定', 'manage_categories', 'custom_header_setting', 'custom_top_page');
  add_submenu_page('custom_top_page', 'メインビジュアル設定', 'メインビジュアル設定', 'manage_categories', 'custom_mv_setting', 'custom_top_page');
  add_submenu_page('custom_top_page', 'サブビジュアル設定', 'サブビジュアル設定', 'manage_categories', 'custom_submv_setting', 'custom_top_page');
  add_submenu_page('custom_top_page', '企業情報設定', '企業情報設定', 'manage_categories', 'custom_top_company', 'custom_top_page');
  add_submenu_page('custom_top_page', 'movie設定', 'movie設定', 'manage_categories', 'custom_movie_setting', 'custom_top_page');
  add_submenu_page('custom_top_page', 'フッター設定', 'フッター設定', 'manage_categories', 'custom_footer_setting', 'custom_top_page');
  add_submenu_page('custom_top_page', 'SNS設定', 'SNS設定', 'manage_categories', 'custom_top_social', 'custom_top_page');

  // $setting = get_option('initial_setting');
  // if (empty($setting)) {
  //   add_menu_page('初期設定', '初期設定', 'manage_categories', 'custom_initial_setting', 'custom_initial_setting', 'dashicons-shield', '1');
  // }
}
add_action('admin_menu', 'my_plugin_menu');

function custom_top_plans_()
{
  echo <<<__HTML__
<div class="wrap" id="custom_contents">
	<h2>{$title}</h2>
	<form name="form" class="postbox pd20" method="post" action="">
	<input type="hidden" name="{$hidden_field_name}" value="Y">
	{$field}
	<div class="submit text-center">
		<input type="submit" name="Submit" class="button-primary" value="登録">
	</div>
	</form>
</div>
__HTML__;
}
//追加したメニューの内容
function custom_top_page()
{

  // ユーザーが必要な権限を持つか確認する必要がある
  if (!current_user_can('manage_categories')) {
    wp_die(__('このページにアクセスする権限がありません。'));
  }

  $hidden_field_name = 'mt_submit_hidden';
  $opt_name = $_GET['page'];

  if (isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y') {
    // POST されたデータを取得

    // POST された値をデータベースに保存
    foreach ($_POST['custom_data'] as $key => $value) {
      update_option($key, $value);
    }

    echo '<div class="updated"><p><strong>保存しました。</strong></p></div>';
  }
  switch ($opt_name) {
    case 'custom_top_social':
      $title = 'SNS設定';
      $field = get_custom_social_setting();
      break;
    case 'custom_header_setting':
      $title = 'ヘッダー設定';
      $field = get_custom_header_setting();
      break;
    case 'custom_mv_setting':
      $title = 'メインビジュアル設定';
      $field = get_custom_mv_setting();
      break;
    case 'custom_top_company':
      $title = '企業情報設定';
      $field = get_custom_company_setting();
      break;
    case 'custom_submv_setting':
      $title = 'サブビジュアル設定';
      $field = get_custom_submv_setting();
      break;
    case 'custom_movie_setting':
      $title = 'movie設定';
      $field = get_custom_movie_setting();
      break;
    case 'custom_footer_setting':
      $title = 'フッター設定';
      $field = get_custom_footer_setting();
      break;
    case 'custom_top_page':
    default:
      $title = 'サイト設定';
      $field = get_custom_site_setting();
      break;
  }
  echo <<<__HTML__
<div class="wrap" id="custom_contents">
	<h2>{$title}</h2>
	<form name="form" class="postbox pd20" method="post" action="">
	<input type="hidden" name="{$hidden_field_name}" value="Y">
	{$field}
	<div class="submit text-center">
		<input type="submit" name="Submit" class="button-primary" value="登録">
	</div>
	</form>
</div>
__HTML__;
}

//追加したメニューの内容
function custom_initial_setting()
{

  // ユーザーが必要な権限を持つか確認する必要がある
  if (!current_user_can('manage_categories')) {
    wp_die(__('このページにアクセスする権限がありません。'));
  }

  $hidden_field_name = 'mt_submit_hidden';

  if (isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y') {
    foreach ($_POST['custom_data'] as $key => $value) {
      if ($key == 'custom_top_page') {
        $mv = get_main_visual_img($_POST['custom_data']['color']);
        $upload = update_custom_attachment($mv);
        if (is_wp_error($upload)) {
          echo $upload->get_error_message() . 'もう一度やり直してください。';
        } else {
          $args = array(
            'catch' => $_POST['custom_data']['custom_top_page']['catch'],
            'youtube' => $_POST['custom_data']['custom_top_page']['youtube'],
            'img' => $upload,
          );
          update_option('custom_top_page', $args);
        }
      } elseif ($key != 'first-mv') {
        update_option($key, $value);
      }
    }
    $bg = get_bg_img($_POST['custom_data']['color']);
    $upload = update_custom_attachment($bg);
    if (is_wp_error($upload)) {
      echo $upload->get_error_message() . 'もう一度やり直してください。';
    } else {
      update_option('bgimg', $upload);
    }
    insert_contact_meta($_POST['custom_data']['admin_email']);
    $business = (!empty($_POST['custom_data']['custom_top_company']['company'])) ? $_POST['custom_data']['custom_top_company']['company'] : $_POST['custom_data']['blogname'];
    auto_create_privacy_page($business);
    auto_create_page();
    wp_update_term(1, 'category', array('name' => 'お知らせ', 'slug' => 'information'));
    insert_plans_post();
    insert_links_post();
    $setting = update_option('initial_setting', true);
    if ($setting != true) {
      echo '<div class="error"><p><strong>もう一度やり直してください。</strong></p></div>';
    }
  }

  $setting = get_option('initial_setting');
  if (empty($setting)) {
    $field = get_custom_initial_setting();

    echo <<<__HTML__
<div class="wrap" id="custom_contents">
	<form name="form" id="form" class="postbox pd20" method="post" action="">
	<ul class="progress-indicator">
		<li class="completed"><span class="bubble"></span>Step 1<br>基本情報</li>
		<li><span class="bubble"></span>Step 2<br>メインビジュアル</li>
		<li><span class="bubble"></span>Step 3<br>サービス内容</li>
		<li><span class="bubble"></span>Step 4<br>会社情報</li>
		<li><span class="bubble"></span>Step 5<br>ソーシャルリンク</li>
	</ul>
	<input type="hidden" name="{$hidden_field_name}" value="Y">
	{$field}
	<div class="submit text-center">
		<button type="button" id="slick_prev" class="btn btn-warning hide">戻る</button>
		<button type="button" id="slick_next" class="btn btn-success">次へ</button>
		<button type="button" id="submit_btn" class="btn btn-primary hide">登録</button>
	</div>
	</form>
</div>
__HTML__;
  } else {
    $sitename = get_bloginfo('name');
    $url = admin_url();
    echo <<<__HTML__
<div class="wrap text-center">
	<p>おめでとうございます ! 新しいサイト、 {$sitename} の準備が整いました。</p>
	<p>新しいサイトをお楽しみください。どうもありがとうございます</p>
	<p><a href="{$url}">{$sitename}に移動する</a></p>
</div>
__HTML__;
  }
}