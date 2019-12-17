<?php
$page_title = "Liste des questionnaires";

require("../connection.php");
require("../scripts/fcts.php");

$req = $connex->prepare("SELECT * FROM questionnaires ORDER BY date_creation DESC");
$req->execute();
$questionnaires = $req->fetchAll();

require ('..\layout\master_begin.php');

?>

<div class="row">
	<div class="col-md-12">
		<h4>Liste des questionnaires</h4>

	<?php if(count($questionnaires)>0) { ?>
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th>Titre du questionnaire</th>
					<th>Date de création</th>
					<th>Nombre de réponses</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($questionnaires as $questionnaire) {
				$req = $connex->prepare("SELECT count(id) AS nbre FROM clients_questionnaires WHERE questionnaire_id=?");
				$req->execute( array($questionnaire['id']) );
				$nbre_reps = $req->fetch()['nbre'];
			?>
				<tr>
					<td><?= $questionnaire['titre'] ?></td>
					<td><?= formatDateTime($questionnaire['date_creation']) ?></td>
					<td><?= $nbre_reps ?></td>
					<td>
						<button onclick="copy_to_clipboard(<?= $questionnaire['id'] ?>)" class="btn pr-3 btn-sm btn-primary">
							<i class="fa fa-copy mr-2"></i>Obtenir le lien
						</button>

						<input type="hidden" id="questionnaire_<?= $questionnaire['id'] ?>" value="localhost/menara_prefa/espace_client/index.php?questionnaire_id=<?= $questionnaire['id'] ?>" />
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php } else { ?>
		<hr />
		<h5>Il n'y a pas de questionnaires à l'instant.</h5>
	<?php } ?>

	</div>
</div>

<script>
	function copy_to_clipboard(id_questionnaire) {
		var tmp_input = document.createElement('input');
		tmp_input.setAttribute('type', 'text');
		tmp_input.setAttribute('value', document.getElementById("questionnaire_"+id_questionnaire).value);
		document.body.appendChild(tmp_input);

		tmp_input.select();
		document.execCommand("copy");

		document.body.removeChild(tmp_input);

		alert('Le lien du questionnaire a été copié au presse-papiers!')
	}
</script>

<?php require ('..\layout\master_end.php'); ?>