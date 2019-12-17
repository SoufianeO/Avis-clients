<?php 
$page_title = "Ajout d'un nouvel utilisateur";

require('..\layout\master_begin.php');

if(!$_SESSION['is_root'])
	header('location:listerUtilisateurs.php');
?>

<div class="row">
	<div class="col-md-8 offset-md-2">
		<h4>Ajouter un utilisateur</h4>
		<hr />
		<form class="form" action="ajouterUtilisateur_script.php" method="POST">

			<div class="form-group">
			    <label>Nom</label>
			    <input name="nom" type="text" class="form-control" />
			</div>
			
			<div class="form-group">
			    <label>Prénom</label>
			    <input name="prenom" class="form-control" />
			</div>

			<div class="form-group">
			    <label>E-mail</label>
			    <input name="email" class="form-control" />
			</div>

			<div class="row">
				<div class="col-md-4 offset-md-4">
					<div class="form-group">
					    <label></label>
					    <input type="submit" value="Ajouter" class="btn btn-success form-control" />
					</div>
				</div>
			</div>

		</form>
	</div>
</div>

<?php require('..\layout\master_end.php'); ?>