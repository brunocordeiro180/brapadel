<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');
require_once("../../../wp-load.php");

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();
$codigo = 0; $valor = 1.00;
if( !isset($_GET['transaction_id']) ){
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
	$codigo =$post_id;
	$valor = $_POST['valor'];
}

if( !isset($_GET['transaction_id']) ){
//EFETUAR PAGAMENTO	
$venda = array("codigo"=>$codigo,
			   "valor"=>$valor,
			   "descricao"=>"Reserva de Quadra",
			//    "nome"=>"",
			//    "email"=>"brunocordeiro180@",
			//    "telefone"=>"(XX) XXXX-XXXX",
			//    "rua"=>"",
			//    "numero"=>"",
			//    "bairro"=>"",
			//    "cidade"=>"",
			   "estado"=>"DF", //2 LETRAS MAIÚSCULAS
			//    "cep"=>"XX.XXX-XXX",
			   "codigo_pagseguro"=>"");
			   
$PagSeguro->executeCheckout($venda,"http://brapadel-com-br.umbler.net/wp-content/themes/fitnesszone-child/checkout.php");

//----------------------------------------------------------------------------
}

//RECEBER RETORNO
if( isset($_GET['transaction_id']) ){
	get_header();

	if(is_array(get_userdata(wp_get_current_user()->ID)->roles)){
	$capitalized_value = strtoupper(get_userdata(wp_get_current_user()->ID)->roles[0]);
	} else {
	$capitalized_value = strtoupper(get_userdata(wp_get_current_user()->ID)->roles);
	}

	if(is_user_logged_in() && strpos(strtoupper($capitalized_value), 'bloqueado') !== true ){ ?>

	<script type="text/javascript">
	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : sParameterName[1];
			}
		}
	};
	</script>
	<?php }else{ ?>

	<section class="reservation__block reservation__active" id="reservation__notlogged">
	<div class="container">
		<div class="row" style="text-align: center;">
		<div class="col-sm">
			<h2 class="reservation__warning">Você precisa estar logado para realizar a reserva. Clique <a href="../wp-login.php">aqui</a> para entrar.</h2>
		</div>
		</div>
	</div>
	</section>

	<?php } 
	
	$pagamento = $PagSeguro->getStatusByReference($codigo);
	
	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if($pagamento->status==3 || $pagamento->status==4){
		$field_key = "pago";
		$value = 1;
		update_field( $field_key, $value, $codigo );
		?>

		<div class="container">
			<div class="row" style="text-align: center;">
			<div class="col-sm">
				<h2 class="reservation__warning">Pagamento realizado com sucesso. Clique <a href="brapadel-com-br.umbler.net/minhas-reservas">aqui</a> para acessar suas reservas.</h2>
			</div>
			</div>
		</div>
		<?php
	}else{
		?>
		<section class="reservation__block reservation__active" id="reservation__notlogged">
		<div class="container">
			<div class="row" style="text-align: center;">
			<div class="col-sm">
				<h2 class="reservation__warning">Reserva feita com sucesso, seu pagamento está em análise. Clique <a href="brapadel-com-br.umbler.net/minhas-reservas">aqui</a> para acessar suas reservas.</h2>
			</div>
			</div>
		</div>
		</section>
	<?php }

	get_footer(); 

}?>