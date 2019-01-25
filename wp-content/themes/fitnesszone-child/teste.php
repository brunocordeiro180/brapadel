<?php


$url = "https://ws.pagseguro.uol.com.br/v2/transactions?email=brunocordeiro180@gmail.com&token=D47613C1FB3F4A6A90FF58BC3AFEF3FE&reference=321";
$xml = simplexml_load_file($url);
echo ($xml->transactions->transaction->status);






















?>