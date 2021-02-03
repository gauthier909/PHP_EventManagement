<section>

<h2>Modification de <?php echo $_POST['name_plan'] ?></h2>

<table id="tableau">
  <thead>
    <tr>
      <th>Date</th>
      <th>Programme du jour</th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i=0; $i<count($tabplansdetails); $i++) { ?>
      <form action="?action=plan_management" method="post">
    <tr>
      <td><?php echo $tabplansdetails[$i]->html_date_training() ?></td>
      <td><input type="text" name="day_program" value="<?php echo $tabplansdetails[$i]->html_day_program(); ?>"></td>
      <td><input type="submit" name="update_plan" value="Appliquer"></td>
      <input type="hidden" name="num_plan" value="<?php echo $num_plan ?>">
      <input type="hidden" name="date_training" value="<?php echo $tabplansdetails[$i]->html_date_training()?>">
      </form>
    </tr>
  <?php } ?>
  </tbody>
</table><br>
</section>