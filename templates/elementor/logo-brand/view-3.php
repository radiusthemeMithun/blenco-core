<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $logos                  string
 * @var $item_space             string
 * @var $logo_color_mode        string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 */



?>
<div class="logo-marquee-wrap">
    <div class="rt-marquee <?php echo esc_attr( $marquee_direction );?>">
        <div class="rt-marquee-item">
            <div class="rt-logo-brand">
                <?php $ade = $delay; $adu = $duration;
                foreach ( $logos as $logo ):
                    $attr = '';
                    if ( !empty( $logo['url']['url'] ) ) {
                        $attr  = 'href=' . esc_url( $logo['url']['url'] );
                        $attr .= !empty( $logo['url']['is_external'] ) ? ' target=_blank' : '';
                        $attr .= !empty( $logo['url']['nofollow'] ) ? ' rel=nofollow' : '';
                    }

                    ?>
                    <?php if ( empty( $logo['image']['id'] ) ) continue; ?>
                    <div class="logo-box <?php echo esc_attr( $logo_color_mode );?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                        <?php if ( $display_shape == 'yes' ) { ?>
                                <div class="round-shape"></div>
                        <?php } ?> 
                        <?php if( $attr ) : ?>
                        <a <?php echo esc_attr($attr) ?> aria-label="brand logo">
                        <?php endif ?>
                            <?php echo wp_get_attachment_image( $logo['image']['id'], 'full' ); ?>
                        <?php if( $attr ) : ?>
                        </a>
                        <?php endif ?>
                    </div>
                    
                <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
            </div>
        </div>
        <div class="rt-marquee-item">
            <div class="rt-logo-brand">
                <?php $ade = $delay; $adu = $duration;
                foreach ( $logos as $logo ):
                    $attr = '';
                    if ( !empty( $logo['url']['url'] ) ) {
                        $attr  = 'href=' . esc_url( $logo['url']['url'] );
                        $attr .= !empty( $logo['url']['is_external'] ) ? ' target=_blank' : '';
                        $attr .= !empty( $logo['url']['nofollow'] ) ? ' rel=nofollow' : '';
                    }

                    ?>
                    <?php if ( empty( $logo['image']['id'] ) ) continue; ?>
                    <div class="logo-box <?php echo esc_attr( $logo_color_mode );?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                        <?php if ( $display_shape == 'yes' ) { ?>
                                <div class="round-shape"></div>
                        <?php } ?> 
                        <?php if( $attr ) : ?>
                        <a <?php echo esc_attr($attr) ?> aria-label="brand logo">
                        <?php endif ?>
                            <?php echo wp_get_attachment_image( $logo['image']['id'], 'full' ); ?>
                        <?php if( $attr ) : ?>
                        </a>
                        <?php endif ?>
                    </div>
                    
                <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
            </div>
        </div>
    </div>
</div>
