<?php
function get_custom_submv_setting()
{
	$opt_name = 'custom_submv_setting';
	$opt_val = get_option($opt_name);
	$service_text = (!empty($opt_val['service_text'])) ? $opt_val['service_text'] : '';
	$service_disc = (!empty($opt_val['service_disc'])) ? $opt_val['service_disc'] : '';
	$service_title = (!empty($opt_val['service_title'])) ? $opt_val['service_title'] : '';
	$service_img = (!empty($opt_val['service_img'])) ? $opt_val['service_img'] : '';
	$service_src = (!empty($service_img)) ? wp_get_attachment_image($service_img, array(165, 99999), false, array('class' => 'img-responsive')) : '';

	$logo = (!empty(get_option('logo'))) ? get_option('logo') : '';
	$logo_img = (!empty($logo['img'])) ? $logo['img'] : '';
	$logo_src = (!empty($logo_img)) ? wp_get_attachment_image($logo_img, array(165, 99999), false, array('class' => 'img-responsive')) : '';
	$logo_select = (empty($logo_img)) ? ' select' : '';
	$contents = <<<__HTML__

	
	<div class="form-group">
			<label for="service_title">タイトル</label>
			<input type="text" name="custom_data[{$opt_name}][service_title]" class="form-control" id="service_title" value="{$service_title}">
		</div>



	<div class="form-group">
			<label for="service_disc">タイトル下の説明</label>
			<input type="text" name="custom_data[{$opt_name}][service_disc]" class="form-control" id="service_disc" value="{$service_disc}">
		</div>
	<div class="form-group">
	<div class="mediaupload d-flex logo">
				<p class="label">画像をアップロード（画像推奨サイズ 950×600）</p>
				<input type="hidden" name="custom_data[{$opt_name}][service_img]" value="{$service_img}" id="logo_img">
			<div class="img_box mini{$logo_select}">{$service_src}</div>
				<div class="text-center mgt10">
					<button type="button" class="select_btn">画像を選択</button>
					<button type="button" class="clear_btn">クリア</button>
				</div>
			</div>		
	</div>
		<div class="form-group">
			<label for="service_text">文章（500文字以内）</label>
			<p class="small">御社のサービス内容をご入力下さい。改行等ご記載通りに反映されます。</p>
			<textarea name="custom_data[{$opt_name}][service_text]" class="form-control" rows="10" id="service_text" maxlength="500" required>{$service_text}</textarea>
		</div>
__HTML__;
	$field = sprintf('<div class="field service_field">%1$s</div>', $contents);
	return $field;
}
