<div class="my_meta_control">
  
  <?php $attachments = new Attachments( 'truck_docs' ); ?>

  <?php

    global $dora;
    global $invoice;

    while ( $attachments->get() ) {
      $field_type = $attachments->field( 'type' );

      if ($field_type == 'DORA') {
        $dora = $attachments->field( 'name' );
      } elseif ($field_type == 'Invoice') {
        $invoice = $attachments->field( 'name' );
      }
    }

    $args = array('post_type'=>'truck_item_number','post_status'=>'publish','posts_per_page'=>-1);
    $tin_query = new WP_Query( $args );
    $tin_arr = array();

    if ( $tin_query->have_posts() ) 
    {
      while ( $tin_query->have_posts() )
      {
        $tin_query->the_post();
 
        array_push( $tin_arr, array( 'id' => $post->ID , 'title' => $post->post_title ) );
      }
    }


  ?>

  <label>Select Truck Item Number:</label>
  <?php $mb->the_field('truck_item_number'); ?>
  <p>
    <select name="<?php $mb->the_name(); ?>">
      <option value=""><?php echo esc_attr( __( 'Select TIN' ) ); ?></option>
      <?php foreach ($tin_arr as $tin) : ?>
        <option value="<?php echo $tin['id']; ?>"<?php $mb->the_select_state($tin['id']); ?>><?php echo $tin['title']; ?></option>
      <?php endforeach; ?>
    </select>
  </p>

  <label>Select Build Date:</label>
  <?php $mb->the_field('build_date'); ?>
  <p>
    <input class="datepicker" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
    <span>Cleck field to select a date</span>
  </p>

  <label>Recieve Date:</label>
  <?php $mb->the_field('recieve_date'); ?>
  <p>
    <input class="recieve-date" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
    <span>This is populated with the date 3 weeks after the Build Date.</span>
  </p>
</div>