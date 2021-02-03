<section id="contenu">
  <h2>Inscription à un évènement</h2>
  <p>Vous allez vous inscrire à l'évènement suivant: &nbsp;<?php echo $_POST['event_name'] ?> </p>
  <p>N° de compte: &nbsp;<?php echo $user_info->html_num_account()?></p>
  <p>Coût: &nbsp; <?php echo $_POST['event_cost'] ?> </p>
  <form action="index.php?action=evenement" method="post">
  <input type="submit" name="event_inscription" value="Payer et m'inscrire">
  <input type="hidden" name="num_event" value="<?php echo $detailed_event->html_num_event() ?>"
  </form>
</section>
