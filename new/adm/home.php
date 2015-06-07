<?php
	if (!isset($_SESSION)) {
		session_start();
		$_SESSION['user_type'] = $_GET['user_type'];
		$_SESSION['username'] = 'adm';
	}
	require '../require/adm-aut.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Página inicial</title>
		<?php
			require '../require/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['user_type'] = $_GET['user_type'];
		$_SESSION['username'] = 'adm';
		require '../require/menu-adm.html';
		require '../require/menu-2-content-1.html';
		echo "Bem vindo, <b>" . $_SESSION['username'] . "</b>!<br/>";
		require '../require/content-2-footer.html';
	?>
</html>