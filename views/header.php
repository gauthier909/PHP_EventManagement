<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" >
		<title>Site Projet Web</title>
		<link rel="stylesheet" type="text/css" href="<?php echo CHEMIN_VUES ?>css/modele.css" media="screen">
	</head>
	<body>
		<header>
			<div class="containe">
			<h1>
				<img src="<?php echo CHEMIN_VUES ?>images/sport.jpg" height="15%" width="15%" alt="logo" id="logo">
				<div id="iplSport">
				IPL Sport
			</div>
			</h1>
			<?php if (!empty($_SESSION['authentifie'])) {  ?>
		<nav>
				<ul>
					
					<li><a href="index.php?action=entrainement">Entrainements</a></li>
					<li><a href="index.php?action=evenement">Evenements</a></li>
					<li><a href="index.php?action=my_account">Mon compte</a></li>
					<?php if ($_SESSION['authentifie'] == 'staff') {  ?>
					<li><a href="index.php?action=gestionMembres">Gestion Membres et Evenements</a></li>
					<li><a href="index.php?action=cotisations">Cotisations</a></li>
					<?php } ?>
					<?php if ($_SESSION['authentifie'] == 'coach') {  ?>
					<li><a href="index.php?action=plan_management">Gestion des plans</a></li>
					<?php } ?>
					<li><a href="index.php?action=logout">Se déconnecter</a></li>
				</ul>
			</nav>
			<?php }  ?>
		</div>
		</header>