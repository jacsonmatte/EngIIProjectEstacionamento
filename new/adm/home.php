<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Control Parking - Página inicial</title>
		<?php
			include '../include/meta.html';
			require '../require/js-base.html';
		?>
	</head>
	<?php
		require '../require/menu-1.html';
		$_SESSION['user_type'] = $_GET['user_type'];
		$_SESSION['username'] = 'teste';
		if ($_SESSION['user_type'] == 1)
			require '../require/menu-adm.html';
		else
			require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
		echo "Bem vindo, <b>" . $_SESSION['username'] . "</b>!<br/>";
		require '../require/content-2-footer.html';
	?>
</html>