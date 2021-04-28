<?php
function get_custom_social_setting()
{
	$opt_name = 'custom_top_social';
	$opt_val = get_option($opt_name);
	$facebook = (!empty($opt_val['facebook'])) ? $opt_val['facebook'] : '';
	$twitter = (!empty($opt_val['twitter'])) ? $opt_val['twitter'] : '';
	$insta = (!empty($opt_val['insta'])) ? $opt_val['insta'] : '';
	$contents = <<<__HTML__
		<p class="small">各ソーシャルサービスのボタンを表示する場合にURLを入力して下さい。</p>
		<div class="form-group">
			<label for="facebook">Facebook</label>
			<input type="url" name="custom_data[{$opt_name}][facebook]" class="form-control" id="facebook" value="{$facebook}" placeholder="例：https://www.facebook.com/アカウント/">
		</div>
		<div class="form-group">
			<label for="twitter">Twitter</label>
			<input type="url" name="custom_data[{$opt_name}][twitter]" class="form-control" id="twitter" value="{$twitter}" placeholder="例：https://twitter.com/アカウント/">
		</div>
		<div class="form-group">
			<label for="insta">Instagram</label>
			<input type="url" name="custom_data[{$opt_name}][insta]" class="form-control" id="insta" value="{$insta}" placeholder="例：https://www.instagram.com/アカウント/">
		</div>
__HTML__;
	$field = sprintf('<div class="field social_field">%1$s</div>', $contents);
	return $field;
}
