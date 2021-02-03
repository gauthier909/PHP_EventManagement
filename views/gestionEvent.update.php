<section>
	<form action="?action=gestionMembres" method="post">
		<fieldset>
		<legend>Modifier l'événement</legend>
		<p><label for="date_debut">Date de début :</label>
			<input type="date" name="date_debut" value="<?php echo $event->html_date_start() ?>"></p>
		<p>
			<label for="date_fin">Date de fin :</label>
			<input type="date" name="date_fin" value="<?php echo $event->html_date_end() ?>">
		</p>
		<p>
			<label for="titre">Titre :</label>
			<input type="text" name="titre"
			value="<?php echo $event->html_title() ?>">
		</p>
		<p>
			<label for="descriptif">Descriptif :</label>
			<!-- <input type="text" name="descriptif" value="<?php //echo $event->html_description() ?>">  -->
			<textarea class="editor" name="descriptif" value="<?php echo $event->html_description() ?>">
					<?php echo $event->html_description(); ?>
					
					</textarea>
		</p>
		<p>
			<label for="lieu">Lieu :</label>
			<input type="text" name="lieu" value="<?php echo $event->html_location() ?>">
		</p>
		<p>
			<label for="cout">Coût :</label>
			<input type="text" name="cout" value="<?php echo $event->html_cost() ?>">
		</p>
		<p>
			<label for="url">URL :</label>
			<input type="text" name="url" value="<?php echo $event->html_url() ?>">
		</p>
		<p><input type="submit" name="form_update" value="Enregistrer">
		 <input type="hidden" name="num_event" value="<?php echo $event->html_num_event() ?>"</p>
		</fieldset>			
	</form>
</section>