<section>
	<form action="?action=gestionMembres" method="post">
		<table id="tableau">
			<thead>
				<tr>
					<th>Membre</th>
					<th>Rôle</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<td><?php echo $user->html_first_name() ?> <?php echo $user->html_last_name(); ?></td>
				<td>
					<select name="role">
						<option>Membre</option>
						<option>Membre Responsable</option>
						<option>Coach</option>
					</select></td>
				<td><input type="submit" name="form_enregistrer" value="Enregistrer">
				    <input type="hidden" name="no_user" value="<?php echo $user->html_no_user() ?>"></td>
			</tr>
			</tbody>
		</table>
	</form>
</section>