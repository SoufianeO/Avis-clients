<?php
	require __DIR__.'\..\connection.php';
	$query = $connex->prepare("SELECT * from message where lu='0'");
	$query->execute();
	$nonLus = $query->fetchAll();

	$query = $connex->prepare("SELECT * from services");
	$query->execute();
	$services = $query->fetchAll();
?>

<ul class="pt-4">
	<li class="link">
		<a href="#collapse-post-profil" data-toggle="collapse" aria-controls="collapse-post" aria-expanded="false">
			<span class="fa fa-user"></span>
			<span class="hidden-xs hidden-sm div"><?php echo strtoupper($_SESSION["nom"])." ".ucfirst(strtolower($_SESSION["prenom"])); ?></span>
		</a>

		<ul class="collapse collapseable" id="collapse-post-profil">
			<li>
				<a href="../utilisateurs/modifier_son_propre_password.php">Modifier mot de passe</a>
			</li>
		</ul>
	</li>
	
	<li class="link pt-4">
		<a href="#collapse-forms" data-toggle="collapse" aria-controls="collapse-post" aria-expanded="false">
			<i class="fas fa-tasks"></i>
			<span class="hidden-xs hidden-sm div">Questionnaires</span>
		</a>

		<ul class="collapse collapseable" id="collapse-forms">
			<li>
				<a href="../questionnaires/ajouterQuestionnaire.php">
					<i class="fas fa-user-plus"></i>
					<span class="hidden-xs hidden-sm div">Nouvel questionnaire</span>
				</a>
			</li>
			<li>
				<a href="../questionnaires/liste_questionnaires.php">
					<i class="fas fa-cogs"></i>
					<span class="hidden-xs hidden-sm div">Liste des questionnaires</span>
				</a>
			</li>
			<li>
				<a href="../questionnaires/consulter_reponses.php">
					<i class="fas fa-database"></i>
					<span class="hidden-xs hidden-sm div ml-1">Consulter les réponses</span>
				</a>
			</li>
		</ul>
	</li>

	<li class="link">
		<a href="#collapse-statistiques" data-toggle="collapse" aria-controls="collapse-post" aria-expanded="false">
			<i class="fas fa-chart-line"></i>
			<span class="hidden-xs hidden-sm div">Statistiques</span>
		</a>

		<ul class="collapse collapseable" id="collapse-statistiques">
			<li>
				<a href="../statistiques/questions_statistiques.php">
					<i class="fas fa-question-circle"></i>
					<span class="hidden-xs hidden-sm div">Questions à statistiques</span>
				</a>
			</li>
			<li>
				<a href="../statistiques/afficher_statistiques.php">
					<i class="fas fa-chart-bar"></i>
					<span class="hidden-xs hidden-sm div">Afficher les statistiques</span>
				</a>
			</li>
		</ul>
	</li>

<?php if($_SESSION['is_root']) { ?>
	<li class="link">
		<a href="#collapse-post-users" data-toggle="collapse" aria-controls="collapse-post" aria-expanded="false">
			<i class="fas fa-users"></i>
			<span class="hidden-xs hidden-sm div">Comptes utilisateurs</span>
		</a>

		<ul class="collapse collapseable" id="collapse-post-users">
			<li>
				<a href="../utilisateurs/ajouterUtilisateur.php">
					<i class="fas fa-user-plus"></i>
					<span class="hidden-xs hidden-sm div">Ajouter un utilisateur</span>
			</a>
			</li>
			<li>
				<a href="../utilisateurs/listerUtilisateurs.php">
					<span class="hidden-xs hidden-sm div ml-3">Gérer les utilisateurs</span>
				</a>
			</li>
		</ul>
	</li>
<?php } ?>

	<li class="link">
		<a href="../logout.php">
			<i class="fas fa-sign-out-alt"></i>
			<span class="hidden-xs hidden-sm div">Déconnexion</span>
		</a>
	</li>
</ul>