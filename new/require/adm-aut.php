<?
	session_start();
	if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 1) {
		echo("Você não está a autorizado a ver esta página	!");
		die();
	}
?>
