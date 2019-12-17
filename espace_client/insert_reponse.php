<?php

require('../connection.php');

$questionnaire_id = $_POST['questionnaire_id'];

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];

$errors = [];

if(empty($nom) || empty(trim($nom,' ')))
	$errors['nom'] = "Le nom est obligatoire!";
if(empty($prenom) || empty(trim($prenom,' ')))
	$errors['prenom'] = "Le prénom est obligatoire!";
if(empty($telephone) || empty(trim($telephone,' ')))
	$errors['telephone'] = "Le téléphone est obligatoire!";
if(empty($email) || empty(trim($email,' ')))
	$errors['email'] = "L'email est obligatoire!";

if(count($errors)>0) {
	session_start();
	$_SESSION['errors'] = $errors;
	header("location:index.php?questionnaire_id=$questionnaire_id");
	die;
}

// insérer le client
$req = $connex->prepare("INSERT INTO clients values(NULL, ?, ?, ?, ?)");
$req->execute( array($nom,$prenom,$telephone,$email) );

$client_id = $connex->lastInsertId();

// insérer la reponses_questionnaires
$req = $connex->prepare("INSERT INTO clients_questionnaires values(NULL, ?, ?, CURRENT_TIMESTAMP)");
$req->execute( array($questionnaire_id, $client_id) );

$client_questionnaire_id = $connex->lastInsertId();


$req = $connex->prepare("SELECT * FROM questions where questionnaire_id=?");
$req->execute( array($questionnaire_id) );
$questions = $req->fetchAll();

//insérer les questions
foreach($questions as $question) {
	$type_qst = $question['type'];
	
	if($type_qst==3)	// multi choix
		$reponse = json_encode( $_POST['question'.$question['id']] );
	else
		$reponse = $_POST['question'.$question['id']];

	$req = $connex->prepare("INSERT INTO reponses values(NULL, ?, ?, ?, ?)");
	$req->execute( array($reponse, $question['id'], $client_id, $client_questionnaire_id) );
}

header("location:success.php");
?>