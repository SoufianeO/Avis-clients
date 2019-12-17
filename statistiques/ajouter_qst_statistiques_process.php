<?php
if(isset($_POST['annuler'])) {
	header("location:questions_statistiques.php");
	die;
}

if(isset($_POST['enregister'])) {
	if( isset($_POST['type_qst']) && !empty($_POST['mot_cle']) && $_POST['nbre_reponses']>0 ) {

		require("../connection.php");
		
		$nbre_reps = $_POST['nbre_reponses'];

		$req = $connex->prepare("INSERT INTO qsts_statistiques values(NULL, ?, ?, ?)");
		
		$tab = [];
		for($i=1; $i<=$nbre_reps; $i++)			
			$tab[] = $_POST['reponse_'.$i];
		$rep = json_encode($tab);

		$req->execute( array($_POST['mot_cle'], $_POST['type_qst'], $rep) );

		session_start();
		$_SESSION['flash_msg'] = "Le question à statistiques a été ajoutée avec succès!";
		$_SESSION['flash_type'] = "alert-success";
	}
	else {
		session_start();
		$_SESSION['flash_msg'] = "Veuillez remplir tous les champs!";
		$_SESSION['flash_type'] = "alert-danger";
	}
		header('location:questions_statistiques.php');
}

?>