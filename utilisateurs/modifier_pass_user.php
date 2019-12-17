<?php 
$page_title = "Modifier le mot de passe d'un administrateur";
require('..\layout\master_begin.php');

if( !$_SESSION['is_root'] )
	header('location:listerUtilisateurs.php');

$error="";

if (isset($_POST["valider"])) {

	$id=$_GET["id"];	
	$confirm_password=$_POST["confirm_password"];
	$new_password=$_POST["new_password"];

	require_once("../connection.php");

	if($new_password!=$confirm_password)
		$error = "Les mots de passes doivent être identiques!";
	else{
		$query = $connex->prepare("update admins set password=? where id=$id");
		$query->execute( array(md5($new_password)) );
		header("location:listerUtilisateurs.php"); 
	}

}


?>
<div class="row">
	<div class="col-md-8 offset-md-2">
		<h4>Modifier mot de passe</h4>
		<hr />
		<form class="form" action="" method="POST">

			<?php if ($error!="") { ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
	        <?php unset($_SESSION["error"]); } ?>
			
			<div class="form-group">
			    <label>Nouveau mot de passe</label>
			    <input type="password" name="new_password" class="form-control" autofocus />
			</div>

			<div class="form-group">
			    <label>Confirmer mot de passe</label>
			    <input type="password" name="confirm_password" class="form-control" />
			</div>

			<div class="row">
				<div class="col-md-4 offset-md-4">
					<div class="form-group">
					    <label></label>
					    <input type="submit" value="Valider" name="valider" class="btn btn-success form-control" />
					</div>
				</div>
			</div>

		</form>
	</div>
</div>

<?php require('..\layout\master_end.php'); ?>