<?php
	require('../connection.php');

	session_start();

	$questionnaire_id = $_GET['questionnaire_id'];

	$req = $connex->prepare('SELECT * FROM questions where questionnaire_id=?');
	$req->execute( array($questionnaire_id) );
	$questions = $req->fetchAll();

	if(count($questions)==0)
		header('location:error.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Espace client</title>
	
	<script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>

	<link href="../assets/css/default.css" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/webfonts/fontawesome-all.min.css" rel="stylesheet">

	<link href="../assets/css/stars_rating/font-awesome-3.2.1.css" rel="stylesheet">
	<link href="../assets/css/stars_rating/stars_rating.css" rel="stylesheet">

	<link rel="icon" href="../assets/logo-fenetre.png">

</head>
<body>

<div class="container-fluid">
	<div class="row" style="background-color: #6e7483;">
		<div class="col-md-4">
			<img src="../assets/logo.png" class="mt-1" width="170px">
		</div>
	</div>

	<div class="row justify-content-center mt-3">
		<div class="col-md-8">
			<h4>Bonjour, prière de remplir le questionnaire suivant :</h4>

			<form class="form mt-4" action="insert_reponse.php" method="post">

				<input type="hidden" name="questionnaire_id" value="<?= $questionnaire_id ?>" />
				
				<h2><u>Informations personnelles :</u></h2>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nom</label>
							<input required="" type="text" name="nom" class="form-control <?= isset($_SESSION['errors']['nom']) ? 'is-invalid' : '' ?>" />

							<?php if(isset($_SESSION['errors']['nom'])) { ?>
							    <span class="invalid-feedback">
			                        <strong><?= $_SESSION['errors']['nom'] ?></strong>
			                    </span>
		                   	<?php unset($_SESSION['errors']['nom']); } ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Prénom</label>
							<input required="" type="text" name="prenom" class="form-control <?= isset($_SESSION['errors']['prenom']) ? 'is-invalid' : '' ?>" />

							<?php if(isset($_SESSION['errors']['prenom'])) { ?>
							    <span class="invalid-feedback">
			                        <strong><?= $_SESSION['errors']['prenom'] ?></strong>
			                    </span>
		                   	<?php unset($_SESSION['errors']['prenom']); } ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Téléphone</label>
							<input required="" type="text" name="telephone" class="form-control <?= isset($_SESSION['errors']['telephone']) ? 'is-invalid' : '' ?>" />

							<?php if(isset($_SESSION['errors']['telephone'])) { ?>
							    <span class="invalid-feedback">
			                        <strong><?= $_SESSION['errors']['telephone'] ?></strong>
			                    </span>
		                   	<?php unset($_SESSION['errors']['telephone']); } ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email</label>
							<input required="" type="text" name="email" class="form-control <?= isset($_SESSION['errors']['email']) ? 'is-invalid' : '' ?>" />

							<?php if(isset($_SESSION['errors']['email'])) { ?>
							    <span class="invalid-feedback">
			                        <strong><?= $_SESSION['errors']['email'] ?></strong>
			                    </span>
		                   	<?php unset($_SESSION['errors']['email']); } ?>
						</div>
					</div>
				</div>
				
				<hr style="border-top: 3px solid rgba(0,0,0,.1)" />
				<h2 class="mb-3"><u>Questions :</u></h2>

				<div class="row">
					<div class="col-md-12">
						<?php for($i=0; $i<count($questions); $i++) { ?>
							<div class="form-group">
							    <h5><li><u>Question <?= $i+1 ?> :</u></li></h5>
								<label><?= $questions[$i]['question'] ?></label>
								
								<?php 
								$type_qst = $questions[$i]['type'];
								
								if($type_qst==1) { ?>
							    	<input required="" type="text" class="form-control" name="question<?= $questions[$i]['id'] ?>" />
							    <?php
							    } elseif($type_qst==4) { ?>
									<br />
									<fieldset class="rating">
									    <input required="" type="radio" id="star5" name="question<?= $questions[$i]['id'] ?>" value="5" /><label for="star5" class="full"></label>
									    <input required="" type="radio" id="star4" name="question<?= $questions[$i]['id'] ?>" value="4" /><label for="star4" class="full"></label>
									    <input required="" type="radio" id="star3" name="question<?= $questions[$i]['id'] ?>" value="3" /><label for="star3" class="full"></label>
									    <input required="" type="radio" id="star2" name="question<?= $questions[$i]['id'] ?>" value="2" /><label for="star2" class= "full"></label>
									    <input required="" type="radio" id="star1" name="question<?= $questions[$i]['id'] ?>" value="1" /><label for="star1" class="full"></label>
									</fieldset>
									<label style="margin-left: 10px; margin-top: 7px;">(obligatoire)</label>
								<?php
								} elseif($type_qst==2) { 
								    $reponses = json_decode($questions[$i]['reponses']); 
								    foreach($reponses as $reponse) { ?>
								    	<br/><input required="" type="radio" class="mr-3" name="question<?= $questions[$i]['id'] ?>" value="<?= $reponse ?>" /><?= $reponse ?>
								    <?php } ?>
								<?php
								} else {
									$reponses = json_decode($questions[$i]['reponses']);
								    foreach($reponses as $reponse) { ?>
								    	<br/><input type="checkbox" class="mr-3" name="question<?= $questions[$i]['id'] ?>[]" value="<?= $reponse ?>" /><?= $reponse ?>
								    <?php } ?>
								<?php } ?>

							</div>
						<?php } ?>
					</div>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="envoyer" value="Envoyer" />
				</div>

			</form>
		</div>
	</div>
</div>

</body>
</html>