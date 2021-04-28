<?php
$post_name = get_query_var('postname');
$post_count = get_query_var('post_count');
$max_header = get_query_var('max_header');
$max_text = get_query_var('max_text');
$args = array(
    'post_type' => $post_name,
    'posts_per_page' => $post_count,
    'orderby' => 'date',
    'order' => 'DESC',
); ?>
<?php $my_query = new WP_Query($args); ?>

<section class="d-flex align-items-center" id="head">
    <div class="swiper-container">
        <!-- 全スライドをまとめるラッパー -->
        <div class="swiper-wrapper">
            <!-- 各スライド -->
            <div class="swiper-slide">
                <span><?php echo $slide_01_src ?>
                </span>
            </div>

        </div>

        <!-- ページネーションを表示する場合 -->
        <div id="swiper-pagination" class="swiper-pagination"></div>



        <!-- 前後スライドへのナビゲーションボタン(矢印)を表示する場合 -->

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>


    </div>


</section>