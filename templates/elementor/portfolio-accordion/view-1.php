<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $portfolio_items  array
 * @var $title_tag        string
 */



if ( empty( $portfolio_items ) ) {
	return;
}

$portfolios = [];
foreach ( $portfolio_items as $portfolio_list ) {
	$portfolios[] = [
		'category'     => $portfolio_list['rt_category'],
		'title'        => $portfolio_list['title'],
		'title_url'    => !empty( $portfolio_list['title_url']['url'] ) ? $portfolio_list['title_url']['url'] : '',
		'img'          => !empty( $portfolio_list['portfolio_image']['url'] ) ? $portfolio_list['portfolio_image']['url'] : '',
        'content'      => !empty( $portfolio_list['portfolio_content'] ) ? $portfolio_list['portfolio_content'] : '', // new field
	];
}
?>

<div class="rt-portfolio-accordion">
	<div class="rt-portfolio-accordion-wrap">
		<?php foreach ( $portfolios as $index => $portfolio ) : ?>
			<div class="item item-<?php echo esc_attr( $index + 1 ); ?>" data-background="<?php echo esc_attr( $portfolio['img'] ); ?>">
				<div class="content">
					<div class="inner">
						<?php if ( ! empty( $portfolio['category'] ) ) : ?>
							<span class="portfolio-cat">
								<?php echo esc_html( $portfolio['category'] ); ?>
							</span>
						<?php endif; ?>

						<?php if ( ! empty( $portfolio['title'] ) ) : ?>
							<<?php echo esc_attr( $title_tag ); ?> class="accordion-title">
								<?php if ( ! empty( $portfolio['title_url'] ) ) : ?>
									<a href="<?php echo esc_url( $portfolio['title_url'] ); ?>">
										<?php echo blenco_html( $portfolio['title'], 'allow_title' ); ?>
									</a>
								<?php else : ?>
									<?php echo blenco_html( $portfolio['title'], 'allow_title' ); ?>
								<?php endif; ?>
							</<?php echo esc_attr( $title_tag ); ?>>
						<?php endif; ?>
                        <?php if ( ! empty( $portfolio['content'] ) ) : ?>
							<div class="accordion-content">
								<?php echo esc_html( $portfolio['content'] ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
