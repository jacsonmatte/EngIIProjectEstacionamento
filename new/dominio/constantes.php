<?php

	// tipo de vaga
	$TIPO_VAGA_CARRO = 1;
	$TIPO_VAGA_MOTO = 2;
	$TIPO_VAGA_UTILITARIO = 3;
	
	// tipo de usuário
	$TIPO_USUARIO_ADM = 1;
	$TIPO_USUARIO_CLIENTE = 2;
	
	// status de reserva
	$STATUS_RESERVA_UTILIZADA = 1; // o veículo já saiu do estacionamento
	$STATUS_RESERVA_UTILIZACAO = 2; // veículo está no estacionamento
	$STATUS_RESERVA_CANCELADA = 3;	// cliente cancelou a reserva
	$STATUS_RESERVA_RESERVADA = 4; // reserva efetuada, veículo ainda não entrou
	$STATUS_RESERVA_NAO_UTILIZADA = 5; // reserva efetuada, veículo não compareceu
	
?>
