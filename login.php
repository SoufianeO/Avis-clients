<?php 
	// ajouter nouvel admin :
	/*
		include('connection.php');
		$query = $connex->prepare("INSERT into admins values (?,?,?,?,?,?)");
		$query->execute( array(null,'soufiane','ounida','soufiane@gmail.com', md5('123'), 1));
	*/
  
	if( isset($_POST['valider']) ) {
		require_once("connection.php");
		$query = $connex->prepare("SELECT * from admins where email=? and password=? limit 1");
		$query->execute( array($_POST['email'], md5($_POST['password'])) );
		$result = $query->fetchAll();

		session_start();

		if(count($result)>0) {
			$_SESSION['connected']=true;
			$_SESSION['nom']=$result[0]['nom'];
			$_SESSION['prenom']=$result[0]['prenom'];
			$_SESSION['is_root']=$result[0]['is_root'];
			$_SESSION['id']=$result[0]['id'];

			header("location:utilisateurs/listerUtilisateurs.php");
		}
		else{
			$_SESSION['error']="Le login ou le mot de passe est invalide!";
			header("location:index.php");
		}
	}



?>