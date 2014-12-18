<?php
class DC_Edd_Discounts_By_Time_Span {

	public function __construct() {
	  add_action('edd_edit_discount_form_before_max_uses', array(&$this, 'edit_enable_time_to_discount'), 10, 2);
	  add_action('edd_edit_discount_form_before_max_uses', array(&$this, 'edit_start_time_to_discount'), 10, 2);
	  add_action('edd_edit_discount_form_before_max_uses', array(&$this, 'edit_end_time_to_discount'), 10, 2);
	  
	  add_action('edd_add_discount_form_before_min_cart_amount', array(&$this, 'add_enable_time_to_discount'));
	  add_action('edd_add_discount_form_before_min_cart_amount', array(&$this, 'add_start_time_to_discount'));
	  add_action('edd_add_discount_form_before_min_cart_amount', array(&$this, 'add_end_time_to_discount'));
	  
	  add_action('edd_post_update_discount', array(&$this, 'save_enable_time_to_discount'), 10, 2);
	  add_action('edd_post_update_discount', array(&$this, 'save_start_time_to_discount'), 10, 2);
	  add_action('edd_post_update_discount', array(&$this, 'save_end_time_to_discount'), 10, 2);
	  
	  add_action('edd_post_insert_discount', array(&$this, 'save_enable_time_to_discount'), 10, 2);
	  add_action('edd_post_insert_discount', array(&$this, 'save_start_time_to_discount'), 10, 2);
	  add_action('edd_post_insert_discount', array(&$this, 'save_end_time_to_discount'), 10, 2);
	}
	
	public function edit_enable_time_to_discount( $discount_id, $discount ) {
	  global $DC_Edd_Discounts_By_Location;
		$time_on = get_post_meta( $discount_id, '_edd_discount_time_on', true);
		$args = array(
		  'name'     => 'time_enable',
		  'id'       => 'edd-time-enable',
			'current'  => $time_on,
			'class'    => 'edd-checkbox'
    );
    $html = $this->insert_tab_row('time enable', 'checkbox', $args, 'Enable Time for this discount.');
		echo $html;
	}
	
	public function add_enable_time_to_discount() {
	  global $DC_Edd_Discounts_By_Location;
		$args = array(
		  'name'     => 'time_enable',
		  'id'       => 'edd-time-enable',
			'current'  => null,
			'class'    => 'edd-checkbox'
    );
    $html = $this->insert_tab_row('time enable', 'checkbox', $args, 'Enable Time for this discount.');
		echo $html;
	}
	
	public function save_enable_time_to_discount( $details, $discount_id ) {
	  $on = 0;
	  if( isset($_POST['time_enable']) )
	    $on = 1;
	  update_post_meta( $discount_id, '_edd_discount_time_on', $on );
	}
	
	public function edit_start_time_to_discount( $discount_id, $discount ) {
	  global $DC_Edd_Discounts_By_Location;
	  $time_on = get_post_meta( $discount_id, '_edd_discount_time_on', true);
	  $disabled = null;
	  if( $time_on == 0 ) {
	    $disabled = 'disabled';
	  }
		$time_start = get_post_meta( $discount_id, '_edd_discount_time_start', true);
		$args = array(
		  'name'     => 'time_start',
		  'id'       => 'edd-time-start',
			'current'  => $time_start,
			'class'    => 'edd-text',
			'disabled' => $disabled
    );
    $html = $this->insert_tab_row('time start', 'text', $args, 'Start Time of this discount.');
		echo $html;
	}
	
	public function add_start_time_to_discount() {
	  global $DC_Edd_Discounts_By_Location;
		$args = array(
		  'name'     => 'time_start',
		  'id'       => 'edd-time-start',
			'current'  => null,
			'class'    => 'edd-text',
			'disabled' => 'disabled'
    );
    $html = $this->insert_tab_row('time start', 'text', $args, 'Start Time of this discount.');
		echo $html;
	}
	
	public function save_start_time_to_discount( $details, $discount_id ) {
	  if( isset( $_POST['time_enable'] ) ) {
	    update_post_meta( $discount_id, '_edd_discount_time_start', $_POST['time_start'] );
	  }
	}
	
	public function edit_end_time_to_discount( $discount_id, $discount ) {
	  global $DC_Edd_Discounts_By_Location;
	  $time_on = get_post_meta( $discount_id, '_edd_discount_time_on', true);
	  $disabled = null;
	  if( $time_on == 0 ) {
	    $disabled = 'disabled';
	  }
		$time_end = get_post_meta( $discount_id, '_edd_discount_time_end', true);
		$args = array(
		  'name'     => 'time_end',
		  'id'       => 'edd-time-end',
			'current'  => $time_end,
			'class'    => 'edd-text',
			'disabled' => $disabled
    );
    $html = $this->insert_tab_row('time end', 'text', $args, 'End Time of this discount.');
		echo $html;
	}
	
	public function add_end_time_to_discount() {
	  global $DC_Edd_Discounts_By_Location;
		$args = array(
		  'name'     => 'time_end',
		  'id'       => 'edd-time-end',
			'current'  => null,
			'class'    => 'edd-text',
			'disabled' => 'disabled'
    );
    $html = $this->insert_tab_row('time end', 'text', $args, 'End Time of this discount.');
		echo $html;
	}
	
	public function save_end_time_to_discount( $details, $discount_id ) {
	  if( isset( $_POST['time_enable'] ) ) {
	    update_post_meta( $discount_id, '_edd_discount_time_end', $_POST['time_end'] );
	  }
	}
	
	public function insert_tab_row( $lable = '', $element = '', $args = array(), $text = '' ) {
	  $html = '<tr>';
		$html .= '<th valign="top" scope="row">';
		$html .= '<label for="edd_' . str_replace( ' ', '_', $lable) . '">' . ucfirst( $lable ) . '</label>';
		$html .= '</th>';
		$html .= '<td>';		
		switch( $element ) {
      case 'checkbox':
        $html .= $this->checkbox($args);
        break;
      case 'text':
        $html .= $this->text($args);
        break;
		}
		$html .= '<p class="description">';
		$html .= $text;
		$html .= '</p>';
		$html .= '</td>';
		$html .= '</tr>';
	  return $html;
	}

	/**
	 * Renders an HTML Checkbox
	 *
	 * @since 1.9
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	public function checkbox( $args = array() ) {
		$defaults = array(
			'name'     => null,
			'id'       => null,
			'current'  => null,
			'class'    => 'edd-checkbox'
		);

		$args = wp_parse_args( $args, $defaults );

		$output = '<input type="checkbox" name="' . esc_attr( $args[ 'name' ] ) . '" id="' . esc_attr( str_replace( '-', '_', $args[ 'id' ]) ) . '" class="' . $args[ 'class' ] . ' ' . esc_attr( $args[ 'name'] ) . '" ' . checked( 1, $args[ 'current' ], false ) . ' />';

		return $output;
	}
	
	/**
	 * Renders an HTML Text
	 *
	 * @since 1.9
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	public function text( $args = array() ) {
		$defaults = array(
			'name'     => null,
			'id'       => null,
			'current'  => null,
			'class'    => 'edd-text',
			'size'     => 8,
			'disabled' => null
		);

		$args = wp_parse_args( $args, $defaults );

		$output = '<input type="text" name="' . esc_attr( $args[ 'name' ] ) . '" id="' . esc_attr( str_replace( '-', '_', $args[ 'id' ]) ) . '" class="' . $args[ 'class' ] . ' ' . esc_attr( $args[ 'name'] ) . '" value="' . $args[ 'current' ] . '" size="' . $args[ 'size' ] . '"' . esc_attr( $args[ 'disabled'] ) . ' />';

		return $output;
	}
}