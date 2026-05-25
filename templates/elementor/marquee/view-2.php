<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $heading_tag                string
 * @var $marquee_direction          string
 * @var $icon_type                  string
 * @var $bgicon                     string
 * @var $image                      string
 * @var $items                      string
 * @var $gradient_display           string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 * @var $layout                     string
 * @var $image_logo                 string
 * @var $image_shape                string
 */



use Elementor\Icons_Manager;

?>
<div class="rt-marquee-slider rt-marquee-slider-<?php echo esc_attr( $layout ) ?>">
    <div class="rt-marquee <?php echo esc_attr( $marquee_direction );?>">
        <div class="rt-marquee-item">
	        <?php $ade = $delay; $adu = $duration; foreach ( $items as $item ) :
            $image_logo  = !empty( $item['image_logo']['id'] ) ? $item['image_logo']['id'] : '';
            $image_shape = !empty( $item['image_shape']['id'] ) ? $item['image_shape']['id'] : '';

			$attr = '';
			if ( !empty( $item['url']['url'] ) ) {
				$attr  = 'href="' . $item['url']['url'] . '"';
				$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
				$title = '<a ' . $attr . '>' . $item['title'] . '</a>';
			} else {
				$title = $item['title'];
			}
			?>
            <<?php echo esc_attr( $heading_tag ); ?> class="entry-title <?php if( $gradient_display == 'yes' ) { ?>title-gradient<?php } ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-per="<?php blenco_html( $item['title'], 'allow_title' );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
	        <?php blenco_html( $title, 'allow_title' ); ?>
            <div class="moving-shape-wrap">
                <div class="about-round-box">
                    <div class="moving-shape-box">
                        <div class="about-shape">
                            <div class="shape <?php echo $animation_spin? 'spin' : ''; ?>">
                                <?php 
                                    if ( $image_shape ) {
                                        echo wp_get_attachment_image( $image_shape, 'full' );
                                    }
                                 ?>
                            </div>
                        </div>
                        <div class="logo-image">
                            <?php 
                            if ( $image_logo ) {
                                echo wp_get_attachment_image( $image_logo, 'full' );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </<?php echo esc_attr( $heading_tag ); ?>>
		    <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
        </div>

        <div class="rt-marquee-item">
	        <?php $ade = $delay; $adu = $duration; foreach ( $items as $item ) :
            $image_logo  = !empty( $item['image_logo']['id'] ) ? $item['image_logo']['id'] : '';
            $image_shape = !empty( $item['image_shape']['id'] ) ? $item['image_shape']['id'] : '';

              			$attr = '';
			if ( !empty( $item['url']['url'] ) ) {
				$attr  = 'href="' . $item['url']['url'] . '"';
				$attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
				$attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
				$title = '<a ' . $attr . '>' . $item['title'] . '</a>';
			} else {
				$title = $item['title'];
			}
			?>
            <<?php echo esc_attr( $heading_tag ); ?> class="entry-title <?php if( $gradient_display == 'yes' ) { ?>title-gradient<?php } ?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-per="<?php blenco_html( $item['title'], 'allow_title' );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
	        <?php blenco_html( $title, 'allow_title' ); ?>
            <div class="moving-shape-wrap">
                <div class="about-round-box">
                    <div class="moving-shape-box">
                        <div class="about-shape">
                            <div class="shape <?php echo $animation_spin? 'spin' : ''; ?>">
                                <?php 
                                    if ( $image_shape ) {
                                        echo wp_get_attachment_image( $image_shape, 'full' );
                                    }
                                 ?>
                            </div>
                        </div>
                        <div class="logo-image">
                            <?php 
                            if ( $image_logo ) {
                                echo wp_get_attachment_image( $image_logo, 'full' );
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </<?php echo esc_attr( $heading_tag ); ?>>
		    <?php $ade = $ade + 200; $adu = $adu + 0; endforeach; ?>
        </div>
    </div>
</div>