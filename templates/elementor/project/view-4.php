<?php
//phpcs:disable
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * @var $post_limit                 string
 * @var $post_ordering              string
 * @var $post_orderby               string
 * @var $query_type                 string
 * @var $content_count              string
 * @var $content_type               string
 * @var $layout                     string
 * @var $item_space                 string
 * @var $col_xl                     string
 * @var $col_lg                     string
 * @var $col_md                     string
 * @var $col_sm                     string
 * @var $col_xs                     string
 * @var $category_display           string
 * @var $button_display             string
 * @var $content_display            string
 * @var $title_tag                  string
 * @var $project_thumbnail_size     string
 * @var $grayscale_display          string
 * @var $button_icon                string
 * @var $link_popup                 string
 * @var $animation                  string
 * @var $animation_effect           string
 * @var $delay                      string
 * @var $duration                   string
 */


use Elementor\Icons_Manager;

$args = array(
	'post_type'      	=> 'rt-project',
	'posts_per_page' 	=> $post_limit,
	'order' 			=> $post_ordering,
	'orderby' 			=> $post_orderby,
);

if( !empty( $cat_id ) ){
	if( $query_type == 'category'){
		$args['tax_query'] = [
			[
				'taxonomy' => 'rt-project-category',
				'field' => 'term_id',
				'terms' => $cat_id,
			],
		];
	}
}
if( !empty( $post_id ) ){
	if( $query_type == 'posts'){
		$args['post__in'] = $post_id;
	}
}

$thumb_size = '';
if( $project_thumbnail_size ) {
	$thumb_size = $project_thumbnail_size;
} else {
	$thumb_size = 'full';
}

$query = new WP_Query( $args );
$col_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-xs-{$col_xs}";

?>
<div class="rt-project-default rt-project-multi-layout-default project-grid-<?php echo esc_attr( $layout );?>">
	<div class="row <?php echo esc_attr( $item_space );?>">
		<?php $ade = $delay; $adu = $duration; if ( $query->have_posts() ) {
			$j = 1;
			while ( $query->have_posts() ) {
				$query->the_post();
				$id = get_the_ID();

				if ( $content_type == 'content' ) {
					$content = apply_filters( 'the_content', get_the_content() );
				}
				else {
					$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
				}
				$content = wp_trim_words( $content, $content_count, '' );
				$content = "$content";
				

				?>
                <div class="<?php echo esc_attr( $col_class );?> <?php echo esc_attr( $animation );?> <?php echo esc_attr( $animation_effect );?>" data-wow-delay="<?php echo esc_attr( $ade );?>ms" data-wow-duration="<?php echo esc_attr( $adu );?>ms">
                    <div class="project-item">
						<?php
							$project_url = esc_url( 'http://blenco.local/project/' );

							$cursor_text_content = '';

							if ( ! empty( $enable_cursor_button ) && $enable_cursor_button === 'yes' ) {

								$button_text = ! empty( $cursor_btn_text ) 
									? $cursor_btn_text 
									: "View All <br> Project";

								$cursor_text_content = <<<HTML
									<a class="rt-project-btn" href="{$project_url}">
										<span class="btn-text">{$button_text}
											<i class="icon-rt-arrow-right-1"></i>
										</span>
									</a>
								HTML;
							}
							?>

							<div class="project-thumbs
								<?php if( empty( $button_display ) ) { ?>shape-hidden<?php } ?> <?php echo esc_attr( $grayscale_display );?>"
								data-cursor-text='<?php echo wp_kses_post( $cursor_text_content ); ?>'
								data-cursor-text-portfolio>
									<?php blenco_post_thumbnail( esc_attr( $thumb_size ) ); ?>
							</div>
						<div class="project-content">
                            <div class="project-info">
								<?php if ( ! empty( $project_date_display == 'yes' ) ) : ?>
									<span class="project-date">
										<?php echo esc_html( get_the_date( 'd M, Y' ) ); ?>
									</span>
								<?php endif; ?>
				                <?php if ( $category_display ) { ?>
                                    <span class="project-cat"><?php
						                $i = 1;
						                $term_lists = get_the_terms( get_the_ID(), 'rt-project-category' );
						                if( $term_lists ) {
							                foreach ( $term_lists as $term_list ){
								                $link = get_term_link( $term_list->term_id, 'rt-project-category' ); ?>
								                <?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>">
								                <?php echo esc_html( $term_list->name ); ?></a><?php $i++; } } ?></span>
				                <?php } ?> <<?php echo esc_attr( $title_tag ); ?> class="project-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</<?php echo esc_attr( $title_tag ); ?>>
								<?php if ( $content_display == 'yes' ) { ?>
                                    <div class="project-excerpt"><?php blenco_html( $content , false ); ?></div>
				                <?php } ?>
                            </div>
                            <?php if( $button_display == 'yes' ) { ?>
                                <div class="rt-button">
                                    <?php if( $link_popup == 'popup' ) { ?>
                                        <a class="btn" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>"
                                           data-elementor-open-lightbox="yes"
                                           data-elementor-lightbox-slideshow="1"
                                           data-elementor-lightbox-title="<?php echo get_the_title(); ?>">
                                            <?php Icons_Manager::render_icon( $button_icon ); ?></a>
                                    <?php } else { ?>
                                        <a class="btn button-4" href="<?php the_permalink();?>" aria-label="project link">
											<span class="btn-icon">
												<?php if ( ! empty( $button_icon ) ) { 
													\Elementor\Icons_Manager::render_icon( $button_icon ); 
												} ?>
											</span>
											<span class="btn-text"><?php echo esc_html( $btn_text ); ?></span>
										</a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
							<?php if($project_number_display == 'yes') { ?>
								<span class="rt-project-number">0<?php echo esc_attr( $j );?></span>
							<?php } ?>
                        </div>
                    </div>
                </div>
            <?php $ade = $ade + 200; $adu = $adu + 0; $j++;} ?>
		<?php } ?>
	</div>
</div>