<?php

function verificaMaioridade($dataNasc){
	$data = new DateTime($dataNasc);
	$resultado = $data->diff( new DateTime( date('Y-m-d') ) );
	return $resultado->format( '%Y' );
}

function subtracaoDeDatas($data){
	date_default_timezone_set('America/Sao_Paulo');
    $time = new DateTime();
    $now  = $time->format('Y-m-d');

    $separa = explode(' ', $data);

	$data_final = $separa[0];
	$diff = strtotime($data_final) - strtotime($now);
	$dias = floor($diff / (60 * 60 * 24));

	if ($dias < '0'){
		return '-';
	}elseif ($dias == '0') {
		return "Hoje";
	}elseif ($dias  == '1') {
		return 'Amanhã';
	}else{
		return $dias;
	}

}

function ajustaStatus($data_fim, $dt_sorteio){
	$dataFim = new DateTime($data_fim);
	$sorteio = new DateTime($dt_sorteio);
	$hoje = new DateTime( date('Y-m-d H:i:s'));

	if( ($hoje > $dataFim) && ($hoje < $sorteio) ){
		return true;
	}
}

function trocaDataParaPagina($data){
	date_default_timezone_set('America/Sao_Paulo');

	$hoje = strtotime(date("Y-m-d"));
	$ontem = strtotime(date("Y-m-d", strtotime('-1 days')));

	$separa = explode(' ', $data); 
	$dt = $separa[0];
	$hr = $separa[1];

	$separa2 = explode(':', $hr);
	$hora = $separa2[0].':'.$separa2[1];

	if ( strtotime($dt) == $hoje ) {
		return 'Hoje '.$hora;
	}elseif ( strtotime($dt) == $ontem ) {
		return 'Ontem '.$hora;
	}else{
		return date('d/m/Y', strtotime($dt)).' '.$hora;
	}
}

function trocaNascParaPagina($data){
	$separa = explode('-', $data); 
	$ano = $separa[0];
	$mes = $separa[1];
	$dia = $separa[2];

	$novaData = $dia.'/'.$mes.'/'.$ano;

	return $novaData;
}

function validateCPF($number) {

    $cpf = preg_replace('/[^0-9]/', "", $number);

    if (strlen($cpf) != 11) {
	    return false;
	}

	if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
	    return false;
	}

	$sum = 0;
	$number_to_multiplicate = 10;

	for ($index = 0; $index < 9; $index++) {
	    $sum += $cpf[$index] * ($number_to_multiplicate--); 
	}

	$result = (($sum * 10) % 11);

	$number_quantity_to_loop = [9, 10];

	foreach ($number_quantity_to_loop as $item) {

	    $sum = 0;
	    $number_to_multiplicate = $item + 1;
	  
	    for ($index = 0; $index < $item; $index++) {

	        $sum += $cpf[$index] * ($number_to_multiplicate--);
	  
	    }

	    $result = (($sum * 10) % 11);

	}

	if ($cpf[$item] != $result) {
		return false;
	}

	return true;

}