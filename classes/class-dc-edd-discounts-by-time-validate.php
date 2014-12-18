<?php
class DC_Edd_Discounts_By_Time_Validate {

	public function __construct() {
		add_filter('edd_ajax_discount_response', array(&$this, 'validate_discount_time'));
	}

	public function validate_discount_time( $return ) {
	  $code = $return['code'];
	  $discount = $this->get_the_discount( $code );
	  if( is_object( $discount ) ) {
	    $time_on = get_post_meta( $discount->ID, '_edd_discount_time_on', true );
	    if( $time_on == 1) {
	      $start_time = get_post_meta( $discount->ID, '_edd_discount_time_start', true );
	      $start_time = strtotime( $start_time );
	      $end_time = get_post_meta( $discount->ID, '_edd_discount_time_end', true );
	      $end_time = strtotime( $end_time );
	      $time = current_time( 'timestamp' );
	      if( $time < $start_time || $time > $end_time ) {
	        edd_set_error( 'invalid_discount_time', __( 'This discount is invalid.', 'edd' ) );
	        edd_unset_cart_discount( $code );
	        $return['msg'] = 'This discount is invalid.';
	      }
	    }
	  }
	  return $return;
	}
	
	public function get_the_discount( $code ) {
	  $discounts = get_posts(
	    array(
        'post_type'      => 'edd_discount',
        'posts_per_page' => -1,
        'orderby'        => 'ID',
        'order'          => 'DESC',
        'post_status'    => 'active',
        'meta_key'       => '_edd_discount_code',
        'meta_value'     => $code
	    )
    );
	  return current( $discounts );
	}
}
