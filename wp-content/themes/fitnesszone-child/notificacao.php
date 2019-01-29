<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	require_once("PagSeguro.class.php");

	$url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/" . $_POST['notificationCode'] . "?email=brasiliapadel@gmail.com&token=D71B13B1A8CF488385EC9AE11317FBF5";
	$xml = simplexml_load_file($url);
	$reference = $xml->reference;
	$status = $xml->status;

	if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
		if( $status==3 || $status==4 ){
			update_field( "pago", true, $reference);
		}else{
			update_field( "pago", false, $reference);
		}
	}
?>