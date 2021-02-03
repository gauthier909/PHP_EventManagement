<section>
	<h2>Enregistrer un paiement</h2>
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
							<td><input type="radio" name="paiement" value="<?php echo $tabMembres[$i]->html_no_user() ?>"></td>
						</tr>
						<?php } ?>
				</tbody>
			</table>
			<?php echo $notification; ?>
	</form>
	<h2>Evènements payés</h2>
	<form action="?action=payEvent" method="post">
		<table id="tableau">
				<thead>
					<tr>
						<th>Membres</th>
						<th>A payé</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0;$i<count($tabMembres);$i++) { ?>
						<tr>
							<td><?php echo $tabMembres[$i]->html_first_name()?> <?php echo $tabMembres[$i]->html_last_name()?>
								<input type="hidden" name="no_user[]" value="<?php echo $tabMembres[$i]->html_no_user()?>">
							</td>
							<td>
								<?php
								
								 if(is_null($tabEventPayed[$tabMembres[$i]->html_no_user()])){
									echo '';
								} else{ 
									foreach ($tabEventPayed[$tabMembres[$i]->html_no_user()] as $key => $value) {

										echo  $value->html_title().'<br>';
									}
								} ?>
							</td>
						</tr>
						<?php } ?>
				</tbody>
			</table>
		</form>
</section>