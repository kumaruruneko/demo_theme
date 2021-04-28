<?php
function get_custom_site_setting()
{
  $opt_name = 'custom_top_page';
  $opt_val = get_option($opt_name);
  $site_setting = (!empty(get_option($opt_name))) ? get_option($opt_name) : '';
  $layout_s = (!empty($site_setting['layout'])) ? $site_setting['layout'] : '';
  $site_color = (!empty($site_setting['site_color'])) ? $site_setting['site_color'] : '';
  $select_color = substr($site_color, 1);
  $font_size = (!empty($site_setting['site_font'])) ? $site_setting['site_font'] : '';
  $font_type = (!empty($site_setting['font_type'])) ? $site_setting['font_type'] : '';


  $img_dir = get_bloginfo('template_directory');
  if ($layout_s == 'layout01') {
    $checked1 = 'checked';
  } elseif ($layout_s == 'layout02') {
    $checked2 = 'checked';
  } elseif ($layout_s == 'layout03') {
    $checked3 = 'checked';
  }

  if ($font_type == 'serif' || empty($font_type)) {
    $serif = 'checked';
  } elseif ($font_type == 'gothic') {
    $gothic = 'checked';
  } elseif ($font_type == 'noto') {
    $noto = 'checked';
  } elseif ($font_type == 'times') {
    $times = 'checked';
  }

  $contents = <<<__HTML__
  <div class="submit text-center">
		<input type="submit" name="Submit" class="button-primary" value="登録">
	</div>
  <p class="small">サイト全般の設定を行います。</p>
  <h3 class="admin_head">基本レイアウトを選択<span class="small"></span></h3>
		<div class="form-group layout_box" style="margin-bottom:30px;">
		<div class="form-group">
			<label for="layout-01">
      <input type="radio" name="custom_data[{$opt_name}][layout]" class="form-control" id="layout-01" value="layout01" {$checked1}>
      <img src="{$img_dir}/src/img/common/layout-1.png" class="img-responsive">
      </label>
      <h4>フルサイズレイアウト</h4>
			<p>画面全体を使って写真や動画などを見せる1カラムのレイアウトです。メインビジュアルに使う画像などは画面全体をカバーする大きさが必要になりますが、各コンテンツを広く使えます。</p>
		</div>
		<div class="form-group">
			<label for="layout-02">
      <input type="radio" name="custom_data[{$opt_name}][layout]" class="form-control" id="layout-02" value="layout02" {$checked2}>
      <img src="{$img_dir}/src/img/common/layout-2.png" class="img-responsive">
      </label>
       <h4>固定幅レイアウト</h4>
      <p>一般的によく見られる幅が固定されたレイアウトです。情報量が少ない場合などにすっきり見せることができます。</p>
		</div>
		<div class="form-group">
			<label for="layout-03">
      <input type="radio" name="custom_data[{$opt_name}][layout]" class="form-control" id="layout-03" value="layout03" {$checked3}>
      <img src="{$img_dir}/src/img/common/layout-3.png" class="img-responsive">
      </label>
       <h4>サイドカラムレイアウト</h4>
      <p>メニューをサイドに置いたレイアウトです。メニュー項目をサイドに縦で並べることによってメニューの数を多く設置でき、コンテンツ部分のみをスクロールさせることもできます。</p>
			</div>
    </div>
    <h3 class="admin_head">テーマカラー<span class="small"></span></h3>
    <div class="form-group layout_box">
      <div class="form-inline" data-selected="{$select_color}">

      <label for="color-01" class="form-group" style="background-color: #a12f2f;">
      <span>赤</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-01" value="c01">
      </label>
      <label for="color-02" class="form-group" style="background-color: #dc7395;">
      <span>ピンク</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-02" value="c02">
      </label>
      <label for="color-03" class="form-group" style="background-color: #807093;">
      <span>紫</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-03" value="c03">
      </label>
      <label for="color-04" class="form-group" style="background-color: #46486a;">
      <span>藤</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-04" value="c04">
      </label>
      <label for="color-05" class="form-group" style="background-color: #273c77;">
      <span>青</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-05" value="c05">
      </label>
      <label for="color-06" class="form-group" style="background-color: #688889;">
      <span>緑青</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-06" value="c06">
      </label>
      <label for="color-07" class="form-group" style="background-color: #4e7064;">
      <span>緑</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-07" value="c07">
      </label>
      <label for="color-08" class="form-group" style="background-color: #778b50;">
      <span>黄緑</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-08" value="c08">
      </label>
      <label for="color-09" class="form-group" style="background-color: #d3ad40;">
      <span>黄</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-09" value="c09">
      </label>
      <label for="color-10" class="form-group" style="background-color: #ffa500;">
      <span>オレンジ</span>
      <input type="radio" name="custom_data[{$opt_name}][site_color]" class="form-control" id="color-10" value="c10">
      </label>
			</div>
    </div>

   <h3 class="admin_head">テキストサイズ<span class="small"></span></h3>
    <div class="form-group layout_box">
      <div class="form-inline font-size" data-font="{$font_size}">
      <label for="font-f01" class="form-group">
      <input type="radio" name="custom_data[{$opt_name}][site_font]" class="form-control" id="font-f01" value="f01">
      <span>標準<small style="font-size:14px;">この大きさで表示されます。</small></span>
      </label>
      <label for="font-f02" class="form-group">
      <input type="radio" name="custom_data[{$opt_name}][site_font]" class="form-control" id="font-f02" value="f02">
      <span>大きい<small style="font-size:16px;">この大きさで表示されます。</small></span>
      </label>
      
			</div>
    </div>
    
     <h3 class="admin_head">フォントを選択<span class="small"></span></h3>
   <div class="form-group layout_box">
		<div class="parts-inline mgt10">
			<div class="parts-inline mgt10" style="margin-right: 3em;">
  			<input id="font-s" type="radio" name="custom_data[{$opt_name}][font_type]" value="serif" {$serif}>
				<label for="font-s" class="serif fz-2">明朝</label>
			</div>

			<div class="parts-inline mgt10" style="margin-right: 3em;">
  			<input id="font-g" type="radio" name="custom_data[{$opt_name}][font_type]" value="gothic" {$gothic}>
				<label for="font-g" class="gothic fz-2">ゴシック</label>
			</div>

			<div class="parts-inline mgt10" style="margin-right: 3em;">
  			<input id="font-h" type="radio" name="custom_data[{$opt_name}][font_type]" value="noto" {$noto}>
				<label for="font-h" class="noto fz-2">Noto Sans JP</label>
      </div>
      
			<div class="parts-inline mgt10">
  			<input id="font-t" type="radio" name="custom_data[{$opt_name}][font_type]" value="times" {$times}>
				<label for="font-t" class="noto fz-2">Times New Roman</label>
			</div>
    </div>
    <br>
			<p><small>Noto Sans JPは日本語と多言語が混ざった時に文字化けが少なくなるように開発されたフォントです。</small></p>
			<p><small>Times New Romanは英語の文字が綺麗に収まりやすいフォントです。日本語は明朝体になります。</small></p>

		</div>
	
__HTML__;

  $field = sprintf('<div class="field">%1$s</div>', $contents);
  return $field;
}
