<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $top_sub_title                  string
 * @var $sub_title_style                string
 * @var $top_title_icon                 string
 * @var $icon_position                  string
 * @var $title                          string
 * @var $main_title_tag                 string
 * @var $title_image_aline              string
 * @var $animation                      string
 * @var $animation_effect               string
 * @var $delay                          string
 * @var $duration                       string
 *
 */

?>
<div class="section-title-wrapper">
	<div class="title-inner-wrapper">
		<!--Top Sub Title-->
		<?php if ( $top_sub_title ): ?>
            <div class="top-sub-title-wrap <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="200ms" data-wow-duration="1200ms">

                <!-- Left Shape -->
                <?php if ( 'yes' === $left_shape_display && !empty( $left_shape_image['url'] ) ) : ?>
                    <span class="sub-title-shape sub-title-shape-left <?php echo $animation_spin? 'move-animation' : ''; ?>">
                        <?php echo wp_get_attachment_image( $left_shape_image['id'], 'full' ); ?>
                    </span>
                <?php endif; ?>

                <!-- Subtitle -->
                <span class="top-sub-title <?php echo esc_attr( $sub_title_style );?>">
                    <?php
                    if ( $top_title_icon && ( 'left' == $icon_position || 'both' == $icon_position ) ) {
                        echo '<i style="margin-right:5px" class="' . $top_title_icon . '" aria-hidden="true"></i>';
                    }
                    echo esc_html( $top_sub_title );
                    if ( $top_title_icon && ( 'right' == $icon_position || 'both' == $icon_position ) ) {
                        echo '<i style="margin-left:5px;transform:scaleX(-1)" class="' . $top_title_icon . '" aria-hidden="true"></i>';
                    }
                    ?>
                </span>

                <!-- Right Shape -->
                <?php if ( 'yes' === $right_shape_display && !empty( $right_shape_image['url'] ) ) : ?>
                    <span class="sub-title-shape sub-title-shape-right <?php echo $animation_spin? 'move-animation' : ''; ?>">
                        <?php echo wp_get_attachment_image( $right_shape_image['id'], 'full' ); ?>
                    </span>
                <?php endif; ?>

            </div>
        <?php endif; ?>

		<!--Main Title-->
		<?php if ( $title ): ?>
        <div class="<?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="400ms" data-wow-duration="1200ms">
            <<?php echo esc_attr( $main_title_tag ) ?> class="main-title <?php echo $title_animation_2? 'rt-text-title' : ''; ?> <?php echo esc_attr( $title_image_aline );?>"><?php blenco_html( $title, 'allow_title' );?>
	        
        </<?php echo esc_attr( $main_title_tag ) ?>>
        </div>
        <?php endif; ?>
    </div>
</div>