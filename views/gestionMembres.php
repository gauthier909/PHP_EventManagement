
<section>
	<h2>Gestion des membres et évènements</h2>
	<form action="index.php?action=gestionMembres" method="post">
				<p>Rechercher : <input type="text" name="keyword" value="<?php echo $html_motcle ?>"/>
				<input type="submit" name="form_recherche" value="Rechercher"></p>
	</form>
	<form action="?action=gestionMembres" method="post">
		<table id="tableau">
				<thead>
					<tr>
						<th>Membres</th>
						<th><input type="submit" name="modifierRole" value="Modifier Rôle"></th>
						<th><input type="submit" name="valide" value="Valider"></th>
						<th>Validé</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0;$i<count($tabMembres);$i++) { ?>
						<tr>
							<td><?php echo $tabMembres[$i]->html_first_name()?> <?php echo $tabMembres[$i]->html_last_name()?></td>
							<td><input type="radio" name="modifrole" value="<?php echo $tabMembres[$i]->html_no_user() ?>"></td>	
							<td><input type="checkbox" name="validite[]" value="<?php echo $tabMembres[$i]->html_no_user(); ?>"<?php echo (isset($user) && $tabMembres[$i]->no_user()==$user->no_user())?'checked':''; ?>></td>
							<td>
								<?php 
                                   if($tabMembres[$i]->html_checked()==1){
                                   	echo '✔';
                                   }
                                   else{
                                   	echo 'x';
                                   }
								 ?>
							</td>
						</tr>
						<?php } ?>
				</tbody>
			</table>
	</form>
	<p>
		<?php echo $notification;  ?>
	</p>
	<?php  
	if ($vueupdate) {
			require_once(CHEMIN_VUES . 'gestionMembres.update.php');
		}
	?>


    
</fieldset>
</form>
	</div>
	<h3>Evènements</h3>
	<h4><a href="index.php?action=payEvent">Indiquer le paiement de l'inscription à un évènement</a></h4>
	<form action="index.php?action=gestionMembres" method="post">
	<fieldset>
		<legend>Créer un événement</legend>
		<p><label for="date_debut">Date de début :</label>
			<input type="date" name="date_debut"></p>
		<p>
			<label for="date_fin">Date de fin :</label>
			<input type="date" name="date_fin">
		</p>
		<p>
			<label for="titre">Titre :</label>
			<input type="text" name="titre">
		</p>
		<p>
			<label for="descriptif">Descriptif :</label>
			<textarea class="editor" name="descriptif">
					<?php echo $this->getRawHtml(); ?>
					
					</textarea>
		</p>
		<p>
			<label for="lieu">Lieu :</label>
			<input type="text" name="lieu">
		</p>
		<p>
			<label for="cout">Coût :</label>
			<input type="text" name="cout">
		</p>
		<p>
			<label for="url">URL :</label>
			<input type="text" name="url">
		</p>
		<p><input type="submit" name="evenement" value="Créer"></p>
		<?php echo $notification2; ?>	
	</fieldset>
</form>
<form action="index.php?action=gestionMembres" method="post">
				<table id="tableau">
					<thead>
						<tr>
							<th>Evenement</th>
							<th><input type="submit" name="modifierEvent" value="Changer"></th>
							<th><input type="submit" name="listDesEvent" value="Lister les membres inscrits/intéressés"></th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i=0;$i<count($tabevents);$i++) { ?>
						<tr>
							<td><?php echo $tabevents[$i]->html_title()?> </td>
							<td><input type="radio" name="modifEvent" value="<?php echo $tabevents[$i]->html_num_event() ?>" ></td>
							<td><input type="radio" name="listEvent" value="<?php echo $tabevents[$i]->html_num_event() ?>" ></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php echo $notification3;  ?>
			</form>
		<?php 
		if ($vueupdate2) {
			require_once(CHEMIN_VUES . 'gestionEvent.update.php');
		} ?>


		<?php 
		if ($vueupdate3) {
			require_once(CHEMIN_VUES . 'gestionListEvent.update.php');
		} ?>

</section>

<script src="./assets/ckeditor.js">
</script>
<script src="./views/javascript/wysiwyg.js">
</script>