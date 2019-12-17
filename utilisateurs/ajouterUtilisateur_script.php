<?php 
require_once("..\connection.php");

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

$pass = generateRandomString(6);

$req = $connex->prepare("INSERT INTO admins values(NULL, ?, ?, ?, ?, '0')");
$req->execute( array($nom, $prenom, $email, md5($pass)) );

$name = strtoupper($nom).' '.ucfirst(strtolower($prenom));

header("location:ajouterUtilisateur_succes.php?newPass=$pass&name=$name");

?>