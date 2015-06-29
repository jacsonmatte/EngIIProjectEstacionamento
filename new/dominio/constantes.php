<?php

	// tipo de vaga
	$TIPO_VAGA_CARRO = 1;
	$TIPO_VAGA_MOTO = 2;
	$TIPO_VAGA_UTILITARIO = 3;
	
	// tipo de usu�rio
	$TIPO_USUARIO_ADM = 1;
	$TIPO_USUARIO_CLIENTE = 2;
	
	// status de reserva
	$STATUS_RESERVA_UTILIZADA = 1; // o ve�culo j� saiu do estacionamento
	$STATUS_RESERVA_UTILIZACAO = 2; // ve�culo est� no estacionamento
	$STATUS_RESERVA_CANCELADA = 3;	// cliente cancelou a reserva
	$STATUS_RESERVA_RESERVADA = 4; // reserva efetuada, ve�culo ainda n�o entrou
	$STATUS_RESERVA_NAO_UTILIZADA = 5; // reserva efetuada, ve�culo n�o compareceu
	
?>
