<section id="contenu">
			<h2>Entrainement</h2>
			
			<p>Bienvenue , vous êtes connecté. Les autres liens ne sont disponible que si vous êtes un membre responsable ou coach. </p>
				<form action="index.php?action=entrainement" method="post">
					Entrainements de la semaine<input type="radio" name="week" value="" checked><br>
					Entrainement du jour<input type="radio" name="day" value=""><br>
					Tous les entrainements<input type="radio" name="all" value=""><br>
					<input type="submit" name="summary" value="Afficher">
				</form>
			<h2><?php echo $length ?></h2>
			<table id="tableau">
			  <thead>
			    <tr>
			      <th>Date</th>
			      <th>Programme du jour</th>
			    </tr>
			  </thead>
			  <tbody>
			    <?php for ($i=0; $i<count($tabplandetails); $i++) { ?>
			    <tr>
			      <td><?php echo $tabplandetails[$i]->html_date_training() ?></td>
			      <td><?php echo $tabplandetails[$i]->html_day_program() ?></td>
			    </tr>
			  <?php } ?>
			  </tbody>
			</table>

</section>