<section id="contenu">
  <table id="tableau">
    <thead>
      <tr>
        <th>
    <p>	<?php echo $detailed_event->html_title() ?></p>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
      Quand? <?php echo $detailed_event->html_date_start() ?> <?php echo $detailed_event->html_date_end()?> <br>
      Où? <?php echo $detailed_event->html_location() ?> <br>
      Quoi? <?php echo $detailed_event->html_description() ?> <br>
      Coût approximatif: <?php echo $detailed_event->html_cost() ?> <br>
      URL: <?php echo $detailed_event->html_url() ?> <br>
      Map:
      <div id="map"></div>
          <script>
              function initMap() {
                  var position = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
                  var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 18,
                  center: position
                  });
                  var marker = new google.maps.Marker({
                      position: position,
                      map: map
                  });
              }
          </script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8F8wJWHNS136oIXmuAdkpFv0jrkz-lKk&callback=initMap"></script><br>
      <form action="index.php?action=evenement" method="post">
        <input type="submit" name="interest" value="<?php echo $notification_interest ?>">
        <?php if(is_null($registered)) { ?>
        <input type="submit" name="event_sign" value="S'inscrire à l'évènement">
        <?php } ?>
        <input type="hidden" name="event_details" value="true">
        <input type="hidden" name="num_event" value="<?php echo $detailed_event->html_num_event() ?>">
        <input type="hidden" name="event_name" value="<?php echo $detailed_event->html_title() ?>">
        <input type="hidden" name="event_cost" value="<?php echo $detailed_event->html_cost() ?>">
      </form>
        </td>
      </tr>
    </tbody>
  </table>
  <br><br><br>
</section>

<script src="./assets/ckeditor.js">
</script>
<script src="./views/javascript/wysiwyg.js">
</script>
