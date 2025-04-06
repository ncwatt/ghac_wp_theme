<?php

 function wc_override_checkout_fields( $fields ) {
    $fields['billing']['billing_company']['placeholder'] = 'Running club required when entering events';
    $fields['billing']['billing_company']['label']       = 'Club name';
    //echo "<pre>" . print_r($fields) . "</pre>";
    return $fields;
  }
  add_filter( 'woocommerce_checkout_fields' , 'wc_override_checkout_fields' );
  
  function wc_form_field_args($args, $key, $value) {
    $args['input_class'] = array( 'form-control' );
    return $args;
  }
  add_filter('woocommerce_form_field_args',  'wc_form_field_args', 10, 3);
  
  function wpauthors_external_add_to_cart_link() {
    global $product;
  
    if ( ! $product->add_to_cart_url() ) {
        return;
    }
  
    $product_url = $product->add_to_cart_url();
    $button_text = $product->single_add_to_cart_text();
  
    do_action( 'woocommerce_before_add_to_cart_button' );
    echo "<p class=\"cart\">";
    echo "<a href=\"" . esc_url( $product_url ) . "\" target=\"_blank\" rel=\"nofollow\" class=\"single_add_to_cart_button button alt\">" . esc_html( $button_text ) . "</a>";
    echo "</p>";
    do_action( 'woocommerce_after_add_to_cart_button' );
  }
  remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
  add_action( 'woocommerce_external_add_to_cart', 'wpauthors_external_add_to_cart_link', 30 );
  
  if ( ! function_exists( 'woocommerce_checkout_field_club' ) ):
    function woocommerce_checkout_field_club() {
      $domain = 'woocommerce';
      $checkout = WC()->checkout;
      echo '<div id="custom_checkout_field"><h2>' . __('New Heading') . '</h2>';
      woocommerce_form_field( 
        'club_name', 
        array(
          'type' => 'text',
          'class' => array(
            'my-field-class form-row-wide'
          ),
          'label' => __('Custom Additional Field'),
          'placeholder' => __('New Custom Field'),
          'required' => false,
        ),
        $checkout->get_value('club_name')
      );
      echo '</div>';
    }
  endif;
  //add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_field_club');