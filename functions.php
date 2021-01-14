<?php 

add_filter( 'woocommerce_product_get_rating_html', 'wc_get_rating_html_new', 99, 4 );

function wc_get_rating_html_new( $rating, $count = 0 ) {
	$html = '';
	/* translators: %s: rating */
	$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
	$ratingIcon = '<i class="fa fa-star" role="img" aria-label="' . esc_attr( $label ) . '"></i>';
	$ratingIconEmpty = '<i class="fa fa-star-o" role="img" aria-label="' . esc_attr( $label ) . '"></i>';
	$ratingIconHalf = '<i class="fa fa-star-half-alt" role="img" aria-label="' . esc_attr( $label ) . '"></i>';

	if ( 0 < $rating ) {

		if (is_float($rating)) {
			$v = round($rating, 0, PHP_ROUND_HALF_DOWN);
			$html = str_repeat($ratingIcon, $v) . $ratingIconHalf . str_repeat($ratingIconEmpty, (4-$v));
		} else {
			$html = str_repeat($ratingIcon, $rating) . str_repeat($ratingIconEmpty, (5-$rating));
		}

		$html = '<div class="rating"><span class="stars">' . $html . '&nbsp;</span>' . wc_get_star_rating_html( $rating, $count ) . '</div>';
	} else if ( 0 > $rating ) {
		$html = str_repeat($ratingIconEmpty, 5);
	}

	return $html;
}

?>
