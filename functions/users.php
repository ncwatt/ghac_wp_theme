<?php

if ( ! function_exists( 'is_user_in_role' ) ) :
    function is_user_in_role( $role ) {
      $user = wp_get_current_user();
      //return ( in_array( 'administrator', array_map( fn($str) => strtolower( $str ), (array) $user->roles ) ) ? true : false );
      return ( in_array( $role, array_map( fn($str) => strtolower( $str ), (array) $user->roles ) ) ? true : false );
    }
endif;