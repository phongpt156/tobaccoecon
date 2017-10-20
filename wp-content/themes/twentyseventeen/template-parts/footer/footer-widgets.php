<?php
/**
 * Displays footer widgets if assigned
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php
if ( is_active_sidebar( 'sidebar-2' ) ||
	 is_active_sidebar( 'sidebar-3' ) ) :
?>

	<aside class="widget-area custom-footer container py-4" role="complementary">
		<div class="d-md-flex flex-row">
			<div class="w-100">
				<p class="mb-4 h3 text-white">Contact us</p>
				<p class="mb-1 text-white">University of Illinois at Chicago</p>
				<p class="mb-1 text-white">Institute for Health Research and Policy</p>
				<p class="mb-1 text-white">Attn: Tobacconomics</p>
				<p class="mb-1 text-white">1747 W. Roosevelt Road</p>
				<p class="mb-1 text-white">5th Floor (Room 558)</p>
			</div>
			<div>
				<?php
				if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
					<div class="widget-column footer-widget-1">
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div>
				<?php }
				if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
					<div class="widget-column footer-widget-2">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<hr style="height: 3px; background-color: #b3895d" />
		<div class="d-md-flex flex-row" style="padding-top: 3em">
			<div class="w-100">
				<div class="text-white text-uppercase h4 mb-4">
					<div>
						<span class="font-weight-bold">uic</span> <span>institute for health</span>
					</div>
					<div>
						research and policy
					</div>
				</div>
				<p class="text-white w-50">
					Tobacconomics is directed by Frank Chaloupka, PhD, and administered by the Institute for Health Research and Policy of the University of Illinois at Chicago. This website was developed with support by the National Cancer Institute of the National Institutes of Health (Grant No. U01-CA154248) as part of the NCI State and Community Tobacco Control Research Initiative. The contents of this Web site are solely the responsibility of the authors and do not necessarily represent the official views of the NIH or the State of Illinois. Privacy Policy
				</p>
			</div>
			<div style="width: 511.20px">
				<?php twitter_like_box($username="twitter", $total=10) ?>
			</div>
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
