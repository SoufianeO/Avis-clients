<?php
	session_start(); 
	if( isset($_SESSION["connected"]) )
	 	header("location:utilisateurs/listerUtilisateurs.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Authentification</title>

	<script src="assets/js/jquery-3.3.1.slim.min.js" ></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<link href="assets/css/default.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/webfonts/fontawesome-all.min.css" rel="stylesheet">

	<link rel="icon" href="assets/logo-fenetre.png">

</head>
<body>

<div class="container pt-3">
	<div class="row justify-content-center mb-5">
		<div class="col-md-8">
			<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 2px solid #2f4050;">
			    <h4 class=" text-center">Espace administrateurs</h4>
			</nav>
		</div>
	</div>
	
	<div class="row justify-content-center">
	    <div class="col-md-6">
			<div class="card">
				<div class="card-header">Authentification</div>

				<div class="card-body">

					<?php if (isset($_SESSION["error"])) { ?>
					<div class="row">
			            <div class="col-md-12">
			                <div class="alert alert-danger" role="alert">
			                    <?= $_SESSION["error"] ?>
			                </div>
			            </div>
			        </div>
			        <?php unset($_SESSION["error"]); } ?>

					<form action="login.php" method="post" class="form">
						<div class="row mt-2">
							<div class="col-md-4">
						    	<label>E-mail</label>
							</div>
							<div class="col-md-8">
						    	<input name="email" type="text" class="form-control" autofocus />
							</div>
						</div>

						<div class="row mt-2">
							<div class="col-md-4">
						    	<label>Mot de passe</label>
							</div>
							<div class="col-md-8">
						    	<input name="password" type="password" class="form-control" />
							</div>
						</div>

						<div class="row mt-2">
							<div class="col-md-4 offset-md-4">
						    	<input name="valider" type="submit" value="Se connecter" class="form-control btn btn-primary" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>