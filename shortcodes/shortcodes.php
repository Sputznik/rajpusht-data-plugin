<?php

$inc_files = array(
  "class-rpdp-shortcode.php",
  "class-rpdp-data-shortcode.php"
);

foreach( $inc_files as $inc_file ){
  require_once( $inc_file );
}
