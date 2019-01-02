<?php 

    $clube = $_POST['clubes'];
    $socios = $_POST['socios'];
    $hora_inicial = $_POST['horario_inicial'];
    $hora_final = $_POST['horario_final'];
    $raquetes = $_POST['raquetes'];
    $bolinhas = $_POST['bolinhas'];
    
    $post_id = wp_insert_post(
    array(
        'post_author'   =>  get_currentuserinfo()->ID,                
        'post_type'     => 'reservab',
        'post_title'    => 'Reserva '
    )
    );

    $my_post = array(
    'ID'           =>  $post_id,
    'post_title'   =>  'Reserva ' . $post_id
    );

    wp_update_post( $my_post );
    
    // save a basic text value
    $field_key = "clube";
    $value = $clube;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "socios";
    $value = $socios;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "hora_inicial";
    $value = $hora_inicial;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "hora_final";
    $value = $hora_final;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "raquetes";
    $value = $raquetes;
    update_field( $field_key, $value, $post_id );

    // save a basic text value
    $field_key = "bolinhas";
    $value = $bolinhas;
    update_field( $field_key, $value, $post_id );
    
    // save a basic text value
    $field_key = "status";
    $value = 1;
    update_field( $field_key, $value, $post_id );

    $field_key = "valor";
    $value = $_POST['valor'];
    update_field( $field_key, $value, $post_id ); 
    wp_publish_post( $post_id ); 

?>