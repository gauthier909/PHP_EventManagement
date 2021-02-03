<section>
<form action="?action=payEvent" method="post">
		<table id="tableau">
				<thead>
					<tr>
						<th>Membres</th>
						<th><input type="submit" name="payEvent" value="Indiquer paiement"></th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0;$i<count($tabMembres);$i++) { ?>
						<tr>
							<td><?php echo $tabMembres[$i]->html_first_name()?> <?php echo $tabMembres[$i]->html_last_name()?></td>
							<td><input type="radio" name="modifrole" value="<?php echo $tabMembres[$i]->html_no_user() ?>"></td>
						</tr>
						<?php } ?>
				</tbody>
			</table>
	</form>
	<form action="?action=payEvent" method="post">
	<table id="tableau">
			<thead>
				<tr>
					<th>Membre</th>
					<th>A payé pour l'évènement</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><?php echo $user->html_first_name() ?> <?php echo $user->html_last_name(); ?></td>
				<td>
					<select name="event">
						<?php for($k=0;$k<count($tabevents);$k++){  ?>
						<option value="<?php echo $tabevents[$k]->html_num_event() ?>"><?php echo $tabevents[$k]->html_title()  ?></option>
						<?php } ?>
					</select></td>
				<td><input type="submit" name="form_enregistrer" value="Enregistrer">
				    <input type="hidden" name="no_user" value="<?php echo $user->html_no_user() ?>"></td>
			</tr>
			</tbody>
		</table>
	</form>
</section>