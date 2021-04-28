<?php



//管理画面にメニュー追加
require_once locate_template('inc/admin_setting/my_plugin_menu.php');

// サイト設定
require_once locate_template('inc/admin_setting/custom_site_setting.php');

//ヘッダー設定
require_once locate_template('inc/admin_setting/custom_header_setting.php');

// メインビジュアル設定
require_once locate_template('inc/admin_setting/custom_mv_setting.php');

//サブビジュアル設定
require_once locate_template('inc/admin_setting/custom_submv_setting.php');

//企業情報設定
require_once locate_template('inc/admin_setting/custom_company_setting.php');

// NEWS設定
require_once locate_template('inc/admin_setting/custom_movie_setting.php');

// フッター設定
require_once locate_template('inc/admin_setting/custom_footer_setting.php');

//SNS設定
require_once locate_template('inc/admin_setting/custom_social_setting.php');

//サブコンテンツ設定（他項目のサブ項目に利用可能）
require_once locate_template('inc/admin_setting/custom_subcontents_setting.php');




function get_custom_basic_setting()
{
	$rand = mt_rand(1, 3);
	$contents = <<<__HTML__
		<div class="form-group">
			<label for="title">サイトの名前</label>
			<!--p class="small">タイトルとしてGoogleなどの検索エンジンで、検索結果などに反映されます。30文字程度の文章をご入力下さい。</p-->
			<div class="form-inline"><input type="text" name="custom_data[blogname]" class="form-control" id="title" value="" required></div>
		</div>
		<div class="form-group">
			<label for="description">サイトの説明</label>
			<p class="small">Googleなどの検索エンジンで、検索結果などに反映される文章です。検索されたいキーワードを盛り込み、150文字程度の文章をご入力下さい。</p>
			<textarea name="custom_data[blogdescription]" class="form-control" rows="5" id="description" required></textarea>
		</div>
		<div class="form-group">
			<label for="color">サイトカラー</label>
			<div class="form-inline">
				<select name="custom_data[color]" class="form-control" id="color">
					<option value="c01" style="color: #a12f2f;">&#9632; 赤</option>
					<option value="c02" style="color: #dc7395;">&#9632; ピンク</option>
					<option value="c03" style="color: #807093;">&#9632; 紫</option>
					<option value="c04" style="color: #46486a;">&#9632; 藤</option>
					<option value="c05" style="color: #273c77;">&#9632; 青</option>
					<option value="c06" style="color: #688889;">&#9632; 緑青</option>
					<option value="c07" style="color: #4e7064;">&#9632; 緑</option>
					<option value="c08" style="color: #778b50;">&#9632; 黄緑</option>
					<option value="c09" style="color: #d3ad40;">&#9632; 黄</option>
					<option value="c10" style="color: #c15e43;">&#9632; オレンジ</option>
				</select>
				<input type="hidden" name="custom_data[layout]" value="{$rand}">
			</div>
		</div>
		<div class="form-group">
			<label>テキストの大きさ</label>
			<div class="radio">
				<label><input type="radio" name="custom_data[size]" value="14" checked> 標準 <span style="font-size:14px;display:inline-block;margin-left:10px;font-weight:normal;">この大きさで表示されます。</span></label>
			</div>
			<div class="radio">
				<label><input type="radio" name="custom_data[size]" value="16"> 大きい <span style="font-size:16px;display:inline-block;margin-left:10px;font-weight:normal;">この大きさで表示されます。</span></label>
			</div>
		</div>
		<div class="form-group">
			<label for="email">受信メールアドレス</label>
			<p class="small">お問い合わせフォームに設定するメールアドレスをご入力下さい。</p>
			<div class="form-inline"><input type="email" name="custom_data[admin_email]" class="form-control" id="email" value="" required></div>
		</div>
__HTML__;
	$field = sprintf('<div class="field setting_field">%1$s</div>', $contents);
	return $field;
}


function get_custom_initial_setting()
{
	$contents = get_custom_basic_setting();
	$contents .= get_custom_site_setting();
	$contents .= get_custom_header_setting();
	// $contents .= get_custom_visual_field();
	// $contents .= get_custom_service_field();
	// $contents .= get_custom_company_field();
	// $contents .= get_custom_social_field();
	$contents .= get_custom_movie_setting();
	$field = sprintf('<div id="first_slider">%1$s</div>', $contents);
	$wp_upload_dir = wp_upload_dir();
	return $field;
}

// 多次元配列の値が空かどうか
function custom_array_filter($var)
{
	$return = false;
	if (is_array($var)) {
		foreach ($var as $v) {
			if (!empty($v)) {
				$return = true;
			}
		}
	} elseif (!empty($var)) {
		$return = true;
	}
	return $return;
}

// 都道府県のセレクトボックス
function get_prefectures_select($label = '')
{
	$format = '<select class="form-control" id="pref_select">%1$s</select>';
	$option = '';
	$args = array(
		'01' => '北海道',
		'02' => '青森県',
		'03' => '岩手県',
		'04' => '宮城県',
		'05' => '秋田県',
		'06' => '山形県',
		'07' => '福島県',
		'08' => '茨城県',
		'09' => '栃木県',
		'10' => '群馬県',
		'11' => '埼玉県',
		'12' => '千葉県',
		'13' => '東京都',
		'14' => '神奈川県',
		'15' => '新潟県',
		'16' => '富山県',
		'17' => '石川県',
		'18' => '福井県',
		'19' => '山梨県',
		'20' => '長野県',
		'21' => '岐阜県',
		'22' => '静岡県',
		'23' => '愛知県',
		'24' => '三重県',
		'25' => '滋賀県',
		'26' => '京都府',
		'27' => '大阪府',
		'28' => '兵庫県',
		'29' => '奈良県',
		'30' => '和歌山県',
		'31' => '鳥取県',
		'32' => '島根県',
		'33' => '岡山県',
		'34' => '広島県',
		'35' => '山口県',
		'36' => '徳島県',
		'37' => '香川県',
		'38' => '愛媛県',
		'39' => '高知県',
		'40' => '福岡県',
		'41' => '佐賀県',
		'42' => '長崎県',
		'43' => '熊本県',
		'44' => '大分県',
		'45' => '宮崎県',
		'46' => '鹿児島県',
		'47' => '沖縄県'
	);
	foreach ($args as $key => $value) {
		$selected = (!empty($label) && $label == $value) ? ' selected' : '';
		$option .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
	}
	return sprintf($format, $option);
}

function get_main_visual_img($color = 'c01')
{
	/*$mv = array();
	$dir = get_template_directory().'/src/img/mv/'.$color.'/*';
	foreach(glob($dir) as $file){
		if(is_file($file)){
			$mv[] = $file;
		}
	}
	$rand = mt_rand( 0, (count($mv)-1) );
	return $mv[$rand];*/
	$dir = get_template_directory() . '/src/img/mv/mv_' . $color . '.jpg';
	return $dir;
}
function get_bg_img($color = 'c01')
{
	/*$bg = array();
	$dir = get_template_directory().'/src/img/bg/'.$color.'/*';
	foreach(glob($dir) as $file){
		if(is_file($file)){
			$bg[] = $file;
		}
	}
	$rand = mt_rand( 0, (count($bg)-1) );
	return $bg[$rand];*/
	$dir = get_template_directory() . '/src/img/service/service_' . $color . '.jpg';
	return $dir;
}
// コンタクトフォームの自動生成
function insert_contact_meta($mail = '')
{
	$post_id = insert_contact_post();
	if (is_wp_error($post_id)) {
		echo $post_id->get_error_message();
		return;
	}
	if (empty($mail)) {
		$mail = get_option('admin_email');
	}
	$args = array(
		'_form' => get_contact_meta_form(),
		'_mail' => get_contact_meta_mail($mail),
		'_mail_2' => get_contact_meta_mail2(),
		'_messages' => get_contact_meta_messages(),
		'_additional_settings' => NULL,
		'_locale' => 'ja'
	);
	foreach ($args as $meta_key => $meta_value) {
		update_post_meta($post_id, $meta_key, $meta_value);
	}
}
function insert_contact_post()
{
	$post = array(
		'ID'             => 2,
		'post_content'   => '',
		'post_title'     => 'お問い合わせ',
		'post_status'    => 'publish',
		'post_type'      => 'wpcf7_contact_form',
		'post_author'    => 1,
		'ping_status'    => 'closed',
		'comment_status' => 'closed'
	);
	$post_id = wp_insert_post($post, true);
	return $post_id;
}
function get_contact_meta_form()
{
	$contents = <<<__HTML__
<table class="table contact_table">
  <tr>
    <th>名前<span class="require">※</span></th>
    <td>[text* your-name class:form-control akismet:author]</td>
  </tr>
  <tr>
    <th>メールアドレス<span class="require">※</span></th>
    <td>[email* your-email class:form-control akismet:author_email]</td>
  </tr>
  <tr>
    <th>TEL<span class="require">※</span></th>
    <td>[tel* your-tel class:form-control]</td>
  </tr>
  <tr>
    <th>お問い合わせ内容<span class="require">※</span></th>
    <td>[textarea* your-message class:form-control]</td>
  </tr>
</table>
<div class="text-center">[submit class:btn_clear class:sm "送信"]</div>
__HTML__;
	return trim($contents, " \t\n");
}
function get_contact_meta_mail($mail)
{
	$title = get_bloginfo('name');
	$url = get_bloginfo('url');
	$contents = <<<__HTML__
メッセージ本文
----------------------------------------------

名前：[your-name]
メールアドレス：[your-email]
TEL：[your-tel]
お問い合わせ内容：
[your-message]

----------------------------------------------

このメールは {$title} ({$url}) のお問い合わせフォームから送信されました
__HTML__;

	$args = array(
		'subject' => 'お問い合わせがありました。', // 題名
		'sender' => '[your-name] <info@' . str_replace(array('http://', 'https://'), '', $url) . '>', // 送信元
		'body' => $contents, // メッセージ本文
		'recipient' => $mail, // 送信先
		'additional_headers' => 'Reply-To: [your-email]', // 追加ヘッダー
		'attachments' => '', // ファイル添付
		'use_html' => false, // HTML 形式のメールを使用する
		'exclude_blank' => false // 空のメールタグを含む行を出力から除外する
	);
	return $args;
}
function get_contact_meta_mail2()
{
	$title = get_bloginfo('name');
	$url = get_bloginfo('url');
	$contents = <<<__HTML__
お問い合わせありがとうございます。
下記の内容で管理者に送信しました。
返信があるまでしばらくお待ちください。

メッセージ本文
----------------------------------------------

名前：[your-name]
メールアドレス：[your-email]
TEL：[your-tel]
お問い合わせ内容：
[your-message]

----------------------------------------------

このメールは {$title} ({$url}) のお問い合わせフォームから送信されました
__HTML__;

	$args = array(
		'active' => true, // メール (2) を使用
		'subject' => 'お問い合わせありがとうございます。', // 題名
		'sender' => $title . ' <info@' . str_replace(array('http://', 'https://'), '', $url) . '>', // 送信元
		'body' => $contents, // メッセージ本文
		'recipient' => '[your-email]', // 送信先
		'additional_headers' => '', // 追加ヘッダー
		'attachments' => '', // ファイル添付
		'use_html' => false, // HTML 形式のメールを使用する
		'exclude_blank' => false // 空のメールタグを含む行を出力から除外する
	);
	return $args;
}
function get_contact_meta_messages()
{
	$args = array(
		'mail_sent_ok' => 'ありがとうございます。メッセージは送信されました。',
		'mail_sent_ng' => 'メッセージの送信に失敗しました。後でまたお試しください。',
		'validation_error' => '入力内容に問題があります。確認して再度お試しください。',
		'spam' => 'メッセージの送信に失敗しました。後でまたお試しください。',
		'accept_terms' => 'メッセージを送信する前に承諾確認が必要です。',
		'invalid_required' => '必須項目に入力してください。',
		'invalid_too_long' => '入力されたテキストが長すぎます。',
		'invalid_too_short' => '入力されたテキストが短すぎます。'
	);
	return $args;
}

// // 管理画面の表示設定にセクションとフィールドを追加
// function eg_settings_api_init()
// {

// 	// セクションを追加
// 	add_settings_section('eg_setting_section', '', '', 'reading');

// 	// その新しいセクションの中に
// 	// 新しい設定の名前と関数を指定しながらフィールドを追加
// 	add_settings_field(
// 		'color',
// 		'サイトカラー',
// 		'egc_setting_callback_function',
// 		'reading',
// 		'eg_setting_section'
// 	);
// 	add_settings_field(
// 		'size',
// 		'テキストの大きさ',
// 		'eg_setting_callback_function',
// 		'reading',
// 		'eg_setting_section'
// 	);
// 	// 新しい設定が $_POST で扱われ、コールバック関数が <input> を
// 	// echo できるように、新しい設定を登録
// 	register_setting('reading', 'color');
// 	register_setting('reading', 'size');
// }
// function eg_setting_callback_function()
// {
// 	echo '<fieldset><p>
// 				<label><input type="radio" name="size" value="14" ' . checked(get_option('size'), 14, false) . '> 標準 <span style="font-size:14px;display:inline-block;margin-left:10px;font-weight:normal;">この大きさで表示されます。</span></label><br>
// 				<label><input type="radio" name="size" value="16"' . checked(get_option('size'), 16, false) . '> 大きい <span style="font-size:16px;display:inline-block;margin-left:10px;font-weight:normal;">この大きさで表示されます。</span></label>
// 			</p></fieldset>';
// }
// function egc_setting_callback_function()
// {
// 	$args = array(
// 		'c01' => array('code' => '#a12f2f', 'label' => '赤'),
// 		'c02' => array('code' => '#dc7395', 'label' => 'ピンク'),
// 		'c03' => array('code' => '#807093', 'label' => '紫'),
// 		'c04' => array('code' => '#46486a', 'label' => '藤'),
// 		'c05' => array('code' => '#273c77', 'label' => '青'),
// 		'c06' => array('code' => '#688889', 'label' => '緑青'),
// 		'c07' => array('code' => '#4e7064', 'label' => '緑'),
// 		'c08' => array('code' => '#778b50', 'label' => '黄緑'),
// 		'c09' => array('code' => '#d3ad40', 'label' => '黄'),
// 		'c10' => array('code' => '#c15e43', 'label' => 'オレンジ'),
// 	);
// 	$color = get_option('color');
// 	echo '<fieldset><p>
// 				<select name="color" class="form-control" id="color">';
// 	foreach ($args as $key => $value) {
// 		$selected = ($key == $color) ? ' selected' : '';
// 		echo '<option value="' . $key . '" style="color: ' . $value['code'] . ';"' . $selected . '>&#9632; ' . $value['label'] . '</option>';
// 	}
// 	echo '</select>
// 			</p></fieldset>';
// }
// add_action('admin_init', 'eg_settings_api_init');

function update_custom_attachment($dir)
{

	$name = basename($dir);

	// アップロード用ディレクトリのパスを取得。
	$wp_upload_dir = wp_upload_dir();
	$filename = $wp_upload_dir['path'] . '/' . $name;
	if (!copy($dir, $filename)) {
		return new WP_Error('broke', '画像のアップロードに失敗しました。');
	}
	// ファイルの種類をチェックする。これを 'post_mime_type' に使う。
	$filetype = wp_check_filetype(basename($filename), null);

	// 添付ファイル用の投稿データの配列を準備。
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// 添付ファイルを追加。
	$attach_id = wp_insert_attachment($attachment, $filename);

	// wp_generate_attachment_metadata() の実行に必要なので下記ファイルを含める。
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	// 添付ファイルのメタデータを生成し、データベースを更新。
	$attach_data = wp_generate_attachment_metadata($attach_id, $filename);
	wp_update_attachment_metadata($attach_id, $attach_data);

	return $attach_id;
}

// 固定ページ「プライバシーポリシー」自動作成
function auto_create_privacy_page($company)
{

	wp_delete_post(3, true);
	$check = get_page_by_path('privacy');
	$contents = <<<__HTML__
<p class="mgb0">本ウェブサイトは、{$company}（以下「当社」）の事業内容等を紹介するサイトです。</p>
<h2><span class="num">1.</span>個人情報保護方針</h2>
<p class="mgb0">当社は、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識と取組みを徹底させることにより、個人情報の保護を推進致します。</p>
<h2><span class="num">2.</span>個人情報の管理</h2>
<p class="mgb0">当社は、お客さまの個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、セキュリティシステムの維持・管理体制の整備・社員教育の徹底等の必要な措置を講じ、安全対策を実施し個人情報の厳重な管理を行ないます。</p>
<h2><span class="num">3.</span>個人情報の利用目的</h2>
<p class="mgb0">本ウェブサイトでは、お客様からのお問い合わせ時に、お名前、e-mailアドレス、電話番号等の個人情報をご登録いただく場合がございますが、これらの個人情報はご提供いただく際の目的以外では利用いたしません。<br>お客さまからお預かりした個人情報は、当社からのご連絡や業務のご案内やご質問に対する回答として、電子メールや資料のご送付に利用いたします。</p>
<h2><span class="num">4.</span>個人情報の第三者への開示・提供の禁止</h2>
<p class="mgb0">当社は、お客さまよりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。</p>
<ul class="ul_deco">
 <li><span class="deco">・</span>お客さまの同意がある場合</li>
 <li><span class="deco">・</span>お客さまが希望されるサービスを行なうために当社が業務を委託する業者に対して開示する場合</li>
 <li><span class="deco">・</span>法令に基づき開示することが必要である場合</li>
</ul>
<h2><span class="num">5.</span>個人情報の安全対策</h2>
<p class="mgb0">当社は、個人情報の正確性及び安全性確保のために、セキュリティに万全の対策を講じています。</p>
<h2><span class="num">6.</span>ご本人の照会</h2>
<p class="mgb0">お客さまがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。</p>
<h2><span class="num">7.</span>法令、規範の遵守と見直し</h2>
<p class="mgb0">当社は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、本ポリシーの内容を適宜見直し、その改善に努めます。</p>
__HTML__;
	$new_page = array(
		'ID' => (!empty($check->ID)) ? $check->ID : '',
		'post_type' => 'page',
		'post_title' => 'プライバシーポリシー',
		'post_name' => 'privacy',
		'post_content' => $contents,
		'post_status' => 'publish',
		'post_author' => 1,
	);
	return wp_insert_post($new_page);
}

//ネットワーク管理画面にメニュー追加
function my_network_menu()
{
	add_menu_page('リスト', 'リスト', 'manage_categories', 'custom_network_list', 'custom_network_list_page', 'dashicons-editor-ul', '10.9');
}
add_action('network_admin_menu', 'my_network_menu');

function custom_network_list_page()
{

	// ユーザーが必要な権限を持つか確認する必要がある
	if (!current_user_can('manage_categories')) {
		wp_die(__('このページにアクセスする権限がありません。'));
	}
	$sites = get_sites(array('site__not_in' => array(1), 'number' => 0));
	$datas = array();
	foreach ($sites as $site) {

		$users = get_users(array('blog_id' => $site->blog_id, 'exclude' => array(1), 'number' => 1, 'orderby' => 'ID'));
		$datas[] = array(
			'status' => get_blog_option($site->blog_id, 'initial_setting'),
			'site' => $site->domain,
			'user' => $users[0]->user_login,
			'user_name' =>  get_user_meta($users[0]->ID, 'first_name', true),
			'mail' => $users[0]->user_email,
		);
	}


	echo <<<__HTML__
<div class="wrap" id="custom_contents">
	<h2>参加サイト一覧</h2>
	<table class="wp-list-table widefat fixed striped users-network">
	<thead>
		<tr>
			<th scope="col" class="manage-column column-registered">
				<span>ステータス</span>
			</th>
			<th scope="col" class="manage-column column-blogs">
				<span>サイト</span>
			</th>
			<th scope="col" class="manage-column column-username">
				<span>ユーザー名</span>
			</th>
			<th scope="col" class="manage-column column-name">
				<span>名前</span>
			</th>
			<th scope="col" class="manage-column column-email">
				<span>メールアドレス</span>
			</th>
		</tr>
	</thead>
	<tbody id="the-list">
__HTML__;
	foreach ($datas as $data) {
		echo '<tr>';
		if ($data['status']) {
			echo '<td><span style="color:#00f;">有効</span></td>';
		} else {
			echo '<td><span style="color:#f00;">無効</span></td>';
		}
		echo '<td>' . $data['site'] . '</td>';
		echo '<td>' . $data['user'] . '</td>';
		echo '<td>' . $data['user_name'] . '</td>';
		echo '<td>' . $data['mail'] . '</td>';
		echo '</tr>';
	}
	echo <<<__HTML__
	</tbody>
	<tfoot>
		<tr>
			<th scope="col" class="manage-column column-registered">
				<span>ステータス</span>
			</th>
			<th scope="col" class="manage-column column-blogs">
				<span>サイト</span>
			</th>
			<th scope="col" class="manage-column column-username">
				<span>ユーザー名</span>
			</th>
			<th scope="col" class="manage-column column-name">
				<span>名前</span>
			</th>
			<th scope="col" class="manage-column column-email">
				<span>メールアドレス</span>
			</th>
		</tr>
	</tfoot>
</table>
</div>
__HTML__;
}

function insert_plans_post()
{
	$meta = array(
		'plans_top' => 'display',
		'plans_price' => '￥25,000',
		'plans_time' => '一時間',
		'plans_detail' => '<p>テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト</p><p>テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト</p><p>&nbsp;</p><p>テストテストテストテストテストテストテストテストテストテストテストテストテストテスト</p>',
	);
	for ($i = 3; $i > 0; $i--) {
		$title = 'サンプルプラン' . $i;
		$check = get_page_by_path($title, OBJECT, 'plans');
		$post = array(
			'post_type' => 'plans',
			'post_title' => $title,
			'post_status' => 'publish',
			'post_author' => get_current_user_id(),
		);
		if (!empty($check->ID)) {
			return;
		}

		$post_id = wp_insert_post($post, true);

		$dir = get_template_directory() . '/src/img/common/plan0' . $i . '.jpg';
		$upload = update_custom_attachment($dir);
		$image_attributes = wp_get_attachment_image_src($upload);
		$meta['plans_img_id'] = $upload;
		$meta['plans_img'] = $image_attributes[0];

		foreach ($meta as $key => $value) {
			update_post_meta($post_id, $key, $value);
		}
	}
}

function insert_links_post()
{

	for ($i = 3; $i > 0; $i--) {
		$title = 'サンプルリンク' . $i;
		$check = get_page_by_path($title, OBJECT, 'links');
		$post = array(
			'post_type' => 'links',
			'post_title' => $title,
			'post_status' => 'publish',
			'post_author' => get_current_user_id(),
		);
		if (!empty($check->ID)) {
			return;
		}

		$post_id = wp_insert_post($post, true);
		update_post_meta($post_id, 'links_url', home_url());
	}
}