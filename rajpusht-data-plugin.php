<?php
/*
Plugin Name: Rajpusht Data Plugin
Plugin URI: https://sputznik.com/
Description: A simple plugin for fetching odometer count from an external api.
Version: 1.0.0
Author: Stephen Anil, Sputznik
Author URI: https://sputznik.com/
Text Domain: rpdp-domain
*/


if( ! defined( 'ABSPATH' ) ){ exit; }


$inc_files = array(
  "class-rpdp-base.php",
  "class-rpdp-admin.php",
  "shortcodes/shortcodes.php"
);

foreach( $inc_files as $inc_file ){
  require_once( $inc_file );
}
