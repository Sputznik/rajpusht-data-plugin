<?php

/* BASE CLASS FOR SHORTCODE */
class RPDP_SHORTCODE extends RPDP_BASE{

	var $shortcode_str;
	var $rpdp_api_key;

	function __construct(){

		// SET RAJPUSHT API KEY
		$this->setRpdpApiKey();

		add_shortcode( $this->shortcode_str, array( $this, 'mainShortcode' ), 100 );
	}


	function getDefaultAtts(){
    return array();
  }

  function getShortcodeAtts( $atts ){
    return shortcode_atts( $this->getDefaultAtts(), $atts, $this->shortcode_str );
  }

	function getRpdpData(){
		$url = "http://data.rajpusht.in/api/external/v1/dashboard";
	  $args = array(
	    'headers' => array(
	      'Content-Type' => 'application/json',
	      'Authorization'    => 'Bearer '.$this->getRpdpApiKey()
	    ),
	    'method'  => 'GET'
	  );

	  $response = wp_remote_get( $url, $args );

		// RETURN RESPONSE DATA IF BASE URL IS VALID
		if ( !is_wp_error( $response ) ) {
			$body = wp_remote_retrieve_body( $response );
			$decoded_response = json_decode( $body );
			if( $decoded_response->status	){
				return $decoded_response->data;
			}
			return false;
		}
		return false;
	}

	function getCacheKey(){
		$cache_key = $this->shortcode_str."_data";
		return $cache_key;
	}

	function getCache(){
		$cache_key = $this->getCacheKey();
		// TRY TO GET VALUE FROM WORDPRESS CACHE
		return get_transient( $cache_key );
	}

	function setCacheKey( $data, $atts ){
		$cache_key = $this->getCacheKey();

		// STORE VALUE IN CACHE FOR MINUTES
		set_transient( $cache_key, $data, ( $atts['cache'] * MINUTE_IN_SECONDS ) );

	}

	function getRpdpApiKey(){ return $this->rpdp_api_key; }

	function setRpdpApiKey(){
		$this->rpdp_api_key = '';
	}

	// TO BE IMPLEMENTED BY CHILD CLASSES - HANDLES SHORTCODE CREATION
	function mainShortcode( $atts ){}

}
