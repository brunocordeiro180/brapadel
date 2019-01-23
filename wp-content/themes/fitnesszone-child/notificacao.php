<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	require_once("PagSeguro.class.php");

	if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
		$PagSeguro = new PagSeguro();
		$response = $PagSeguro->executeNotification($_POST);
		if( $response->status==3 || $response->status==4 ){
						
		}else{
			
		}
	}
?>