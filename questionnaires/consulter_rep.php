<?php 
$page_title = "Réponses aux questionnaires";

require("../connection.php");
require("../scripts/fcts.php");

if(isset($_GET['client_questionnaire']))
	$clients_questionnaires_id = $_GET['client_questionnaire'];

$req = $connex->prepare("SELECT * FROM clients,clients_questionnaires WHERE clients_questionnaires.id=? AND clients.id=client_id");
$req->execute( array($clients_questionnaires_id) );
$client = $req->fetch();

$req = $connex->prepare("SELECT * FROM questionnaires,clients_questionnaires WHERE clients_questionnaires.id=? AND questionnaires.id=questionnaire_id");
$req->execute( array($clients_questionnaires_id) );
$questionnaire = $req->fetch();

$req = $connex->prepare("SELECT questions.question, questions.type, reponses.reponse  FROM reponses, questions WHERE clients_questionnaires_id= ? AND questions.id=reponses.question_id");
$req->execute( array($clients_questionnaires_id) );
$reponses = $req->fetchAll();

require ('..\layout\master_begin.php');
?>

<div class="row">
	<div class="col-md-12">
		<h4>Réponses de <b><?= strtoupper($client['nom'])." ".ucfirst(strtolower($client['prenom'])) ?></b> au questionnaire <u><?= $questionnaire['titre'] ?></u></h4>

		<table class="table">
			<thead>
				<tr>
					<th>Question</th>
					<th>Réponse</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; foreach($reponses as $reponse) { ?>
				<tr>
					<td><?= $i.'. '.$reponse['question'] ?></td>
					<td>
						<?php
							$type_qst = $reponse['type'];
							if($type_qst==1 || $type_qst==2){
								echo $reponse['reponse'];
							}
							elseif($type_qst==3) {
								$reps = json_decode($reponse['reponse']);
								for($i=0; $i<count($reps); $i++) {
									echo '- '.$reps[$i];
									if($i!=count($reps)-1)
										echo "<br />";
								}
							}
							else {
								echo $reponse['reponse'].' étoiles';
							}

							$i++;
						?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<?php require ('..\layout\master_end.php'); ?>