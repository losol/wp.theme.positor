<?php
/**
 * Template part for displaying grid with query posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Positor
 */

?>

<div class="row no-gutters bg-featured-grid">
<?php

	/**
	 * WP_Query arguments.
	 *
	 * @link https://codex.wordpress.org/Class_Reference/WP_Query
	 */
	$args = array(
		'posts_per_page' => '6',
		'orderby' => 'modified',
		'order' => 'desc',
		'post__not_in'   => get_option( 'sticky_posts' ),
		'meta_query' => array(
			array(
				'key'     => '_positor_featured_post',
				'value'   => '1',
				),
				),
		);

	// The Query.
	$query = new WP_Query( $args );

	// Sets counter, and start the post loop.
	$count = (int) 0;
	$posts_count = $query -> post_count;

	$level_2_css_class = 'col-md-3';
	if ( 3 === $posts_count ) {
			$level_2_css_class = 'col-md-12';
	} elseif ( 4 === $posts_count ) {
			$level_2_css_class = 'col-md-6';
	} elseif ( 5 === $posts_count ) {
			$level_2_css_class = 'col-md-4';
	}


	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) :
			$query->the_post();
			$count++;
			if ( 1 === $count ) {
				echo '<div class="bg-white col-md-9 d-flex align-items-stretch grid story-level-1">';
				get_template_part( 'components/card/card-standard' );
				echo '</div>';
			}
			if ( 2 === $count ) {
				echo '<div class="col-md-3 d-flex align-items-stretch grid story-level-2">';
				get_template_part( 'components/card/card-standard' );
				echo '</div>';
			}
			if ( $count > 2 ) {
				echo '<div class="' . esc_html( $level_2_css_class ) . ' d-flex align-items-stretch grid story-level-2">';
				get_template_part( 'components/card/card-standard' );
				echo '</div>';
			}
		endwhile;
	}
	wp_reset_postdata();
?>

</div>
