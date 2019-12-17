<?php
$page_title = "Statistiques";

require("../connection.php");
require("../scripts/fcts.php");

$req = $connex->prepare("SELECT questions.id AS id_qst, questions.type, mot_cle, questions.reponses FROM questions,qsts_statistiques
	WHERE questions.qsts_statistiques_id = qsts_statistiques.id");

$req->execute();
$qsts_statistiques = $req->fetchAll();

require ('../layout/master_begin.php');

?>

<div class="row">
	<div class="col-md-12">
		<h4>Statistiques</h4>

		<table class="table">
			<thead class="thead-light">
				<tr>
					<th style="width: 31%; vertical-align: inherit;">Mot-clé</th>
					<th style="width: 15%; vertical-align: inherit;">Type</th>
					<th class="text-center" style="width: 18%">Nombre de réponses à la question</th>
					<th style="width: 36%; vertical-align: inherit;">Réponses</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($qsts_statistiques as $qst_statistiques) {
				$req = $connex->prepare("SELECT reponse FROM reponses WHERE question_id=?");
				$req->execute( array($qst_statistiques['id_qst']) );
				$reps = $req->fetchAll();
				
				$choices = json_decode($qst_statistiques['reponses']);

				for($j=0; $j<count($choices); $j++)
					$map[$j] = 0;	

				$qst_type = $qst_statistiques['type'];

				foreach($reps as $rep) {

					if($qst_type==2) {
						$reponse = $rep['reponse'];
						$index_rep = array_search($reponse, $choices);
						$map[$index_rep]++;
					}
					else {
						$reponses = json_decode( $rep['reponse'] );
						foreach($reponses as $reponse) {;
							$index_rep = array_search($reponse, $choices);
							$map[$index_rep]++;
						}
					}
				}

				$total = 0;
				foreach($map as $elem)
					$total += $elem;

			?>
				<tr>
					<td><?= $qst_statistiques['mot_cle'] ?></td>
					<td><?= ($qst_statistiques['type']==2) ? 'À seul choix' : 'À choix multiple' ?></td>
					<td class="text-center"><?= count($reps) ?></td>
					<td>
						<?php
							for($i=0; $i<count($choices); $i++) {
								$percentage = round(($map[$i]*100)/$total, 2);
								echo '- '.$choices[$i]." ($map[$i]) : <b>$percentage %</b>";
								if($i!=count($choices)-1)
									echo "<br />";
							}
						?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php require ('../layout/master_end.php'); ?>