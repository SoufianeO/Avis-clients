<?php
require('../connection.php');

$titre = $_POST['titre'];

print_r($_POST);

echo "<br /><br /><br /><br />";

if(empty($titre)){
	session_start();
	$_SESSION['error'] = "Veuillez remplir le champ titre!";
	header('location:ajouterQuestionnaire.php');
	die;
}

$req = $connex->prepare("SELECT * FROM questionnaires where titre=?");
$req->execute( array($titre) );
$rows = $req->fetchAll();

if(count($rows)>0){
	session_start();
	$_SESSION['error'] = "Ce titre a été déjà été utilisé!";
	header('location:ajouterQuestionnaire.php');
	die;
}

$req = $connex->prepare("INSERT INTO questionnaires values(NULL, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
$req->execute( array($titre) );

$questionnaire_id = $connex->lastInsertId();

$nbre_qsts = $_POST['nbre_questions'];

for($i=1; $i<=$nbre_qsts; $i++) {
	$type = $_POST['type_qst_'.$i];

	$req = $connex->prepare("INSERT INTO questions values(NULL, ?, ?, ?, ?, ?)");
	$qst = $_POST['question'.$i];
	$rep = NULL;
	$qst_stat_id = NULL;
	
	if($type==2 || $type==3) {
		if(!isset($_POST['qst_'.$i.'_is_statistic'])) {
			$nbre_reponses = $_POST['nbres_reponses_qst_'.$i];
			$tab = [];

			for($j=1; $j<=$nbre_reponses; $j++) {
				$tab[] = $_POST['reponse_de_qst'.$i.'_'.$j];
			}

			$rep = json_encode($tab);
		}
		else { // c'est une question à statistique
			$req1 = $connex->prepare('SELECT * FROM qsts_statistiques where id=?');
			$req1->execute( array($_POST['qst_'.$i.'_qst_statistiques_id']) );
			$qst_stat = $req1->fetch();

			$qst_stat_id = $qst_stat['id'];
			$rep = $qst_stat['reponses'];
		}

	}

	$req->execute( array($type, $qst, $rep, $questionnaire_id, $qst_stat_id) );
}

session_start();
$_SESSION['flash_msg'] = "Le questionnaire a été ajouté avec succès!";
$_SESSION['flash_type'] = "alert-success";

header('location:liste_questionnaires.php');