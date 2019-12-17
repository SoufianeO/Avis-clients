<?php

try {
  	$connex=new PDO("mysql:host=localhost;dbname=menara","root","");
}
catch (PDOException $e) {
	echo $e->getMessage();
}

?>