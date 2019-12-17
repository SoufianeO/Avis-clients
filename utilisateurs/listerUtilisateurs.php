<?php
	require_once("..\connection.php");
	$query = $connex->prepare("SELECT * from admins where is_root='0'");
	$query->execute();
	$admins = $query->fetchAll();

	require('..\layout\master_begin.php');
	if(!$_SESSION['is_root'])
		header('location:../questionnaires/liste_questionnaires.php');
?>

<h3>Liste des administrateurs</h3>

<?php if(count($admins)==0){ ?>
	<hr />
	<font class="font-weight-bold">Il n'y a pas d'autres administrateurs.</font>
<?php } else { ?>
	<table class="table" style="width: 100%">
		<thead>
			<th style="width: 18%">Nom</th>
			<th style="width: 18%">Prénom</th>
			<th style="width: 30%">Email</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach($admins as $admin){ ?>
			<tr>
				<td><?= $admin['nom'] ?></td>
				<td><?= $admin['prenom'] ?></td>
				<td><?= $admin['email'] ?></td>
				<td>
					<a class="btn btn-warning" href="modifier_pass_user.php?id=<?=$admin['id']?>">Modifier mot de passe</a>
					<a class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteModal<?= $admin['id'] ?>">Supprimer</a>
				</tr>
			</tr>

			<!-- Modal de l'archivage de la suppression -->
			<div class="modal fade" id="deleteModal<?= $admin['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Avertissement</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraiment supprimer cet utilisateur?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
			        <!-- lors du click sur 'Oui' on applique la méthode -->
			        <a href="supprimer_user.php?id=<?=$admin['id']?>"><button type="button" class="btn btn-primary">Oui</button></a>
			      </div>
			    </div>
			  </div>
			</div>

			<?php } ?>
		</tbody>
	</table> 
<?php } ?>

<?php require('..\layout\master_end.php'); ?>