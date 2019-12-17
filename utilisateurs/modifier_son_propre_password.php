<?php 
	$page_title = "Modifier le mot de passe";
	require('..\layout\master_begin.php');

	$error="";

	if (isset($_POST["valider"])){

		$old_password=$_POST["old_password"];
		$new_password=$_POST["new_password"];
		$confirm_password=$_POST["confirm_password"];
		$id=$_SESSION["id"];

		require_once("../connection.php");

		$query = $connex->prepare("SELECT * from admins where id=? and password=md5(?) limit 1");
		$query->execute( array($id, $old_password) );
		$admins = $query->fetchAll();

		print_r($admins);

		if(count($admins)==0 || $new_password!=$confirm_password)
			$error = "Les mots de passes sont invalides!";
		else{
			$query = $connex->prepare("update admins set password=? where id=? ");
		    $query->execute( array(md5($new_password), $id) );
		    header("location:listerUtilisateurs.php");
		}
	}

?>
<div class="row">
	<div class="col-md-8 offset-md-2">
		<h4>Modifier le mot de passe</h4>
		<hr />
		<form class="form" action="" method="POST">

			<?php if ($error!="") { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
	        <?php unset($_SESSION["error"]); } ?>

			<div class="form-group">
			    <label>Ancien mot de passe</label>
			    <input name="old_password" type="password" class="form-control" autofocus />
			</div>
			
			<div class="form-group">
			    <label>Nouveau mot de passe</label>
			    <input type="password" name="new_password" class="form-control" />
			</div>

			<div class="form-group">
			    <label>Confirmer mot de passe</label>
			    <input type="password" name="confirm_password" class="form-control" />
			</div>

			<div class="row">
				<div class="col-md-4 offset-md-4">
					<div class="form-group">
					    <label></label>
					    <input type="submit" name="valider" value="Valider" class="btn btn-success form-control" />
					</div>
				</div>
			</div>

		</form>
	</div>
</div>

<?php require('..\layout\master_end.php'); ?>