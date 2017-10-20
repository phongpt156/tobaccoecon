<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="tobacco-site-branding">
	<div class="">

		<?php the_custom_logo(); ?>

		<div class="site-branding-text py-4 pl-5 pr-3">
            <h1 class="tobacco-title px-4 py-2 text-uppercase font-weight-bold"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="d-inline-block"><?php bloginfo( 'name' ); ?></a></h1>
		</div><!-- .site-branding-text -->

		<?php if ( ( twentyseventeen_is_frontpage() || ( is_home() && is_front_page() ) ) && ! has_nav_menu( 'top' ) ) : ?>
			<a href="#content" class="menu-scroll-down"><?php echo twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'twentyseventeen' ); ?></span></a>
		<?php endif; ?>
	</div>
</div>
