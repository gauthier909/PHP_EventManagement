<section>

    <table id="tableau">
        <thead>
            <tr>
                <th>Inscrits</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if(is_null($registered) || empty($registered)){ ?>
                    <td><?php echo ' Aucun'; } ?></td>
                </tr>
                <td>
                    <?php  for ($i=0;$i<count($registered);$i++) {  echo ' '.$registered[$i]->html_first_name().' '.$registered[$i]->html_last_name().'<br>'; } ?>
                </td>
            </tr>
        </tbody>
    </table>


    <table id="tableau">
        <thead>
            <tr>
                <th>Intéressés</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php if(is_null($interested) || empty($interested)){ ?>
                    <td><?php echo ' Aucun'; } ?></td>
                </tr>
                <td>
                    <?php  for ($i=0;$i<count($interested);$i++) { echo ' '.$interested[$i]->html_first_name().' '.$interested[$i]->html_last_name().'<br>'; } ?>
                </td>
            </tr>
        </tbody>
    </table>



</section>