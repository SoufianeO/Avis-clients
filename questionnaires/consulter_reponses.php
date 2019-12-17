<?php 
$page_title = "Réponses aux questionnaires";

require("../connection.php");
require("../scripts/fcts.php");

$req = $connex->prepare("SELECT clients_questionnaires.id, nom, prenom, date_reponse, titre FROM clients_questionnaires, clients, questionnaires where clients_questionnaires.client_id=clients.id and clients_questionnaires.questionnaire_id=questionnaires.id ORDER BY date_reponse DESC");
$req->execute();
$reps = $req->fetchAll();

require ('..\layout\master_begin.php');
?>

<div class="row">
	<div class="col-md-12">
		<h4>Réponses aux questionnaires</h4>

	<?php if(count($reps)>0) { ?>
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th>Nom du client</th>
					<th>Titre du questionnaire</th>
					<th>Date de réponse</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($reps as $rep) { ?>
				<tr>
					<td><?= strtoupper($rep['nom'])." ".ucfirst(strtolower($rep['prenom'])) ?></td>
					<td><?= $rep['titre'] ?></td>
					<td><?= formatDateTime($rep['date_reponse']) ?></td>
					<td>
						<a href="consulter_rep.php?client_questionnaire=<?= $rep['id'] ?>" class="btn pr-3 btn-sm btn-success"><i class="fa fa-eye mr-2"></i>Voir</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php } else { ?>
		<hr />
		<h5>Il n'y a pas de réponses pour le moment.</h5>
	<?php } ?>

	</div>
</div>


<?php require ('..\layout\master_end.php'); ?>