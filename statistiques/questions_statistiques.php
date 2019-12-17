<?php 
require("../connection.php");

$req = $connex->prepare("SELECT * FROM qsts_statistiques");
$req->execute();
$qsts = $req->fetchAll();

$page_title = "Questions à statistiques";
require ('../layout/master_begin.php');
?>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				<h4>Questions à statistiques</h4>
			</div>
			<div class="col-md-4">
				<div class="float-right">
					<button onclick="display_form()" class="btn btn-sm btn-primary">Ajouter une question à statistiques</button>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<div id="myForm" style="display: none;" class="col-md-8">
				<div class="px-3 py-2" style="border: 4px solid #b4b9be;">
					<h4 class="text-center">
						Ajouter une question à statistiques
					</h4>
					<hr />

					<form action="ajouter_qst_statistiques_process.php" method="post" class="form">
						<div class="form-group">
							<label><u>Type question</u></label><br>
							<input type="radio" class="mr-2" id="seul_choix" name="type_qst" value="2" /><label for="seul_choix" class="mr-5">Question à seul choix</label>
							<input type="radio" class="mr-2" id="choix_multiple" name="type_qst" value="3" /><label for="choix_multiple">Question à choix multiple</label>
						</div>
						<div class="form-group">
							<label><u>Mot-clé</u></label>
							<input type="text" name="mot_cle" class="form-control" placeholder="Taper le mot-clé ..." />
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<div class="float-left">
										<label><u>Réponses possibles</u></label>
									</div>
									<div class="float-right pr-2">
										<button onclick="ajouter_reponse(event)" class="btn btn-sm btn-dark">Ajouter une réponse</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8" id="col-reponses">
									<input type="hidden" name="nbre_reponses" id="nbre_reponses" value="0" />
									
									<div id="reponses" class="px-2 py-1" style="border: 1px solid #b4b9be;">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row justify-content-center">
								<div class="col-md-8">
									<input type="submit" name="enregister" value="Enregistrer" class="form-control btn btn-sm btn-success" />
									<input type="submit" name="annuler" class="form-control mt-2 btn btn-sm btn-warning" value="Annuler" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	<?php if(count($qsts)>0) { ?>
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th>Mot-clé</th>
					<th>Type question</th>
					<th>Réponses</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($qsts as $qst) {
				$tab = json_decode($qst['reponses']);
				$reps = "";
				for($i=0; $i<count($tab); $i++) {
					$reps .= '- '.$tab[$i];
					if($i!=count($tab)-1)
						$reps.= "<br />";
				}

				?>
				<tr>
					<td><?= $qst['mot_cle'] ?></td>
					<td><?= ($qst['type']==2) ? 'Question à seul choix' : 'Question à choix multiple' ?></td>
					<td><?= $reps ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php } else { ?>
		<hr />
		<h5>Il n'y a pas de questions à l'instant.</h5>
	<?php } ?>
	</div>
</div>


<script>
	document.getElementById('reponses').style.borderWidth="0px";

	var disp="none";
	function display_form() {
		disp = (disp=="block") ? "none" : "block";
		document.getElementById('myForm').style.display=disp;
	}

	function ajouter_reponse(event) {
		event.preventDefault();

		var reponses = document.getElementById('reponses');

		reponses.style.borderWidth="1px";

		var nbre_rep = parseInt(++document.getElementById('nbre_reponses').value);

		var input = document.createElement("input");
		input.classList.add('form-control');
		input.style = 'display: inline; width: 91%;';
		input.setAttribute('type', 'text');
		input.setAttribute('placeholder', 'Taper la réponse ici ...');
		input.setAttribute('name', 'reponse_'+nbre_rep);

		var supp_rep = document.createElement('button');
		supp_rep.classList.add('btn');
		supp_rep.classList.add('btn-sm');
		supp_rep.classList.add('btn-danger');
		supp_rep.style = "font-size: 11pt; font-weight: bold;";
		supp_rep.setAttribute('onclick', 'supprimer_reponse(event, '+nbre_rep+')');
		supp_rep.innerHTML = "-";

		var ligne_rep = document.createElement('div');
		ligne_rep.appendChild(input);
		ligne_rep.appendChild(supp_rep);

		reponses.appendChild(ligne_rep);
	}

	function supprimer_reponse(event, num_rep) {
		event.preventDefault();

		var nbre_reps = --document.getElementById('nbre_reponses').value;
		
		if(nbre_reps==0)
			document.getElementById('reponses').style.borderWidth="0px";
		
		var divs_reps = document.getElementById('reponses').getElementsByTagName('div');

		var div_rep = event.target.parentNode;
		div_rep.parentNode.removeChild(div_rep);

		for(var i=parseInt(num_rep)-1; i<divs_reps.length; i++) {
			var j=i+1;
			divs_reps[i].getElementsByTagName('input')[0].setAttribute('name', 'reponse_'+j);
			divs_reps[i].getElementsByTagName('button')[0].setAttribute('onclick', 'supprimer_reponse(event, '+j+')');
		}
	}

</script>

<?php require ('../layout/master_end.php'); ?>