<section>
	<div id="cotisation">
		<h2>Cotisation</h2>
		<form action="index.php?action=cotisations" method="post">
 
   <fieldset>
       <legend>Débuter la cotisation de l'année</legend> 

       <p><label for="cout">Coût :</label>
       <input type="text" name="cout"/></p>

       <p><label for="annee_mf">Année :</label>
       <input type="text" name="annee_mf"/></p>

      <p><label for="adresse">Répondre à l'adresse e-mail :</label>
       <input type="text" name="adresse"/></p>


       <p><input type="submit" name="envoieCotisation" value="Envoyer"></p>
       <?php echo $notification;  ?>
   </fieldset>
</form>

   <h2>Paiements</h2>
   <form action="index.php?action=cotisations" method="post">
   <p>Année : <select name="annee">
   	<?php for($k=0;$k<count($tabAnnee);$k++){  ?>
   	<option <?php if($annee ==  $tabAnnee[$k]->html_annee_mf()) echo "selected";  ?>>
   		<?php echo $tabAnnee[$k]->html_annee_mf() ?>
   	</option>
   	<?php } ?>
   </select> <input type="submit" name="choixAnnee">
<p><strong>Année:  <?php echo $annee  ?>  <br>   Coût de la cotisation: <?php echo $cost[0]->html_cost_mf()  ?> Euros</strong></p>
   	<h3>Membres pas en ordre</h3>
   	<?php if (count($tabMembresPasEnOrdre) == 0) {echo 'Tout les membres ont payé leur cotisation cette année';} ?>
   	<table id="tableau">
				<thead>
					<tr>
						<th>Membres</th>
						<th>A payé</th>
						<th><input type="submit" name="ajouter" value="Ajouter"></th>
					</tr>
				</thead>
				<tbody>

					<?php for($k=0;$k<count($tabMembresPasEnOrdre);$k++){
						$a_paye = $this->_db->select_payements($tabMembresPasEnOrdre[$k]->no_user(),$annee);
					 ?>
						<tr>
							<td><?php echo $tabMembresPasEnOrdre[$k]->html_first_name()?> <?php echo $tabMembresPasEnOrdre[$k]->html_last_name()?><br> (<?php echo $tabMembresPasEnOrdre[$k]->html_e_mail()?>)</td>
							<td> <?php if(empty($a_paye[0])){echo '0 €';} else{ echo $a_paye[0]->html_amount().' €'; } ?> </td>
							<td><input type="text" name="payed[]">
							<input type="hidden" name="no_user[]" value="<?php echo $tabMembresPasEnOrdre[$k]->html_no_user()?>"></td>
						</tr>
						<?php } ?>
				</tbody>
			</table>
		</form>
			<?php echo $notification2;  ?>
			<!-- <p><a href='index.php?action=cotisations&amp;see=all'>Lister pour envoie par mail</a></p> -->
<h3>Membres en ordre</h3>
<?php if (count($tabMembresEnOrdre) == 0) {echo 'Aucun membre n\'a payé sa cotisation cette année';} ?>

	<table id="tableau">
				<thead>
					<tr>
						<th>Membres</th>
						<th>A payé</th>
					</tr>
				</thead>
				<tbody>

					<?php for($k=0;$k<count($tabMembresEnOrdre);$k++){ ?>
						<tr>
							<td><?php echo $tabMembresEnOrdre[$k]->html_first_name()?> <?php echo $tabMembresEnOrdre[$k]->html_last_name()?></td>
							<td><?php 
                                   
                                   	echo '✔';
                                   
								 ?></td>
								 <form action="index.php?action=cotisations" method="post">
							<!--<td><input type="submit" name="delete_payement" value="x"> -->
							<input type="hidden" name="no_user_delete" value="<?php echo $tabMembresEnOrdre[$k]->html_no_user()?>"></td>
						</form> 
						</tr>
						<?php } ?>
				</tbody>
			</table>
</section>