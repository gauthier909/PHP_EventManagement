

<section id="contenu">
	<h2 id="textHome">Accueil</h2>
	<p>
		Bienvenue sur le site officiel des coureurs du groupe 3 de la ville de Bruxelles en Belgique. <br>
		Ce site est réservé aux membres du club ; il permet la gestion de ses membres (cotisation), des événements ainsi que les plans d'entrainement.
	</p>
	<p>
		<div class="formulaire">
				<form action="?action=accueil" method="post">
				<p>E-mail : <input type="text" name="email" /></p>
				<p>Mot de passe : <input type="password" name="motDePasse" /></p>
				<p><input type="submit" name="form_login" value="Se connecter"></p>
				</form>
			</div>
	</p>
	<p><?php echo $notification;  ?></p>
	<p>Pas de compte ? <a href="index.php?action=inscription">S'inscire</a></p>
	<img id="acc" src="<?php echo CHEMIN_VUES ?>images/muscle.jpg" width ="500" heigth="400">
</section>