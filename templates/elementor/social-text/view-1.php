<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $list                   string
 * @var $animation              string
 * @var $animation_effect       string
 * @var $delay                  string
 * @var $duration               string
 */


?>

<div class="rt-social-text">
    <?php if ( $label ): ?>
        <label><?php blenco_html( $label, 'allow_title' ); ?></label>
    <?php endif; ?>
    
    <ul class="text-list-box">
        <?php 
        $ade = $delay; 
        $adu = $duration;

        foreach( $list as $item ):

            $link = $item['link'] ?? [];

            $attr = '';
            if ( ! empty( $link['url'] ) ) {
                $attr  = 'href="' . esc_url( $link['url'] ) . '"';
                $attr .= ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
                $attr .= ! empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
            }
        ?>
        
        <li class="text-list elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> 
            <?php echo esc_attr( $animation ); ?> 
            <?php echo esc_attr( $animation_effect ); ?>"
            data-wow-delay="<?php echo esc_attr( $ade ); ?>ms" 
            data-wow-duration="<?php echo esc_attr( $adu ); ?>ms">

            <a <?php echo $attr; ?>>
                <?php if ( ! empty( $item['text'] ) ) : ?>
                    <span class="social-text">
                        <?php echo blenco_html( $item['text'], 'allow_title' ); ?>
                    </span>
                <?php endif; ?>
               <?php if ( $separator_display ) { ?>
                    <span class="rt-separator"></span>
                <?php } ?>
            </a>
        </li>

        <?php 
            $ade = $ade + 200; 
        endforeach; 
        ?>
    </ul>
</div>
