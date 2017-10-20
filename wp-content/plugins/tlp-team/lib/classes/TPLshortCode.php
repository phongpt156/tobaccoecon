<?php

if ( ! class_exists( 'TPLshortCode' ) ):

	/**
	 *
	 */
	class TPLshortCode {

		function __construct() {
			add_shortcode( 'tlpteam', array( $this, 'team_shortcode' ) );

		}

		function team_shortcode( $atts ) {

			global $TLPteam;
			$atts = shortcode_atts( array(
				'layout'            => 1,
				'member'            => null,
				'col'               => 3,
				'orderby'           => 'date',
				'order'             => 'DESC',
				'name-color'        => null,
				'designation-color' => null,
				'sd-color'          => null
			), $atts, 'tlpteam' );

			if ( ! in_array( $atts['col'], array_keys( $TLPteam->scColumns() ) ) ) {
				$atts['col'] = 3;
			}
			if ( ! in_array( $atts['layout'], array_keys( $TLPteam->scLayouts() ) ) ) {
				$atts['layout'] = 1;
			}
			$posts_per_page = $atts['member'] ? absint( $atts['member'] ) : '-1';

			$html = null;

			$args = array(
				'post_type'      => 'team',
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per_page,
				'orderby'        => $atts['orderby'],
				'order'          => $atts['order']
			);
			if ( is_user_logged_in() && is_super_admin() ) {
				$args['post_status'] = array( 'publish', 'private' );
			}
			$settings      = get_option( $TLPteam->options['settings'] );
			$fImgSize      = ! empty( $settings['feature_img_size'] ) ? $settings['feature_img_size'] : $TLPteam->options['feature_img_size'];
			$customImgSize = ! empty( $settings['rt_custom_img_size'] ) ? $settings['rt_custom_img_size'] : array();

			$teamQuery = new WP_Query( $args );
			$layoutID  = "tlp-team-" . mt_rand();
			if ( $teamQuery->have_posts() ) {
				$html .= "<div class='container-fluid tlp-team' id='{$layoutID}'>";
				$html .= $this->customStyle( $layoutID, $atts );
				if ( $atts['layout'] == 'isotope' ) {
					$html .= '<div class="button-group sort-by-button-group">
									<button data-sort-by="original-order" class="selected">Default</button>
									<button data-sort-by="name">Name</button>
									  <button data-sort-by="designation">Designation</button>
								  </div>';
					$html .= '<div class="tlp-team-isotope">';
				}
				if ( $atts['layout'] != 'isotope' ) {
					$html .= '<div class="row layout' . $atts['layout'] . '">';
				}
				while ( $teamQuery->have_posts() ) : $teamQuery->the_post();
					$pID         = get_the_ID();
					$title       = get_the_title();
					$pLink       = get_permalink();
					$loc = get_post_meta( get_the_ID(), 'location', true );
					$email = get_post_meta( get_the_ID(), 'email', true );
					$tel = get_post_meta( get_the_ID(), 'telephone', true );
					$short_bio   = get_post_meta( get_the_ID(), 'short_bio', true );
					$designation = get_post_meta( get_the_ID(), 'designation', true );

					if ( has_post_thumbnail() ) {
						$imgSrc = $TLPteam->getFeatureImageSrc( $pID, $fImgSize, $customImgSize );
					} else {
						$imgSrc = $TLPteam->assetsUrl . 'images/demo.jpg';
					}
					$grid = $atts['col'] == 5 ? '24' : 12 / $atts['col'];

					if ( $atts['col'] == 2 ) {
						$image_area   = "tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 ";
						$content_area = "tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 ";
					} else {
						$image_area   = "tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 ";
						$content_area = "tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 ";
					}

					$sLink = unserialize( get_post_meta( get_the_ID(), 'social', true ) );
					$html .= "<div class='team-member tlp-col-md-{$grid} tlp-col-sm-6 tlp-col-xs-12 tlp-equal-height'>";
					switch ( $atts['layout'] ) {
						case 1:
							$html .= $this->layoutOne( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $loc, $email, $tel );
							break;

						case 2:
							$html .= $this->layoutTwo( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink,
								$image_area, $content_area, $loc, $email, $tel );
							break;

						case 3:
							$html .= $this->layoutThree( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink,
								$image_area, $content_area, $loc, $email, $tel );
							break;

						case 'isotope':
							$html .= $this->layoutIsotope( $title, $pLink, $imgSrc, $designation, $grid, $loc, $email, $tel );
							break;

						default:
							# code...
							break;
					}
					$html .= "</div>";

				endwhile;
				if ( $atts['layout'] != 'isotope' ) {
					$html .= '</div>'; // End row
				}
				wp_reset_postdata();
				// end row
				if ( $atts['layout'] == 'isotope' ) {
					$html .= '</div>'; // end tlp-team-isotope
				}
				$html .= '</div>'; // end container
			} else {
				$html .= "<p>" . __( 'No member found', TLP_TEAM_SLUG ) . "</p>";
			}

			return $html;
		}

		function layoutOne( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $loc, $email, $tel ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
			} else {
				$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
			}
			$html .= '<div class="tlp-content">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="name">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="name"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			if ( $designation ) {
				$html .= '<div class="designation">' . $designation . '</div>';
			}
			$html .= '</div>';
			$html .= '<div class="short-bio">';
			if ( $short_bio ) {
				$html .= '<p>' . $short_bio . '</p>';
			}
			$html .= '</div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutTwo( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $image_area, $content_area, $loc, $email, $tel ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			$html     .= '<div class="' . $image_area . '">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
			} else {
				$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
			}
			$html .= '</div>';

			$html .= '<div class="' . $content_area . '">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="tlp-title">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="tlp-title"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			$html .= '<div class="designation">' . $designation . '</div>';
			$html .= '<div class="short-bio">
							    	<p>' . $short_bio . '</p>
							    </div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';
			
			$html .= '<div>' . $loc . '</div>';
			$html .= '<div>' . $email . '</div>';
			$html .= '<div>' . $tel . '</div>';

			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutThree( $title, $pLink, $imgSrc, $designation, $short_bio, $sLink, $image_area, $content_area, $loc, $email, $tel ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area text-center d-flex justify-content-center">';
			$html     .= '<div class="' . $image_area . 'round-img" style="z-index:100;width:auto;top:-90px;position:absolute">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '" style="width:180px;height:180px"/>';
			} else {
				// $html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
				$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '" style="width:180px;height:180px"/>';
			}
			$html .= '</div>';

			$html .= '<div class="' . $content_area . 'custom-aboutus" style="position: relative;background-color: #ff952f">';
			$html .= '<div class="custom-aboutus-info">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="tlp-title text-white">' . $title . '</h3>';
			} else {
				// $html .= '<h3 class="tlp-title text-white"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
				$html .= '<h3 class="tlp-title text-white">' . $title . '</h3>';
			}

			$locale = get_locale();
			if ($locale == 'vi') {
				$html .= '<div class="text-white">Địa chỉ: ' . $loc . '</div>'; // location
				$html .= '<div class="text-white">Email: ' . $email . '</div>'; // email
				$html .= '<div class="text-white">Mobile: ' . $tel . '</div>'; // telephone
			} else {
				$html .= '<div class="text-white">Address: ' . $loc . '</div>'; // location
				$html .= '<div class="text-white">Email: ' . $email . '</div>'; // email
				$html .= '<div class="text-white">Mobile: ' . $tel . '</div>'; // telephone
			}
			$html .= '</div>';

			$html .= '<div class="designation">' . $designation . '</div>';
			$html .= '<div class="short-bio">
						    	<p>' . $short_bio . '</p>
						    </div>';
			$html .= '<div class="tpl-social">';
			if ( $sLink ) {
				foreach ( $sLink as $id => $link ) {
					$html .= "<a href='{$sLink[$id]}' title='$id' target='_blank'><i class='fa fa-$id'></i></a>";
				}
			}
			$html .= '</div>';

			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		function layoutIsotope( $title, $pLink, $imgSrc, $designation, $grid, $loc, $email, $tel ) {
			global $TLPteam;
			$settings = get_option( $TLPteam->options['settings'] );
			$html     = null;
			$html     .= '<div class="single-team-area">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/>';
			} else {
				$html .= '<a title="' . $title . '" href="' . $pLink . '"><img class="img-responsive" src="' . $imgSrc . '" alt="' . $title . '"/></a>';
			}
			$html .= '<div class="tlp-content">';
			if ( $settings['link_detail_page'] == 'no' ) {
				$html .= '<h3 class="name">' . $title . '</h3>';
			} else {
				$html .= '<h3 class="name"><a title="' . $title . '" href="' . $pLink . '">' . $title . '</a></h3>';
			}
			if ( $designation ) {
				$html .= '<div class="designation">' . $designation . '</div>';
			}
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}

		private function customStyle( $layoutID, $atts ) {
			$style       = null;
			$name        = ! empty( $atts['name-color'] ) ? $atts['name-color'] : null;
			$designation = ! empty( $atts['designation-color'] ) ? $atts['designation-color'] : null;
			$sd          = ! empty( $atts['sd-color'] ) ? $atts['sd-color'] : null;
			if ( $name ) {
				$style .= "#{$layoutID} .single-team-area h3,
							#{$layoutID} .single-team-area h3 a{ color: {$name};}";
			}
			if ( $designation ) {
				$style .= "#{$layoutID} .single-team-area .designation{ color: {$designation};}";
			}
			if ( $sd ) {
				$style .= "#{$layoutID} .single-team-area .short-bio{ color: {$sd};}";
			}

			if ( ! empty( $style ) ) {
				$style = "<style>{$style}</style>";
			}

			return $style;

		}


	}

endif;
