<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 2) {
		echo "Você não está a autorizado a ver esta página!";
		die();
	}
?>