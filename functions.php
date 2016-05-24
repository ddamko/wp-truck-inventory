<?php
/**
 * Scelzi Enterprises Inc Functions and Definitions for an Inventory Management System within WordPress.
 */

include_once 'metaboxes/setup.php';

include_once 'metaboxes/truck-details-spec.php';

/**
 * Load Scripts and Stylesheets
 */
function inventory_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20120206', true );
  wp_enqueue_script( 'chassis-pool', get_template_directory_uri() . '/js/chassis-pool.js', array('jquery'), '20120207', true );
  wp_localize_script( 'chassis-pool', 'ajax_script', array( 'ajaxurl' => admin_url('admin-ajax.php') ) );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'jquery-ui-core' );
  wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action( 'wp_enqueue_scripts', 'scelzi_scripts' );

/**
 * Load jQuery Datepicker for Admin Interface
 */
function load_admin_datepicker() {
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'jquery-ui-core' );
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_script( 'datepicker', get_template_directory_uri() . '/js/datepicker.js', array( 'jquery', 'jquery-ui-core' ) );
  wp_enqueue_style( 'style', get_template_directory_uri() . '/inc/jquery-ui-1.9.2.custom.min.css' );
}
add_action( 'admin_footer', 'load_admin_datepicker' );

/**
 * Register Truck Inventory Post Type
 */
function truck_inventory() {

  $labels = array(
    'name'               => _x( 'Trucks', 'post type general name' ),
    'singular_name'      => _x( 'Truck', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'truck item number' ),
    'add_new_item'       => __( 'Add New Truck' ),
    'edit_item'          => __( 'Edit Truck' ),
    'new_item'           => __( 'New Truck' ),
    'all_items'          => __( 'All Trucks' ),
    'view_item'          => __( 'View Truck' ),
    'search_items'       => __( 'Search Trucks' ),
    'not_found'          => __( 'No Trucks found' ),
    'not_found_in_trash' => __( 'No Trucks found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Truck Inventory'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds truck inventory',
    'public'        => true,
    'menu_position' => 5,
    'hierarchical'  => true,
    'query_var'   => 'truck',
    'supports'      => array( 'title' ),
    'has_archive'   => false,
    'rewrite'   => array( 'slug' => 'truck'),
  );
  register_post_type( 'truck_inventory', $args );

}
add_action( 'init', 'truck_inventory' );

/**
 * Register Dealer Cities Taxonomy with Truck Inventory Post Type
 */
function dealer_cities() {
  
  $labels = array(
    'name'              => _x( 'Location', 'taxonomy general name' ),
    'singular_name'     => _x( 'Location', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Locations' ),
    'all_items'         => __( 'All Locations' ),
    'parent_item'       => __( 'Parent Location' ),
    'parent_item_colon' => __( 'Parent Location:' ),
    'edit_item'         => __( 'Edit Location' ),
    'update_item'       => __( 'Update Location' ),
    'add_new_item'      => __( 'Add New Location' ),
    'new_item_name'     => __( 'New Location Name' ),
    'menu_name'         => __( 'Manage Locations' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => truee,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'dealer_cities', 'truck_inventory', $args );

}
add_action( 'init', 'dealer_cities', 0);

/**
 * Register Truck Model Year Taxonomy with Truck Inventory Post Type
 */
function truck_year() {
  
  $labels = array(
    'name'              => _x( 'Year', 'taxonomy general name' ),
    'singular_name'     => _x( 'Year', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Year' ),
    'all_items'         => __( 'All Year' ),
    'parent_item'       => __( 'Parent Year' ),
    'parent_item_colon' => __( 'Parent Year:' ),
    'edit_item'         => __( 'Edit Year' ),
    'update_item'       => __( 'Update Year' ),
    'add_new_item'      => __( 'Add New Year' ),
    'new_item_name'     => __( 'New Year Name' ),
    'menu_name'         => __( 'Manage Year' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => true,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_year', 'truck_inventory', $args );

}
add_action( 'init', 'truck_year', 0);

/**
 * Register Truck Item Number Post Type
 */
function truck_item_number() {

  $labels = array(
    'name'               => _x( 'Truck Item #', 'post type general name' ),
    'singular_name'      => _x( 'Truck Item #', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'truck item number' ),
    'add_new_item'       => __( 'Add New Truck Item #' ),
    'edit_item'          => __( 'Edit TIN' ),
    'new_item'           => __( 'New TIN' ),
    'all_items'          => __( 'All TINs' ),
    'view_item'          => __( 'View TIN' ),
    'search_items'       => __( 'Search TINs' ),
    'not_found'          => __( 'No TINs found' ),
    'not_found_in_trash' => __( 'No TINs found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Truck Item #'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds truck item number collections',
    'public'        => true,
    'menu_position' => 5,
    'hierarchical'  => true,
    'query_var'   => 'tin',
    'supports'      => array( 'title'),
    'has_archive'   => false,
    'rewrite'   => array( 'slug' => 'tin'),
  );
  register_post_type( 'truck_item_number', $args );

}
add_action( 'init', 'truck_item_number' );

/**
 * Register Truck Make Taxonomy with TIN Post Type
 */
function truck_makes() {
  
  $labels = array(
    'name'              => _x( 'Make', 'taxonomy general name' ),
    'singular_name'     => _x( 'Make', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Makes' ),
    'all_items'         => __( 'All Makes' ),
    'parent_item'       => __( 'Parent Make' ),
    'parent_item_colon' => __( 'Parent Make:' ),
    'edit_item'         => __( 'Edit Make' ),
    'update_item'       => __( 'Update Make' ),
    'add_new_item'      => __( 'Add New Make' ),
    'new_item_name'     => __( 'New Make Name' ),
    'menu_name'         => __( 'Manage Makes' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => true,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_makes', 'truck_item_number', $args );

}
add_action( 'init', 'truck_makes', 0);

/**
 * Register Truck Model Taxonomy with TIN Post Type
 */
function truck_models() {
  
  $labels = array(
    'name'              => _x( 'Model', 'taxonomy general name' ),
    'singular_name'     => _x( 'Model', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Models' ),
    'all_items'         => __( 'All Models' ),
    'parent_item'       => __( 'Parent Model' ),
    'parent_item_colon' => __( 'Parent Model:' ),
    'edit_item'         => __( 'Edit Model' ),
    'update_item'       => __( 'Update Model' ),
    'add_new_item'      => __( 'Add New Model' ),
    'new_item_name'     => __( 'New Model Name' ),
    'menu_name'         => __( 'Manage Model' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => true,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_models', 'truck_item_number', $args );

}

add_action( 'init', 'truck_models', 0);

/**
 * Register Truck Cab Type Taxonomy with TIN Post Type
 */
function truck_cab_types() {
  
  $labels = array(
    'name'              => _x( 'Cab Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Cab Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Cab Types' ),
    'all_items'         => __( 'All Cab Types' ),
    'parent_item'       => __( 'Parent Cab Type' ),
    'parent_item_colon' => __( 'Parent Cab Type:' ),
    'edit_item'         => __( 'Edit Cab Type' ),
    'update_item'       => __( 'Update Cab Type' ),
    'add_new_item'      => __( 'Add New Cab Type' ),
    'new_item_name'     => __( 'New Cab Type Name' ),
    'menu_name'         => __( 'Manage Cab Types' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => true,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_cab_types', 'truck_item_number', $args );

}
add_action( 'init', 'truck_cab_types', 0);

/**
 * Register Truck Drivetrain Type Taxonomy with TIN Post Type
 */
function truck_drive_types() {
  
  $labels = array(
    'name'              => _x( 'Drive Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Drive Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Drive Types' ),
    'all_items'         => __( 'All Drive Types' ),
    'parent_item'       => __( 'Parent Drive Type' ),
    'parent_item_colon' => __( 'Parent Drive Type:' ),
    'edit_item'         => __( 'Edit Drive Type' ),
    'update_item'       => __( 'Update Drive Type' ),
    'add_new_item'      => __( 'Add New Drive Type' ),
    'new_item_name'     => __( 'New Drive Type Name' ),
    'menu_name'         => __( 'Manage Drive Types' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_drive_types', 'truck_item_number', $args );

}
add_action( 'init', 'truck_drive_types', 0);

/**
 * Register Truck Rear Type Taxonomy with TIN Post Type
 */
function truck_rear_types() {
  
  $labels = array(
    'name'              => _x( 'Rear Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Rear Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Rear Types' ),
    'all_items'         => __( 'All Rear Types' ),
    'parent_item'       => __( 'Parent Rear Type' ),
    'parent_item_colon' => __( 'Parent Rear Type:' ),
    'edit_item'         => __( 'Edit Rear Type' ),
    'update_item'       => __( 'Update Rear Type' ),
    'add_new_item'      => __( 'Add New Rear Type' ),
    'new_item_name'     => __( 'New Rear Type Name' ),
    'menu_name'         => __( 'Manage Rear Types' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_rear_types', 'truck_item_number', $args );

}
add_action( 'init', 'truck_rear_types', 0);

/**
 * Register Truck Trim Type Taxonomy with TIN Post Type
 */
function truck_trim_types() {
  
  $labels = array(
    'name'              => _x( 'Trim Type', 'taxonomy general name' ),
    'singular_name'     => _x( 'Trim Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Trim Types' ),
    'all_items'         => __( 'All Trim Types' ),
    'parent_item'       => __( 'Parent Trim Type' ),
    'parent_item_colon' => __( 'Parent Trim Type:' ),
    'edit_item'         => __( 'Edit Trim Type' ),
    'update_item'       => __( 'Update Trim Type' ),
    'add_new_item'      => __( 'Add New Trim Type' ),
    'new_item_name'     => __( 'New Trim Type Name' ),
    'menu_name'         => __( 'Manage Trim Types' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => true,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_trim_types', 'truck_item_number', $args );

}
add_action( 'init', 'truck_trim_types', 0);

/**
 * Register Truck Wheel Base Taxonomy with TIN Post Type
 */
function truck_WBS() {
  
  $labels = array(
    'name'              => _x( 'WB', 'taxonomy general name' ),
    'singular_name'     => _x( 'WB', 'taxonomy singular name' ),
    'search_items'      => __( 'Search WBs' ),
    'all_items'         => __( 'All WBs' ),
    'parent_item'       => __( 'Parent WB' ),
    'parent_item_colon' => __( 'Parent WB:' ),
    'edit_item'         => __( 'Edit WB' ),
    'update_item'       => __( 'Update WB' ),
    'add_new_item'      => __( 'Add New WB' ),
    'new_item_name'     => __( 'New WB Name' ),
    'menu_name'         => __( 'Manage WBs' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_WBs', 'truck_item_number', $args );

}
add_action( 'init', 'truck_WBs', 0);

/**
 * Register Truck Curb Weight Taxonomy with TIN Post Type
 */
function truck_CAS() {
  
  $labels = array(
    'name'              => _x( 'CA', 'taxonomy general name' ),
    'singular_name'     => _x( 'CA', 'taxonomy singular name' ),
    'search_items'      => __( 'Search CAs' ),
    'all_items'         => __( 'All CAs' ),
    'parent_item'       => __( 'Parent CA' ),
    'parent_item_colon' => __( 'Parent CA:' ),
    'edit_item'         => __( 'Edit CA' ),
    'update_item'       => __( 'Update CA' ),
    'add_new_item'      => __( 'Add New CA' ),
    'new_item_name'     => __( 'New CA Name' ),
    'menu_name'         => __( 'Manage CAs' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_CAs', 'truck_item_number', $args );

}
add_action( 'init', 'truck_CAs', 0);

/**
 * Register Truck Color Options Taxonomy with TIN Post Type
 */
function truck_colors() {
  
  $labels = array(
    'name'              => _x( 'Color', 'taxonomy general name' ),
    'singular_name'     => _x( 'Color', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Colors' ),
    'all_items'         => __( 'All Colors' ),
    'parent_item'       => __( 'Parent Color' ),
    'parent_item_colon' => __( 'Parent Color:' ),
    'edit_item'         => __( 'Edit Color' ),
    'update_item'       => __( 'Update Color' ),
    'add_new_item'      => __( 'Add New Color' ),
    'new_item_name'     => __( 'New Color Name' ),
    'menu_name'         => __( 'Manage Colors' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_colors', 'truck_item_number', $args );

}
add_action( 'init', 'truck_colors', 0);

/**
 * Register Truck Engine Type Taxonomy with TIN Post Type
 */
function truck_engine() {
  
  $labels = array(
    'name'              => _x( 'Engine', 'taxonomy general name' ),
    'singular_name'     => _x( 'Engine', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Engines' ),
    'all_items'         => __( 'All Engines' ),
    'parent_item'       => __( 'Parent Engine' ),
    'parent_item_colon' => __( 'Parent Engine:' ),
    'edit_item'         => __( 'Edit Engine' ),
    'update_item'       => __( 'Update Engine' ),
    'add_new_item'      => __( 'Add New Engine' ),
    'new_item_name'     => __( 'New Engine Name' ),
    'menu_name'         => __( 'Manage Engine' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_engine', 'truck_item_number', $args );

}
add_action( 'init', 'truck_engine', 0);

/**
 * Register Truck Transmission Type Taxonomy with TIN Post Type
 */
function truck_trans() {
  
  $labels = array(
    'name'              => _x( 'Transmission', 'taxonomy general name' ),
    'singular_name'     => _x( 'Transmission', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Transmissions' ),
    'all_items'         => __( 'All Transmissions' ),
    'parent_item'       => __( 'Parent Transmission' ),
    'parent_item_colon' => __( 'Parent Transmission:' ),
    'edit_item'         => __( 'Edit Transmission' ),
    'update_item'       => __( 'Update Transmission' ),
    'add_new_item'      => __( 'Add New Transmission' ),
    'new_item_name'     => __( 'New Transmission Name' ),
    'menu_name'         => __( 'Manage Trans' ),
  );

  $args = array(
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'show_admin_column' => false,
    'hierarchical'  => true,
    'update_count_callback' => '_update_post_term_count',
  );
  register_taxonomy( 'truck_trans', 'truck_item_number', $args );

}
add_action( 'init', 'truck_trans', 0);

/**
 * Register Document Attachement to Truck Inventory
 */
function truck_attachments( $attachments ) {
  
  $fields = array(
    array(
      'name'    => 'name',
      'type'    => 'text',
      'label'   => __( 'Name', 'attachments' ),
      'default' => 'title',
    ),
    array(
      'name'    => 'type',
      'type'    => 'select',
      'label'   => __( 'Type', 'attachments' ),
      'meta'    => array(
        'allow_null' => false,
        'multiple'   => false,
        'options'    => array('DORA' => 'DORA', 'Invoice' => 'Invoice'),
      ),
    ),
  );

  $args = array(
    'label'       => 'Truck Attachments',
    'post_type'   => array( 'truck_inventory' ),
    'position'    => 'normal',
    'priority'    => 'high',
    'filetype'    => null,
    'note'        => null,
    'append'      => true,
    'button_text' => __( 'Attach PDFs', 'attachments' ),
    'modal_text'  => __( 'Attach', 'attachments' ),
    'router'      => 'browse',
    'fields'      => $fields,
  );
  $attachments->register( 'truck_docs', $args );

}
add_action( 'attachments_register', 'truck_attachments', 0);

/**
 * Manage TIN Post Table Column
 */
function columns_head_truck_item_number($defaults) {  
  $defaults['title'] = 'TIN';
  return $defaults;  
} 
add_filter('manage_truck_item_number_posts_columns', 'columns_head_truck_item_number', 0);

/**
 * Manage Truck Inventory Post Table Column
 */
function columns_head_truck_inventory($defaults) {  
  $defaults['title'] = 'Factory #';
  $defaults['truck_makes'] = 'Make';
  $defaults['truck_models'] = 'Model';
  $defaults['truck_colors'] = 'Color';
  $defaults['build_date'] = 'Build Date';
  $defaults['recieve_date'] = 'Recieve Date';
  return $defaults;  
} 
add_filter('manage_truck_inventory_posts_columns', 'columns_head_truck_inventory', 0);

/**
 * Manage Truck Inventory Content of Post Table Column
 */
function columns_content_truck_inventory($column_name, $post_ID) {  
  $tin_id = get_post_meta($post_ID, 'truck_item_number', true);

  switch ($column_name) {
    
    case 'truck_makes':
      $get_tin = wp_get_post_terms($tin_id, 'truck_makes', array("fields" => "names"));
      echo $get_tin[0];
      break;
    
    case 'truck_models':
      $get_tin = wp_get_post_terms($tin_id, 'truck_models', array("fields" => "names"));
      echo $get_tin[0];
      break;

    case 'truck_colors':
      $get_tin = wp_get_post_terms($tin_id, 'truck_colors', array("fields" => "names"));
      echo $get_tin[0];
      break;

    case 'build_date':
      $get_date = get_post_meta($post_ID, 'build_date', true);
      echo $get_date;
      break;

    case 'recieve_date':
      $get_date = get_post_meta($post_ID, 'recieve_date', true);
      echo $get_date;
      break;
  }
}  
add_action('manage_truck_inventory_posts_custom_column', 'columns_content_truck_inventory', 0, 2); 

/**
 * Remove Dates from TIN and Truck Inventory Table Columns
 */
function columns_remove_date($defaults) {  
  unset($defaults['date']);  
  return $defaults; 
}
add_filter('manage_truck_inventory_posts_columns', 'columns_remove_date');
add_filter('manage_truck_item_number_posts_columns', 'columns_remove_date');

/**
 * Truck Inventory Chassis Pool Query (!!NEEDS BE REFACTORED!!)
 */
function chassis_pool_submit() {

  global $posts;

  // Get query vars for Truck Inventory including Year and City
  $truck_year = $_POST['truck_year'];
  $city       = $_POST['city'];

  // Get all taxonomies for Year and City
  $all_years  = get_terms('truck_year', array( 'fields' => 'ids' ));
  $all_cities = get_terms('scelzi_cities', array( 'fields' => 'ids' ));

  // Check if All is selected for Year and set taxonomy query to all terms
  if ($truck_year == 'all') {
    $year_tax = array( 'taxonomy' => 'truck_year', 'field' => 'id', 'terms' => $all_years );
  } else {
    $year_tax = array( 'taxonomy' => 'truck_year', 'field' => 'slug', 'terms' => $truck_year );
  }

  // Check if All is selected for City and set taxonomy query to all terms
  if ($city == 'all') {
    $city_tax = array( 'taxonomy' => 'scelzi_cities', 'field' => 'id', 'terms' => $all_cities );
  } else {
    $city_tax = array( 'taxonomy' => 'scelzi_cities', 'field' => 'slug', 'terms' => $city );
  }

  // Get all query vars for TINs
  $truck_makes        = $_POST['truck_makes'];
  $truck_models       = $_POST['truck_models'];
  $truck_rear_types   = $_POST['truck_rear_types'];
  $truck_cab_types    = $_POST['truck_cab_types'];
  $truck_wbs          = $_POST['truck_wbs'];
  $truck_engines      = $_POST['truck_engines'];
  $truck_drive_types  = $_POST['truck_drive_types'];
  $truck_trim_types   = $_POST['truck_trim_types'];
  $truck_color        = 'all';
  $truck_trans        = $_POST['truck_trans'];
  $truck_cas          = $_POST['truck_cas'];

  // Get all taxonomies for Make, Rear Types, Cab Types, WBs, Engines, Drive Types, Transmissions and CAs.
  $all_makes       = get_terms('truck_makes',       array( 'fields' => 'ids' ));
  $all_models      = get_terms('truck_models',      array( 'fields' => 'ids' ));
  $all_rear_types  = get_terms('truck_rear_types',  array( 'fields' => 'ids' ));
  $all_cab_types   = get_terms('truck_cab_types',   array( 'fields' => 'ids' ));
  $all_trim_types  = get_terms('truck_trim_types',  array( 'fields' => 'ids' ));
  $all_wbs         = get_terms('truck_WBs',         array( 'fields' => 'ids' ));
  $all_engines     = get_terms('truck_engine',      array( 'fields' => 'ids' ));
  $all_drive_types = get_terms('truck_drive_types', array( 'fields' => 'ids' ));
  $all_colors      = get_terms('truck_colors',      array( 'fields' => 'ids' ));
  $all_trans       = get_terms('truck_trans',       array( 'fields' => 'ids' ));
  $all_cas         = get_terms('truck_CAs',         array( 'fields' => 'ids' ));

  // Check if All is selected for Makes and set taxonomy query to all terms
  if ($truck_makes == 'all') {
    $makes_tax = array( 'taxonomy' => 'truck_makes', 'field' => 'id', 'terms' => $all_makes );
  } else {
    $makes_tax = array( 'taxonomy' => 'truck_makes', 'field' => 'slug', 'terms' => $truck_makes );
  }

  // Check if All is selected for Models and set taxonomy query to all terms
  if ($truck_models == 'all') {
    $models_tax = array( 'taxonomy' => 'truck_models', 'field' => 'id', 'terms' => $all_models );
  } else {
    $models_tax = array( 'taxonomy' => 'truck_models', 'field' => 'slug', 'terms' => $truck_models );
  }

  // Check if All is selected for Rear Types and set taxonomy query to all terms
  if ($truck_rear_types == 'all') {
    $rear_tax = array( 'taxonomy' => 'truck_rear_types', 'field' => 'id', 'terms' => $all_rear_types );
  } else {
    $rear_tax = array( 'taxonomy' => 'truck_rear_types', 'field' => 'slug', 'terms' => $truck_rear_types );
  }

  // Check if All is selected for Cab Types and set taxonomy query to all terms
  if ($truck_cab_types == 'all') {
    $cab_tax = array( 'taxonomy' => 'truck_cab_types', 'field' => 'id', 'terms' => $all_cab_types );
  } else {
    $cab_tax = array( 'taxonomy' => 'truck_cab_types', 'field' => 'slug', 'terms' => $truck_cab_types );
  }

  // Check if All is selected for Trim Types and set taxonomy query to all terms
  if ($truck_trim_types == 'all') {
    $trim_tax = array( 'taxonomy' => 'truck_trim_types', 'field' => 'id', 'terms' => $all_trim_types );
  } else {
    $trim_tax = array( 'taxonomy' => 'truck_trim_types', 'field' => 'slug', 'terms' => $truck_trim_types );
  }

  // Check if All is selected for WBs and set taxonomy query to all terms
  if ($truck_wbs == 'all') {
    $wb_tax = array( 'taxonomy' => 'truck_WBs', 'field' => 'id', 'terms' => $all_wbs );
  } else {
    $wb_tax = array( 'taxonomy' => 'truck_WBs', 'field' => 'slug', 'terms' => $truck_wbs);
  }

  // Check if All is selected for Engines and set taxonomy query to all terms
  if ($truck_engines == 'all') {
    $engine_tax = array( 'taxonomy' => 'truck_engine', 'field' => 'id', 'terms' => $all_engines );
  } else {
    $engine_tax = array( 'taxonomy' => 'truck_engine', 'field' => 'slug', 'terms' => $truck_engines );
  }

  // Check if All is selected for Drive Types and set taxonomy query to all terms
  if ($truck_drive_types == 'all') {
    $drive_tax = array( 'taxonomy' => 'truck_drive_types', 'field' => 'id', 'terms' => $all_drive_types );
  } else {
    $drive_tax = array( 'taxonomy' => 'truck_drive_types', 'field' => 'slug', 'terms' => $truck_drive_types );
  }

  // Check if All is selected for Color and set taxonomy query to all terms
  if ($truck_color == 'all') {
    $color_tax = array( 'taxonomy' => 'truck_colors', 'field' => 'id', 'terms' => $all_colors );
  } else {
    $color_tax = array( 'taxonomy' => 'truck_colors', 'field' => 'slug', 'terms' => $truck_color );
  }

  // Check if All is selected for Transmissions and set taxonomy query to all terms
  if ($truck_trans == 'all') {
    $trans_tax = array( 'taxonomy' => 'truck_trans', 'field' => 'id', 'terms' => $all_trans );
  } else {
    $trans_tax = array( 'taxonomy' => 'truck_trans', 'field' => 'slug', 'terms' => $truck_trans );
  }

  // Check if All is selected for CAs and set taxonomy query to all terms
  if ($truck_cas == 'all') {
    $cas_tax = array( 'taxonomy' => 'truck_CAs', 'field' => 'id', 'terms' => $all_cas );
  } else {
    $cas_tax = array( 'taxonomy' => 'truck_CAs', 'field' => 'slug', 'terms' => $truck_cas );
  }

  $truck_tax_query = array( 'relation' => 'AND', $year_tax, $city_tax );
  $tin_tax_query   = array( 'relation' => 'AND', $makes_tax, $models_tax, $rear_tax, $cab_tax, $trim_tax, $engine_tax, $drive_tax, $color_tax, $trans_tax, /*$gwvr_tax,*/ $wb_tax, $cas_tax ); 

  $filter_truck_args = array( 'post_type' => 'truck_inventory', 'post_status' => 'publish', 'nopaging' => true, 'tax_query' => $truck_tax_query, 'order' => 'ASC', 'orderby' => 'ID' );
  $filter_tin_args   = array( 'post_type' => 'truck_item_number', 'post_status' => 'publish', 'nopaging' => true, 'tax_query' => $tin_tax_query );
  
  $filter_truck_query = new WP_Query( $filter_truck_args );
  $filter_tin_query = new WP_Query( $filter_tin_args );

  $truck_tq    = $filter_truck_query->get('tax_query');
  $truck_tqv   = $filter_truck_query->query_vars['tax_query'];
  $truck_qtq   = $filter_truck_query->query['tax_query'];
  
  $truck_posts = $filter_truck_query->posts;
  $truck_post_count = $filter_truck_query->post_count;

  $tin_tq    = array_slice($filter_tin_query->get('tax_query'), 1);
  $tin_tqv   = array_slice($filter_tin_query->query_vars['tax_query'], 1);
  $tin_qtq   = array_slice($filter_tin_query->query['tax_query'], 1);
  
  $tin_posts = $filter_tin_query->posts;
  $tin_post_count = $filter_tin_query->post_count;

  $truck_tin_tq    = array_merge($truck_tq, $tin_tq);
  $truck_tin_tqv   = array_merge($truck_tqv, $tin_tqv);
  $truck_tin_qtq   = array_merge($truck_qtq, $tin_qtq);
  $truck_tin_posts = array_merge($truck_posts, $tin_posts);
  $truck_tin_post_count = bcadd($truck_post_count, $tin_post_count);

  $filter_truck_query->posts = $truck_tin_posts;
  $filter_truck_query->set('tax_query', $truck_tin_tq);
  $filter_truck_query->query_vars['tax_query'] = $truck_tin_tqv;
  $filter_truck_query->query['tax_query'] = $truck_tin_qtq;
  $filter_truck_query->post_count = $truck_tin_post_count;

  $truck_arr = array();
  $tin_arr = array();
  $matches = array();

  while ( $filter_truck_query->have_posts() ) : $filter_truck_query->the_post();
    
    $id = get_the_ID();
    $meta = get_post_meta( $id, 'truck_item_number', true);

    if (!$meta) {
      array_push($tin_arr, $id);
    } elseif ($meta) {
      $truck_arr[$id] = $meta;
    }

    $matches = array_intersect($truck_arr, $tin_arr);

  endwhile;

  if( !empty($matches) ) {

    foreach ($matches as $key => $value) {
      $truck_id = $key;
      $tin_id = $value;

      $truck           = get_post($truck_id);
      $attachments_arr = get_post_meta( $truck_id, 'attachments', false );

      $attachments = json_decode($attachments_arr[0]);
      $truck_docs = $attachments->{'truck_docs'};

      $dora_id = $truck_docs[0]->id;
      $invoice_id = $truck_docs[1]->id;

      $dora         = $truck_docs[0]->fields->name;
      $year         = wp_get_post_terms( $truck_id, 'truck_year', array('fields' => 'all') );
      $make         = wp_get_post_terms( $tin_id, 'truck_makes', array('fields' => 'all') );
      $model        = wp_get_post_terms( $tin_id, 'truck_models', array('fields' => 'all') );
      $cab          = wp_get_post_terms( $tin_id, 'truck_cab_types', array('fields' => 'all') );
      $drive        = wp_get_post_terms( $tin_id, 'truck_drive_types', array('fields' => 'all') );
      $rear         = wp_get_post_terms( $tin_id, 'truck_rear_types', array('fields' => 'all') );
      $trim         = wp_get_post_terms( $tin_id, 'truck_trim_types', array('fields' => 'all') );
      $wb           = wp_get_post_terms( $tin_id, 'truck_WBs', array('fields' => 'all') );
      $ca           = wp_get_post_terms( $tin_id, 'truck_CAs', array('fields' => 'all') );
      $color        = wp_get_post_terms( $tin_id, 'truck_colors', array('fields' => 'all') );
      $engine       = wp_get_post_terms( $tin_id, 'truck_engine', array('fields' => 'all') );
      $trans        = wp_get_post_terms( $tin_id, 'truck_trans', array('fields' => 'all') );
      $location     = wp_get_post_terms( $truck_id, 'scelzi_cities', array('fields' => 'all') );
      $vin_num      = $truck_docs[1]->fields->name;
      $build_date   = get_post_meta( $truck_id, 'build_date', true );
      $recieve_date = get_post_meta( $truck_id, 'recieve_date', true );

      $invoice_url  = get_post_meta( $invoice_id, '_wp_attached_file', true );
      $dora_url     = get_post_meta( $dora_id, '_wp_attached_file', true );

      echo "<tr class='results-row'>";
        echo "<td><a href='".esc_url( home_url( '/wp-content/uploads/' ) ).$dora_url."' target='_blank'>".$dora."</a></td>";
        echo "<td>".$year[0]->name."</td>";
        echo "<td>".$make[0]->name."</td>";
        echo "<td>".$model[0]->name."</td>";
        echo "<td>".$cab[0]->name."</td>";
        echo "<td>".$drive[0]->name."</td>";
        echo "<td>".$rear[0]->name."</td>";
        echo "<td>".$trim[0]->name."</td>";
        echo "<td>".$wb[0]->name."</td>";
        echo "<td>".$ca[0]->name."</td>";
        echo "<td>".$color[0]->name."</td>";
        echo "<td>".$engine[0]->name."</td>";
        echo "<td>".$trans[0]->name."</td>";
        echo "<td>".$location[0]->name."</td>";
        echo "<td><a href='".esc_url( home_url( '/wp-content/uploads/' ) ).$invoice_url."' target='_blank'>".$vin_num."</a></td>";
        echo "<td>".$build_date."</td>";
        echo "<td>".$recieve_date."</td>";
      echo "</tr>";
    }

  } else {

    echo "<tr class='results-row'>";
    echo "<td colspan='18' class='no-matches'>
            <h2>No Matches. Please contact us for more details.</h2>
            <h2>1.800.858.2883</h2>
          </td>";
    echo "<tr>";
  }

  die();
}
add_action('wp_ajax_nopriv_chassis_pool_submit', 'chassis_pool_submit');
add_action('wp_ajax_chassis_pool_submit', 'chassis_pool_submit');