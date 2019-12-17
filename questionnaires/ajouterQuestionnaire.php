<?php 
session_start();

$page_title = "Ajouter un nouvel questionnaire";
require ('../layout/master_begin.php');

require('../connection.php');

$req = $connex->prepare("SELECT * FROM qsts_statistiques where type=2");
$req->execute();
$qsts_statistiques_seul_choix = $req->fetchAll();

$req = $connex->prepare("SELECT * FROM qsts_statistiques where type=3");
$req->execute();
$qsts_statistiques_multi_choix = $req->fetchAll();

?>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-7">
				<h4>Ajouter un nouvel questionnaire</h4>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-8">
						<select id="qst_type" class="form-control">
							<option value="0" selected>--</option>
							<option value="1">Question simple</option>
							<option value="2">Seul choix</option>
							<option value="3">Multiple choix</option>
							<option value="4">Classement étoiles</option>
						</select>
					</div>
					<div class="col-md-4">
						<button onclick="addQuestion()" class="btn btn-primary">Ajouter</button>
					</div>
				</div>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-12">
				<form id="questionnaire_form" class="form" action="ajouterQuestionnaire_process.php" method="POST">

					<input type="hidden" name="nbre_questions" value="0" />

					<div id="form-elements">
						
						<div class="form-group">
						    <h4><u>Titre du questionnaire</u></h4>
						    <input name="titre" placeholder="Taper le titre du questionnaire" type="text" class="form-control <?= isset($_SESSION['error']) ? 'is-invalid' : '' ?>" />

							<?php if(isset($_SESSION['error'])) { ?>
						    <span class="invalid-feedback">
		                        <strong><?= $_SESSION['error'] ?></strong>
		                    </span>
		                   	<?php unset($_SESSION['error']); } ?>
						</div>

					</div>

					<div class="row">
						<div class="col-md-4 offset-md-4">
							<div class="form-group">
							    <input type="submit" value="Enregistrer le questionnaire" class="btn btn-success form-control" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	var types_qsts=['(Question simple)', '(Question à seul choix)', '(Question à choix multiple)', '(Question à classement étoiles)'];

	var qsts_statistiques_seul_choix = <?= json_encode($qsts_statistiques_seul_choix) ?>;
	var qsts_statistiques_multi_choix = <?= json_encode($qsts_statistiques_multi_choix) ?>;

	function addQuestion() {
		var qst_type = parseInt(document.getElementById('qst_type').value);

		if(qst_type!=0) {
			var nbre_questions = ++document.getElementsByName('nbre_questions')[0].value;
			
			var num_qst = document.createElement("input");
			num_qst.classList.add('numero-qst');
			num_qst.setAttribute('type', 'hidden');
			num_qst.setAttribute('value', nbre_questions);

			var form = document.getElementById('form-elements');

			var form_group = document.createElement("div");
			form_group.classList.add('form-group');

			form_group.appendChild(num_qst);
			
			var hr = document.createElement("hr");
			
			var titre = document.createElement("div");
			titre.classList.add('row');

			var cont_col_1 = document.createElement("div");
			cont_col_1.classList.add('col-md-6');
			
			var container = document.createElement("div");
			container.classList.add('float-left');

			var h4 = document.createElement("h4");
			
			var u = document.createElement("u");
			u.appendChild(document.createTextNode("Question "+nbre_questions+" "));

			var supp = document.createElement('button');
			supp.classList.add('btn');
			supp.classList.add('btn-danger');
			supp.classList.add('py-0');
			supp.classList.add('ml-1');
			supp.innerHTML = "<i class='fas fa-trash'></i>"
			supp.setAttribute('onclick', "supprimer_question(event, "+nbre_questions+")");

			h4.appendChild(u);

			h4.appendChild(document.createTextNode(types_qsts[qst_type-1]));
			h4.appendChild(supp);
			
			container.appendChild(h4);
			cont_col_1.appendChild(container);
			titre.appendChild(cont_col_1);

			if(qst_type==2 || qst_type==3) {
				var cont_col_2 = document.createElement("div");
				cont_col_2.classList.add('col-md-6');


				var float_left = document.createElement("div");
				float_left.classList.add('float-left');
				float_left.classList.add('mt-1');
				float_left.classList.add('checkbox_statistic');

				var checkbox_statistic = document.createElement('input');
				checkbox_statistic.setAttribute('type', 'checkbox');
				checkbox_statistic.setAttribute('name', 'qst_'+nbre_questions+'_is_statistic');
				checkbox_statistic.setAttribute('onclick', 'afficher_list(event,'+nbre_questions+')');
				checkbox_statistic.setAttribute('value', 0);
				checkbox_statistic.setAttribute('id', "statistiques_"+nbre_questions);

				var label_statistic = document.createElement('label');
				label_statistic.classList.add('ml-1');
				label_statistic.style="font-size: 12pt";
				label_statistic.setAttribute('for', "statistiques_"+nbre_questions);
				label_statistic.innerHTML = "Qst à statistiques";

				var select_mot_cles = document.createElement('select');
				select_mot_cles.classList.add('ml-1');
				select_mot_cles.style = "display:inline; width: 126px; display: none;";
				select_mot_cles.setAttribute('name', "qst_"+nbre_questions+"_qst_statistiques_id");
				select_mot_cles.setAttribute('id', "is_qst_statistiques_"+nbre_questions);

				var qsts_statistiques = (qst_type==2) ? qsts_statistiques_seul_choix : qsts_statistiques_multi_choix;

				for(var k=0; k<qsts_statistiques.length; k++) {
					var option = document.createElement('option');
					option.value = qsts_statistiques[k].id;
					option.innerHTML = qsts_statistiques[k].mot_cle;

					select_mot_cles.appendChild(option);
				}

				float_left.appendChild(checkbox_statistic);
				float_left.appendChild(label_statistic);
				float_left.appendChild(select_mot_cles);

				var float_right = document.createElement("div");
				float_right.classList.add('float-right');

				var btn_add_rep = document.createElement("btn");
				btn_add_rep.classList.add('btn');
				btn_add_rep.classList.add('btn-dark');
				btn_add_rep.classList.add('py-0');
				btn_add_rep.classList.add('mt-1');
				btn_add_rep.appendChild(document.createTextNode('Ajouter une réponse'));

				btn_add_rep.setAttribute('onclick', 'ajouter_reponse(event)');

				float_right.appendChild(btn_add_rep);

				cont_col_2.appendChild(float_left);
				cont_col_2.appendChild(float_right);

				titre.appendChild(cont_col_2);
			}

			form_group.appendChild(hr);
			form_group.appendChild(titre);

			var row = document.createElement("div");
			row.classList.add('row');

			var col = document.createElement("div");

			var input_hidden = document.createElement("input");
			input_hidden.setAttribute('type', 'hidden');
			input_hidden.setAttribute('name', 'type_qst_'+nbre_questions);
			input_hidden.setAttribute('value', qst_type);

			var input = document.createElement("input");
			input.classList.add('form-control');
			input.setAttribute('type', 'text');
			input.setAttribute('placeholder', 'Taper la question ici...');
			input.setAttribute('name', 'question'+nbre_questions);

			col.appendChild(input_hidden);
			col.appendChild(input);

			row.appendChild(col);

			if(qst_type==1 || qst_type==4) {
				col.classList.add('col-md-12');
			}
			else {
				col.classList.add('col-md-7');

				var col2 = document.createElement("div");
				col2.classList.add('col-md-5');
				col2.classList.add('col_reponses');

				var input_hidden = document.createElement("input");
				input_hidden.setAttribute('type', 'hidden');
				input_hidden.setAttribute('name', 'nbres_reponses_qst_'+nbre_questions);
				input_hidden.setAttribute('value', 0);

				col2.appendChild(input_hidden);

				row.appendChild(col2);
			}

			form_group.appendChild(row);

			form.appendChild(form_group);
		
			document.getElementById('qst_type').value=0;
		}
		else {
			alert('Veuillez choisir un type de question!');
		}
	}

	function ajouter_reponse(obj) {
		var form_grp = obj.target.parentNode.parentNode.parentNode.parentNode;

		var num_qst = parseInt(form_grp.getElementsByClassName('numero-qst')[0].value);

		var col_reponses = form_grp.getElementsByClassName('col_reponses')[0];

		var nbre_rep = parseInt(++col_reponses.getElementsByTagName('input')[0].value);

		var input = document.createElement("input");
		input.classList.add('form-control');
		input.style = 'display: inline; width: 93%;';
		input.setAttribute('type', 'text');
		input.setAttribute('placeholder', 'Taper la réponse ici...');
		input.setAttribute('name', 'reponse_de_qst'+num_qst+'_'+nbre_rep);

		var supp_rep = document.createElement('button');
		supp_rep.classList.add('btn');
		supp_rep.classList.add('btn-sm');
		supp_rep.classList.add('btn-danger');
		supp_rep.style = "font-size: 11pt; font-weight: bold;";
		supp_rep.setAttribute('onclick', 'supprimer_reponse(event, '+ num_qst+', '+nbre_rep+')');
		supp_rep.innerHTML = "-";

		var ligne_rep = document.createElement('div');
		ligne_rep.appendChild(input);
		ligne_rep.appendChild(supp_rep);

		col_reponses.appendChild(ligne_rep);
	}

	function supprimer_question(event, num_qst) {
		event.preventDefault();

		document.getElementsByName('nbre_questions')[0].value--;

		var form_groups = document.getElementsByClassName('form-group');

		form_groups[num_qst].parentNode.removeChild(form_groups[num_qst]);

		for(var i=num_qst; i<form_groups.length-1; i++) {
			
			var current_form_group = form_groups[i];
			
			current_form_group.getElementsByTagName('button')[0].setAttribute('onclick', 'supprimer_question(event, '+i+')');

			// num qst
			--current_form_group.getElementsByTagName('input')[0].value;

			var type_qst_input = current_form_group.getElementsByTagName('input')[2];
			type_qst_input.setAttribute('name', 'type_qst_'+i);

			current_form_group.getElementsByTagName('u')[0].innerHTML = 'Question '+i;

			current_form_group.getElementsByClassName('row')[1].getElementsByTagName('input')[1].setAttribute('name', 'question'+i);

			if(type_qst_input.value==2 || type_qst_input.value==3) {


				//float-left 'statistic' contient (checkbox+label+select)
				var float_left_statistic = current_form_group.getElementsByClassName('checkbox_statistic')[0];

				var checkbox_statistic = float_left_statistic.getElementsByTagName('input')[0];
				checkbox_statistic.setAttribute('name', 'qst_'+i+'_is_statistic');
				checkbox_statistic.setAttribute('onclick', 'afficher_list(event,'+i+')');
				checkbox_statistic.setAttribute('id', "statistiques_"+i);

				var label_statistic = float_left_statistic.getElementsByTagName('label')[0];
				label_statistic.setAttribute('for', "statistiques_"+i);

				var select_mot_cles = float_left_statistic.getElementsByTagName('select')[0];
				select_mot_cles.setAttribute('name', "qst_"+i+"_qst_statistiques_id");
				select_mot_cles.setAttribute('id', "is_qst_statistiques_"+i);

				var col_reps = current_form_group.getElementsByClassName('col_reponses')[0];

				var inputs = col_reps.getElementsByTagName('input');

				inputs[0].setAttribute('name', 'nbres_reponses_qst_'+i);

				for(var j=1; j<inputs.length; j++) {
					inputs[j].setAttribute('name', 'reponse_de_qst'+i+'_'+j);
				}
			}
		}
	}

	function supprimer_reponse(event, num_qst, num_rep) {
		event.preventDefault();

		event.target.parentNode.parentNode.getElementsByTagName('input')[0].value--;

		var divs_reps = event.target.parentNode.parentNode.getElementsByTagName('div');

		var div_rep = event.target.parentNode;
		div_rep.parentNode.removeChild(div_rep);

		for(var i=parseInt(num_rep)-1; i<divs_reps.length; i++) {
			var j=i+1;
			divs_reps[i].getElementsByTagName('input')[0].setAttribute('name', 'reponse_de_qst'+num_qst+'_'+j);
			divs_reps[i].getElementsByTagName('button')[0].setAttribute('onclick', 'supprimer_reponse(event, '+num_qst+', '+j+')');
		}
	}

	function afficher_list(event, num_qst) {
		var checkbox_statistic = event.target;
		checkbox_statistic.value = (parseInt(checkbox_statistic.value)+1)%2;
		var value = parseInt(checkbox_statistic.value);

		var tab1 = ['none', 'inline'];
		var tab2 = ['inline-block', 'none'];

		document.getElementById("is_qst_statistiques_"+num_qst).style.display = tab1[value];
		
		var form_group = document.getElementsByClassName('form-group')[num_qst];

		form_group.getElementsByClassName('btn-dark')[0].style.display = tab2[value];
		form_group.getElementsByClassName('col_reponses')[0].style.display = tab2[value];
	}

</script>

<?php require ('..\layout\master_end.php'); ?>