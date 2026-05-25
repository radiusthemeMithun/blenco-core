<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $scroll_image                   string
 * @var $title                          string
 * @var $title_tag                      string
 * @var $project_date_display           string
 */


use Elementor\Icons_Manager;

$attr = '';
if ( ! empty( $link ) && ! empty( $link['url'] ) ) {
	$attr  = 'href="' . esc_url( $link['url'] ) . '"';
	$attr .= ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
	$attr .= ! empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
	$attr .= ' aria-label="info link"';
}
?>

<div class="rt-project-scroll rt-scroll-trigger-scale">
	<div class="project-scroll-layout <?php echo $project_scroll_animation? 'rt-project-panel' : ''; ?>">
		<?php if ( ! empty( $scroll_image['id'] ) ) : ?>
			<div class="scroll-img ">
				<?php echo wp_get_attachment_image( $scroll_image['id'], 'full' ); ?>
			</div>
		<?php endif; ?>
		<div class="project-scroll-content">
			<?php if ( ! empty( $title ) ) : ?>
				<<?php echo esc_attr( $title_tag ); ?> class="scroll-title">
					<a <?php echo $attr; ?>>
						<?php blenco_html( $title, 'allow_title' ); ?>
					</a>
				</<?php echo esc_attr( $title_tag ); ?>>
			<?php endif; ?>


			<?php if ( ! empty( $project_date_display == 'yes' ) ) : ?>
				<span class="project-date">
					<?php echo esc_html( get_the_date( 'd M, Y' ) ); ?>
				</span>
			<?php endif; ?>

			<?php if ( ! empty( $content ) ) : ?>
				<p><?php blenco_html( $content, 'allow_content' ); ?></p>
			<?php endif; ?>
            <div class="rt-button">
                <?php if ( ! empty( $read_more_display == 'yes' ) ) { ?>
                    <a class="btn" 
                    <?php echo $attr; ?> 
                    aria-label="button link">
                        <span class="btn-icon">
                            <?php if ( ! empty( $button_icon ) ) { 
                                \Elementor\Icons_Manager::render_icon( $button_icon ); 
                            } ?>
                        </span>
                        <span class="btn-text"><?php echo esc_html( $btn_text ); ?></span>
                    </a>
                <?php } ?>
            </div>
		</div>
	</div>
</div>
