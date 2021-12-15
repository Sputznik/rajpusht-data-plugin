<?php

class RPDP_DATA_SHORTCODE extends RPDP_SHORTCODE{

  function __construct(){

    $this->shortcode_str 	= 'rajpusht_api';

    parent::__construct();

  }

  function getDefaultAtts(){
    return array(
			'data'  => ''
		);
  }

  function mainShortcode( $atts ){

    global $rpdp_admin;
    $cache_time = (int) $rpdp_admin->getSettingByKey('cache_time');

    /* GET ATTRIBUTES FROM THE SHORTCODE */
		$atts = $this->getShortcodeAtts( $atts );

    $data = false;

		// SHOW ERROR IF API KEY IS NOT SET
		if( empty( $this->getRpdpApiKey() ) ){
			return "Add Api Key";
		}

    /* CHECK IF CACHE TIME IS SET IF YES THEN CHECK IF THE DATA EXISTS IN CACHE  */
    if( $cache_time ){
      $data = $this->getCache();
    }

    // IF NO VALUE IN CACHE
    if ( $data === false ) {
      $response = $this->getRpdpData();
      // CHECK IF RESPONSE EXISTS
      if( $response ){
        $data = (array)$response;
  			if( $cache_time ){
  				$this->setCacheKey( $data );
  			}
      }
		}

    $count = $data ? $data[ $atts['data'] ] : 0;

    return $count;

	}

}

RPDP_DATA_SHORTCODE::getInstance();
