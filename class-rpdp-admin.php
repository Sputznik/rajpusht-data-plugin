<?php

class RPDP_ADMIN{

  var $settings;

  function __construct(){

    $this->readSettings();

    add_action( 'admin_menu', array( $this, 'adminMenu' ) );

  }

  function adminMenu() {
    add_options_page(
      __( 'Rajpusht Plugin Settings', 'rpdp-domain' ),
      __( 'Rajpusht Settings', 'rpdp-domain' ),
      'manage_options',
      'rpdp-settings',
      array( $this, 'settingsPage' )
    );
  }

  function getSettings(){ return $this->settings; }
  function getSettingByKey( $key ){ return $this->settings[$key]; }
  function setSettings( $settings ){ $this->settings = $settings; }

  function readSettings(){
    $value = get_option( 'rpdp_settings' );
    if( !$value || !is_array( $value ) ) return array();
    $this->setSettings( $value );
  }

  function writeSettings( $settings ){
    update_option( 'rpdp_settings', $settings );
    $this->setSettings( $settings );
  }

  function settingsPage(){
    include( "templates/rpdp-admin-settings.php" );
  }

}

global $rpdp_admin;
$rpdp_admin = new RPDP_ADMIN;
