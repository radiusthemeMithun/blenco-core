<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $items                      string
 * @var $title_tag                  string
 * @var $project_scroll_animation   string
 
 */

use Elementor\Icons_Manager;

$animation_class = ( ! empty( $project_scroll_animation ) && 'yes' === $project_scroll_animation ) ? 'rt-scale-animation' : '';

?>
<div class="rt-project-fun <?php echo esc_attr( $animation_class ); ?>">
    <div class="rt-project-fun-wrap">
        <?php 
        foreach ( $items as $item ): 
            $attr = '';
            if ( !empty( $item['url']['url'] ) ) {
                $attr  = 'href="' . $item['url']['url'] . '"';
                $attr .= !empty( $item['url']['is_external'] ) ? ' target="_blank"' : '';
                $attr .= !empty( $item['url']['nofollow'] ) ? ' rel="nofollow"' : '';
            }
        ?>   
        <div class="rt-funfact-panel">
            <div class="project-item">
                <?php if( !empty( $item['image']['id'] ) ) { ?>
                    <div class="project-thumbs">
                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
                    </div>
                <?php } ?>
                <div class="fun-content">
                    <div class="project-cat"><?php echo blenco_html( $item['category'], 'allow_title' );?></div>
                        <?php if( $item['title'] ) { ?><<?php echo esc_attr( $title_tag ) ?> class="fun-title">
                        <a class="title-link" <?php echo $attr; ?>><?php echo blenco_html( $item['title'], 'allow_title' );?></a></<?php echo esc_attr( $title_tag ) ?>>
                    <?php } ?>
                    <div class="rt-content"><?php echo blenco_html( $item['content'], 'allow_title' );?></div>
                    <?php if ( !empty($item['btn_text']) ) : ?>
                        <div class="rt-button">
                            <a class="btn button-4" <?php echo $attr; ?> aria-label="project link">

                                <span class="btn-icon">
                                    <?php 
                                    if ( !empty( $item['btn_icon'] ) ) { 
                                        \Elementor\Icons_Manager::render_icon( $item['btn_icon'] ); 
                                    }
                                    ?>
                                </span>

                                <span class="btn-text">
                                    <?php echo esc_html( $item['btn_text'] ); ?>
                                </span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>