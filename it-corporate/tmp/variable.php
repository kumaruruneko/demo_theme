<?php
$custom_site_setting = 'custom_top_page';
$custom_site_setting_val = get_option($custom_site_setting);
$layout_s = (!empty($custom_site_setting_val['layout'])) ? $custom_site_setting_val['layout'] : '';

$slide = (!empty(get_option('slide'))) ? get_option('slide') : '';
$slide_01 = (!empty($slide['img1'])) ? $slide['img1'] : '';
$slide_02 = (!empty($slide['img2'])) ? $slide['img2'] : '';
$slide_03 = (!empty($slide['img3'])) ? $slide['img3'] : '';
$slide_04 = (!empty($slide['img4'])) ? $slide['img4'] : '';
$slide_05 = (!empty($slide['img5'])) ? $slide['img5'] : '';
$slide_01_src = (!empty($slide_01)) ? wp_get_attachment_image($slide_01, array(99999, 99999), false, array('class' => 'img-responsive')) : '';
$slide_02_src = (!empty($slide_02)) ? wp_get_attachment_image($slide_02, array(99999, 99999), false, array('class' => 'img-responsive')) : '';
$slide_03_src = (!empty($slide_03)) ? wp_get_attachment_image($slide_03, array(99999, 99999), false, array('class' => 'img-responsive')) : '';
$slide_04_src = (!empty($slide_04)) ? wp_get_attachment_image($slide_04, array(99999, 99999), false, array('class' => 'img-responsive')) : '';
$slide_05_src = (!empty($slide_05)) ? wp_get_attachment_image($slide_05, array(99999, 99999), false, array('class' => 'img-responsive')) : '';

$follow = (!empty(get_option('logo'))) ? get_option('logo') : '';
$follow_head = (!empty($follow['follow'])) ? $follow['follow'] : '';


$site_color = (!empty($custom_site_setting_val['site_color'])) ? $custom_site_setting_val['site_color'] : '';
$site_font = (!empty($custom_site_setting_val['site_font'])) ? $custom_site_setting_val['site_font'] : '';
if ($site_font == 'f01') {
  $site_font = '14';
} elseif ($site_font == 'f02') {
  $site_font = '16';
};


$sub_mv = 'custom_submv_setting';
$bgimg  = get_option($sub_mv);
$service_img = (!empty($bgimg['service_img'])) ? $bgimg['service_img'] : '';
$subimg = wp_get_attachment_image_src($service_img, 'full')[0];
$logos   = get_option('logo');
$font_types   = get_option('custom_top_page');


$color  = get_option('color');
$size   = get_option('size');
$reservation = get_option('reservation');
$fonts = get_option('font');
$font = $logos['font'];
$font_type = $font_types['font_type'];
$logo_img = wp_get_attachment_image($logos['img'], array(165, 99999), false, array('class' => 'img-responsive'));
$logo_text = $logos['text'];
$outside = $custom_top_page['outside'];
$sns    = get_option('custom_top_social');

$head_position = '';

if (is_home() || is_front_page()) {
  $head_position = 'relative';

  $custom_top_page = get_option('custom_top_page');
  $mv = wp_get_attachment_image_src($custom_top_page['img'], 'full')[0];

  $movie = get_option('custom_movie_setting');
  $youtube_URL = (!empty($opt_val['youtube_URL'])) ? $opt_val['youtube_URL'] : '';
  $youtube_title = (!empty($opt_val['youtube_title'])) ? $opt_val['youtube_title'] : '';
  $youtube_subtitle = (!empty($opt_val['youtube_subtitle'])) ? $opt_val['youtube_subtitle'] : '';

  $service = get_option('custom_submv_setting');
  $service_img = (!empty($opt_val['service_img'])) ? $opt_val['service_img'] : '';
  $service_src = (!empty($service_img)) ? wp_get_attachment_image($service_img, array(165, 99999), false, array('class' => 'img-responsive')) : '';
} elseif (is_page('about')) {
  $company = get_option('custom_top_company');
  $map     = $company['pref'] . $company['city'] . $company['address'];
  $map     = str_replace(array(" ", "　"), "", $map);
};
