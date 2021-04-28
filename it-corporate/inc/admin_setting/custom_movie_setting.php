<?php
function get_custom_movie_setting()
{
	$opt_name = 'custom_movie_setting';
	$opt_val = get_option($opt_name);
	$youtube_URL = (!empty($opt_val['youtube_URL'])) ? $opt_val['youtube_URL'] : '';
	$youtube_title = (!empty($opt_val['youtube_title'])) ? $opt_val['youtube_title'] : '';
	$youtube_subtitle = (!empty($opt_val['youtube_subtitle'])) ? $opt_val['youtube_subtitle'] : '';
	$contents = <<<__HTML__
		<p class="admin_head">youtubeの設定を行います。</p>
		<p class="small">URLの項目に入力すると表示されます</p>
		<div class="form-group">
			<label for="youtube">YouTube URL（動画を表示させる場合、YouTubeのURLを入力してください。）</label>
			<input type="url" name="custom_data[{$opt_name}][youtube_URL]" class="form-control" id="youtube" value="{$youtube_URL}" placeholder="例：https://www.youtube.com/watch?v=××××××">
		</div>
		<div class="form-group">
			<label for="youtube">タイトル</label>
			<input type="text" name="custom_data[{$opt_name}][youtube_title]" class="form-control" id="youtube" value="{$youtube_title}" placeholder="例：MOVIE">
		</div>
		<div class="form-group">
			<label for="youtube">サブタイトル</label>
			<input type="text" name="custom_data[{$opt_name}][youtube_subtitle]" class="form-control" id="youtube" value="{$youtube_subtitle}" placeholder="例：紹介動画">
		</div>
__HTML__;
	$field = sprintf('<div class="field social_field">%1$s</div>', $contents);
	return $field;
}
