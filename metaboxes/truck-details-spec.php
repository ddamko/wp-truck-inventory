<?php

$trucks_mb = new WPAlchemy_MetaBox(array
(
  'id' => '_trucks_meta',
  'title' => 'Truck Details',
  'template' => get_stylesheet_directory() . '/metaboxes/truck-details-ui.php',
  'types' => array('truck_inventory'),
  'context' => 'normal',
  'priority' => 'low',
  'autosave' => FALSE,
  'mode' => WPALCHEMY_MODE_EXTRACT,
  'hide_editor' => TRUE,
  'hide_screen_option' => TRUE,

));