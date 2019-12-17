<?php 
$page_title = "Ajout d'un nouvel utilisateur";
require('..\layout\master_begin.php');
?>

<div class="row">
	<div class="col-md-10 offset-md-1">
		<h4>L'utilisateur <font class="font-weight-bold"><?= $_GET['name'] ?></font> a été crée avec succès avec le mot de pass : <font class="font-weight-bold"><?= $_GET['newPass'] ?></font>.</h4>

		<br />

		<a href="listerUtilisateurs.php" class="btn btn-success">Voir la liste des utilisateurs</a>
	</div>
</div>

<?php require('..\layout\master_end.php'); ?>