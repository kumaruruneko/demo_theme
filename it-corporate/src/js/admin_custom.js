(function ($) {
  $('.mv_field .select').prevAll().find('.btn-group').hide();
  $('.mv_field .select').prev().find('.btn-group').show();
  var frame5_check = $('.slide_frame05').hasClass('select')
  if (frame5_check == false) {
    $('.btn-group').hide();
    $('.slide_frame05').find('.btn-group').show();
  }
  $('.btn-group button').on('click', function () {
    $('.mv_field .select').prevAll().find('.btn-group').hide();
    $('.mv_field .select').prev().find('.btn-group').show();

  });

  $('.slide_frame01 .slide-add').on('click', function () {
    $('.slide_frame02').removeClass('select');
    $('.slide_frame02 .img_box').addClass('select');
    $(this).parents('.form-group').find('.btn-group').hide('');
    $('.slide_frame02 .btn-group').show();

  });
  $('.slide_frame02 .slide-add').on('click', function () {
    $('.slide_frame03').removeClass('select');
    $('.slide_frame03 .img_box').addClass('select');
    $(this).parents('.form-group').find('.btn-group').hide('');


  });
  $('.slide_frame03 .slide-add').on('click', function () {
    $('.slide_frame04').removeClass('select');
    $('.slide_frame04 .img_box').addClass('select');
    $(this).parents('.form-group').find('.btn-group').hide('');

  });
  $('.slide_frame04 .slide-add').on('click', function () {
    $('.slide_frame05').removeClass('select');
    $('.slide_frame05 .img_box').addClass('select');
    $(this).parents('.form-group').find('.btn-group').hide('');

  });

  $('.slide_frame02 .slide-minus').on('click', function () {
    $('.slide_frame02').addClass('select');
    $('.slide_frame02 img').remove();
    $(this).parents('.form-group').find('input').val('');
    $('.slide_frame02 img').remove();
    $('.slide_frame01 .btn-group').show();


  });
  $('.slide_frame03 .slide-minus').on('click', function () {
    $('.slide_frame03').addClass('select');
    $('.slide_frame03 img').remove();
    $(this).parents('.form-group').find('input').val('');
    $('.slide_frame02 .btn-group').show();

  });
  $('.slide_frame04 .slide-minus').on('click', function () {
    $('.slide_frame04').addClass('select');
    $('.slide_frame04 img').remove();
    $(this).parents('.form-group').find('input').val('');
    $('.slide_frame03 .btn-group').show();
  });
  $('.slide_frame05 .slide-minus').on('click', function () {
    $('.slide_frame05').addClass('select');
    $('.slide_frame05 img').remove();
    $(this).parents('.form-group').find('input').val('');
    $('.slide_frame04 .btn-group').show();
  });

var selected = $('#color').data('color');
$('#color option').each(function () {
  var colorsct = $(this).attr('value');
  if (colorsct == selected) {
    $(this).attr('selected', 'selected')
  }
})
var colorbtn = $('input[name="custom_data[custom_top_page][site_color]"]');
colorbtn.on('click', function () {
  colorbtn.parents('label').removeClass('checked')
  $(this).parents('label').addClass('checked')
})
var selected = $('.form-inline').data('selected');
$('#color-' + selected).parents('label').addClass('checked')
$('#color-' + selected).attr('checked', 'checked')
var fontselected = $('.font-size').data('font');
$('#font-' + fontselected).attr('checked', 'checked')

})(jQuery);
