<?php require '../require/cliente-aut.php'; ?>

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
		require '../require/menu-cliente.html';
		require '../require/menu-2-content-1.html';
		echo "Bem vindo, <b>" . $_SESSION['username'] . "</b>!<br/>";
		require '../require/content-2-footer.html';
	?>
</html>
