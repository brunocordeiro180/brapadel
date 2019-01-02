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

function remove_acf_time_picker_seconds() { ?>
    <style>
      .ui_tpicker_second,
      .ui_tpicker_second::before {
        display: none !important;
      }
    </style>
<?php }
  
add_action('admin_head', 'remove_acf_time_picker_seconds');
add_action( 'init', 'create_posttype_reservab' );






remove_role('assinante_bloqueado');

remove_role('Cliente - Bloqueado');


add_role('cliente_bloqueado', __(
'Cliente - Bloqueado'),
array(
'read' => true, // Allows a user to read
'create_posts' => false, // Allows user to create new posts
'edit_posts' => false, // Allows user to edit their own posts
)
);



?>
