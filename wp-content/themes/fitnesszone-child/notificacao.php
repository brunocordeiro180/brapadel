<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	require_once("PagSeguro.class.php");

	if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
		$PagSeguro = new PagSeguro();
		$response = $PagSeguro->executeNotification($_POST);
		if( $response->status==3 || $response->status==4 ){
        	$clube = $_POST['clube'];
			$quadra = $_POST['quadra'];
			$socios = $_POST['socios'];
			$hora_inicial = $_POST['horario_inicial'];
			$hora_final = $_POST['horario_final'];
			$raquetes = $_POST['raquetes'];
			$bolinhas = $_POST['bolinhas'];
			$data = $_POST['data'];
			$current_user = wp_get_current_user();
			
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

			$field_key = "quadra";
			$value = $quadra;
			update_field( $field_key, $value, $post_id );

			// save a basic text value
			$field_key = "socios";
			$value = $socios;
			update_field( $field_key, $value, $post_id );

			$field_key = "data";
			$value = $data;
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

			// save a basic text value
			$field_key = "usuario";
			$value = $current_user->ID;
			update_field( $field_key, $value, $post_id );

			$field_key = "valor";
			$value = $_POST['valor'];
			update_field( $field_key, $value, $post_id ); ; 

			$field_key = "forma_de_pagamento";
			$value = $_POST['forma_pagamento'];
			update_field( $field_key, $value, $post_id ); 

			$field_key = 'pago';
			$value = 1;
			update_field($field_key, $value, $post_id);
			
			wp_publish_post( $post_id ); 

			$user_data = get_userdata( get_currentuserinfo()->ID );
			
			// the message
			$msg = "Sua Reserva foi cadastrada com sucesso!\nO código da sua reserva é " . $post_id . " e está programada para acontecer no dia " . str_replace(".", "/", $data) . " às  " . $hora_inicial;

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);

			// send email
			mail($user_data->user_email,"Confirmação de Reserva",$msg);
			
		}else{
			//PAGAMENTO PENDENTE
			$clube = $_POST['clube'];
			$quadra = $_POST['quadra'];
			$socios = $_POST['socios'];
			$hora_inicial = $_POST['horario_inicial'];
			$hora_final = $_POST['horario_final'];
			$raquetes = $_POST['raquetes'];
			$bolinhas = $_POST['bolinhas'];
			$data = $_POST['data'];
			$current_user = wp_get_current_user();
			
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

			$field_key = "quadra";
			$value = $quadra;
			update_field( $field_key, $value, $post_id );

			// save a basic text value
			$field_key = "socios";
			$value = $socios;
			update_field( $field_key, $value, $post_id );

			$field_key = "data";
			$value = $data;
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

			// save a basic text value
			$field_key = "usuario";
			$value = $current_user->ID;
			update_field( $field_key, $value, $post_id );

			$field_key = "valor";
			$value = $_POST['valor'];
			update_field( $field_key, $value, $post_id ); ; 

			$field_key = "forma_de_pagamento";
			$value = $_POST['forma_pagamento'];
			update_field( $field_key, $value, $post_id ); 
			
			wp_publish_post( $post_id ); 

			$user_data = get_userdata( get_currentuserinfo()->ID );
			
			// the message
			$msg = "Sua Reserva foi cadastrada com sucesso!\nO código da sua reserva é " . $post_id . " e está programada para acontecer no dia " . str_replace(".", "/", $data) . " às  " . $hora_inicial;

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);

			// send email
			mail($user_data->user_email,"Confirmação de Reserva",$msg);
			echo $PagSeguro->getStatusText($PagSeguro->status);
		}
	}
?>