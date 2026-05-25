<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$items = array();

if ( !empty($portfolio_items) && is_array($portfolio_items) ) {
    foreach ( $portfolio_items as $item ) {

        $items[] = array(
            'image'        => !empty($item['image']['url']) ? $item['image']['url'] : "",
            'title'        => !empty($item['title']) ? $item['title'] : "",
            'link'         => !empty($item['link']['url']) ? $item['link']['url'] : '#',

            'sub_title'    => !empty($item['sub_title']) ? $item['sub_title'] : "",
            'content'      => !empty($item['content']) ? $item['content'] : "",
            'button_text'  => !empty($item['button_text']) ? $item['button_text'] : "",
            'button_url'   => !empty($item['button_url']['url']) ? $item['button_url']['url'] : "#",
        );
    }
}

$title_tag = !empty($title_tag) ? $title_tag : 'h2';
?>

<div class="rt-slicer-effect">
    <div class="rt-slicer">

        <div class="swiper slicer-active" data-xld="<?php echo esc_attr($swiper_data); ?>">
            <div class="swiper-wrapper">

                <?php $i = 1; foreach ( $items as $portfolio ) { ?>
                    <div class="swiper-slide slide-<?php echo esc_attr($i); ?>">
                        <div class="slicer__item">

                            <?php if ( !empty($portfolio['image']) ) { ?>
                                <img class="swiper-slicer-image"
                                    src="<?php echo esc_url($portfolio['image']); ?>"
                                    alt="<?php echo esc_attr($portfolio['title']); ?>" />
                            <?php } ?>

                            <div class="slide-content">
                                <div class="grid-mask"></div>
                            </div>
                            <div class="slider-content">

                                <?php if( !empty($portfolio['sub_title']) ) { ?>
                                    <div class="sub-title">
                                        <?php echo blenco_html( $portfolio['sub_title'], 'allow_title' ); ?>
                                    </div>
                                <?php } ?>

                                <?php if( !empty($portfolio['title']) ) { ?>
                                    <<?php echo esc_attr($title_tag); ?> class="slider-title">
                                        <?php echo blenco_html( $portfolio['title'], 'allow_title' ); ?>
                                    </<?php echo esc_attr($title_tag); ?>>
                                <?php } ?>

                                <?php if( !empty($portfolio['content']) ) { ?>
                                    <div class="slider-text">
                                        <?php echo blenco_html( $portfolio['content'], 'allow_title' ); ?>
                                    </div>
                                <?php } ?>

                                <?php if( !empty($portfolio['button_text']) ) { ?>
                                    <div class="slider-btn-area rt-button">
                                        <a class="btn" href="<?php echo esc_url( $portfolio['button_url'] ); ?>">
                                            <span class="btn-icon">
                                                <i class="icon-rt-arrow-right-1"></i>
                                            </span>
                                            <span class="btn-text">
                                                <?php echo blenco_html( $portfolio['button_text'], 'allow_title' ); ?>
                                            </span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                <?php $i++; } ?>

            </div>

            <?php if ( $display_pagination == 'yes' ) { ?>
                <div class="rt-slicer-pagination"></div>
            <?php } ?>

        </div>

    </div>
</div>
