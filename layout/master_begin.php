<?php
	if( !isset($_SESSION) )
		session_start();
	
	if( !isset($_SESSION["connected"]) )
		header("location:../index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= isset($page_title) ? "$page_title" : "Bienvenue" ?></title>
	
	<script src="../assets/js/jquery-3.3.1.slim.min.js" ></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>

	<link href="../assets/css/default.css" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/webfonts/fontawesome-all.min.css" rel="stylesheet">

	<link rel="icon" href="../assets/logo-fenetre.png">

</head>
<body>

<div class="container-fluid">
		<div class="col-md-4">
			<img src="../assets/logo.png" class="mt-1" width="130px">
	</div>

	<div class="row display-table-row">
		<div class="col-md-2 display-table-cell hidden-sm-down hidden-xs-down valign-top" id="side-menu">
			<?php include("side.php"); ?>
		</div>
		
		<div class="col-md-8 offset-md-1 mt-4">

			<?php if(isset($_SESSION['flash_msg'])) { ?>
                <div class="alert <?= $_SESSION['flash_type'] ?> alert-dismissible show"  role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <?= $_SESSION['flash_msg'] ?>
                </div>
            <?php unset($_SESSION['flash_msg']); } ?>