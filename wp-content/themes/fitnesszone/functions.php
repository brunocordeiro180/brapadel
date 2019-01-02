<?php

function create_posttype_reservab() {

    $labels = array(
        'name' => 'Reservas Brapadel',
        'singular_name' => 'Reserva Brapadel',
        'add_new_item' => 'Adiconar nova Reserva',
        'edit_item' => 'Editar Reserva',
        'new_item' => 'Nova Reserva',
        'all_items' => 'Todas as Reservas'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-cart'
    );
 
    register_post_type( 'reservab', $args);
}
  
add_action( 'init', 'create_posttype_reservab' );


?>
