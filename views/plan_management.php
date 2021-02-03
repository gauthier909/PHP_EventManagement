
<section>
<h2>Gestion des Plans</h2>
<h3>Liste des plans</h3>

  <table id="tableau">
    <thead>
      <tr>
        <th>Nom du plan</th>
        <th>Effacer</th>
        <th>Modifier</th>
        <th>iCal</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i=0; $i<count($tabplans); $i++) { ?>
					<form action="?action=plan_management" method="post">
      <tr>
        <td><?php echo $tabplans[$i]->html_name() ?></td>
        <td><input type="submit" name="delete" value="X">
					<input type="hidden" name="num_plan" value="<?php echo $tabplans[$i]->html_num_plan(); ?>">
          <input type="hidden" name="name_plan" value="<?php echo $tabplans[$i]->html_name(); ?>">
        </td>
        <td><input type="submit" name="update" value="Modifier"></td>
				  </form>
          <td><a href="index.php?action=calendrier&decorate=no&plan=<?php echo $tabplans[$i]->html_num_plan(); ?>">Générer</a></td>
				<!--<td><?php #echo $tabplans[$i]->html_num_plan() ?></td>-->

      </tr>
		<?php } ?>
		<input type="hidden" name="num_plan" value="<?php echo $num_plan ?>">
    </tbody>
  </table>

<form enctype="multipart/form-data" action="index.php?action=plan_management" method="post">
<h3>Ajouter un plan</h3>
<p>Nom du plan à ajouter:</p>
	<input type="text" name="add_plan" value="Plan à ajouter">
  <p>Fichier .csv : <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
  <input type="file" name="csvfile" /></p>
	<input type="submit" name="add" value="Ajouter">
</form>

<p>
  <a href="index.php?action=entrainement">Retour aux entrainements</a>
</p>
</section>