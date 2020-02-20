<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	if (isset($_SESSION['id_user'])){
		header('Location: .\Mes_infos.php');
	}?>

	<form method="post" id="identification" action=".\connexion.php">
		<fieldset>
			<p><b>e-mail : </b><input type="email" name="email"></p>
			<p><b>Mot de passe : </b><input type="password" name="mdp"></p>
		</fieldset>
		<input type="submit" name="Connexion" id="connexion">
		<input type="reset" name="Effacer" id="effacer">
	</form>

	<a href=".\creer_compte.php">Créer un compte</a>

</body>
</html>