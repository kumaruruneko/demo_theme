<?php
function get_custom_header_setting()
{
	$opt_name = 'custom_header_setting';
	$opt_val = get_option($opt_name);
	$logo = (!empty(get_option('logo'))) ? get_option('logo') : '';
	$logo_img = (!empty($logo['img'])) ? $logo['img'] : '';
	$logo_src = (!empty($logo_img)) ? wp_get_attachment_image($logo_img, array(165, 99999), false, array('class' => 'img-responsive')) : '';
	$logo_select = (empty($logo_img)) ? ' select' : '';
	$logo_text = (!empty($logo['text'])) ? $logo['text'] : '';
	$logo_font = (!empty($logo['font'])) ? $logo['font'] : '';

	$follow = (!empty(get_option('logo'))) ? get_option('logo') : '';
	$follow_head = (!empty($follow['follow'])) ? $follow['follow'] : '';


	$catch = (!empty($opt_val['catch'])) ? $opt_val['catch'] : '';
	$outside = (!empty($opt_val['outside'])) ? $opt_val['outside'] : '';
	$img = (!empty($opt_val['img'])) ? $opt_val['img'] : '';
	$img_src = (!empty($img)) ? wp_get_attachment_image($img, array(1920, 99999), false, array('class' => 'img-responsive')) : '';
	$select = (empty($img)) ? ' select' : '';
	$bgimg = get_option('bgimg');
	$bg_src = (!empty($bgimg)) ? wp_get_attachment_image($bgimg, array(960, 99999), false, array('class' => 'img-responsive')) : '';
	$bg_select = (empty($bg)) ? ' select' : '';
	$contents = <<<__HTML__
	<p class="small">ヘッダーの各種設定を行います。</p>
		<div class="form-group">
			<label>ロゴ</label>
			<div class="mediaupload d-flex logo">
				<p class="label">画像をアップロード（画像推奨サイズ 165×40）</p>
				<input type="hidden" name="custom_data[logo][img]" value="{$logo_img}" id="logo_img">
				<div class="img_box mini{$logo_select}">{$logo_src}</div>
					<div class="text-center mgt10">
						<button type="button" class="select_btn">画像を選択</button>
						<button type="button" class="clear_btn">クリア</button>
					</div>
			</div>
		</div>

			<div class="form-group">
				<div class="form-inline mgt10">
					<label for="catchphrase">メインビジュアル上に表示されるキャッチコピー</label>
					<input type="text" name="custom_data[logo][text]" class="form-control" id="logo_text" value="{$logo_text}" maxlength="25">
				</div>
			</div>
							
__HTML__;



	if ($follow_head == 'follow') {
		$checked1 = 'checked';
	} elseif (empty($follow_head) || $follow_head == 'nofollow') {
		$checked2 = 'checked';
	}
	$contents .= <<<__HTML__
	<div class="form-group">

		<h4>ヘッダー追従設定</h4>
							<p>スクロールに合わせてヘッダーが追従します</p>
<div class="parts-inline mgt10">
		<div class="parts-inline mgt10">

	<input id="header-s" type="radio" name="custom_data[logo][follow]" value="follow" {$checked1}>
	<label for="header-s">追従する</label>
		</div>

		<div class="parts-inline mgt10">

  <input id="header-g" type="radio" name="custom_data[logo][follow]" value="nofollow" {$checked2}>
	<label for="header-g">追従しない</label>

		</div>
	</div>
	</div>
	</div>
__HTML__;
	$field = sprintf('<div class="field social_field">%1$s</div>', $contents);
	return $field;
}
