<?php
//phpcs:disable
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blenco
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class('blenco-header-footer'); ?>>
<?php wp_body_open(); ?>

<!-- preloader -->
<?php if ( blenco_option( 'rt_preloader' ) ) {
	if( !empty( blenco_option( 'rt_preloader_logo' ) ) ) { ?>
		<div id="preloader"><?php echo wp_get_attachment_image( blenco_option( 'rt_preloader_logo' ), 'full', true );?></div>
	<?php } else { ?>
		<div id="preloader" class="loader">
			<div class="cssload-loader">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
		</div>
	<?php }
}
?>

<!-- ajax search overlay -->
<div class="rt-focus"></div>

<div id="page" class="site">

	<?php do_action( 'rt_hf_header_markup' ); ?>
	<div class="rt-smooth" id="rt_smooth"></div>
	<div id="smooth-wrapper">
	<div id="smooth-content">

    <div id="content" class="site-content">
		<?php get_template_part( 'views/content', 'banner' ); ?>
