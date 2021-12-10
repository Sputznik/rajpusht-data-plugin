<?php

class RPDP_DATA_SHORTCODE extends RPDP_SHORTCODE{

  function __construct(){

    $this->shortcode_str 	= 'rajpusht_api';

    parent::__construct();

  }

  function getDefaultAtts(){
    return array(
			'data'  => '',
      'cache'	=> 10 // CACHE FOR MINUTES
		);
  }

  function mainShortcode( $atts ){

    /* GET ATTRIBUTES FROM THE SHORTCODE */
		$atts = $this->getShortcodeAtts( $atts );

    $data = false;

		// SHOW ERROR IF API KEY IS NOT SET
		if( empty( $this->getRpdpApiKey() ) ){
			return "Add Api Key";
		}

    /* CHECK IF THE DATA EXISTS IN CACHE */
		if( isset( $atts['cache'] ) && $atts['cache'] && is_numeric( $atts['cache'] ) ){
			$data = $this->getCache();
		}

    // IF NO VALUE IN CACHE
    if ( $data === false ) {
      $data = (array)$this->getRpdpData();
			if( $data && isset( $atts['cache'] ) && $atts['cache'] ){
				$this->setCacheKey( $data, $atts );
			}
		}

    $count = $data ? $data[ $atts['data'] ] : "Something went wrong";

    return $count;

	}

}

RPDP_DATA_SHORTCODE::getInstance();
