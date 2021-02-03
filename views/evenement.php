<section id="contenu">
      <h2>Evènements</h2>
      <?php foreach ($tabevents as $i => $event) { ?>
        <table id="tableau">
          <thead>
            <tr>
              <th>
          <p>	<?php echo $event->html_title() ?></p>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <form action="index.php?action=evenement" method="post">
                  <input type="submit" name="event_details" value="Plus d'infos">
                  <input type="hidden" name="num_event" value="<?php echo $event->html_num_event() ?>">
                </form>
              </td>
            </tr>
          </tbody>
        </table>
        <br>
      <?php } ?>
</section>
