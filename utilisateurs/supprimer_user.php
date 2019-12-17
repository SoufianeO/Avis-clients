<?php 
session_start();
if(!$_SESSION['is_root'])
	header('location:listerUtilisateurs.php');

require_once("../connection.php");

$id=$_GET['id'];
$req = $connex->prepare('delete from admins where id=? ');
$req->execute( array($id) );

header('location:listerUtilisateurs.php');

?>