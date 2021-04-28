<?php
function get_custom_mv_setting()
{
	$opt_name = 'custom_mv_slide';
	$opt_val = get_option($opt_name);
	$slide = (!empty(get_option('slide'))) ? get_option('slide') : '';
	$slide_01 = (!empty($slide['img1'])) ? $slide['img1'] : '';
	$slide_02 = (!empty($slide['img2'])) ? $slide['img2'] : '';
	$slide_03 = (!empty($slide['img3'])) ? $slide['img3'] : '';
	$slide_04 = (!empty($slide['img4'])) ? $slide['img4'] : '';
	$slide_05 = (!empty($slide['img5'])) ? $slide['img5'] : '';
	$slide_01_src = (!empty($slide_01)) ? wp_get_attachment_image($slide_01, array(99999, 350), false, array('class' => 'img-responsive')) : '';
	$slide_02_src = (!empty($slide_02)) ? wp_get_attachment_image($slide_02, array(99999, 350), false, array('class' => 'img-responsive')) : '';
	$slide_03_src = (!empty($slide_03)) ? wp_get_attachment_image($slide_03, array(99999, 350), false, array('class' => 'img-responsive')) : '';
	$slide_04_src = (!empty($slide_04)) ? wp_get_attachment_image($slide_04, array(99999, 350), false, array('class' => 'img-responsive')) : '';
	$slide_05_src = (!empty($slide_05)) ? wp_get_attachment_image($slide_05, array(99999, 350), false, array('class' => 'img-responsive')) : '';
	$slide_01_select = (empty($slide_01)) ? ' select' : '';
	$slide_02_select = (empty($slide_02)) ? ' select' : '';
	$slide_03_select = (empty($slide_03)) ? ' select' : '';
	$slide_04_select = (empty($slide_04)) ? ' select' : '';
	$slide_05_select = (empty($slide_05)) ? ' select' : '';


	$contents = <<<__HTML__
		<p class="small">メインビジュアルの設定を行います。</p>
		<h3 class="admin_head">スライダー設定　(最大5枚まで)　<span class="small">※スライダーの枚数が2枚以上の場合に自動でスライダーとして機能します。</span></h3>
		<div class="form-group slide_frame01">
		<div class="mediaupload d-flex logo">
		<section class="btn-group">
		<button type="button" class="slide-add">スライドを追加<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
		</section>
			<h3>スライド画像1枚目</h3>
				<p class="label">スライド画像をアップロード（画像推奨サイズ 1920×1000）</p>
				<input type="hidden" name="custom_data[slide][img1]" value="{$slide_01}" id="logo_img">
				<div class="img_box {$slide_01_select}">{$slide_01_src}</div>
				<div class="text-center mgt10 btn_cont">
					<button type="button" class="select_btn">画像を選択</button>
					<button type="button" class="clear_btn">クリア</button>
				</div>
			</div>
		</div>

			<div class="form-group slide_frame02{$slide_02_select}">
		<div class="mediaupload d-flex logo">
		<section class="btn-group">
		<button type="button" class="slide-add">スライドを追加<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
		<button type="button" class="slide-minus">スライドを削除<i class="fa fa-minus-circle" aria-hidden="true"></i></button>
		</section>
					<h3>スライド画像2枚目</h3>
				<p class="label">スライド画像をアップロード（画像推奨サイズ 1920×1000）</p>
				<input type="hidden" name="custom_data[slide][img2]" value="{$slide_02}" id="logo_img">
				<div class="img_box {$slide_02_select}">{$slide_02_src}</div>
				<div class="text-center mgt10 btn_cont">
					<button type="button" class="select_btn">画像を選択</button>
					<button type="button" class="clear_btn">クリア</button>
				</div>
			</div>
		</div>

			<div class="form-group slide_frame03{$slide_03_select}">
		<div class="mediaupload d-flex logo">
		<section class="btn-group">
		<button type="button" class="slide-add">スライドを追加<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
		<button type="button" class="slide-minus">スライドを削除<i class="fa fa-minus-circle" aria-hidden="true"></i></button>
		</section>
			<h3>スライド画像3枚目</h3>
				<p class="label">スライド画像をアップロード（画像推奨サイズ 1920×1000）</p>
				<input type="hidden" name="custom_data[slide][img3]" value="{$slide_03}" id="logo_img">
				<div class="img_box {$slide_03_select}">{$slide_03_src}</div>
				<div class="text-center mgt10 btn_cont">
					<button type="button" class="select_btn">画像を選択</button>
					<button type="button" class="clear_btn">クリア</button>
				</div>
			</div>
		</div>

			<div class="form-group slide_frame04{$slide_04_select}">
		<div class="mediaupload d-flex logo">
		<section class="btn-group">
		<button type="button" class="slide-add">スライドを追加<i class="fa fa-plus-circle" aria-hidden="true"></i></button>
		<button type="button" class="slide-minus">スライドを削除<i class="fa fa-minus-circle" aria-hidden="true"></i></button>
		</section>
			<h3>スライド画像4枚目</h3>
				<p class="label">スライド画像をアップロード（画像推奨サイズ 1920×1000）</p>
				<input type="hidden" name="custom_data[slide][img4]" value="{$slide_04}" id="logo_img">
				<div class="img_box {$slide_04_select}">{$slide_04_src}</div>
				<div class="text-center mgt10 btn_cont">
					<button type="button" class="select_btn">画像を選択</button>
					<button type="button" class="clear_btn">クリア</button>
				</div>
			</div>
		</div>

			<div class="form-group slide_frame05{$slide_05_select}">
		<div class="mediaupload d-flex logo">
		<section class="btn-group">
		<button type="button" class="slide-minus">スライドを削除<i class="fa fa-minus-circle" aria-hidden="true"></i></button>
		</section>
			<h3>スライド画像5枚目</h3>
				<p class="label">スライド画像をアップロード（画像推奨サイズ 1920×1000）</p>
				<input type="hidden" name="custom_data[slide][img5]" value="{$slide_05}" id="logo_img">
				<div class="img_box {$slide_05_select}">{$slide_05_src}</div>
				<div class="text-center mgt10 btn_cont">
					<button type="button" class="select_btn">画像を選択</button>
					<button type="button" class="clear_btn">クリア</button>
				</div>
			</div>
		</div>
		
__HTML__;
	$field = sprintf('<div class="field mv_field">%1$s</div>', $contents);
	return $field;
}
