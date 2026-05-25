
<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author   RadiusTheme
 * @since    1.0
 * @version  1.0
 * @var $portfolio_slider_items  array
 * @var $title_tag         string
 */


if ( empty( $portfolio_slider_items ) ) {
    return;
}

$portfolios = [];
foreach ( $portfolio_slider_items as $portfolio_list ) {
    $portfolios[] = [
        'content'     => $portfolio_list['content'],
        'title'     => $portfolio_list['title'],
        'title_url' => !empty( $portfolio_list['title_url']['url'] ) ? $portfolio_list['title_url']['url'] : '',
        'img'       => !empty( $portfolio_list['portfolio_image']['url'] ) ? $portfolio_list['portfolio_image']['url'] : '',
    ];
}
?>

<div class="rt-port-slider-area">
    <div class="rt-port-slider-main">
        <div id="rt-port-slider-wrap" class="rt-port-1 rt-port-slider-wrap">
            <?php foreach ( $portfolios as $index => $portfolio ) : 
                $count = $index + 1; 
            ?>
                <div class="rt-port-slider-thumb rt-port-<?php echo esc_attr( $count ); ?>">
                    <?php if ( ! empty( $portfolio['img'] ) ) : ?>
                        <img src="<?php echo esc_url( $portfolio['img'] ); ?>" alt="<?php echo esc_attr( $portfolio['title'] ); ?>">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="rt-port-slider-content-wrap">
            <div class="rt-port-slider-content">
                <?php foreach ( $portfolios as $index => $portfolio ) : 
                    $count = $index + 1;
                    $active_class = ( $index === 0 ) ? ' active' : '';
                ?>
                    <?php if ( ! empty( $portfolio['content'] ) ) : ?>
                        <span class="portfolio-content">
                            <?php echo esc_html( $portfolio['content'] ); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ( ! empty( $portfolio['title'] ) ) : ?>
                        <<?php echo esc_attr( $title_tag ); ?> class="rt-port-slider-title<?php echo esc_attr( $active_class ); ?>" rel="rt-port-<?php echo esc_attr( $count ); ?>">
                            <?php if ( ! empty( $portfolio['title_url'] ) ) : ?>
                                <a href="<?php echo esc_url( $portfolio['title_url'] ); ?>">
                                    <?php echo blenco_html( $portfolio['title'], 'allow_title' ); ?>
                                </a>
                            <?php else : ?>
                                <?php echo blenco_html( $portfolio['title'], 'allow_title' ); ?>
                            <?php endif; ?>
                        </<?php echo esc_attr( $title_tag ); ?>>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>